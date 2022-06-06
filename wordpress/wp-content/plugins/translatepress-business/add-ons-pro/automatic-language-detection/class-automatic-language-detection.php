<?php

class TRP_IN_Automatic_Language_Detection {

	protected $settings;
	protected $loader;
	/* @var TRP_Url_Converter */
	protected $url_converter;
	/* @var TRP_IN_ALD_Settings */
	protected $trp_ald_settings;
	/* @var TRP_Languages */
	protected $trp_languages;

	/**
	 * TRP_Automatic_Language_Detection constructor.
	 *
	 * Defines constants, adds hooks and deals with license page.
	 */
	public function __construct() {

		define( 'TRP_IN_ALD_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		define( 'TRP_IN_ALD_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		require_once( TRP_IN_ALD_PLUGIN_DIR . 'includes/class-ald-settings.php' );
		require_once( TRP_IN_ALD_PLUGIN_DIR . 'includes/class-determine-language.php' );

		$this->trp_ald_settings = new TRP_IN_ALD_Settings();
		$trp = TRP_Translate_Press::get_trp_instance();

		$this->loader = $trp->get_component( 'loader' );
		$this->loader->add_action( 'wp_enqueue_scripts', $this, 'enqueue_cookie_adding' );

		$this->loader->add_action( 'trp_extra_settings', $this->trp_ald_settings, 'addon_settings_ui', 10, 1 );
		$this->loader->add_action( 'admin_init', $this->trp_ald_settings, 'register_setting' );

	}

	/**
	 * Enqueue script on all front-end pages
	 */
	public function enqueue_cookie_adding() {
        $trp_language_cookie_data = $this->get_language_cookie_data();
        if ( apply_filters( 'trp_ald_enqueue_redirecting_script', true ) ) {
            wp_enqueue_script( 'trp-language-cookie', TRP_IN_ALD_PLUGIN_URL . 'assets/js/trp-language-cookie.js', array( 'jquery' ), TRP_IN_ALD_PLUGIN_VERSION );
            wp_localize_script( 'trp-language-cookie', 'trp_language_cookie_data', $trp_language_cookie_data );
        }
    }

	/**
	 * Returns site data useful for determining language from url
	 *
	 * @return array
	 */
	public function get_language_cookie_data() {
		$trp = TRP_Translate_Press::get_trp_instance();
		if ( ! $this->url_converter ) {
			$this->url_converter = $trp->get_component( 'url_converter' );
		}
		if ( ! $this->settings ) {
			$trp_settings   = $trp->get_component( 'settings' );
			$this->settings = $trp_settings->get_settings();
		}
		if ( ! $this->trp_languages ) {
			$this->trp_languages = $trp->get_component( 'languages' );
		}
		$ald_settings = $this->trp_ald_settings->get_ald_settings();

		$data = array(
			'abs_home'          => $this->url_converter->get_abs_home(),
			'url_slugs'         => $this->settings['url-slugs'],
			'cookie_name'       => 'trp_language',
			'cookie_age'        => '30',
			'cookie_path'       => COOKIEPATH,
			'default_language'  => $this->settings['default-language'],
			'publish_languages' => $this->settings['publish-languages'],
			'trp_ald_ajax_url'  => apply_filters( 'trp_ald_ajax_url', TRP_IN_ALD_PLUGIN_URL . 'includes/trp-ald-ajax.php' ),
			'detection_method'  => $ald_settings['detection-method'],
			'iso_codes'         => $this->trp_languages->get_iso_codes( $this->settings['publish-languages'] )
		);

		return apply_filters( 'trp_language_cookie_data', $data );
	}
}
