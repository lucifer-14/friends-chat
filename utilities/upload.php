
<?php

//upload.php
//include "admin/config.php"
if(isset($_POST["image"]))
{
 $data = $_POST["image"];

 $image_array_1 = explode(";", $data);

 $image_array_2 = explode(",", $image_array_1[1]);

 $data = base64_decode($image_array_2[1]);
  
 $imageName = "../user_img/" . uniqid() . '.jpg';

 file_put_contents($imageName, $data);
 $imageName = substr($imageName, 3);
 echo $imageName;
 //echo '<img src="'.$imageName.'" class="img-thumbnail" />';

 // 	$path = $_FILES["$fieldName"]['name'];
 //    $ext = pathinfo($path, PATHINFO_EXTENSION);
 //    $img = $imagePath . uniqid().".".$ext;

	// move_uploaded_file($_FILES["$fieldName"]['tmp_name'], $img);

 // echo '<img src="'.$imageName.'" class="img-thumbnail" />';
}

?>