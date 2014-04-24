<?php
require_once('../wp-config.php');
require('../wp-content/plugins/ba-includes/ba-upload/server/php/upload.class.php');

$options = array(
	'script_url' => '../wp-content/plugins/ba-includes/ba-upload/server/php/',
	'upload_dir' => '../wp-content/uploads/attachments/authors/originals/',
	'upload_url' => '/wp-content/uploads/attachments/authors/originals/',
	'param_name' => 'file',
	// Set the following option to 'POST', if your server does not support
	// DELETE requests. This is a parameter sent to the client:
	'delete_type' => 'DELETE',
	//'accept_file_types' => '/.+$/i',
	'accept_file_types' => '/(.png$|.gif$|.jpg$|.jpeg$|.bmp$)/i',
	// The maximum number of files for the upload directory:
	'max_number_of_files' => null,
	// Image resolution restrictions:
	'max_width' => null,
	'max_height' => null,
	'min_width' => 128,
	'min_height' => 128,
	// Set the following option to false to enable resumable uploads:
	'discard_aborted_uploads' => true,
	// Set to true to rotate images based on EXIF meta data, if available:
	'orient_image' => true,
	'image_versions' => array(
			// Uncomment the following version to restrict the size of
			// uploaded images. You can also add additional versions with
			// their own upload directories:
			
			'standards' => array(
				'upload_dir' => '../wp-content/uploads/attachments/authors/standards/',
				'upload_url' => '/wp-content/uploads/attachments/authors/standards/',
				'max_width' => 325, //325
				'max_height' => 182, //580
				'jpeg_quality' => 95
				),
			
			'big' => array(
				'upload_dir' => '../wp-content/uploads/attachments/authors/bigs/',
				'upload_url' => '/wp-content/uploads/attachments/authors/bigs/',
				'max_width' => 1200,
				'max_height' => 600,
				'jpeg_quality' => 95
				),
			
			'thumbnail_230x120' => array(
				'upload_dir' => '../wp-content/uploads/attachments/authors/thumbnails.230x120/',
				'upload_url' => '/wp-content/uploads/attachments/authors/thumbnails.230x120/',
				'max_width' => 215,
				'max_height' => 120
				),
			
			'thumbnail_120x120' => array(
				'upload_dir' => '../wp-content/uploads/attachments/authors/thumbnails.120x120/',
				'upload_url' => '/wp-content/uploads/attachments/authors/thumbnails.120x120/',
				'max_width' => 120,
				'max_height' => 120
				),
			
			'thumbnail_55x55' => array(
				'upload_dir' => '../wp-content/uploads/attachments/authors/thumbnails.55x55/',
				'upload_url' => '/wp-content/uploads/attachments/authors/thumbnails.55x55/',
				'max_width' => 55,
				'max_height' => 55
				),
			
			'thumbnail' => array(
				'upload_dir' => '../wp-content/uploads/attachments/authors/thumbnails/',
				'upload_url' => '/wp-content/uploads/attachments/authors/thumbnails/',
				'max_width' => 120,
				'max_height' => 120
				)
			)
		);
$upload_handler = new UploadHandler($options);

header('Pragma: no-cache');
header('Content-Type: text/html; charset=UTF-8');

switch ($_SERVER['REQUEST_METHOD']) {
	case 'OPTIONS':
		break;
	case 'HEAD':
	case 'GET':
		$upload_handler->get();
		break;
	case 'POST':
		if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
			$upload_handler->delete();
		} else {
			$info = $upload_handler->post();
			
			render($info[0]);
		}
		break;
	case 'DELETE':
		$upload_handler->delete();
		break;
	default:
		header('HTTP/1.1 405 Method Not Allowed');
}

function render($info)
{
	$json = json_encode($info);
	?>
	<!DOCTYPE HTML>
	<html>
	<head>

	<?php
	$id = MD5($info->name);
	
    if ($info->error)
    {
	?>
		<script type="text/javascript">
			alert('<?php _e('error_upload_' . $info->error) ?>');

			document.location = "photos-upload.php";
		</script>
		<?php
		exit;
    }
    else
    {
		echo '</head><body><div style="display: none;">';
		
		switch($info->type)
		{
			case 'image/png': case 'image/jpeg': case 'image/gif': case 'image/bmp': case 'image/x-icon':
				echo '<div id="att_'. $id . '" class="photo-container">';
				echo '<a rel="lightbox[roadtrip]" href="' . $info->big_url . '" target="_new"><img style="" alt="' . $info->name . '" srcx="' . $info->standards_url . '"/></a>' . '<br />';
		
				//echo '<br/>';
				//echo '<span>Size: ' . formatSizeUnits($info->size) . '</span>';
		
				echo '<a class="photos-button-remove">' . __('Remove') . '<div  class="file-json" style="display: none;">{json}' . $json . '</div></a>';
				
				break;
		}
    }
			?>
</div>

</div>
<script src="/wp-includes/js/jquery.1.8.21/jquery-1.7.2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function (){
		var val;
		val = parent.document.getElementById('photos').value;

		val = '{json}<?php echo $json ?>' + val;
		
		parent.document.getElementById('photos').value = val;
    
		$(parent.document).find('#photos-container').append($('#att_<?php echo $id ?>'));
		
		var src = $(parent.document).find('#att_<?php echo $id ?> img');
		
		$(src).attr('src', $(src).attr('srcx')).attr('srcx', '');
		
		document.location = 'photos-upload.php';
	});
</script>

<?php
}
?>
