<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$record_shot_id = $_POST['record_shot_id'];
$material_type_id = $_POST['material_type_id'];
$material_lot = $_POST['material_lot'];
$material_quantity = $_POST['material_quantity'];

try {
    $sql = "INSERT INTO t_record_shot_material( line_id, record_shot_id, shot_material_id, lot, quantity
      ) VALUES (
          2, '$record_shot_id', '$material_type_id', '$material_lot', '$material_quantity'
      )";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode("INSERTED");
} 
catch(PDOException $e) {
    echo $e;
}
?>