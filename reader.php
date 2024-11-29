<?php
require_once "class-db.php";

$id = $_GET['id'];

$db = new DB();
$data = $db->get_user($id);
?>

<div class="info">
    <img src="<?php echo "http://localhost/qrcodes/uploads/".$data['picture']; ?>" width="200" alt="picture">
    <p>Fullname: <?php echo $data['fullname']; ?></p>
    <p>Email: <?php echo $data['email']; ?></p>
</div> 