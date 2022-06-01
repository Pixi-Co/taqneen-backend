<?php

/*
 * ==========================================================
 * INITIAL CONFIGURATION FILE
 * ==========================================================
 *
 * Insert here the information for the database connection and for other core settings.
 *
 */

require_once "env.php";


/* Main folder url */
define('MAIN_URL', env('SB_MAIN'));

/* Plugin folder url */
define('SB_URL', env('SB_URL'));

/* The name of the database */
define('SB_DB_NAME', env('DB_DATABASE'));

/* MySQL database username */
define('SB_DB_USER', env('DB_USERNAME'));

/* MySQL database password */
define('SB_DB_PASSWORD', env('DB_PASSWORD'));

/* MySQL hostname */
define('SB_DB_HOST', env('DB_HOST'));

/* MySQL port (optional) */
define('SB_DB_PORT', '');
/* [extra] */

define('SB_ADMIN_LANG', 'ar');

define('SB_CROSS_DOMAIN', true);

define('SB_CROSS_DOMAIN_URL', 'https://taqneen.com');
?>
