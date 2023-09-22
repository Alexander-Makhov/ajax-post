<?php get_header(); ?>

    <?php while ( have_posts() ) : the_post();

        get_template_part( 'template/content', get_post_type());

    endwhile; ?>

<?php get_footer();
