<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to firmasite_comment() which is
 * located in the functions.php file.
 *
 * @package firmasite
 * @since firmasite 1.0
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
?>

	<div id="comments" class="comments-area form-inline">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'firmasite' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h4>

		<ol class="commentlist media-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use firmasite_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define firmasite_comment() and that will be used instead.
				 * See firmasite_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 
					'callback' => 'firmasite_comment', 
					'avatar_size'       => 64,
					
				 ) );
			?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        	<div class="pagination">
			<?php paginate_comments_links("type=list"); ?>
            </div>
		<?php endif; // check for comment navigation ?>
		<?php /* if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'firmasite' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'firmasite' ) ); ?></div>
		</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation */ ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'firmasite' ); ?></p>
	<?php endif; ?>

	<?php comment_form(array('comment_notes_after' => '')); ?>

</div><!-- #comments .comments-area -->
