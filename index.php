<?php

  $insert=false;
  $hostname="localhost";
  $username="root";
  $password="";
  $dbname="notes";

  $conn=mysqli_connect($hostname,$username,$password,$dbname);

  if(!$conn){
    die("sorry we cant connect to database".mysqli_error());
  }

  if($_SERVER["REQUEST_METHOD"]=="POST"){

    $title=$_POST['title'];
    $description=$_POST['description'];
    $sql="INSERT INTO `notes` (`srno`, `title`, `description`, `date`) VALUES (NULL, '$title', '$description', current_timestamp())";
    $result=mysqli_query($conn,$sql);

    if($result){
      $insert=true;
    }
  }
  
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>crudApp</title>
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>


      <div class="container mt-4">
          <h2>Add a note</h2>
        <form action="index.php" method="post">
            <div class="mb-3 ">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Take a note-</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
           
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>

      <div class="container">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">sno</th>
              <th scope="col">Title</th>
              <th scope="col">Description</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody><?php
            $sql="SELECT * FROM `notes`";
            
            $result=mysqli_query($conn,$sql);
            // echo $result;
            $count=1;
            while($row=mysqli_fetch_assoc($result)){
              ?>
            
              <tr>
                <th scope="row"><?php echo  $count ?></th>
                <td><?php echo  $row['title'] ?></td>
                <td><?php echo  $row['description'] ?></td>
                <td>
                    <button class="btn btn-primary btn-sm">Edit</button>
                    <button class="btn btn-primary btn-sm">Delete</button>
                </td>
              </tr>
              <?php
              $count++;
            }
          ?>
          </tbody>
        </table>
      </div>


    <?php
    if($insert==true){
      ?>
      <script>alert("Record added!")</script>
      <?php
    }
    ?>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>