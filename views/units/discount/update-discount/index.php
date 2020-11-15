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

                  <h4 class="card-title">İndirim Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">İndirimınızın bilgilerini buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdateDiscount" method="post" model="discount">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtDiscountName">İndirim Adı (*)</label>
                      <input type="hidden" name="txtDiscountId" value="<?php echo $this->discountInformations["discount_id"]; ?>">
                      <input value="<?php echo $this->discountInformations["discount_name"]; ?>" type="text" class="form-control" name="txtDiscountName" id="txtDiscountName" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtDiscountType">İndirim Tipi (*)</label>
                      <select class="form-control" name="txtDiscountType" required data-value="<?php echo $this->discountInformations["discount_type"]; ?>">
                        <option value="" selected disabled>-Seçiniz-</option>
                        <option value="0">Yüzde</option>
                        <option value="1">Tutar</option>
                      </select>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtDiscountAmount">İndirim Miktarı</label>
                      <input value="<?php echo $this->discountInformations["discount_amount"]; ?>" type="text" class="form-control" name="txtDiscountAmount" id="txtDiscountAmount" required>
                    </div>
                    <!-- form group -->


                    <button type="submit" class="btn btn-primary btnLoadingUpdateDiscount">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>discount/discount-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/units/discount/update-discount/update-discount.js"></script>

</body>


</html>
