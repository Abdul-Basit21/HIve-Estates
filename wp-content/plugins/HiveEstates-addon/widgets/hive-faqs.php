<?php

use Elementor\Conditions;

class Hive_Faqs_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Hive Faqs';
    }

    public function get_title()
    {
        return esc_html__('Hive Faqs', 'hiveestates-addon');
    }

    public function get_icon()
    {
        return 'eicon-accordion';
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
            'faq_title',
            [
                'label' => esc_html__('Faq Title', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Faq Title', 'hiveestates-addon'),
                'placeholder' => esc_html__('Faq Title', 'hiveestates-addon'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'faq_description',
            [
                'label' => esc_html__('Faq Description', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Default description', 'hiveestates-addon'),
                'placeholder' => esc_html__('Type your description here', 'hiveestates-addon'),
            ]
        );

        $this->add_control(
            'faqs_section',
            [
                'label' => esc_html__('Repeater List', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'faq_title' => esc_html__('Title', 'hiveestates-addon'),
                        'faq_description' => esc_html__('Description', 'hiveestates-addon'),
                    ],
                    [
                        'faq_title' => esc_html__('Title', 'hiveestates-addon'),
                        'faq_description' => esc_html__('Description', 'hiveestates-addon'),
                    ],
                ],
                'title_field' => '{{{ faq_title }}}',
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
        $faqs_section = $settings['faqs_section'];
?>
        <div class="container faqs-container">
            <div class="row">
                <?php
                foreach ($faqs_section as $key => $faqs) {
                ?>
                    <div class="col-12 col-md-10 p-0 mt-3">
                        <div class="accordion hive-accordion" id="accordionExample-<?= $key ?>">
                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header faq-title">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?= $key ?>" aria-expanded="false" aria-controls="collapseOne-<?= $key ?>">
                                        <?php echo $faqs['faq_title']; ?>
                                    </button>
                                </h2>
                                <div id="collapseOne-<?= $key ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample-<?= $key ?>">
                                    <div class="accordion-body faq-para">
                                        <?php echo $faqs['faq_description']; ?>
                                    </div>
                                </div>
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
