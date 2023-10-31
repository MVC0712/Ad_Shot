<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$sql ="";
$sql1 = "";
$sql2 = "";
$sql3 = "";
$sql4 = "";
$sql5 = "";
$sql6 = "";
$sql7 = "";
$sql8 = "";
$sql9 = "";
$sql10 = "";
$arr = array();

// $start_s = "2022/12/01";
// $end_s = "2022/12/05";
$start_s = $_POST['start_s'];
$end_s = $_POST['end_s'];

$begin = new DateTime($start_s);
$end = new DateTime($end_s);
$end = $end->modify( '+1 day' );
$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);

foreach ($period as $key => $dt) {
    $din = $dt->format("Ymd");
    $arr[] = $din;
}

$sql1 = "SELECT 
    'Total' AS product_name,
    '' AS 'Total Actual',
    '' AS 'Total plan',
    '' AS 'Completion rate',
    'Plan' AS 'PlanOrActual',
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql1 = $sql1 ." MAX(CASE WHEN t_anod_plan.product_date = '" . $di . "' THEN t103.ttq ELSE '' END) AS '_" . $din ."',";
}
$sql1 = substr(trim($sql1), 0, -1);
$sql1 = $sql1." FROM
t_anod_plan
    LEFT JOIN
m_product ON m_product.id = t_anod_plan.production_id
    LEFT JOIN
(SELECT 
        m_product.id AS iddd,
        product_date,
        m_product.product_name,
        SUM(quantity) AS ttq
FROM
    t_anod_plan
LEFT JOIN m_product ON m_product.id = t_anod_plan.production_id
GROUP BY product_date) t103 ON t103.iddd = t_anod_plan.production_id
    AND t103.product_date = t_anod_plan.product_date ";

$sql2 = " UNION SELECT 
    'Total' AS product_name,
    '' AS 'Total Actual',
    (
";

for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql2 = $sql2."t1003._".$arr[$i]."+";
}
$sql2 = substr(trim($sql2), 0, -1);
$sql2 = $sql2.") AS 'Total plan',
    '' AS 'Completion rate',
    'Total plan' AS 'PlanOrActual',
";
for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql2 = $sql2."(";
    for ($j = 0; $j <= $i; $j++) {
        $sql2 = $sql2."t1003._".$arr[$j]."+";
    }
    $sql2 = substr(trim($sql2), 0, -1);
    $sql2 = $sql2.") AS _".$arr[$i];
    $sql2 = $sql2." , ";
}
$sql2 = substr(trim($sql2), 0, -1);
$sql2 = $sql2."FROM
    (SELECT 
    m_product.id AS idd,
    m_product.product_name,
";
foreach ($period as $dtp) {
    $dp = $dtp->format("Y-m-d");
    $dpn = $dtp->format("Ymd");
    $sql2 = $sql2 ." MAX(CASE WHEN t_anod_plan.product_date = '". $dp ."' THEN t103.ttq ELSE '' END) AS '_". $dpn ."' ,";
    }
    $sql2 = substr(trim($sql2), 0, -1);
    $sql2 = $sql2." FROM
    t_anod_plan
LEFT JOIN m_product ON m_product.id = t_anod_plan.production_id
LEFT JOIN (SELECT 
        m_product.id AS iddd,
        product_date,
        m_product.product_name,
        SUM(quantity) AS ttq
FROM
    t_anod_plan
LEFT JOIN m_product ON m_product.id = t_anod_plan.production_id
GROUP BY product_date) t103 ON t103.iddd = t_anod_plan.production_id
    AND t103.product_date = t_anod_plan.product_date) t1003 ";

$sql3 = " UNION SELECT 
    'Total' AS product_name,
    '' AS 'Total Actual',
    '' AS 'Total plan',
    '' AS 'Completion rate',
    'Actual' AS 'PlanOrActual',
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql3 = $sql3 ." MAX(CASE WHEN t_record_anod.product_date = '" . $di . "' THEN t104.ttqq ELSE '' END) AS '_" . $din ."',";
}
$sql3 = substr(trim($sql3), 0, -1);
$sql3 = $sql3." FROM
t_record_anod
    LEFT JOIN
m_product ON m_product.id = t_record_anod.product_id
    LEFT JOIN
