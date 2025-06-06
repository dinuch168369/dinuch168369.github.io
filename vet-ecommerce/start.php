<?php
require_once __DIR__ . '/includes/user_handler.php';
require_once __DIR__ . '/includes/facebook_helper.php';
require_once __DIR__ . '/includes/comment_handler.php';

session_start();
$user = getLoggedInUser();
if (!$user) {
    header('Location: index.php');
    exit;
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $live_video_id = $_POST['live_video_id'] ?? '';
    $accessToken = $user['fb_access_token'] ?? getAccessTokenFromSession();
    if (!$accessToken) {
        $message = "No Facebook access token available.";
    } else {
        $comments = fetchLiveComments($live_video_id, $accessToken);
        if (isset($comments['error'])) {
            $message = $comments['error'];
        } else {
            storeComments($user['id'], $live_video_id, $comments);
            $message = "Fetched and stored " . count($comments) . " comments.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fetch Facebook Live Comments</title>
</head>
<body>
    <h1>Fetch Comments for a Live Video</h1>
    <form method="post">
        <label for="live_video_id">Live Video ID:</label>
        <input type="text" name="live_video_id" id="live_video_id" required>
        <button type="submit">Fetch Comments</button>
    </form>
    <?php if ($message) echo "<p>$message</p>"; ?>
    <br>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>