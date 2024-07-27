<?php
$movie_id = $_GET['id'];
$api_url = "https://api.loliko.cn/movies/{$movie_id}";

$context = stream_context_create([
    'http' => [
        'ignore_errors' => true,
        'timeout' => 10  // 设置10秒超时
    ]
]);

$response = file_get_contents($api_url, false, $context);

if ($response === FALSE) {
    header("HTTP/1.1 500 Internal Server Error");
    echo json_encode(['error' => 'Failed to fetch data from API']);
} else {
    $responseData = json_decode($response, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        header('Content-Type: application/json');
        echo $response;
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(['error' => 'Invalid JSON response from API']);
    }
}
