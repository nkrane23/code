<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php get_template_part( 'parts/header/head'); ?>
</head>

<body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">

<div class="site-wrapper">
    <?php
        if(empty(get_field('skip_to_main'))) {
            $skip = 'main';
        } else {
            $skip = get_field('skip_to_main');
        }
    ?>

    <a href="#<?= $skip;?>" id="skip-to-content" aria-label="Skip to main content">Skip to main content</a>

    <?php get_template_part( 'parts/header/header'); ?>