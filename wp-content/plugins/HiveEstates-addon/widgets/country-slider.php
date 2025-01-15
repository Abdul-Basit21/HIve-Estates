<?php

use Elementor\Conditions;

class Country_Slider_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Country Slider';
    }

    public function get_title()
    {
        return esc_html__('Country Slider', 'hiveestates-addon');
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'country_title',
            [
                'label' => esc_html__('Slider Title', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Slider Title', 'hiveestates-addon'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'country_BG_Image',
            [
                'label' => esc_html__('Background Image', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->add_control(
            'country_slider',
            [
                'label' => esc_html__('Repeater List', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'country_title' => esc_html__('Title', 'hiveestates-addon'),
                        'country_BG_Image' => esc_html__('Background Image', 'hiveestates-addon'),
                    ],
                    [
                        'country_title' => esc_html__('Title', 'hiveestates-addon'),
                        'country_BG_Image' => esc_html__('Background Image', 'hiveestates-addon'),
                    ],
                ],
                'title_field' => '{{{ country_title }}}',
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
        $country_slider = $settings['country_slider'];
?>
        <div class="container"> 
            <div class="owl-carousel country-slider owl-theme">
                <?php
                foreach ($country_slider as $slider) {
                ?>
                    <div class="item">
                        <img class="slider-image" src="<?php echo $slider['country_BG_Image']['url']; ?>" alt="">
                        <h2><?php echo $slider['country_title']; ?></h2>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

<?php
    }
}
