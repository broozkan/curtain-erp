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
            <div class="col-xl-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    Teslimat Tarihi <strong class="font-weight-bold text-danger">BUGÜN</strong> Olan Siparişler Listesi
                  </h4>
                  <div class="table-responsive">
                    <form class="form-inline frmCustomTableSearch" model="factory" action="" method="post">
                      <div class="form-group">
                        <label for="txtSearchSaleBarcode">Satış Barkodu : </label>
                        <input type="text" class="form-control" name="txtSearchSaleBarcode" id="txtSearchSaleBarcode" value="">
                      </div>
                      <div class="form-group d-none">
                        <label for="txtSearchFactoryId">Fabrika : </label>
                        <input type="text" class="form-control" name="txtSearchFactoryId" id="txtSearchFactoryId" value="<?php echo $this->factoryInformations["factory_id"]; ?>">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm" name="button">Ara</button>
                      </div>
                    </form>
                    <table class="table mb-0 tbl-todays-works" id="factory-queue" function="factory-queue" model="factory" is-override="true" page-number="1" item-per-page="10" override-function="overrideFactoryQueue" >
                      <thead class="thead-light">
                        <tr>
                          <th>#</th>
                          <th>Müşteri</th>
                          <th>Satış Barkodu</th>
                          <th>Teslimat Tarihi</th>
                          <th>İşlem</th>
                        </tr>
                      </thead>
                      <tbody>
                        <div class="loading d-none">
                          <img src='<?php echo $this->pathHtml; ?>assets/images/table-loading.gif' class="table-spinner"/>
                        </div>
                        <?php

                        ?>

                      </tbody>
                    </table>
                    <div class="card-footer ">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="custom-pagination">
                            <?php
                              // for ($i=1; $i < ($this->totalPageNumber + 1); $i++) {
                              //   echo '<a href="#" value="'.$i.'">'.$i.'</a>';
                              // }
                            ?>
                          </div>
                          <div class="itemPerPage display-inline-block float-right">
                            Sayfa başı
                            <select class="form-control form-control-sm txtCustomItemPerPage" id="">
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
                <!-- end card-body-->

              </div>
              <!-- end card -->

            </div>
            <!-- end col -->
            <div class="col-xl-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    Teslimat Tarihi <strong class="font-weight-bold text-warning">YARIN</strong> Olan Siparişler Listesi
                  </h4>
                  <div class="table-responsive">
                    <table class="table mb-0 tbl-tomorrows-works" >
                      <thead class="thead-light">
                        <tr>
                          <th>#</th>
                          <th>Müşteri</th>
                          <th>Satış Barkodu</th>
                          <th>Teslimat Tarihi</th>
                          <th>İşlem</th>
                        </tr>
                      </thead>
                      <tbody>
                        <div class="loading d-none">
                          <img src='<?php echo $this->pathHtml; ?>assets/images/table-loading.gif' class="table-spinner"/>
                        </div>
                        <?php

                        ?>

                      </tbody>
                    </table>
                    <div class="card-footer ">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="custom-pagination">
                            <?php
                              // for ($i=1; $i < ($this->totalPageNumber + 1); $i++) {
                              //   echo '<a href="#" value="'.$i.'">'.$i.'</a>';
                              // }
                            ?>
                          </div>
                          <div class="itemPerPage display-inline-block float-right">
                            Sayfa başı
                            <select class="form-control form-control-sm txtCustomItemPerPage" id="">
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
                <!-- end card-body-->

              </div>
              <!-- end card -->

            </div>
            <!-- end col -->
            <div class="col-xl-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    Teslimat Tarihi <strong class="font-weight-bold">SONRA</strong> Olan Siparişler Listesi
                  </h4>
                  <div class="table-responsive">
                    <table class="table mb-0 tbl-other-works" >
                      <thead class="thead-light">
                        <tr>
                          <th>#</th>
                          <th>Müşteri</th>
                          <th>Satış Barkodu</th>
                          <th>Teslimat Tarihi</th>
                          <th>İşlem</th>
                        </tr>
                      </thead>
                      <tbody>
                        <div class="loading d-none">
                          <img src='<?php echo $this->pathHtml; ?>assets/images/table-loading.gif' class="table-spinner"/>
                        </div>
                        <?php

                        ?>

                      </tbody>
                    </table>
                    <div class="card-footer ">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="custom-pagination">
                            <?php
                              // for ($i=1; $i < ($this->totalPageNumber + 1); $i++) {
                              //   echo '<a href="#" value="'.$i.'">'.$i.'</a>';
                              // }
                            ?>
                          </div>
                          <div class="itemPerPage display-inline-block float-right">
                            Sayfa başı
                            <select class="form-control form-control-sm txtCustomItemPerPage" id="">
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

  <?php require $this->pathPhp."arayuz/modals/modalVerifySaleFactory.php"; ?>

  <?php require $this->pathPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->pathHtml; ?>views/apps/factory/factory-queue/factory-queue.js"></script>

</body>


</html>
