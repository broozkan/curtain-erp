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

                  <h4 class="card-title">Müşteri Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">Müşteriınızın bilgilerini buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdateCustomer" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCustomerName">Müşteri Adı (*)</label>
                      <input type="hidden" name="txtCustomerId" value="<?php echo $this->customerInformations["customer_id"]; ?>">
                      <input value="<?php echo $this->customerInformations["customer_name"]; ?>" type="text" class="form-control" name="txtCustomerName" id="txtCustomerName" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCustomerAddress">Müşteri Adresi</label>
                      <input value="<?php echo $this->customerInformations["customer_address"]; ?>" type="text" class="form-control" name="txtCustomerAddress" id="txtCustomerAddress" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCustomerPhoneNumber">Müşteri Telefon Numarası </label>
                      <input value="<?php echo $this->customerInformations["customer_phone_number"]; ?>" type="text" class="form-control mobile-phone-number" name="txtCustomerPhoneNumber" id="txtCustomerPhoneNumber">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCustomerEmail">Müşteri E-posta Adresi </label>
                      <input value="<?php echo $this->customerInformations["customer_email"]; ?>" type="text" class="form-control email" name="txtCustomerEmail" id="txtCustomerEmail">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCustomerTaxNumber">Müşteri Vergi Numarası </label>
                      <input value="<?php echo $this->customerInformations["customer_tax_number"]; ?>" type="number" class="form-control" name="txtCustomerTaxNumber" id="txtCustomerTaxNumber">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtCustomerTaxDepartment">Müşteri Vergi Dairesi </label>
                      <input value="<?php echo $this->customerInformations["customer_tax_department"]; ?>" type="number" class="form-control" name="txtCustomerTaxDepartment" id="txtCustomerTaxDepartment">
                    </div>
                    <!-- form group -->


                    <button type="submit" class="btn btn-primary btnLoadingUpdateCustomer">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>customer/customer-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/units/customer/update-customer/update-customer.js"></script>

</body>


</html>
