<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package trw
 */

if ( ! function_exists( 'trw_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function trw_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'trw' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'trw_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function trw_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'trw' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'trw_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function trw_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'trw' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'trw' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'trw' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'trw' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'trw' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'trw' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'trw_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function trw_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}
		?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div><!-- .post-thumbnail -->

		<?php
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

if ( ! function_exists( 'trw_get_media' ) ) :
	/**
	 * Returns media for any given post
	 */
	function trw_get_media( $id ) {

		if ( !$id ) {
			return false;
		}

		$media = get_field( 'media', $id );

		if ( !$media ) {
			return false;

		} else {

			foreach( $media as $media_item ) {
				$file = $media_item['file'];
				$media_files[] = $file;
			}
		}

		return $media_files;
	}
endif;

if ( ! function_exists( 'trw_show_media' ) ) :
	/**
	 * Returns gallery of media for any given post
	 */
	function trw_show_media( $id, $size = 'full', $select = 'all' ) {

		$media = trw_get_media( $id );

		if ( !$media ) {
			return false;
		}

		$media_count = count( $media );
		$media_markup = '<div class="media-gallery count-' . $media_count . '">';

		if ( $select == 'all' ) {

			foreach( $media as $media_number=>$media_item ) {
				$type = $media_item['type'];
				$src = $media_item['url'];
				$alt = ($media_item['alt'] ? $media_item['alt'] : ' ');
				$width = $media_item['width'];
				$height = $media_item['height'];
				$number = $media_number;

				if ( $type == 'image' ) {
					$media_markup .= '<div class="media-item image" id="media-' . $number . '"><img src="' . $src . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '"><div class="media-counter rotate-90"><span>' . intval($number+1) . ' of ' . $media_count . '</span></div></div>';
				}
			}
		}

		$media_markup .= '</div>';

		echo $media_markup;
	}
endif;

if ( ! function_exists( 'trw_media_nav' ) ) :
	/**
	 * Displays prev/next buttons for gallery images
	 */
	function trw_media_nav() {
		?>
		<a href="#prev" class="prev"></a>
		<a href="#next" class="next"></a>
		<?php
	}
endif;

if ( ! function_exists( 'trw_get_about' ) ) :
	/**
	 * Displays about page content
	 */
	function trw_get_about() {

		$about_content = get_field('about_content', 'options');
		$contact_email = get_field('contact_email', 'options');
		$instagram_link = get_field('instagram_link', 'options');

		?>

		<a href="#about-close" id="aboutClose">X</a>

		<a href="mailto:<?php echo $contact_email; ?>" id="contact">contact</a>

		<div class="about-content">
			<?php echo $about_content; ?>
		</div>

		<a href="mailto:<?php echo $instagram_link; ?>" id="instagram">instagram</a>

		<?php
	}
endif;
