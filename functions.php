<?php
function readmore_scripts() {
	wp_enqueue_script('jquery');
 	wp_enqueue_script( 'js-readmore', get_stylesheet_directory_uri() . '/js/readmore.js', array('jquery') );
} 
add_action( 'wp_enqueue_scripts', 'readmore_scripts' );

add_filter( 'excerpt_more', function( $more ) {
    global $post;
	return ' <a href="'. get_permalink( $post ) . '">'. __( 'Читать дальше...' ) .'</a>';
});

function ajax_load_posts(){
 
	$args = unserialize( stripslashes( $_POST['query'] ) );
	$args['paged'] = $_POST['page'] + 1;
	$args['post_status'] = 'publish'; 
	$posts = new WP_Query( $args );

    if ( $posts->have_posts()) :
        while( $posts->have_posts()) : $posts->the_post();
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
        <?php endwhile; 
    endif;
    wp_reset_postdata();
	die();
}
 
add_action('wp_ajax_readmore', 'ajax_load_posts');
add_action('wp_ajax_nopriv_readmore', 'ajax_load_posts');