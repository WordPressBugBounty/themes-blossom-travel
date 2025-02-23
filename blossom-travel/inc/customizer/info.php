<?php
/**
 * Blossom Travel Theme Info
 *
 * @package Blossom_Travel
 */

function blossom_travel_customizer_theme_info( $wp_customize ) {
	
    $wp_customize->add_section( 'theme_info', array(
		'title'       => __( 'Demo & Documentation' , 'blossom-travel' ),
		'priority'    => 6,
	) );
    
    /** Important Links */
	$wp_customize->add_setting( 'theme_info_theme',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $theme_info = '<p>';
	$theme_info .= sprintf( __( 'Demo Link: %1$sClick here.%2$s', 'blossom-travel' ),  '<a href="' . esc_url( 'https://blossomthemes.com/theme-demo/?theme=blossom-travel&utm_source=blossom_travel&utm_medium=customizer&utm_campaign=theme_demo' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p><p>';
    $theme_info .= sprintf( __( 'Documentation Link: %1$sClick here.%2$s', 'blossom-travel' ),  '<a href="' . esc_url( 'https://docs.blossomthemes.com/blossom-travel/?utm_source=blossom_travel&utm_medium=customizer&utm_campaign=docs' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p>';
	$theme_info .= '<p>';
    $theme_info .= sprintf( __( 'Video Link: %1$sClick here.%2$s', 'blossom-travel' ),  '<a href="' . esc_url( 'https://www.youtube.com/watch?v=Pg9Q1BSGUtU&list=PLkJUvleBsFhdvnjBoX0R7Oua2JcLLBo8R' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p>';

	$wp_customize->add_control( new Blossom_Travel_Note_Control( $wp_customize,
        'theme_info_theme', 
            array(
                'section'     => 'theme_info',
                'description' => $theme_info
            )
        )
    );
    
}
add_action( 'customize_register', 'blossom_travel_customizer_theme_info' );

if( class_exists( 'WP_Customize_Section' ) ) :
/**
 * Adding Go to Pro Section in Customizer
 * https://github.com/justintadlock/trt-customizer-pro
 */
class Blossom_Travel_Customize_Section_Pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'blossom-travel-pro-section';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				{{ data.title }}
				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{{ data.pro_url }}}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}
endif;

/**
 * Add Pro Button
*/
function blossom_travel_page_sections_pro( $manager ) {
	// Register custom section types.
	$manager->register_section_type( 'Blossom_Travel_Customize_Section_Pro' );

	// Register sections.
	$manager->add_section(
		new Blossom_Travel_Customize_Section_Pro(
			$manager,
			'blossom_travel_page_view_pro',
			array(
				'title'    => esc_html__( 'Pro Available', 'blossom-travel' ),
                'priority' => 5, 
				'pro_text' => esc_html__( 'VIEW PRO THEME', 'blossom-travel' ),
				'pro_url'  => esc_url( 'https://blossomthemes.com/wordpress-themes/blossom-travel-pro/?utm_source=blossom_travel&utm_medium=customizer&utm_campaign=upgrade_to_pro' ),
			)
		)
	);
}
add_action( 'customize_register', 'blossom_travel_page_sections_pro' );