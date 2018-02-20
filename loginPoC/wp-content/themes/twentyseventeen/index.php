<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<?php if ( is_home() && ! is_front_page() ) : ?>
		<header class="page-header">
			<h1 class="page-title"><?php single_post_title(); ?></h1>
		</header>
	<?php else : ?>
	<header class="page-header">
		<h2 class="page-title"><?php _e( 'Posts', 'twentyseventeen' ); ?></h2>
	</header>
	<?php endif; ?>

    <?php

    function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }

        if (isset($_POST["email"]) && isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["phone"]) && !is_numeric(email_exists(esc_sql($_POST["email"]))))
        {
            $password = generateRandomString();

            $role = get_role("custom2");

            if ($role == null)
            {
                add_role( "custom2", "custom2", array('read'         => true) );
            }

            $userdata = array(
                'user_login'  =>  esc_sql($_POST["email"]),
                'user_email'  =>  esc_sql($_POST["email"]),
                'user_nicename' => esc_sql($_POST["firstName"])." ".esc_sql($_POST["lastName"]),
                'first_name' =>  esc_sql($_POST["firstName"]),
                'last_name' =>  esc_sql($_POST["lastName"]),
                'role' => 'custom2',
                'locale' => 'de_DE',
                'user_pass'   =>  $password
            );

            $user_id = wp_insert_user( $userdata ) ;

            add_user_meta( $user_id, "phone_number", esc_sql($_POST["phone"]));

            echo $user_id;
            echo $password;
        }

     ?>

     <div>
         <h1>Login form</h1>
         <?php wp_login_form(); ?>
     </div>

    <div class="registration-form">
        <h1>Registration form POC</h1>
        <form method="POST">
        <label>E-mail cím:<input type="text" name="email" /></label>
        <label>Vezetéknév:<input type="text" name="firstName" /></label>
        <label>Keresztnév:<input type="text" name="lastName" /></label>
        <label>Phone:<input type="text" name="phone" /></label>
        <input type="submit" />
        </form>
    </div>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/post/content', get_post_format() );

				endwhile;

				the_posts_pagination( array(
					'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
				) );

			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
