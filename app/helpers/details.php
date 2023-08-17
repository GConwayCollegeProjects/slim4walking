<?php




$error          = false;
$result         = false;
$table          = "flags";
$id_field       = "flags_id";
$start          = 0;


$sql        = "SELECT * from routes where route_id = $id LIMIT 1" ;



$field1 = "route_name" ;
$field2 = "route_distance" ;
$field3 = "route_ascent" ;
$field4 = "route_details" ;
$field5 = "route_id";
$field6 = 2;



try {
    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $result =$stmt->fetch();
} catch (PDOException $e) {
    $error = $e->getMessage();
}

if ($result[0]['route_id']<1) {


    //$result[0]['route_details'];

    echo '<hr>';

    echo '<div>';


    echo '<div id=' . $result[$field5] . ' style="position: relative; background-color: var(--my-orange);" >';
    echo '<p id=' . $result[$field5] . ' class = "heading">' . $result[$field1] . '</p>';
    echo '<div class = "row">';
    echo '<div id=' . $result[$field5] . ' class="col"><div class="distance"><b>Distance: </b>' . $result[$field2] . ' miles</div></div>
                <div id=' . $result[$field5] . ' class = "col"><div class="ascent"><b>Ascent: </b>' . $result[$field3] . ' metres</div></div>
                </div>';
    $full_input = $result[$field4];

    echo '<div id=' . $result[$field5] . ' class="text">' . $full_input . '</div>';

    echo '<hr>';
    echo '</div>';
}