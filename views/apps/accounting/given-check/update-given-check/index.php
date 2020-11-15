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

                  <h4 class="card-title">Verilen Çekyi Düzenle</h4>
                  <p class="card-subtitle mb-4">Verilen Çeknizi düzenleyebilirsiniz.</p>

                  <form id="frmUpdateGivenCheck" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtGivenCheckSupplierId">Verilen Çek Tedarikçisi (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtGivenCheckSupplierId"
                      table="tbl_suppliers"
                      model="supplier"
                      property="name"
                      click="true"
                      value="<?php echo $this->givenCheckInformations["supplier_name"]; ?>"
                      data-id="<?php echo $this->givenCheckInformations["given_check_supplier_id"]; ?>"
                      required
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtGivenCheckCategoryId">Verilen Çek Kategorisi (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtGivenCheckCategoryId"
                      table="tbl_categories"
                      model="category"
                      property="name"
                      click="true"
                      value="<?php echo $this->givenCheckInformations["category_name"]; ?>"
                      data-id="<?php echo $this->givenCheckInformations["given_check_category_id"]; ?>"
                      required
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtGivenCheckMaturityDate">Verilen Çek Vade Tarihi (*)</label>
                      <input value="<?php echo $this->givenCheckInformations["given_check_maturity_date"]; ?>" type="date" name="txtGivenCheckMaturityDate" class="form-control" value="" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtGivenCheckType">Verilen Çek Tipi (*)</label>
                      <input type="hidden" name="txtGivenCheckId" value="<?php echo $this->givenCheckInformations["given_check_id"]; ?>">
                      <select class="form-control" name="txtGivenCheckType" data-value="<?php echo $this->givenCheckInformations["given_check_type"]; ?>" required>
                        <option value="0">Çek</option>
                        <option value="1">Senet</option>
                      </select>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtGivenCheckFileNumber">Verilen Çek Evrak No</label>
                      <input value="<?php echo $this->givenCheckInformations["given_check_file_number"]; ?>" type="text" name="txtGivenCheckFileNumber" class="form-control" >
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtGivenCheckCashId">Verilen Çek Kasası (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtGivenCheckCashId"
                      table="tbl_cashes"
                      model="cash"
                      property="name"
                      click="true"
                      value="<?php echo $this->givenCheckInformations["cash_name"]; ?>"
                      data-id="<?php echo $this->givenCheckInformations["given_check_cash_id"]; ?>"
                      required
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtGivenCheckBankId">Verilen Çek Banka (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtGivenCheckBankId"
                      table="tbl_banks"
                      model="bank"
                      property="name"
                      click="true"
                      value="<?php echo $this->givenCheckInformations["bank_name"]; ?>"
                      data-id="<?php echo $this->givenCheckInformations["given_check_bank_id"]; ?>"
                      required
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtGivenCheckState">Verilen Çek Durumu (*)</label>
                      <select class="form-control" name="txtGivenCheckState" data-value="<?php echo $this->givenCheckInformations["given_check_state"]; ?>" required>
                        <option value="1">Ödendi</option>
                        <option value="0">Ödenmedi</option>
                      </select>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtGivenCheckAmount">Verilen Çek Tutarı (*)</label>
                      <input value="<?php echo $this->givenCheckInformations["given_check_amount"]; ?>" type="number" step=".01" name="txtGivenCheckAmount" class="form-control" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtGivenCheckDescription">Verilen Çek Açıklama</label>
                      <input value="<?php echo $this->givenCheckInformations["given_check_description"]; ?>" type="text" name="txtGivenCheckDescription" class="form-control"  >
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtGivenCheckPhoto">Verilen Çek Görsel</label>
                      <input type="file" name="txtGivenCheckPhoto" id="txtGivenCheckPhoto" class="form-control" value="" >
                    </div>
                    <!-- form group -->



                    <button type="submit" class="btn btn-primary btnLoadingNewGivenCheck">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>given-check/given-check-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/apps/accounting/given-check/update-given-check/update-given-check.js"></script>

</body>


</html>
