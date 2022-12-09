<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$targetId = "";
$targetId = $_POST['targetId'];
try {
    $sql = "SELECT id, shot_material_id, lot, quantity FROM t_record_shot_material
    WHERE
    line_id = '2' AND record_shot_id = '$targetId';";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>