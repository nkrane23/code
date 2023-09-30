<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta id="meta" name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon-16x16.png">
<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/images/favicons/site.webmanifest">

<link href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-logo.png" rel="apple-touch-icon-precomposed">

<script type="text/javascript">
    var mmtitle = "<?= get_field('mobile_menu_title', 'option');?>"
</script>

<!-- Google Fonts-->
<link href="https://fonts.googleapis.com/css?family=Dosis:400,500|Lora|Bad+Script|Comfortaa" rel="stylesheet">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3F38CQBHGS"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-3F38CQBHGS');
</script>

<?php wp_head(); ?>