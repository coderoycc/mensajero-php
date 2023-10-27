<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST['id'];
  
  if(isset($_FILES['logo'])) {
    $targetDirectory = '../assets/logos/';
    $targetFile = $targetDirectory . 'logo_' . $id . '.' . 'png';
    $image = imagecreatefromstring(file_get_contents($_FILES['logo']['tmp_name']));
    if ($image !== false) {
      imagepng($image, $targetFile, 8); 
      imagedestroy($image);
      echo json_encode(array('status' => 'ok'));
    } else {
      echo json_encode(array('status' => 'error'));
    }
  }
}
?>
