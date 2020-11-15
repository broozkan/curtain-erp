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
            <div class="col-xl-12">


              <div class="card">
                <div class="card-body">

                  <h4 class="card-title">Yeni Alış Faturası Ekle</h4>
                  <p class="card-subtitle mb-4">Alış faturanızı buradan ekleyebilirsiniz</p>

                  <?php require $this->pathPhp."arayuz/forms/new/formNewPurchaseInvoice.php"; ?>

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

  <?php require $this->pathPhp."arayuz/modals/modalNewStockProduct.php"; ?>
  <?php require $this->pathPhp."arayuz/modals/modalNewUnit.php"; ?>
  <?php require $this->pathPhp."arayuz/modals/modalNewTax.php"; ?>

  <?php require $this->pathPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->pathHtml; ?>views/apps/accounting/purchase-invoice/new-purchase-invoice/new-purchase-invoice.js"></script>
  <script src="<?php echo $this->pathHtml; ?>assets/js/purchase-invoice.js"></script>

</body>


</html>
