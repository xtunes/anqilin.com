<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
$ajax=$_REQUEST['ajax'];
if($ajax!=1){
get_header(); ?>
		<div class="main">
			<div class="thumbnails">
<?php } ?>
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
				  <?php if ($current>1): ?>
					  <a href="<?php echo $base.($current-1) ?>" rel="paginate">Previous</a>				    
				  <?php endif ?>
          <?php if ($current<$total): ?>
            <a href="<?php echo $base.($current+1) ?>" rel="paginate">Next</a>
          <?php endif ?>
				</div>
				<div class="clear"></div>
<?php if($ajax!=1){ ?>
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

  		$q(function(){
        
        $q("a[rel='preview']").live('click',function(e){
          $q('.picviewer').html('<p class="loading">loading...</p>');
          link=$q(this);
          $q('.picviewer').load(link.attr('href'),{ajax:1});
          return false;
        });
        
        $q("a[rel='paginate']").live('click',function(e){
          $q('.thumbnails').html('<p class="loading">loading...</p>');
          link=$q(this);
          $q('.thumbnails').load(link.attr('href'),{ajax:1});
          return false;
        });
  		});
  		
  	</script>

<?php get_footer(); }?>
