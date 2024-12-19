<?php

use Elementor\Conditions;

class Testimonials_List_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Testimonials List';
    }

    public function get_title()
    {
        return esc_html__('Testimonials List', 'hiveestates-addon');
    }

    public function get_icon()
    {
        return 'eicon-testimonial';
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
            'client_image',
            [
                'label' => esc_html__('Client Image', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'client_name',
            [
                'label' => esc_html__('Client Name', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Client Name', 'hiveestates-addon'),
                'placeholder' => esc_html__('Client Name', 'hiveestates-addon'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'review_text',
            [
                'label' => esc_html__('Review Text', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'placeholder' => esc_html__('Type your description here', 'hiveestates-addon'),
            ]
        );

        $repeater->add_control(
            'review_stars',
            [
                'label' => esc_html__('Review Stars', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '5',
                'options' => [
                    '1' => esc_html__('1', 'hiveestates-addon'),
                    '2'  => esc_html__('2', 'hiveestates-addon'),
                    '3' => esc_html__('3', 'hiveestates-addon'),
                    '4' => esc_html__('4', 'hiveestates-addon'),
                    '5' => esc_html__('5', 'hiveestates-addon'),
                ]
            ]
        );

        $this->add_control(
            'client_testimonials',
            [
                'label' => esc_html__('Repeater List', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'client_image' => esc_html__('Image', 'hiveestates-addon'),
                        'client_name' => esc_html__('Name', 'hiveestates-addon'),
                        'review_text' => esc_html__('Review Text', 'hiveestates-addon'),
                        'review_stars' => esc_html__('Review Stars', 'hiveestates-addon'),
                    ],
                    [
                        'client_image' => esc_html__('Image', 'hiveestates-addon'),
                        'client_name' => esc_html__('Name', 'hiveestates-addon'),
                        'review_text' => esc_html__('Review Text', 'hiveestates-addon'),
                        'review_stars' => esc_html__('Review Stars', 'hiveestates-addon'),
                    ],
                ],
                'title_field' => '{{{ client_name }}}',
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
        $client_testimonials = $settings['client_testimonials'];
?>
        <div class="container tesmonial-container">
            <div class="row">
                <?php
                foreach ($client_testimonials as $testimonials) {
                ?>
                    <div class="col-12 col-md-4">
                        <div class="tesmonial-item ">
                            <i class="ri-double-quotes-r testimonials-quote"></i>
                            <div class="tesmonial-img-wrapper">
                                <img src="<?php echo $testimonials['client_image']['url']; ?>" alt="">
                            </div>
                            <div class="client-review"><?php echo $testimonials['review_text']; ?></div>
                            <h2 class="client-name"><?php echo $testimonials['client_name']; ?></h2>
                            <div class="review-stars">
                                <?php
                                $limit = (int)$testimonials['review_stars'] ?? 5;
                                for ($i = 0; $i < $limit; $i++) {
                                ?>
                                    <i class="fa-solid fa-star"></i>
                                <?php
                                }
                                ?>
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
