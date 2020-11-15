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

                  <h4 class="card-title">Yeni Tedarikçi Ekle</h4>
                  <p class="card-subtitle mb-4">Yeni bir tedarikçinizi buradan ekleyebilirsiniz.</p>

                  <form id="frmNewSupplier" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSupplierName">Tedarikçi Adı (*)</label>
                      <input type="text" class="form-control" name="txtSupplierName" id="txtSupplierName" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSupplierAddress">Tedarikçi Adresi</label>
                      <input type="text" class="form-control" name="txtSupplierAddress" id="txtSupplierAddress" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSupplierPhoneNumber">Tedarikçi Telefon Numarası </label>
                      <input type="text" class="form-control mobile-phone-number" name="txtSupplierPhoneNumber" id="txtSupplierPhoneNumber">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSupplierEmail">Tedarikçi E-posta Adresi </label>
                      <input type="text" class="form-control email" name="txtSupplierEmail" id="txtSupplierEmail">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSupplierTaxNumber">Tedarikçi Vergi Numarası </label>
                      <input type="number" class="form-control" name="txtSupplierTaxNumber" id="txtSupplierTaxNumber">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSupplierTaxDepartment">Tedarikçi Vergi Dairesi </label>
                      <input type="number" class="form-control" name="txtSupplierTaxDepartment" id="txtSupplierTaxDepartment">
                    </div>
                    <!-- form group -->


                    <button type="submit" class="btn btn-primary btnLoadingNewSupplier">Kaydet</button>
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
  <script src="<?php echo $this->pathHtml; ?>views/units/supplier/new-supplier/new-supplier.js"></script>

</body>


</html>
