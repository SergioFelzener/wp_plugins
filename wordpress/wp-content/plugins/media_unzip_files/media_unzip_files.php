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

        echo "<h3 class='mt-10 text-2xl'>" . __('Upload de Arquivos ZIP', 'unzip-file') . "</h3>";

        echo '
 

        <form action="/wordpress/wp-admin/admin.php?page=upload_media_zip" enctype="multipart/form-data">
            <div class="flex w-full mt-4">
                <label for="fileToUpload" class="w-64 flex flex-col items-center px-4 py-6 bg-purple-500 text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-purple-400 hover:text-white">
                    <i class="material-icons w-8 h-8">cloud_upload</i>
                    <span class="mt-2 text-base leading-normal">Selecione o Arquivo</span>
                    <input type="file" class="hidden" name="fileToUpload" id="fileToUpload/>
                </label>
            </div>
        </form>
        
        
        
        
        ';



    }

 }

 MediaUnzip::getInstance();



