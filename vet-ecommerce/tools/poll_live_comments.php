<?php
require_once __DIR__ . '/includes/facebook_helper.php';
require_once __DIR__ . '/includes/user_handler.php';
require_once __DIR__ . '/includes/user_handler.php';

// Set these before running, or make them script arguments
$live_video_id = 'YOUR_LIVE_VIDEO_ID';
$user_id = 1; // or get from your users table
$accessToken = 'YOUR_LONG_LIVED_PAGE_ACCESS_TOKEN';

$seen_comments = [];

echo "Polling comments for Live Video ID: $live_video_id\n";
while (true) {
    $comments = fetchLiveComments($live_video_id, $accessToken);

    if (isset($comments['error'])) {
        echo $comments['error'] . "\n";
    } else {
        foreach ($comments as $comment) {
            if (!in_array($comment['id'], $seen_comments)) {
                // Save only if not already seen (optional: check DB as well)
                saveCommentToDb($user_id, $live_video_id, $comment);
                $seen_comments[] = $comment['id'];
                echo "Saved comment: {$comment['id']} - {$comment['message']}\n";
            }
        }
    }
    // Poll every 10 seconds
    sleep(10);
}