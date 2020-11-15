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

                  <h4 class="card-title">Tahsilatyi Düzenle</h4>
                  <p class="card-subtitle mb-4">Tahsilatnizi düzenleyebilirsiniz.</p>

                  <form id="frmUpdateCollection" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCollectionCustomerId">Tahsilat Tedarikçisi (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtCollectionCustomerId"
                      table="tbl_customers"
                      model="customer"
                      property="name"
                      click="true"
                      data-id="<?php echo $this->collectionInformations["collection_customer_id"]; ?>"
                      value="<?php echo $this->collectionInformations["customer_name"]; ?>"
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCollectionCategoryId">Tahsilat Kategorisi (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtCollectionCategoryId"
                      table="tbl_categories"
                      model="category"
                      property="name"
                      click="true"
                      data-id="<?php echo $this->collectionInformations["collection_category_id"]; ?>"
                      value="<?php echo $this->collectionInformations["category_name"]; ?>"
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCollectionDate">Tahsilat Tarihi (*)</label>
                      <input value="<?php echo $this->collectionInformations["collection_date"]; ?>" type="date" class="form-control" name="txtCollectionDate" id="txtCollectionDate" required>
                      <input type="hidden" name="txtCollectionId" value="<?php echo $this->collectionInformations["collection_id"]; ?>">
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCollectionCashId">Tahsilat Kasası (*)</label>
                      <input
                      type="text"
                      class="form-control input-search"
                      name="txtCollectionCashId"
                      table="tbl_cashes"
                      model="cash"
                      property="name"
                      click="true"
                      data-id="<?php echo $this->collectionInformations["collection_cash_id"]; ?>"
                      value="<?php echo $this->collectionInformations["cash_name"]; ?>"
                      >
                      <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCollectionAmount">Tahsilat Miktarı (*)</label>
                      <input value="<?php echo $this->collectionInformations["collection_amount"]; ?>" type="number" step=".01" class="form-control" name="txtCollectionAmount" id="txtCollectionAmount" required>
                    </div>
                    <!-- form group -->


                    <button type="submit" class="btn btn-primary btnLoadingUpdateCollection">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>collection/collection-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/apps/accounting/collection/update-collection/update-collection.js"></script>

</body>


</html>
