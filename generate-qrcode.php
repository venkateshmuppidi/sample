<?php
require_once "vendor/autoload.php";
require_once "class-db.php";

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

$qrcode_id = time().uniqid();

if ( !file_exists('uploads') ) {
    mkdir('uploads', 0755);
}

$filename = time().$_FILES['picture']['name'];
move_uploaded_file($_FILES['picture']['tmp_name'], 'uploads/'.$filename);

$data = array(
    'qrcode_id' => $qrcode_id,
    'fullname' => $_POST['fullname'],
    'email' => $_POST['email'],
    'picture' => $filename,
);
$db = new DB();
$db->insert_user($data);

$url = "http://localhost/qrcodes/reader.php?id=".$qrcode_id;
$qr_image = (new QRCode)->render($url);
echo json_encode(array('code' => 'success', 'content' => '<img src="'. $qr_image .'" alt="QR Code" />'));
die;