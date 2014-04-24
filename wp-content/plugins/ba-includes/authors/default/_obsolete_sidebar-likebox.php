<?php 
    global $likebox_params;
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/<?php echo get_language_code() ?>/all.js#xfbml=1&appId=326575494130260";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like-box" data-href="http://www.facebook.com/<?php echo $likebox_params['facebook'] ?>" data-width="220" data-show-faces="true" data-stream="false" data-header="true"></div>