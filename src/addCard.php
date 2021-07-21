<?php

session_start();

require "db_conn.php";
require "functions.php";

if(!isset($_SESSION['id']))
 header("location:auth/connexion.php");
if(isset($_POST['ajouter'])) {
    if(  !empty($_POST['email']))
    {
      $name = $_POST['name'];
      $company =$_POST['company_name'];
      $email = $_POST['email'];
      $phone =$_POST['telephone'];
      $email_v= filter_var(clean($email),FILTER_SANITIZE_EMAIL);

      if( (filter_var($email_v,FILTER_VALIDATE_EMAIL) )) {
          $update = $db->prepare("INSERT INTO libraries (name,company_name,email,telephone,user_id)  VALUES(?,?,?,?,?) ");   
          $update->execute([$name,$company,$email_v,$phone,$_SESSION['id']]);
          header('Location:home.php');      
        }
    }
    else { 
      echo "the email must be non-empty";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../favicon.ico">

<title>Album example for Bootstrap</title>

<!-- Bootstrap core CSS -->
<link href="../../../../dist/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="assets\home.css?v=<?php echo time(); ?>" rel="stylesheet">

<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>

<header>
     
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a  href="#">Cards Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
           
           
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <?php echo  $_SESSION['name']; ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="information.php">My information</a>
                <a class="dropdown-item" href="addCard.php">ADD Cards</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="auth/logout.php">Log out</a>
              </div>
            </li>
            
          </ul>
          
        </div>
</nav>
   </header>

<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal" action='addCard.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">Add Card</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Name </label>
      <div class="controls">
        <input type="text" id="username" name="name" placeholder="" class="input-xlarge"  >
        
      </div>
    </div>
 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail *</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
        
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Company name</label>
      <div class="controls">
        <input type="text" name="company_name" placeholder="" class="input-xlarge">
        
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password -->
      <label class="control-label"  for="password_confirm">Phone </label>
      <div class="controls">
        <input type="text" id="password_confirm" name="telephone" placeholder="" class="input-xlarge">
        
      </div>
    </div>
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" name="ajouter">Ajouter</button>
      </div>
    </div>
  </fieldset>
</form>
</body>
</html>