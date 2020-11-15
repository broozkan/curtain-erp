<form id="frmUpdateSale" method="post" class="frmSale" model="sale">

  <!-- form group -->
  <div class="form-group col-4">
    <label for="txtSaleCustomerId">Satış Müşterisi (*)</label>
    <input
    type="text"
    class="form-control input-search"
    name="txtSaleCustomerId"
    table="tbl_customers"
    model="customer"
    property="name"
    click="true"
    value="<?php echo $this->saleInformations["customer_name"]; ?>"
    data-id="<?php echo $this->saleInformations["sale_customer_id"]; ?>"
    required
    >
    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
    <button type="button" class="btn btn-xs btn-default btnInsideInput btnNewCustomer" data-toggle="modal" data-target="#modalNewCustomer" name="button"> <span class="fa fa-plus"></span> </button>

  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group col-4">
    <label for="txtSaleQueryUserId">Satışı Yapan Kişi (*)</label>
    <select class="form-control" name="txtSaleQueryUserId" required data-value="<?php echo $this->saleInformations["sale_query_user_id"]; ?>">
      <option value="" selected disabled>-Seçiniz-</option>
      <?php
      for ($i=0; $i < count($this->employees); $i++) {
        echo '<option value="'.$this->employees[$i]["employee_id"].'" >'.$this->employees[$i]["employee_name"].'</option>';
      }
      ?>
    </select>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group col-4">
    <label for="txtSaleQueryDate">Satış İşlem Tarihi (*)</label>
    <input type="hidden" name="txtSaleId" value="<?php echo $this->saleInformations["sale_id"]; ?>">
    <input type="date" name="txtSaleQueryDate" required class="form-control" value="<?php echo $this->saleInformations["sale_query_date"]; ?>">
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group col-4">
    <label for="txtSaleDeliveryDate">Satış Teslimat Tarihi (*)</label>
    <input type="date" name="txtSaleDeliveryDate" required class="form-control" value="<?php echo $this->saleInformations["sale_delivery_date"]; ?>">
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group col-4">
    <label for="txtSaleNote">Satış Genel Notu </label>
    <input type="text" name="txtSaleNote"  class="form-control" value="<?php echo $this->saleInformations["sale_note"]; ?>">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group col-4">
    <label for="txtSaleCommonFile">Satış Genel Dosyası </label>
    <input type="file" name="txtSaleCommonFile" id="txtSaleCommonFile" class="form-control" value="">
  </div>
  <!-- form group -->

  <hr>
  <div class="rooms-container ">
    <?php
    for ($i=0; $i < count($this->saleRoomInformations); $i++) {
      echo '<div class="row rowRoom">
      <div class="col-lg-12">
      <!-- form group -->
      <div class="form-group">
      <input type="hidden" name="txtSaleItemSaleInformationId[]" class="txtSaleItemSaleInformationId" value="'.$this->saleRoomInformations[$i]["sale_information_id"].'">
      <input type="text" class="form-control form-control-lg txtSaleItemRoomName" name="txtSaleItemRoomName[]" value="'.$this->saleRoomInformations[$i]["sale_information_room_name"].'" required="">
      </div>
      <!-- form group -->
      </div>
      <div class="col-lg-3">
      <!-- form group -->
      <div class="div-brillant-container">
      <div class="form-group form-sale-group">
      <label for="" class="mr-3">TÜL :
        <button type="button" class="btn btn-sm btn-primary btnAddBrillantMeasure" name="button"> <span class="fa fa-plus"></span> </button>
        </label>
        </div>
        <div class="brillant-measurements">';

        $brillantWidths = json_decode($this->saleRoomInformations[$i]["sale_information_brillant_widths"],true);
        $brillantHeights = json_decode($this->saleRoomInformations[$i]["sale_information_brillant_heights"],true);
        $storCodes = json_decode($this->saleRoomInformations[$i]["sale_information_stor_codes"],true);

        for ($a=0; $a < count($brillantWidths); $a++) {
          echo '<div class="form-inline">';
          echo '<label for="">'.($a+1).'</label>';
          echo '<input value="'.$brillantWidths[$a].'"  type="text" name="txtSaleItemBrillantWidth[]" class="form-control col-4 txtSaleItemBrillantWidth" placeholder="EN">';
          echo '<input value="'.$brillantHeights[$a].'"  type="text" name="txtSaleItemBrillantHeight[]" class="form-control col-4 txtSaleItemBrillantHeight" placeholder="BOY">';
          echo '</div>';
        }

        echo '

        </div>
        </div>
        <!-- form group -->

        <!-- form group -->
        <div class="div-stor-container mt-3">
        <div class="form-group form-sale-group">
        <label for="" class="mr-3">STOR :
          <button type="button" class="btn btn-sm btn-primary btnAddStorMeasure" name="button"> <span class="fa fa-plus"></span> </button>
          </label>
          </div>
          <div class="stor-measurements">';

          $storWidths = json_decode($this->saleRoomInformations[$i]["sale_information_stor_widths"],true);
          $storHeights = json_decode($this->saleRoomInformations[$i]["sale_information_stor_heights"],true);

          for ($a=0; $a < count($storWidths); $a++) {
            echo '<div class="form-inline">';
            echo '<label for="">'.($a+1).'</label>';
            echo '<input value="'.$storWidths[$a].'"  type="text" name="txtSaleItemStorWidth[]" class="form-control col-4 txtSaleItemStorWidth" placeholder="EN">';
            echo '<input value="'.$storHeights[$a].'"  type="text" name="txtSaleItemStorHeight[]" class="form-control col-4 txtSaleItemStorHeight" placeholder="BOY">';
            echo '</div>';
          }

          echo '

          </div>

          </div>
          <!-- form group -->
          </div>

          <div class="col-lg-3">
          <!-- form group -->
          <div class="form-group form-sale-group">
          <label for="">STOR KODU :</label>
          <input type="text" name="txtSaleItemStorCode[]" class="form-control col-6 txtSaleItemStorCode" placeholder="STOR KODU" value="'.$storCodes[$i].'" >
          </div>
          <!-- form group -->
          <!-- form group -->
          <div class="form-group form-sale-group mt-2">
          <label for="">PİLE SIKLIĞI :</label>
          <input type="text" name="txtSaleItemPileDensity[]" class="form-control col-6 txtSaleItemPileDensity" placeholder="PİLE SIKLIĞI" value="'.$this->saleRoomInformations[$i]["sale_information_pile_density"].'" >
          </div>
          <!-- form group -->
          <!-- form group -->
          <div class="form-group form-sale-group mt-2">
          <label for="">ODA DOSYASI :</label>
          <input type="file" name="txtSaleItemFile[]" class="form-control col-6 txtSaleItemFile">
          </div>
          <!-- form group -->
          <!-- form group -->
          <div class="form-group form-sale-group mt-2">
          <label for="">ODA AÇIKLAMASI :</label>
          <input type="text" name="txtSaleItemDescription[]" class="form-control col-12 txtSaleItemDescription" placeholder="ODA AÇIKLAMASI" value="'.$this->saleRoomInformations[$i]["sale_information_room_description"].'" >
          </div>
          <!-- form group -->

          </div>
          <div class="col-lg-6">
          <div class="table-responsive tbl-sale-items-container">
          <table class="table tbl-sale-items">
          <thead>
          <tr>
          <th>#</th>
          <th>KATEGORİ</th>
          <th>ÜRÜN</th>
          <th>ALIŞ FİYATI</th>
          <th>MİKTAR</th>
          <th>FİYAT </th>
          <th>TOPLAM</th>
          </tr>
          </thead>
          <tbody>';
          $productCategoryIds = json_decode($this->saleRoomInformations[$i]["sale_information_product_category_ids"],true);
          $productIds = json_decode($this->saleRoomInformations[$i]["sale_information_product_ids"],true);
          $productPurchasePrices = json_decode($this->saleRoomInformations[$i]["sale_information_product_purchase_prices"],true);
          $productPieces = json_decode($this->saleRoomInformations[$i]["sale_information_product_pieces"],true);
          $productAmounts = json_decode($this->saleRoomInformations[$i]["sale_information_product_amounts"],true);
          $productTotals = json_decode($this->saleRoomInformations[$i]["sale_information_product_totals"],true);

          for ($a=0; $a < count($this->saleRoomInformations[$i]["sale_information_product_names"]); $a++) {
            echo '<tr>';
            if ($a == 0) {
              echo '<td> <button type="button" class="btn btn-sm btn-success btnAddSaleItem" name="button"><span class="fa fa-plus"></span> </button> </td>';
            }else {
              echo '<td> <button type="button" class="btn btn-sm btn-danger btnDeleteSaleItem" name="button"><span class="fa fa-trash"></span> </button> </td>';
            }

            echo '<td>';
            echo '<div class="form-group">';
            echo '<input type="text"
            class="form-control form-control-sm input-search txtSaleItemProductCategoryId"
            name="txtSaleItemProductCategoryId[]"
            table="tbl_categories"
            model="category" property="name"
            click="true"
            value="'.@$this->saleRoomInformations[$i]["sale_information_category_names"][$a].'"
            data-id="'.@$productCategoryIds[$a].'"
            placeholder="Kategori">';
            echo '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
            echo '</div>';
            echo '</td>';
            echo '<td>';
            echo '<div class="form-group">';
            echo '<input type="text"
            class="form-control form-control-sm input-search txtSaleItemSaleProductId"
            name="txtSaleItemSaleProductId[]"
            table="tbl_sale_products"
            model="sale_product"
            property="name"
            click="true"
            value="'.$this->saleRoomInformations[$i]["sale_information_product_names"][$a].'"
            data-id="'.$productIds[$a].'"
            placeholder="Ürün">';
            echo '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
            echo '</div>';
            echo '</td>';
            echo '<td>';
            echo '<div class="form-group">';
            echo '<input type="number" step=".01" class="form-control form-control-sm txtSaleItemPurchasePrice" name="txtSaleItemPurchasePrice[]" value="'.$productPurchasePrices[$a].'" placeholder="Alış Fİyatı">';
            echo '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
            echo '</div>';
            echo '</td>';
            echo '<td>';
            echo '<div class="form-group">';
            echo '<input type="number" step=".01" class="form-control form-control-sm txtSaleItemPiece" name="txtSaleItemPiece[]" value="'.$productPieces[$a].'" placeholder="Adet">';
            echo '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
            echo '</div>';
            echo '</td>';
            echo '<td>';
            echo '<div class="form-group">';
            echo '<input type="number" step=".01" class="form-control form-control-sm txtSaleItemPrice" name="txtSaleItemPrice[]" value="'.$productAmounts[$a].'" placeholder="Tutar">';
            echo '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
            echo '</div>';
            echo '</td>';
            echo '<td>';
            echo '<div class="form-group">';
            echo '<input type="number" step=".01" class="form-control form-control-sm txtSaleItemTotal" name="txtSaleItemTotal[]" value="'.$productTotals[$a].'" placeholder="Toplam">';
            echo '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
            echo '</div>';
            echo '</td>';

            echo '</tr>';

          }
          echo '

          </tbody>
          </table>
          </div>

          </div>
          </div>
          <hr class="room-seperator" >';


        }

        ?>




          </div>

          <div class="row">
            <div class="col-lg-12">
              <button type="button" class="btn btn-success btn-lg float-right btnAddRoom" name="button"> <span class="fa fa-plus"></span> Oda Ekle</button>
            </div>
          </div>

          <hr>
          <hr>

          <div class="row">
            <div class="col-lg-8">

            </div>
            <div class="col-lg-4">
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <div class="form-group">
                        <td class="float-right">Ara Toplam :</td>
                        <td ><input type="number" step=".01" class="form-control txtSaleSubTotal" name="txtSaleSubTotal" value="<?php echo $this->saleInformations["sale_sub_total"]; ?>"> </td>
                      </div>
                    </tr>
                    <tr>
                      <div class="form-group">
                        <td class="float-right">İndirim :</td>
                        <td ><input type="number" step=".01" class="form-control txtSaleDiscountAmount" name="txtSaleDiscountAmount" value="<?php echo $this->saleInformations["sale_discount_amount"]; ?>"> </td>

                      </div>
                    </tr>
                    <tr>
                      <div class="form-group">
                        <td class="float-right">Vergi Toplamı :</td>
                        <td> <input type="number" step=".01" class="form-control txtSaleTaxTotal" name="txtSaleTaxTotal" value="<?php echo $this->saleInformations["sale_tax_total"]; ?>"> </td>
                      </div>
                    </tr>
                    <tr>
                      <div class="form-group">
                        <td class="float-right">Toplam :</td>
                        <td > <input type="number" step=".01" class="form-control txtSaleTotal" name="txtSaleTotal" value="<?php echo $this->saleInformations["sale_total"]; ?>"> </td>
                      </div>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>






          <button type="submit" class="btn btn-primary btnLoadingUpdateSale">Kaydet</button>
          <a href="<?php echo $this->pathHtml; ?>sale/sale-list/" class="btn btn-danger">İptal</a>
        </form>
