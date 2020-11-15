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
            <div class="col-xl-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    Girdi-Çıktı Listesi
                  </h4>
                  <p class="card-subtitle mb-4">Tüm muhasebe hareketlerinize buradan ulaşabilirsiniz</p>
                  <div class="table-responsive">
                    <form class="form-inline d-none frmTableSearch" model="accounting-record" action="" method="post">
                      <div class="form-group">
                        <label for="txtAccountingRecordCustomerId">Satış Müşterisi : </label>
                        <input type="text" class="form-control" name="txtAccountingRecordCustomerId" id="txtAccountingRecordCustomerId">
                      </div>
                      <div class="form-group">
                        <label for="txtAccountingRecordSupplierId">Tedarikçi : </label>
                        <input type="text" class="form-control" name="txtAccountingRecordSupplierId" id="txtAccountingRecordSupplierId">
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
                <!-- end card-body-->

              </div>
              <!-- end card -->

            </div>
            <!-- end col -->

          </div>
          <!-- end row -->

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
  <script src="<?php echo $this->pathHtml; ?>views/apps/accounting/accounting-record/accounting-record-list/accounting-record-list.js"></script>

</body>


</html>
