<?php

require "../db_conn.php";
require "../functions.php";

if(isset($_POST['inscription'])) {
  if(!empty($_POST['name']) &&
  !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password2']))
  {

      $nom = $_POST['name'];
      $email = $_POST['email'];
      $pass1 =$_POST['password'];
      $pass2 =$_POST['password2'];

      $email_v= filter_var(clean($email),FILTER_SANITIZE_EMAIL);

      $pass1_hash = password_hash($pass1,PASSWORD_DEFAULT);
      $pass2_hash = password_hash($pass2,PASSWORD_DEFAULT);  

          if( (filter_var($email_v,FILTER_VALIDATE_EMAIL) )) {

              if(validatePw($pass1)) {

                  if(pwEquals($pass1,$pass2)){
                    $new_user = $db->prepare("INSERT INTO users
                    (name,email,password) VALUES (?,?,?)");
                    $new_user->execute([$nom,$email_v,$pass1_hash]);

                    $id = $db->lastInsertId();

                    $new_user = $db->prepare("INSERT INTO profile
                    (name,user_id) VALUES (?,?)");
                    $new_user->execute([$nom,$id]);
                    header('Location:connexion.php');      
                    
          }
        }
      }
    }
    else { 
        echo "All fields must be completed";
    }
                         


}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Document</title>
</head>
<body>

<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal" action='' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">Register</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">name</label>
      <div class="controls">
        <input type="text" id="username" name="name" placeholder="" class="input-xlarge">
        <p class="help-block">Username can contain any letters or numbers, without spaces</p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
        <p class="help-block">Please provide your E-mail</p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
        <p class="help-block">Password should be at least 8 characters</p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password -->
      <label class="control-label"  for="password_confirm">Password (Confirm)</label>
      <div class="controls">
        <input type="password" id="password_confirm" name="password2" placeholder="" class="input-xlarge">
        <p class="help-block">Please confirm password</p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" name="inscription">Register</button>
      </div>
    </div>
  </fieldset>
</form>
</body>
</html>