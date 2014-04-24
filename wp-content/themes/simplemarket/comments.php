<?php
/**
 * Comments
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
 
 
 function write_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
			  case 'pingback'  :
			  case 'trackback' :
		?>
	<li class="comment-pingback">
		<p><?php _e( 'Pingback:', TEMPLATE_DOMAIN); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', TEMPLATE_DOMAIN), ' ' ); ?></p>
		<?php break; default:
	?>
	
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>">
        <div class="comment-author vcard">
            <?php echo get_avatar( $comment, 32 ); ?>
        </div>
        
		<div class="comment-body">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', TEMPLATE_DOMAIN); ?></em>
				<?php endif; ?>
			<?php comment_text(); ?>
		</div>
			<header class="comment-header">
<!--            <div class="comment-reply">
            </div>
            <div class="comment-edit">
            </div>
-->            <div class="comment-meta">
				<?php printf( __( '%s ', TEMPLATE_DOMAIN), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                ·
                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                <?php printf( __( '%1$s at %2$s', TEMPLATE_DOMAIN ), get_comment_date(),  get_comment_time() ); ?></a>
                
                <?php edit_comment_link( '· ' .__( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
                
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'reply_text' => ' · ' . __('Reply'), 'max_depth' => $args['max_depth'] ) ) ); ?>
                
            </div>
		</header>
        <div class="clear"></div>
	</article>

	<?php break;
	endswitch;
}
?>

<div id="comments">
<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', TEMPLATE_DOMAIN); ?></p>
	</div>
<?php
return;
endif;
?>
<?php if ( have_comments() ) : ?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<div class="comment-navigation">
		<div class="comment-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', TEMPLATE_DOMAIN) ); ?></div>
		<div class="comment-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', TEMPLATE_DOMAIN) ); ?></div>
	</div> 
<?php endif; ?>
	<ol class="commentlist">
		<?php
		$args = array(  
    'walker'            => null,
    'max_depth'         => '',
    'style'             => 'ul',
    'callback'          => 'write_comment', //'simplemarket_comment',  
    'end-callback'      => null,
    'type'              => 'all',
    'page'              => '',
    'avatar_size'       => 24,
    'reverse_top_level' => null,
    'reverse_children'  =>  ''
	);

			wp_list_comments( $args );
		?>
	</ol>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
	<div class="comment-navigation">
		<div class="comment-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', TEMPLATE_DOMAIN) ); ?></div>
		<div class="comment-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', TEMPLATE_DOMAIN) ); ?></div>
	</div>
<?php endif;  ?>

<?php else : 

if ( ! comments_open() ) :
?>
<p class="nocomments"><?php _e( 'Comments are closed.', TEMPLATE_DOMAIN); ?></p>
<?php endif;  ?>

<?php endif;  ?>

<?php
$comments_args = array(
			// change the title of send button 
			'title_reply'=>'',
			// remove "Text or HTML to be displayed after the set of comment fields"
			'comment_notes_after' => '',
			// redefine your own textarea (the comment body)
			'comment_field' => '<p class="comment-form-comment"><input type="text" id="comment" name="comment" aria-required="true"/>',
	);
	
	comment_form($comments_args);
?>
</div>