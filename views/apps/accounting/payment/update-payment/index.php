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

                  <h4 class="card-title">Ödemeyi Düzenle</h4>
                  <p class="card-subtitle mb-4">Ödemenizi düzenleyebilirsiniz.</p>

                  <form id="frmUpdatePayment" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentSupplierId">Ödeme Tedarikçisi (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtPaymentSupplierId"
                      table="tbl_suppliers"
                      model="supplier"
                      property="name"
                      click="true"
                      data-id="<?php echo $this->paymentInformations["payment_supplier_id"]; ?>"
                      value="<?php echo $this->paymentInformations["supplier_name"]; ?>"
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentCategoryId">Ödeme Kategorisi (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtPaymentCategoryId"
                      table="tbl_categories"
                      model="category"
                      property="name"
                      click="true"
                      data-id="<?php echo $this->paymentInformations["payment_category_id"]; ?>"
                      value="<?php echo $this->paymentInformations["category_name"]; ?>"
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentDate">Ödeme Tarihi (*)</label>
                      <input value="<?php echo $this->paymentInformations["payment_date"]; ?>" type="date" class="form-control" name="txtPaymentDate" id="txtPaymentDate" required>
                      <input type="hidden" name="txtPaymentId" value="<?php echo $this->paymentInformations["payment_id"]; ?>">
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentCashId">Ödeme Kasası (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtPaymentCashId"
                      table="tbl_cashes"
                      model="cash"
                      property="name"
                      click="true"
                      data-id="<?php echo $this->paymentInformations["payment_cash_id"]; ?>"
                      value="<?php echo $this->paymentInformations["cash_name"]; ?>"
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentAmount">Ödeme Miktarı (*)</label>
                      <input value="<?php echo $this->paymentInformations["payment_amount"]; ?>" type="number" step=".01" class="form-control" name="txtPaymentAmount" id="txtPaymentAmount" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" checked class="custom-control-input" id="txtIsPaymentRepeat">
                        <label class="custom-control-label" for="txtIsPaymentRepeat">Ödeme Otomatik Tekrarlansın</label>
                      </div>
                    </div>
                    <!-- form group -->

                    <button type="submit" class="btn btn-primary btnLoadingUpdatePayment">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>payment/payment-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/apps/accounting/payment/update-payment/update-payment.js"></script>

</body>


</html>
