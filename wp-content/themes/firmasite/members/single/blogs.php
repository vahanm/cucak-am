<?php

/**
 * BuddyPress - Users Blogs
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<div class="item-list-tabs" id="subnav" role="navigation">
	<ul class="nav nav-pills">

		<?php bp_get_options_nav(); ?>

		<li id="blogs-order-select" class="last pull-right filter">

			<label for="blogs-all"><?php _e( 'Order By:', 'firmasite' ); ?></label>
			<select id="blogs-all">
				<option value="active"><?php _e( 'Last Active', 'firmasite' ); ?></option>
				<option value="newest"><?php _e( 'Newest', 'firmasite' ); ?></option>
				<option value="alphabetical"><?php _e( 'Alphabetical', 'firmasite' ); ?></option>

				<?php do_action( 'bp_member_blog_order_options' ); ?>

			</select>
		</li>
	</ul>
</div><!-- .item-list-tabs -->

<?php do_action( 'bp_before_member_blogs_content' ); ?>

<div class="blogs myblogs" role="main">

	<?php locate_template( array( 'blogs/blogs-loop.php' ), true ); ?>

</div><!-- .blogs.myblogs -->

<?php do_action( 'bp_after_member_blogs_content' ); ?>
