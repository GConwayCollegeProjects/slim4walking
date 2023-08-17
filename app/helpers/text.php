<?php




$error          = false;
$result         = false;
$table          = "text";
$id_field       = "text_id";
$start          = 0;



$sql        = "SELECT * from text" ;



$field1 = "text_id" ;
$field2 = "text_subject" ;
$field3 = "text_text" ;
$field4 = "text_amended" ;
$field5 = "text_disabled";
$field6 = "text_changed_by";



try {
    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $result =$stmt->fetchAll();

    //var_dump($result);
} catch (PDOException $e) {
    $error = $e->getMessage();
}
//  ******************************************************** Start of Div Frame



//echo "<hr> ";
$count = 0;
$rowno = 0;
$color = array('lightblue', 'lightgreen', 'lightgrey');

echo "<div style='max-height: 200px; max-width 70%; background-color: white
        font-size: x-small; overflow: auto; padding: 0 .5em; text-overflow: clip'>";


foreach ($result as $key => $row) {
    $color2 = 'style="background-color: '.$color[$count].'"';
    echo '<div id='.$rowno.' onclick="selectText($this.id)" style="position: relative; background-color: '.$color[$count].';" >';
    echo '<div class = "row" style="max-width: 90%; margin: 0 auto; overflow: auto;">';
    $full_input = $row[$field3];
    $length = 200;
    $short_input ="";
    if (strlen($full_input)>$length) {
        $short_input = function_that_shortens_text_but_doesnt_cutoff_words($full_input, $length);
    } else {
        $short_input =$full_input;
    }

    echo $short_input;
    echo '<hr>';
    echo '</div>';
    $rowno ++;
    $count ++;
    if ($count===3) {
        $count = 0;
    };
}

