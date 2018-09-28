<?php
/**
* The Header for our theme.
*
* Displays all of the <head> section and everything up till <div id="main">
*
* @package gndmbldr
**/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="shortcut icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.png"/>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!-- <link href='https://fonts.googleapis.com/css?family=Fira+Sans:400,300' rel='stylesheet' type='text/css'> -->
<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:300,400,600" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Teko:300,500" rel="stylesheet">

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TVVHKXH');</script>
<!-- End Google Tag Manager -->

<?php wp_head(); ?>
</head>



<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="">
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php wp_head(); ?>
	<meta name="p:domain_verify" content="973ba085206c4de597f2f91978ff2a48"/>


</head>
<body <?php body_class(); ?>>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TVVHKXH"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<div id="page" class="<?php echo( $template ); ?>">
		<header class="gb-head gb-hdr clear-fix">
			<div class="gb-logo gb-hdr__logo text-center"><a href="<?php bloginfo('siteurl'); ?>"><img id="gb-logo" src="<?php bloginfo('stylesheet_directory'); ?>/images/gb-logo.png" width="603" height="348"></a></div>
			<div class="gb-header-mobile gb-hdr__mobile">
				<div class="gb-logo-mobile gb-hdr__mobile__logo"><a href="<?php bloginfo('siteurl'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/gb-logo.png" width="603" height="348"></a></div>
				<div class="gb-buttons-mobile gb-hdr__burger">
					<div class="burger-wrapper">
					  <span class="burger"></span>
					</div>
				</div>
			</div>

			<nav class="gb-menubar" id="access" role="navigation">
				<h1 class="assistive-text section-heading" style="display:none;"><?php _e( 'Main menu', 'toolbox' ); ?></h1>
				<div class="skip-link screen-reader-text" style="display:none;"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'toolbox' ); ?>"><?php _e( 'Skip to content', 'toolbox' ); ?></a></div>

				<?php wp_nav_menu( array('location' => 'primary' ,'menu' => 'Menu 1','container'=> 'div','container_class' => 'menu gb-menu','menu_class' => 'navi gb-menu__list', 'depth' => 2)); ?>

					<!-- SAMPLE MENU HTML GENERATED

					<div class="menu">
						<ul>
							<li class="current_page_item">
								<a href="http://localhost/gundambuilder.com/">Home</a>
							</li>
							<li class="page_item page-item-2">
								<a href="http://localhost/gundambuilder.com/?page_id=2">Sample Page</a>
							</li>
						</ul>
					</div>

					!-->

			</nav><!-- #access -->
		</header><!--- /HEAD ---->
