<form id="frmNewSaleProduct" class="new" method="post" model="sale-product">

  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleProductName">Ürün Adı (*)</label>
    <input type="text" class="form-control" name="txtSaleProductName" id="txtSaleProductName" required>
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleProductBarcode">Ürün Barkodu (*)</label>
    <input type="text" class="form-control" name="txtSaleProductBarcode" id="txtSaleProductBarcode">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleProductPhoto">Ürün Fotoğrafı</label>
    <input type="file" class="form-control" name="txtSaleProductPhoto" id="txtSaleProductPhoto">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleProductSize">Ürün Ebatı</label>
    <input type="text" class="form-control" name="txtSaleProductSize" id="txtSaleProductSize">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleProductColor">Ürün Rengi</label>
    <input type="text" class="form-control" name="txtSaleProductColor" id="txtSaleProductColor">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleProductQuality">Ürün Kalitesi</label>
    <input type="text" class="form-control" name="txtSaleProductQuality" id="txtSaleProductQuality">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleProductStockPiece">Ürün Stok Miktarı (*)</label>
    <input type="text" class="form-control" name="txtSaleProductStockPiece" id="txtSaleProductStockPiece" required value="0">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleProductUnitPurchasePrice">Ürün Birim Alış Fiyatı (*)</label>
    <input type="number" step=".01" class="form-control" name="txtSaleProductUnitPurchasePrice" required id="txtSaleProductUnitPurchasePrice" value="0">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleProductUnitSellingPrice">Ürün Birim Satış Fiyatı (*)</label>
    <input type="number" step=".01" class="form-control" name="txtSaleProductUnitSellingPrice" required id="txtSaleProductUnitSellingPrice" value="0">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleProductPurchaseTaxId">Ürün Alış Vergisi</label>
    <select class="form-control" id="txtSaleProductPurchaseTaxId" name="txtSaleProductPurchaseTaxId">
      <?php
      for ($i=0; $i < count($this->taxes); $i++) {
        echo '<option value="'.$this->taxes[$i]["tax_id"].'">'.$this->taxes[$i]["tax_name"].' - (%'.$this->taxes[$i]["tax_percentage"].')</option>';
      }
      ?>
    </select>
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleProductSellingTaxId">Ürün Satış Vergisi</label>
    <select class="form-control" id="txtSaleProductSellingTaxId" name="txtSaleProductSellingTaxId">
      <?php
      for ($i=0; $i < count($this->taxes); $i++) {
        echo '<option value="'.$this->taxes[$i]["tax_id"].'">'.$this->taxes[$i]["tax_name"].' - (%'.$this->taxes[$i]["tax_percentage"].')</option>';
      }
      ?>
    </select>
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleProductUnitId">Ürün Birimi</label>
    <select class="form-control" id="txtSaleProductUnitId" name="txtSaleProductUnitId">
      <?php
      for ($i=0; $i < count($this->units); $i++) {
        echo '<option value="'.$this->units[$i]["unit_id"].'">'.$this->units[$i]["unit_name"].'</option>';
      }
      ?>
    </select>
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleProductCategoryId">Ürün Kategorisi</label>
    <select class="form-control" id="txtSaleProductCategoryId" name="txtSaleProductCategoryId">
      <?php
      for ($i=0; $i < count($this->categories); $i++) {
        echo '<option value="'.$this->categories[$i]["category_id"].'">'.$this->categories[$i]["category_name"].'</option>';
      }
      ?>
    </select>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="txtSaleProductStockDecrease" name="txtSaleProductStockDecrease" value="1">
      <label class="custom-control-label" for="txtSaleProductStockDecrease">Stok düşümü olacak</label>
    </div>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group div-stock-decrease-informations d-none">

    <label for="txtSaleProductStockDecreaseStockProductIds">Stok Düşüm Ürünü (*) <sup>Bu ürün satış olarak kaydedildiğinde stoğunuzda hangi ürünlerden eksilme olacağını belirtir</sup>
      <button type="button" class="btn btn-sm btn-success btnAddStockDecreaseInformationRow float-right" name="button"> <span class="fa fa-plus"></span> </button>
    </label>
    <input
    type="text"
    class="form-control input-search col-6 txtSaleProductStockDecreaseStockProductIds"
    name="txtSaleProductStockDecreaseStockProductIds[]"
    table="tbl_stock_products"
    model="stock_product"
    property="name"
    click="true"
    style="display:inline"
    placeholder="Stok ürünü arayınız"
    >
    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
    <input type="number" class="form-control col-4" name="txtSaleProductStockDecreaseStockDecreaseAmounts[]" placeholder="Stok düşüm miktarı" style="display:inline" value="">
  </div>
  <!-- form group -->



  <button type="submit" class="btn btn-primary btnLoadingNewSaleProduct">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>sale-product/sale-product-list/" class="btn btn-danger">İptal</a>
</form>
