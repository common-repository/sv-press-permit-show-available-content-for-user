<?php
	/*
	Plugin Name: SV Press Permit Show Available Content for User
	Plugin URI: https://straightvisions.com/
	Description: Lists hidden content which has view permissions for current logged in user by Press Permit
	Version: 1.0.0
	Author: Matthias Reuter
	Author URI: https://straightvisions.com
	Text Domain: sv_pp_sacfu
	License: GPL3
	License URI: https://www.gnu.org/licenses/gpl-3.0.html
	*/

	class sv_pp_sacfu{
		public $basename							= NULL;
		public $path								= NULL;
		public $url									= NULL;
		public $version								= 1000;
		/**
		 * @desc			Load's requested libraries dynamicly
		 * @param	string	$name library-name
		 * @return			class object of the requested library
		 * @author			Matthias Reuter
		 * @since			1.0
		 * @ignore
		 */
		public function __get($name){
			if(file_exists($this->path.'lib/modules/'.$name.'.php')){
				require_once($this->path.'lib/modules/'.$name.'.php');
				$classname							= 'sv_pp_'.$name;
				$this->$name						= new $classname($this);
				return $this->$name;
			}else{
				throw new Exception('Class '.$name.' could not be loaded (tried to load class-file '.$this->path.'lib/'.$name.'.php'.')');
			}
		}
		/**
		 * @desc			initialize plugin
		 * @author			Matthias Reuter
		 * @since			1.0
		 * @ignore
		 */
		public function __construct(){
			$this->basename							= plugin_basename(__FILE__);
			$this->path								= trailingslashit(WP_PLUGIN_DIR.'/'.dirname($this->basename));
			$this->url								= trailingslashit(plugins_url( '' , __FILE__ ));
			
			// language settings
			load_textdomain('sv_pp_sacfu', WP_LANG_DIR.'/plugins/sv_pp_sacfu-'.apply_filters('plugin_locale', get_locale(), 'sv_pp_sacfu').'.mo');
			load_plugin_textdomain('sv_pp_sacfu', false, dirname($this->basename).'/lib/assets/lang/');
			
			//$this->settings->init();				// load settings
			$this->hooks->init();					// load hooks
		}
	}

	$GLOBALS['plugin_sv_pp_sacfu']					= new sv_pp_sacfu();
?>