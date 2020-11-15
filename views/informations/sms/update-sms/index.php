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

                  <h4 class="card-title">Sms Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">Smsınızın bilgilerini buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdateSms" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSmsUrl">Sms Url (*)</label>
                      <input type="hidden" name="txtSmsId" value="<?php echo $this->smsInformations["sms_id"]; ?>">
                      <input value="<?php echo $this->smsInformations["sms_url"]; ?>" type="text" class="form-control" name="txtSmsUrl" id="txtSmsUrl" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSmsUsername">Sms Kullanıcı Adı (*)</label>
                      <input value="<?php echo $this->smsInformations["sms_username"]; ?>" type="text" class="form-control" name="txtSmsUsername" id="txtSmsUsername" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSmsPassword">Sms Parolası (*)</label>
                      <input value="<?php echo $this->smsInformations["sms_password"]; ?>" type="password" class="form-control" name="txtSmsPassword" id="txtSmsPassword" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSmsOriginator">Sms Başlığı (*)</label>
                      <input value="<?php echo $this->smsInformations["sms_originator"]; ?>" type="text" class="form-control" name="txtSmsOriginator" id="txtSmsOriginator" required>
                    </div>
                    <!-- form group -->



                    <button type="submit" class="btn btn-primary btnLoadingUpdateSms">Kaydet</button>
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
  <script src="<?php echo $this->pathHtml; ?>views/informations/sms/update-sms/update-sms.js"></script>

</body>


</html>
