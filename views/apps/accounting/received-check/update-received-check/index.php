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

                  <h4 class="card-title">Alınan Çekyi Düzenle</h4>
                  <p class="card-subtitle mb-4">Alınan Çeknizi düzenleyebilirsiniz.</p>

                  <form id="frmUpdateReceivedCheck" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckCustomerId">Alınan Çek Müşterisi (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtReceivedCheckCustomerId"
                      table="tbl_customers"
                      model="customer"
                      property="name"
                      click="true"
                      value="<?php echo $this->receivedCheckInformations["customer_name"]; ?>"
                      data-id="<?php echo $this->receivedCheckInformations["received_check_customer_id"]; ?>"
                      required
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckCategoryId">Alınan Çek Kategorisi (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtReceivedCheckCategoryId"
                      table="tbl_categories"
                      model="category"
                      property="name"
                      click="true"
                      value="<?php echo $this->receivedCheckInformations["category_name"]; ?>"
                      data-id="<?php echo $this->receivedCheckInformations["received_check_category_id"]; ?>"
                      required
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckMaturityDate">Alınan Çek Vade Tarihi (*)</label>
                      <input value="<?php echo $this->receivedCheckInformations["received_check_maturity_date"]; ?>" type="date" name="txtReceivedCheckMaturityDate" class="form-control" value="" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckType">Alınan Çek Tipi (*)</label>
                      <input type="hidden" name="txtReceivedCheckId" value="<?php echo $this->receivedCheckInformations["received_check_id"]; ?>">
                      <select class="form-control" name="txtReceivedCheckType" data-value="<?php echo $this->receivedCheckInformations["received_check_type"]; ?>" required>
                        <option value="0">Çek</option>
                        <option value="1">Senet</option>
                      </select>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckFileNumber">Alınan Çek Evrak No</label>
                      <input value="<?php echo $this->receivedCheckInformations["received_check_file_number"]; ?>" type="text" name="txtReceivedCheckFileNumber" class="form-control" >
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckCashId">Alınan Çek Kasası (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtReceivedCheckCashId"
                      table="tbl_cashes"
                      model="cash"
                      property="name"
                      click="true"
                      value="<?php echo $this->receivedCheckInformations["cash_name"]; ?>"
                      data-id="<?php echo $this->receivedCheckInformations["received_check_cash_id"]; ?>"
                      required
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckBankId">Alınan Çek Banka (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtReceivedCheckBankId"
                      table="tbl_banks"
                      model="bank"
                      property="name"
                      click="true"
                      value="<?php echo $this->receivedCheckInformations["bank_name"]; ?>"
                      data-id="<?php echo $this->receivedCheckInformations["received_check_bank_id"]; ?>"
                      required
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckState">Alınan Çek Durumu (*)</label>
                      <select class="form-control" name="txtReceivedCheckState" data-value="<?php echo $this->receivedCheckInformations["received_check_state"]; ?>" required>
                        <option value="1">Ödendi</option>
                        <option value="0">Ödenmedi</option>
                      </select>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckAmount">Alınan Çek Tutarı (*)</label>
                      <input value="<?php echo $this->receivedCheckInformations["received_check_amount"]; ?>" type="number" step=".01" name="txtReceivedCheckAmount" class="form-control" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckDescription">Alınan Çek Açıklama</label>
                      <input value="<?php echo $this->receivedCheckInformations["received_check_description"]; ?>" type="text" name="txtReceivedCheckDescription" class="form-control"  >
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckPhoto">Alınan Çek Görsel</label>
                      <input type="file" name="txtReceivedCheckPhoto" id="txtReceivedCheckPhoto" class="form-control" value="" >
                    </div>
                    <!-- form group -->



                    <button type="submit" class="btn btn-primary btnLoadingNewReceivedCheck">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>received-check/received-check-list/" class="btn btn-danger">İptal</a>
                  </form>

                </div> <!-- end card-body-->
              </div> <!-- end card-->



            </div>
            <div class="col-xl-6">


              <div class="card">
                <div class="card-body">

                  <h4 class="card-title">Çeki Cirola</h4>

                  <form id="frmVouchCheck" method="post">
                    <!-- form group -->
                    <input type="hidden" name="txtReceivedCheckId" value="<?php echo $this->receivedCheckInformations["received_check_id"]; ?>">
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtVouchReceivedCheckSupplierId">Tedarikçi (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtVouchReceivedCheckSupplierId"
                      table="tbl_suppliers"
                      model="supplier"
                      property="name"
                      click="true"
                      value="<?php echo $this->receivedCheckInformations["supplier_name"]; ?>"
                      data-id="<?php echo $this->receivedCheckInformations["received_check_vouch_supplier_id"]; ?>"
                      required
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                    </div>
                    <!-- form group -->



                    <button type="submit" class="btn btn-primary btnLoadingVouchCheck">Cirola</button>
                    <a href="<?php echo $this->pathHtml; ?>received-check/received-check-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/apps/accounting/received-check/update-received-check/update-received-check.js"></script>

</body>


</html>
