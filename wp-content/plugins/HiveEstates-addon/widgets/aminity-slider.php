<?php

use Elementor\Conditions;

class Aminity_Slider_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Aminity Slider';
    }

    public function get_title()
    {
        return esc_html__('Aminity Slider', 'hiveestates-addon');
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
            'slider_title',
            [
                'label' => esc_html__('Slider Title', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Slider Title', 'hiveestates-addon'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'slider_icon',
            [
                'label' => esc_html__('Icon', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'slider_BG_Image',
            [
                'label' => esc_html__('Background Image', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->add_control(
            'sliders',
            [
                'label' => esc_html__('Repeater List', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slider_title' => esc_html__('Title', 'hiveestates-addon'),
                        'slider_icon' => esc_html__('Icon', 'hiveestates-addon'),
                        'slider_BG_Image' => esc_html__('Background Image', 'hiveestates-addon'),
                    ],
                    [
                        'slider_title' => esc_html__('Title', 'hiveestates-addon'),
                        'slider_icon' => esc_html__('Icon', 'hiveestates-addon'),
                        'slider_BG_Image' => esc_html__('Background Image', 'hiveestates-addon'),

                    ],
                ],
                'title_field' => '{{{ slider_title }}}',
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
        $sliders = $settings['sliders'];
?>
        <div class="container">
            <div class="owl-carousel aminity-slider owl-theme">
                <?php
                foreach ($sliders as $slider) {
                ?>
                    <div class="item" style="background-image: url(<?php echo $slider['slider_BG_Image']['url']; ?>);">
                        <img class="aminity-icon" src="<?php echo $slider['slider_icon']['url']; ?>" alt="">
                        <h2>Swipe</h2>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

<?php
    }
}
