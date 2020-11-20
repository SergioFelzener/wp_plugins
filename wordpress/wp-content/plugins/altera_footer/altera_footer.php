<?php

/**
 * Plugin Name: Colocar Footer Personalizado no Site.
 * Plugin URI: https://teste.com
 * Description: Este Plugin altera o footer do site.
 * Version: 1.0.0
 * Author: Sergio Felzener
 * Author URI: https://teste.com
 * Text Domain: woocommerce
 * Domain Path: altera_footer
 * Requires at least: 5.3
 * Requires PHP: 7.0
 *
 *
 */


function footer_movie_games_wp(){

    echo "  <head>
                <style>   
                    footer p {
                        padding: 5px 0;
                        padding-top: 10px;
                        text-align: center;
                        color: white;
                    } 
                    footer img {
                        width: 144px;
                    }
                    footer {
                        background-color: black;
                    }
                </style>
            </head>
            <footer>
                <p>Copyright &copy; 2020 <img src='./wp-content/img/logo2.png' alt='logo'> All Rights Reserved.</p>
                <p>Desenvolvimento de Plug-in para WordPress Sergio Felzener - Senac - CMS</p>
            </footer>";
}

add_action( 'wp_footer' , 'footer_movie_games_wp' );
