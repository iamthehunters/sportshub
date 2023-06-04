<?php
/**
 * Author Box Element
 * 
 * @package News Cast
 * @since 1.0.0
 * 
 */
class Style_Mag_Social_Icons_Element extends \Elementor\Widget_Base {
    /**
     * @return - name of the widget
     */
    public function get_name() {
        return 'social-icons';
    }

    /**
     * @return - title of the widget
     */
    public function get_title() {
        return esc_html__( 'Social Icons', 'news-cast' );
    }

    /**
     * @return - icon for the widget
     */
    public function get_icon() {
        return 'far fa-thumbs-up';
    }

    /**
     * @return - category name for the widget
     */
    public function get_categories() {
        return [ 'news-cast-elements' ];
    }

    /**
     * add controls for widget.
     */
    protected function _register_controls() {

        //General Settings
        $this->start_controls_section(
            'general_setting_section',
            [
                'label' => esc_html__( 'General Setting', 'news-cast' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'blockTitleOption',
            [
                'label' => esc_html__( 'Show block title', 'news-cast' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'news-cast' ),
                'label_off' => esc_html__( 'Hide', 'news-cast' ),
                'show' => esc_html__( 'Show', 'news-cast' ),
                'hide' => esc_html__( 'Hide', 'news-cast' ),
                'return_value' => 'show',
                'default' => 'show',
            ]
        );

        $this->add_control(
            'blockTitle',
            [
                'label'     => esc_html__( 'Block Title', 'news-cast' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__( 'Follow Us', 'news-cast' ),
                'placeholder' => esc_html__( 'Enter title', 'news-cast' ),
                'condition' => [
                    'blockTitleOption' => 'show'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'social_icon_setting_section',
            [
                'label' => esc_html__( 'Social Icons Setting', 'news-cast' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon_label',
            [
                'label'     => esc_html__( 'Icon Label', 'news-cast' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__( 'Facebook', 'news-cast' ),
                'placeholder' => esc_html__( 'Add icon label here', 'news-cast' )
            ]
        );

        $repeater->add_control(
            'icon_link',
            [
                'label'     => esc_html__( 'Icon URL', 'news-cast' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Add url to the given icons here..', 'news-cast' )
            ]
        );

        $repeater->add_control(
			'icon_class',
			[
				'label' => __( 'Icon', 'news-cast' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-facebook-f',
					'library' => 'brands',
				],
			]
		);

        $repeater->add_control(
			'icon_color',
			[
				'label'     => __( 'Color', 'news-cast' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#3b5998',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} a, {{WRAPPER}} {{CURRENT_ITEM}} div, {{WRAPPER}} {{CURRENT_ITEM}} span, {{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
				],
			]
		);

        $this->add_control(
			'iconsData',
			[
				'label' => __( 'Social Icons', 'news-cast' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'icon_label'    => __( 'Facebook', 'news-cast' ),
						'icon_link'     => '#',
                        'icon_class'    => 'fas fa-facebook',
                        'icon_color'    => '#3b5998'
					]
				],
				'title_field' => '{{{ icon_label }}}',
			]
		);
        $this->end_controls_section();
    }
    
    /**
     * renders the widget content.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        extract( $settings );
        $element_id = $this->get_id();
        $blockTitleOption   = ( $blockTitleOption === 'show' );
        
        echo '<div id="bmm-social-icons-block-'.esc_attr( $element_id ).'" class="bmm-social-icons-block block-'.esc_attr( $element_id ).' bmm-block bmm-block-social-icons--layout-one">';
            if( !empty( $blockTitle ) ) {
                echo '<h2 class="bmm-block-title"><span>'.esc_html( $blockTitle ).'</span></h2>';
            }
        ?>
            <div class="social-icons-wrap">
                <?php
                    if( $iconsData ) :
                        foreach( $iconsData as $icon ) {
                        ?>
                            <div class="single-icon elementor-repeater-item-<?php echo esc_attr( $icon['_id'] ); ?>">
                                <h2 class="icon-label"><a href="<?php echo esc_html( $icon['icon_link'] ); ?>"><?php echo esc_html( $icon['icon_label'] ); ?></a></h2>
                                <span class="icon-element"><a href="<?php echo esc_html( $icon['icon_link'] ); ?>"><i class="<?php echo esc_html( $icon['icon_class']['value'] ); ?>"></i></a></span>
                            </div>
                        <?php
                        }
                    endif;
                ?>
            </div>
        </div><!-- #bmm-social-icons-block -->
        <?php
    }
}