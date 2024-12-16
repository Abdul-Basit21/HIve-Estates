<?php

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
						<img src="/wp-content/uploads/2024/12/Group-1000004714-3-1.png" alt="">
						<p class="footer-para">
							Over 39,000 people work for us in more than 70 countries all over the This breadth of global coverage, combined with specialist services
						</p>
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