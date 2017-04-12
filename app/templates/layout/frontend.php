<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?= $pageTitle ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../public/css/css.css">
	<link rel="stylesheet" href="public/css/css.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- <link rel="stylesheet" type="text/css" href="/fran/php/t-framework/public/css/css.css"> -->

</head>
<body>
<?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') include 'admin-header.php';?>

<?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'client') include 'client-header.php';?>

<?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'tech') include 'tech-header.php';?>

<div class="clearfix" id="pageContent">
	<?= $pageContent ?>
</div>

<footer><p>DreamWeb</p></footer>
</body>
</html>