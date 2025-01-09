<?php

use Elementor\Conditions;

class Post_List extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Post List';
    }

    public function get_title()
    {
        return esc_html__('Post List', 'hiveestates-addon');
    }

    public function get_icon()
    {
        return 'eicon-single-post';
    }

    public function get_categories()
    {
        return ['hiveestates-addon-Category'];
    }

    public function get_keywords()
    {
        return ['blog', 'posts', 'list'];
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

        $options = array();
        $posts = get_posts(array(
            'post_type' => 'post', // Change to 'post' for default blog posts
            'posts_per_page' => -1,
        ));
        foreach ($posts as $post) {
            $options[$post->ID] = $post->post_title;
        }

        $this->add_control(
            'select_posts',
            [
                'label' => esc_html__('Select Blog Posts', 'hiveestates-addon'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $options,
                'default' => [],
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
        $selected_posts = $settings['select_posts'];

        if (empty($selected_posts)) {
            return;
        }
?>

        <div class="container blog_post_list">
            <div class="row">
                <?php
                foreach ($selected_posts as $post_id) {
                    $post_thumbnail = get_the_post_thumbnail($post_id, 'medium'); // Get featured image
                    $post_categories = get_the_category($post_id); // Get categories
                    $post_tags = get_the_tags($post_id); // Get tags
                ?>
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="blog-post-item property-list">
                            <div class="post-thumbnail property-img-wrapper hover-img-efftect">
                                <a href="<?php echo get_permalink($post_id); ?>">
                                    <?php echo $post_thumbnail; ?>
                                </a>
                            </div>
                            <div class="post-content">
                                <h3 class="post-title">
                                    <a class="property-title" href="<?php echo get_permalink($post_id); ?>">
                                        <?php echo get_the_title($post_id); ?>
                                    </a>
                                </h3>
                                <p class="post-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt($post_id), 20); ?>
                                </p>
                                <div class="post-meta">
                                    <span class="post-date">
                                        <i class="ri-calendar-todo-line"></i>
                                        <?php echo get_the_date('', $post_id); ?>
                                    </span>
                                    <!-- <span class="post-categories">
                                        <i class="fa fa-folder"></i>
                                        <?php foreach ($post_categories as $category) : ?>
                                            <a href="<?php echo get_category_link($category->term_id); ?>">
                                                <?php echo $category->name; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </span> -->
                                </div>
                                <?php if ($post_tags) : ?>
                                    <div class="post-tags">
                                        <i class="fa fa-tags"></i>
                                        <?php foreach ($post_tags as $tag) : ?>
                                            <a href="<?php echo get_tag_link($tag->term_id); ?>">
                                                <?php echo $tag->name; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
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
