<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
					<h1 class="inner-title"><?php the_title() ?></h1>
					<?php if (function_exists('yoast_breadcrumb')) {
						yoast_breadcrumb('<nav aria-label="You are here:" role="navigation"><ul class="breadcrumbs">', '</ul></nav>');
					} ?>
				</div>
			</div>
		</div>
	</div>
	<?php the_content(); ?>

</main><!-- #main -->



<?php
get_sidebar();
get_footer();
