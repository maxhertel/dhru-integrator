<?php
/**
 * head_start.php
 *
 * Author: pixelcave
 *
 * The first block of code used in every page of the template
 *
 */
require_once 'config.php';

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if(!preg_match("/index/i", $path) && !preg_match("/register/i", $path) && !preg_match("/forgot/i", $path))
{
  $username = $_SESSION['username'];
  $password = $_SESSION['password'];
  if($username != false && $password != false)
  {
	$data_user = mysqli_query($con, "SELECT * FROM `apiusers` WHERE `username` = '$username'");
	$result = mysqli_fetch_array($data_user);
	$data_order = mysqli_query($con, "SELECT * FROM `apiorders` WHERE `username` = '$username'");
	$get = mysqli_num_rows($data_order);
  }
  else
  {
	header('Location: index.php');
  }
}	
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?php echo $one->title; ?></title>

  <meta name="description" content="<?php echo $one->description; ?>">
  <meta name="author" content="<?php echo $one->author; ?>">
  <meta name="robots" content="<?php echo $one->robots; ?>">

  <!-- Open Graph Meta -->
  <meta property="og:title" content="<?php echo $one->title; ?>">
  <meta property="og:site_name" content="<?php echo $one->name; ?>">
  <meta property="og:description" content="<?php echo $one->description; ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo $one->og_url_site; ?>">
  <meta property="og:image" content="<?php echo $one->og_url_image; ?>">

  <!-- Icons -->
  <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
  <link rel="shortcut icon" href="<?php echo $one->assets_folder; ?>/media/favicons/favicon.png">
  <link rel="icon" type="image/png" sizes="192x192" href="<?php echo $one->assets_folder; ?>/media/favicons/favicon-192x192.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $one->assets_folder; ?>/media/favicons/apple-touch-icon-180x180.png">
  <!-- END Icons -->

  <!-- Stylesheets -->