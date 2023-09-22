<?php get_header(); ?>

    <?php 
    $args = array(
        'cat' => 2,
        'post_type' => 'post',
        'posts_per_page' => 3,
    );

    $query = new WP_Query( $args );     

    if ( $query->have_posts()) : ?>
        <div class="news-list">
            <?php while( $query->have_posts() ) : $query->the_post(); 
            $title = get_the_title();
            $excerpt_text = get_the_excerpt(); ?>
                <div class="news-list__content content">
                    <?php if ( isset( $title ) && !empty( $title )) : ?>
                        <div class="content-title">
                            <h2><?= $title; ?></h2>
                        </div>
                    <?php endif; if ( isset( $excerpt_text ) && !empty( $excerpt_text )) : ?>
                        <div class="content-text">
                            <?= $excerpt_text; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
        <br>
        <?php if ( $query->max_num_pages > 1 ) : ?>
            <script>
            let ajaxurl = '<?= site_url() ?>/wp-admin/admin-ajax.php',
                true_posts = '<?= serialize( $query->query_vars); ?>',
                current_page = <?= ( get_query_var('paged')) ? get_query_var('paged') : 1; ?>,
                max_pages = '<?= $query->max_num_pages; ?>';
            </script>
            <button class="btn-load-post"><?= __('Read more'); ?></button>
        <?php endif; 
    endif; wp_reset_postdata(); ?>

<?php get_footer();
