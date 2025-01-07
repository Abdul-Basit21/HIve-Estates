<?php get_header(); ?>


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
<div class="container property-detail-container">
    <div class="row">
        <div class="col-9">
            <div class="property-info-top">
                <div class="info-top-left">
                    <div class="tags-wrapper">
                        <?php
                        $property_tags = get_the_tags($property_id);
                        if ($property_tags): ?>
                            <?php foreach ($property_tags as $tag): ?>
                                <span class="prop-tag"> <?php echo esc_html($tag->name); ?></span>
                            <?php endforeach; ?>
                        <?php endif;
                        ?>
                    </div>
                    <h2><?php the_title(); ?></h2>
                    <p>
                        <i class="fa-solid fa-location-arrow"></i>
                        <span class="prop-detail-location"><?= get_field('address', $property_id); ?></span>
                    </p>
                </div>
                <div class="info-top-right">
                    <span class="prop-detail-price">$<?= get_field('property_price', $property_id); ?></span>
                    <span class="prop-detail-area"><?= get_field('area', $property_id); ?></span>
                </div>
            </div>
            <div class="property-detail-gallery">
                <div class="outer">
                    <div id="big" class="owl-carousel owl-theme">
                        <?php
                        $property_gallery = get_field('property_gallery', $property_id);
                        foreach ($property_gallery as $property_gallery) {
                        ?>
                            <a href="<?php echo $property_gallery; ?>" data-fancybox="gallery">
                                <img src="<?php echo $property_gallery; ?>" alt="">
                            </a>
                        <?php
                        };
                        ?>
                    </div>
                    <div id="thumbs" class="owl-carousel owl-theme">
                        <?php
                        $property_gallery = get_field('property_gallery', $property_id);
                        foreach ($property_gallery as $property_gallery) {
                        ?>
                            <img src="<?php echo $property_gallery; ?>" alt="">
                        <?php
                        };
                        ?>
                    </div>
                </div>
            </div>
            <div class="property-detail-content-wrapper">
                <?php echo the_content(); ?>
            </div>
            <div class="property-overview">
                <h2>Property Overview</h2>
                <div class="overview-main">
                    <span class="prop-icon beds">
                        Bedrooms
                        <span>
                            <i class="fa-solid fa-bed"></i>
                            <?= get_field('beds', $property_id); ?>
                        </span>
                    </span>
                    <span class="prop-icon baths">
                        Baths
                        <span>
                            <i class="fa-solid fa-bath"></i>
                            <?= get_field('baths', $property_id); ?>
                        </span>
                    </span>
                    <span class="prop-icon area">
                        Area
                        <span>
                            <i class="fa-solid fa-expand"></i>
                            <?= get_field('area', $property_id); ?>
                        </span>
                    </span>
                    <span class="prop-icon room">
                        Rooms
                        <span>
                            <i class="ri-door-open-fill"></i>
                            <?= get_field('rooms', $property_id); ?>
                        </span>
                    </span>
                    <span class="prop-icon year">
                        Year Built
                        <span>
                            <i class="fa-regular fa-calendar-days"></i>
                            <?= get_field('year_built', $property_id); ?>
                        </span>
                    </span>
                </div>
            </div>
            <div class="properties-amenities-wrapper property-overview">
                <h2 class="amenity"><i class="ri-git-fork-line"></i>Property Amenities</h2>
                <div class="amenity-items">
                    <ul>
                        <?php
                        $property_amenities = get_field('property_amenities', $property_id);
                        foreach ($property_amenities as $amenity) {
                        ?>
                            <li><?php echo $amenity['amenity']; ?></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="property-detail-right">
                <div class="cont-form">
                    <h2>Contact the listing owner</h2>
                    <?php echo do_shortcode('[contact-form-7 id="bbf1795" title="property-detail-form"]'); ?>
                </div>
                <div class="post-details-categories mt-5">
                    <h2 class="post-categories">Related Properties</h2>
                    <?php
                    // Fetch current property ID
                    $current_property_id = get_the_ID();

                    // Get taxonomy terms of the current property
                    $terms = wp_get_post_terms($current_property_id, 'property_category', array('fields' => 'ids'));

                    if (!empty($terms)) {
                        // Query related properties
                        $related_properties_query = new WP_Query(array(
                            'post_type' => 'properties', // Custom post type
                            'posts_per_page' => 3,       // Number of related properties to show
                            'post__not_in' => array($current_property_id), // Exclude current property
                            // 'tax_query' => array(
                            //     array(
                            //         'taxonomy' => 'property_category', // Custom taxonomy
                            //         'field'    => 'term_id',
                            //         'terms'    => $terms,
                            //     ),
                            // ),
                        ));

                        if ($related_properties_query->have_posts()) {
                            while ($related_properties_query->have_posts()) {
                                echo '<div class="related-properties">';
                                $related_properties_query->the_post();
                    ?>
                                <div class="rel-prop-img">
                                    <?php echo get_the_post_thumbnail(); ?>
                                </div>
                                <div class="rel-prop-info">
                                    <span class="property-price">$<?= get_field('property_price', $property_id); ?></span>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <p>
                                        <i class="fa-solid fa-location-arrow"></i>
                                        <span class="prop-detail-location"><?= get_field('address', $property_id); ?></span>
                                    </p>
                                </div>
                    <?php
                            echo '</div>';
                            }
                        }
                        // Restore original post data
                        wp_reset_postdata();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>