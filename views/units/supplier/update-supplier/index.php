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

                  <h4 class="card-title">Tedarikçi Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">Tedarikçiınızın bilgilerini buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdateSupplier" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSupplierName">Tedarikçi Adı (*)</label>
                      <input type="hidden" name="txtSupplierId" value="<?php echo $this->supplierInformations["supplier_id"]; ?>">
                      <input value="<?php echo $this->supplierInformations["supplier_name"]; ?>" type="text" class="form-control" name="txtSupplierName" id="txtSupplierName" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSupplierAddress">Tedarikçi Adresi</label>
                      <input value="<?php echo $this->supplierInformations["supplier_address"]; ?>" type="text" class="form-control" name="txtSupplierAddress" id="txtSupplierAddress" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSupplierPhoneNumber">Tedarikçi Telefon Numarası </label>
                      <input value="<?php echo $this->supplierInformations["supplier_phone_number"]; ?>" type="text" class="form-control mobile-phone-number" name="txtSupplierPhoneNumber" id="txtSupplierPhoneNumber">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSupplierEmail">Tedarikçi E-posta Adresi </label>
                      <input value="<?php echo $this->supplierInformations["supplier_email"]; ?>" type="text" class="form-control email" name="txtSupplierEmail" id="txtSupplierEmail">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSupplierTaxNumber">Tedarikçi Vergi Numarası </label>
                      <input value="<?php echo $this->supplierInformations["supplier_tax_number"]; ?>" type="number" class="form-control" name="txtSupplierTaxNumber" id="txtSupplierTaxNumber">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSupplierTaxDepartment">Tedarikçi Vergi Dairesi </label>
                      <input value="<?php echo $this->supplierInformations["supplier_tax_department"]; ?>" type="number" class="form-control" name="txtSupplierTaxDepartment" id="txtSupplierTaxDepartment">
                    </div>
                    <!-- form group -->


                    <button type="submit" class="btn btn-primary btnLoadingUpdateSupplier">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>supplier/supplier-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/units/supplier/update-supplier/update-supplier.js"></script>

</body>


</html>
