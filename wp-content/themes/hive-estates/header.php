<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hive_Estates
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'hive-estates'); ?></a>

		<header id="masthead" class="site-header container-fluid header-main">
			<div class="container header-container">
				<div class="row align-items-center">
					<div class="col-2">
						<div class="site-branding">
							<?php
							the_custom_logo();
							if (is_front_page() && is_home()) :
							?>
								<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
							<?php
							else :
							?>
								<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
										<?php
										if (!is_home() && ! is_front_page()) {
										?>
											<img src="/wp-content/uploads/2024/12/Group-1000004714-2-1.png">

										<?php
										} else {
										?>
											<img src="<?= get_field('header_logo', 'option'); ?>">
										<?php
										}
										?>
									</a></p>
							<?php
							endif;
							$hive_estates_description = get_bloginfo('description', 'display');
							if ($hive_estates_description || is_customize_preview()) :
							?>
								<p class="site-description"><?php echo $hive_estates_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
															?></p>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-7 header-center-div">
						<nav id="site-navigation" class="main-navigation">
							<?php
							wp_nav_menu(
								array(
									'menu' => 'header menu',
									// 'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'menu_class'        => 'main-menu',
								)
							);
							?>
						</nav><!-- #site-navigation -->
						<!-- <i class="fa-solid fa-bars-staggered sider-bar-open"></i> -->
						<i class="ri-bar-chart-horizontal-line sider-bar-open"></i>
					</div>
					<div id="sidebar-wrapper" class="sidebar-wrapper">
						<!-- <i class="fa-solid fa-xmark sidebar-close"></i> -->
						<i class="ri-close-fill sidebar-close"></i>
						<div class="logo">
							<img src="<?= get_field('sidebar_logo', 'option'); ?>" alt="">
						</div>
						<div class="contact-info">
							<h2><?= get_field('contact_info', 'option'); ?></h2>
							<p><?= get_field('contact_address', 'option'); ?></p>
						</div>
						<div class="gallery-wrapper">
							<h2>Gallery</h2>
							<div class="gallery">
								<?php
								$gallery_imgs = get_field('gallery', 'option');
								foreach ($gallery_imgs as $gallery) {
								?>
									<img src="<?php echo $gallery['gallery_img']; ?>" alt="">
								<?php
								};
								?>
							</div>
						</div>

						<div class="social-info">
							<h2><?= get_field('follow_us', 'option'); ?></h2>
							<div class="social-links">
								<?php
								$sidebar_social_links = get_field('sidebar_social_links', 'option');
								foreach ($sidebar_social_links as $sidebar_social_link) {
								?>
									<a href="<?php echo $sidebar_social_link['sidebar_socail_link']; ?>"><?php echo $sidebar_social_link['sidebar-social_icon']; ?></a>
								<?php
								}
								?>
							</div>
						</div>
					</div>
					<div class="col-3 col-lg-3">
						<div class="header-right-wrapper">
							<div class="icon">
								<i class="ri-customer-service-2-line"></i>
							</div>
							<div class="footer-right-info">
								<span><?= get_field('request_a_demo_text', 'option'); ?></span>
								<a href="tel:<?= get_field('request_a_demo_number', 'option'); ?>"><?= get_field('request_a_demo_number', 'option'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>

		</header><!-- #masthead -->