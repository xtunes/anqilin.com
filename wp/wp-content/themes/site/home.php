<?php

/**
 * Template Name: 首页

 */

get_header(); ?>

			<div class="main">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; // end of the loop. ?>
			</div>
			<div id="musicplayer"></div>
<script type='text/javascript'>

 
 jQuery(function(){
jwplayer('musicplayer').setup({
  flashplayer: '/jwplayer/player.swf',
  file: '/music/1.mp3',
  height: 1,
  width: 1,
  autoplay:true,
  events: {
  	onReady:function(){
  		jQuery('#musicplayer_wrapper').css('margin-left','-9999px')
  	}	
  }
 }); 
	jQuery('.music-play').hide();
 	jQuery('.music-stop').click(function(){
 		jwplayer('musicplayer').play();
 		jQuery(this).hide();
 		jQuery('.music-play').show();
 	});
 	
 	jQuery('.music-play').click(function(){
 		jwplayer('musicplayer').play();
 		jQuery(this).hide();
 		jQuery('.music-stop').show();
 	});
 });
</script>

<?php get_footer(); ?>
