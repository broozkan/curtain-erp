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
              <span class="fa fa-user fa-4x"></span>
            </div>
            <div class="col-sm-2">
              <div class="text-left mt-4">
                <h4><?php echo $this->customerInformations["customer_name"]; ?></h4>
                <p class="text-muted mt-3 mb-4"><?php echo $this->customerInformations["customer_address"]; ?></p>
                <p class="text-muted mt-3 mb-4"><?php echo $this->customerInformations["customer_email"]; ?></p>
                <p class="text-muted mt-3 mb-4"><?php echo $this->customerInformations["customer_phone_number"]; ?></p>

              </div>
            </div>
            <div class="col-sm-9">
              <div class="row">
                <div class="col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <h6 class="text-uppercase font-size-12 text-muted mb-3">BORÇ</h6>
                          <span class="h3 mb-0"> <?php echo $this->totalDebt; ?> ₺ </span>
                        </div>
                      </div> <!-- end row -->
                    </div> <!-- end card-body-->
                  </div> <!-- end card-->
                </div>
                <div class="col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <h6 class="text-uppercase font-size-12 text-muted mb-3">TAHSİL EDİLEN MİKTAR</h6>
                          <span class="h3 mb-0"> <?php echo $this->totalCollection; ?> ₺ </span>
                        </div>
                      </div> <!-- end row -->
                    </div> <!-- end card-body-->
                  </div> <!-- end card-->
                </div>
                <div class="col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <h6 class="text-uppercase font-size-12 text-muted mb-3">BAKİYE</h6>
                          <span class="h3 mb-0"> <?php echo $this->balance; ?> ₺ </span>
                        </div>
                      </div> <!-- end row -->
                    </div> <!-- end card-body-->
                  </div> <!-- end card-->
                </div>
                <div class="col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <h6 class="text-uppercase font-size-12 text-muted mb-3">SATIŞ TOPLAM MALİYET</h6>
                          <span class="h3 mb-0"> <?php echo $this->productPurchasePricesTotal; ?> ₺ </span>
                        </div>
                      </div> <!-- end row -->
                    </div> <!-- end card-body-->
                  </div> <!-- end card-->
                </div>
                <div class="offset-xl-3 col-xl-6">
                  <div class="card">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <h6 class="text-uppercase font-size-12 text-muted mb-3">TOPLAM KÂR-ZARAR</h6>
                          <span class="h3 mb-0"> <?php echo $this->totalProfit; ?> ₺ </span>
                        </div>
                      </div> <!-- end row -->
                    </div> <!-- end card-body-->
                  </div> <!-- end card-->
                </div>
              </div>
            </div>
          </div><!-- end row -->


          <div class="row mt-5">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="mb-3 font-weight-bold text-uppercase">Girdi-Çıktı Detay</h5>
                  <div id="accordion">
                    <div class="card mb-1">
                      <div class="card-header bg-white border-bottom-0 p-3" id="headingOne">
                        <h5 class="m-0 font-size-16">
                          <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                          aria-controls="collapseOne" class="text-dark btnCollapse">
                          Satışlar
                        </a>
                      </h5>
                    </div>

                    <div id="collapseOne" class="collapse"
                    aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body text-muted pt-1">
                      <div class="table-responsive">
                        <form class="form-inline d-none frmTableSearch" model="sale" action="" method="post">
                          <div class="form-group">
                            <label for="txtSaleCustomerId">Satış Müşterisi : </label>
                            <input type="text" class="form-control" name="txtSaleCustomerId" id="txtSaleCustomerId" value="<?php echo $this->customerInformations["customer_name"]; ?>">
                          </div>
                          <div class="form-group">
                            <label for="txtSaleDate">Satış Tarihi : </label>
                            <input type="date" class="form-control" name="txtSaleDate" id="txtSaleDate" value="">
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm" name="button">Ara</button>
                          </div>
                        </form>
                        <table class="table mb-0" id="sale-list" model="sale" is-override="false" page-number="1" item-per-page="10">
                          <thead class="thead-light">
                            <tr>
                              <th>#</th>
                              <th>Müşteri</th>
                              <th>Satışı Yapan Kişi</th>
                              <th>Tutar</th>
                              <th>Satış Tarihi</th>
                              <th>Teslimat Tarihi</th>
                              <th>Adres</th>
                              <th>İşlem</th>
                            </tr>
                          </thead>
                          <tbody>
                            <div class="loading d-none">
                              <img src='<?php echo $this->pathHtml; ?>assets/images/table-loading.gif' class="table-spinner"/>
                            </div>

                          </tbody>
                        </table>
                        <div class="card-footer ">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="pagination">

                              </div>
                              <div class="itemPerPage display-inline-block float-right">
                                Sayfa başı
                                <select class="form-control form-control-sm txtItemPerPage">
                                  <option value="10" selected>10</option>
                                  <option value="25">25</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                                  <option value="500">500</option>
                                </select>
                                satır göster
                              </div>
                            </div>

                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card mb-1">
                  <div class="card-header bg-white border-bottom-0 p-3" id="headingTwo">
                    <h5 class="m-0 font-size-16">
                      <a href="#" class="text-dark collapsed btnCollapse" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Muhasebe Kayıtları (Fatura, çek vs.)
                      </a>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body text-muted pt-1">
                      <div class="table-responsive">
                        <form class="form-inline d-none frmTableSearch" model="accounting-record" action="" method="post">
                          <div class="form-group">
                            <label for="txtAccountingRecordCustomerId">Satış Müşterisi : </label>
                            <input type="text" class="form-control" name="txtAccountingRecordCustomerId" id="txtAccountingRecordCustomerId"  value="<?php echo $this->customerInformations["customer_name"]; ?>">
                          </div>
                          <div class="form-group">
                            <label for="txtAccountingRecordSupplierId">Tedarikçi : </label>
                            <input type="text" class="form-control" name="txtAccountingRecordSupplierId" id="txtAccountingRecordSupplierId"  value="<?php echo $this->customerInformations["customer_name"]; ?>">
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm" name="button">Ara</button>
                          </div>
                        </form>
                        <table class="table mb-0" id="accounting-record" model="accounting-record" is-override="false" page-number="1" item-per-page="100">
                          <thead class="thead-light">
                            <tr>
                              <th>Cari</th>
                              <th>Tutar</th>
                              <th>İşlem Adı</th>
                              <th>Tarih</th>
                              <th>#</th>
                            </tr>
                          </thead>
                          <tbody>
                            <div class="loading d-none">
                              <img src='<?php echo $this->pathHtml; ?>assets/images/table-loading.gif' class="table-spinner"/>
                            </div>

                          </tbody>
                        </table>
                        <div class="card-footer ">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="pagination">

                              </div>
                              <div class="itemPerPage display-inline-block float-right">
                                Sayfa başı
                                <select class="form-control form-control-sm txtItemPerPage">
                                  <option value="100" selected>100</option>
                                  <option value="500">500</option>
                                </select>
                                satır göster
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
          </div>


        </div> <!-- end col -->

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
<script src="<?php echo $this->pathHtml; ?>views/units/customer/customer-profile/customer-profile.js"></script>

</body>


</html>
