<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login-EEPIS Informatics Laboratoium</title>
	<link rel="shortcut icon" href="logo.png" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="asset/raw/datatables.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="asset/css/animate.min.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="asset/raw/Bootstrap-3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="asset/css/custom.css" />
	<link rel="stylesheet" type="text/css" href="asset/css/style.css" />
	
	<style>
		body{
			background: url('asset/img/bg1.jpg');
		}
	</style>
  </head>
  <body>
  	<br>
  	<br>
  	<br>
  	<div class="col-md-4 col-md-offset-4 mb-4 jumbotron animated bounceIn" style="text-align: center">
	<form action="?.php" id="login" name="login" method="POST" class="form-login">
			<img class="mb-4" width="80" height="80" src="asset/img/login.png">
			<h2>EEPIS Informatics Laboratorium</h2>
			<br>
			<div class="form-label-group">
				<input class="form-control" type="text" name="email" id="email" required="yes" placeholder="Email *" autofocus="yes" autocomplete="no">
				<label for="userid"></label>
			</div>
			<div class="form-label-group"> 
				<input class="form-control" type="password" name="password" required="yes" id="password" placeholder="Password *">
				<label for="password"></label>
			</div>
			<button class="btn btn-info btn-primary btn-block" type="submit" name="login" id="login">LOGIN</button>
			<br>
	
	</form>
	</div>
	
	<br>
	
    <script src="asset/raw/datatables.min.js"></script>
    <script src="asset/raw/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
    <script src="asset/raw/Bootstrap-3.3.7/js/bootstrap.min.js"></script>
	
</body>
	
</html>