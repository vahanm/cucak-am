<?php
require_once(dirname(__FILE__) . '/../wp-config.php');

global $wpdb;

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
?>
   <url>
      <loc>http://www.cucak.am/</loc>
      <lastmod><?php echo date('Y-m-d') ?></lastmod>
      <changefreq>always</changefreq>
      <priority>0.1</priority>
   </url>

   <url>
      <loc>http://en.cucak.am/</loc>
      <lastmod><?php echo date('Y-m-d') ?></lastmod>
      <changefreq>always</changefreq>
      <priority>0.1</priority>
   </url>

   <url>
      <loc>http://ru.cucak.am/</loc>
      <lastmod><?php echo date('Y-m-d') ?></lastmod>
      <changefreq>always</changefreq>
      <priority>0.1</priority>
   </url>

   <url>
      <loc>http://am.cucak.am/</loc>
      <lastmod><?php echo date('Y-m-d') ?></lastmod>
      <changefreq>always</changefreq>
      <priority>0.1</priority>
   </url>
<?php
// Registred Subdomains -- BEGIN

global $registredSubdomains;

foreach($registredSubdomains as $key => $value) {
?>
<url>
	<loc>http://<?php echo $key ?>/</loc>
	<lastmod><?php echo date('Y-m-d') ?></lastmod>
	<changefreq>always</changefreq>
	<priority>0.2</priority>
</url>
<?php } // Registred Subdomains -- End ?>


<?php
// All Categories -- BEGIN

$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 0,
	'hierarchical'             => 1,
	'taxonomy'                 => 'category',
	'pad_counts'               => false );
$posts_array = get_categories( $args );

foreach($posts_array as $category) {
?>
<url>
    <loc>http://cucak.am/?cat=<?php echo $category->cat_ID ?></loc>
    <lastmod><?php echo date('Y-m-d') ?></lastmod>
    <changefreq>always</changefreq>
    <priority>0.4</priority>
</url>
<url>
    <loc>http://en.cucak.am/?cat=<?php echo $category->cat_ID ?></loc>
    <lastmod><?php echo date('Y-m-d') ?></lastmod>
    <changefreq>always</changefreq>
    <priority>0.4</priority>
</url>
<url>
    <loc>http://ru.cucak.am/?cat=<?php echo $category->cat_ID ?></loc>
    <lastmod><?php echo date('Y-m-d') ?></lastmod>
    <changefreq>always</changefreq>
    <priority>0.4</priority>
</url>
<?php
} // All Categories -- End 

// All posts -- BEGIN

$posts_array = array( 'empty' );
$group = 0;

while (count($posts_array) > 0) {

    $args = array(
        'numberposts'     => 100,
        'offset'          => $group * 100,
        'orderby'         => 'post_date',
        'order'           => 'DESC',
        'post_type'       => 'post',
        'post_status'     => 'publish',
        'suppress_filters' => true );
    $posts_array = get_posts( $args );

    foreach($posts_array as $post) {
    ?>
	    <url>
		    <loc>http://am.cucak.am/?p=<?php echo $post->ID ?></loc>
		    <lastmod><?php $lastmod = explode(' ', $post->post_modified); echo $lastmod[0]; ?></lastmod>
		    <changefreq>never</changefreq>
		    <priority>0.9</priority>
	    </url>
	    <url>
		    <loc>http://en.cucak.am/?p=<?php echo $post->ID ?></loc>
		    <lastmod><?php $lastmod = explode(' ', $post->post_modified); echo $lastmod[0]; ?></lastmod>
		    <changefreq>never</changefreq>
		    <priority>0.9</priority>
	    </url>
	    <url>
		    <loc>http://ru.cucak.am/?p=<?php echo $post->ID ?></loc>
		    <lastmod><?php $lastmod = explode(' ', $post->post_modified); echo $lastmod[0]; ?></lastmod>
		    <changefreq>never</changefreq>
		    <priority>0.9</priority>
	    </url>
    <?php
    } // All Posts -- End
    
    $group ++;
    
    //wp_reset_query();
}

echo '</urlset>';
