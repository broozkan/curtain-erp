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

                  <h4 class="card-title">Yeni Alınan Çek Ekle</h4>
                  <p class="card-subtitle mb-4">Alınan çekinizi buradan ekleyebilirsiniz</p>

                  <form id="frmNewReceivedCheck" method="post">

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
                      value=""
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
                      value=""
                      required
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckMaturityDate">Alınan Çek Vade Tarihi (*)</label>
                      <input type="date" name="txtReceivedCheckMaturityDate" class="form-control" value="" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckType">Alınan Çek Tipi (*)</label>
                      <select class="form-control" name="txtReceivedCheckType" required>
                        <option value="0">Çek</option>
                        <option value="1">Senet</option>
                      </select>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckFileNumber">Alınan Çek Evrak No</label>
                      <input type="text" name="txtReceivedCheckFileNumber" class="form-control" value="" >
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
                      value=""
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
                      value=""
                      required
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckState">Alınan Çek Durumu (*)</label>
                      <select class="form-control" name="txtReceivedCheckState" required>
                        <option value="1">Ödendi</option>
                        <option value="0">Ödenmedi</option>
                      </select>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckAmount">Alınan Çek Tutarı (*)</label>
                      <input type="number" step=".01" name="txtReceivedCheckAmount" class="form-control" value="" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtReceivedCheckDescription">Alınan Çek Açıklama</label>
                      <input type="text" name="txtReceivedCheckDescription" class="form-control" value="" >
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
  <script src="<?php echo $this->pathHtml; ?>views/apps/accounting/received-check/new-received-check/new-received-check.js"></script>

</body>


</html>
