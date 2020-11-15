<form id="frmNewStockProduct" class="new" method="post" model="stock-product">

  <!-- form group -->
  <div class="form-group">
    <label for="txtStockProductName">Ürün Adı (*)</label>
    <input type="text" class="form-control" name="txtStockProductName" id="txtStockProductName" required>
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtStockProductBarcode">Ürün Barkodu (*)</label>
    <input type="text" class="form-control" name="txtStockProductBarcode" id="txtStockProductBarcode">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtStockProductPhoto">Ürün Fotoğrafı</label>
    <input type="file" class="form-control" name="txtStockProductPhoto" id="txtStockProductPhoto">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtStockProductSize">Ürün Ebatı</label>
    <input type="text" class="form-control" name="txtStockProductSize" id="txtStockProductSize">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtStockProductColor">Ürün Rengi</label>
    <input type="text" class="form-control" name="txtStockProductColor" id="txtStockProductColor">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtStockProductQuality">Ürün Kalitesi</label>
    <input type="text" class="form-control" name="txtStockProductQuality" id="txtStockProductQuality">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtStockProductStockPiece">Ürün Stok Miktarı</label>
    <input type="text" class="form-control" name="txtStockProductStockPiece" id="txtStockProductStockPiece" value="0">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtStockProductStoreId">Stok Ürün Deposu (*)</label>
    <input
    type="text"
    class="form-control input-search"
    name="txtStockProductStoreId"
    table="tbl_stores"
    model="store"
    property="name"
    click="true"
    value=""
    >
    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtStockProductUnitPurchasePrice">Ürün Birim Alış Fiyatı</label>
    <input type="number" step=".01" class="form-control" name="txtStockProductUnitPurchasePrice" id="txtStockProductUnitPurchasePrice" value="0">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtStockProductUnitSellingPrice">Ürün Birim Satış Fiyatı</label>
    <input type="number" step=".01" class="form-control" name="txtStockProductUnitSellingPrice" id="txtStockProductUnitSellingPrice" value="0">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtStockProductPurchaseTaxId">Ürün Alış Vergisi</label>
    <select class="form-control" id="txtStockProductPurchaseTaxId" name="txtStockProductPurchaseTaxId">
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
    <label for="txtStockProductSellingTaxId">Ürün Satış Vergisi</label>
    <select class="form-control" id="txtStockProductSellingTaxId" name="txtStockProductSellingTaxId">
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
    <label for="txtStockProductUnitId">Ürün Birimi</label>
    <select class="form-control" id="txtStockProductUnitId" name="txtStockProductUnitId">
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
    <label for="txtStockProductCategoryId">Ürün Kategorisi</label>
    <select class="form-control" id="txtStockProductCategoryId" name="txtStockProductCategoryId">
      <?php
      for ($i=0; $i < count($this->categories); $i++) {
        echo '<option value="'.$this->categories[$i]["category_id"].'">'.$this->categories[$i]["category_name"].'</option>';
      }
      ?>
    </select>
  </div>
  <!-- form group -->



  <button type="submit" class="btn btn-primary btnLoadingNewStockProduct">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>stock-product/stock-product-list/" class="btn btn-danger">İptal</a>
</form>
