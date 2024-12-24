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
                    <span class="prop-tag">
                        <?php
                        $property_tags = get_the_tags($property_id);
                        if ($property_tags): ?>
                            <?php foreach ($property_tags as $tag): ?>
                                <?php echo esc_html($tag->name); ?>
                            <?php endforeach; ?>
                        <?php endif;
                        ?>
                    </span>
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
        </div>
        <div class="col-3"></div>
    </div>
</div>

<?php get_footer(); ?>