(SELECT 
        m_product.id AS idddd,
        product_date,
        m_product.product_name,
        SUM(input_quantity) - SUM(ng_quantity) AS ttqq
FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
GROUP BY product_date) t104 ON t104.idddd = t_record_anod.product_id
    AND t104.product_date = t_record_anod.product_date ";

    $sqlng = " UNION SELECT 
    'Total' AS product_name,
    '' AS 'Total Actual',
    '' AS 'Total plan',
    '' AS 'Completion rate',
    'NG' AS 'PlanOrActual',
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sqlng = $sqlng ." MAX(CASE WHEN t_record_anod.product_date = '" . $di . "' THEN t105.ttqq ELSE '' END) AS '_" . $din ."',";
}
$sqlng = substr(trim($sqlng), 0, -1);
$sqlng = $sqlng." FROM
t_record_anod
    LEFT JOIN
m_product ON m_product.id = t_record_anod.product_id
    LEFT JOIN
(SELECT 
        record_anod_id AS idddd,
        product_date,
        SUM(t_record_anod_error.ng_quantity) AS ttqq
FROM
    t_record_anod_error 
LEFT JOIN t_record_anod ON t_record_anod.id = t_record_anod_error.record_anod_id
GROUP BY product_date) t105 ON t105.idddd = t_record_anod.id ";

$sql4 = " UNION SELECT 
    'Total' AS product_name,
    (
";

for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql4 = $sql4."t1004._".$arr[$i]."+";
}
$sql4 = substr(trim($sql4), 0, -1);
$sql4 = $sql4.") AS 'Total Actual',
    '' AS 'Total plan',
    '' AS 'Completion rate',
    'Total Actual' AS 'PlanOrActual',
";
for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql4 = $sql4."(";
    for ($j = 0; $j <= $i; $j++) {
        $sql4 = $sql4."t1004._".$arr[$j]."+";
    }
    $sql4 = substr(trim($sql4), 0, -1);
    $sql4 = $sql4.") AS _".$arr[$i];
    $sql4 = $sql4." , ";
}
$sql4 = substr(trim($sql4), 0, -1);
$sql4 = $sql4." FROM
    (SELECT 
        m_product.id AS idd,
        m_product.product_name,
";
foreach ($period as $dtp) {
    $dp = $dtp->format("Y-m-d");
    $dpn = $dtp->format("Ymd");
    $sql4 = $sql4 ." MAX(CASE WHEN t_record_anod.product_date = '". $dp ."' THEN t104.ttqq ELSE '' END) AS '_". $dpn ."' ,";
    }
    $sql4 = substr(trim($sql4), 0, -1);
    $sql4 = $sql4." FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
LEFT JOIN (SELECT 
        m_product.id AS idddd,
        product_date,
        m_product.product_name,
        SUM(input_quantity) - SUM(ng_quantity) AS ttqq
FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
GROUP BY product_date) t104 ON t104.idddd = t_record_anod.product_id
    AND t104.product_date = t_record_anod.product_date) t1004 ";

$sql5 = " UNION SELECT 
    m_product.product_name AS product_name,
    '' AS 'Total Actual',
    '' AS 'Total plan',
    '' AS 'Completion rate',
    'Plan' AS 'PlanOrActual',
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql5 = $sql5 ." MAX(CASE WHEN t_anod_plan.product_date = '" . $di . "' THEN t10.ttq ELSE '' END) AS '_" . $din ."',";
}
$sql5 = substr(trim($sql5), 0, -1);
$sql5 = $sql5." FROM
t_anod_plan
    LEFT JOIN
m_product ON m_product.id = t_anod_plan.production_id
    LEFT JOIN
(SELECT 
    m_product.id AS iddd,
        product_date,
        m_product.product_name,
        SUM(quantity) AS ttq
FROM
    t_anod_plan
LEFT JOIN m_product ON m_product.id = t_anod_plan.production_id
GROUP BY product_date , iddd) t10 ON t10.iddd = t_anod_plan.production_id
    AND t10.product_date = t_anod_plan.product_date
GROUP BY product_name ";

$sql6 = " UNION SELECT 
    t1003.product_name AS product_name,
    '' AS 'Total Actual',
    (
";

for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql6 = $sql6."t1003._".$arr[$i]."+";
}
$sql6 = substr(trim($sql6), 0, -1);
$sql6 = $sql6.") AS 'Total plan',
    '' AS 'Completion rate',
    'Total plan' AS 'PlanOrActual',
