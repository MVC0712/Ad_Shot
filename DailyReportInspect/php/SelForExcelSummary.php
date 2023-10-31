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
$sqL4 = "";
$sql5 = "";
$sql6 = "";
$sql7 = "";
$sqL8 = "";
$sql9 = "";
$sql10 = "";
$sql11 = "";
$sqL12 = "";
$total = "(";
$total1 = "(";

$arr = array();

$start_s = "2023/09/13";
$end_s = "2023/09/15";
// $start_s = $_POST['start_s'];
// $end_s = $_POST['end_s'];

$begin = new DateTime($start_s);
$end = new DateTime($end_s);
$end = $end->modify( '+1 day' );
$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);

foreach ($period as $key => $dt) {
    $din = $dt->format("Ymd");
    $arr[] = $din;
}

for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $total = $total."t1003._".$arr[$i]."+";
}
$total = substr(trim($total), 0, -1);
$total = $total." )";

for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $total1 = $total1."t1004._".$arr[$i]."+";
}
$total1 = substr(trim($total1), 0, -1);
$total1 = $total1." )";

$sql1 = "SELECT 
    '1' AS a,
    '合計' AS 品番,
    '' AS 計画数量,
    '' AS 実績数量,
    '' AS 実績完成率,
    '計画' AS 計画／実績,
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
    '2' AS a,
    '合計' AS 品番,
    '' AS 計画数量,
    (
";

for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql2 = $sql2."t1003._".$arr[$i]."+";
}
$sql2 = substr(trim($sql2), 0, -1);
$sql2 = $sql2.") AS 実績数量,
    '' AS 実績完成率,
    '累計計画' AS 計画／実績,
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

$sqL4 = " UNION SELECT 
            '4' AS a,
            '合計' AS 品番,
            '' AS 計画数量,
            '' AS 実績数量,
            '' AS 実績完成率,
            '実績' AS 計画／実績,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sqL4 = $sqL4 ." MAX(CASE WHEN t_record_anod.product_date = '" . $di . "' THEN t104.ttqq ELSE '' END) AS '_" . $din ."',";
}
$sqL4 = substr(trim($sqL4), 0, -1);
$sqL4 = $sqL4." FROM
t_record_anod
    LEFT JOIN
m_product ON m_product.id = t_record_anod.product_id
    LEFT JOIN
(SELECT 
        m_product.id AS idddd,
        product_date,
        m_product.product_name,
        IFNULL(SUM(input_quantity), 0) - IFNULL(SUM(ng_quantity), 0) AS ttqq
FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
GROUP BY product_date) t104 ON t104.idddd = t_record_anod.product_id
    AND t104.product_date = t_record_anod.product_date ";

$sql5 = " UNION SELECT 
    '5' AS a,
    '合計' AS 品番,
    (
";

for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql5 = $sql5."t1004._".$arr[$i]."+";
}
$sql5 = substr(trim($sql5), 0, -1);
$sql5 = $sql5.") AS 計画数量,
    '' AS 実績数量,
    '' AS 実績完成率,
    '累計実績' AS 計画／実績,
";
for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql5 = $sql5."(";
    for ($j = 0; $j <= $i; $j++) {
        $sql5 = $sql5."t1004._".$arr[$j]."+";
    }
    $sql5 = substr(trim($sql5), 0, -1);
    $sql5 = $sql5.") AS _".$arr[$i];
    $sql5 = $sql5." , ";
}
$sql5 = substr(trim($sql5), 0, -1);
$sql5 = $sql5." FROM
    (SELECT 
        m_product.id AS idd,
        m_product.product_name,
";
foreach ($period as $dtp) {
    $dp = $dtp->format("Y-m-d");
    $dpn = $dtp->format("Ymd");
    $sql5 = $sql5 ." MAX(CASE WHEN t_record_anod.product_date = '". $dp ."' THEN t104.ttqq ELSE '' END) AS '_". $dpn ."' ,";
    }
    $sql5 = substr(trim($sql5), 0, -1);
    $sql5 = $sql5." FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
LEFT JOIN (SELECT 
        m_product.id AS idddd,
        product_date,
        m_product.product_name,
        IFNULL(SUM(input_quantity), 0) - IFNULL(SUM(ng_quantity), 0) AS ttqq
FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
GROUP BY product_date) t104 ON t104.idddd = t_record_anod.product_id
    AND t104.product_date = t_record_anod.product_date) t1004 ";

$sql3 = " UNION SELECT 
    '3' AS a,
    '合計' AS 品番,
    '' AS 計画数量,
    (
";

for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql3 = $sql3."t1003._".$arr[$i]."+";
}
$sql3 = substr(trim($sql3), 0, -1);
$sql3 = $sql3.") AS 実績数量,
    '' AS 実績完成率,
    '完成率計画' AS 計画／実績,
