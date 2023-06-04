<?php
/**
 * Post List block layout one - php render.
 */
    if( !isset( $posts_wrappper ) ) echo '<div class="bmm-post-wrapper">';
        $list_post_args = array(
            'post_type'     => 'post',
            'posts_per_page' => esc_attr( $postCount ),
            'order'         => esc_html( $order ),
            'orderby'       => 'date',
            'post_status'   => 'publish'
        );
        if( !empty( $postCategory ) ) {
            $list_post_args['category_name'] = implode( ',', $postCategory );
        }

        $list_post_query = new WP_Query( $list_post_args );
        $max_num_pages = $list_post_query->max_num_pages;
        if( !( $list_post_query->have_posts() ) ) {
            esc_html_e( 'No posts found', 'news-cast' );
        }

        while( $list_post_query->have_posts() ) : $list_post_query->the_post();
            $news_cast_post_id = get_the_ID();
            $post_format = get_post_format( $news_cast_post_id );
            if( empty( $post_format ) ) {
                $post_format = 'standard';
            }
            $author_id  = get_post_field( 'post_author', $news_cast_post_id );
            $author_thumb = get_avatar_url( $author_id, ['size' => 48] );
            $author_display_name = get_the_author_meta( 'display_name', $author_id );
            $author_url = get_author_posts_url( $author_id );
            
            $categories = get_the_category( $news_cast_post_id );

            $tags = get_the_tags( $news_cast_post_id );
            $comments_number = get_comments_number( $news_cast_post_id );
    ?>
            <article post-id="post-<?php echo esc_attr( $news_cast_post_id ); ?>" class="bmm-post post-format--<?php echo esc_html( $post_format ); ?>" itemscope itemtype="<?php echo esc_url( 'http://schema.org/articleBody' ); ?>">
                <?php
                    if( has_post_thumbnail() ) {
                        $image_url = get_the_post_thumbnail_url( $news_cast_post_id, 'news-cast-medium' );
                    } else {
                        $image_url = false;
                    }

                    if( $image_url ) {
                ?>
                        <div class="bmm-post-thumb">
                            <a href="<?php the_permalink(); ?>" target="<?php echo esc_html( $permalinkTarget ); ?>">
                                <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title(); ?>"/>
                            </a>
                        </div>
                <?php
                    }
                ?>
                <div class="post-elements-wrapper">
                    <h2 class="bmm-post-title">
                        <a href="<?php the_permalink(); ?>" target="<?php echo esc_html( $permalinkTarget ); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="bmm-post-meta">
                        <?php
                            if( $categoryOption && $categories ) {
                                echo '<span class="bmm-post-cats-wrap bmm-post-meta-item">';
                                foreach( $categories as $category ) :
                                    echo '<span class="bmm-post-cat bmm-cat-'.absint( $category->term_id ).'"><a href="'.esc_url( get_term_link( $category->term_id ) ).'" target="'.esc_html( $permalinkTarget ).'">'.esc_html( $category->name ).'</a></span>';
                                endforeach;
                                echo '</span>';
                            }

                            if( $tagsOption && $tags ) {
                                echo '<span class="bmm-post-tags-wrap bmm-post-meta-item">';
                                foreach( $tags as $single_tag ) :
                                    echo '<span class="bmm-post-tag"><a href="'.esc_url( get_tag_link( $single_tag->term_id ) ).'" target="'.esc_html( $permalinkTarget ).'">'.esc_html( $single_tag->name ).'</a></span>';
                                endforeach;
                                echo '</span>';
                            }

                            if( $dateOption ) {
                                echo '<span class="bmm-post-date bmm-post-meta-item" itemprop="datePublished">';
                                    echo '<a href="'.esc_url( get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ) ).'" target="'.esc_html( $permalinkTarget ).'">'.get_the_date().'</a>';
                                echo '</span>';
                            }

                            if( $commentOption ) {
                                echo '<span class="bmm-post-comments-wrap bmm-post-meta-item">';
                                    echo '<a href="'.esc_url( get_the_permalink() ).'/#comments" target="'.esc_html( $permalinkTarget ).'">';
                                        echo esc_attr( $comments_number );
                                        echo '<span class="bmm-comment-txt">'.esc_html__( "Comments", "news-cast" ).'</span>';
                                    echo '</a>';
                                echo '</span>';
                            }
                        ?>
                    </div>
                    <?php
                        if( $contentOption === true ) {
                            echo '<div class="bmm-post-content" itemprop="description">';
                                the_excerpt();
                            echo '</div>';
                        }
                        
                        if( $authorOption ) {
                            echo '<span class="bmm-post-author-name bmm-post-meta-item" itemprop="author">';
                                echo '<a href="'.esc_url( $author_url ).'" target="'.esc_html( $permalinkTarget ).'">';
                                    echo '<img src="' .esc_url( $author_thumb ). '"/>';
                                    echo '<span class="author-name">' .esc_html( $author_display_name ). '</span>';
                                echo '</a>';
                            echo '</span>';
                        }
                        
                        if( $buttonOption && !empty( $buttonLabel ) ) {
                            echo '<div class="bmm-read-more-one"><a href="'.esc_url( get_the_permalink() ).'" target="'.esc_html( $permalinkTarget ).'">'.esc_html( $buttonLabel ). '</a></div>';
                        }
                    ?>
                </div><!-- .post-elements-wrapper -->
            </article>
    <?php
        endwhile;
        wp_reset_postdata();
if( !isset( $posts_wrappper ) ) echo '</div><!-- .bmm-post-wrapper -->';