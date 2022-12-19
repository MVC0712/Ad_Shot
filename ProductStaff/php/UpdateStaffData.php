<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$id = $_POST['targetId'];
$name = $_POST['name'];
$code = $_POST['code'];
$position_id = $_POST['position_id'];
$join_date = $_POST['join_date'];
$leave_date = $_POST['leave_date'];

try {
    $sql = "UPDATE m_staff SET 
    name = '$name' ,
    code = '$code' ,
    position_id = '$position_id' ,
    join_date = '$join_date' ,
    leave_date = '$leave_date'
    WHERE id= '$id'";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>