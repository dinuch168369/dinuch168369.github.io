<?php
	// get files in the current directory
	$files = scandir( getcwd() );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach ( $files as $file ) : ?>
				<?php if ( '.' != $file && '..' != $file && '.git' != $file && 'README.md' != $file && '.htaccess' != $file ) : ?>
					<li>
						<a href="<?php echo $file; ?>">
							<?php echo $file; ?>
						</a>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
</body>
</html>