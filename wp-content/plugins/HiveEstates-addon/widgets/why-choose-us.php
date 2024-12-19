<?php

use Elementor\Conditions;

class Why_Choose_Us_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Why Choose';
    }

    public function get_title()
    {
        return esc_html__('Why Choose', 'hiveestates-addon');
    }

    public function get_icon()
    {
        return 'eicon-info-box';
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
            'choose_title',
            [
                'label' => esc_html__('Choose Title', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Slider Title', 'hiveestates-addon'),
                'placeholder' => esc_html__('Choose Title', 'hiveestates-addon'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'choose_image',
            [
                'label' => esc_html__('Choose Image', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'choose_description',
            [
                'label' => esc_html__('Choose Description', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Default description', 'hiveestates-addon'),
                'placeholder' => esc_html__('Type your description here', 'hiveestates-addon'),
            ]
        );

        $this->add_control(
            'choose_section',
            [
                'label' => esc_html__('Repeater List', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'country_Image' => esc_html__('Choose Image', 'hiveestates-addon'),
                        'choose_title' => esc_html__('Title', 'hiveestates-addon'),
                        'choose_description' => esc_html__('Description', 'hiveestates-addon'),
                    ],
                    [
                        'country_Image' => esc_html__('Choose Image', 'hiveestates-addon'),
                        'choose_title' => esc_html__('Title', 'hiveestates-addon'),
                        'choose_description' => esc_html__('Description', 'hiveestates-addon'),
                    ],
                ],
                'title_field' => '{{{ choose_title }}}',
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
        $choose_sec = $settings['choose_section'];
?>
        <div class="container choose-container">
            <div class="row">
                <?php
                foreach ($choose_sec as $choose) {
                ?>
                    <div class="col-12 col-md-4">
                        <div class="choose-item property-list">
                            <div class="property-img-wrapper">
                                <img src="<?php echo $choose['choose_image']['url'] ?>" alt="">
                            </div>
                            <h2 class="choose-title property-title"><?php echo $choose['choose_title']; ?></h2>
                            <div class="choose-para post-excerpt"><?php echo $choose['choose_description']; ?></div>
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
