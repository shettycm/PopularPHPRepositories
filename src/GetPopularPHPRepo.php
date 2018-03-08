<?php
/* This script is run as cron job to update the repo_details table repeatedly. */
namespace Shettycm;

require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

$client = new \GuzzleHttp\Client();
/* ToDo: Parse Link header and get the next link to make request. rel="last" contains last page request. */
for($i=1; $i<=5; $i++){
    $url = 'https://api.github.com/search/repositories?q=is:public+language:php&sort=stars&order=desc&page=' . $i;
    $response = $client->request(
        'GET',
        $url,
        [
        'header' =>
            [
            'Accept' => 'application/json',
            'Content-type' => 'application/json'
            ]
        ]
    );
    $content = json_decode($response->getBody()->getContents(), true);
    $data = $content['items'];
    $config = parse_ini_file("config.ini");
    $db = new \PDO('mysql:host='.$config['HOST'].';dbname='.$config['DBNAME'].';charset=utf8', $config['USERNAME'], $config['PASSWORD']);
    try {
        $sql = "INSERT INTO repo_details(ID, name, URL, created_date, last_push_date, description, stars) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if (count($data) > 1) {
            $sql .= str_repeat(",(?, ?, ?, ?, ?, ?, ?)", count($data) - 1);
        }
        $sql .= " ON DUPLICATE KEY UPDATE stars = VALUES(stars)";
        $insertData = [];
        foreach ($data as $datum) {
            $insertData[] = $datum['id'];
            $insertData[] = $datum['name'];
            $insertData[] = $datum['url'];
            $insertData[] = date("Y-m-d H:i:s", strtotime($datum['created_at']));
            $insertData[] = date("Y-m-d H:i:s", strtotime($datum['pushed_at']));
            $insertData[] = $datum['description'];
            $insertData[] = $datum['stargazers_count'];
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($insertData);
    } catch(\PDOException $ex) {
        echo "An Error occured!" . $ex->getMessage();
    }
}
?>

