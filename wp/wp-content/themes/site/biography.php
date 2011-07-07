<?php
/**
 * Template Name: biography

 */

get_header(); ?>

			<div class="main">
				<div class="personpic">
					<?php the_post_thumbnail('full');?>
				</div>
				<div class="personintro" id="scroll-pane">
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
				<a class="arrow-up" href="#"><img src="/images/arrow-up.gif"/></a>
				<a class="arrow-down" href="#"><img src="/images/arrow-down.gif"/></a>
			</div>
<script type="text/javascript" charset="utf-8">
	function scrollUp(){
		jQuery('#scroll-pane').scrollTop(jQuery('#scroll-pane').scrollTop()-1);
	}
	
	function scrollDown(){
		var s = jQuery('#scroll-pane').scrollTop();
		jQuery('#scroll-pane').scrollTop(s+1);
	}

	jQuery(function(){
		var top=jQuery('#scroll-pane').scrollTop();
		if(top>0){
			scrollUp();
		}else{
			scrollDown();
		}
		if(top==jQuery('#scroll-pane').scrollTop()){
			jQuery('.arrow-up').hide();
			jQuery('.arrow-down').hide();
		}else{
			jQuery('.arrow-up').mousedown(function(e){
			e.preventDefault();
			e.stopPropagation();
			var handler = setInterval(scrollUp,10);
			jQuery(document).mouseup(function(){
				jQuery(document).unbind('mousedown');
				clearInterval(handler);
			});
			});
			jQuery('.arrow-down').mousedown(function(e){
				e.preventDefault();
				e.stopPropagation();
				var handler = setInterval(scrollDown,10);
				jQuery(document).mouseup(function(){
					jQuery(document).unbind('mousedown');
					clearInterval(handler);
				});
			});
		}
		
		jQuery('.arrow-up').click(function(e){
			e.preventDefault();
			// e.stopPropagation();
		});
		jQuery('.arrow-down').click(function(e){
			e.preventDefault();
			// e.stopPropagation();
		});
	});
</script>
<?php get_footer(); ?>
