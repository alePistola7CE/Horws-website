<?php
/*
	Plugin Name: Stockdio Historical Chart
	Plugin URI: http://www.stockdio.com/wordpress
	Plugin URI: http://www.stockdio.com/wordpress
	Description: A WordPress plugin for displaying historical stock market live charts and technical indicators.
	Author: Stockdio
	Version: 2.6.1
	Author URI: http://www.stockdio.com
*/
//set up the admin area options page
define( 'stockdio_historical_chart__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
class StockdioSettingsPage
{
		public static function get_page_url( $page = 'config' ) {

		$args = array( 'page' => 'stockdio-historical-chart-settings-config' );

		$url = add_query_arg( $args, class_exists( 'Jetpack' ) ? admin_url( 'admin.php' ) : admin_url( 'options-general.php' ) );

		return $url;
	}
	public static function view( $name) {
		$file = stockdio_historical_chart__PLUGIN_DIR . $name . '.php';
		include( $file );
	}
	
	public static function display_admin_alert() {
		self::view( 'activate_plugin_admin' );
	}
	public static function display_settings_alert() {
		self::view( 'activate_plugin_settings' );
	}
	
	public static function display_notice() {
		global $hook_suffix;
		$stockdio_historical_chart_options = get_option( 'stockdio_historical_chart_options' );
		$api_key = $stockdio_historical_chart_options['api_key'];
		/*print $hook_suffix;*/
		if (($hook_suffix == 'plugins.php' || in_array( $hook_suffix, array( 'jetpack_page_stockdio-historical-chart-key-config', 'settings_page_stockdio-historical-chart-key-config', 'settings_page_stockdio-historical-chart-settings-config', 'jetpack_page_stockdio-historical-chart-settings-config' ))) && empty($api_key))
		{
			if ($hook_suffix == 'plugins.php')
				self::display_admin_alert();
			else
				self::display_settings_alert();
		}
		
	}
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $stockdio_historical_chart_options;

    /**
     * Start up
     */
    public function __construct()
    {
		add_action('admin_head', 'stockdio_js');
        add_action( 'admin_menu', array( $this, 'stockdio_historical_chart_add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'stockdio_historical_chart_page_init' ) );
		add_action( 'admin_notices', array( $this, 'display_notice' ) );
		add_action('admin_head', 'stockdio_charts_button');
    }
	
    /**
     * Add options page
     */
    public function stockdio_historical_chart_add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Stockdio Historical Chart Settings', 
            'Stockdio Historical Chart', 
            'manage_options', 
            'stockdio-historical-chart-settings-config', 
            array( $this, 'stockdio_historical_chart_create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function stockdio_historical_chart_create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'stockdio_historical_chart_options' );
        ?>
</link>

<div class="wrap">
  <h2>Stockdio Historical Chart Settings</h2>
  <div class="stockdio_historical_chart_form">
    <form method="post" action="options.php">
      <?php
					// This prints out all hidden setting fields
					settings_fields( 'stockdio_historical_chart_option_group' );   
					do_settings_sections( 'stockdio-historical-chart-settings-config' );
					submit_button(); 
				?>
    </form>
  </div>
</div>
<?php
    }


    /**
     * Register and add settings
     */
    public function stockdio_historical_chart_page_init()
    {        
		$stockdio_historical_chart_options = get_option( 'stockdio_historical_chart_options' );
		$api_key = $stockdio_historical_chart_options['api_key'];
		//delete_option( 'stockdio_historical_chart_options'  );
		register_setting(
			'stockdio_historical_chart_option_group', // Option group
			'stockdio_historical_chart_options', // Option name
			array( $this, 'stockdio_historical_chart_sanitize' ) // stockdio_historical_chart_sanitize
		);
		
		if (empty($api_key)) {
			add_settings_section(
				'setting_section_id', // ID
				'', // Title
				array( $this, 'stockdio_historical_chart_print_section_empty_app_key_info' ), // Callback
				'stockdio-historical-chart-settings-config' // Page
			);  

			add_settings_field(
				'api_key', // ID
				'App-Key', // Title 
				array( $this, 'stockdio_historical_chart_api_key_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section        
			);  
		}
		else {
			add_settings_section(
				'setting_section_id', // ID
				'', // Title
				array( $this, 'stockdio_historical_chart_print_section_info' ), // Callback
				'stockdio-historical-chart-settings-config' // Page
			);  

			add_settings_field(
				'api_key', // ID
				'Api Key', // Title 
				array( $this, 'stockdio_historical_chart_api_key_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section        
			);  

			add_settings_field(
				'default_exchange', // ID
				'Exchange', // Title 
				array( $this, 'stockdio_historical_chart_exchange_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);
			
			add_settings_field(
				'default_symbol', // ID
				'Symbol', // Title 
				array( $this, 'stockdio_historical_chart_symbol_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);  		

			add_settings_field(
				'default_compare', // ID
				'Compare', // Title 
				array( $this, 'stockdio_historical_chart_compare_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);  			
			
			add_settings_field(
				'default_width', // ID
				'Width', // Title 
				array( $this, 'stockdio_historical_chart_width_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);
			
			add_settings_field(
				'default_height', // ID
				'Height', // Title 
				array( $this, 'stockdio_historical_chart_height_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);
			add_settings_field(
				'default_displayPrices', // ID
				'Display Prices', // Title 
				array( $this, 'stockdio_historical_chart_displayPrices_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);			
			
			add_settings_field(
				'default_performance', // ID
				'Performance', // Title 
				array( $this, 'stockdio_historical_chart_performance_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);  

			add_settings_field(
				'default_culture', // ID
				'Culture', // Title 
				array( $this, 'stockdio_historical_chart_culture_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);
			
			add_settings_field(
				'default_allowPeriodChange', // ID
				'Allow Period Change', // Title 
				array( $this, 'stockdio_historical_chart_allowPeriodChange_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);	

			add_settings_field(
				'default_intraday', // ID
				'Intraday', // Title 
				array( $this, 'stockdio_historical_intraday_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);	
			
			add_settings_field(
				'default_days', // ID
				'Days', // Title 
				array( $this, 'stockdio_historical_chart_days_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);	
			
					
			add_settings_field(
				'default_motif', // ID
				'Motif', // Title 
				array( $this, 'stockdio_historical_chart_motif_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);
			
			add_settings_field(
				'default_palette', // ID
				'Palette', // Title 
				array( $this, 'stockdio_historical_chart_palette_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);		
			
			add_settings_field(
				'allowPeriodChangeCheck', // ID
				'', // Title 
				array( $this, 'stockdio_historical_chart_allowPeriodChangeCheck_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);	
			add_settings_field(
				'intradayCheck', // ID
				'', // Title 
				array( $this, 'stockdio_historical_chart_intradayCheck_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);				
			
			add_settings_field(
				'default_font', // ID
				'Font', // Title 
				array( $this, 'stockdio_historical_chart_font_callback' ), // Callback
				'stockdio-historical-chart-settings-config', // Page
				'setting_section_id' // Section           
			);	
			
		}
		
		$plugin_data = get_plugin_data( __FILE__ );
		$plugin_version = $plugin_data['Version'];
		$css_address=plugin_dir_url( __FILE__ )."assets/stockdio-wp.css";
		wp_register_script("customAdminCss",$css_address );
		wp_enqueue_style("customAdminCss", $css_address, array(), $plugin_version, false);
		
		$css_tinymce_button_address=plugin_dir_url( __FILE__ )."assets/stockdio-tinymce-button.css";
		wp_register_script("custom_tinymce_button_Css",$css_tinymce_button_address );
		wp_enqueue_style("custom_tinymce_button_Css", $css_tinymce_button_address, array(), $plugin_version, false);
		
		wp_enqueue_script('jquery');
		//$js_address=plugin_dir_url( __FILE__ )."assets/stockdio-wp.js";
		//wp_register_script("customAdminJs",$js_address );
		//wp_enqueue_style("customAdminJs", $js_address, array(), false, false);
    }

	public function stockdio_historical_chart_sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['api_key'] ) )
            $new_input['api_key'] = $input['api_key'] ;
        if( isset( $input['default_symbol'] ) )
            $new_input['default_symbol'] =  $input['default_symbol'] ;
		
		if( isset( $input['default_compare'] ) )
            $new_input['default_compare'] =  $input['default_compare'] ;
		if( isset( $input['default_performance'] ) )
            $new_input['default_performance'] =  $input['default_performance'] ;
		if( isset( $input['default_exchange'] ) )
            $new_input['default_exchange'] =  $input['default_exchange'] ;
		if( isset( $input['default_culture'] ) )
            $new_input['default_culture'] =  $input['default_culture'] ;
		if( isset( $input['default_width'] ) )
            $new_input['default_width'] =  $input['default_width'] ;
		if( isset( $input['default_height'] ) )
            $new_input['default_height'] =  $input['default_height'] ;
		if( isset( $input['default_displayPrices'] ) )
            $new_input['default_displayPrices'] =  $input['default_displayPrices'] ;
		if( isset( $input['default_font'] ) )
            $new_input['default_font'] =  $input['default_font'] ;		
		if( isset( $input['default_allowPeriodChange'] ) )
			$new_input['default_allowPeriodChange'] =  $input['default_allowPeriodChange'] ;		
		if( isset( $input['default_intraday'] ) )
			$new_input['default_intraday'] =  $input['default_intraday'] ;
		if( isset( $input['default_days'] ) )
			$new_input['default_days'] =  $input['default_days'];
		if( isset( $input['allowPeriodChangeCheck'] ) )
			$new_input['allowPeriodChangeCheck'] =  $input['allowPeriodChangeCheck'] ;	
		if( isset( $input['intradayCheck'] ) )
			$new_input['intradayCheck'] =  $input['intradayCheck'] ;	
		if( isset( $input['default_motif'] ) )
            $new_input['default_motif'] =  $input['default_motif'] ;
		if( isset( $input['default_palette'] ) )
            $new_input['default_palette'] =  $input['default_palette'] ;

        return $new_input;
    }
	

	/**	
     * Print the Section text when app key is empty
     */
    public function stockdio_historical_chart_print_section_empty_app_key_info()
    {
        print '<p>If you don\'t have a Stockdio account please click <a href="#" id="a_show_register_form">here</a>
		<br><br>
		Enter your app-key here. For more information go to <a href="http://www.stockdio.com/wordpress?wp=1" target="_blank">http://www.stockdio.com/wordpress</a>.
		</p>';
    }
	
    /** 
     * Print the Section text
     */
    public function stockdio_historical_chart_print_section_info()
    {
        print '<br/><i>For more information on this plugin, please visit <a href="http://www.stockdio.com/wordpress?wp=1" target="_blank">http://www.stockdio.com/wordpress</a>.</i>';
    }

    /** 
     * Get the settings option array and print one of its values
     */
     public function stockdio_historical_chart_api_key_callback()
    {
        printf(
            '<input type="text" id="api_key" name="stockdio_historical_chart_options[api_key]" value="%s" />',
            isset( $this->options['api_key'] ) ? esc_attr( $this->options['api_key']) : ''
        );

    }

	public function stockdio_historical_chart_symbol_callback()
    {
    	if( empty( $this->options['default_symbol'] ) )
            $this->options['default_symbol'] = '' ;
        printf(
            '<input type="text" id="default_symbol" name="stockdio_historical_chart_options[default_symbol]" value="%s" />		
			<p class="description" id="tagline-description">A valid company\'s stock symbol (ex. AAPL), market index ticker (ex. ^SPX), currency pair (ex. EUR/USD) or commodity ticker (ex. GC). For a list of available market indices please visit <a href="www.stockdio.com/indices" target="_blank">http://www.stockdio.com/indices</a>. For available currencies please visit <a href="www.stockdio.com/currencies" target="_blank">http://www.stockdio.com/currencies</a> and for available commodities, please go to <a href="www.stockdio.com/commodities" target="_blank">http://www.stockdio.com/commodities</a>.</p>',
            isset( $this->options['default_symbol'] ) ? esc_attr( $this->options['default_symbol']) : ''
        );
    }
	
	public function stockdio_historical_chart_compare_callback()
    {
    	if( empty( $this->options['default_compare'] ) )
            $this->options['default_compare'] = '' ;
        printf(
            '<input type="text" id="default_compare" name="stockdio_historical_chart_options[default_compare]" value="%s" />		
			<p class="description" id="tagline-description">Specify a list of valid stock symbols or market indices against which to compare the base symbol, separated by semicolon (ex. MSFT;GOOG;^SPX;^IXIC). Not case sensitive (optional).</p>
			',
            isset( $this->options['default_compare'] ) ? esc_attr( $this->options['default_compare']) : ''
        );
    }
	
	public function stockdio_historical_chart_performance_callback()
    {	
        printf(
            '<input type="checkbox" id="default_performance" name="stockdio_historical_chart_options[default_performance]" value="%s" '. checked( $this->options['default_performance'],1, false ) .' />			
			<p class="description" id="tagline-description">If checked, price performance (percent change) will be displayed, instead of actual price.</p>
			',
            isset( $this->options['default_performance'] ) && $this->options['default_performance'] != 0 ? $this->options['default_performance'] : 1
        );	
    }
	
	public function stockdio_historical_intraday_callback()
    {	
		if( !isset( $this->options['intradayCheck'] ) ){
			 $this->options['default_intraday']=1;
		}	
        printf(
            '<input type="checkbox" id="default_intraday" name="stockdio_historical_chart_options[default_intraday]" value="%s" '. checked( $this->options['default_intraday'],1, false ) .' />			
			<p class="description" id="tagline-description">If enabled, intraday delayed data will be used if available for the exchange and number of days is between 1 and 5. For a list of exchanges with intraday data available, please visit <a href="http://www.stockdio.com/exchanges.?wp=1" target="_blank">http://www.stockdio.com/exchanges.</a></p>
			',
            isset( $this->options['default_intraday'] ) ? $this->options['default_intraday'] : 1
        );
    }
	
	public function stockdio_historical_chart_exchange_callback()
        {
		if( empty( $this->options['default_exchange'] ) )
            $this->options['default_exchange'] = '' ;
        printf(
            '<select name="stockdio_historical_chart_options[default_exchange]" id="default_exchange">		
			    <option value="" selected="selected">None</option>
				<option value="Forex">Currencies Trading</option>
				<option value="Commodities">Commodities Trading</option>
				<option value="NYSENasdaq">NYSE-Nasdaq-NYSE MKT</option>
				<option value="OTCMKTS" >OTC Markets</option>
				<option value="OTCBB" >OTC Bulletin Board</option>
				<option value="LSE" >London Stock Exchange</option>
				<option value="TSE" >Tokyo Stock Exchange</option>
				<option value="HKSE">Hong Kong Stock Exchange</option>
				<option value="SSE">Shanghai Stock Exchange</option>
				<option value="SZSE">Shenzhen Stock Exchange</option>
				<option value="FWB">Deutsche Börse Frankfurt</option>
				<option value="XETRA">XETRA</option>
				<option value="AEX">Euronext Amsterdam</option>
				<option value="BEX">Euronext Brussels</option>
				<option value="PEX">Euronext Paris</option>
				<option value="LEX">Euronext Lisbon</option>
				<option value="ASX">Australian Stock Exchange</option>
				<option value="TSX">Toronto Stock Exchange</option>
				<option value="TSXV">TSX Venture Exchange</option>
				<option value="CSE">Canadian Securities Exchange</option>
				<option value="SIX">SIX Swiss Exchange</option>
				<option value="KRX">Korean Stock Exchange</option>
				<option value="Kosdaq">Kosdaq Stock Exchange</option>
				<option value="OMXS">NASDAQ OMX Stockholm</option>
				<option value="OMXC">NASDAQ OMX Copenhagen</option>
				<option value="OMXH">NASDAQ OMX Helsinky</option>
				<option value="OMXI">NASDAQ OMX Iceland</option>
				<option value="BSE">Bombay Stock Exchange</option>
				<option value="NSE">India NSE</option>
				<option value="BME">Bolsa de Madrid</option>
				<option value="JSE">Johannesburg Stock Exchange</option>
				
				
				<option value="TWSE">Taiwan Stock Exchange</option>
				<option value="BIT">Borsa Italiana</option>
				<option value="MOEX">Moscow Exchange</option>
				<option value="Bovespa">Bovespa Sao Paulo Stock Exchange</option>
				<option value="NZX">New Zealand Exchange</option>	
				<option value="ISE">Irish Stock Exchange</option>	

				<option value="SGX">Singapore Exchange</option>	
				
				<option value="TADAWUL">Tadawul Saudi Stock Exchange</option>	
				<option value="WSE">Warsaw Stock Exchange</option>	
				
				
				<option value="TASE">Tel Aviv Stock Exchange</option>			
				<option value="KLSE">Bursa Malaysia</option>	
				<option value="IDX">Indonesia Stock Exchange</option>		
				<option value="BMV">Bolsa Mexicana de Valores</option>
				<option value="OSE">Oslo Stock Exchange</option>		
				<option value="BCBA">Bolsa de Comercio de Buenos Aires</option>			
				<option value="SET">Stock Exchange of Thailand</option>		
				<option value="VSE">Vienna Stock Exchange</option>		
				<option value="BCS">Bolsa de Comercio de Santigo</option>		
				<option value="BIST">Borsa Istanbul</option>	
				<option value="OMXT">NASDAQ OMX Tallinn</option>	
				<option value="OMXR">NASDAQ OMX Riga</option>	
				<option value="OMXV">NASDAQ OMX Vilnius</option>	
				<option value="PSE">Philippine Stock Exchange</option>
				<option value="ADX">Abu Dhabi Securities Exchange</option>
				<option value="DFM">Dubai Financial Market</option>
				<option value="BVC">Bolsa de Valores de Colombia</option>
				
				
				<option value="NGSE">Nigerian Stock Exchange</option>				
				<option value="QSE">Qatar Stock Exchange</option>	
				<option value="TPEX">Taipei Exchange</option>	
				<option value="BVL">Bolsa de Valores de Lima</option>	
				<option value="EGX">The Egyptian Exchange</option>	
				
				<option value="ASE">Athens Stock Exchange</option>	
				
				<option value="NASE">Nairobi Securities Exchange</option>	
				<option value="HNX">Hanoi Stock Exchange</option>	
				<option value="HOSE">Hochiminh Stock Exchange</option>		
				<option value="BCPP">Prague Stock Exchange</option>		
				<option value="AMSE">Amman Stock Exchange</option>						
             </select>
			 <p class="description" id="tagline-description">Specify the stock exchange the symbol belongs to. If not specified, NYSE & Nasdaq will be used by default (USA).</p>
			 <script>document.getElementById("default_exchange").value = "'.$this->options['default_exchange'].'";</script>
			 ',
    		'default_exchange'
    		);
    }

		public function stockdio_historical_chart_culture_callback()
        {
		if( empty( $this->options['default_culture'] ) )
            $this->options['default_culture'] = '' ;
        printf(
            '<select name="stockdio_historical_chart_options[default_culture]" id="default_culture">		
			    <option value="" selected="selected">None</option> 
				<option value="English-US">English-US</option> 
				<option value="English-UK">English-UK</option> 
				<option value="English-Canada">English-Canada</option> 
				<option value="English-Australia">English-Australia</option> 
				<option value="Spanish-Spain">Spanish-Spain</option> 
				<option value="Spanish-Mexico">Spanish-Mexico</option> 
				<option value="Spanish-LatinAmerica">Spanish-LatinAmerica</option> 
				<option value="French-France">French-France</option> 
				<option value="French-Canada">French-Canada</option> 
				<option value="French-Belgium">French-Belgium</option> 
				<option value="French-Switzerland">French-Switzerland</option> 
				<option value="Italian-Italy">Italian-Italy</option> 
				<option value="Italian-Switzerland">Italian-Switzerland</option> 
				<option value="German-Germany">German-Germany</option> 
				<option value="German-Switzerland">German-Switzerland</option> 
				<option value="Portuguese-Brasil">Portuguese-Brasil</option> 
				<option value="Portuguese-Portugal">Portuguese-Portugal</option> 
				<option value="Dutch-Netherlands">Dutch-Netherlands</option> 
				<option value="Dutch-Belgium">Dutch-Belgium</option> 
				<option value="SimplifiedChinese-China">SimplifiedChinese-China</option> 
				<option value="SimplifiedChinese-HongKong">SimplifiedChinese-HongKong</option> 		
				<option value="Japanese-Japan">Japanese-Japan</option> 
				<option value="Korean-Korea">Korean-Korea</option> 
				<option value="Russian-Russia">Russian-Russia</option> 	
				<option value="Polish-Poland">Polish-Poland</option>					
             </select>
			 <p class="description" id="tagline-description">Allows to specify a combination of language and country settings, used to display texts and to format numbers and dates (e.g. Spanish-Spain). For a list of available culture combinations please visit <a href="http://www.stockdio.com/cultures?wp=1" target="_blank">http://www.stockdio.com/cultures</a>.</p>
			 <script>document.getElementById("default_culture").value = "'.$this->options['default_culture'].'";</script>
			 ',
    		'default_culture'
    		);
    }
	
		public function stockdio_historical_chart_displayPrices_callback()
        {
		if( empty( $this->options['default_displayPrices'] ) )
            $this->options['default_displayPrices'] = 'Lines' ;
        printf(
            '<select name="stockdio_historical_chart_options[default_displayPrices]" id="default_displayPrices">		
			    <option value="" selected="selected">None</option> 
				<option value="OHLC">OHLC</option> 		
				<option value="HLC">HLC</option> 		
				<option value="Candlestick">Candlestick</option> 		
				<option value="Lines">Lines</option> 		
				<option value="Area">Area</option> 		
             </select>
			 <p class="description" id="tagline-description">Allows to specify how to display the prices on the chart.</p>
			 <script>document.getElementById("default_displayPrices").value = "'.$this->options['default_displayPrices'].'";</script>
			 ',
    		'default_displayPrices'
    		);
    }	
	
	public function stockdio_historical_chart_width_callback()
    {
    	if( empty( $this->options['default_width'] ) )
            $this->options['default_width'] = '' ;
        printf(
            '<input type="text" id="default_width" name="stockdio_historical_chart_options[default_width]" value="%s" />
			<p class="description" id="tagline-description">Specifies the chart width, in pixels (e.g. 800px) or percentage (e.g. 100%%). If you specify the numerical value only, without px or %%, size will be assumed as pixels.</p>'
			,
            isset( $this->options['default_width'] ) ? esc_attr( $this->options['default_width']) : ''
        );
    }
	
    public function stockdio_historical_chart_height_callback()
    {
    	if( empty( $this->options['default_height'] ) )
            $this->options['default_height'] = '350px' ;
        printf(
            '<input type="text" id="default_height" name="stockdio_historical_chart_options[default_height]" value="%s" />
			<p class="description" id="tagline-description">Specifies the chart height, in pixels (e.g. 420px or 420).</p>
			',
            isset( $this->options['default_height'] ) ? esc_attr( $this->options['default_height']) : ''
        );
    }
	
	public function stockdio_historical_chart_font_callback()
    {
    	if( empty( $this->options['default_font'] ) )
            $this->options['default_font'] = '' ;
        printf(
            '<input type="text" id="default_font" name="stockdio_historical_chart_options[default_font]" value="%s" />
			<p class="description" id="tagline-description">Allows to specify the font that will be used to render the chart. Multiple fonts may be specified separated by comma, e.g. Lato,Helvetica,Arial.</p>
			',
            isset( $this->options['default_font'] ) ? esc_attr( $this->options['default_font']) : ''
        );
    }
	
	public function stockdio_historical_chart_allowPeriodChange_callback()
    {
		if( !isset( $this->options['allowPeriodChangeCheck'] ) ){
			 $this->options['default_allowPeriodChange']=1;
		}	
        printf(
            '<input type="checkbox" id="default_allowPeriodChange" name="stockdio_historical_chart_options[default_allowPeriodChange]" value="%s" '. checked( $this->options['default_allowPeriodChange'],1, false ) .' />			
			<p class="description" id="tagline-description">Provides a UI to allow the end user to select the period for the data to be displayed.</p>
			',
            isset( $this->options['default_allowPeriodChange'] ) ? $this->options['default_allowPeriodChange'] : 1
        );
		
    }
	

	
	public function stockdio_historical_chart_days_callback()
    {
    	if( empty( $this->options['default_days'] ) )
            $this->options['default_days'] = '' ;
        printf(
            '<input type="text" id="default_days" name="stockdio_historical_chart_options[default_days]" value="%s" />
			<p class="description" id="tagline-description">Used only if the start and/or the end date are not specified. If not specified, its default value is 365 days. If intraday data is available for the stock exchange and the exchange is currently open, the default number of days is 1.</p>
			',
            isset( $this->options['default_days'] ) ? esc_attr( $this->options['default_days']) : ''
        );
    }

	
	
	public function stockdio_historical_chart_intradayCheck_callback()
    {
		$this->options['intradayCheck'] = "1";
		 printf('<input style="display:none" type="text" id="intradayCheck" name="stockdio_historical_chart_options[intradayCheck]" value="1" />');
		printf('<div class="stockdio_hidden_setting" style="display:none"></div><script>jQuery(function () {jQuery(".stockdio_hidden_setting").parent().parent().hide()});</script> ');
    }
	
	public function stockdio_historical_chart_allowPeriodChangeCheck_callback()
    {
		$this->options['allowPeriodChangeCheck'] = "1";
		 printf('<input style="display:none" type="text" id="allowPeriodChangeCheck" name="stockdio_historical_chart_options[allowPeriodChangeCheck]" value="1" />');
		printf('<div class="stockdio_hidden_setting" style="display:none"></div><script>jQuery(function () {jQuery(".stockdio_hidden_setting").parent().parent().hide()});</script> ');
    }
	
	public function stockdio_historical_chart_palette_callback()
        {
		if( empty( $this->options['default_palette'] ) )
            $this->options['default_palette'] = '' ;
        printf(
            '<select name="stockdio_historical_chart_options[default_palette]" id="default_palette">
			    <option value="" selected="selected">None</option>
				<option value="Aurora">Aurora</option>
				<option value="Block">Block</option>
				<option value="Brown-Sugar">Brown-Sugar</option>
				<option value="Eggplant">Eggplant</option>
				<option value="Excite-Bike">Excite-Bike</option>
				<option value="Financial-Light" >Financial-Light</option>
				<option value="Healthy">Healthy</option>
				<option value="High-Contrast">High-Contrast</option>
				<option value="Humanity">Humanity</option>
				<option value="Lilacs-in-Mist">Lilacs-in-Mist</option>
				<option value="Mesa">Mesa</option>
				<option value="Modern-Business">Modern-Business</option>
				<option value="Mint-Choc">Mint-Choc</option>
				<option value="Pastels">Pastels</option>
				<option value="Relief">Relief</option>
				<option value="Whitespace">Whitespace</option>			 
             </select>
			 <p class="description" id="tagline-description">Includes a set of consistent colors used for the visualization. Most palette colors can be overridden with specific colors for several features such as border, background, labels, etc. For more info, please visit <a href="http://www.stockdio.com/palettes?wp=1" target="_blank">http://www.stockdio.com/palettes</a> </p>
			 <script>document.getElementById("default_palette").value = "'.$this->options['default_palette'].'";</script>
			 ',
    		'default_palette'
    		);
    }

	public function stockdio_historical_chart_motif_callback()
        {
		if( empty( $this->options['default_motif'] ) )
            $this->options['default_motif'] = '' ;			
        printf(
            '<select name="stockdio_historical_chart_options[default_motif]" id="default_motif">			
				<option value="" selected="selected">None</option>
				<option value="Aurora">Aurora</option>
				<option value="Blinds">Blinds</option>
				<option value="Block">Block</option>
				<option value="Face">Face</option>
				<option value="Financial" >Financial</option>
				<option value="Glow">Glow</option>
				<option value="Healthy">Healthy</option>
				<option value="Hook">Hook</option>
				<option value="Lizard">Lizard</option>
				<option value="Material">Material</option>
				<option value="Relief">Relief</option>
				<option value="Semantic">Semantic</option>
				<option value="Topbar">Topbar</option>
				<option value="Tree">Tree</option>
				<option value="Whitespace">Whitespace</option>
				<option value="Wireframe">Wireframe</option>
             </select>
			 <p class="description" id="tagline-description">Design used to display the visualization with a specific aesthetics, including borders and styles, among other elements. For more info, please visit <a href="http://www.stockdio.com/motifs?wp=1" target="_blank">http://www.stockdio.com/motifs</a></p>
			 <script>document.getElementById("default_motif").value = "'.$this->options['default_motif'].'";</script>			 
			 ',
    		'default_motif'
    		);
    }
		
}

if( is_admin() )
    $stockdio_historical_chart_settings_page = new StockdioSettingsPage();

//Add the shortcode
add_shortcode( 'stockdio-historical-chart', 'stockdio_historical_chart_func' );

//widget
require_once( dirname(__FILE__) . "/stockdio_historical_chart_widget.php"); 

//Execute the shortcode with $atts arguments
function stockdio_historical_chart_func( $atts ) {
	//make array of arguments and give these arguments to the shortcode
    $a = shortcode_atts( array(
        'symbol' => '',
		'compare'=> '',
		'stockexchange' => '',
		'culture' => '',
		'displayprices' => '',
		'width'	=> '',
		'height'	=> '',	
		'font'	=> '',	
		'allowperiodchange' => '',
		'intraday' => '',
		'days' => '',
		'motif'	=> '',
		'palette'	=> '',
		'from'	=> '',
		'to'	=> '',
		'performance'	=> ''
    ), $atts );

    //create variables from arguments array
    extract($a);

	//assign settings values to $stockdio_historical_chart_options
  	$stockdio_historical_chart_options = get_option( 'stockdio_historical_chart_options' );
	
	//build the css style strings
  	$api_key = '';
	if (isset($stockdio_historical_chart_options['api_key']))
		$api_key = $stockdio_historical_chart_options['api_key'];

	$default_symbol ='';
	if (isset($stockdio_historical_chart_options['default_symbol']))
		$default_symbol = $stockdio_historical_chart_options['default_symbol'];
	
	$default_compare ='';
	if (isset($stockdio_historical_chart_options['default_compare']))
		$default_compare = $stockdio_historical_chart_options['default_compare'];
	
	
	$default_exchange='';
	if (isset($stockdio_historical_chart_options['default_exchange']))
		$default_exchange = $stockdio_historical_chart_options['default_exchange'];
	
	$default_culture='';
	if (isset($stockdio_historical_chart_options['default_culture']))
		$default_culture = $stockdio_historical_chart_options['default_culture'];
	
	$default_displayPrices='';
	if (isset($stockdio_historical_chart_options['default_displayPrices']))
		$default_displayPrices = $stockdio_historical_chart_options['default_displayPrices'];	
	
	$default_width = '';
	if (isset($stockdio_historical_chart_options['default_width']))
		$default_width = $stockdio_historical_chart_options['default_width'];
	
	$default_height = '';
	if (isset($stockdio_historical_chart_options['default_height']))
		$default_height = $stockdio_historical_chart_options['default_height'];
	
	$default_font = '';
	if (isset($stockdio_historical_chart_options['default_font']))
		$default_font = $stockdio_historical_chart_options['default_font'];
			
			
	$default_allowPeriodChange = "true";
	if ($stockdio_historical_chart_options['default_allowPeriodChange'] == 0 && $stockdio_historical_chart_options['allowPeriodChangeCheck']!= "") 
			$default_allowPeriodChange = "false";
		
	$default_intraday = "true";
	if ($stockdio_historical_chart_options['default_intraday'] == 0 && $stockdio_historical_chart_options['intradayCheck']!= "") 
			$default_intraday = "false";
	
	$default_performance = "true";
	if ($stockdio_historical_chart_options['default_performance'] == 0) 
			$default_performance = "false";
	

	$default_days = '';
	if (isset($stockdio_historical_chart_options['default_days'])) 
			$default_days = $stockdio_historical_chart_options['default_days'];			
	
	$default_motif = '';
	if (isset($stockdio_historical_chart_options['default_motif']))
		$default_motif = $stockdio_historical_chart_options['default_motif'];
	
	$default_palette = '';
	if (isset($stockdio_historical_chart_options['default_palette']))
		$default_palette = $stockdio_historical_chart_options['default_palette'];
	
	$extraSettings = '';
	
	
	if (empty($performance))
		$performance=$default_performance;
	
	if (empty($symbol))
		$symbol=$default_symbol;
	if (empty($symbol)!== TRUE)	{
		$extraSettings .= '&symbol='.urlencode($symbol);
	}
	
	$page="HistoricalPrices";
	if (empty($compare))
		$compare=$default_compare;
	if (!empty($compare)){
		$extraSettings .= '&compare='.$compare;
		$page="ComparePrices";
	}
	else{
		if ($performance == "true" || $performance ==1)
			$page="ComparePrices";
	}
	
	if (empty($stockexchange))
		$stockexchange =$default_exchange;
	if (!empty($stockexchange))
		$extraSettings .= '&stockExchange='.urlencode($stockexchange);
	
	if (empty($culture))
		$culture =$default_culture;
	if (!empty($culture))
		$extraSettings .= '&culture='.urlencode($culture);
	
	if (empty($displayprices))
		$displayprices =$default_displayPrices;
	if (!empty($displayprices))
		$extraSettings .= '&displayprices='.urlencode($displayprices);
	
	if (empty($symbol))
		$symbol=$default_symbol;
	
	if (empty($font))
		$font =$default_font;	
	
	if (empty($width))
		$width =$default_width;
	if (strpos($width, 'px') !== FALSE && strpos($width, '%') !== FALSE) 
		$width =$width.'px';
	if (empty($width))
		$width ='100%';
	$extraSettings .= '&width='.urlencode('100%');	
		
	if (empty($height))
		$height =$default_height;
	if (strpos($height, 'px') !== FALSE && strpos($height, '%') !== FALSE) 
		$height =$height.'px';
	if (empty($height))
		$height ='350px';
	$extraSettings .= '&height='.urlencode('100%');	
		
	if (empty($motif))
		$motif =$default_motif;		
	if (!empty($motif))
		$extraSettings .= '&motif='.urlencode($motif);
	
	if (empty($palette))
		$palette =$default_palette;
	if (!empty($palette))
		$extraSettings .= '&palette='.urlencode($palette);

	if (!empty($font))	
		$extraSettings .= '&font='.urlencode($font);	
	
	if (!empty($from)) 
		$extraSettings .= '&from='.urlencode($from);
		
	if (!empty($to)) 
		$extraSettings .= '&to='.urlencode($to);	
		
	if (empty($allowperiodchange))
		$allowperiodchange=$default_allowPeriodChange;
	
	if (empty($intraday))
		$intraday=$default_intraday;
	if ($intraday == "1")
		$intraday = 'true';
	if ($intraday == "0")
		$intraday = 'false';
	$extraSettings .= '&intraday='.$intraday;
	
	
	if (empty($days))
		$days=$default_days;
	
	if (!empty($days)) 
		$extraSettings .= '&days='.urlencode($days);
	
	if ($allowperiodchange == "1")
		$allowperiodchange = 'true';
	if ($allowperiodchange == "0")
		$allowperiodchange = 'false';
	
	if (!empty($from) && !empty($to))
		$allowperiodchange = 'false';
	
	
	$extraSettings .= '&allowPeriodChange='.urlencode($allowperiodchange);
	
	//$extraSettings .= '&test='.$stockdio_historical_chart_options['default_allowPeriodChange'];
	
  	//make main html output  	
	$output = '<iframe frameBorder="0" scrolling="no" width="'.$width.'" height="'.$height.'" src="https://api.stockdio.com/visualization/financial/charts/v1/'.$page.'?app-key='.$api_key.'&wp=1&showUserMenu=false'.$extraSettings.'"></iframe>';  	

  	//return completed string
  	return $output;

}	

    /** 
     * ShortCode editor button
     */
	function register_button( $buttons ) {
		if (!in_array("stockdio_charts_button", $buttons)) {
			array_push( $buttons, "|", "stockdio_charts_button" );
		}
	   return $buttons;
	}	 
	function add_plugin( $plugin_array ) {
		if (!array_key_exists("stockdio_charts_button", $plugin_array)) {
			$plugin_data = get_plugin_data( __FILE__ );
			$plugin_version = $plugin_data['Version'];
			$plugin_array['stockdio_charts_button'] = plugin_dir_url( __FILE__ ).'assets/stockdio-charts-shortcode.js?ver='.$plugin_version;
			add_filter( 'mce_buttons', 'register_button' );	  
			
		}
	   return $plugin_array;
	}	
	function stockdio_charts_button() {
	   if ( current_user_can('edit_posts') && current_user_can('edit_pages') ) {
		  add_filter( 'mce_external_plugins', 'add_plugin' );		  		  
	   }
	}	
    /**
     * Intialize global variables
     */
    function stockdio_js(){ 
	$options = get_option( 'stockdio_historical_chart_options' );
	?>
		<script>
			var stockdio_historical_charts_settings = <?php echo json_encode( $options ); ?>;	
			jQuery(function () {
				
				setDefaultValue = function(o,n,v){
					if (typeof o == 'undefined' || o[n]==null || o[n]=='')
						o[n] = v;
				}				
				setDefaultValue(stockdio_historical_charts_settings,"default_height", '350px');
				setDefaultValue(stockdio_historical_charts_settings, "default_width", '');
				setDefaultValue(stockdio_historical_charts_settings, "default_days", '');
				setDefaultValue(stockdio_historical_charts_settings, "default_displayPrices", 'Lines');
				
				
				
				if (pagenow == "settings_page_stockdio-historical-chart-settings-config") {
					jQuery("#a_show_appkey_input").click(function(e){ 
						e.preventDefault();
						jQuery(".stockdio_register_mode").hide();
						jQuery(".stockdio_historical_chart_form").show();
					});
					jQuery("#a_show_register_form").click(function(e){ 
						e.preventDefault();
						jQuery(".stockdio_register_mode").show();
						jQuery(".stockdio_historical_chart_form").hide();
					});				
					var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
					var eventer = window[eventMethod];
					var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

					// Listen to message from child window
					eventer(messageEvent, function (e) {
						if (typeof e != 'undefined' && typeof e.data != 'undefined' && e.data != ""&& e.data.length == 32) {
							jQuery("#api_key").val(e.data);
							jQuery("#submit").click();
						}
					}, false);
					
					if (jQuery("#api_key").val()== ""){					
						if (typeof stockdio_ticker_settings != 'undefined' && typeof stockdio_ticker_settings.api_key != 'undefined' && stockdio_ticker_settings.api_key != "") {
							jQuery("#api_key").val(stockdio_ticker_settings.api_key);
							jQuery("#a_show_appkey_input").click();
						}
						else{
							if (typeof stockdio_quotes_board_settings  != 'undefined' && typeof stockdio_quotes_board_settings.api_key != 'undefined' && stockdio_quotes_board_settings.api_key != "") {
								jQuery("#api_key").val(stockdio_quotes_board_settings.api_key);
								jQuery("#a_show_appkey_input").click();
							}
							else{
								if (typeof stockdio_news_board_settings != 'undefined' && typeof stockdio_news_board_settings.api_key != 'undefined' && stockdio_news_board_settings.api_key != "") {
									jQuery("#api_key").val(stockdio_news_board_settings.api_key);
									jQuery("#a_show_appkey_input").click();
								}
								else{
									if (typeof stockdio_market_overview_settings != 'undefined' && typeof stockdio_market_overview_settings.api_key != 'undefined' && stockdio_market_overview_settings.api_key != "") {
										jQuery("#api_key").val(stockdio_market_overview_settings.api_key);
										jQuery("#a_show_appkey_input").click();
									}
									else{
										
									}									
								}								
							}
						}
					}
				}
			});		
			var stockdio_global_checker=1;
			var stockdio_historical=1;
			
		</script><?php
	}
	
	//register_activation_hook(__FILE__, 'my_plugin_activate');
	//add_action('admin_init', 'my_plugin_redirect');
	 
	function my_plugin_activate() {
		add_option('my_plugin_do_activation_redirect', true);
	}
	 
	function my_plugin_redirect() {
		if (get_option('my_plugin_do_activation_redirect', false)) {
			delete_option('my_plugin_do_activation_redirect');
			if(!isset($_GET['activate-multi']))
			{
				wp_redirect("options-general.php?page=stockdio-historical-chart-settings-config");
			}
		}
	}
?>
