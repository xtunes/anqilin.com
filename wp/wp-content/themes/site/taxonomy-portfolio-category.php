<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
$ajax=$_REQUEST['ajax'];
if($ajax!=1):
get_header(); ?>
		<div class="main">
			<div class="thumbnails">
<?php endif ?>
				<ul>
				  <?php
				    $count=0;
				    //query_posts("posts_per_page=12&paged=".get_query_var('page'));
				    if ( have_posts() ) : while ( have_posts() ) : the_post();
             if($count==0){
               $first=$post;
               $count++;
             }
             /****************************************************************************************************
                http://wordpress.org/support/topic/plugin-custom-field-template-use-media-picker-and-output-image 
             *****************************************************************************************************/
             $postid = $post->ID;
             $imageid = get_post_meta($postid,'image',true);
             $imageurl = wp_get_attachment_image_src($imageid, 'icon');
             if(empty($imageurl)){
               $imageurl = "/images/thumb.gif";
             }else{
               $imageurl = $imageurl[0];
             }
             ?>
                <li id="design-<?php echo the_ID() ?>"><a href="<?php the_permalink() ?>" rel="preview" title="<?php the_title() ?>"><img src="<?php echo $imageurl; ?>"/></a></li>
             <?php
            endwhile;
            endif;
				  ?>
				</ul>
				<div class="pagenavi">
				  <?php
				    global $wp_query, $wp_rewrite;
            $wp_query -> query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
				    $total=$wp_query->max_num_pages;
            if( $wp_rewrite->using_permalinks() )
              $base = user_trailingslashit( trailingslashit(remove_query_arg( 'ajax', get_pagenum_link( 1 ) ) ) . 'page/', 'paged' );
            // $base = add_query_arg('page','%#%');
            // fb($base);
            // fb($total);
				  ?>
				  
					  <a <?php if ($current<=1) echo 'style="visibility:hidden"' ?> href="<?php echo $base.($current-1) ?>" rel="paginate">Previous</a>				    
            <a <?php if ($current>=$total) echo 'style="visibility:hidden"' ?> href="<?php echo $base.($current+1) ?>" rel="paginate">Next</a>
				</div>
				<div class="clear"></div>
