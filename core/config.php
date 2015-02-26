<?php 

define('URL_WEB', 'http://localhost/coffee-dashboard/');

// ========== ID & PASS ========== 

// MARS
define('DB_HOST', 'localhost');
define('DB_NAME', 'coffee_dashboard');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// ========== CORE ===============
 
define('DIR_CORE',   __DIR__);

define('DIR_VIEW', DIR_CORE . '/view/');

define('DIR_CTL', DIR_CORE . '/ctrl/');
define('DIR_MDL', DIR_CORE . '/mdl/');
define('DIR_TOOLS', DIR_CORE . '/tools/');


// ========== VIEWS ==============

define('VIEW_HEADER', DIR_VIEW . 'header.php');
define('VIEW_FOOTER', DIR_VIEW . 'footer.php');

 ?>
