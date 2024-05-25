
<?php
require_once "header.php";

$conn = mysql_connect("localhost", "root", "", "asifsirblog");


if (isset($_POST['name123'])) {
    $uremail = $_POST['uremail'];
    $upassword = $_POST['upassword'];
    $sql = "SELECT * FROM users WHERE email='$uremail' AND password='$upassword'";
    $conn->query($sql);
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
                                <input type="text" placeholder="Your Email" class="form-control" name="uremail">
                            </div>
                            <div class="mb-3">
                                <input type="text" placeholder="Your Password" class="form-control" name="upassword">
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