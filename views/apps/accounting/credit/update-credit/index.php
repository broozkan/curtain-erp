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

                  <h4 class="card-title">Krediyi Düzenle</h4>
                  <p class="card-subtitle mb-4">Kredinizi düzenleyebilirsiniz.</p>

                  <form id="frmUpdateCredit" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCreditSupplierId">Kredi Tedarikçisi (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtCreditSupplierId"
                      table="tbl_suppliers"
                      model="supplier"
                      property="name"
                      click="true"
                      data-id="<?php echo $this->creditInformations["credit_supplier_id"]; ?>"
                      value="<?php echo $this->creditInformations["supplier_name"]; ?>"
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCreditCategoryId">Kredi Kategorisi (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtCreditCategoryId"
                      table="tbl_categories"
                      model="category"
                      property="name"
                      click="true"
                      data-id="<?php echo $this->creditInformations["credit_category_id"]; ?>"
                      value="<?php echo $this->creditInformations["category_name"]; ?>"
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCreditDate">Kredi Tarihi (*)</label>
                      <input value="<?php echo $this->creditInformations["credit_date"]; ?>" type="date" class="form-control" name="txtCreditDate" id="txtCreditDate" required>
                      <input type="hidden" name="txtCreditId" value="<?php echo $this->creditInformations["credit_id"]; ?>">
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCreditCashId">Kredi Kasası (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtCreditCashId"
                      table="tbl_cashes"
                      model="cash"
                      property="name"
                      click="true"
                      data-id="<?php echo $this->creditInformations["credit_cash_id"]; ?>"
                      value="<?php echo $this->creditInformations["cash_name"]; ?>"
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCreditAmount">Kredi Miktarı (*)</label>
                      <input value="<?php echo $this->creditInformations["credit_amount"]; ?>" type="number" step=".01" class="form-control" name="txtCreditAmount" id="txtCreditAmount" required>
                    </div>
                    <!-- form group -->


                    <button type="submit" class="btn btn-primary btnLoadingUpdateCredit">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>credit/credit-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/apps/accounting/credit/update-credit/update-credit.js"></script>

</body>


</html>
