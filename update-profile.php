
<?php
require_once "header.php";


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
                                <input type="text" class="form-control" id="name" name="name" value="" >
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="" readonly>
                            </div>

                            <!-- Date of Birth -->
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob"   name="dob" value= "" >
                            </div>
                            <!-- Gender -->
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                   
                                </select>
                            </div>
                      <div class="mb-3">

                         <button type="submit" class=" btn btn-primary "> Update Profile  </button>

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