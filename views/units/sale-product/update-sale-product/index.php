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

                  <form id="frmUpdateSaleProduct" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSaleProductName">Ürün Adı (*)</label>
                      <input type="hidden" name="txtSaleProductId" value="<?php echo $this->saleProductInformations["sale_product_id"] ?>">
                      <input value="<?php echo $this->saleProductInformations["sale_product_name"]; ?>" type="text" class="form-control" name="txtSaleProductName" id="txtSaleProductName" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSaleProductBarcode">Ürün Barkodu (*)</label>
                      <input value="<?php echo $this->saleProductInformations["sale_product_barcode"]; ?>" type="text" class="form-control" name="txtSaleProductBarcode" id="txtSaleProductBarcode">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSaleProductSize">Ürün Ebatı (*)</label>
                      <input value="<?php echo $this->saleProductInformations["sale_product_size"]; ?>" type="text" class="form-control" name="txtSaleProductSize" id="txtSaleProductSize">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSaleProductColor">Ürün Rengi (*)</label>
                      <input value="<?php echo $this->saleProductInformations["sale_product_color"]; ?>" type="text" class="form-control" name="txtSaleProductColor" id="txtSaleProductColor">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSaleProductQuality">Ürün Kalitesi (*)</label>
                      <input value="<?php echo $this->saleProductInformations["sale_product_quality"]; ?>" type="text" class="form-control" name="txtSaleProductQuality" id="txtSaleProductQuality">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSaleProductStockPiece">Ürün Stok Miktarı (*)</label>
                      <input value="<?php echo $this->saleProductInformations["sale_product_stock_piece"]; ?>" type="text" class="form-control" name="txtSaleProductStockPiece" id="txtSaleProductStockPiece">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSaleProductUnitPurchasePrice">Ürün Birim Alış Fiyatı (*)</label>
                      <input value="<?php echo $this->saleProductInformations["sale_product_unit_purchase_price"]; ?>" type="number" step=".01" class="form-control" name="txtSaleProductUnitPurchasePrice" id="txtSaleProductUnitPurchasePrice">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSaleProductUnitSellingPrice">Ürün Birim Satış Fiyatı (*)</label>
                      <input value="<?php echo $this->saleProductInformations["sale_product_unit_selling_price"]; ?>" type="number" step=".01" class="form-control" name="txtSaleProductUnitSellingPrice" id="txtSaleProductUnitSellingPrice">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtSaleProductPurchaseTaxId">Ürün Alış Vergisi (*)</label>
                      <select data-id="<?php echo $this->saleProductInformations["sale_product_purchase_tax_id"]; ?>" class="form-control" id="txtSaleProductPurchaseTaxId" name="txtSaleProductPurchaseTaxId">
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
                      <label for="txtSaleProductSellingTaxId">Ürün Satış Vergisi (*)</label>
                      <select data-id="<?php echo $this->saleProductInformations["sale_product_selling_tax_id"]; ?>" class="form-control" id="txtSaleProductSellingTaxId" name="txtSaleProductSellingTaxId">
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
                      <label for="txtSaleProductUnitId">Ürün Birimi (*)</label>
                      <select data-id="<?php echo $this->saleProductInformations["sale_product_unit_id"]; ?>" class="form-control" id="txtSaleProductUnitId" name="txtSaleProductUnitId">
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
                      <label for="txtSaleProductCategoryId">Ürün Kategorisi (*)</label>
                      <select data-id="<?php echo $this->saleProductInformations["sale_product_category_id"]; ?>" class="form-control" id="txtSaleProductCategoryId" name="txtSaleProductCategoryId">
                        <?php
                        for ($i=0; $i < count($this->categories); $i++) {
                          echo '<option value="'.$this->categories[$i]["category_id"].'">'.$this->categories[$i]["category_name"].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <!-- form group -->

                    <button type="submit" class="btn btn-primary btnLoadingUpdateSaleProduct">Kaydet</button>
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
