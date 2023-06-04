<?php
/**
 * Element radio image custom elementor control.
 * 
 */
class Style_Mag_Radio_Image_Control extends \Elementor\Base_Data_Control {
    /**
     * Control name.
     */
    public function get_type() {
        return 'RADIOIMAGE';
    }
    
    /**
     * Enqueue control scripts and styles.
     *
     * Used to register and enqueue custom scripts and styles used by control.
     *
     * @since 1.0.0
     * @access public
     */
    public function enqueue() {
        wp_enqueue_style( 'news-cast-elementor-radio-image-control', NEWS_CAST_ELEMENTOR_DIR_URI . 'custom-controls/radio-image/radio-image.css', array(), NEWS_CAST_VERSION, 'all' );

        wp_enqueue_script( 'news-cast-elementor-radio-image-control', NEWS_CAST_ELEMENTOR_DIR_URI . 'custom-controls/radio-image/radio-image.js', array( 'jquery' ), NEWS_CAST_VERSION, true );
    }
    
    protected function get_default_settings() {
		return [
			'label_block' => true,
			'options' => [],
		];
    }
    
    public function content_template() {
        $control_uid = $this->get_control_uid();
    ?>
        <div id="elementor-radio-image-control-field">
            <label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>
            <div class="elementor-control-input-wrapper">
                <ul id="<?php echo esc_attr( $control_uid ); ?>" class="bmm-radio-image-control-wrap">
                    <# _.each( data.options, function( option ) { #>
                        <li class='bmm-radio-image-item <# if( option.value === data.controlValue ) { #>isActive<# } #>' data-value="{{ option.value }}">
                            {{ option.value }}
                            <# if( option.label ) { #>
                                <img src="{{ option.label }}" alt="{{ option.value }}" />
                            <# } #>
                        </li>
                    <# }); #>
                </ul>
            </div>
        </div>
    <?php
    }
}