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

                  <h4 class="card-title">Yeni Banka Ekle</h4>
                  <p class="card-subtitle mb-4">Yeni bir çalışanınızı buradan ekleyebilirsiniz.</p>

                  <form id="frmNewBank" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtBankName">Banka Adı (*)</label>
                      <input type="text" class="form-control" name="txtBankName" id="txtBankName" required>
                    </div>
                    <!-- form group -->


                    <button type="submit" class="btn btn-primary btnLoadingNewBank">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>bank/bank-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/units/bank/new-bank/new-bank.js"></script>

</body>


</html>
