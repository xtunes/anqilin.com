<?php
/**
 * The template for displaying all portfolios.
 *
 *
 * @package WordPress
 * @subpackage Anqilin.com
 */
$ajax=$_REQUEST['ajax'];
while ( have_posts() ) : the_post();
endwhile;
if($ajax!=1){
  get_header();?>
		<div class="main">
			<div class="picviewer">
	      <?php include('portfolio-preview.php') ?>
			</div>
			<div class="clear"></div>
		</div>
<?php get_footer(); 
}else{
  include('portfolio-preview.php');
}?>