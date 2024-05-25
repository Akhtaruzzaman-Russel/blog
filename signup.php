
<?php
require_once "header.php";
require_once "./classes/signup.php";

if (isset($_SESSION['email'])) {
    header("location: ./");
}

use classes\signup\signup as signup;

$signup = new signup();


if(isset($_POST['name123'])){
    $urname = $signup -> sanitize($_POST['urname']) ;
    $uremail = $signup -> sanitize($_POST['uremail']) ;
    $gender = isset($_POST['gender']) ? $signup -> sanitize( $_POST['gender'] ) : "" ;
    $dob = $signup -> sanitize ($_POST['dob']) ;
    $password = $signup -> sanitize($_POST['password']) ;

    $signup -> signup($urname, $password, $uremail, $gender, $dob);

}

?>

    <div class="container">
        <div class="row  d-flex" style="min-height: calc(100vh - 60px); ">
            <div class="col-md-5 m-auto border border-1 border-primary rounded shadow p-4">

            <h1 class="mb-3" >Sign Up </h1>

            <form action="" method="post" >

                    <div class="mb-3">
                        <input type="text" placeholder="Your Name" class="form-control  <?= !empty($signup->urnameErrMsg) ? 'is-invalid' : null ?> " name="urname" value="<?= $urname ?? null ?>"> 
                        
                        <div class="invalid-feedback">
                            <?= $signup->urnameErrMsg ?? null ?>
                        </div>
                    </div>

                    <div class="mb-3">
                       
                        <input type="text" placeholder="Your Email" class="form-control <?= !empty($signup->uremailErrMsg) ? 'is-invalid' : null ?> " name="uremail" value="<?= $uremail ?? null ?>"> 
                      
                        <div class="invalid-feedback">
                            <?= $signup->uremailErrMsg?? null?>
                        </div>
                    </div>


                    <div class=" border <?= !empty($signup->genderErrMsg) ? "border-danger is-invalid " : null ?> rounded py-2">
                        <div class="form-check form-check-inline px-3">
                            
                            <label for="" class="form-check-label">Gender</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" id="male" class="form-check-input" value="Male" <?= isset($gender) && $gender === "Male" ? "checked" : null?> >
                            <label for="male" class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" id="female" class="form-check-input" value="Female" <?= isset($gender) && $gender === "Female" ? "checked" : null?>>
                            <label for="female" class="form-check-label">Female</label>
                        </div>
                    </div>
                    
                    <div class="invalid-feedback">
                     <?= $signup->genderErrMsg?? null?>
                     </div>
                     <div class="mb-3"></div>
                        
                    
                    <div class="mb-3">
                        <input type="date" name="dob" id="" class="form-control <?= !empty($signup-> dobErrMsg) ? 'is-invalid ': null ?>" placeholder="Date of Birth mm/dd/yyyy" value= "<?= $dob ?? null ?>"  >

                        <div class="invalid-feedback">
                            <?= $signup->dobErrMsg?? null?>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <input type="password" placeholder="New Password" class="form-control <?= !empty($signup->passwordErrMsg) ? 'is-invalid ' : null  ?>" name="password"  id="">
                        
                        <div class="invalid-feedback">
                            <?= $signup->passwordErrMsg?? null?>
                        </div>
                    </div>

                    <div class="mb-3 form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="showpass">
                        <label for="" class="form-check-label">Show Password</label>
                    </div>
                    
                    <div>
                        <input type="submit" value="Sign Up" name="name123" class="btn btn-primary ">
                    </div>
                    

            </form>

            </div>
        </div>
    </div>
  






  <?php
  
  require_once "footer.php";
   ?>

<!-- Show Password tick when Sign Up -->
   <script>

        const showpass = document.querySelector("#showpass");
        const password = document.querySelector("input[name=password]");
        showpass.addEventListener("click", () => {
            if(showpass.checked){
                password.setAttribute("type", "text");
            }else{
                password.setAttribute("type", "password");
            }
        })




   </script>