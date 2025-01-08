<?php

use Elementor\Conditions;

class Property_List_Sale extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Property Sale List';
    }

    public function get_title()
    {
        return esc_html__('Property Sale List', 'hiveestates-addon');
    }

    public function get_icon()
    {
        return 'eicon-slider-album';
    }

    public function get_categories()
    {
        return ['hiveestates-addon-Category'];
    }

    public function get_keywords()
    {
        return ['test', 'heading'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'hiveestates-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Fetch available tags
        $tags = get_tags();
        $tag_options = [];
        foreach ($tags as $tag) {
            $tag_options[$tag->term_id] = $tag->name;
        }

        // Add tag selection control
        $this->add_control(
            'select_tags',
            [
                'label' => esc_html__('Select Tags', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => false,
                'options' => $tag_options,
            ]
        );

        $this->end_controls_section();

        $this->style_tab();
    }

    private function style_tab()
    {
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__('Style', 'hiveestates-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $selected_tags = $settings['select_tags'];

        if (!empty($selected_tags)) {
            // Query posts by selected tags
            $query_args = [
                'post_type' => 'properties',
                'posts_per_page' => -1,
                'tax_query' => [
                    [
                        'taxonomy' => 'post_tag', // or replace with the appropriate taxonomy
                        'field' => 'term_id',
                        'terms' => $selected_tags,
                    ],
                ],
            ];
            $query = new WP_Query($query_args);

            if ($query->have_posts()) {
                echo '<div class="container">';
                echo '<div class="row property_sale_carousel owl-carousel owl-theme">';
                while ($query->have_posts()) {
                    $query->the_post();
                    $property_id = get_the_ID();
                    $property_img = get_the_post_thumbnail($property_id);
                    $property_tags = get_the_tags($property_id);
                    $property_cat = get_the_category($property_id);
?>
                    <div class="item">
                        <div class="property-list"> 
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
                }
                echo '</div></div>';
                wp_reset_postdata();
            }
        }
    }
}
