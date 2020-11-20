<?php

/**
 * Plugin Name: Personalizar Painel do Admin.
 * Plugin URI: https://teste.com
 * Description: Este Plugin personaliza Painel de Admin.
 * Version: 1.0.0
 * Author: Sergio Felzener
 * Author URI: https://teste.com
 * Text Domain: thema-admin-personalizado
 * Domain Path: meu_tema_personalizado
 * Requires at least: 5.3
 * Requires PHP: 7.0
 *
 *
 */

class PainelPersonalizado
{

    private static $instance;

    public static function getInstance()
    {

        if (self::$instance == null) {

            self::$instance = new self();
        }
    }

    private function __construct()
    {

        //Desativar a action welcome_panel

        remove_action('welcome_panel', 'wp_welcome_panel');


        // Adicionando meu painel personalizado

        add_action('welcome_panel', array($this,  'painel_personalizado'));
    }

    function painel_personalizado()
    {
?>

        <div class="welcome-panel">
            <h3>Seja Bem vindo Ao Painel Administrativo Personalizado</h3>
            <p>Link Social</p>
            <div id="icons">
                <a href="#" target="_blank">
                    <img src="http://127.0.0.1/wp_plugins/wordpress/wp-content/uploads/2020/11/youtube-e1605902191805.png" alt="youtube">
                </a>
                <a href="#" target="_blank">
                    <img src="http://127.0.0.1/wp_plugins/wordpress/wp-content/uploads/2020/11/face-e1605902163134.png" alt="facebook">
                </a>
                <a href="#" target="_blank">
                    <img src="http://127.0.0.1/wp_plugins/wordpress/wp-content/uploads/2020/11/twitter-e1605902138309.png" alt="twitter">
                </a>
                <a href="#" target="_blank">
                    <img src="http://127.0.0.1/wp_plugins/wordpress/wp-content/uploads/2020/11/git-e1605902417897.png" alt="github">
                </a>

            </div>


        </div>

<?php


    }
}

PainelPersonalizado::getInstance();
