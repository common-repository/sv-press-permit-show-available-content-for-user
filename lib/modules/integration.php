<?php
	/**
	 * @author			Matthias Reuter
	 * @package			sv_pp_sacfu
	 * @copyright		2016 Matthias Reuter
	 * @link			https://straightvisions.com
	 * @since			1.0
	 * @license			This is no free software. See license.txt or https://straightvisions.com
	 */
	class sv_pp_integration extends sv_pp_sacfu{
		public $core													= NULL;
		private $groups													= array();
		private $exceptions												= array();
		private $items													= array();
		
		/**
		 * @desc			Loads other classes of package
		 * @author			Matthias Reuter
		 * @since			1.0
		 * @ignore
		 */
		public function __construct($core){
			$this->core													= isset($core->core) ? $core->core : $core; // loads common classes
		}
		/**
		 * @desc			get groups for current user
		 * @return	array	user groups
		 * @author			Matthias Reuter
		 * @since			1.0
		 */
		public function get_current_user_groups(){
			global $wpdb;
			
			$groups														= $wpdb->get_results('SELECT group_id FROM '.$wpdb->prefix.'pp_group_members WHERE user_id="'.get_current_user_id().'"', ARRAY_A);

			foreach($groups as $group){
				$this->groups[$group['group_id']]						= $group['group_id'];
			}
			
			return $this->groups;
		}
		/**
		 * @desc			get exceptions for user groups (agents)
		 * @return	void
		 * @author			Matthias Reuter
		 * @since			1.0
		 */
		public function get_exceptions_for_user_groups($group_id){
			global $wpdb;
			
			$query														= 'SELECT exception_id FROM '.$wpdb->prefix.'ppc_exceptions WHERE for_item_type IN ("page", "post") AND mod_type="additional" AND agent_id IN('.implode($this->get_current_user_groups(),',').')';
			$exceptions													= $wpdb->get_results($query, ARRAY_A);
			
			foreach($exceptions as $exception){
				$this->exceptions[$exception['exception_id']]			= $exception['exception_id'];
			}
		}
		/**
		 * @desc			get items for exceptions
		 * @return	void
		 * @author			Matthias Reuter
		 * @since			1.0
		 */
		public function get_items_for_exceptions($exception_id){
			global $wpdb;
			
			$query														= 'SELECT item_id FROM '.$wpdb->prefix.'ppc_exception_items WHERE exception_id IN('.implode($this->exceptions,',').') AND assign_for="item"';
			$items														= $wpdb->get_results($query, ARRAY_A);
			
			foreach($items as $item){
				$this->items[$item['item_id']]							= $item['item_id'];
			}
		}
		/**
		 * @desc			get content accessible for current user
		 * @return	array	content IDs
		 * @author			Matthias Reuter
		 * @since			1.0
		 */
		public function get_content_for_current_user(){
			$this->get_exceptions_for_user_groups();
			$this->get_items_for_exceptions();
			
			return $this->items;
		}
	}
?>