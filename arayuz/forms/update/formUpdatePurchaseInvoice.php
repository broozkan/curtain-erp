<form id="frmUpdatePurchaseInvoice" method="post">

  <!-- form group -->
  <div class="form-group">
    <input type="hidden" name="txtUpdatePurchaseInvoiceId" class="txtUpdatePurchaseInvoiceId" value="<?php echo $this->purchaseInvoiceId; ?>">
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtUpdatePurchaseInvoiceSupplierId">Alış Faturası Tedarikçisi (*)</label>
    <input
    type="text"
    class="form-control input-search txtUpdatePurchaseInvoiceSupplierId"
    name="txtUpdatePurchaseInvoiceSupplierId"
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
    <label for="txtUpdatePurchaseInvoiceCategoryId">Alış Faturası Kategorisi (*)</label>
    <input
    type="text"
    class="form-control input-search txtUpdatePurchaseInvoiceCategoryId"
    name="txtUpdatePurchaseInvoiceCategoryId"
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
    <label for="txtUpdatePurchaseInvoiceMaturityDate">Alış Faturası Vade Tarihi (*)</label>
    <input type="date" name="txtUpdatePurchaseInvoiceMaturityDate" class="form-control txtUpdatePurchaseInvoiceMaturityDate" value="" required>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtUpdatePurchaseInvoiceCashId">Alış Faturası Kasası <sup>Eğer boş bırakırsanız mali değeri olmayan bir fatura kaydolur</sup> </label>
    <select class="form-control txtUpdatePurchaseInvoiceCashId" name="txtUpdatePurchaseInvoiceCashId" id="txtUpdatePurchaseInvoiceCashId">
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
    <label for="txtUpdatePurchaseInvoiceNote">Alış Faturası Açıklama</label>
    <input type="text" name="txtUpdatePurchaseInvoiceNote" class="form-control txtUpdatePurchaseInvoiceNote" value="" >
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtUpdatePurchaseInvoicePhoto">Alış Faturası Görsel</label>
    <input type="file" name="txtUpdatePurchaseInvoicePhoto" id="txtUpdatePurchaseInvoicePhoto" class="form-control txtUpdatePurchaseInvoicePhoto" value="" >
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input txtUpdatePurchaseInvoiceStockAddition" name="txtUpdatePurchaseInvoiceStockAddition" value="1" id="txtUpdatePurchaseInvoiceStockAddition">
      <label class="custom-control-label" for="txtUpdatePurchaseInvoiceStockAddition">Stoklara işlensin</label>
    </div>
  </div>
  <!-- form group -->

  <hr>

  <div class="table-responsive">
    <table class="table tbl-purchase-invoice-products">
      <thead>
        <tr>
          <th><button type="button" class="btn btn-success btn-sm btnAddRow" name="button"> <span class="fa fa-plus"></span> </button></th>
          <th>Ürün</th>
          <th>Birim </th>
          <th>Miktar</th>
          <th>Alış Fiyat</th>
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

  <button type="submit" class="btn btn-primary btnLoadingUpdatePurchaseInvoice">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>purchase-invoice/purchase-invoice-list/" class="btn btn-danger">İptal</a>
</form>
