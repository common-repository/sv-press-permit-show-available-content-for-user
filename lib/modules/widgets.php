<?php
	class SV_PP_ShowAvailableContentForUser extends WP_Widget{
		function __construct(){
			// Instantiate the parent object
			parent::__construct(false, __('SV PP Show Available Content for User','sv_pp_sacfu'));
		}

		function widget($args, $instance){
			$content_IDs					= $GLOBALS['plugin_sv_pp_sacfu']->integration->get_content_for_current_user();
			
			include($GLOBALS['plugin_sv_pp_sacfu']->path.'lib/tpl/SV_PP_ShowAvailableContentForUser.php');
		}

		function update($new_instance, $old_instance){
			// Save widget options
		}

		function form($instance){
			// Output admin widget options form
		}
	}
	
	function SV_PP_ShowAvailableContentForUser_shortcode($atts){
		ob_start();
		the_widget('SV_PP_ShowAvailableContentForUser', $atts, array('widget_id'=>'arbitrary-instance-'.$id,
			'before_widget'					=> '',
			'after_widget'					=> '',
			'before_title'					=> '',
			'after_title'					=> ''
		));
		$output								= ob_get_contents();
		ob_end_clean();
		
		return $output;
	}
	add_shortcode('sv_pp_sacfu','SV_PP_ShowAvailableContentForUser_shortcode'); 
?>