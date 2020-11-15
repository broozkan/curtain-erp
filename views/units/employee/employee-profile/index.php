<!DOCTYPE html>
<html lang="tr">

<?php require $this->pathPhp."arayuz/head.php"; ?>


<body>

  <!-- Begin page -->
  <div id="layout-wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    <?php require $this->pathPhp."arayuz/sidebar.php"; ?>

    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

      <?php require $this->pathPhp."arayuz/header.php"; ?>


      <div class="page-content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-sm-1">
              <img class="rounded-circle header-profile" src="<?php echo $this->pathHtml; ?>assets/images/users/<?php echo $this->employeeInformations["employee_photo"]; ?>" alt="<?php echo $this->employeeInformations["employee_name"]; ?>">
            </div>
            <div class="col-sm-8">
              <div class="text-left mt-4">
                <h4><?php echo $this->employeeInformations["employee_name"]; ?></h4>
                <p class="text-muted mt-3 mb-4"><?php echo $this->employeeInformations["employee_email"]; ?></p>
                <p class="text-muted mt-3 mb-4"><?php echo $this->employeeInformations["employee_phone_number"]; ?></p>

              </div>
            </div><!-- end col -->
          </div><!-- end row -->


          <div class="row mt-5">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-body">
                  <h5 class="mb-3 font-weight-bold text-uppercase">General</h5>
                  <div id="accordion">
                    <div class="card mb-1">
                      <div class="card-header bg-white border-bottom-0 p-3" id="headingOne">
                        <h5 class="m-0 font-size-16">
                          <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                          aria-controls="collapseOne" class="text-dark">
                          Q. What is Lorem Ipsum?
                        </a>
                      </h5>
                    </div>

                    <div id="collapseOne" class="collapse show"
                    aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body text-muted pt-1">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life
                      accusamus terry richardson ad squid. 3 wolf moon officia
                      aute, non cupidatat skateboard dolor brunch. Food truck
                      quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                      sunt aliqua put a bird on it squid single-origin coffee
                      nulla assumenda shoreditch et. Nihil anim keffiyeh
                      helvetica, craft beer labore wes anderson cred nesciunt
                      sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                      Leggings occaecat craft beer farm-to-table, raw denim
                      aesthetic synth nesciunt you probably haven't heard of them
                      accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div>
                <div class="card mb-1">
                  <div class="card-header bg-white border-bottom-0 p-3" id="headingTwo">
                    <h5 class="m-0 font-size-16">
                      <a href="#" class="text-dark collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Q. Is safe use Lorem Ipsum?
                      </a>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body text-muted pt-1">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life
                      accusamus terry richardson ad squid. 3 wolf moon officia
                      aute, non cupidatat skateboard dolor brunch. Food truck
                      quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                      sunt aliqua put a bird on it squid single-origin coffee
                      nulla assumenda shoreditch et. Nihil anim keffiyeh
                      helvetica, craft beer labore wes anderson cred nesciunt
                      sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                      Leggings occaecat craft beer farm-to-table, raw denim
                      aesthetic synth nesciunt you probably haven't heard of them
                      accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div>
                <div class="card mb-1">
                  <div class="card-header bg-white border-bottom-0 p-3" id="headingThree">
                    <h5 class="m-0 font-size-16">
                      <a href="#" class="text-dark collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Q. Why use Lorem Ipsum?
                      </a>
                    </h5>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body text-muted pt-1">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life
                      accusamus terry richardson ad squid. 3 wolf moon officia
                      aute, non cupidatat skateboard dolor brunch. Food truck
                      quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                      sunt aliqua put a bird on it squid single-origin coffee
                      nulla assumenda shoreditch et. Nihil anim keffiyeh
                      helvetica, craft beer labore wes anderson cred nesciunt
                      sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                      Leggings occaecat craft beer farm-to-table, raw denim
                      aesthetic synth nesciunt you probably haven't heard of them
                      accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>


          <div class="card">
            <div class="card-body">
              <h5 class="mb-3 font-weight-bold text-uppercase">Payments & Support</h5>
              <div id="accordion2">
                <div class="card mb-1">
                  <div class="card-header bg-white border-bottom-0 p-3" id="headingFour">
                    <h5 class="m-0 font-size-16">
                      <a href="#" class="text-dark collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Q. When can be used?
                      </a>
                    </h5>
                  </div>
                  <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion2">
                    <div class="card-body text-muted pt-1">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life
                      accusamus terry richardson ad squid. 3 wolf moon officia
                      aute, non cupidatat skateboard dolor brunch. Food truck
                      quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                      sunt aliqua put a bird on it squid single-origin coffee
                      nulla assumenda shoreditch et. Nihil anim keffiyeh
                      helvetica, craft beer labore wes anderson cred nesciunt
                      sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                      Leggings occaecat craft beer farm-to-table, raw denim
                      aesthetic synth nesciunt you probably haven't heard of them
                      accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div>
                <div class="card mb-1">
                  <div class="card-header bg-white border-bottom-0 p-3" role="tab" id="headingFive">
                    <h5 class="m-0 font-size-16">
                      <a href="#" class="text-dark collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Q. How many variations exist?
                      </a>
                    </h5>
                  </div>
                  <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion2">
                    <div class="card-body text-muted pt-1">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life
                      accusamus terry richardson ad squid. 3 wolf moon officia
                      aute, non cupidatat skateboard dolor brunch. Food truck
                      quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                      sunt aliqua put a bird on it squid single-origin coffee
                      nulla assumenda shoreditch et. Nihil anim keffiyeh
                      helvetica, craft beer labore wes anderson cred nesciunt
                      sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                      Leggings occaecat craft beer farm-to-table, raw denim
                      aesthetic synth nesciunt you probably haven't heard of them
                      accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div>
                <div class="card mb-0">
                  <div class="card-header bg-white border-bottom-0 p-3" role="tab" id="headingSix">
                    <h5 class="m-0 font-size-16">
                      <a href="#" class="text-dark collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        Q. License & Copyright
                      </a>
                    </h5>
                  </div>
                  <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion2">
                    <div class="card-body text-muted pt-1">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life
                      accusamus terry richardson ad squid. 3 wolf moon officia
                      aute, non cupidatat skateboard dolor brunch. Food truck
                      quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                      sunt aliqua put a bird on it squid single-origin coffee
                      nulla assumenda shoreditch et. Nihil anim keffiyeh
                      helvetica, craft beer labore wes anderson cred nesciunt
                      sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                      Leggings occaecat craft beer farm-to-table, raw denim
                      aesthetic synth nesciunt you probably haven't heard of them
                      accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div> <!-- end col -->

        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="mt-0">Have any questions ?</h5>
              <p class="text-muted font-13 mb-4">Email us your Questions or you can send us twitter.</p>
              <form>
                <div class="form-group row">
                  <div class="col-lg-6 mb-3 mb-lg-0">
                    <input class="form-control" type="text" id="name" placeholder="Name">
                  </div>
                  <div class="col-lg-6">
                    <input class="form-control" type="email" id="example-email-input3" placeholder="Email">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12">
                    <input class="form-control" type="text" id="subject2" placeholder="Subject">
                  </div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Your message"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block px-4">Send Message</button>
              </form>
            </div>
          </div>
        </div>
      </div>


    </div> <!-- container-fluid -->
  </div>
  <!-- End Page-content -->

  <?php require $this->pathPhp."arayuz/footer.php"; ?>


</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Overlay-->
<div class="menu-overlay"></div>


<?php require $this->pathPhp."arayuz/script.php"; ?>
<script src="<?php echo $this->pathHtml; ?>views/units/employee/employee-profile/employee-profile.js"></script>

</body>


</html>
