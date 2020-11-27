<?php 

/**
 * Plugin Name: Enviar arquivo .ZIP com multiplas imagens.
 * Plugin URI: https://teste.com
 * Description: Este Plugin envia arquivos de imagens .ZIP e descompacta os arquivos de imagens na pasta MEDIA do WP.
 * Version: 1.0.0
 * Author: Sergio Felzener
 * Author URI: https://teste.com
 * Text Domain: unzip-file
 * Domain Path: media_unzip_files
 * Requires at least: 5.3
 * Requires PHP: 7.0
 *
 *
 */


 class MediaUnzip { 

    private static $instance;

    public static function getInstance() { 
        if (self::$instance == NULL) { 
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() { 

        add_action('admin_menu', array($this, 'start_media_file_unzip'));

    }

    public function start_media_file_unzip () { 

        add_menu_page('Upload Media Zip',
                      'Upload Media Zip', 
                      'manage_options', 
                      'upload_media_zip', 
                      'MediaUnzip::upload_media_zip',
                      'dashicons-media-archive',
                       10 );

    }


    //criando funcao que verifica o tipo de arquivo enviado.

    public function allowed_file_types( $filetype ) { 

        $allowed_file_types = array('image/png', 
                                    'image/jpeg',
                                    'image/svg',
                                    'image/jpg', 
                                    'image/bmp');

        if ( in_array( $filetype, $allowed_file_types )) { 

            return true;

        } else { 

            return false;
        }



    }

    public function upload_media_zip() { 

        echo'<head>
                <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            </head>';
        

            _e('<h3 class="mt-10 text-2xl"> Upload de Arquivos ZIP</h3>', 'unzip-file');

            echo '
 

        <form class="mt-5" action="/wp_plugins/wordpress/wp-admin/admin.php?page=upload_media_zip" enctype="multipart/form-data" method="POST">
            <div class="flex w-full mt-4">                 
                    <input class="border shadow-sm text-sm font-medium rounded-md" type="file" name="fileToUpload" id="fileToUpload">
                       
            </div>

            <button type="submit" name="submit" class="inline-flex shadow-2xl mt-2 py-2 px-4 justify-center 
                    border border-transparent shadow-sm text-sm font-medium rounded-md text-white 
                    bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 
                    focus:ring-indigo-700">Save
            </button>
        </form>
        
        
        
        
        ';


        if ( isset($_FILES['fileToUpload']) ) {

            //Preparar arquivos para serem enviados

            //Obter diretorio do plugin 

            $dir = "../wp-content/uploads" . wp_upload_dir()['subdir'];

            // Usar o PHP para carregar o arquivo ZIP para diretório de upload

            $target_file = $dir.'/'.basename($_FILES['fileToUpload']['name']);
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file); 

            $file_name = basename($_FILES['fileToUpload']['name']);

            // Criar Instancia de um objeto utilitário 

            $zip = new ZipArchive();

            // Abrir arquivo zip 

            $res = $zip -> open($target_file);

            //verificar se existe o arquivo 

            if ($res === TRUE) { 

                $zip->extractTo($dir);

                //exibir mensagem de sucesso

                echo '<h3 class="text-lg shadow-lg text-green-500">O arquivo zip' .  $file_name . ' foi descompactado com sucesso ' . wp_upload_dir()['url'] . '</h3>';


                echo "Tem" . $zip->numFiles. "Arquivos neste arquivo<br>";

                for ( $i = 0; $i < $zip->numFiles; $i++ ) { 

                    //obter url do arquivo de Mídia.

                    $media_file_name = wp_upload_dir()['url'].'/'.$zip->getNameIndex($i);

                    echo "$media_file_name";

                    // Obter o tipo do arquivo de Midia 

                    $filetype = wp_check_filetype(basename($media_file_name), null);
                    $allowed = MediaUnzip::allowed_file_types($filetype['type']);

                    if ($allowed) { 

                        // exibir o link para usuário ver arquivo upload

                        echo '<a href="'.$media_file_name.'" target="_blank">'.$media_file_name. '</a>
                                Tipos: '.$filetype['type'].'<br> 
                        
                             ';


                        // Informações dos anexos que vai ser utilizado pela biblioteca de midia
                        $attachment = array(

                            'guid' => $media_file_name,
                            'post_mime_type' => $filetype['type'],
                            'post_title' => preg_replace('/\.[ˆ.]+$/', '', $zip->getNameIndex($i)),
                            'post_content' => '',
                            'post_status' => 'inherit'

                        );

                        //inserir anexo

                        $attach_id = wp_insert_attachment($attachment, $dir . '/' . $zip->getNameIndex($i));

                        //Metadados do Anexo 

                        $attach_data = wp_generate_attachment_metadata($attach_id, $dir. '/' . $zip->getNameIndex);
                        wp_update_attachment_metadata($attach_id, $attach_data);

                    } else { 

                        echo $zip->getNameIndex($i). ' Não pode ser enviado' . $filetype['type'] . 'arquivo não permitido';

                        
                    }




                }

            }else { 
                echo '<h3 class="mt-2 text-lg text-red-500">O arquivo ' . $file_name  .  ' não foi descompactado Arquivo Inválido</h3>';

                echo '<p class="text-green-600">Este upload só aceita arquivos .ZIP</p>';

                echo '<p class="mt-2">conteúdo</p>';
                echo '<p class="text-blue-300">image/png</p>
                <p class="text-blue-300">image/jpeg</p>
                <p class="text-blue-300">image/svg</p>
                <p class="text-blue-300">image/jpg</p> 
                <p class="text-blue-300">image/bmp</p>';

            }

            $zip->close();



        }

    }

 }

 MediaUnzip::getInstance();



