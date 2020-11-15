<!DOCTYPE html>
<html lang="tr">

<?php require $this->pathPhp."arayuz/head.php"; ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->pathHtml; ?>assets/css/sale.css">

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

                  <h4 class="card-title">Yeni Satış Ekle</h4>
                  <p class="card-subtitle mb-4">Yeni bir çalışanınızı buradan ekleyebilirsiniz.</p>

                  <?php require $this->pathPhp."arayuz/forms/new/formNewSale.php"; ?>

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

  <?php require $this->pathPhp."arayuz/modals/modalNewDiscount.php"; ?>
  <?php require $this->pathPhp."arayuz/modals/modalNewCustomer.php"; ?>
  <?php require $this->pathPhp."arayuz/modals/modalNewCategory.php"; ?>

  <?php require $this->pathPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->pathHtml; ?>views/apps/sale/new-sale/new-sale.js"></script>
  <script src="<?php echo $this->pathHtml; ?>assets/js/sale.js"></script>

</body>


</html>
