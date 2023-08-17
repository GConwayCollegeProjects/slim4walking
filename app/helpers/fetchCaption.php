<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}



if(!isset($_POST['submit'])) {
	echo "<div>Failed to post details correctly</div>";
	// Update errors log =======================================
}
else {

	require_once('../src/Connection.php');

	$Conn = new Connection();

	$pdo = $Conn->newConnection();

	$userid = $_SESSION['userid'];
	$fullname = $_POST['id'];
	$end = strpos($fullname, '.');
	$filename = substr($fullname, 0, $end );

	$type = $_POST['type'];

	switch($type) {
		case "i":
			$field1 = 'img_filename';
			$field2 = 'img_ext';
			$field3 = 'img_caption';
			$sql = "SELECT img_caption FROM images where img_filename = '$filename' LIMIT 1";
			break;
		case "v":
			$field1 = 'vid_filename';
			$field2 = 'vid_ext';
			$field3 = 'vid_caption';
			$sql = "SELECT vid_caption FROM videos where vid_filename = '$filename' LIMIT 1";
			break;
		case "p":
			$field1 = 'pdf_filename';
			$field2 = 'pdf_ext';
			$field3 = 'pdf_caption';
			$sql =  "SELECT pdf_caption FROM pdfs where pdf_filename = '$filename' LIMIT 1";;
			break;
        case "m":
            $field1 = 'map_filename';
            $field2 = 'map_ext';
            $field3 = 'map_caption';
            $sql =  "SELECT map_caption FROM maps where map_filename = '$filename' LIMIT 1";;
            break;
	}
// create record and get id
	try {
		$stmt = $pdo->prepare("$sql");
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt = null;
		$conn = null;

		echo $result[0];

	} catch (PDOException $e) {
		$error = $e->getMessage();
	}
}



