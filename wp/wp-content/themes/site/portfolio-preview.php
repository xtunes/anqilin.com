<?php 
   $postid = $post->ID;
   $imageid = get_post_meta($postid,'image',true);
   $previewurl = wp_get_attachment_image_src($imageid, 'preview');
   $fullurl = wp_get_attachment_image_src($imageid, 'full');
   if(!empty($previewurl)){
     $previewurl = $previewurl[0];
     $fullurl = $fullurl[0];
   }
   ?>
<h1><?php the_title()?></h1>
<div class="pic">
	<a href="<?php echo $fullurl ?>" rel="full" title="<?php the_title() ?>"><img src="<?php echo $previewurl; ?>"/></a>
	<div style="display:none" class="portfolio-description">
	  <?php the_content() ?>
	</div>
	<div class="zoom">
	<a class="arrow-left" href="#"><img src="/images/arrow-left.gif"></a>
	<p>Click zoom</p>
	<a class="arrow-right" href="#"><img src="/images/arrow-right.gif"></a>
</div>
</div>