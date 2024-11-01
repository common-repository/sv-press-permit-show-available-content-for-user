<div class="SV_PP_wrapper">
<?php
	foreach($content_IDs as $content_ID){
		$post			= get_post($content_ID);
?>
	<div class="SV_PP_item">
		<div class="SV_PP_item_title"><a href="<?php echo get_permalink($post); ?>" title="<?php the_title_attribute(array('post' => $post)); ?>"><?php echo $post->post_title; ?></a></div>
	</div>
<?php } ?>
</div>