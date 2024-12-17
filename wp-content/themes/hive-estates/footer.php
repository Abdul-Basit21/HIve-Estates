<a?php

	/**
	* The template for displaying the footer
	*
	* Contains the closing of the #content div and all content after.
	*
	* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	*
	* @package Hive_Estates
	*/

	?>

	<footer id="colophon" class="site-footer container-fluid  p-0">
		<div class="container-fluid newsletter-wrapper">
			<div class="container">
				<v class="row">
					<div class="col-7 d-flex align-items-center">
						<h4 class="newsletter-title">
							Newsletter To Get Updated The Latest News
						</h4>
					</div>
					<div class="col-5">
						<?php echo do_shortcode('[contact-form-7 id="c90925f" title="newsletter-form"]'); ?>
					</div>
				</v>
			</div>
		</div>
		<div class="container-fluid footer-main">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-4 col-lg-4">
						<div class="footer-first-col">
							<img src="<?= get_field('header_logo', 'option'); ?>" alt="">
							<p class="footer-para">
								<?= get_field('footer_para', 'option'); ?>
							</p>
							<div class="footer-social-links">
								<?php
									$social_links = get_field('footer_social_links', 'option');
									foreach ($social_links as $social_link) {
									?>
								<?php echo $social_link['social_link']; ?>
							<?php
									}
							?>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4 col-lg-2 footer-menu-col">
						<h3 class="footer-links-heading">
							Useful Links
						</h3>
						<?php
						wp_nav_menu(
							array(
								'menu' => 'footer-second-col',
								// 'theme_location' => 'menu-1',
								'menu_id'        => 'footer-second',
								'menu_class'        => 'footer-second-col',
							)
						);
						?>
					</div>
					<div class="col-12 col-md-4 col-lg-2 footer-menu-col">
						<h3 class="footer-links-heading">
							Explore
						</h3>
						<?php
						wp_nav_menu(
							array(
								'menu' => 'footer-third-col',
								// 'theme_location' => 'menu-1',
								'menu_id'        => 'footer-third',
								'menu_class'        => 'footer-third-col',
							)
						);
						?>
					</div>
					<div class="col-12 col-md-4 col-lg-4">
						<h3 class="footer-links-heading">
							Get In Touch
						</h3>
						<div class="footer-info-links">
							<div class="icon-link location">
								<?php echo get_field('location_icon', 'option'); ?>
								<a href="<?php echo get_field('location_link_url', 'option') ?>" class="icon-text"><?php echo get_field('location', 'option'); ?></a>
							</div>
							<div class="icon-link phone">
								<?php echo get_field('phone_icon', 'option'); ?>
								<a href="tel:<?php echo get_field('phone', 'option'); ?>" class="icon-text"><?php echo get_field('phone', 'option'); ?></a>
							</div>
							<div class="icon-link mail">
								<?php echo get_field('mail_icon', 'option'); ?>
								<a href="mailto:<?php echo get_field('email', 'option'); ?>" class="icon-text"><?php echo get_field('email', 'option'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fuid footer-copyright">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="site-info">
							<a href="<?php echo esc_url(__('https://wordpress.org/', 'hive-estates')); ?>">
								<?php
								/* translators: %s: CMS name, i.e. WordPress. */
								printf(esc_html__('Proudly powered by %s', 'hive-estates'), 'WordPress');
								?>
							</a>
							<span class="sep"> | </span>
							<?php
							/* translators: 1: Theme name, 2: Theme author. */
							printf(esc_html__('Theme: %1$s by %2$s.', 'hive-estates'), 'hive-estates', '<a href="https://devteampro.com/">devTeam_studios</a>');
							?>
						</div><!-- .site-info -->
					</div>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>

	</body>

	</html>