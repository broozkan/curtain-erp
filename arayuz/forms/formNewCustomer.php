<form id="frmNewCustomer" class="new" method="post" model="customer">

  <!-- form group -->
  <div class="form-group">
    <label for="txtCustomerName">Müşteri Adı (*)</label>
    <input type="text" class="form-control" name="txtCustomerName" id="txtCustomerName" required>
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtCustomerAddress">Müşteri Adresi</label>
    <input type="text" class="form-control" name="txtCustomerAddress" id="txtCustomerAddress" required>
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtCustomerPhoneNumber">Müşteri Telefon Numarası </label>
    <input type="text" class="form-control mobile-phone-number" name="txtCustomerPhoneNumber" id="txtCustomerPhoneNumber">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtCustomerEmail">Müşteri E-posta Adresi </label>
    <input type="text" class="form-control email" name="txtCustomerEmail" id="txtCustomerEmail">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtCustomerTaxNumber">Müşteri Vergi Numarası </label>
    <input type="number" class="form-control" name="txtCustomerTaxNumber" id="txtCustomerTaxNumber">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtCustomerTaxDepartment">Müşteri Vergi Dairesi </label>
    <input type="number" class="form-control" name="txtCustomerTaxDepartment" id="txtCustomerTaxDepartment">
  </div>
  <!-- form group -->


  <button type="submit" class="btn btn-primary btnLoadingNewCustomer">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>customer/customer-list/" class="btn btn-danger">İptal</a>
</form>
