<form id="frmSendEmailToCustomer" method="post" model="tax">

  <!-- form group -->
  <div class="form-group">
    <label for="txtEmailCustomerId">Müşteri (*)</label>
    <input
    type="text"
    class="form-control input-search"
    name="txtEmailCustomerId[]"
    table="tbl_customers"
    model="customer"
    property="name"
    click="true"
    required
    >
    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtEmailContent">E-Posta İçeriği</label>
    <textarea name="txtEmailContent" id="txtEmailContent" class="form-control" rows="8" cols="80"></textarea>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" checked class="custom-control-input" id="txtEmailSendSaleFile">
      <label class="custom-control-label" for="txtEmailSendSaleFile">Satış bilgileri dosyası gönderilsin</label>
    </div>
  </div>
  <!-- form group -->


  <button type="submit" class="btn btn-primary btnLoadingEmail">Gönder</button>
  <a href="<?php echo $this->pathHtml; ?>tax/tax-list/" class="btn btn-danger">İptal</a>
</form>
