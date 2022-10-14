<?php 

$id = (($_POST["id"] ? $_POST["id"] : 0));

if ($id != 0) {
    
	$filename = "pano.xml";
    $filename_template = "pano-template.xml";
    
    $data_template = file_get_contents($filename_template);

    $new = str_replace('%%node%%', $id, $data_template);

    file_put_contents($filename, $new);

}

?>

