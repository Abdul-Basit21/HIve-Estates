<?php

use Elementor\Conditions;

class Hive_Facilities_List_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Hive Facilities List';
    }

    public function get_title()
    {
        return esc_html__('Hive Facilities List', 'hiveestates-addon');
    }

    public function get_icon()
    {
        return 'eicon-bullet-list';
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
            'facility_title',
            [
                'label' => esc_html__('Facility Title', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Facility Title', 'hiveestates-addon'),
                'placeholder' => esc_html__('Facility Title', 'hiveestates-addon'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'facility_description',
            [
                'label' => esc_html__('Facility Description', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'placeholder' => esc_html__('Type your description here', 'hiveestates-addon'),
            ]
        );

        $this->add_control(
            'facilities_list_section',
            [
                'label' => esc_html__('Repeater List', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'facility_title' => esc_html__('Facility Title', 'hiveestates-addon'),
                        'facility_description' => esc_html__('Description', 'hiveestates-addon'),
                    ],
                    [
                        'facility_title' => esc_html__('Facility Title', 'hiveestates-addon'),
                        'facility_description' => esc_html__('Description', 'hiveestates-addon'),
                    ],
                ],
                'title_field' => '{{{ facility_title }}}',
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
        $facilities_list_section = $settings['facilities_list_section'];
?>
        <div class="facilities-container">
            <?php
            foreach ($facilities_list_section as $facility) {
            ?>
                <div class="facility-list-item">
                    <h2 class="f-list-heading">
                        <?php echo $facility['facility_title']; ?>
                    </h2>
                    <p class="f-list-para">
                        <?php echo $facility['facility_description']; ?>
                    </p>
                </div>
            <?php
            }
            ?>
        </div>


<?php
    }
}
