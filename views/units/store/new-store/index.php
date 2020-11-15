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

                  <h4 class="card-title">Yeni Depo Ekle</h4>
                  <p class="card-subtitle mb-4">Yeni bir çalışanınızı buradan ekleyebilirsiniz.</p>

                  <form id="frmNewStore" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtStoreName">Depo Adı (*)</label>
                      <input type="text" class="form-control" name="txtStoreName" id="txtStoreName" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtStoreAddress">Depo Adresi</label>
                      <input type="text" class="form-control" name="txtStoreAddress" id="txtStoreAddress">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtStorePhoneNumber">Depo Telefon Numarası</label>
                      <input type="text" class="form-control mobile-phone-number" name="txtStorePhoneNumber" id="txtStorePhoneNumber">
                    </div>
                    <!-- form group -->


                    <button type="submit" class="btn btn-primary btnLoadingNewStore">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>store/store-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/units/store/new-store/new-store.js"></script>

</body>


</html>
