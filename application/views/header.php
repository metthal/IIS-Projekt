<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo config_item('charset');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>style/layout.css">
</head>
<body>
<div class="mainbody">
<div class="header">
<h1>Učebne, such logo</h1>
<?php

if (login_data('username'))
{
    echo '<div class="logged_as">', PHP_EOL;
    echo 'Prihlásený ako <span class="login">', login_data('username'), '</span>', PHP_EOL;
    echo '</div>', PHP_EOL;
}

?>
