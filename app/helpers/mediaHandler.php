<?php

namespace Cohortology;


use XMLWriter;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    $datetime = date('Y-m-d H:i:s');
    $url_root = 'https://www.cohortology.com';
    //$url_root = implode('/', explode('\\', $url_root, -2));


if (!isset($_POST['submit'])) {
    echo "<div>Failed to post details correctly</div>";
    // Update errors log =======================================
} else {
    $type = $_POST['type'];
    switch ($type) {
        case "i":
            $allowed = array('jpg', 'jpeg', 'png');
            $fileLimit = 10000000;
            $fileDestination = $url_root.'/data/img/';
            $sql = "INSERT INTO images (img_id, img_filename, img_ext, img_caption, img_added, img_amended, img_changed_by) VALUES (:id, :filename, :ext, :caption, :added, :amended, :changed_by )";
            break;
        case "v":
            $allowed = array('mp3', 'mp4');
            $fileLimit = 100000000;
            $fileDestination = $url_root.'/data/vid/';
            $sql = "INSERT INTO videos (vid_id, vid_filename, vid_ext, vid_caption, vid_added, vid_amended, vid_changed_by) VALUES (:id, :filename, :ext, :caption, :added, :amended, :changed_by )";
            break;
        case "p":
            $allowed = array('pdf');
            $fileLimit = 10000000;
            $fileDestination = $url_root.'/data/pdf/';
            $sql = "INSERT INTO pdfs (pdf_id, pdf_filename, pdf_ext, pdf_caption, pdf_added, pdf_amended, pdf_changed_by) VALUES (:id, :filename, :ext, :caption, :added, :amended, :changed_by )";
            break;
        case "m":
            $allowed = array('gpx');
            $fileLimit = 10000000;
            $fileDestination = $url_root.'/data/map/';
            $sql = "INSERT INTO maps (map_id, map_filename, map_ext, map_caption, map_added, map_amended, map_changed_by) VALUES (:id, :filename, :ext, :caption, :added, :amended, :changed_by )";
            break;
    }

    require_once('../src/Connection.php');


    $Conn = new Connection();

    $pdo = $Conn->newConnection();

    $id = $_SESSION['userid'];


    if (isset($_FILES['file'])) {
// Check for and save media file if exists ========================

        $caption = $_POST['caption'];
        $unique = uniqid("CH", true);
        $unique = str_replace(".", "", $unique);
        $fileName = $_FILES['file']['name'];

        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        if (in_array($fileActualExt, $allowed)) {
             if ($fileError === 0) {

                if ($fileSize < $fileLimit) {

                    if($type==="m") {
                        $fileNameNew = $unique . '.' . 'tmp';
                    }
                    else{
                        $fileNameNew = $unique . '.' . $fileActualExt;
                    }
                    $fileDestinationPath = $fileDestination . $fileNameNew;
                    $result = move_uploaded_file($fileTmpName, $fileDestinationPath);

                    if($type==="m" && $result === true) {
                        $fileNameNew = $unique . '.' . 'gpx';
                        $result = doXML($fileDestinationPath, $fileNameNew, $fileDestination);
                    }
                    if ($result === true) {
                        $Filename = $unique;
                        $Caption = $caption;
                        $Ext = $fileActualExt;
                        // create record and get id's
// *******************************************************************************************************************
                        // Insert Image


                        $stmt = $pdo->prepare($sql);

                        //Bind our variables.
                        $stmt->bindValue(':id', $id);
                        $stmt->bindValue(':filename', $Filename);
                        $stmt->bindValue(':ext', $Ext);
                        $stmt->bindValue(':caption', $Caption);
                        $stmt->bindValue(':added', $datetime);
                        $stmt->bindValue(':amended', $datetime);
                        $stmt->bindValue(':changed_by', $id);

                        //Execute the statement and insert the new image.
                        $stmt->execute();

                        //$iID = $pdo->lastInsertId();

                        echo $Filename.".".$Ext;
                    } else {
                        $Error = 'There was an error uploading your file';
                    }
                } else {
                    $Error = 'Your file is too big!';
                }
            } else {
                $Error = 'There was an error uploading your file';
            }
        } else {
            $Error = 'You cannot upload files of this type!';
        }
    } // done iFile
}

function doXML($fileDestinationPath, $fileNameNew, $fileDestination ): bool
{
    if (file_exists($fileDestinationPath)) {
        $xml1 = simplexml_load_file($fileDestinationPath);
        $xml2 = new XMLWriter();
        $uri = $fileDestination . $fileNameNew;
        $xml2->openURI($uri);
        $xml2->startDocument("1.0", "utf-8");
        $xml2->startElement('gpx');
        $xml2->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $xml2->writeAttribute('xmlns:xsd', 'http://www.w3.org/2001/XMLSchema');
        $xml2->writeAttribute('xmlns:gs', 'http://www.topografix.com/GPX/gpx_style/0/2');
        $xml2->setIndent(1);
        $xml2->writeAttribute('xmlns:gh', 'https://graphhopper.com/public/schema/gpx/1.1');
        $xml2->writeAttribute('xsi:schemaLocation', 'http://www.topografix.com/GPX/1/1/gpx.xsd');
        $xml2->writeAttribute('version', '1.1');
        $xml2->writeAttribute('creator', 'G Conway');
        $xml2->writeAttribute('xmlns', 'http://www.topografix.com/GPX/1/1');
        $xml2->setIndent(1);
        $xml2->startElement('rte');
        $rte[] = $xml1->rte;
        foreach ($rte as $output) {
            for ($i = 0; $i <= 500; $i++) {
                try {
                    if (isset($output->rtept[$i])) {
                        $att = $output->rtept[$i]->attributes();
                        $xml2->startElement('rtept');
                        $xml2->writeAttribute('lat', $att[0]);
                        $xml2->writeAttribute('lon', $att[1]);
                        if (!empty($output->rtept[$i]->ele)) {
                            $xml2->startElement('ele');
                            $xml2->text($output->rtept[$i]->ele);
                            $xml2->endElement();
                        }
                        $xml2->endElement();
                        $xml2->setIndent(1);
                    } else {
                        break;
                    }
                } catch (Exception $e) {
                    break;
                }
            }
            $xml2->endElement();
            $xml2->endElement();
            $xml2->endDocument();
            unlink($fileDestinationPath);

        }
    }
    else
        {
           return false;
        }
    return true;
}



