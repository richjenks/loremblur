<?php
	$url = @( $_SERVER['HTTPS'] != 'on' ) ? 'http://' : 'https://';         // Protocol
	$url .= $_SERVER['SERVER_NAME'];                                        // Host
	if ($_SERVER['SERVER_PORT'] != 80) $url .= ':'.$_SERVER['SERVER_PORT']; // Port
	if ($_SERVER['REQUEST_URI'] !== '/') $url .= $_SERVER['REQUEST_URI'];   // Request
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Loremblur</title>
	<link rel="stylesheet" href="style.css">
	<meta name="viewport" content="width=device-width,initial-scale=1" />
</head>
<body>
	<div class="container">
		<h1><b>loremblur.io</b> provides neutral and inoffensive coloured placeholder images</h1>
		<div class="content">
			<p>Add the size of the image you want after the URL and you'll get a placeholder:</p>
			<a class="code" target="_blank" href="<?= $url; ?>?200x150"><?= $url; ?>?200x150</a>
			<img src="<?= $url; ?>?200x150">
			<p>Or just use one number to get a square placeholder:</p>
			<code>&lt;img src="<?= $url; ?>?70"&gt;</code>
			<img src="<?= $url; ?>?70">
		</div>
	</div>
</body>
</html>
