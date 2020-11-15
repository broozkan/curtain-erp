<!DOCTYPE html>
<html lang="tr">

<?php require $this->pathPhp."arayuz/head.php"; ?>

<style media="screen">
  .btnUpdate{
    display: none;
  }
</style>
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
                    Satışlar Listesi
                    <a href="<?php echo $this->pathHtml; ?>sale/new-sale" class="btn btn-primary btn-sm float-right"> <span class="fa fa-plus"></span> Yeni Satış Ekle</a>
                  </h4>
                  <p class="card-subtitle mb-4">Satışlerinizin listesine buradan ulaşabilirsiniz</p>
                  <div class="table-responsive">
                    <form class="form-inline frmTableSearch" model="sale" action="" method="post">
                      <div class="form-group">
                        <label for="txtSaleCustomerId">Satış Müşterisi : </label>
                        <input type="text" class="form-control" name="txtSaleCustomerId" id="txtSaleCustomerId" value="">
                      </div>
                      <div class="form-group">
                        <label for="txtSaleDate">Satış Tarihi : </label>
                        <input type="date" class="form-control" name="txtSaleDate" id="txtSaleDate" value="">
                      </div>
                      <div class="form-group">
                        <label for="txtSaleState">Durumu : </label>
                        <input type="text" class="form-control" name="txtSaleState" id="txtSaleState" value="">
                      </div>
                      <div class="form-group">
                        <label for="txtSaleFactoryState">Fabrika Durumu : </label>
                        <input type="text" class="form-control" name="txtSaleFactoryState" id="txtSaleFactoryState" value="">
                      </div>
                      <div class="form-group">
                        <label>Atölye Onay Tarih Aralığı : </label>
                        <input type="date" class="form-control" name="txtWorkshopVerifyBeginningDate" id="txtWorkshopVerifyBeginningDate" value="">
                        <input type="date" class="form-control" name="txtWorkshopVerifyEndingDate" id="txtWorkshopVerifyEndingDate" value="">
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
                          <th>Durum</th>
                          <th>Fabrika Durumu</th>
                          <th class="d-none">Dikiş Ustası</th>
                          <th>Dikiş Ustası</th>
                          <!-- <th>Durum</th> -->
                          <!-- <th>Dikiş Ustası</th> -->
                          <th>İşlem</th>
                        </tr>
                      </thead>
                      <tbody>
                        <div class="loading d-none">
                          <img src='<?php echo $this->pathHtml; ?>assets/images/table-loading.gif' class="table-spinner"/>
                        </div>
                        <?php
                        // for ($i=0; $i < count($this->sales); $i++) {
                        // echo '<tr id='.$this->sales[$i]["sale_id"].'">';
                        // echo '<td>'.$this->sales[$i]["sale_id"].'</td>';
                        // echo '<td>'.$this->sales[$i]["sale_name"].'</td>';
                        // echo '<td>'.$this->sales[$i]["sale_phone_number"].'</td>';
                        // echo '<td>'.$this->sales[$i]["sale_email"].'</td>';
                        // echo '<td>'.$this->sales[$i]["sale_username"].'</td>';
                        // echo '<td>';
                        // echo '<div class="btn-group mb-2">';
                        // echo '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">İşlem <i class="mdi mdi-chevron-down"></i></button>';
                        // echo '<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">';
                        // echo '<a class="dropdown-item" href="#">Profil</a>';
                        // echo '<a class="dropdown-item" href="#">Düzenle</a>';
                        // echo '<a class="dropdown-item" href="#">Sil</a>';
                        // echo '</div>';
                        // echo '</div>';
                        // echo '</td>';
                        // echo '</tr>';
                        // }
                        ?>

                      </tbody>
                    </table>
                    <div class="card-footer ">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="pagination">
                            <?php
                            // for ($i=1; $i < ($this->totalPageNumber + 1); $i++) {
                            //   echo '<a href="#" value="'.$i.'">'.$i.'</a>';
                            // }
                            ?>
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
  <script src="<?php echo $this->pathHtml; ?>views/apps/sale/sale-list/sale-list.js"></script>

</body>


</html>
