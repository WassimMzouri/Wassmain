<?php
   try{
      $pdo=new PDO("mysql:host=localhost;dbname=amac2","root","");
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }
?>