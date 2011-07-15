<?php 
   $postid = $post->ID;
   $imageid = get_post_meta($postid,'image',true);
   $videoid = get_post_meta($postid,'video',true);
   $previewurl = wp_get_attachment_image_src($imageid, 'preview');
   $fullurl = wp_get_attachment_image_src($imageid, 'full');
   if(!empty($videoid)){
     $video = wp_get_attachment_url($videoid);
   }
   
   if(!empty($previewurl)){
     $previewurl = $previewurl[0];
     $fullurl = $fullurl[0];
   }
   ?>
<h1><?php the_title()?></h1>
<div class="pic">
	<a href="#" rel="full" title="<?php the_title() ?>"><img class="preview-image" src="<?php echo $previewurl; ?>"/></a>

	<div class="zoom">
	<a class="arrow-left" href="#"><img src="/images/arrow-left.gif"></a>
	<a href="#" class="clickzoom" rel="full">Click zoom</a>
	<a class="arrow-right" href="#"><img src="/images/arrow-right.gif"></a>
</div>
</div>
<!-- preload-full-image -->
<img style="margin-top:-100000px;margin-left:-100000px;width:1px;height:1px" class="portfolio-fullimage" src="<?php echo $fullurl ?>"/>
<?php if (isset($video)): ?>
  <div style="display:none" class= "portfolio-video"><?php echo $video ?></div>
<?php endif ?>
<div style="display:none" class="portfolio-description">
  <?php the_content() ?>
</div>
