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

	$type = $_POST['type'];

	switch($type) {
		case "i":
			$field1 = 'img_filename';
			$field2 = 'img_ext';
			$field3 = 'img_caption';
			$sql = "SELECT * FROM images where img_ind_id = $userid";
			$path1 = "../../data/images/";
			$path2 = "../data/images/";
			break;
		case "v":

			$field1 = 'vid_filename';
			$field2 = 'vid_ext';
			$field3 = 'vid_caption';
			$sql = "SELECT * FROM videos where vid_ind_id = $userid";
			$path1 = "../../data/videos/";
			$path2 = "../data/videos/";
			break;
		case "p":
			$field1 = 'pdf_filename';
			$field2 = 'pdf_ext';
			$field3 = 'pdf_caption';
			$sql = "SELECT * FROM pdfs where pdf_ind_id = $userid";
			$path1 = "../../data/pdfs/";
			$path2 = "../data/pdfs/";
			break;
        case "m":
            $field1 = 'map_filename';
            $field2 = 'map_ext';
            $field3 = 'map_caption';
            $sql = "SELECT * FROM maps where map_ind_id = $userid";
            $path1 = "../../data/maps/";
            $path2 = "../data/maps/";
            break;
	}
// create record and get id




		try {
			$stmt = $pdo->prepare("$sql");
			$stmt->execute();

			$result = $stmt->fetchAll();
			$stmt = null;
			$conn = null;
		} catch (PDOException $e) {
			$error = $e->getMessage();
		}


	echo'<div class="container  overflow-auto" style="height:250px; width: 450px ">
            <div class="row"> 	<!--    DIV - Start of 	-->
			 ' ;
	$x=1;
	foreach($result as $key => $row) {
		$exists = $path1.$row[$field1].".".$row[$field2];

		$src = $path2.$row[$field1].".".$row[$field2];

		if (file_exists($exists) === true) {

			$id = $type.$row[$field1].".".$row[$field2];

			switch ($type) {
				case 'i':
						echo '<div class="col-sm-4">';
						echo '<li class=" d-flex justify-content-center" style="list-style: none; margin-bottom: 10px">
						<img  id=' . $id . ' height="80px" onclick="getCaption(this.id)" alt="" src= ' . $src . '>
						<br></li>';
						echo '</div>';
				break;
				case 'v':
					echo '<div class="col-sm-4">';
						$vidtype = 'video/'.$row[$field2];
					echo '<li class=" d-flex justify-content-center" style="list-style: none; margin-bottom: 10px">
							<div id='.$id.'  onclick="getCaption(this.id)" > <video height="80px"   preload="metadata">
  						<source src='.$src.' type='.$vidtype.'>
						</video></div><br></li>' ;

				break;
				case 'p':
					echo '<div class="col-sm-4">';
					echo '<li class=" d-flex justify-content-center" style="list-style: none; margin-bottom: 10px">
						<img  id=' . $id . '  height="80px" onclick="getCaption(this.id)" alt="" src="img/pdf.png">
						<br></li>';
					echo '<li class=" d-flex justify-content-center" style="list-style: none">'.$row[$field3].'<br></li>' ;
					echo '</div>';
					break;

                case 'm':
                    echo '<div class="col-sm-4">';
                    echo '<li class=" d-flex justify-content-center" style="list-style: none; margin-bottom: 10px">
						<img  id=' . $id . '  height="80px" onclick="getCaption(this.id)" alt="" src="img/smiley.png">
						<br></li>';
                    echo '<li class=" d-flex justify-content-center" style="list-style: none">'.$row[$field3].'<br></li>' ;
                    echo '</div>';
                    break;


			}
			if ($x ===3){
				echo ' <div class="w-100"></div>';
				$x=0;
			}
			$x = $x+1;
		}
		else{
			echo "can't find file";
		}



	}





	echo '
                                                    
                                        </div> <!-- End of Row -->
                                    </div> <!-- End of container -->' ;

}
