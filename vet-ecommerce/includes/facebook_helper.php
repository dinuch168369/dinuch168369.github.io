<?php
require_once __DIR__ . '/../vendor/autoload.php';

function getFacebookClient() {
    $config = require __DIR__ . '/../config/config.php';
    return new \Facebook\Facebook([
        'app_id' => $config['app_id'],
        'app_secret' => $config['app_secret'],
        'default_graph_version' => $config['default_graph_version'],
    ]);
}

function getLoginUrl() {
    $fb = getFacebookClient();
    $helper = $fb->getRedirectLoginHelper();
    $permissions = [
        'email',
        'public_profile',
        // 'pages_show_list',
        // 'pages_read_engagement',
        // 'pages_manage_metadata',
        // 'pages_read_user_content'
    ];
    
    $config = require __DIR__ . '/../config/config.php';
    return $helper->getLoginUrl($config['callback_url'], $permissions);
}

function getAccessTokenFromSession() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    return $_SESSION['fb_access_token'] ?? null;
}

function setAccessTokenToSession($accessToken) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION['fb_access_token'] = (string)$accessToken;
}

function getFacebookUserProfile($accessToken) {
    $fb = getFacebookClient();
    try {
        $response = $fb->get('/me?fields=id,first_name,last_name,email', $accessToken);
        return $response->getGraphUser();
    } catch (Exception $e) {
        return null;
    }
}
?>