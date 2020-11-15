<form id="frmNewSale" method="post" class="frmSale new" model="sale">

  <!-- form group -->
  <div class="form-group col-4">
    <label for="txtSaleCustomerId">Satış Müşterisi (*)</label>
    <input
    type="text" autocomplete="off"
    class="form-control input-search"
    name="txtSaleCustomerId"
    table="tbl_customers"
    model="customer"
    property="name"
    click="true"
    value=""
    required
    autocomplete="off"
    >
    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
    <button type="button" class="btn btn-xs btn-default btnInsideInput btnNewCustomer" data-toggle="modal" data-target="#modalNewCustomer" name="button"> <span class="fa fa-plus"></span> </button>

  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group  col-4">
    <label for="txtSaleQueryUserId">Satışı Yapan Kişi (*)</label>
    <select class="form-control" name="txtSaleQueryUserId" required>
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
  <div class="form-group  col-4">
    <label for="txtSaleQueryDate">Satış İşlem Tarihi (*)</label>
    <input type="date" name="txtSaleQueryDate" required class="form-control" value="">
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group  col-4">
    <label for="txtSaleDeliveryDate">Satış Teslimat Tarihi (*)</label>
    <input type="date" name="txtSaleDeliveryDate" required class="form-control" value="">
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group  col-4">
    <label for="txtSaleNote">Satış Genel Notu </label>
    <input type="text" autocomplete="off" name="txtSaleNote"  class="form-control" value="">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group  col-4">
    <label for="txtSaleCommonFile">Satış Genel Dosyası </label>
    <input type="file" name="txtSaleCommonFile" id="txtSaleCommonFile" class="form-control" value="">
  </div>
  <!-- form group -->

  <hr>
  <div class="rooms-container ">
    <div class="row rowRoom">
      <div class="col-lg-12">
        <!-- form group -->
        <div class="form-group">
          <input type="text" autocomplete="off" class="form-control form-control-lg txtSaleItemRoomName" name="txtSaleItemRoomName[]" value="SALON" required>
        </div>
        <!-- form group -->
      </div>
      <div class="col-lg-6">
        <!-- form group -->
        <div class="div-brillant-container">
          <div class="form-group form-sale-group">
            <label for="" class="mr-3">TÜL :
              <button type="button" class="btn btn-sm btn-primary btnAddBrillantMeasure" name="button"> <span class="fa fa-plus"></span> </button>
              <button type="button" class="btn btn-sm btn-danger btnDeleteBrillantMeasure" name="button"> <span class="fa fa-trash"></span> </button>
            </label>
          </div>
          <div class="brillant-measurements">
            <div class="form-group">
              <input type="text" autocomplete="off" name="txtSaleItemBrillantWidth[]" class="form-control col-12 txtSaleItemBrillantWidth" placeholder="TÜL EN">
              <input type="text" autocomplete="off" name="txtSaleItemBrillantHeight[]" class="form-control col-12 txtSaleItemBrillantHeight" placeholder="TÜL BOY">
            </div>
            <div class="form-group">
              <input type="text" autocomplete="off" name="txtSaleItemBrillantWidth[]" class="form-control col-12 txtSaleItemBrillantWidth" placeholder="TÜL EN">
              <input type="text" autocomplete="off" name="txtSaleItemBrillantHeight[]" class="form-control col-12 txtSaleItemBrillantHeight" placeholder="TÜL BOY">
            </div>
            <div class="form-group">
              <input type="text" autocomplete="off" name="txtSaleItemBrillantWidth[]" class="form-control col-12 txtSaleItemBrillantWidth" placeholder="TÜL EN">
              <input type="text" autocomplete="off" name="txtSaleItemBrillantHeight[]" class="form-control col-12 txtSaleItemBrillantHeight" placeholder="TÜL BOY">
            </div>
            <div class="form-group">
              <input type="text" autocomplete="off" name="txtSaleItemBrillantWidth[]" class="form-control col-12 txtSaleItemBrillantWidth" placeholder="TÜL EN">
              <input type="text" autocomplete="off" name="txtSaleItemBrillantHeight[]" class="form-control col-12 txtSaleItemBrillantHeight" placeholder="TÜL BOY">
            </div>
          </div>
        </div>
        <!-- form group -->

        <!-- form group -->
        <div class="div-stor-container mt-3">
          <div class="form-group form-sale-group">
            <label for="" class="mr-3">STOR :
              <button type="button" class="btn btn-sm btn-primary btnAddStorMeasure" name="button"> <span class="fa fa-plus"></span> </button>
              <button type="button" class="btn btn-sm btn-danger btnDeleteStorMeasure" name="button"> <span class="fa fa-trash"></span> </button>
            </label>
          </div>
          <div class="stor-measurements">
            <div class="form-group">
              <input type="text" autocomplete="off" name="txtSaleItemStorWidth[]" class="form-control col-12 txtSaleItemStorWidth" placeholder="STOR EN">
              <input type="text" autocomplete="off" name="txtSaleItemStorHeight[]" class="form-control col-12 txtSaleItemStorHeight" placeholder="STOR BOY">
            </div>
            <div class="form-group">
              <input type="text" autocomplete="off" name="txtSaleItemStorWidth[]" class="form-control col-12 txtSaleItemStorWidth" placeholder="STOR EN">
              <input type="text" autocomplete="off" name="txtSaleItemStorHeight[]" class="form-control col-12 txtSaleItemStorHeight" placeholder="STOR BOY">

            </div>
            <div class="form-group">
              <input type="text" autocomplete="off" name="txtSaleItemStorWidth[]" class="form-control col-12 txtSaleItemStorWidth" placeholder="STOR EN">
              <input type="text" autocomplete="off" name="txtSaleItemStorHeight[]" class="form-control col-12 txtSaleItemStorHeight" placeholder="STOR BOY">
            </div>
            <div class="form-group">
              <input type="text" autocomplete="off" name="txtSaleItemStorWidth[]" class="form-control col-12 txtSaleItemStorWidth" placeholder="STOR EN">
              <input type="text" autocomplete="off" name="txtSaleItemStorHeight[]" class="form-control col-12 txtSaleItemStorHeight" placeholder="STOR BOY">
            </div>
          </div>
        </div>
        <!-- form group -->
      </div>

      <!-- <div class="col-lg-3"> -->
        <!-- form group -->
        <!-- <div class="form-group form-sale-group">
          <label for="">STOR KODU :</label>
          <input type="text" autocomplete="off" name="txtSaleItemStorCode[]"  class="form-control col-6 txtSaleItemStorCode" placeholder="STOR KODU">
        </div> -->
        <!-- form group -->
        <!-- form group -->
        <!-- <div class="form-group form-sale-group mt-2">
          <label for="">PİLE SIKLIĞI :</label>
          <input type="text" autocomplete="off" name="txtSaleItemPileDensity[]"  class="form-control col-6 txtSaleItemPileDensity" placeholder="PİLE SIKLIĞI"> -->
        <!-- </div> -->
        <!-- form group -->
        <!-- form group -->
        <!-- <div class="form-group form-sale-group mt-2">
          <label for="">ODA DOSYASI :</label>
          <input type="file" name="txtSaleItemFile[]" class="form-control col-6 txtSaleItemFile" >
        </div> -->
        <!-- form group -->
        <!-- form group -->
        <!-- <div class="form-group form-sale-group mt-2">
          <label for="">ODA AÇIKLAMASI :</label>
          <input type="text" autocomplete="off" name="txtSaleItemDescription[]"  class="form-control col-8 txtSaleItemDescription" placeholder="ODA AÇIKLAMASI">
        </div> -->
        <!-- form group -->

      <!-- </div> -->
      <div class="col-lg-6">
        <div class="table-responsive tbl-sale-items-container">
          <table class="table tbl-sale-items">
            <thead>
              <tr>
                <th><button type="button" class="btn btn-sm btn-success btnAddSaleItem" name="button"><span class="fa fa-plus"></span> </button></th>
                <th>KATEGORİ</th>
                <th class="width50">ÜRÜN</th>
                <th class="width20">ALIŞ FİYATI</th>
                <th >MİKTAR</th>
                <th class="width20">FİYAT </th>
                <th>TOPLAM</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> <button type="button" class="btn btn-sm btn-danger btnDeleteSaleItem" name="button"><span class="fa fa-trash"></span> </button> </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input
                    type="text" autocomplete="off"
                    class="form-control form-control-sm input-search txtSaleItemProductCategoryId pointer-events-none"
                    name="txtSaleItemProductCategoryId[]"
                    table="tbl_categories"
                    model="category"
                    property="name"
                    click="true"
                    value="FON"
                    data-id="6"
                    placeholder="Kategori"
                    >
                    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                  </div>
                  <!-- form group -->
                </td>
                <td class="">
                  <!-- form group -->
                  <div class="form-group">
                    <input
                    type="text" autocomplete="off"
                    class="form-control form-control-sm input-search txtSaleItemSaleProductId "
                    name="txtSaleItemSaleProductId[]"
                    table="tbl_sale_products"
                    model="sale_product"
                    property="name"
                    click="true"
                    value=""

                    placeholder="Ürün"
                    >
                    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                  </div>
                  <!-- form group -->

                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemPurchasePrice[]" class="txtSaleItemPurchasePrice form-control form-control-sm" value="0" min="0">
                  </div>
                  <!-- form group -->
                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemPiece[]" class="txtSaleItemPiece form-control form-control-sm" value="1" min="1">
                  </div>
                  <!-- form group -->
                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemPrice[]" class="txtSaleItemPrice form-control form-control-sm" value="0" min="0">
                  </div>
                  <!-- form group -->
                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemTotal[]" class="txtSaleItemTotal form-control form-control-sm txtSaleItemTotal" value="0" min="0">
                  </div>
                  <!-- form group -->
                </td>
              </tr>
              <tr>
                <td> <button type="button" class="btn btn-sm btn-danger btnDeleteSaleItem" name="button"><span class="fa fa-trash"></span> </button> </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input
                    type="text" autocomplete="off"
                    class="form-control form-control-sm input-search txtSaleItemProductCategoryId pointer-events-none"
                    name="txtSaleItemProductCategoryId[]"
                    table="tbl_categories"
                    model="category"
                    property="name"
                    click="true"
                    value="TÜL"
                    data-id="5"

                    placeholder="Kategori"
                    >
                    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                  </div>
                  <!-- form group -->
                </td>
                <td  class="">
                  <!-- form group -->
                  <div class="form-group">
                    <input
                    type="text" autocomplete="off"
                    class="form-control form-control-sm input-search txtSaleItemSaleProductId "
                    name="txtSaleItemSaleProductId[]"
                    table="tbl_sale_products"
                    model="sale_product"
                    property="name"
                    click="true"
                    value=""

                    placeholder="Ürün"
                    >
                    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                  </div>
                  <!-- form group -->

                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemPurchasePrice[]" class="txtSaleItemPurchasePrice form-control form-control-sm" value="0" min="0">
                  </div>
                  <!-- form group -->
                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemPiece[]" class="txtSaleItemPiece form-control form-control-sm" value="1" min="1">
                  </div>
                  <!-- form group -->
                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemPrice[]" class="txtSaleItemPrice form-control form-control-sm" value="0" min="0">
                  </div>
                  <!-- form group -->
                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemTotal[]" class="txtSaleItemTotal form-control form-control-sm txtSaleItemTotal" value="0" min="0">
                  </div>
                  <!-- form group -->
                </td>
              </tr>
              <tr>
                <td> <button type="button" class="btn btn-sm btn-danger btnDeleteSaleItem" name="button"><span class="fa fa-trash"></span> </button> </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input
                    type="text" autocomplete="off"
                    class="form-control form-control-sm input-search txtSaleItemProductCategoryId pointer-events-none"
                    name="txtSaleItemProductCategoryId[]"
                    table="tbl_categories"
                    model="category"
                    property="name"
                    click="true"
                    value="STOR-ZEBRA"
                    data-id="10"

                    placeholder="Kategori"
                    >
                    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                  </div>
                  <!-- form group -->
                </td>
                <td class="">
                  <!-- form group -->
                  <div class="form-group">
                    <input
                    type="text" autocomplete="off"
                    class="form-control form-control-sm input-search txtSaleItemSaleProductId "
                    name="txtSaleItemSaleProductId[]"
                    table="tbl_sale_products"
                    model="sale_product"
                    property="name"
                    click="true"
                    value=""

                    placeholder="Ürün"
                    >
                    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                  </div>
                  <!-- form group -->

                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemPurchasePrice[]" class="txtSaleItemPurchasePrice form-control form-control-sm" value="0" min="0">
                  </div>
                  <!-- form group -->
                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemPiece[]" class="txtSaleItemPiece form-control form-control-sm" value="1" min="1">
                  </div>
                  <!-- form group -->
                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemPrice[]" class="txtSaleItemPrice form-control form-control-sm" value="0" min="0">
                  </div>
                  <!-- form group -->
                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemTotal[]" class="txtSaleItemTotal form-control form-control-sm txtSaleItemTotal" value="0" min="0">
                  </div>
                  <!-- form group -->
                </td>
              </tr>
              <tr>
                <td> <button type="button" class="btn btn-sm btn-danger btnDeleteSaleItem" name="button"><span class="fa fa-trash"></span> </button> </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input
                    type="text" autocomplete="off"
                    class="form-control form-control-sm input-search txtSaleItemProductCategoryId pointer-events-none"
                    name="txtSaleItemProductCategoryId[]"
                    table="tbl_categories"
                    model="category"
                    property="name"
                    click="true"
                    value="DİĞER"
                    data-id="11"

                    placeholder="Kategori"
                    >
                    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                  </div>
                  <!-- form group -->
                </td>
                <td class="">
                  <!-- form group -->
                  <div class="form-group">
                    <input
                    type="text" autocomplete="off"
                    class="form-control form-control-sm input-search txtSaleItemSaleProductId  "
                    name="txtSaleItemSaleProductId[]"
                    table="tbl_sale_products"
                    model="sale_product"
                    property="name"
                    click="true"
                    value=""

                    placeholder="Ürün"
                    >
                    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                  </div>
                  <!-- form group -->

                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemPurchasePrice[]" class="txtSaleItemPurchasePrice form-control form-control-sm" value="0" min="0">
                  </div>
                  <!-- form group -->
                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemPiece[]" class="txtSaleItemPiece form-control form-control-sm" value="1" min="1">
                  </div>
                  <!-- form group -->
                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemPrice[]" class="txtSaleItemPrice form-control form-control-sm" value="0" min="0">
                  </div>
                  <!-- form group -->
                </td>
                <td>
                  <!-- form group -->
                  <div class="form-group">
                    <input type="number" step=".01" name="txtSaleItemTotal[]" class="txtSaleItemTotal form-control form-control-sm txtSaleItemTotal" value="0" min="0">
                  </div>
                  <!-- form group -->
                </td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>

      <div class="row inline-flex">
        <div class="col-lg-12">
          <!-- form group -->
          <div class="form-inline inline-block form-sale-group">
            <input type="text" autocomplete="off" name="txtSaleItemStorCode[]"  class="form-control col-12 txtSaleItemStorCode" placeholder="STOR KODU">
          </div>
          <!-- form group -->
          <!-- form group -->
          <div class="form-inline inline-block form-sale-group mt-2">
            <input type="text" autocomplete="off" name="txtSaleItemPileDensity[]"  class="form-control col-12 txtSaleItemPileDensity" placeholder="PİLE SIKLIĞI">
          </div>
          <!-- form group -->
          <!-- form group -->
          <div class="form-inline inline-block form-sale-group mt-2">
            <input type="file" name="txtSaleItemFile[]" class="form-control col-12 txtSaleItemFile" >
          </div>
          <!-- form group -->
          <!-- form group -->
          <div class="form-inline inline-block form-sale-group mt-2">
            <input type="text" autocomplete="off" name="txtSaleItemDescription[]"  class="form-control col-12 txtSaleItemDescription" placeholder="ODA AÇIKLAMASI">
          </div>
          <!-- form group -->
        </div>
      </div>
    </div>
    <hr class="room-seperator" >
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
                <td ><input type="number" step=".01" class="form-control txtSaleSubTotal" name="txtSaleSubTotal"> </td>
              </div>
            </tr>
            <tr>
              <div class="form-group">
                <td class="float-right">İndirim :</td>
                <td ><input type="number" value="0" step=".01" class="form-control txtSaleDiscountAmount" name="txtSaleDiscountAmount"> </td>

              </div>
            </tr>
            <tr>
              <div class="form-group">
                <td class="float-right">Vergi Toplamı :</td>
                <td> <input type="number" step=".01" class="form-control txtSaleTaxTotal" name="txtSaleTaxTotal" value="0"> </td>
              </div>
            </tr>
            <tr>
              <div class="form-group">
                <td class="float-right">Toplam :</td>
                <td > <input type="number" step=".01" class="form-control txtSaleTotal" name="txtSaleTotal"> </td>
              </div>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>






  <button type="submit" class="btn btn-primary btnLoadingNewSale">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>sale/sale-list/" class="btn btn-danger">İptal</a>
</form>
