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

                  <h4 class="card-title">Vergi Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">Vergiınızın bilgilerini buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdateTax" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtTaxName">Vergi Adı (*)</label>
                      <input type="hidden" name="txtTaxId" value="<?php echo $this->taxInformations["tax_id"]; ?>">
                      <input value="<?php echo $this->taxInformations["tax_name"]; ?>" type="text" class="form-control" name="txtTaxName" id="txtTaxName" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtTaxPercentage">Vergi Adresi</label>
                      <input value="<?php echo $this->taxInformations["tax_percentage"]; ?>" type="text" class="form-control" name="txtTaxPercentage" id="txtTaxPercentage" required>
                    </div>
                    <!-- form group -->



                    <button type="submit" class="btn btn-primary btnLoadingUpdateTax">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>tax/tax-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/units/tax/update-tax/update-tax.js"></script>

</body>


</html>
