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

                  <h4 class="card-title">Kategori Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">Kategoriınızın bilgilerini buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdateCategory" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCategoryName">Kategori Adı (*)</label>
                      <input type="hidden" name="txtCategoryId" value="<?php echo $this->categoryInformations["category_id"]; ?>">
                      <input value="<?php echo $this->categoryInformations["category_name"]; ?>" type="text" class="form-control" name="txtCategoryName" id="txtCategoryName" required>
                    </div>
                    <!-- form group -->

        


                    <button type="submit" class="btn btn-primary btnLoadingUpdateCategory">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>category/category-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/units/category/update-category/update-category.js"></script>

</body>


</html>
