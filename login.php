<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Regisztrációs tesztfeladat</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Belépés</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Emailcím</label>
  		<input type="text" name="email" >
  	</div>
  	<div class="input-group">
  		<label>Jelszó</label>
  		<input type="password" name="password">
  	</div>
      <div class="input-group">
  		<label>Jelszó újra</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Belépés</button>
  	</div>
  	<p>
  		Még nem regisztráltál? <a href="register.php">Regisztráció</a>
  	</p>
  </form>
</body>
</html>