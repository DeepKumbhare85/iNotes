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
    
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
    <title>crudApp</title>
  </head>
  <body>
    

    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
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
                    <button class="btn btn-primary btn-sm edits">Edit</button>
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

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


    <!-- Option 1: Bootstrap Bundle with Popper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script>  

        edits=document.getElementsByClassName("edits");
        console.log(edits);
        Array.from(edits).forEach((element)=>{
            element.addEventListener('click',function(e){
            tr=e.target.parentNode.parentNode;
            title=tr.getElementsByTagName('td')[0].innerText;
            description=tr.getElementsByTagName('td')[1].innerText;
            console.log(title);
            console.log(description);
            $('#exampleModal').modal('toggle');

          })
        })
      </script>
  </body>
</html>