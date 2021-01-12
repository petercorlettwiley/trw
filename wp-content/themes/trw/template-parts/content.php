<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trw
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( !is_singular() ) : // archive and home view ?>

		<a class="post-link-wrap" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">

		<?php
		the_title( '<div class="rotate-90"><h2 class="entry-title">', '</h2></div>' );
		trw_post_thumbnail();
		?>

		</a>

	<?php else : // single post view ?>

	<div class="post-text-wrap">

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	
		<div class="entry-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'trw' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			?>
		</div><!-- .entry-content -->

	</div><!--  .post-text-wrap -->

	<div class="entry-media">

		<?php trw_show_media( get_the_ID(), 'full', 'all' ); ?>
		
	</div>

	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
