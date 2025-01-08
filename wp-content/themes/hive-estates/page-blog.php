<?php
/* Template Name: Blog Posts */
get_header();
?>

<main class="blog-posts-container">
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
    <div class="container">
        <div class="blog-posts row mt-4 mb-5">
            <?php
            // Set up pagination
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            // Query for blog posts
            $blog_query = new WP_Query(array(
                'post_type'      => 'post',      // Default blog post type
                'posts_per_page' => 6,         // Number of posts per page
                'paged'          => $paged,     // Current page
            ));

            if ($blog_query->have_posts()) :
                while ($blog_query->have_posts()) :
                    $blog_query->the_post();
            ?>
                    <div class="col-12 col-md-6 col-lg-4 mt-4">
                        <div class="blog-post-item property-list">
                            <div class="post-thumbnail property-img-wrapper hover-img-efftect">
                                <a href="<?php echo get_permalink($post_id); ?>">
                                    <?php echo get_the_post_thumbnail($post_id, 'medium') ?>
                                </a>
                            </div>
                            <div class="post-content">
                                <h3 class="post-title">
                                    <a class="property-title" href="<?php echo get_permalink($post_id); ?>">
                                        <?php echo get_the_title($post_id); ?>
                                    </a>
                                </h3>
                                <p class="post-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt($post_id), 20); ?>
                                </p>
                                <div class="post-meta">
                                    <span class="post-date">
                                        <i class="ri-calendar-todo-line"></i>
                                        <?php echo get_the_date('', $post_id); ?>
                                    </span>
                                    <!-- <span class="post-categories">
                                        <i class="fa fa-folder"></i>
                                        <?php foreach ($post_categories as $category) : ?>
                                            <a href="<?php echo get_category_link($category->term_id); ?>">
                                                <?php echo $category->name; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </span> -->
                                </div>
                                <?php if ($post_tags) : ?>
                                    <div class="post-tags">
                                        <i class="fa fa-tags"></i>
                                        <?php foreach ($post_tags as $tag) : ?>
                                            <a href="<?php echo get_tag_link($tag->term_id); ?>">
                                                <?php echo $tag->name; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;

                // Pagination
                echo '<div class="pagination">';
                echo paginate_links(array(
                    'total' => $blog_query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => '&laquo; Previous',
                    'next_text' => 'Next &raquo;',
                ));
                echo '</div>';
            else :
                echo '<p>No blog posts found.</p>';
            endif;

            // Restore original post data
            wp_reset_postdata();
            ?>
        </div>
    </div>

</main>

<?php
get_footer();
?>