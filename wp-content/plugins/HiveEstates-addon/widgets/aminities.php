<?php

use Elementor\Conditions;

class Aminities_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Aminities';
    }

    public function get_title()
    {
        return esc_html__('Aminities', 'hiveestates-addon');
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
                    ],
                    [
                        'slider_title' => esc_html__('Title', 'hiveestates-addon'),
                        'slider_icon' => esc_html__('Icon', 'hiveestates-addon'),

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
        <div class="container aminities-container">
            <div class="aminities-main">
                <?php
                foreach ($sliders as $slider) {
                ?>
                    <div class="aminity">
                        <img class="aminity-icon" src="<?php echo $slider['slider_icon']['url']; ?>" alt="">
                        <h2><?php echo $slider['slider_title']; ?></h2>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

<?php
    }
}
