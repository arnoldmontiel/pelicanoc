<?php

$urls = array();

if (isset($_POST['liteUploader_id']) && $_POST['liteUploader_id'] == 'fileUpload1')
{
	foreach ($_FILES['fileUpload1']['error'] as $key => $error)
	{
	    if ($error == UPLOAD_ERR_OK)
		{
			$uploadedUrl = 'images/' . $_FILES['fileUpload1']['name'][$key];
	        move_uploaded_file( $_FILES['fileUpload1']['tmp_name'][$key], $uploadedUrl);
	        $urls[] = $uploadedUrl;
	    }
	}

	$message = 'Successfully Uploaded File(s) From First Upload Input';
}

echo json_encode(
	array(
		'message' => $message,
		'urls' => $urls,
	)
);
exit;

?>
