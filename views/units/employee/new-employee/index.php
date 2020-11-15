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

                  <h4 class="card-title">Yeni Çalışan Ekle</h4>
                  <p class="card-subtitle mb-4">Yeni bir çalışanınızı buradan ekleyebilirsiniz.</p>

                  <form id="frmNewEmployee" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtEmployeeName">Çalışan Adı Soyadı (*)</label>
                      <input type="text" class="form-control" name="txtEmployeeName" id="txtEmployeeName" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtEmployeePhoneNumber">Çalışan Telefon Numarası </label>
                      <input type="text" class="form-control mobile-phone-number" name="txtEmployeePhoneNumber" id="txtEmployeePhoneNumber">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtEmployeeEmail">Çalışan E-posta Adresi </label>
                      <input type="text" class="form-control email" name="txtEmployeeEmail" id="txtEmployeeEmail">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtEmployeePhoto">Çalışan Fotoğrafı </label>
                      <input type="file" class="form-control" name="txtEmployeePhoto" id="txtEmployeePhoto">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtEmployeeRedirectUrl">Çalışan Giriş Sayfası </label>
                      <input type="text" class="form-control" name="txtEmployeeRedirectUrl" id="txtEmployeeRedirectUrl">
                    </div>
                    <!-- form group -->
                    <hr>
                    <h4 class="card-title">Çalışan Giriş Bilgileri </h4>
                    <sup>Kullanıcı giriş yapmayacaksa boş bırakabilirsiniz</sup>

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtEmployeeUsername">Çalışan Kullanıcı Adı </label>
                      <input type="text" class="form-control" name="txtEmployeeUsername" id="txtEmployeeUsername" aria-describedby="txtEmployeeUsernameHelp">
                      <small id="txtEmployeeUsernameHelp" class="form-text text-muted">Kullanıcı giriş yapmayacaksa boş bırakabilirsiniz</small>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-row">
                      <div class="form-group">
                        <label for="txtEmployeePassword">Çalışan Parolası </label>
                        <input type="password" class="form-control" name="txtEmployeePassword" id="txtEmployeePassword" aria-describedby="txtEmployeePasswordHelp">
                        <small id="txtEmployeePasswordHelp" class="form-text text-muted">Kullanıcı giriş yapmayacaksa boş bırakabilirsiniz</small>
                      </div>
                      <div class="form-group ml-3">
                        <label for="txtEmployeePasswordRepeat">Çalışan Parolası (Tekrar)</label>
                        <input type="password" class="form-control" name="txtEmployeePasswordRepeat" id="txtEmployeePasswordRepeat" aria-describedby="txtEmployeePasswordRepeatHelp">
                        <small id="txtEmployeePasswordRepeatHelp" class="form-text text-muted">Kullanıcı giriş yapmayacaksa boş bırakabilirsiniz</small>
                      </div>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group mb-3">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="txtEmployeePermissions[]" id="txtEmployeeCanSale" value="txtEmployeeCanSale">
                        <label class="custom-control-label" for="txtEmployeeCanSale">Satış gerçekleştirebilir</label>
                      </div>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group mb-3">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="txtEmployeePermissions[]" id="txtEmployeeCanInvoice" value="txtEmployeeCanInvoice">
                        <label class="custom-control-label" for="txtEmployeeCanInvoice">Fatura Kesebilir</label>
                      </div>
                    </div>
                    <!-- form group -->

                    <button type="submit" class="btn btn-primary btnLoadingNewEmployee">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>employee/employee-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/units/employee/new-employee/new-employee.js"></script>

</body>


</html>
