<?php

use Elementor\Conditions;

class Country_Packery_List_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Country Packery List';
    }

    public function get_title()
    {
        return esc_html__('Country Packery List', 'hiveestates-addon');
    }

    public function get_icon()
    {
        return 'eicon-posts-masonry';
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
            'country_name',
            [
                'label' => esc_html__('Country Name', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Slider Title', 'hiveestates-addon'),
                'placeholder' => esc_html__('Country Name', 'hiveestates-addon'),
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
            'countries_packery',
            [
                'label' => esc_html__('Repeater List', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'country_name' => esc_html__('Country', 'hiveestates-addon'),
                        'country_Image' => esc_html__('Background Image', 'hiveestates-addon'),
                    ],
                    [
                        'country_name' => esc_html__('Country', 'hiveestates-addon'),
                        'country_Image' => esc_html__('Background Image', 'hiveestates-addon'),
                    ],
                ],
                'title_field' => '{{{ country_name }}}',
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
        $countries = $settings['countries_packery'];
?>
        <div class="container country-list-container">
            <div class="row pakery-gallery-wrapper">
                <?php
                foreach ($countries as $key => $country) {
                ?>
                    <div class="col-12 col-md-4 pakery-gallery-item">
                        <div class="country-item pakery-item">
                            <img src="<?php echo $country['country_BG_Image']['url'] ?>" alt="">
                            <h2 class="country-name"><?php echo $country['country_name']; ?></h2>
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
