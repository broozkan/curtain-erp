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

                  <h4 class="card-title">Fabrika Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">Fabrikaınızın bilgilerini buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdateFactory" method="post" model="factory">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtFactoryProgramUniqueId">Fabrika ID (*)</label>
                      <input type="hidden" name="txtFactoryId" value="<?php echo $this->factoryInformations["factory_id"]; ?>">
                      <input value="<?php echo $this->factoryInformations["factory_program_unique_id"]; ?>" type="text" class="form-control" name="txtFactoryProgramUniqueId" id="txtFactoryProgramUniqueId" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtFactoryName">Fabrika Adı (*)</label>
                      <input type="hidden" name="txtFactoryId" value="<?php echo $this->factoryInformations["factory_id"]; ?>">
                      <input value="<?php echo $this->factoryInformations["factory_name"]; ?>" type="text" class="form-control" name="txtFactoryName" id="txtFactoryName" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtFactoryAddress">Fabrika Adresi</label>
                      <input value="<?php echo $this->factoryInformations["factory_address"]; ?>" type="text" class="form-control" name="txtFactoryAddress" id="txtFactoryAddress">
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtFactoryPhoneNumber">Fabrika Telefon Numarası</label>
                      <input value="<?php echo $this->factoryInformations["factory_phone_number"]; ?>" type="text" class="form-control" name="txtFactoryPhoneNumber" id="txtFactoryPhoneNumber">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtFactoryEmail">Fabrika E-Posta Adresi</label>
                      <input value="<?php echo $this->factoryInformations["factory_email"]; ?>" type="text" class="form-control email" name="txtFactoryEmail" id="txtFactoryEmail">
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtFactoryDbServer">Fabrika Veritabanı Sunucusu (*)</label>
                      <input value="<?php echo $this->factoryInformations["factory_db_server"]; ?>" type="text" class="form-control ip" name="txtFactoryDbServer" id="txtFactoryDbServer" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtFactoryDbName">Fabrika Veritabanı Adı (*)</label>
                      <input value="<?php echo $this->factoryInformations["factory_db_name"]; ?>" type="text" class="form-control" name="txtFactoryDbName" id="txtFactoryDbName" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtFactoryDbUsername">Fabrika Veritabanı Kullanıcı Adı (*)</label>
                      <input value="<?php echo $this->factoryInformations["factory_db_username"]; ?>" type="text" class="form-control" name="txtFactoryDbUsername" id="txtFactoryDbUsername" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtFactoryDbPassword">Fabrika Veritabanı Parolası (*)</label>
                      <input value="<?php echo $this->factoryInformations["factory_db_password"]; ?>" type="password" class="form-control" name="txtFactoryDbPassword" id="txtFactoryDbPassword" required>
                    </div>
                    <!-- form group -->



                    <button type="submit" class="btn btn-primary btnLoadingUpdateFactory">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>factory/factory-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/units/factory/update-factory/update-factory.js"></script>

</body>


</html>
