<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trw
 */

?>
  
  <section id="about">
    <div class="wrap">
      <?php trw_get_about(); ?>
    </div>
  </section>

  <footer id="footer">
    <div class="color-buttons">
      <div class="black"></div>
      <div class="white"></div>
    </div>
  </footer>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
