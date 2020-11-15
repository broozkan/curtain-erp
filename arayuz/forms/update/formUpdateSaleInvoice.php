<form id="frmUpdateSaleInvoice" method="post">

  <!-- form group -->
  <div class="form-group">
    <input type="hidden" name="txtUpdateSaleInvoiceId" class="txtUpdateSaleInvoiceId" value="<?php echo $this->saleInvoiceId; ?>">
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtUpdateSaleInvoiceCustomerId">Satış Faturası Müşterisi (*)</label>
    <input
    type="text"
    class="form-control input-search txtUpdateSaleInvoiceCustomerId"
    name="txtUpdateSaleInvoiceCustomerId"
    table="tbl_suppliers"
    model="supplier"
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
    <label for="txtUpdateSaleInvoiceCategoryId">Satış Faturası Kategorisi (*)</label>
    <input
    type="text"
    class="form-control input-search txtUpdateSaleInvoiceCategoryId"
    name="txtUpdateSaleInvoiceCategoryId"
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
    <label for="txtUpdateSaleInvoiceMaturityDate">Satış Faturası Vade Tarihi (*)</label>
    <input type="date" name="txtUpdateSaleInvoiceMaturityDate" class="form-control txtUpdateSaleInvoiceMaturityDate" value="" required>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtUpdateSaleInvoiceCashId">Satış Faturası Kasası <sup>Eğer boş bırakırsanız mali değeri olmayan bir fatura kaydolur</sup> </label>
    <select class="form-control txtUpdateSaleInvoiceCashId" name="txtUpdateSaleInvoiceCashId" id="txtUpdateSaleInvoiceCashId">
      <option value="" selected>-MALİ DEĞERİ OLMAYACAK-</option>
      <?php
        for ($i=0; $i < count($this->cashes); $i++) {
          echo '<option value="'.$this->cashes[$i]["cash_id"].'" >'.$this->cashes[$i]["cash_name"].'</option>';
        }
      ?>
    </select>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtUpdateSaleInvoiceNote">Satış Faturası Açıklama</label>
    <input type="text" name="txtUpdateSaleInvoiceNote" class="form-control txtUpdateSaleInvoiceNote" value="" >
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtUpdateSaleInvoicePhoto">Satış Faturası Görsel</label>
    <input type="file" name="txtUpdateSaleInvoicePhoto" id="txtUpdateSaleInvoicePhoto" class="form-control txtUpdateSaleInvoicePhoto" value="" >
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input txtUpdateSaleInvoiceStockAddition" name="txtUpdateSaleInvoiceStockAddition" value="1" id="txtUpdateSaleInvoiceStockAddition">
      <label class="custom-control-label" for="txtUpdateSaleInvoiceStockAddition">Stoklara işlensin</label>
    </div>
  </div>
  <!-- form group -->

  <hr>

  <div class="table-responsive">
    <table class="table tbl-sale-invoice-products">
      <thead>
        <tr>
          <th><button type="button" class="btn btn-success btn-sm btnAddRow" name="button"> <span class="fa fa-plus"></span> </button></th>
          <th>Ürün</th>
          <th>Birim </th>
          <th>Miktar</th>
          <th>Satış Fiyat</th>
          <th>Vergi</th>
          <th>Ara Tutar</th>
        </tr>
      </thead>
      <tbody>


      </tbody>
      <tfoot>
        <tr class="trSubTotal">
          <td colspan="6" class="text-right" >Ara Toplam : </td>
          <td class="text-right"><span class="spanSubTotal">00.00</span> ₺ </td>
        </tr>
        <tr class="trTotal">
          <td colspan="6" class="text-right">Toplam : </td>
          <td class="text-right"><span class="spanTotal">00.00</span> ₺ </td>
        </tr>
      </tfoot>
    </table>
  </div>

  <button type="submit" class="btn btn-primary btnLoadingUpdateSaleInvoice">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>sale-invoice/sale-invoice-list/" class="btn btn-danger">İptal</a>
</form>
