<?php
/*ToDo: Read credentials from config.ini. Using parse_ini_file was giving 500 error when called from ajax*/
$db = new \PDO('mysql:host=localhost;dbname=repository;charset=utf8', 'root', 'root');
$data = [];
try {
    $stmt = $db->query("SELECT * FROM repo_details ORDER BY stars DESC");
    while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
} catch(\PDOException $ex) {
    echo "An Error occured!" . $ex->getMessage();
}
$results = [
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
];

header('Content-type: application/json');
echo json_encode($results);