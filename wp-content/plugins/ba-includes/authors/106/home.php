<?php

$authorId = arg($_GET, 'author', 0);

$name = get_user_meta($authorId, 'display_name', true);
$name = (strlen($name) > 0) ? $name : __('Unknown author');
$page = 'home';


// http://www.slidesjs.com/ - Slider API
?>
<style type="text/css" media="screen">
    div#slides.slides_container {
        width:700px;
        height:200px;
    }
    div#slides.slides_container div {
        width:700px;
        height:200px;
        display:block;
    }
</style>

<script src="<?php echo site_url('/wp-content/plugins/ba-includes/authors/106/resources/slides.min.jquery.js') ?>"></script>

<script>
    $(function(){
		$("#slides").show().slides({
			play: 3000,
			pagination: false,
			generatePagination: false,
			slideSpeed: 600
			//, hoverPause: true
		});
		//$("#slides").slideDown();
    });
</script>

<div id="slides" style="display: none;">
    <div class="slides_container">
        <div>
            <img src="<?php echo site_url('/wp-content/plugins/ba-includes/authors/106/resources/images/home1.jpg') ?>">
        </div>
        <div>
            <img src="<?php echo site_url('/wp-content/plugins/ba-includes/authors/106/resources/images/home2.jpg') ?>">
        </div>
        <div>
            <img src="<?php echo site_url('/wp-content/plugins/ba-includes/authors/106/resources/images/home3.jpg') ?>">
        </div>
        <div>
            <img src="<?php echo site_url('/wp-content/plugins/ba-includes/authors/106/resources/images/home4.jpg') ?>">
        </div>
    </div>
</div>

