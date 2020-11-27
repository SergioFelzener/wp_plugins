<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wpcms' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', '127.0.0.1' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Ewbw+f5V,99YIiBxXaVB)(YH#WC:=UPw&$~cFSk`B.EJWfc3]#R0GOq~^OTw(3B[' );
define( 'SECURE_AUTH_KEY',  '&@vq9fOU/A2CM_vw2h{r(t!uETOR*X<Ogr{<$GE?Uc3Eig6~,Psn[As5i@7P{_K>' );
define( 'LOGGED_IN_KEY',    '_pMUFA))s 9s{Kc6eJ^6CNYrYy`29w<sWeMldv{e5sa{sIf!i!0mg{4V$xVL)b]}' );
define( 'NONCE_KEY',        '8tLIKp=nw5X4u&=VFmA)E~yMql8Vh|j@ya5yl); 9ec_}nXGle)&x!fdu3I>8eEL' );
define( 'AUTH_SALT',        '3gOtHCAyQn)E7kP@i3DUYXy,0OIUrs!fvUO!5(>EB{k=gx2B;a{rT%,g^ly&IekG' );
define( 'SECURE_AUTH_SALT', 'k8t^#y-MXA%?&VYO%E*|qpVkYZ^d.GSr[v=JE&E%$DJEg72Pdion.`&+VSVKI=[<' );
define( 'LOGGED_IN_SALT',   ')VnDHRl(M-IMyBCGDIUle118X8/elfE3C6n]lr5{;uF)7JYs_diVI`1>XiZAm{7G' );
define( 'NONCE_SALT',       'sf8RI6Q=G]qjO3[KRxhaC$7 ^;0F}|%cqv$CDQaq%gpx|bz7];Y-Bm2S8:fdOc@p' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'FS_METHOD', 'direct' );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}


/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';