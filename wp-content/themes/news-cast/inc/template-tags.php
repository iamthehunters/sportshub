<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package News Cast
 * @since 1.0.0
 */

if ( ! function_exists( 'news_cast_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function news_cast_posted_on() {
		$post_date_prefix_string = esc_html__( 'Posted on ', 'news-cast' );
		if( is_archive() || is_search() || is_home() ) {
			$archive_post_date_option = get_theme_mod( 'archive_post_date_option', true );
			if( ! $archive_post_date_option ) {
				return;
			}
			$post_date_prefix_string = get_theme_mod( 'archive_post_date_prefix_string', esc_html__( 'Posted on ', 'news-cast' ) );
		} else if( is_single() ) {
			$single_post_date_option = get_theme_mod( 'single_post_date_option', true );
			if( ! $single_post_date_option ) {
				return;
			}
			$post_date_prefix_string = get_theme_mod( 'single_post_date_prefix_string', esc_html__( 'Posted on ', 'news-cast' ) );
		}
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
			esc_html_x( '%1$1s %2$1s', 'post date', 'news-cast' ),
			esc_html( $post_date_prefix_string ), '<a href="' . esc_url( get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ) ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="bmm-post-date bmm-post-meta-item">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'news_cast_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function news_cast_posted_by() {
		$post_author_prefix_string = esc_html__( 'By ', 'news-cast' );
		if( is_archive() || is_search() || is_home() ) {
			$archive_post_author_option = get_theme_mod( 'archive_post_author_option', true );
			if( ! $archive_post_author_option ) {
				return;
			}
			$post_author_prefix_string = get_theme_mod( 'archive_post_author_prefix_string', esc_html__( 'Posted by: ', 'news-cast' ) );
		} else if( is_single() ) {
			$single_post_author_option = get_theme_mod( 'single_post_author_option', true );
			if( ! $single_post_author_option ) {
				return;
			}
			$post_author_prefix_string = get_theme_mod( 'single_post_author_prefix_string', esc_html__( 'Posted by: ', 'news-cast' ) );
		}
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%1$s %2$1s', 'post author', 'news-cast' ), esc_html( $post_author_prefix_string ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="bmm-post-author-name bmm-post-meta-item byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'news_cast_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function news_cast_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			$category_prefix = esc_html__( 'Posted in : ', 'news-cast' );
			$category_option = true;
			if( is_archive() || is_search() || is_home() ) {
				$category_option = get_theme_mod( 'archive_post_categories_option', true );
				$category_prefix = get_theme_mod( 'archive_post_categories_prefix_string', esc_html__( 'Posted in : ', 'news-cast' ) );
			} else if( is_single() ) {
				$category_option = get_theme_mod( 'single_post_categories_option', true );
				$category_prefix = get_theme_mod( 'single_post_categories_prefix_string', esc_html__( 'Posted in : ', 'news-cast' ) );
			}
			/* translators: used between list items, there is a space after the comma */
			//$categories_list = get_the_category_list( esc_html__( ', ', 'news-cast' ) );
			$news_cast_categories = get_the_category();
			if( $news_cast_categories ) {
				$categories_list = false;
				foreach( $news_cast_categories as $news_cast_cat ) {
					$cat_link = get_category_link( $news_cast_cat->term_id );
					$categories_list .= '<a class="bmm-cat-' .absint( $news_cast_cat->term_id ). '" href="' .esc_url($cat_link). '">' .esc_html( $news_cast_cat->name ). '</a> ';
				}
				if ( $categories_list && $category_option ) {
					/* translators: 1: list of categories. */
					printf( '<span class="bmm-post-cat cat-links">' . esc_html__( '%1$s %2$s', 'news-cast' ) . '</span>', esc_html( $category_prefix ), $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
			
			$tag_prefix = esc_html__( 'Tagged : ', 'news-cast' );
			$tag_option = true;
			if( is_archive() || is_search() || is_home() ) {
				$tag_option = get_theme_mod( 'archive_post_tags_option', true );
				$tag_prefix = get_theme_mod( 'archive_post_tags_prefix_string', esc_html__( 'Posted in : ', 'news-cast' ) );
			} else if( is_single() ) {
				$tag_option = get_theme_mod( 'single_post_tags_option', true );
				$tag_prefix = get_theme_mod( 'single_post_tags_prefix_string', esc_html__( 'Posted in : ', 'news-cast' ) );
			}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'news-cast' ) );
			if ( $tags_list && $tag_option ) {
				/* translators: 1: list of tags. */
				printf( '<span class="bmm-post-tags-wrap bmm-post-meta-item tags-links">' . esc_html__( '%1$s %2$s', 'news-cast' ) . '</span>', esc_html( $tag_prefix ), $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

			$comments_number = get_comments_number( get_the_ID() );
			if( 1 ) {
			    echo '<span class="bmm-post-comments-wrap bmm-post-meta-item">';
			        echo '<a href="'.esc_url( get_the_permalink() ).'/#comments">';
			            echo esc_attr( $comments_number );
			            echo '<span class="bmm-comment-txt">'.esc_html__( "Comments", "news-cast" ).'</span>';
			        echo '</a>';
			    echo '</span>';
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'news-cast' ),
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

if ( ! function_exists( 'news_cast_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function news_cast_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
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
