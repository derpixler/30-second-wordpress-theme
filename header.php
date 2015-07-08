<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and
 * everything up till some navigation parts
 *
 * @package    WordPress
 * @subpackage 30 Second WordPress Theme
 */
?>
<!Doctype html>
<!--[if IE 7]><html class="no-js ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !IE]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
	<title><?php wp_title( '|', TRUE, 'right' ); ?></title>
	<meta name="application-name" content="<?php bloginfo( 'blogname' ); ?>">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ( is_singular() ) : wp_enqueue_script( 'comment-reply' ); endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    
	<div class="wrapper">
	
        <!-- Header -->
        <header class="header_wrap">
				
	<section id="header-1" class="row">
				
		<div id="logo" class="logo">
			<?php echo t30_get_logo(); ?>
		</div>

%MAIN_CONTENT_AREA%

	</section>

		</header>