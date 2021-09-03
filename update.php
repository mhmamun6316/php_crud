<?php 

include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

 if(isset($_POST['done'])){

    $id = $_GET['id'];
    $b_id=$_POST['bookid'];
    $name=$_POST['bookname'];
    $publisher=$_POST['publisher'];
    $price=$_POST['price'];
    $q = " update books set id=$id, book_id='$b_id', book_name='$name', author='$publisher', price='$price' where id=$id  ";

   //     print_r($q);
     $query = mysqli_query($conn,$q);
    header("Location: welcome.php");
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
   
   <div class="container text-center">
      <div class="py-4 bg-dark text-light rounded">
       <?php echo "<h3>Welcome " . $_SESSION['username'] . "</h3>"; ?>
      </div>
      <div class="d-flex justify-content-center">
          <form method="post" class="w-75">
             <div class="py-3">
                  <?php 
                    $id=$_GET['id'];
                    $sql2="select * from books where id='$id'";
                    $result2=mysqli_query($conn,$sql2);
                    while($row2=mysqli_fetch_array($result2))
                    {
                        ?>
                  <div class="row">
                      <div class="col-6">
                          <div class="input-group flex-nowrap py-2">
                              <span class="input-group-text bg-success"><i class="fas fa-id-badge"></i></span>
                              <input type="text" class="form-control" name="bookid" value="<?php echo $row2['book_id']; ?>"    placeholder="Book_ID">
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="input-group flex-nowrap py-2">
                              <span class="input-group-text bg-success"><i class="fas fa-book-medical"></i></span>
                              <input type="text" class="form-control" name="bookname" value="<?php echo $row2['book_name']; ?>" placeholder="Book_Name" >
                          </div>
                      </div>
                  </div> 
                  <div class="row">
                      <div class="col-6">
                          <div class="input-group flex-nowrap py-2">
                              <span class="input-group-text bg-success"><i class="fas fa-user-alt"></i></span>
                              <input type="text" class="form-control" name="publisher" value="<?php echo $row2['author']; ?>"  placeholder="Book_Publisher">
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="input-group flex-nowrap py-2">
                              <span class="input-group-text bg-success"><i class='fas fa-dollar-sign'></i></span>
                              <input type="text" class="form-control" name="price" value="<?php echo $row2['price']; ?>"  placeholder="Price">
                          </div>
                      </div>
                  </div>                    
                  <?php
                    }
                 ?>
             </div>
             <button class="btn btn-success px-4 py-2 mb-3" type="submit" name="done">Update Book</button>
          </form>
      </div>
      
      <div class="d-flex table-data">
       <table class="table table-striped table-dark align-middle">
           <thead class="thead-dark">
               <tr>
                    <th>SL</th>
                    <th>Book ID</th>
                    <th>Book Image</th>
                    <th>Book Name</th>
                    <th>Publisher</th>
                    <th>Book Price</th>
                    <th>Delete</th>
                    <th>Edit</th>
               </tr>
           </thead>
           <tbody>
              <?php 
                $sql = "SELECT * FROM books";
                $result = mysqli_query($conn,$sql);
                $count=0;
               while($row=mysqli_fetch_assoc($result)){
               ?>  
               <tr>
                    <th><?php echo $count++ ?></th>
                    <th><?php echo $row['book_id']; ?></th>
                    <th><img class="img_show" src="images/<?php echo $row['image']; ?>"></th>
                    <th><?php echo $row['book_name']; ?></th>
                    <th><?php echo $row['author']; ?></th>
                    <th><?php echo $row['price']; ?></th>
                    <th><button class="btn btn-danger"><a href="delete.php?id=<?php echo $row['id'] ?>" class="text-white" >Delete</a></button></th>
                    <th><button class="btn btn-warning"><a href="update.php?id=<?php echo $row['id'] ?>" class="text-white" >Edit</a></button></th>
               </tr>
              <?php 
               }
               ?>
           </tbody>
       </table>
   </div>
   
   </div>
   
    <div class="container d-flex justify-content-end">
       <button class="btn btn-primary logout"><a href="logout.php">Logout</a></button>
   </div>
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>