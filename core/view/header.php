<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title><?php if(isset($the_title)) { echo $the_title . ' | Coffee Dashboard'; }else{ echo"Coffee Dashboard";} ?> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URL_WEB ?>assets/css/main.min.css">
</head>
<body id ="<?php if(isset($simple_title)) { echo $simple_title; }; ?>">



