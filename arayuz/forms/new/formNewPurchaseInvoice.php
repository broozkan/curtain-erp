<form id="frmNewPurchaseInvoice" method="post">

  <!-- form group -->
  <div class="form-group">
    <label for="txtPurchaseInvoiceSupplierId">Alış Faturası Tedarikçisi (*)</label>
    <input
    type="text"
    class="form-control input-search"
    name="txtPurchaseInvoiceSupplierId"
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
    <label for="txtPurchaseInvoiceCategoryId">Alış Faturası Kategorisi (*)</label>
    <input
    type="text"
    class="form-control input-search"
    name="txtPurchaseInvoiceCategoryId"
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
    <label for="txtPurchaseInvoiceMaturityDate">Alış Faturası Vade Tarihi (*)</label>
    <input type="date" name="txtPurchaseInvoiceMaturityDate" class="form-control" value="" required>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtPurchaseInvoiceCashId">Alış Faturası Kasası <sup>Eğer boş bırakırsanız mali değeri olmayan bir fatura kaydolur</sup> </label>
    <select class="form-control" name="txtPurchaseInvoiceCashId" id="txtPurchaseInvoiceCashId">
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
    <label for="txtPurchaseInvoiceNote">Alış Faturası Açıklama</label>
    <input type="text" name="txtPurchaseInvoiceNote" class="form-control" value="" >
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtPurchaseInvoicePhoto">Alış Faturası Görsel</label>
    <input type="file" name="txtPurchaseInvoicePhoto" id="txtPurchaseInvoicePhoto" class="form-control" value="" >
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" checked class="custom-control-input" name="txtPurchaseInvoiceStockAddition" value="1" id="txtPurchaseInvoiceStockAddition">
      <label class="custom-control-label" for="txtPurchaseInvoiceStockAddition">Stoklara işlensin</label>
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
        <tr>
          <td><button type="button" class="btn btn-danger btn-sm btnDeleteRow" name="button"> <span class="fa fa-minus"></span> </button> </td>
          <td>

            <div class="form-group">
              <input
              type="text"
              class="form-control form-control-sm input-search txtPurchaseInvoiceProductId"
              name="txtPurchaseInvoiceItemProductId[]"
              table="tbl_stock_products"
              model="stock_product"
              property="name"
              click="true"
              value=""
              required
              >
              <button type="button" class="btn btn-xs btn-default btnInsideInput btnNewStockProduct" data-toggle="modal" data-target="#modalNewStockProduct" name="button"> <span class="fa fa-plus"></span> </button>
              <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <select class="form-control form-control-sm txtPurchaseInvoiceItemUnitId" name="txtPurchaseInvoiceItemUnitId[]">
                <option value="" disabled selected>-Seçiniz-</option>
                <?php
                for ($i=0; $i < count($this->units); $i++) {
                  echo '<option value="'.$this->units[$i]["unit_id"].'">'.$this->units[$i]["unit_name"].'</option>';
                }
                ?>
              </select>
              <button type="button" class="btn btn-xs btn-default btnInsideInput btnNewStockProduct" data-toggle="modal" data-target="#modalNewUnit" name="button"> <span class="fa fa-plus"></span> </button>
              <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
            </div>
          </td>
          <td><input type="text" class="form-control form-control-sm txtPurchaseInvoiceItemPiece" name="txtPurchaseInvoiceItemPiece[]" value=""> </td>
          <td><input type="text" class="form-control form-control-sm txtPurchaseInvoiceItemPurchasePrice" name="txtPurchaseInvoiceItemPurchasePrice[]" value=""> </td>
          <td>
            <div class="form-group">
              <select class="form-control form-control-sm txtPurchaseInvoiceItemTaxId" name="txtPurchaseInvoiceItemTaxId[]">
                <option value="" disabled selected>-Seçiniz-</option>
                <?php
                for ($i=0; $i < count($this->taxes); $i++) {
                  echo '<option value="'.$this->taxes[$i]["tax_id"].'" tax_percentage="'.$this->taxes[$i]["tax_percentage"].'" >'.$this->taxes[$i]["tax_name"].'</option>';
                }
                ?>
              </select>
              <button type="button" class="btn btn-xs btn-default btnInsideInput btnNewTax" data-toggle="modal" data-target="#modalNewTax" name="button"> <span class="fa fa-plus"></span> </button>
              <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
            </div>
          </td>
          <td><span class="lead spanRowTotal">0.00 ₺</span> </td>
        </tr>

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

  <button type="submit" class="btn btn-primary btnLoadingNewPurchaseInvoice">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>purchase-invoice/purchase-invoice-list/" class="btn btn-danger">İptal</a>
</form>
