<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$id = $_POST['id'];
$material_type_id = $_POST['material_type_id'];
$material_lot = $_POST['material_lot'];
$material_quantity = $_POST['material_quantity'];

try {
    $sql = "UPDATE t_record_shot_material SET 
    shot_material_id = '$material_type_id' ,
    lot = '$material_lot' ,
    quantity = '$material_quantity'
    WHERE id= '$id'";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>