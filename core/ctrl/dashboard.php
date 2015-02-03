<?php  

$the_title = 'Dashboard';
$simple_title =  strtolower($the_title);  
$page_to_load = DIR_VIEW . 'dashboard.php';

include( VIEW_HEADER );
include( $page_to_load );
include( VIEW_FOOTER );

?>

