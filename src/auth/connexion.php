<?php
require "../db_conn.php";
require "../functions.php";

session_start();
redirect();

if(isset($_POST['connexion'])) {
    if(!empty($_POST['email'] && !empty($_POST['password']))){
      $email = $_POST['email'];
      $password = $_POST['password'];
      $email_v= filter_var(clean($email),FILTER_SANITIZE_EMAIL);
      if( (filter_var($email_v,FILTER_VALIDATE_EMAIL) )) {
        $email_exist = $db->prepare("SELECT * FROM users WHERE email = ? ");
        $email_exist->execute([$email_v]);

        $email_exist_count = $email_exist->rowCount();
        
        if($email_exist_count == 1)
        {
          $email_result = $email_exist->fetch(PDO::FETCH_ASSOC);
          $password_hash = $email_result['password'];
          if(password_verify($password,$password_hash)) {
              $all_data = $db->prepare("SELECT * FROM users WHERE id = ?  ");
              $all_data->execute([$email_result['id']]);
              $all_data_result = $all_data->fetch(PDO::FETCH_ASSOC);           
              $_SESSION['id'] = $all_data_result['id'];
              $_SESSION['name'] = $all_data_result['name'];
              $_SESSION['email'] = $all_data_result['email'];
              header('Location:../home.php');   
          }     
        }
      }
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
    <link href="assets\home.css?v=<?php echo time(); ?>" rel="stylesheet">
    <title>Connexion</title>
</head>
<body>

<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal" action='' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">Connexion</legend>
    </div>
   
 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
      </div>
    </div>

    <div class="control-group">
        <a href="inscription.php" class="register-link" >Vous avez pas un compte ?</a>
    </div>
    <div class="control-group">
      <!-- Button -->
      <div class="controls">

        <button name ="connexion" class="btn btn-success">Connexion</button>
      </div>
    </div>
  </fieldset>
</form>
</body>
</html>