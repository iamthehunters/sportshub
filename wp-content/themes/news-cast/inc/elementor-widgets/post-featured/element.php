<?php
/**
 * Post Featured Element
 * 
 * @package News Cast
 * @since 1.0.0
 * 
 */
class Style_Mag_Post_Featured_Element extends \Elementor\Widget_Base {

    /**
     * @return - name of the widget
     */
    public function get_name() {
        return 'post-featured';
    }

    /**
     * @return - title of the widget
     */
    public function get_title() {
        return esc_html__( 'Post Featured', 'news-cast' );
    }

    /**
     * @return - icon for the widget
     */
    public function get_icon() {
        return 'fas fa-grip-vertical';
    }

    /**
     * @return - category name for the widget
     */
    public function get_categories() {
        return [ 'news-cast-elements' ];
    }

    /**
     * Get List of categories
     */
    public function news_cast_get_categories( $posttype ) {
        $categories_lists = [];
        $taxonomies = get_taxonomies( array( 'object_type' => array( $posttype ) ) );
        if( !empty( $taxonomies ) ) {
            foreach( $taxonomies as $taxonomy ) {
                $taxonomy_name = $taxonomy;
                break;
            }
            $categories = get_terms( $taxonomy_name );
            if( !empty( $categories ) ) {
                foreach( $categories as $category ) {
                    $categories_lists[ $category->slug ] = esc_html( $category->name ). ' ('.absint( $category->count ). ')';
                }
            }
        }
        return $categories_lists;
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
                'label' => esc_html__( 'Block Title', 'news-cast' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__( 'News Cast Post Featured Title', 'news-cast' ),
                'placeholder' => esc_html__( 'Enter title', 'news-cast' ),
                'condition' => [
                    'blockTitleOption' => 'show'
                ]
            ]
        );
        
        $this->add_control(
            'postCategory',
            [
                'label' => esc_html__( 'Post Categories', 'news-cast' ),
                'type' => 'MULTICHECKBOX',
                'options' => $this->news_cast_get_categories( 'post' ),
            ]
        );
        
        $this->add_control(
            'buttonOption',
            [
                'label' => esc_html__( 'Show read more button', 'news-cast' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'news-cast' ),
                'label_off' => esc_html__( 'Hide', 'news-cast' ),
                'show' => esc_html__( 'Show', 'news-cast' ),
                'hide' => esc_html__( 'Hide', 'news-cast' ),
                'return_value' => 'show',
                'default' => 'hide',
            ]
        );

        $this->add_control(
            'buttonLabel',
            [
                'label' => esc_html__( 'Button Label', 'news-cast' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Add label here...', 'news-cast' ),
                'default'   => esc_html__( 'Read more', 'news-cast' ),
                'condition' => [
                    'buttonOption' => 'show'
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'query_setting_section',
            [
                'label' => esc_html__( 'Query Setting', 'news-cast' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Order', 'news-cast' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'   => esc_html__( 'Ascending', 'news-cast' ),
                    'desc'   => esc_html__( 'Descending', 'news-cast' )
                ]
            ]
        );

        $this->add_control(
            'dateOption',
            [
                'label' => esc_html__( 'Show date', 'news-cast' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'news-cast' ),
                'label_off' => esc_html__( 'Hide', 'news-cast' ),
                'show' => esc_html__( 'Show', 'news-cast' ),
                'hide' => esc_html__( 'Hide', 'news-cast' ),
                'return_value' => 'show',
                'default' => 'hide',
            ]
        );
        
        $this->add_control(
            'authorOption',
            [
                'label' => esc_html__( 'Show author', 'news-cast' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'news-cast' ),
                'label_off' => esc_html__( 'Hide', 'news-cast' ),
                'show' => esc_html__( 'Show', 'news-cast' ),
                'hide' => esc_html__( 'Hide', 'news-cast' ),
                'return_value' => 'show',
                'default' => 'hide',
            ]
        );
        
        $this->add_control(
            'categoryOption',
            [
                'label' => esc_html__( 'Show categories', 'news-cast' ),
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
            'tagsOption',
            [
                'label' => esc_html__( 'Show tags', 'news-cast' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'news-cast' ),
                'label_off' => esc_html__( 'Hide', 'news-cast' ),
                'show' => esc_html__( 'Show', 'news-cast' ),
                'hide' => esc_html__( 'Hide', 'news-cast' ),
                'return_value' => 'show',
                'default' => 'hide',
            ]
        );
        
        $this->add_control(
            'commentOption',
            [
                'label' => esc_html__( 'Show comments number', 'news-cast' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'news-cast' ),
                'label_off' => esc_html__( 'Hide', 'news-cast' ),
                'show' => esc_html__( 'Show', 'news-cast' ),
                'hide' => esc_html__( 'Hide', 'news-cast' ),
                'return_value' => 'show',
                'default' => 'hide',
            ]
        );

        $this->add_control(
            'contentOption',
            [
                'label' => esc_html__( 'Show content', 'news-cast' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'news-cast' ),
                'label_off' => esc_html__( 'Hide', 'news-cast' ),
                'show' => esc_html__( 'Show', 'news-cast' ),
                'hide' => esc_html__( 'Hide', 'news-cast' ),
                'return_value' => 'show',
                'default' => 'hide',
            ]
        );

        $this->end_controls_section();

        /**************************************************************/
        $this->start_controls_section(
            'extra_option_section',
            [
            'label' => esc_html__( 'Extra Settings', 'news-cast' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'permalinkTarget',
                [
                    'label' => esc_html__( 'Links open in', 'news-cast' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '_self',
                    'options' => [
                        '_self'  => esc_html__( 'Same Tab', 'news-cast' ),
                        '_blank'  => esc_html__( 'New Tab', 'news-cast' )
                    ],
                ]
            );

            $this->add_control(
                'imageHoverType',
                [
                    'label' => esc_html__( 'Image Hover Type', 'news-cast' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none'  => esc_html__( 'None', 'news-cast' ),
                        'effect-one'    => esc_html__( 'Effect One', 'news-cast' ),
                        'effect-two'    => esc_html__( 'Effect Two', 'news-cast' )
                    ],
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
        $buttonOption       = ( $buttonOption === 'show' );
        $contentOption      = ( $contentOption === 'show' );
        $dateOption         = ( $dateOption === 'show' );
        $authorOption       = ( $authorOption === 'show' );
        $categoryOption     = ( $categoryOption === 'show' );
        $tagsOption         = ( $tagsOption === 'show' );
        $commentOption      = ( $commentOption === 'show' );
        
        echo '<div id="bmm-post-featured-block-'.esc_attr( $element_id ).'" class="bmm-post-featured-block block-'.esc_attr( $element_id ).' bmm-block bmm-block-post-post-featured--layout-two bmm-block-image-hover--'.esc_html( $imageHoverType ).'">';
            if( !empty( $blockTitle ) ) {
                echo '<h2 class="bmm-block-title"><span>'.esc_html( $blockTitle ).'</span></h2>';
            }
            // include template file w.r.t  layout value
            include( NEWS_CAST_INCLUDES_PATH .'elementor-widgets/post-featured/template.php' );
        echo '</div><!-- #bmm-post-featured-block -->';
    }
}