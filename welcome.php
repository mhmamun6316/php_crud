<?php 

include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

if(isset($_POST['submit'])){
    $image = $_FILES['image']['name'];
    $target = "images/".basename($image);
    
    $id=$_POST['bookid'];
    $name=$_POST['bookname'];
    $publisher=$_POST['publisher'];
    $price=$_POST['price'];
    
    $query="INSERT INTO `books`(`book_id`, `book_name`, `author`, `price`, `image`) VALUES ('$id','$name','$publisher','$price','$image')";
    $result = mysqli_query($conn, $query);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		 $msg = "Image uploaded successfully";
  	}else{
  		 $msg = "Failed to upload image";
  	}
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
      <div class="d-flex justify-content-center align-itemn-center">
          <form method="post" class="w-75" enctype="multipart/form-data">
             <div class="py-3">
             <div class="row">
                 <div class="col-6">
                     <div class="input-group flex-nowrap py-2">
                          <span class="input-group-text bg-success"><i class="fas fa-id-badge"></i></span>
                          <input type="text" class="form-control" name="bookid" placeholder="Book_ID">
                      </div>
                 </div>
                 <div class="col-6">
                      <div class="input-group flex-nowrap py-2">
                          <span class="input-group-text bg-success"><i class="fas fa-book-medical"></i></span>
                          <input type="text" class="form-control" name="bookname" placeholder="Book_Name">
                      </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-6">
                     <div class="input-group flex-nowrap py-2">
                          <span class="input-group-text bg-success"><i class="fas fa-user-alt"></i></span>
                          <input type="text" class="form-control" name="publisher" placeholder="Book_Publisher">
                      </div>
                 </div>
                 <div class="col-6">
                       <div class="input-group flex-nowrap py-2">
                          <span class="input-group-text bg-success"><i class='fas fa-dollar-sign'></i></span>
                          <input type="text" class="form-control" name="price" placeholder="Price">
                      </div>
                 </div>
             </div>
             
              <div class="input-group flex-nowrap py-2">
                  <span class="input-group-text bg-success"><i class="fas fa-image"></i></span>
                  <input type="file" class="form-control" name="image" placeholder="image">
              </div>
              
             </div>
             <button class="btn btn-success px-4 py-2 mb-3" type="submit" name="submit">Add Book</button>
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