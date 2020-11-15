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

                  <h4 class="card-title">E-Posta Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">E-posta bilgilerinizi buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdateEmail" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtEmailHost">E-Posta Host (*)</label>
                      <input type="hidden" name="txtEmailId" value="<?php echo $this->emailInformations["email_id"]; ?>">
                      <input value="<?php echo $this->emailInformations["email_host"]; ?>" type="text" class="form-control" name="txtEmailHost" id="txtEmailHost" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtEmailUsername">E-Posta Kullanıcı Adı (*)</label>
                      <input value="<?php echo $this->emailInformations["email_username"]; ?>" type="text" class="form-control" name="txtEmailUsername" id="txtEmailUsername" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtEmailPassword">E-Posta Parola (*)</label>
                      <input value="<?php echo $this->emailInformations["email_password"]; ?>" type="text" class="form-control" name="txtEmailPassword" id="txtEmailPassword" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtEmailPort">E-Posta Port (*)</label>
                      <input value="<?php echo $this->emailInformations["email_port"]; ?>" type="number" class="form-control" name="txtEmailPort" id="txtEmailPort" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtEmailFromName">E-Posta Gönderen Adı (*)</label>
                      <input value="<?php echo $this->emailInformations["email_port"]; ?>" type="number" class="form-control" name="txtEmailFromName" id="txtEmailFromName" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtEmailUsername">E-Posta Kullanıcı Adı (*)</label>
                      <input value="<?php echo $this->emailInformations["email_username"]; ?>" type="text" class="form-control" name="txtEmailUsername" id="txtEmailUsername" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtEmailPassword">E-Posta Parolası (*)</label>
                      <input value="<?php echo $this->emailInformations["email_password"]; ?>" type="password" class="form-control" name="txtEmailPassword" id="txtEmailPassword" required>
                    </div>
                    <!-- form group -->

                    <button type="submit" class="btn btn-primary btnLoadingUpdateEmail">Kaydet</button>
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
  <script src="<?php echo $this->pathHtml; ?>views/informations/email/update-email/update-email.js"></script>

</body>


</html>