<?php if($ajax!=1): ?>
			</div>
			<div class="picviewer">
			  <?php
			    if(!empty($post)){
			     $post = $first;
			     include 'portfolio-preview.php';
			    }
			  ?>
			<div class="clear"></div>
		</div>
  	<script type="text/javascript" charset="utf-8">
      $q=jQuery.noConflict();
      $currentThumb=null;
      
      function showPreview(thumblink){
        if(thumblink.length==0)
          return;
        
        $q('.picviewer').html('<p class="loading">loading...</p>');
        $q('.picviewer').load(thumblink.attr('href'),{ajax:1});
        
        if($currentThumb){
          $currentThumb.parent().removeClass('current');
        }
        $currentThumb = thumblink;
        $currentThumb.parent().addClass('current');
      }
      
      
      function showDetail(){
        var w = $q(window).width();
        var left = Math.max(0,(w-$q('.imgbox').width())/2);
        $q('.imgbox').css('left',left);
        $q('a[rel="image"]').attr('rel','video').text('-VIDEO');
        
        var desc="<h1>"+$q('a[rel="full"]').attr('title')+"</h1>"
        desc+=$q('.portfolio-description').html();
        $q('.imgintro').html(desc);
        $q('.fullimg img').attr('src',$q('.portfolio-fullimage').attr('src'));
        $q('.outerwrap').css('margin-left',0);
        $q('.imgintro').hide();
        
        //reset detail box
        
        video= $q('.portfolio-video');
        if(video.length>0){
          var url = video.text();
          jwplayer('videoplayer').setup({
  				  flashplayer: '/jwplayer/player.swf',
  				  height: 538,
  				  width: 701
  				});
          jwplayer('videoplayer').load([{file: url }]);
          $q('a[rel="video"]').show();
        }
        else{
          $q('a[rel="video"]').hide();
        }
        
        $q('.overlay').fadeIn();
        $q('.imgbox').fadeIn();
      }
      
      var $dx;
      var $dy;
      var $zw;
      var $zh;
      var $zo;
      var $zoomBox;

      function toggleZoom(img){
			  var container=img.parent();
			  var mw=container.width();
			  var mh=container.height();
			  			  
        if(img.attr('style')!=''){
          img.attr('style','');
          var w=img.width();
  			  var h=img.height();
  			  $zoomBox=img.parent();
  			  $zw=mw;
  			  $zh=mh;
          $dx=Math.max(0,w-$zw);
          $dy=Math.max(0,h-$zh);
          $zoomBox=container;
  			  $zo=$zoomBox.offset();
          $zoomBox.mousemove(zoomMove);
          return;
        }
        
        var w=img.width();
			  var h=img.height();



			  if(w>mw || h>mh){
			    if(w/h>mw/mh){
			      img.width(mw);
			    }else{
			      img.height(mh);
			    }
			    $q('a[rel="zoom"]').show();
			  }else{
			    $q('a[rel="zoom"]').hide();
			  }
			  container.scrollLeft(0).scrollTop(0).unbind('mousemove');
			  $dx=$dy=0;
      }
      
      function zoomMove(e){
        var sl=(e.pageX-$zo.left)/$zw*$dx;
        var st=(e.pageY-$zo.top)/$zh*$dy;
        $zoomBox.scrollLeft(sl);
        $zoomBox.scrollTop(st);
      }

    	$q(function(){
        $currentThumb = $q("a[rel='preview']").first();
        $currentThumb.parent().addClass('current');
        
        $q("a[rel='preview']").live('click',function(e){
          showPreview($q(this));
          return false;
        });

        $q("a[rel='paginate']").live('click',function(e){
          $q('.thumbnails').html('<p class="loading">loading...</p>');
          link=$q(this);
          $q('.thumbnails').load(link.attr('href'),{ajax:1});
          return false;
        });

        $q("a[rel='full']").live('click',function(e){
          showDetail();
          return false;
        });
        
        $q("a.arrow-left").live('click',function(e){
          showPreview($currentThumb.parent().prev().children().first());
          return false;
        });
        
        $q("a.arrow-right").live('click',function(e){
          showPreview($currentThumb.parent().next().children().first());
          return false;
        });
        
        $q('.overlay').live('click',function(){
          
          $q('.overlay').fadeOut();
          $q('.imgbox').fadeOut();
          var video = $q('#videoplayer-wrapper');
          if(video.length>0){
            video.remove();
            $q('#imgwrap').insertAfter($q('<div id="videoplayer"></div>'));
          }
          
        });
        
        $q('a[rel="video"]').live('click',function(){
          $q('.outerwrap').stop().animate({'margin-left':-1*$q('#imgwrap').width()});
          $q(this).attr('rel','image').text('-PHOTO');
          return false;
        });
        
        $q('a[rel="image"]').live('click',function(){
          $q('.outerwrap').stop().animate({'margin-left':0});
          $q(this).attr('rel','video').text('-VIDEO');
          jwplayer('videoplayer').stop();
          return false;
        });
        
        $q('a[rel="info"]').live('click',function(){
          $q('.imgintro').toggle();
          return false;
        });
        
        $q('a[rel="zoom"]').live('click',function(){
          toggleZoom($q('#imgwrap img'));
          return false;
        });
        
        
        var html_str="";
        html_str+='<div class="overlay" style="width:'+$q(document).width()+'px;height:'+$q(document).height()+'px;"></div>';
        html_str+='<div class="imgbox">';
        html_str+='		<div class="fullimg">';
        html_str+='			<div class="outerwrap">';
        html_str+='			<div id="imgwrap">';
        html_str+='				  <img/>';
        html_str+='			</div>';
        html_str+='			<div id="videoplayer">';
        html_str+='			</div>';
        html_str+='			</div> ';
        html_str+='			<div class="clear"></div>				';
        html_str+='			<div style="text-align:center;">';
        html_str+='				<a rel="info" href="#">INFO</a>';
        html_str+='				<a rel="zoom" href="#">-ZOOM</a>';
        html_str+='				<a rel="video" href="#">-VIDEO</a>';
        html_str+='			</div>';
        html_str+='		</div>';
        html_str+='		<div class="imgintro"></div>';
        html_str+='		<div class="clear"></div> 		';
        html_str+='</div>';
        $q('body').append($q(html_str));
				
        $q('#imgwrap img').load(function(){
          var img=$q(this);
   			  img.attr('style','');
   			  $q('#imgwrap').scrollLeft(0).scrollTop(0).unbind('mousemove');
          toggleZoom(img);
        }).mousedown(function(){return false})
        .mouseup(function(){return false});
        ;
 
        
    	});
    </script>

<?php get_footer(); 
endif
?>
