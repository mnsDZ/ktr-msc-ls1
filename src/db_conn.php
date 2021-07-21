<?php

 
   $server='localhost';
   $dbname='epitechdb';
   $user='root';
   $password='';
   $dsn='mysql:host='.$server.';dbname='.$dbname;

   try
   {
      $db=new PDO($dsn,$user,$password);
      $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   }    
   catch(PDOException $e)
   {
            die('echec'.$e->getMessage());
   }   


   
    
?>