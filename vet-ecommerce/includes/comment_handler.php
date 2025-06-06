<?php
    require_once __DIR__ . '/facebook_helper.php';
    require_once __DIR__ . '/user_handler.php';

function fetchLiveComments($liveVideoId, $accessToken) {
    $fb = getFacebookClient();
    try {
        $response = $fb->get(
            "/$liveVideoId/tbl_comments?order=reverse_chronological&live_filter=stream",
            $accessToken
        );
        return $response->getGraphEdge()->asArray();
    } catch(Exception $e) {
        return ['error' => 'Error: ' . $e->getMessage()];
    }
}

function saveCommentToDb($user_id, $video_id, $comment) {
    $pdo = db();
    $stmt = $pdo->prepare('INSERT INTO tbl_comments (user_id, video_id, comment_id, message, from_name, created_time) VALUES (?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE message=VALUES(message), from_name=VALUES(from_name), created_time=VALUES(created_time)');
    $stmt->execute([
        $user_id,
        $video_id,
        $comment['id'],
        $comment['message'] ?? '',
        $comment['from']['name'] ?? '',
        isset($comment['created_time']) ? date('Y-m-d H:i:s', strtotime($comment['created_time'])) : null
    ]);
}

function storeComments($user_id, $video_id, $comments) {
    foreach ($comments as $comment) {
        saveCommentToDb($user_id, $video_id, $comment);
    }
}
?>