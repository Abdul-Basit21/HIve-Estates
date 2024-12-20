<?php

use Elementor\Conditions;

class Masonry_Gallery_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Masonry Gallery';
    }

    public function get_title()
    {
        return esc_html__('Masonry Gallery', 'hiveestates-addon');
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
            'gallery_images',
            [
                'label' => esc_html__('Gallery Image', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->add_control(
            'masonry-gallery',
            [
                'label' => esc_html__('Repeater List', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'gallery_images' => esc_html__('Gallery Image', 'hiveestates-addon'),
                    ],
                    [
                        'gallery_images' => esc_html__('Gallery Image', 'hiveestates-addon'),
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
        $gallery_images = $settings['masonry-gallery'];
?>
        <div class="container gallery-masonry-container">
            <div class="row">
                <div class="gallery-masonry-wrapper">
                    <?php
                    foreach ($gallery_images as $gallery_item) {
                    ?>

                        <div class="gallery-masonry-item">
                            <a href="<?php echo $gallery_item['gallery_images']['url'] ?>" data-fancybox="gallery">
                                <img src="<?php echo $gallery_item['gallery_images']['url'] ?>" alt="">
                            </a>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

<?php
    }
}
