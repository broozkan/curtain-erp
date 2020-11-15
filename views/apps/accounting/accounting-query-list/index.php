<!DOCTYPE html>
<html lang="en">

<?php require $this->pathPhp."arayuz/head.php"; ?>


<body>

  <!-- Begin page -->
  <div id="layout-wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

      <div data-simplebar class="h-100">

        <!-- LOGO -->
        <div class="navbar-brand-box">
          <a href="index.html" class="logo">
            <span>
              <img src="assets/images/logo-light.png" alt="" height="15">
            </span>
            <i>
              <img src="assets/images/logo-small.png" alt="" height="24">
            </i>
          </a>
        </div>

        <!--- Sidemenu -->
        <?php require $this->pathPhp."arayuz/sidebar.php"; ?>

        <!-- Sidebar -->
      </div>
    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

      <?php require $this->pathPhp."arayuz/header.php"; ?>


      <div class="page-content">
        <div class="container-fluid">

          <div class="row justify-content-center">
            <div class="col-xl-10">

              <!-- Plans -->
              <div class="row ">
                <div class="col-md-4">
                  <div class="card card-pricing">
                    <div class="card-body text-center">
                      <i class="card-pricing-icon fa fa-file-invoice text-default"></i>
                      <h5 class="font-weight-bold  mt-4 text-uppercase">Alış Faturaları</h5>
                      <a href="<?php echo $this->pathHtml; ?>purchase-invoice/purchase-invoice-list" class="btn btn-primary mt-4 mb-2 btn-rounded">Git <i class="mdi mdi-arrow-right ml-1"></i></a>
                    </div>
                  </div> <!-- end Pricing_card -->
                </div> <!-- end col -->
                <div class="col-md-4">
                  <div class="card card-pricing">
                    <div class="card-body text-center">
                      <i class="card-pricing-icon fa fa-file-invoice text-default"></i>
                      <h5 class="font-weight-bold  mt-4 text-uppercase">Satış Faturaları</h5>
                      <a href="<?php echo $this->pathHtml; ?>sale-invoice/sale-invoice-list" class="btn btn-primary mt-4 mb-2 btn-rounded">Git <i class="mdi mdi-arrow-right ml-1"></i></a>
                    </div>
                  </div> <!-- end Pricing_card -->
                </div> <!-- end col -->
              </div>
              <!-- end row -->
              <!-- Plans -->
              <div class="row ">
                <div class="col-md-4">
                  <div class="card card-pricing">
                    <div class="card-body text-center">
                      <i class="card-pricing-icon fa fa-hand-holding-usd text-default"></i>
                      <h5 class="font-weight-bold  mt-4 text-uppercase">Ödemeler</h5>
                      <a href="<?php echo $this->pathHtml; ?>payment/payment-list" class="btn btn-primary mt-4 mb-2 btn-rounded">Git <i class="mdi mdi-arrow-right ml-1"></i></a>
                    </div>
                  </div> <!-- end Pricing_card -->
                </div> <!-- end col -->
                <div class="col-md-4">
                  <div class="card card-pricing">
                    <div class="card-body text-center">
                      <i class="card-pricing-icon fa fa-hand-holding-usd text-default"></i>
                      <h5 class="font-weight-bold  mt-4 text-uppercase">Tahsilatlar</h5>
                      <a href="<?php echo $this->pathHtml; ?>collection/collection-list" class="btn btn-primary mt-4 mb-2 btn-rounded">Git <i class="mdi mdi-arrow-right ml-1"></i></a>
                    </div>
                  </div> <!-- end Pricing_card -->
                </div> <!-- end col -->

              </div>
              <!-- end row -->
              <!-- Plans -->
              <div class="row ">
                <div class="col-md-4">
                  <div class="card card-pricing">
                    <div class="card-body text-center">
                      <i class="card-pricing-icon fa fa-money-check-alt text-default"></i>
                      <h5 class="font-weight-bold  mt-4 text-uppercase">Alınan Çek/Senet</h5>
                      <a href="<?php echo $this->pathHtml; ?>received-check/received-check-list" class="btn btn-primary mt-4 mb-2 btn-rounded">Git <i class="mdi mdi-arrow-right ml-1"></i></a>
                    </div>
                  </div> <!-- end Pricing_card -->
                </div> <!-- end col -->
                <div class="col-md-4">
                  <div class="card card-pricing">
                    <div class="card-body text-center">
                      <i class="card-pricing-icon fa fa-money-check-alt text-default"></i>
                      <h5 class="font-weight-bold  mt-4 text-uppercase">Verilen Çek/Senet</h5>
                      <a href="<?php echo $this->pathHtml; ?>given-check/given-check-list" class="btn btn-primary mt-4 mb-2 btn-rounded">Git <i class="mdi mdi-arrow-right ml-1"></i></a>
                    </div>
                  </div> <!-- end Pricing_card -->
                </div> <!-- end col -->

              </div>
              <!-- end row -->
              <!-- Plans -->
              <div class="row ">
                <div class="col-md-4">
                  <div class="card card-pricing">
                    <div class="card-body text-center">
                      <i class="card-pricing-icon fa fa-money-check-alt text-default"></i>
                      <h5 class="font-weight-bold  mt-4 text-uppercase">Krediler</h5>
                      <a href="<?php echo $this->pathHtml; ?>credit/credit-list" class="btn btn-primary mt-4 mb-2 btn-rounded">Git <i class="mdi mdi-arrow-right ml-1"></i></a>
                    </div>
                  </div> <!-- end Pricing_card -->
                </div> <!-- end col -->
              </div>
              <!-- end row -->
              <!-- Plans -->
              <div class="row ">
                <div class="col-md-8">
                  <div class="card card-pricing">
                    <div class="card-body text-center">
                      <i class="card-pricing-icon fa fa-exchange-alt text-default"></i>
                      <h5 class="font-weight-bold  mt-4 text-uppercase">Girdi-Çıktı Listesi</h5>
                      <a href="<?php echo $this->pathHtml; ?>accounting-record/accounting-record-list" class="btn btn-primary mt-4 mb-2 btn-rounded">Git <i class="mdi mdi-arrow-right ml-1"></i></a>
                    </div>
                  </div> <!-- end Pricing_card -->
                </div> <!-- end col -->
              </div>
              <!-- end row -->

            </div> <!-- end col-->
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

</body>


</html>
