<?php
require_once('../wp-config.php');
require_once('../wp-content/plugins/ba-includes/ba-upload/server/php/upload.class.php'); // UPLOAD Class

$options = array(
    'script_url' => '../wp-content/plugins/ba-includes/ba-upload/server/php/',
    'upload_dir' => '../wp-content/uploads/attachments/temp/originals/',
    'upload_url' => '/wp-content/uploads/attachments/temp/originals/',
    'param_name' => 'file',
    // Set the following option to 'POST', if your server does not support
    // DELETE requests. This is a parameter sent to the client:
    'delete_type' => 'DELETE',
    //'accept_file_types' => '/.+$/i',
    'accept_file_types' => '/(.png$|.gif$|.jpg$|.jpeg$|.bmp$|.ico$|.pdf$|.doc$|.docx$|.xls$|.xlsx$|.zip$|.rar$|.7z$|.txt$|.ini$|.inf$|.exe$)/i',
    // The maximum number of files for the upload directory:
    'max_number_of_files' => null,
    // Image resolution restrictions:
    'max_width' => 6000,
    'max_height' => 6000,
    'min_width' => 200,
    'min_height' => 200,
    // Set the following option to false to enable resumable uploads:
    'discard_aborted_uploads' => true,
    // Set to true to rotate images based on EXIF meta data, if available:
    'orient_image' => true,
    'image_versions' => array(
            // Uncomment the following version to restrict the size of
            // uploaded images. You can also add additional versions with
            // their own upload directories:
            
            'standards' => array(
                'upload_dir' => '../wp-content/uploads/attachments/temp/standards/',
                'upload_url' => '/wp-content/uploads/attachments/temp/standards/',
                'max_width' => 325, //325
                'max_height' => 182, //580
                'jpeg_quality' => 95
                ),
            
            'big' => array(
                'upload_dir' => '../wp-content/uploads/attachments/temp/bigs/',
                'upload_url' => '/wp-content/uploads/attachments/temp/bigs/',
                'max_width' => 1800,
                'max_height' => 900,
                'jpeg_quality' => 95
                ),
            
            'thumbnail_230x120' => array(
                'upload_dir' => '../wp-content/uploads/attachments/temp/thumbnails.230x120/',
                'upload_url' => '/wp-content/uploads/attachments/temp/thumbnails.230x120/',
                'max_width' => 215,
                'max_height' => 120
                ),
            
            'thumbnail_120x120' => array(
                'upload_dir' => '../wp-content/uploads/attachments/temp/thumbnails.120x120/',
                'upload_url' => '/wp-content/uploads/attachments/temp/thumbnails.120x120/',
                'max_width' => 120,
                'max_height' => 120
                ),
            
            'thumbnail_55x55' => array(
                'upload_dir' => '../wp-content/uploads/attachments/temp/thumbnails.55x55/',
                'upload_url' => '/wp-content/uploads/attachments/temp/thumbnails.55x55/',
                'max_width' => 55,
                'max_height' => 55
                ),
            
            'thumbnail' => array(
                'upload_dir' => '../wp-content/uploads/attachments/temp/thumbnails/',
                'upload_url' => '/wp-content/uploads/attachments/temp/thumbnails/',
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

function render($info) {
    $json = json_encode($info);
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
    <?php
    $id = MD5($info->name); //date("Y_m_d_H_i_s");
    
    if ($info->error) {
    ?>
        <script type="text/javascript">
            //alert('<?php echo 'Upload error: ' . $info->error; ?>');
            alert('<?php _e('error_upload_' . $info->error) ?>');

            document.location = "upload.php";
        </script>
        <?php
        exit;
    } else {
        echo '</head><body><div style="display: none;">';
        
        switch($info->type)
        {
            case 'image/png': case 'image/jpeg': case 'image/gif': case 'image/bmp': case 'image/x-icon':
                echo '<div id="att_'. $id . '" class="att-file att-file-image">';
                echo '<div class="att-file-image-default"></div>';
                echo '<input class="att-file-image-default-input" type="radio" id="thumbnail_'. $id . '" name="post_thumbnail" value="' . $info->thumbnail_url . '" />';
                echo '<a href="' . $info->url . '" target="_new"><img style="" alt="' . $info->name . '" srcx="' . $info->standards_url . '"/></a>' . '<br />';
                break;
            case 'application/msword': case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                echo '<div id="att_' . $id . '" class="att-file att-file-word">';
                echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" srcx="/wp-includes/images/icons/doc.png"/></a>';
                break;
            case 'text/plain':
                echo '<div id="att_' . $id . '" class="att-file att-file-text">';
                echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" srcx="/wp-includes/images/icons/text.png"/></a>';
                break;
            case 'application/vnd.ms-excel': case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                echo '<div id="att_' . $id . '" class="att-file att-file-excel">';
                echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" srcx="/wp-includes/images/icons/excel.png"/></a>';
                break;
            case 'application/x-zip-compressed':
                echo '<div id="att_' . $id . '" class="att-file att-file-archive">';
                echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" srcx="/wp-includes/images/icons/archive.png"/></a>';
                break;
            case 'application/pdf':
                echo '<div id="att_' . $id . '" class="att-file att-file-book">';
                echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" srcx="/wp-includes/images/icons/pdf.png"/></a>';
                break;
            default:
                echo '<div id="att_' . $id . '" class="att-file att-file-other">';
                echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" srcx="/wp-includes/images/icons/unknown.png"/></a>';
        }
        
        echo '<br/>';
        
        echo '<input type="text" name="post_file_' . $id . '" id="file_' . $id . '" style="width: 90%" defaultvalue="' . __('Please enter the file name.') . '" value="" />';
        //echo '<a href="' . $info->url . '" target="_new">' . $info->name . '</a><br />';
//      echo 'Type: ' . $info->type . '<br />';
        echo '<br />';
        echo '<span>Size: ' . formatSizeUnits($info->size) . '</span>';
        
        echo '<a class="button-remove-file" style="color: #f31;">' . __('Remove') . '<div  class="file-json" style="display: none;">{json}' . $json . '</div></a>';
    }
?>
</div>

</div>
<script src="/wp-includes/js/jquery.1.8.21/jquery-1.7.2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function (){
        var val;
        val = parent.document.getElementById("attfiles").value;

        val = val + '{json}<?php echo $json ?>';
        
        parent.document.getElementById("attfiles").value = val;

        $(parent.document).find('#att .addpostctrl').before($('#att_<?php echo $id ?>'));
        
        var src = $(parent.document).find('#att_<?php echo $id ?> img');
        
        $(src).attr('src', $(src).attr('srcx')).attr('srcx', '');
        
        if ($(parent.document).find('#att input:radio:checked').length == 0) {
            $(parent.document).find('#att input:radio:first').attr('checked', 'checked');
        }

        parent.makeImagesAsSortable();

        document.location = "upload.php";
    });
</script>

<?php
}