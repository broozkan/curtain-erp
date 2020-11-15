<form id="frmNewPayment" class="new" method="post" model="payment">

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
    value=""
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
    value=""
    >
    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtPaymentDate">Ödeme Tarihi (*)</label>
    <input type="date" class="form-control" name="txtPaymentDate" id="txtPaymentDate" required>
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
    value=""
    >
    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtPaymentAmount">Ödeme Miktarı (*)</label>
    <input type="number" step=".01" class="form-control" name="txtPaymentAmount" id="txtPaymentAmount" required>
  </div>
  <!-- form group -->


  <!-- form group -->
  <div class="form-group">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" name="txtIsPaymentRepeat" id="txtIsPaymentRepeat" value="1">
      <label class="custom-control-label" for="txtIsPaymentRepeat">Ödeme Otomatik Tekrarlansın</label>
    </div>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group div-payment-repeat d-none">
    <label for="txtPaymentRepeatPeriod">Ödeme Tekrar Periyodu</label>
    <select class="form-control" name="txtPaymentRepeatPeriod">
      <option value="0">Her Ay</option>
      <option value="1">Her Yıl</option>
    </select>
  </div>
  <!-- form group -->

  <button type="submit" class="btn btn-primary btnLoadingNewPayment">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>payment/payment-list/" class="btn btn-danger">İptal</a>
</form>
