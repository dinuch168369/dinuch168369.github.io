link: https://developers.facebook.com/apps/ 
Create an app -> App name -> Other -> Select an app type
    noted: for user facebook account Select Consumer / for facebook page Select Business 
*** How the System Works ***
#1 Configuration
    -config/config.php: Holds your app credentials, Facebook app settings, and database configuration.
#2 Database
    -database/database.sql: Defines tables for users and comments. Make sure you have at least a users and comments table, with fields to link comments to videos and users.
#3 Core Logic
    -includes/facebook_helper.php: Handles Facebook SDK initialization, login URL generation, token exchange, and API calls.
    -includes/user_handler.php: Manages user login/registration, both via email and Facebook OAuth.
    -includes/comment_handler.php: Contains functions to fetch comments from Facebook videos (using the video ID and the Graph API) and save them to your database.
#4 Polling Tool
    -tools/poll_live_comments.php: (Optional) A CLI utility to continuously poll Facebook for new comments on a live video and store them.
#5 Public-Facing Pages
    -public/index.php: User login page (should support both email/password and Facebook login).
    -public/callback.php: Handles OAuth callback from Facebook, retrieves user info, and logs the user in or registers them.
    -public/dashboard.php: Displays user info, past fetched comments, and allows access to comment-fetching features.
    -public/start.php: Lets logged-in users enter a Facebook Live video ID to start capturing comments.
    -public/logout.php: Destroys session and logs out the user.
#6 Vendor
    -vendor/composer.json: Facebook PHP SDK and other dependencies managed by Composer.
