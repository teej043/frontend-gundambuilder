<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package gndmbldr
 */
?>


        </main><!--- /MAIN ---->

        <div style="clear:both;"></div>

        <!--- FOOOTER ---->
        <footer id="colophon" class="gb-foot site-footer" role="contentinfo">
            <?php get_sidebar( 'footer' ); ?>
            <div class="site-info">
                <?php //do_action( 'twentyfourteen_credits' ); ?>
                <a style="display:none;" href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyfourteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentyfourteen' ), 'WordPress' ); ?></a>
                <img src="<?php bloginfo('stylesheet_directory'); ?>/images/img-site-footer.png" height="40" />
            </div><!-- .site-info -->
        </footer><!--- /FOOTER ---->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="<?php bloginfo('stylesheet_directory'); ?>/js/pkgd-main-deps.min.js"></script>


    </div><!-- #page -->

	<?php
	$brwsr = $_SERVER["HTTP_USER_AGENT"];
	//echo(strpos($brwsr,'MSIE 9.0'));
	if (( strpos($brwsr, 'MSIE 7') != false ) || ( strpos($brwsr, 'MSIE 8') != false )) {

	?>
	<div id="old-browser" style="position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:99999;background:#ccc;">
	<div style="position:fixed;margin-left:-300px;left:50%;width:600px;height:500px;z-index:999;top:50px;background:#fff;text-align:left;border:1px #aaa solid;">
		<p style="font-family:Arial,sans-serif;padding:15px;">
			Dear visitor,<br /><br />
			I regret to inform you that you are using an old browser that is no longer supported by this site. As a lone developer of this site I urge you to upgrade or use a newer browser because additional time and effort just to support this old browser is costly. If you want to learn how and where to get a better browser please visit this site <a href="http://browsingbetter.com/" target="_blank">http://browsingbetter.com</a>. Thank you very much.<br /><br />
			GundamBuilder.com
		</p>
	</div>
	</div>
	<?php } ?>


    <?php wp_footer(); ?>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-52510012-1', 'auto');
	  ga('send', 'pageview');

	</script>
</body>
</html>
