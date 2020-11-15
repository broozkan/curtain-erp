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

                  <h4 class="card-title">Ödeme Metodu Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">Ödeme Metoduınızın bilgilerini buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdatePaymentMethod" method="post">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentMethodName">Ödeme Metodu Adı (*)</label>
                      <input type="hidden" name="txtPaymentMethodId" value="<?php echo $this->saleProductInformations["payment_method_id"] ?>">
                      <input value="<?php echo $this->saleProductInformations["payment_method_name"]; ?>" type="text" class="form-control" name="txtPaymentMethodName" id="txtPaymentMethodName" required>
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentMethodBarcode">Ödeme Metodu Barkodu (*)</label>
                      <input value="<?php echo $this->saleProductInformations["payment_method_barcode"]; ?>" type="text" class="form-control" name="txtPaymentMethodBarcode" id="txtPaymentMethodBarcode">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentMethodSize">Ödeme Metodu Ebatı (*)</label>
                      <input value="<?php echo $this->saleProductInformations["payment_method_size"]; ?>" type="text" class="form-control" name="txtPaymentMethodSize" id="txtPaymentMethodSize">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentMethodColor">Ödeme Metodu Rengi (*)</label>
                      <input value="<?php echo $this->saleProductInformations["payment_method_color"]; ?>" type="text" class="form-control" name="txtPaymentMethodColor" id="txtPaymentMethodColor">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentMethodQuality">Ödeme Metodu Kalitesi (*)</label>
                      <input value="<?php echo $this->saleProductInformations["payment_method_quality"]; ?>" type="text" class="form-control" name="txtPaymentMethodQuality" id="txtPaymentMethodQuality">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentMethodStockPiece">Ödeme Metodu Stok Miktarı (*)</label>
                      <input value="<?php echo $this->saleProductInformations["payment_method_stock_piece"]; ?>" type="text" class="form-control" name="txtPaymentMethodStockPiece" id="txtPaymentMethodStockPiece">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentMethodUnitPurchasePrice">Ödeme Metodu Birim Alış Fiyatı (*)</label>
                      <input value="<?php echo $this->saleProductInformations["payment_method_unit_purchase_price"]; ?>" type="number" step=".01" class="form-control" name="txtPaymentMethodUnitPurchasePrice" id="txtPaymentMethodUnitPurchasePrice">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentMethodUnitSellingPrice">Ödeme Metodu Birim Satış Fiyatı (*)</label>
                      <input value="<?php echo $this->saleProductInformations["payment_method_unit_selling_price"]; ?>" type="number" step=".01" class="form-control" name="txtPaymentMethodUnitSellingPrice" id="txtPaymentMethodUnitSellingPrice">
                    </div>
                    <!-- form group -->
                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtPaymentMethodPurchaseTaxId">Ödeme Metodu Alış Vergisi (*)</label>
                      <select data-id="<?php echo $this->saleProductInformations["payment_method_purchase_tax_id"]; ?>" class="form-control" id="txtPaymentMethodPurchaseTaxId" name="txtPaymentMethodPurchaseTaxId">
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
                      <label for="txtPaymentMethodSellingTaxId">Ödeme Metodu Satış Vergisi (*)</label>
                      <select data-id="<?php echo $this->saleProductInformations["payment_method_selling_tax_id"]; ?>" class="form-control" id="txtPaymentMethodSellingTaxId" name="txtPaymentMethodSellingTaxId">
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
                      <label for="txtPaymentMethodUnitId">Ödeme Metodu Birimi (*)</label>
                      <select data-id="<?php echo $this->saleProductInformations["payment_method_unit_id"]; ?>" class="form-control" id="txtPaymentMethodUnitId" name="txtPaymentMethodUnitId">
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
                      <label for="txtPaymentMethodCategoryId">Ödeme Metodu Kategorisi (*)</label>
                      <select data-id="<?php echo $this->saleProductInformations["payment_method_category_id"]; ?>" class="form-control" id="txtPaymentMethodCategoryId" name="txtPaymentMethodCategoryId">
                        <?php
                        for ($i=0; $i < count($this->categories); $i++) {
                          echo '<option value="'.$this->categories[$i]["category_id"].'">'.$this->categories[$i]["category_name"].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <!-- form group -->

                    <button type="submit" class="btn btn-primary btnLoadingUpdatePaymentMethod">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>payment-method/payment-method-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/units/payment-method/update-payment-method/update-payment-method.js"></script>

</body>


</html>
