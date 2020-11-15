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

                  <h4 class="card-title">Şirket Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">Şirketınızın bilgilerini buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdateCompany" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCompanyName">Şirket Adı (*)</label>
                      <input type="hidden" name="txtCompanyId" value="<?php echo $this->companyInformations["company_id"]; ?>">
                      <input value="<?php echo $this->companyInformations["company_name"]; ?>" type="text" class="form-control" name="txtCompanyName" id="txtCompanyName" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCompanyAddress">Şirket Adresi</label>
                      <input value="<?php echo $this->companyInformations["company_address"]; ?>" type="text" class="form-control" name="txtCompanyAddress" id="txtCompanyAddress" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCompanyPhoneNumber">Şirket Telefon Numarası </label>
                      <input value="<?php echo $this->companyInformations["company_phone_number"]; ?>" type="text" class="form-control mobile-phone-number" name="txtCompanyPhoneNumber" id="txtCompanyPhoneNumber">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCompanyEmail">Şirket E-posta Adresi </label>
                      <input value="<?php echo $this->companyInformations["company_email"]; ?>" type="text" class="form-control email" name="txtCompanyEmail" id="txtCompanyEmail">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCompanyTaxNumber">Şirket Vergi Numarası </label>
                      <input value="<?php echo $this->companyInformations["company_tax_number"]; ?>" type="number" class="form-control" name="txtCompanyTaxNumber" id="txtCompanyTaxNumber">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCompanyTaxDepartment">Şirket Vergi Dairesi </label>
                      <input value="<?php echo $this->companyInformations["company_tax_department"]; ?>" type="text" class="form-control" name="txtCompanyTaxDepartment" id="txtCompanyTaxDepartment">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCompanyWebsite">Şirket Web Sitesi </label>
                      <input value="<?php echo $this->companyInformations["company_website"]; ?>" type="text" class="form-control" name="txtCompanyWebsite" id="txtCompanyWebsite">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCompanyLogo">Şirket Logosu </label>
                      <input type="file" class="form-control" name="txtCompanyLogo" id="txtCompanyLogo">
                    </div>
                    <!-- form group -->


                    <button type="submit" class="btn btn-primary btnLoadingUpdateCompany">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>company/company-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/informations/company/update-company/update-company.js"></script>

</body>


</html>
