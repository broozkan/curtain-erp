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

                  <h4 class="card-title">Satış Faturasını Düzenle</h4>
                  <p class="card-subtitle mb-4">Satış Faturasını düzenleyebilirsiniz.</p>

                  <?php require $this->pathPhp."arayuz/forms/update/formUpdateSaleInvoice.php"; ?>

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
  <script src="<?php echo $this->pathHtml; ?>assets/js/objects/sale-invoice.js"></script>
  <script src="<?php echo $this->pathHtml; ?>views/apps/accounting/sale-invoice/update-sale-invoice/update-sale-invoice.js"></script>

</body>


</html>
