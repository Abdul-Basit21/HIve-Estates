<?php

use Elementor\Conditions;

class Our_Team_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Our Team';
    }

    public function get_title()
    {
        return esc_html__('Our Team', 'hiveestates-addon');
    }

    public function get_icon()
    {
        return 'eicon-person';
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
            'image',
            [
                'label' => esc_html__('Image', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Name', 'hiveestates-addon'),
                'placeholder' => esc_html__('Name', 'hiveestates-addon'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'designation',
            [
                'label' => esc_html__('Disgnation', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Designation', 'hiveestates-addon'),
                'placeholder' => esc_html__('Designation', 'hiveestates-addon'),
                'label_block' => true,
            ]
        );

        
        $repeater->add_control(
			'facebook_link',
			[
				'label' => esc_html__( 'Facebook Link', 'hiveestates-addon' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'instagram_link',
			[
				'label' => esc_html__( 'Instagram Link', 'hiveestates-addon' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
        $repeater   ->add_control(
			'twitter_link',
			[
				'label' => esc_html__( 'Twitter Link', 'hiveestates-addon' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
        $repeater->add_control(
            'phone_number',
            [
                'label' => esc_html__('Number', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Number', 'hiveestates-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'team_members',
            [
                'label' => esc_html__('Repeater List', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'image' => esc_html__('Image', 'hiveestates-addon'),
                        'name' => esc_html__('Name', 'hiveestates-addon'),
                        'designation' => esc_html__('Designation', 'hiveestates-addon'),
                        'facebook_link' => esc_html__('Facebook Link', 'hiveestates-addon'),
                        'instagram_link' => esc_html__('Instagram Link', 'hiveestates-addon'),
                        'twitter_link' => esc_html__('Twitter Link', 'hiveestates-addon'),
                        'phone_number' => esc_html__('Number', 'hiveestates-addon'),
                    ],
                    [
                        'image' => esc_html__('Image', 'hiveestates-addon'),
                        'name' => esc_html__('Name', 'hiveestates-addon'),
                        'designation' => esc_html__('Designation', 'hiveestates-addon'),
                        'facebook_link' => esc_html__('Facebook Link', 'hiveestates-addon'),
                        'instagram_link' => esc_html__('Instagram Link', 'hiveestates-addon'),
                        'twitter_link' => esc_html__('Twitter Link', 'hiveestates-addon'),
                        'phone_number' => esc_html__('Number', 'hiveestates-addon'),
                    ],
                ],
                'title_field' => '{{{ name }}}',
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
        $team_member = $settings['team_members'];
?>
        <div class="container team-container">
            <div class="row">
                <?php
                foreach ($team_member as $member) {
                ?>
                    <div class="col-12 col-md-3">
                        <div class="team-item ">
                            <div class="team-img-wrapper">
                                <img src="<?php echo $member['image']['url'] ?>" alt="">
                            </div>
                            <h2 class="member-name"><?php echo $member['name']; ?></h2>
                            <div class="member-designation"><?php echo $member['designation']; ?></div>
                            <div class="member-social-wrapper">
                                <a href="<?php echo  $member['facebook_link']['url']; ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="<?php echo  $member['instagram_link']['url']; ?>"><i class="fa-brands fa-instagram"></i></a>
                                <a href="<?php echo  $member['twitter_link']['url']; ?>"><i class="fa-brands fa-twitter"></i></a>
                                <a href="tel:<?php echo  $member['phone_number']; ?>"><i class="fa-solid fa-phone"></i></a>
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
