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

        $options = array();
        $posts = get_posts(array(
            'post_type' => 'properties',
        ));
        foreach ($posts as $post) {
            $options[$post->ID] = $post->post_title;
        };


        $this->add_control(
            'select_properties',
            [
                'label' => esc_html__('Select Properties', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $options,
                'default' => ['title', 'description'],
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
        $select_properties = $settings['select_properties'];
?>



        <div class="container property_sale_carousel">
            <div class="row">
                <?php
                foreach ($select_properties as $properties) {
                    $property_img = get_the_post_thumbnail($properties);
                    $property_cat = get_the_category($properties);
                    $property_tag = get_the_tags($properties);
                ?>
                    <div class="col-4 porperty-list">
                        <?php
                        foreach ($property_tag as $tag) {
                        ?>
                            <!-- <span class="prop-icon tag">
                                <i class="ri-home-office-line"></i>
                                <?php echo $tag->name; ?>
                            </span> -->
                        <?php
                        };
                        ?>
                        <div class="property-img-wrapper">
                            <a href="<?php echo the_permalink($properties); ?>">
                                <?php echo $property_img; ?>
                            </a>
                        </div>
                        <span class="property-price">$<?= get_field('property_price', $properties); ?></span>
                        <a href="<?php echo the_permalink($properties); ?>" class="property-title"><?php echo get_the_title($properties); ?></a>
                        <p class="property-address">
                            <i class="fa-solid fa-location-arrow"></i>
                            <?= get_field('address', $properties); ?>
                        </p>
                        <span class="prop-icon beds">
                            <i class="ri-hotel-bed-line"></i>
                            Beds : <?= get_field('beds', $properties); ?>
                        </span>
                        <span class="prop-icon baths">
                            <i class="fa-solid fa-bath"></i>
                            Baths : <?= get_field('baths', $properties); ?>
                        </span>
                        <span class="prop-icon area">
                            <i class="ri-codepen-line"></i>
                            Area : <?= get_field('area', $properties); ?>
                        </span>
                        <?php
                        foreach ($property_cat as $cat) {
                        ?>
                            <span class="prop-icon category prop-footer">
                                <i class="ri-stack-line"></i>
                                <strong>Category :</strong><?php echo $cat->name; ?>
                            </span>
                        <?php
                        };
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
<?php
    }
}
