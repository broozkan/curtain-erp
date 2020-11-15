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
          <div class="row mt-5">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">
              <button type="button" class="btn btn-warning btnCommonAnalyseToday" name="button">Bugün</button>
              <button type="button" class="btn btn-warning btnCommonAnalyseLastWeek" name="button">Geçen Hafta</button>
              <button type="button" class="btn btn-warning btnCommonAnalyseLastMonth" name="button">Geçen Ay</button>
              <button type="button" class="btn btn-warning btnCommonAnalyseLastYear" name="button">Geçen Yıl</button>
            </div>
          </div>
          <div class="row mt-3 mb-5">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">
              <form class="form-inline" action="" method="post" id="frmCommonAnalyse" >
                <!-- form group -->
                <div class="form-group">
                  <label for="txtBeginningDate">Başlangıç Tarihi :</label>
                  <input type="date" class="form-control" required name="txtBeginningDate" id="txtBeginningDate" value="">
                </div>
                <!-- form group -->
                <!-- form group -->
                <div class="form-group">
                  <label for="txtEndingDate">Bitiş Tarihi :</label>
                  <input type="date" class="form-control" required name="txtEndingDate" id="txtEndingDate" value="">
                </div>
                <!-- form group -->
                <!-- form group -->
                <div class="form-group">
                  <button type="submit" class="btn btn-primary" name="button">Getir</button>
                </div>
                <!-- form group -->
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-xl-3">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col">
                      <h6 class="text-uppercase font-size-12 text-muted mb-3">Yapılan Toplam Satış</h6>
                      <span class="h3 mb-0"> <span class="spanTotalSaleAmount">0.00</span> ₺ </span>
                    </div>
                    <div class="col-auto">
                      <span class="badge badge-soft-success"></span>
                    </div>
                  </div> <!-- end row -->
                  <div class="row mt-3">
                    <div class="table-responsive">
                      <table class="table table-hovered table-striped tbl-total-sale">
                        <thead>
                          <tr>
                            <th>İsim</th>
                            <th>Ara Toplam</th>
                            <th>İndirim</th>
                            <th>Toplam</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div> <!-- end card-body-->
              </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-lg-6 col-xl-3">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col">
                      <h6 class="text-uppercase font-size-12 text-muted mb-3">Satış Toplam Maliyet</h6>
                      <span class="h3 mb-0"> <span class="spanTotalSaleCostAmount">0.00</span> ₺ </span>
                    </div>
                    <div class="col-auto">
                      <span class="badge badge-soft-danger"></span>
                    </div>
                  </div> <!-- end row -->
                  <div class="row mt-3">
                    <div class="table-responsive">
                      <table class="table table-hovered table-striped tbl-total-sale-cost">
                        <thead>
                          <tr>
                            <th>İsim</th>
                            <th>Toplam Maliyet</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div> <!-- end card-body-->
              </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-lg-6 col-xl-3">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col">
                      <h6 class="text-uppercase font-size-12 text-muted mb-3">Toplam Masraf</h6>
                      <span class="h3 mb-0"> <span class="spanTotalPaymentAmount">0.00</span> ₺ </span>
                    </div>
                    <div class="col-auto">
                      <span class="badge badge-lg badge-soft-danger"> <span class="font-weight-bold">Emniyet Payı</span>  + %<?php echo $this->costSecureAmount; ?></span>
                    </div>
                  </div> <!-- end row -->
                  <div class="row mt-3">
                    <div class="table-responsive">
                      <table class="table table-hovered table-striped tbl-payments">
                        <thead>
                          <tr>
                            <th>Kategori</th>
                            <th>Toplam</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div> <!-- end card-body-->
              </div> <!-- end card-->
            </div> <!-- end col-->


            <div class="col-lg-6 col-xl-3">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col">
                      <h6 class="text-uppercase font-size-12 text-muted mb-3">Toplam Kâr-Zarar</h6>
                      <span class="h3 mb-0"> <span class="spanTotalProfit">0.00</span> ₺ </span>
                    </div>
                    <div class="col-auto">
                      <span class="badge badge-soft-danger"></span>
                    </div>
                  </div> <!-- end row -->
                </div> <!-- end card-body-->
              </div> <!-- end card-->
            </div> <!-- end col-->
          </div>
          <!-- end row-->





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
  <script src="<?php echo $this->pathHtml; ?>views/apps/analyse/common-analyse/common-analyse.js"></script>

</body>


</html>
