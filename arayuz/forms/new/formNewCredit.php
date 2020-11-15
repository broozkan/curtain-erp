<form id="frmNewCredit" class="new" method="post" model="credit">

  <!-- form group -->
  <div class="form-group">
    <label for="txtCreditBankId">Kredi Bankası (*)</label>
    <input
    type="text"
    class="form-control input-search"
    name="txtCreditBankId"
    table="tbl_banks"
    model="bank"
    property="name"
    click="true"
    required
    >
    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

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
    required
    >
    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtCreditAmount">Kredi Tutarı (*)</label>
    <input type="number" class="form-control" step=".01" name="txtCreditAmount" id="txtCreditAmount" required>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtCreditInstallmentCount">Kredi Taksit Sayısı (*)</label>
    <input type="number" class="form-control" name="txtCreditInstallmentCount" id="txtCreditInstallmentCount" required>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtCreditInstallmentBeginningDate">Kredi Taksit Başlangıç Tarihi (*)</label>
    <input type="date" class="form-control" name="txtCreditInstallmentBeginningDate" id="txtCreditInstallmentBeginningDate" required>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtCreditInstallmentPeriod">Kredi Taksit Periyodu</label>
    <select class="form-control" name="txtCreditInstallmentPeriod" id="txtCreditInstallmentPeriod">
      <option value="" disabled selected>-Seçiniz-</option>
      <option value="0">Aylık</option>
      <option value="1">Yıllık</option>
    </select>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtCreditNote">Kredi Notu</label>
    <input type="text" class="form-control" name="txtCreditNote" id="txtCreditNote">
  </div>
  <!-- form group -->


  <button type="submit" class="btn btn-primary btnLoadingNewCredit">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>credit/credit-list/" class="btn btn-danger">İptal</a>
</form>
