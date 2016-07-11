<?php

/**
 * Loremblur
 *
 * Neutral and inoffensive coloured placeholder images
 */

// Show welcome page?
if (empty($_SERVER['QUERY_STRING'])) {
	require 'welcome.php';
	die;
}

// Validate request format
$qs = $_SERVER['QUERY_STRING'];
if (preg_match('/^([0-9]+)x?([0-9]+)?$/', $qs, $matches)) {
	$res['w'] = $matches[1];
	$res['h'] = (empty($matches[2])) ? $matches[1] : $matches[2];
} else {
	http_response_code(400);
	die;
}

// Validate request values
$max = ['w' => 4096, 'h' => 2160];
if (
	$res['w'] > $max['w']
	|| $res['h'] > $max['h']
	|| $res['w'] < 1
	|| $res['h'] < 1
) {
	http_response_code(400);
	die;
}

// Select 1-100
$hash = md5(serialize($res));
$hash = substr($hash, 0, 2);
$num = hexdec($hash);
$num = intval(round($num / 2.55));
if ($num === 0) $num++;

// File paths
$file = $res['w'] . 'x' . $res['h'] . '.jpg';
$cache = implode(DIRECTORY_SEPARATOR, [__DIR__, 'img', 'cache', $file]);
$src   = implode(DIRECTORY_SEPARATOR, [__DIR__, 'img', 'src',   $num.'.jpg']);

// Ensure cached file exists
while (!file_exists($cache)) {
	$img = imagecreatefromjpeg($src);
	$img = imagescale($img, $res['w'], $res['h']);
	imagejpeg($img, $cache, 100);
}

// Serve cached image
header('Content-type: image/jpeg');
header('Content-Length: ' . filesize($cache));
readfile($cache);
