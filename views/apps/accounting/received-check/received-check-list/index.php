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
                    Alınan Çekler Listesi
                    <a href="<?php echo $this->pathHtml; ?>received-check/new-received-check" class="btn btn-primary btn-sm float-right"> <span class="fa fa-plus"></span> Yeni Alınan Çek Ekle</a>
                  </h4>
                  <p class="card-subtitle mb-4">Alınan Çeklerinizin listesine buradan ulaşabilirsiniz</p>
                  <div class="table-responsive">
                    <form class="form-inline frmTableSearch" model="received-check" action="" method="post">
                      <div class="form-group">
                        <label for="txtReceivedCheckCustomerId">Alınan Çek Müşterisi : </label>
                        <input type="text" class="form-control" name="txtReceivedCheckCustomerId" id="txtReceivedCheckCustomerId" value="">
                      </div>
                      <div class="form-group">
                        <label for="txtReceivedCheckCategoryId">Alınan Çek Kategorisi : </label>
                        <input type="text" class="form-control" name="txtReceivedCheckCategoryId" id="txtReceivedCheckCategoryId" value="">
                      </div>
                      <div class="form-group">
                        <label for="txtReceivedCheckMaturityDate">Alınan Çek Vade Tarihi : </label>
                        <input type="date" class="form-control" name="txtReceivedCheckMaturityDate" id="txtReceivedCheckMaturityDate" value="">
                      </div>
                      <div class="form-group">
                        <label for="txtReceivedCheckCashId">Alınan Çek Kasası : </label>
                        <input type="text" class="form-control" name="txtReceivedCheckCashId" id="txtReceivedCheckCashId" value="">
                      </div>
                      <div class="form-group">
                        <label for="txtReceivedCheckBankId">Alınan Çek Bankası : </label>
                        <input type="text" class="form-control" name="txtReceivedCheckBankId" id="txtReceivedCheckBankId" value="">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm" name="button">Ara</button>
                      </div>
                    </form>
                    <table class="table mb-0" id="received-check-list" model="received_check" is-override="false" page-number="1" item-per-page="1">
                      <thead class="thead-light">
                        <tr>
                          <th>#</th>
                          <th>Müşteri</th>
                          <th>Kategori</th>
                          <th>Vade Tarihi</th>
                          <th>Kasa</th>
                          <th>Banka</th>
                          <th>Tutar</th>
                          <th>İşlem</th>
                        </tr>
                      </thead>
                      <tbody>
                        <div class="loading d-none">
                          <img src='<?php echo $this->pathHtml; ?>assets/images/table-loading.gif' class="table-spinner"/>
                        </div>
                        <?php
                        // for ($i=0; $i < count($this->received-checks); $i++) {
                          // echo '<tr id='.$this->received-checks[$i]["received-check_id"].'">';
                          // echo '<td>'.$this->received-checks[$i]["received-check_id"].'</td>';
                          // echo '<td>'.$this->received-checks[$i]["received-check_name"].'</td>';
                          // echo '<td>'.$this->received-checks[$i]["received-check_phone_number"].'</td>';
                          // echo '<td>'.$this->received-checks[$i]["received-check_email"].'</td>';
                          // echo '<td>'.$this->received-checks[$i]["received-check_username"].'</td>';
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
                              <option value="1" selected>1</option>
                              <option value="5">5</option>
                              <option value="7">7</option>
                              <option value="10">10</option>
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
  <script src="<?php echo $this->pathHtml; ?>views/apps/accounting/received-check/received-check-list/received-check-list.js"></script>

</body>


</html>