";
for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql6 = $sql6."(";
    for ($j = 0; $j <= $i; $j++) {
        $sql6 = $sql6."t1003._".$arr[$j]."+";
    }
    $sql6 = substr(trim($sql6), 0, -1);
    $sql6 = $sql6.") AS _".$arr[$i];
    $sql6 = $sql6." , ";
}
$sql6 = substr(trim($sql6), 0, -1);
$sql6 = $sql6." FROM
    (SELECT 
        m_product.id AS idd,
        m_product.product_name,
";
foreach ($period as $dtp) {
    $dp = $dtp->format("Y-m-d");
    $dpn = $dtp->format("Ymd");
    $sql6 = $sql6 ." MAX(CASE WHEN t_anod_plan.product_date = '". $dp ."' THEN t103.ttq ELSE '' END) AS '_". $dpn ."' ,";
    }
    $sql6 = substr(trim($sql6), 0, -1);
    $sql6 = $sql6." FROM
    t_anod_plan
LEFT JOIN m_product ON m_product.id = t_anod_plan.production_id
LEFT JOIN (SELECT 
        m_product.id AS iddd,
        product_date,
        m_product.product_name,
        SUM(quantity) AS ttq
FROM
    t_anod_plan
LEFT JOIN m_product ON m_product.id = t_anod_plan.production_id
GROUP BY product_date , iddd) t103 ON t103.iddd = t_anod_plan.production_id
    AND t103.product_date = t_anod_plan.product_date
GROUP BY product_name) t1003  ";

$sql7 = " UNION SELECT 
    m_product.product_name AS product_name,
    '' AS 'Total Actual',
    '' AS 'Total plan',
    '' AS 'Completion rate',
    'Actual' AS 'PlanOrActual',
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql7 = $sql7 ." MAX(CASE WHEN t_record_anod.product_date = '" . $di . "' THEN t10.ttq ELSE '' END) AS '_" . $din ."',";
}
$sql7 = substr(trim($sql7), 0, -1);
$sql7 = $sql7." FROM
t_record_anod
    LEFT JOIN
m_product ON m_product.id = t_record_anod.product_id
    LEFT JOIN
(SELECT 
    m_product.id AS iddd,
        product_date,
        m_product.product_name,
        SUM(input_quantity) - SUM(ng_quantity) AS ttq
FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
GROUP BY product_date , iddd) t10 ON t10.iddd = t_record_anod.product_id
    AND t10.product_date = t_record_anod.product_date
GROUP BY product_name ";

$sql8 = " UNION SELECT 
    t1004.product_name AS product_name,
    (
";

for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql8 = $sql8."t1004._".$arr[$i]."+";
}
$sql8 = substr(trim($sql8), 0, -1);
$sql8 = $sql8.") AS 'Total Actual',
    '' AS 'Total plan',
    '' AS 'Completion rate',
    'Total Actual' AS 'PlanOrActual',
";
for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql8 = $sql8."(";
    for ($j = 0; $j <= $i; $j++) {
        $sql8 = $sql8."t1004._".$arr[$j]."+";
    }
    $sql8 = substr(trim($sql8), 0, -1);
    $sql8 = $sql8.") AS _".$arr[$i];
    $sql8 = $sql8." , ";
}
$sql8 = substr(trim($sql8), 0, -1);
$sql8 = $sql8." FROM
    (SELECT 
        m_product.id AS idd,
        m_product.product_name,
";
foreach ($period as $dtp) {
    $dp = $dtp->format("Y-m-d");
    $dpn = $dtp->format("Ymd");
    $sql8 = $sql8 ." MAX(CASE WHEN t_record_anod.product_date = '". $dp ."' THEN t104.ttqq ELSE '' END) AS '_". $dpn ."' ,";
    }
    $sql8 = substr(trim($sql8), 0, -1);
    $sql8 = $sql8." FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
LEFT JOIN (SELECT 
        m_product.id AS idddd,
        product_date,
        m_product.product_name,
        SUM(input_quantity) - SUM(ng_quantity) AS ttqq
FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
GROUP BY product_date , idddd) t104 ON t104.idddd = t_record_anod.product_id
    AND t104.product_date = t_record_anod.product_date
GROUP BY product_name) t1004";

$sql = "SELECT * FROM (".$sql1.$sql2.$sql3.$sqlng.$sql4.$sql5.$sql6.$sql7.$sql8.") tt 
ORDER BY 
product_name DESC,
CASE tt.PlanOrActual
WHEN 'Plan' THEN 4
WHEN 'Total plan' THEN 3
WHEN 'Actual' THEN 2
WHEN 'Total actual' THEN 1
ELSE 0
END DESC";
// print_r($sql);

try {
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>