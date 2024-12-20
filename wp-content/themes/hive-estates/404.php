<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Hive_Estates
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container-fluid inner-banner p-0">
		<div class="container">
			<div class="row">
				<div class="col-12 inner-banner-wrapper">
					<h1 class="inner-title">Page Not Find</h1>
					<?php if (function_exists('yoast_breadcrumb')) {
						yoast_breadcrumb('<nav aria-label="You are here:" role="navigation"><ul class="breadcrumbs">', '</ul></nav>');
					} ?>
				</div>
			</div>
		</div>
	</div>
	<section class="error-404 not-found container d-flex justify-content-center align-items-center">
		<div class="row">
			<div class="col-12">
				<header class="page-header">
					<img src="<?= get_field('404_image', 'option'); ?>" alt="">
					<h1 class="page-title"><?php esc_html_e('Oops! page not found.', 'hive-estates'); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'hive-estates'); ?></p>
				</div><!-- .page-content -->
				<div class="hive-btn">
					<a href="/">
						<span>Back To Homepage</span>
					</a>
				</div>
			</div>
		</div>
	</section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
