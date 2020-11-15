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

                  <h4 class="card-title">Program Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">Programınızın bilgilerini buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdateSoftwareSetting" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSoftwareSettingCostSecureAmount">Masraf Emniyet Payı Adı (*)</label>
                      <input type="hidden" name="txtSoftwareSettingId" value="<?php echo $this->softwareInformations["software_setting_id"]; ?>">
                      <input value="<?php echo $this->softwareInformations["software_setting_cost_secure_amount"]; ?>" type="number" step=".01" class="form-control" name="txtSoftwareSettingCostSecureAmount" id="txtSoftwareSettingCostSecureAmount" required>
                    </div>
                    <!-- form group -->


                    <button type="submit" class="btn btn-primary btnLoadingUpdateSoftwareSetting">Kaydet</button>
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
  <script src="<?php echo $this->pathHtml; ?>views/informations/software-setting/update-software-setting/update-software-setting.js"></script>

</body>


</html>
