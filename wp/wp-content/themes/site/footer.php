<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<div class="clear"></div>
<div class="footer">
	<div class="follow">
			<span>FOLLOW ME AT</span>
			<a href="http://weibo.com/princeangel"><img src="/images/weibo.png" alt="新浪微博"></a>
			<a href="http://www.facebook.com/Angelino.lin"><img src="/images/Facebook-Logo.png" alt="facebook"></a>
			<a href="http://www.twitter.com/AnqiLin"><img src="/images/twitter.png" alt="twitter"></a>
		</div>
				<p class="bold">Background Music: J’ai Peur - Heart Demon</p>
				<p>Lyric: Hong xi ying</p>
				<p>rearragnment and voice: Anqi LIN</p>
				<p>Origin track: Goldie</p>
				<p class="music-stop">Turn off</p>
				<p class="music-play">Turn on</p>
				<div class="copyright">
					<p class="bold">WEB IMAGE AND DESIGN BY anqi.LIN, all copyrights reserved,2011</p>
					<p class="bold">Webmaster by XTUNES</p>				
				</div>
					
			</div>
		</div>
</div>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>