";
for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql3 = $sql3." ROUND((";
    for ($j = 0; $j <= $i; $j++) {
        $sql3 = $sql3."t1003._".$arr[$j]."+";
    }
    $sql3 = substr(trim($sql3), 0, -1);
    $sql3 = $sql3.")/".$total.",1) AS _".$arr[$i];
    $sql3 = $sql3." , ";
}
$sql3 = substr(trim($sql3), 0, -1);
$sql3 = $sql3."FROM
    (SELECT 
    m_product.id AS idd,
    m_product.product_name,
";
foreach ($period as $dtp) {
    $dp = $dtp->format("Y-m-d");
    $dpn = $dtp->format("Ymd");
    $sql3 = $sql3 ." MAX(CASE WHEN t_anod_plan.product_date = '". $dp ."' THEN t103.ttq ELSE '' END) AS '_". $dpn ."' ,";
    }
    $sql3 = substr(trim($sql3), 0, -1);
    $sql3 = $sql3." FROM
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

$sql6 = " UNION SELECT 
    '6' AS a,
    '合計' AS 品番,
    (
";

for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql6 = $sql6."t1004._".$arr[$i]."+";
}
$sql6 = substr(trim($sql6), 0, -1);
$sql6 = $sql6.") AS 計画数量,
    '' AS 実績数量,
    '' AS 実績完成率,
    '完成率実績' AS 計画／実績,
";
for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql6 = $sql6."ROUND((";
    for ($j = 0; $j <= $i; $j++) {
        $sql6 = $sql6."t1004._".$arr[$j]."+";
    }
    $sql6 = substr(trim($sql6), 0, -1);
    $sql6 = $sql6.")/".$total1.",1) AS _".$arr[$i];
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
    $sql6 = $sql6 ." MAX(CASE WHEN t_record_anod.product_date = '". $dp ."' THEN t104.ttqq ELSE '' END) AS '_". $dpn ."' ,";
    }
    $sql6 = substr(trim($sql6), 0, -1);
    $sql6 = $sql6." FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
LEFT JOIN (SELECT 
        m_product.id AS idddd,
        product_date,
        m_product.product_name,
        IFNULL(SUM(input_quantity), 0) - IFNULL(SUM(ng_quantity), 0) AS ttqq
FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
GROUP BY product_date) t104 ON t104.idddd = t_record_anod.product_id
    AND t104.product_date = t_record_anod.product_date) t1004 ";


$sqL8 = " UNION SELECT 
    '7' AS a,
    '合計' AS 品番,
    '' AS 計画数量,
    '' AS 実績数量,
    '' AS 実績完成率,
    '稼働率' AS 計画／実績,
";

foreach ($period as $dt) {
$di = $dt->format("Y-m-d");
$din = $dt->format("Ymd");
$sqL8 = $sqL8 ." MAX(CASE WHEN t_record_anod.product_date = '" . $di . "' THEN t_record_anod.performance ELSE '' END) AS '_" . $din ."',";
}
$sqL8 = substr(trim($sqL8), 0, -1);
$sqL8 = $sqL8." FROM
t_record_anod ";

$sql7 = " UNION SELECT 
    '1' AS a,
    m_product.product_name AS 品番,
    '' AS 計画数量,
    '' AS 実績数量,
    '' AS 実績完成率,
    '計画' AS 計画／実績,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql7 = $sql7 ." MAX(CASE WHEN t_anod_plan.product_date = '" . $di . "' THEN t10.ttq ELSE '' END) AS '_" . $din ."',";
}
$sql7 = substr(trim($sql7), 0, -1);
$sql7 = $sql7." FROM
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
GROUP BY m_product.product_name ";

$sql9 = " UNION SELECT 
    '2' AS a,
    t1003.product_name AS 品番,
    '' AS 計画数量,
    (
";

for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql9 = $sql9."t1003._".$arr[$i]."+";
}
$sql9 = substr(trim($sql9), 0, -1);
$sql9 = $sql9.") AS 実績数量,
    '' AS 実績完成率,
    '累計計画' AS 計画／実績,
";
for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql9 = $sql9."(";
    for ($j = 0; $j <= $i; $j++) {
        $sql9 = $sql9."t1003._".$arr[$j]."+";
    }
    $sql9 = substr(trim($sql9), 0, -1);
    $sql9 = $sql9.") AS _".$arr[$i];
    $sql9 = $sql9." , ";
}
$sql9 = substr(trim($sql9), 0, -1);
$sql9 = $sql9." FROM
    (SELECT 
        m_product.id AS idd,
        m_product.product_name,
";
foreach ($period as $dtp) {
    $dp = $dtp->format("Y-m-d");
    $dpn = $dtp->format("Ymd");
    $sql9 = $sql9 ." MAX(CASE WHEN t_anod_plan.product_date = '". $dp ."' THEN t103.ttq ELSE '' END) AS '_". $dpn ."' ,";
    }
    $sql9 = substr(trim($sql9), 0, -1);
    $sql9 = $sql9." FROM
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

$sql10 = " UNION SELECT 
    '4' AS a,
    m_product.product_name AS 品番,
    '' AS 計画数量,
    '' AS 実績数量,
    '' AS 実績完成率,
    '実績' AS 計画／実績,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql10 = $sql10 ." MAX(CASE WHEN t_record_anod.product_date = '" . $di . "' THEN t10.ttq ELSE '' END) AS '_" . $din ."',";
}
$sql10 = substr(trim($sql10), 0, -1);
$sql10 = $sql10." FROM
t_record_anod
    LEFT JOIN
