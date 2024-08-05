<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Read_More_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'read-more';
    }

    public function get_title() {
        return __( 'Read More', 'elementor-read-more-plugin' );
    }

    public function get_icon() {
        return 'eicon-post';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'elementor-read-more-plugin' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'elementor-read-more-plugin' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Default description', 'elementor-read-more-plugin' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => __( 'Character Limit', 'elementor-read-more-plugin' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 100,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'elementor-read-more-plugin' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Číst více', 'elementor-read-more-plugin' ),
            ]
        );

        $this->add_control(
            'button_text_hide',
            [
                'label' => __( 'Button Text (Hide)', 'elementor-read-more-plugin' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Skrýt', 'elementor-read-more-plugin' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'elementor-read-more-plugin' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'elementor-read-more-plugin' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more-content, {{WRAPPER}} p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Button Text Color', 'elementor-read-more-plugin' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Button Background Color', 'elementor-read-more-plugin' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Button Hover Text Color', 'elementor-read-more-plugin' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => __( 'Button Hover Background Color', 'elementor-read-more-plugin' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __( 'Button Border', 'elementor-read-more-plugin' ),
                'selector' => '{{WRAPPER}} .read-more-button',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Button Border Radius', 'elementor-read-more-plugin' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .read-more-button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => __( 'Text Typography', 'elementor-read-more-plugin' ),
                'selector' => '{{WRAPPER}} .read-more-content, {{WRAPPER}} p',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Button Typography', 'elementor-read-more-plugin' ),
                'selector' => '{{WRAPPER}} .read-more-button',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        global $post;
        $description = !empty($post->post_content) ? wp_strip_all_tags($post->post_content) : $settings['description'];
        $limit = $settings['limit'];
        $button_text = $settings['button_text'];
        $button_text_hide = $settings['button_text_hide'];

        $custom_css = "
        <style>
            .read-more-button {
                background-color: {$settings['button_background_color']};
                color: {$settings['button_color']};
            }
            .read-more-button:hover {
                background-color: {$settings['button_hover_background_color']};
                color: {$settings['button_hover_color']};
            }
        </style>";

        echo $custom_css;

        if (strlen($description) > $limit) {
            $short_description = mb_substr($description, 0, $limit, 'UTF-8');
            $remaining_text = mb_substr($description, $limit, null, 'UTF-8');
            echo '<div class="read-more-wrapper"><p>' . $short_description . '<span class="read-more-ellipsis">...</span><span class="read-more-content" style="display:none;">' . $remaining_text . '</span></p>';
            echo '<button class="read-more-button" data-show-text="' . esc_attr($button_text) . '" data-hide-text="' . esc_attr($button_text_hide) . '">' . $button_text . '</button></div>';
        } else {
            echo '<p>' . $description . '</p>';
        }
    }

    protected function _content_template() {
        ?>
        <#
        var description = settings.description;
        var limit = settings.limit;
        var button_text = settings.button_text;
        var button_text_hide = settings.button_text_hide;

        if ( description.length > limit ) {
            var short_description = description.substring(0, limit);
            var remaining_text = description.substring(limit);
            #>
            <div class="read-more-wrapper"><p>{{{ short_description }}}<span class="read-more-ellipsis">...</span><span class="read-more-content" style="display:none;">{{{ remaining_text }}}</span></p>
            <button class="read-more-button" data-show-text="{{ button_text }}" data-hide-text="{{ button_text_hide }}">{{{ button_text }}}</button></div>
            <#
        } else {
            #>
            <p>{{{ description }}}</p>
            <#
        }
        #>
        <?php
    }
}
