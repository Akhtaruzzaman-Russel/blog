
<?php
require_once "header.php";

$conn = mysqli_connect("localhost", "root", "", "asifsirblog");


if (isset($_POST['name123'])) {
    $uremail = $_POST['uremail'];
    $password = $_POST['urpassword'];
    $sql = "SELECT * FROM users WHERE email='$uremail'";
	
    $checkEmail = $conn->query($sql);
    if ($checkEmail->num_rows > 0) {
        $row = $checkEmail->fetch_object();
        if (password_verify($password, $row->password)) {

            echo "<script>toastr.success('Login successful');setTimeout(()=> location.href='index.php', 2000)</script>";
        } else {
            echo " <script> toastr.error('Invalid Password'); setTimeout(()=> location.href='signin.php' , 2000) </script>";
        }
    }
}


?>


    <div class="container">
        <div class="row">
                    <div class="col-md-12">
                   
                    </div>

                    <div class="col-md-5 mx-auto mt-5 border rounded shadow p-4 ">
                        <h1 class="text-center mb-3">Sign In</h1>
                        <form action="" method="post">
        
                            <div class="mb-3">
                                <input type="email" name="uremail" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="urpassword" class="form-control" placeholder="Your Password" required>
                            </div>

                            <div>
                                <input type="submit" value="Sign In" name="name123" class="btn btn-primary ">
                            </div>
                            
                        </form>



                    </div>
        </div>
    </div>
  






  <?php
  
  require_once "footer.php";
   ?>