<?php

use Elementor\Conditions;

class Hive_Gallery_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Hive Gallery';
    }

    public function get_title()
    {
        return esc_html__('Hive Gallery', 'hiveestates-addon');
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
            'hive_gallery_images',
            [
                'label' => esc_html__('Gallery Image', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->add_control(
            'hive-gallery',
            [
                'label' => esc_html__('Repeater List', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'hive_gallery_images' => esc_html__('Gallery Image', 'hiveestates-addon'),
                    ],
                    [
                        'hive_gallery_images' => esc_html__('Gallery Image', 'hiveestates-addon'),
                    ],
                ],
                'title_field' => 'Gallery Image',
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
        $hive_gallery = $settings['hive-gallery'];
?>
        <div class="container hive-gallery-container">
            <div class="row">
                <?php
                foreach ($hive_gallery as $hive_gallery_item) {
                ?>
                    <div class="col-12 col-md-3 col-lg-4 mb-3">
                        <div class="hive-gallery-item">
                            <img src="<?php echo $hive_gallery_item['hive_gallery_images']['url'] ?>" alt="">
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
