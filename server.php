<?php
session_start();


$email    = "";
$errors = array(); 

// kapcsolat
$db = mysqli_connect('localhost', 'root', '', 'registration');

// regisztrálás
if (isset($_POST['reg_user'])) {
  
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  
  if (empty($email)) { array_push($errors, "Email cím szükséges!"); }
  if (empty($password_1)) { array_push($errors, "Jelszó szükséges!"); }
  if ($password_1 != $password_2) {
	array_push($errors, "A két beírt jelszó nem egyezik meg!");
  }

 
  $user_check_query = "SELECT * FROM users WHERE  email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // létező emailcím

    if ($user['email'] === $email) {
      array_push($errors, "Már regisztrált emailcím");
    }
  }

  
  if (count($errors) == 0) {
  	$password = md5($password_1);

  	$query = "INSERT INTO users (email, password) 
  			  VALUES('$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "Sikeres regisztráció";
  	header('location: index.php');
  }
}

if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($email)) {
        array_push($errors, "Email cím szükséges!");
    }
    if (empty($password)) {
        array_push($errors, "Jelszó szükséges!");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['email'] = $email;
          $_SESSION['success'] = "Sikeres belépés";
          header('location: index.php');
        }else {
            array_push($errors, "Hibás emailcím vagy jelszó!");
        }
    }
  }
  
  ?>