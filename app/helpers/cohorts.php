<?php




$error          = false;
$result         = false;
$table          = "flags";
$id_field       = "flags_id";
$start          = 0;



$sql        = "SELECT * from routes" ;



$field1 = "route_name" ;
$field2 = "route_distance" ;
$field3 = "route_ascent" ;
$field4 = "route_details" ;
$field5 = "route_id";
$field6 = 2;



try {
    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $result =$stmt->fetchAll();

    //var_dump($result);
} catch (PDOException $e) {
    $error = $e->getMessage();
}
//  ******************************************************** Start of Div Frame

echo '<div id="list" class="container-fluid frame"  >';


echo "<hr> ";
$count = 0;
$color = array('lightblue', 'lightgreen', 'lightgrey');

echo '<div>';

foreach ($result as $key => $row) {
    $color2 = 'style="background-color: '.$color[$count].'"';
    echo '<div id='.$row[$field5].' style="position: relative; background-color: '.$color[$count].';" >';
    echo '<p id='.$row[$field5].' class = "heading">'.$row[$field1].'</p>';
    echo '<div class = "row">';
    echo   '<div id='.$row[$field5].' class="col"><div class="distance"><b>Distance: </b>'.$row[$field2].' miles</div></div>
                <div id='.$row[$field5].' class = "col"><div class="ascent"><b>Ascent: </b>'.$row[$field3].' metres</div></div>
                </div>';
    $full_input = $row[$field4];
    $length = 100;
    $short_input ="";
    if (strlen($full_input)>$length) {
        $short_input = function_that_shortens_text_but_doesnt_cutoff_words($full_input, $length);
    } else {
        $short_input =$full_input;
    }
    echo   '<td><p id='.$row[$field5].' class="full-input text">'.$full_input.'</p></td>';
    echo   '<td><p id='.$row[$field5].' class="short-input text">'.$short_input.'</p></td>';

    echo '<hr>';
    echo '</div>';


    $count ++;
    if ($count===3) {
        $count = 0;
    };
}



echo '</div>' ;  //end Div List
