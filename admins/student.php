<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
  header("location:login.php");
  exit;
  
};

$showalert = true;
$showerror = true;
if($_SERVER['REQUEST_METHOD']=="POST"){
   require "../dbconnect.php";
   if(isset($_post['submit']))
   $username =$_POST['username'];
   $password =$_POST['password'];
   $cpassword =$_POST['cpassword'];
   $sql1 = "SELECT * from 'internship'.'studentsignup' where username= '$username' and cpassword='$cpassword'";
   $result1 = mysqli_query($conn , $sql1) or die(mysqli_error($sql1));
   $num = mysqli_num_rows($result1);
   if($num == 0){
       if($password == $cpassword && $username !="")
       {
           $password = password_hash($password,PASSWORD_DEFAULT);
           mysqli_query("INSERT INTO 'internship'.'studentsignup'(username, password, cpassword) VALUES ('$username','$password','$cpassword')");
           $result = mysqli_query($conn , $sql) or die( mysqli_error($conn));
           echo "done";

           $table = $username.'studentsignup';
           $sql ="CREATE TABLE 'internship'.'studentsignup'.`$table`(
              username varchar(255),
              password varchar(255),
              cpassword varchar(255)
          )";
          $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

           header("location:student.php");
       }
       else{
           $showalert = true;
       }
   }
   else{
       $showerror = true ;
   }

}
?>
<?php include "nav.php";  ?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Student Registration </title>
     
</head>
<body style="background-color: grey;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <form>
        <section class="h-100 bg-dark">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card card-registration my-4">
                            <div class="row g-0">
                                <div class="col-xl-6 d-none d-xl-block">
                                    <img src="gdsc.jpeg" alt="Sample photo" class="img-fluid" style="border-top-left-radius: .55rem; border-bottom-left-radius: .55rem; width: fit-content;" />
                                </div>
                                <div class="col-xl-6">
                                    <div class="card-body p-md-5 text-black">
                                      <div class="middle">
                                       <div class="table1">
                                         <form action="student.php" method="post">


                                              <!-- form  -->

                                         <h3 class="mb-5 text-uppercase">Student registration form</h3><div class="row">
                                            <div class="col-md-6 mb-4">
                                            </div>
                                            <div class="mb-3">
                                                 <label for="exampleInputPassword1" class="form-label">Username</label>
                                                  <input placeholder="username" name="username" type="username" class="form-control" id="exampleInputPassword1">
                                                </div>
                                                <div class="mb-3">
                                                     <label for="exampleInputPassword1" class="form-label">Password</label>
                                                     <input placeholder="password" name="password" type="password" class="form-control" id="exampleInputPassword1">
                                                </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">confirm Password</label>
                                                        <input placeholder="cpassword"name="cpassword" type="cpassword" class="form-control" id="exampleInputPassword1">
                                                    </div>
                                                 </div>
                                                     <center><button id="submit" type="submit" class="btn btn-warning">submit</button></center>
                                                     </form>
                                                    </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </form>

</body>

</html>