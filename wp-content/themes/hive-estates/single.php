<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

	<div class="container blog-detail property-detail-container">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-8">

				<div class="blog-img-feature">
					<?php echo get_the_post_thumbnail(); ?>
					<div class="post-meta">
						<span class="post-date">
							<i class="ri-calendar-todo-line"></i>
							<?php echo get_the_date('', $post_id); ?>
						</span>
						<span class="post-categories">
							<i class="fa fa-folder"></i>
							<?php $post_categories = get_the_category($post_id); ?>
							<?php foreach ($post_categories as $category) : ?>
								<a href="<?php echo get_category_link($category->term_id); ?>">
									<?php echo $category->name; ?>
								</a>
							<?php endforeach; ?>
						</span>
					</div>
				</div>

				<div class="property-info-top">
					<div class="info-top-left">
						<h2><?php the_title(); ?></h2>
					</div>
				</div>
				<div class="blog-detail-content">
					<?php echo the_content() ?>
				</div>
				<?php

				// the_title();
				// the_content();





				// while (have_posts()) :

				// 	the_post();

				// 	get_template_part('template-parts/content', get_post_type());

				// 	// If comments are open or we have at least one comment, load up the comment template.
				// 	if (comments_open() || get_comments_number()) :
				// 		comments_template();
				// 	endif;

				// endwhile; // End of the loop.
				?>
			</div>
			<div class="col-12 col-md-12 col-lg-4"></div>
		</div>
	</div>


</main><!-- #main -->

<?php
get_sidebar();
get_footer();
