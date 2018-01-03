<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'utopspac_ss_dbnamed8b');

/** MySQL database username */
define('DB_USER', 'utopspac_ss_dd8b');

/** MySQL database password */
define('DB_PASSWORD', 'WZGBQW3uDgvB');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '{snY<-kbGoRJVf]cR@s(}eA(x$p*KetDUEunbG-a>mlV_?V=bOpZWjzI%qdSKJhXEt;DGE(|gTD;M<ORD)%;tK[[-{/!IgOblu{w<NJWdq)MEe{&odx[bn}N^Jf@U*(o');
define('SECURE_AUTH_KEY', 'R=Iuwu}W]>+!xDW_Lq+pXdB!pteZR^Tix[)Gwj}IS_W!qBgg<>dF>Olz%!oPFyF)sY]xCGSRU*nsnga/g/a*W+[<Qmy[NU-eTRJL[Ucxw<kk$/ebTojp?Go>Mq;ytZPw');
define('LOGGED_IN_KEY', ']D^*zy/Qi!T<Wk=ae_wh<QTEkuI^]}n?h*!bq*M;ZdDYtMWKreXL!k]|Yoo@JhFDGbY=-HL@dzWg@-ocbSqMb??vTid/%G(JhgP)p+)YjPoWJp=j{KKtSx(TRzyQBGSm');
define('NONCE_KEY', 'mYv(zIYqEM&%uWKaiyuz^Iu*Gp|ea^yav]d!KRFyE?eE/|FnH/O^CwEJXGYHmCojo+BaC%bM>fIN/WNDvKLE}qPyS{DCEfFJw?/avIwGLva$>PN+oaqwp-<mgAFbe+*&');
define('AUTH_SALT', '>oWRrm!bLkj&SNRa$b!Cw!*KzTVPRKH}Fw&J-kFRXSW]N&TLW%iM@]LF-&MwOT&E]G*WgEpmBz{zn!Lx+=RE^dc=ewXP[!>g|er}KHP!CrqGAA)isrJp-|EkGp=_NB*S');
define('SECURE_AUTH_SALT', '*Bx?ALI;I[)hh+@}YUHg{*JG|pw}NYuq]QP}CtyIy+c_k]k}t<}GvM%rhR^xsN$N_w)f{)$ZNnW^jp>C-GMDLB?L%/REwh*Z<fW_pF;$@vWRXbzD;-)rOX;$cA>]vkA[');
define('LOGGED_IN_SALT', 'Msyq(!BIrK&eXgLTjyaT*Lrp|wCVhLyc?ko_dCaL>{Bu?@kIm)ec}^%xszVGH@GkWm?YL@eG/-CFYL@azSHhcLTLR-<iKYrCIHGUSr+=sxBUpj_>}+CiuOYCAMW<DiF&');
define('NONCE_SALT', 'fwVt/qG+D]rYf<um=k@k-?qUH=>U$db<+@t]aaXPxA-$)qV!]F^HtIl$@{IEX>V;[P*!ZyYmx{|i{_Q=&*!IAv({kq=WE>AI>QDj)xt;}O(@q$EU/>e[VN@vz}BDbGP+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_ifoo_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
