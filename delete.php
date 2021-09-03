<?php

include 'config.php';

$id=$_GET['id'];



$sql2 = "SELECT * FROM books where id=$id";
                $result2 = mysqli_query($conn,$sql2);
               while($row=mysqli_fetch_assoc($result2)){
                   unlink("images/".$row['image']);
                      }


$sql="delete from books where id=$id";

mysqli_query($conn,$sql);


header('location:index.php');

?>
