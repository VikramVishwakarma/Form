<!doctype html>
<html class="no-js" lang="zxx" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset') ?>" >
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php
        bloginfo('name');
        if (wp_title('', false)) {
            echo ' |';
        } else {
            echo bloginfo('description');
        } wp_title('');
        ?></title>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?=get_bloginfo( 'name' );?></title>
        
        <!-- Font Awesome icons (free version)-->
        <!-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> -->
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <style>
        fieldset {
            border: 1px solid #d4cdcd;
            border-radius: 5px;
        }
        #replacement_section p{
            color: rgb(0, 120, 212);
            font-weight: bolder;
            letter-spacing: 3px;
            font-family: cursive;
            text-align: center;
            font-size: 2rem;
            margin-top: -120px;
        }
        </style>

        <?php wp_head()?>
    </head>
    <body id="page-top" <?php body_class()?>>
      