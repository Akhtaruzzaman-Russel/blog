
<?php
require_once "header.php";


?>


<div class="container-fluid">
    <div class="row d-flex position-fixed w-100">

          <div class="  flex-shrink-0 p-3  min-vh-100  col-1  " style="width: 280px; ">
                  <a href="/" class="d-flex align-items-center pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom">
                    <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
                    
                    <span class="fs-5 fw-semibold">Collapsible</span>
                  </a>
            
                      <?php include_once('./components/adminSidebar2.php') ?>
            </div>
              <div class="col flex-grow-1 bg-light text-dark">
                <h2>Dashboard</h2>
              </div>
    </div>

</div>



  <?php
  
  require_once "footer.php";
   ?>