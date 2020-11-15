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

                  <h4 class="card-title">Ürün Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">Ürünınızın bilgilerini buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdateStockProduct" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtStockProductName">Ürün Adı (*)</label>
                      <input type="hidden" name="txtStockProductId" value="<?php echo $this->stockProductInformations["stock_product_id"] ?>">
                      <input value="<?php echo $this->stockProductInformations["stock_product_name"]; ?>" type="text" class="form-control" name="txtStockProductName" id="txtStockProductName" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtStockProductBarcode">Ürün Barkodu (*)</label>
                      <input value="<?php echo $this->stockProductInformations["stock_product_barcode"]; ?>" type="text" class="form-control" name="txtStockProductBarcode" id="txtStockProductBarcode">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtStockProductSize">Ürün Ebatı (*)</label>
                      <input value="<?php echo $this->stockProductInformations["stock_product_size"]; ?>" type="text" class="form-control" name="txtStockProductSize" id="txtStockProductSize">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtStockProductColor">Ürün Rengi (*)</label>
                      <input value="<?php echo $this->stockProductInformations["stock_product_color"]; ?>" type="text" class="form-control" name="txtStockProductColor" id="txtStockProductColor">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtStockProductQuality">Ürün Kalitesi (*)</label>
                      <input value="<?php echo $this->stockProductInformations["stock_product_quality"]; ?>" type="text" class="form-control" name="txtStockProductQuality" id="txtStockProductQuality">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtStockProductStockPiece">Ürün Stok Miktarı (*)</label>
                      <input value="<?php echo $this->stockProductInformations["stock_product_stock_piece"]; ?>" type="text" class="form-control" name="txtStockProductStockPiece" id="txtStockProductStockPiece">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtStockProductUnitPurchasePrice">Ürün Birim Alış Fiyatı (*)</label>
                      <input value="<?php echo $this->stockProductInformations["stock_product_unit_purchase_price"]; ?>" type="number" step=".01" class="form-control" name="txtStockProductUnitPurchasePrice" id="txtStockProductUnitPurchasePrice">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtStockProductUnitSellingPrice">Ürün Birim Satış Fiyatı (*)</label>
                      <input value="<?php echo $this->stockProductInformations["stock_product_unit_selling_price"]; ?>" type="number" step=".01" class="form-control" name="txtStockProductUnitSellingPrice" id="txtStockProductUnitSellingPrice">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtStockProductPurchaseTaxId">Ürün Alış Vergisi (*)</label>
                      <select data-id="<?php echo $this->stockProductInformations["stock_product_purchase_tax_id"]; ?>" class="form-control" id="txtStockProductPurchaseTaxId" name="txtStockProductPurchaseTaxId">
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
                      <label for="txtStockProductSellingTaxId">Ürün Satış Vergisi (*)</label>
                      <select data-id="<?php echo $this->stockProductInformations["stock_product_selling_tax_id"]; ?>" class="form-control" id="txtStockProductSellingTaxId" name="txtStockProductSellingTaxId">
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
                      <label for="txtStockProductUnitId">Ürün Birimi (*)</label>
                      <select data-id="<?php echo $this->stockProductInformations["stock_product_unit_id"]; ?>" class="form-control" id="txtStockProductUnitId" name="txtStockProductUnitId">
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
                      <label for="txtStockProductCategoryId">Ürün Kategorisi (*)</label>
                      <select data-id="<?php echo $this->stockProductInformations["stock_product_category_id"]; ?>" class="form-control" id="txtStockProductCategoryId" name="txtStockProductCategoryId">
                        <?php
                        for ($i=0; $i < count($this->categories); $i++) {
                          echo '<option value="'.$this->categories[$i]["category_id"].'">'.$this->categories[$i]["category_name"].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <!-- form group -->

                    <button type="submit" class="btn btn-primary btnLoadingUpdateStockProduct">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>sale-product/sale-product-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/units/sale-product/update-sale-product/update-sale-product.js"></script>

</body>


</html>
