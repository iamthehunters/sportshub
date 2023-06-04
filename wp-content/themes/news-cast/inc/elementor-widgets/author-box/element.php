<?php
/**
 * Author Box Element
 * 
 * @package News Cast
 * @since 1.0.0
 * 
 */
class Style_Mag_Author_Box_Element extends \Elementor\Widget_Base {
    /**
     * @return - name of the widget
     */
    public function get_name() {
        return 'author-box';
    }

    /**
     * @return - title of the widget
     */
    public function get_title() {
        return esc_html__( 'Author Box', 'news-cast' );
    }

    /**
     * @return - icon for the widget
     */
    public function get_icon() {
        return 'far fa-user';
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
                'default'   => esc_html__( 'Author Info', 'news-cast' ),
                'placeholder' => esc_html__( 'Enter title', 'news-cast' ),
                'condition' => [
                    'blockTitleOption' => 'show'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'author_content_setting_section',
            [
                'label' => esc_html__( 'Author Content Setting', 'news-cast' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'authorImage',
			[
				'label' => __( 'Upload author image', 'news-cast' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

        $this->add_control(
            'authorName',
            [
                'label'     => esc_html__( 'Author Name', 'news-cast' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__( 'Author Name', 'news-cast' ),
                'placeholder' => esc_html__( 'Add author name here', 'news-cast' )
            ]
        );

        $this->add_control(
            'authorLink',
            [
                'label'     => esc_html__( 'Author URL', 'news-cast' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Add url to the given author here..', 'news-cast' )
            ]
        );

        $this->add_control(
            'authorDesc',
            [
                'label'     => esc_html__( 'Author Description', 'news-cast' ),
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Add author description here..', 'news-cast' )
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
        
        echo '<div id="bmm-author-box-block-'.esc_attr( $element_id ).'" class="bmm-author-box-block block-'.esc_attr( $element_id ).' bmm-block bmm-block-author-box--layout-one">';
            if( !empty( $blockTitle ) ) {
                echo '<h2 class="bmm-block-title"><span>'.esc_html( $blockTitle ).'</span></h2>';
            }
        ?>
            <div class="author-content-wrap">
            <?php
                if( $authorImage['url'] ) {
            ?>
                    <img class="author-image" src="<?php echo esc_url($authorImage['url']); ?>"/>
            <?php
                }
            ?>
                <h2 class="author-name"><a href=<?php echo esc_url( $authorLink ); ?>><?php echo esc_html( $authorName ); ?></a></h2>
                <?php
                    if( $authorDesc ) {
                ?>
                        <div class="author-desc">
                            <?php echo esc_html( $authorDesc ); ?>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div><!-- #bmm-author-box-block -->
        <?php
    }
}