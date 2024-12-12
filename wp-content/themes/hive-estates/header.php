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
								<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img src="/wp-content/uploads/2024/12/Group-1000004714-3-1.png"></a></p>
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
					<div class="sidebar-wrapper">
						<!-- <i class="fa-solid fa-xmark sidebar-close"></i> -->
						<i class="ri-close-fill sidebar-close"></i>
						<div class="logo">
							<img src="/wp-content/uploads/2024/12/Group-1000004714-4.png" alt="">
						</div>
						<div class="contact-info">
							<h2>Contact Info:</h2>
							<p>Akshya Nagar 1st Block 1st Cross, Rammurthy nagar, Bangalore-560016 </p>
						</div>
						<div class="gallery-wrapper">
							<h2>Gallery</h2>
							<div class="gallery">
								<img src="/wp-content/uploads/2024/12/construction-concept-with-engineering-tools_1150-17810.jpg" alt="">
								<img src="/wp-content/uploads/2024/12/3d-rendering-business-meeting-working-room-office-building-scaled.jpg" alt="">
								<img src="/wp-content/uploads/2024/12/modern-residential-building_1268-14735.jpg" alt="">
								<img src="/wp-content/uploads/2024/12/construction-concept-with-engineering-tools_1150-17810.jpg" alt="">
								<img src="/wp-content/uploads/2024/12/3d-rendering-business-meeting-working-room-office-building-scaled.jpg" alt="">
								<img src="/wp-content/uploads/2024/12/modern-residential-building_1268-14735.jpg" alt="">
							</div>
						</div>

						<div class="social-info">
							<h2>Follow Us On:</h2>
							<div class="social-links">
								<i class="fa-brands fa-facebook-f"></i>
								<i class="fa-brands fa-instagram"></i>
								<i class="fa-brands fa-linkedin-in"></i>
								<i class="fa-brands fa-youtube"></i>
							</div>
						</div>
					</div>
					<div class="col-3 col-lg-3">
						<div class="header-right-wrapper">
							<div class="icon">
								<i class="ri-customer-service-2-line"></i>
							</div>
							<div class="footer-right-info">
								<span>Request a demo</span>
								<a href="">0123456789</a>
							</div>
						</div>
					</div>
				</div>
			</div>

		</header><!-- #masthead -->