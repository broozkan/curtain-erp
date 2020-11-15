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

                  <h4 class="card-title">Bayi Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">Bayiınızın bilgilerini buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdateDealer" method="post" model="dealer">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtDealerProgramUniqueId">Bayi ID (*)</label>
                      <input type="hidden" name="txtDealerId" value="<?php echo $this->dealerInformations["dealer_id"]; ?>">
                      <input value="<?php echo $this->dealerInformations["dealer_program_unique_id"]; ?>" type="text" class="form-control" name="txtDealerProgramUniqueId" id="txtDealerProgramUniqueId" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtDealerName">Bayi Adı (*)</label>
                      <input type="hidden" name="txtDealerId" value="<?php echo $this->dealerInformations["dealer_id"]; ?>">
                      <input value="<?php echo $this->dealerInformations["dealer_name"]; ?>" type="text" class="form-control" name="txtDealerName" id="txtDealerName" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtDealerAddress">Bayi Adresi</label>
                      <input value="<?php echo $this->dealerInformations["dealer_address"]; ?>" type="text" class="form-control" name="txtDealerAddress" id="txtDealerAddress">
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtDealerPhoneNumber">Bayi Telefon Numarası</label>
                      <input value="<?php echo $this->dealerInformations["dealer_phone_number"]; ?>" type="text" class="form-control" name="txtDealerPhoneNumber" id="txtDealerPhoneNumber">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtDealerEmail">Bayi E-Posta Adresi</label>
                      <input value="<?php echo $this->dealerInformations["dealer_email"]; ?>" type="text" class="form-control email" name="txtDealerEmail" id="txtDealerEmail">
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtDealerDbServer">Bayi Veritabanı Sunucusu (*)</label>
                      <input value="<?php echo $this->dealerInformations["dealer_db_server"]; ?>" type="text" class="form-control ip" name="txtDealerDbServer" id="txtDealerDbServer" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtDealerDbName">Bayi Veritabanı Adı (*)</label>
                      <input value="<?php echo $this->dealerInformations["dealer_db_name"]; ?>" type="text" class="form-control" name="txtDealerDbName" id="txtDealerDbName" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtDealerDbUsername">Bayi Veritabanı Kullanıcı Adı (*)</label>
                      <input value="<?php echo $this->dealerInformations["dealer_db_username"]; ?>" type="text" class="form-control" name="txtDealerDbUsername" id="txtDealerDbUsername" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtDealerDbPassword">Bayi Veritabanı Parolası (*)</label>
                      <input value="<?php echo $this->dealerInformations["dealer_db_password"]; ?>" type="password" class="form-control" name="txtDealerDbPassword" id="txtDealerDbPassword" required>
                    </div>
                    <!-- form group -->



                    <button type="submit" class="btn btn-primary btnLoadingUpdateDealer">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>dealer/dealer-list/" class="btn btn-danger">İptal</a>
                  </form>


                </div> <!-- end card-body-->
              </div> <!-- end card-->



            </div>

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
  <script src="<?php echo $this->pathHtml; ?>views/units/dealer/update-dealer/update-dealer.js"></script>

</body>


</html>