m_product ON m_product.id = t_record_anod.product_id
    LEFT JOIN
(SELECT 
    m_product.id AS iddd,
        product_date,
        m_product.product_name,
        IFNULL(SUM(input_quantity), 0) - IFNULL(SUM(ng_quantity), 0) AS ttq
FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
GROUP BY product_date , iddd) t10 ON t10.iddd = t_record_anod.product_id
    AND t10.product_date = t_record_anod.product_date
GROUP BY m_product.product_name ";

$sql11 = " UNION SELECT 
    '5' AS a,
    t1004.product_name AS 品番,
    (
";

for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql11 = $sql11."t1004._".$arr[$i]."+";
}
$sql11 = substr(trim($sql11), 0, -1);
$sql11 = $sql11.") AS 計画数量,
    '' AS 実績数量,
    '' AS 実績完成率,
    '累計実績' AS 計画／実績,
";
for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sql11 = $sql11."(";
    for ($j = 0; $j <= $i; $j++) {
        $sql11 = $sql11."t1004._".$arr[$j]."+";
    }
    $sql11 = substr(trim($sql11), 0, -1);
    $sql11 = $sql11.") AS _".$arr[$i];
    $sql11 = $sql11." , ";
}
$sql11 = substr(trim($sql11), 0, -1);
$sql11 = $sql11." FROM
    (SELECT 
        m_product.id AS idd,
        m_product.product_name,
";
foreach ($period as $dtp) {
    $dp = $dtp->format("Y-m-d");
    $dpn = $dtp->format("Ymd");
    $sql11 = $sql11 ." MAX(CASE WHEN t_record_anod.product_date = '". $dp ."' THEN t104.ttqq ELSE '' END) AS '_". $dpn ."' ,";
    }
    $sql11 = substr(trim($sql11), 0, -1);
    $sql11 = $sql11." FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
LEFT JOIN (SELECT 
        m_product.id AS idddd,
        product_date,
        m_product.product_name,
        IFNULL(SUM(input_quantity), 0) - IFNULL(SUM(ng_quantity), 0) AS ttqq
FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
GROUP BY product_date , idddd) t104 ON t104.idddd = t_record_anod.product_id
    AND t104.product_date = t_record_anod.product_date
GROUP BY product_name) t1004 ";

$sqL12 = " UNION SELECT 
    '6' AS a,
    t1004.product_name AS 品番,
    (
";

for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sqL12 = $sqL12."t1004._".$arr[$i]."+";
}
$sqL12 = substr(trim($sqL12), 0, -1);
$sqL12 = $sqL12.") AS 計画数量,
    '' AS 実績数量,
    '' AS 実績完成率,
    '完成率' AS 計画／実績,
";
for ($i = 0; $i <= iterator_count($period)-1; $i++) {
    $sqL12 = $sqL12."ROUND((";
    for ($j = 0; $j <= $i; $j++) {
        $sqL12 = $sqL12."t1004._".$arr[$j]."+";
    }
    $sqL12 = substr(trim($sqL12), 0, -1);
    $sqL12 = $sqL12.")/".$total1.",1) AS _".$arr[$i];
    $sqL12 = $sqL12." , ";
}
$sqL12 = substr(trim($sqL12), 0, -1);
$sqL12 = $sqL12." FROM
    (SELECT 
        m_product.id AS idd,
        m_product.product_name,
";
foreach ($period as $dtp) {
    $dp = $dtp->format("Y-m-d");
    $dpn = $dtp->format("Ymd");
    $sqL12 = $sqL12 ." MAX(CASE WHEN t_record_anod.product_date = '". $dp ."' THEN t104.ttqq ELSE '' END) AS '_". $dpn ."' ,";
    }
    $sqL12 = substr(trim($sqL12), 0, -1);
    $sqL12 = $sqL12." FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
LEFT JOIN (SELECT 
        m_product.id AS idddd,
        product_date,
        m_product.product_name,
        IFNULL(SUM(input_quantity), 0) - IFNULL(SUM(ng_quantity), 0) AS ttqq
FROM
    t_record_anod
LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
GROUP BY product_date , idddd) t104 ON t104.idddd = t_record_anod.product_id
    AND t104.product_date = t_record_anod.product_date
GROUP BY product_name) t1004";


$sql = "SELECT * FROM (".$sql1.$sql2.$sql3.$sqL4.$sql5.$sql6.$sql7.$sqL8.$sql9.$sql10.$sql11.$sqL12.") tt 
    ORDER BY 
    tt.品番 DESC,
    tt.a ASC";

// print_r($sql6);

try {
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>