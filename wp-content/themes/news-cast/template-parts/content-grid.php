<?php
/**
 * Template part for displaying post grid
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package News Cast
 * @since 1.0.0
 * 
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('bmm-post'); ?>>

	<div class="title-wrap">
        <h2 class="bmm-post-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
    </div><!-- .title-wrap -->
    <div class="bmm-post-meta">
		<?php news_cast_entry_footer(); ?>
		<?php news_cast_posted_on(); ?>
	</div>
    <?php
		news_cast_posted_by();

		if( has_post_thumbnail() ) :
    ?>
			<div class="bmm-post-thumb">
				<?php news_cast_post_thumbnail(); ?>
			</div>
	<?php endif; ?>
	
	<div class="post-elements-wrapper">

		<div class="entry-content">
			<?php
				$content_type = news_cast_get_content_type();
				switch( $content_type ) {
					case 'excerpt': the_excerpt() ;
								break;
					default : the_content(
									sprintf(
										wp_kses(
											/* translators: %s: Name of current post. Only visible to screen readers */
											__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'news-cast' ),
											array(
												'span' => array(
													'class' => array(),
												),
											)
										),
										wp_kses_post( get_the_title() )
									)
								);
								break;
				}

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'news-cast' ),
						'after'  => '</div>',
					)
				);
			?>
		</div><!-- .entry-content -->

		<?php

		/**
		 * hook - news_cast_archive_single_post_before_article_hook
		 * 
		 * @hooked - news_cast_archive_read_more_button - 10
		 * 
		 */
			if( has_action( 'news_cast_archive_single_post_before_article_hook' ) ) {
				do_action( 'news_cast_archive_single_post_before_article_hook' );
			}
        ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->