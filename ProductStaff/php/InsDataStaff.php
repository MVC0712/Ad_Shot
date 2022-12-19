<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}

$name = $_POST['name'];
$join_date = $_POST['join_date'];
$position_id = $_POST['position_id'];
$code = $_POST['code'];

try {
    $sql = "INSERT INTO m_staff (name, code, position_id, join_date) VALUES (
        '$name', '$code', '$position_id', '$join_date')";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>