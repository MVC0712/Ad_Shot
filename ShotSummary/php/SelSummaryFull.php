<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$sql ="";
$sql1 = "";
$start_s = "2022/12/01";
$end_s = "2022/12/05";

  $begin = new DateTime($start_s);
  $end = new DateTime($end_s);
  $end = $end->modify( '+1 day' );
  $interval = DateInterval::createFromDateString('1 day');
  $period = new DatePeriod($begin, $interval, $end);
  foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
  }
$sql1 = $sql1."
SELECT 
    '1' AS o,
    m_product.id AS idd,
    m_product.product_name,
";
  foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql1 = $sql1 ." MAX(CASE WHEN t_record_anod.product_date = '" . $di . "' THEN t10.ttq ELSE '' END) AS '_" . $din ."',";
    }
    $sql2 = substr(trim($sql1), 0, -1);
    $sql2 = $sql2." FROM t_record_anod 
    LEFT JOIN
    m_product ON m_product.id = t_record_anod.product_id
    LEFT JOIN
        (SELECT 
            '2' AS o,
            m_product.id AS iddd,
            product_date,
            m_product.product_name,
            SUM(input_quantity) - SUM(ng_quantity) AS ttq
        FROM
            t_record_anod
    LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
    GROUP BY product_date , iddd) t10 ON t10.iddd = t_record_anod.product_id
        AND t10.product_date = t_record_anod.product_date
GROUP BY idd 
UNION SELECT 
    '2' AS o,
    m_product.id AS idd,
    m_product.product_name,
";
    $sql3="";
    foreach ($period as $dtp) {
    $dp = $dtp->format("Y-m-d");
    $dpn = $dtp->format("Ymd");
    $sql3 = $sql3 ." MAX(CASE WHEN t_anod_plan.product_date = '". $dp ."' THEN t10.ttq ELSE '' END) AS '_". $dpn ."',";
    }
    $sql3 = substr(trim($sql3), 0, -1);
    $sql3 = $sql3." FROM t_anod_plan
    LEFT JOIN
        m_product ON m_product.id = t_anod_plan.production_id
    LEFT JOIN
        (SELECT 
            '2' AS o,
            m_product.id AS iddd,
            product_date,
            m_product.product_name,
            SUM(quantity) AS ttq
        FROM
            t_anod_plan
    LEFT JOIN m_product ON m_product.id = t_anod_plan.production_id
    GROUP BY product_date , iddd) t10 ON t10.iddd = t_anod_plan.production_id
        AND t10.product_date = t_anod_plan.product_date
GROUP BY idd
ORDER BY idd DESC , o ASC;";
    $sql = $sql2.$sql3;
try {
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>