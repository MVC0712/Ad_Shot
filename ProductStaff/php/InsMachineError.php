<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}

$code = $_POST['machine_error'];
$description = $_POST['machine_error_code'];

try {
    $sql = "INSERT INTO m_code (code, description) VALUES ('$code', '$description')";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>