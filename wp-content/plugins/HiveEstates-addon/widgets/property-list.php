<?php

use Elementor\Conditions;

class Property_List extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Property List';
    }

    public function get_title()
    {
        return esc_html__('Property List', 'hiveestates-addon');
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return ['hiveestates-addon-Category'];
    }

    public function get_keywords()
    {
        return ['properties', 'real estate', 'sale'];
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

        // Fetch available properties
        $options = [];
        $properties = get_posts([
            'post_type' => 'properties',
            'posts_per_page' => -1,
        ]);

        foreach ($properties as $property) {
            $options[$property->ID] = $property->post_title;
        }

        // Add Select2 control for properties
        $this->add_control(
            'select_properties',
            [
                'label' => esc_html__('Select Properties', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true, // Allow multiple property selection
                'options' => $options,
                'default' => [],
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
        $selected_properties = $settings['select_properties'];

        if (empty($selected_properties)) {
            echo '<p>' . esc_html__('No properties selected.', 'hiveestates-addon') . '</p>';
            return;
        }
?>

        <div class="container property_list_grid">
            <div class="row">
                <?php
                foreach ($selected_properties as $property_id) {
                    $property_img = get_the_post_thumbnail($property_id, 'medium');
                    $property_price = get_field('property_price', $property_id);
                    $property_address = get_field('address', $property_id);
                    $property_beds = get_field('beds', $property_id);
                    $property_baths = get_field('baths', $property_id);
                    $property_area = get_field('area', $property_id);
                    $property_cat = get_the_category($property_id)
                ?>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="property-list-item property-list">
                            <div class="property-img-wrapper hover-img-efftect">
                                <a href="<?php echo get_permalink($property_id); ?>">
                                    <?php echo $property_img; ?>
                                </a>
                            </div>
                            <div class="property-list-right">
                                <a href="<?php echo get_permalink($property_id); ?>" class="property-title">
                                    <?php echo get_the_title($property_id); ?>
                                </a>
                                <span class="property-price">
                                    $<?php echo esc_html($property_price); ?>
                                </span>
                                <p class="property-address">
                                    <i class="fa-solid fa-location-arrow"></i>
                                    <?php echo esc_html($property_address); ?>
                                </p>
                                <div class="property-meta">
                                    <span class="prop-icon beds">
                                        <i class="ri-hotel-bed-line"></i>
                                        Beds: <?php echo esc_html($property_beds); ?>
                                    </span>
                                    <span class="prop-icon baths">
                                        <i class="fa-solid fa-bath"></i>
                                        Baths: <?php echo esc_html($property_baths); ?>
                                    </span>
                                    <span class="prop-icon area">
                                        <i class="ri-codepen-line"></i>
                                        Area: <?php echo esc_html($property_area); ?>
                                    </span>
                                </div>
                                <?php if ($property_cat) : ?>
                                    <div class="property-category">
                                        <strong>Category: </strong>
                                        <?php foreach ($property_cat as $cat) : ?>
                                            <span class="prop-cat-name"><?php echo esc_html($cat->name); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
<?php
    }
}
