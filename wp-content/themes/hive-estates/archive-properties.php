<?php
get_header();
?>

<main class="properties-archive-container">
    <div class="container-fluid inner-banner p-0">
        <div class="container">
            <div class="row">
                <div class="col-12 inner-banner-wrapper">
                    <h1 class="inner-title">Properties</h1>
                    <?php if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<nav aria-label="You are here:" role="navigation"><ul class="breadcrumbs">', '</ul></nav>');
                    } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-2 mb-4 property-filter-container">
        <!-- Filter Form -->
        <div class="row mt-4 mb-2">
            <form method="GET" action="">
                <!-- Search -->
                <input type="text" name="property_search" placeholder="Search properties" value="<?php echo isset($_GET['property_search']) ? esc_attr($_GET['property_search']) : ''; ?>">

                <!-- Tags Filter -->
                <?php
                $tags = get_terms(array(
                    'taxonomy' => 'post_tag', // WordPress default tags taxonomy
                    'hide_empty' => true,
                ));
                ?>
                <select name="property_tag">
                    <option value="">All Tags</option>
                    <?php foreach ($tags as $tag) : ?>
                        <option value="<?php echo esc_attr($tag->slug); ?>" <?php selected(isset($_GET['property_tag']) && $_GET['property_tag'] === $tag->slug); ?>>
                            <?php echo esc_html($tag->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Category Filter -->
                <?php
                $categories = get_categories(array(
                    'taxonomy' => 'category', // WordPress default categories taxonomy
                    'hide_empty' => true,
                ));
                ?>
                <select name="property_category">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo esc_attr($category->slug); ?>" <?php selected(isset($_GET['property_category']) && $_GET['property_category'] === $category->slug); ?>>
                            <?php echo esc_html($category->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Price Sorting -->
                <select name="sort_price">
                    <option value="">Sort by Price</option>
                    <option value="low_to_high" <?php selected(isset($_GET['sort_price']) && $_GET['sort_price'] === 'low_to_high'); ?>>Low to High</option>
                    <option value="high_to_low" <?php selected(isset($_GET['sort_price']) && $_GET['sort_price'] === 'high_to_low'); ?>>High to Low</option>
                </select>

                <!-- Submit Button -->
                <button type="submit">Filter</button>
            </form>
        </div>
        <!-- Properties List -->
        <div class="properties-list row mb-5 px-2 px-md-0">
            <?php
            // Initialize variables
            $search_query = isset($_GET['property_search']) ? sanitize_text_field($_GET['property_search']) : '';
            $tax_query = array();
            $meta_query = array();
            $orderby = 'date';
            $order = 'DESC';

            // Tax Query for Tags and Categories
            if (!empty($_GET['property_tag'])) {
                $tax_query[] = array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($_GET['property_tag']),
                );
            }

            if (!empty($_GET['property_category'])) {
                $tax_query[] = array(
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($_GET['property_category']),
                );
            }

            // If both tag and category filters exist, combine them
            if (!empty($tax_query)) {
                $args['tax_query'] = $tax_query;
            }

            // Meta Query for Sorting by Price
            if (!empty($_GET['sort_price'])) {
                if ($_GET['sort_price'] === 'low_to_high') {
                    $orderby = 'meta_value_num';
                    $meta_query[] = array(
                        'key'     => 'property_price',
                        'compare' => 'EXISTS',
                        'type'    => 'NUMERIC',
                    );
                    $order = 'ASC';
                } elseif ($_GET['sort_price'] === 'high_to_low') {
                    $orderby = 'meta_value_num';
                    $meta_query[] = array(
                        'key'     => 'property_price',
                        'compare' => 'EXISTS',
                        'type'    => 'NUMERIC',
                    );
                    $order = 'DESC';
                }
            }


            // Build the WP_Query args
            $args = array(
                'post_type'      => 'properties',
                'posts_per_page' => 10,
                'paged'          => $paged,
                's'              => $search_query, // This integrates the search field into the query
                'tax_query'      => !empty($tax_query) ? $tax_query : array(),
                'meta_query'     => !empty($meta_query) ? $meta_query : array(),
                'orderby'        => $orderby,
                'order'          => $order,
            );

            // Run the query
            $properties_query = new WP_Query(query: $args);

            if ($properties_query->have_posts()) :
                while ($properties_query->have_posts()) :
                    $properties_query->the_post();
                    $property_img = get_the_post_thumbnail($property_id);
                    $property_tags = get_the_tags($property_id);
                    $property_cat = get_the_category($property_id);
            ?>
                    <div class="col-12 col-md-6 col-lg-4 mt-4">
                        <div class="property-list ">
                            <!-- <?php if ($property_tags): ?>
                                <div class="property-tags">
                                    <?php foreach ($property_tags as $tag): ?>
                                        <span class="tag"><?php echo esc_html($tag->name); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?> -->
                            <div class="property-img-wrapper hover-img-efftect">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo $property_img; ?>
                                </a>
                            </div>
                            <span class="property-price">$<?= get_field('property_price', $property_id); ?></span>
                            <a href="<?php the_permalink(); ?>" class="property-title"><?php the_title(); ?></a>
                            <p class="property-address">
                                <i class="fa-solid fa-location-arrow"></i>
                                <?= get_field('address', $property_id); ?>
                            </p>
                            <span class="prop-icon beds">
                                <i class="ri-hotel-bed-line"></i>
                                Beds : <?= get_field('beds', $property_id); ?>
                            </span>
                            <span class="prop-icon baths">
                                <i class="fa-solid fa-bath"></i>
                                Baths : <?= get_field('baths', $property_id); ?>
                            </span>
                            <span class="prop-icon area">
                                <i class="ri-codepen-line"></i>
                                Area : <?= get_field('area', $property_id); ?>
                            </span>
                            <span class="prop-icon category prop-footer">
                                <i class="ri-stack-line"></i>
                                <strong>Category :</strong>
                                <?php
                                foreach ($property_cat as $cat) {
                                ?>
                                    <span class="prop-cat-name"><?php echo $cat->name; ?></span>
                                <?php
                                };
                                ?>
                            </span>

                        </div>
                    </div>
            <?php
                endwhile;

                // Pagination
                echo '<div class="pagination">';
                echo paginate_links(array(
                    'total'   => $properties_query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => '&laquo; Previous',
                    'next_text' => 'Next &raquo;',
                ));
                echo '</div>';
            else :
                echo '<p>No properties found.</p>';
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