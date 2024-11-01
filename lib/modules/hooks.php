<?php
	/**
	 * @author			Matthias Reuter
	 * @package			sv_swagger4wp
	 * @copyright		2016 Matthias Reuter
	 * @link			https://straightvisions.com
	 * @since			1.0
	 * @license			This is no free software. See license.txt or https://straightvisions.com
	 */
	class sv_pp_hooks extends sv_pp_sacfu{
		public $core					= NULL;
		
		/**
		 * @desc			Loads other classes of package
		 * @author			Matthias Reuter
		 * @since			1.0
		 * @ignore
		 */
		public function __construct($core){
			$this->core					= isset($core->core) ? $core->core : $core; // loads common classes
		}
		/**
		 * @desc			initialize actions and filters
		 * @return	void
		 * @author			Matthias Reuter
		 * @since			1.0
		 */
		public function init(){
			$this->actions();
			$this->filters();
		}
		/**
		 * @desc			initialize actions
		 * @return	void
		 * @author			Matthias Reuter
		 * @since			1.0
		 */
		public function actions(){
			add_action('widgets_init', array($this,'widgets'));
		}
		/**
		 * @desc			initialize filters
		 * @return	void
		 * @author			Matthias Reuter
		 * @since			1.0
		 */
		public function filters(){

		}
		/**
		 * @desc			initialize widgets
		 * @return	void
		 * @author			Matthias Reuter
		 * @since			1.0
		 */
		public function widgets(){
			require_once($this->core->path.'lib/modules/widgets.php');
			register_widget('SV_PP_ShowAvailableContentForUser');
		}
	}
?>