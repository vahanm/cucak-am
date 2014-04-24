<?php
require_once('../wp-config.php');
require_once('../wp-content/plugins/ba-includes/ba-upload/server/php/upload.class.php');

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
	'max_width' => 950,
	'max_height' => 150,
	'min_width' => 950,
	'min_height' => 50,
	// Set the following option to false to enable resumable uploads:
	'discard_aborted_uploads' => true,
	// Set to true to rotate images based on EXIF meta data, if available:
	'orient_image' => true,
	'image_versions' => array(
			// Uncomment the following version to restrict the size of
			// uploaded images. You can also add additional versions with
			// their own upload directories:
			
			'standards' => array(
				'upload_dir' => '../wp-content/uploads/attachments/authors/headers/',
				'upload_url' => '/wp-content/uploads/attachments/authors/headers/',
				'max_width' => 950,
				'max_height' => 150,
				'jpeg_quality' => 97
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

			document.location = 'header-upload.php';
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
					echo '<img style="width: 468px;" alt="' . $info->name . '" srcx="' . $info->standards_url . '"/>' . '<br />';
		
				echo '<a class="photos-button-remove">' . __('Remove') . '</a>';
				
				break;
		}
    }
			?>
</div>

</div>
<script src="/wp-includes/js/jquery.1.8.21/jquery-1.7.2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function (){		
		parent.document.getElementById('photos').value = '<?php echo $json ?>';
    
		$(parent.document).find('#photos-container').empty();
		$(parent.document).find('#photos-container').append($('#att_<?php echo $id ?>'));
		
		var src = $(parent.document).find('#att_<?php echo $id ?> img');
		
		$(src).attr('src', $(src).attr('srcx')).removeAttr('srcx');
		
		document.location = 'header-upload.php';
	});
</script>

<?php
}
?>
