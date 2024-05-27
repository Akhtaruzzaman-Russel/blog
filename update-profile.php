
<?php
require_once "header.php";
if (!isset($_SESSION['email'])){
    header("location:./signin.php ");
}




if (isset($_POST['upProfile'])) {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $update =  $conn->query("UPDATE users SET name='$name', dob='$dob', gender='$gender' WHERE email='$email'");
    if ($update) {
        echo "<script>  toastr.success('Profile Updated'); setTimeout(()=>{location.href='update-profile.php'}, 2000) </script>";
    } else {
        echo "<script>  toastr.error('Profile Not Updated'); setTimeout(()=>{location.href='update-profile.php'}, 2000) </script>";
    }
   
   
}

?>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Update Profile </h1>
                <div class="row">
                    <div class="col-md-6">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $userInfo->name ?? null ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $userInfo->email ?? null ?>" readonly required>
                            </div>

                            <!-- Date of Birth -->
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob"   name="dob" value= "<?= $userInfo->dob ?? null ?>" required>
                            </div>
                            <!-- Gender -->
                            <div class="mb-3">
                            <label for="" class="form-check-label">Gender</label>
							
							
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="male" name="gender" value="Male" <?= isset($userInfo->gender) && $userInfo->gender == "Male" ? "checked" : null ?>>
                                <label for="male" class="form-check-label">Male</label>
                            </div>
							
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="female" name="gender" value="Female" <?= isset($userInfo->gender) && $userInfo->gender == "Female" ? "checked" : null ?>>
                                <label for="female" class="form-check-label">Female</label>
                            </div>
                        </div>
						
						
						


                            
                      <div class="mb-3">

                         <button type="submit" class=" btn btn-primary " name="upProfile"> Update Profile  </button>

                      </div>
                        
                  
                                            
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
  






  <?php
  
  require_once "footer.php";
   ?>