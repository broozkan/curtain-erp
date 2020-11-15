<!DOCTYPE html>
<html lang="tr">

<?php require $this->pathPhp."arayuz/head.php"; ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->pathHtml; ?>assets/css/sale.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->pathHtml; ?>views/apps/sale/sale-profile/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->pathHtml; ?>views/apps/sale/sale-profile/sale-profile.css">

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



          <div class="row" id="divPrint">
            <div class="col-xl-12">


              <div class="card">
                <div class="card-body">

                  <h4 class="card-title no-print">Satış Detayı</h4>
                  <h4 class="card-title"><?php echo $this->saleInformations["customer_name"]; ?></h4>

                  <div class="row"  >
                    <div class="col-lg-12">
                      <div class="table-responsive">
                        <table class="table print-table">
                          <tbody>
                            <tr>
                              <td class="no-print"> <strong> Müşteri : </strong> <?php echo $this->saleInformations["customer_name"]; ?></td>
                              <input type="hidden" class="txtCustomerName" value="<?php echo $this->saleInformations["customer_name"]; ?>">
                              <input type="hidden" class="txtSaleCustomerId" value="<?php echo $this->saleInformations["sale_customer_id"]; ?>">
                              <td> <strong> Müşteri Adresi : </strong> <?php echo $this->saleInformations["customer_address"]; ?></td>


                              <td> <strong> Telefon Numarası : </strong> <?php echo $this->saleInformations["customer_phone_number"]; ?></td>

                              <td> <strong> Satışı Gerçekleştiren Kişi : </strong> <?php echo $this->saleInformations["employee_name"]; ?></td>

                              <td> <strong> Satış Tarihi : </strong> <?php echo $this->saleInformations["sale_query_date"]; ?></td>

                              <td class="no-print">
                                <strong> Durum : </strong>
                                <?php
                                if ($this->saleInformations["sale_payment_state"] == 1) {
                                  echo '<span class="badge badge-success">Ödendi</span>';
                                }elseif ($this->saleInformations["sale_payment_state"] == 2) {
                                  echo '<span class="badge badge-warning">Ödenecek tutardan fazlası alındı!</span>';
                                }else {
                                  echo '<span class="badge badge-danger">Ödenmedi</span>';
                                }
                                ?>
                              </td>
                              <input type="hidden" id="txtSaleBarcode" value="<?php echo $this->saleInformations["sale_barcode"]; ?>">
                              <td> <div id="demo" class="float-right" ></div></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-lg-12 no-print">
                      <div class="table-responsive">
                        <table class="table print-table">
                          <tbody>

                            <tr class="no-print d-none">
                              <td> <strong> Görseller : </strong></td>
                              <td>  </td>
                            </tr>
                            <tr class="no-print">
                              <td> <strong>İşlemler :</strong> </td>
                              <td>
                                <?php
                                if ($this->saleInformations["sale_sent_factory_id"] == null) {
                                  echo '<button type="button" class="btn btn-sm btn-primary mb-2 btnModalFactoryList" sale-id="'.$this->saleInformations["sale_id"].'" data-toggle="modal" data-target="#modalFactoryList" name="button">Fabrikaya Gönder</button>';
                                }else {
                                  echo '<button type="button" class="btn btn-sm btn-danger mb-2 btnCancelSendingSaleToFactory" sale-id="'.$this->saleInformations["sale_id"].'" name="button">Üretimden Geri Al</button>';
                                }
                                ?>
                                <?php
                                if ($this->saleInformations["sale_workshop_id"] == null) {
                                  echo '<button type="button" class="btn btn-sm btn-primary mb-2 btnModalWorkshopList" sale-id="'.$this->saleInformations["sale_id"].'" data-toggle="modal" data-target="#modalWorkshopList" name="button">Terzihaneye Gönder</button>';
                                }else {
                                  echo '<button type="button" class="btn btn-sm btn-danger mb-2 btnCancelSendingSaleToWorkshop" sale-id="'.$this->saleInformations["sale_id"].'" name="button">Atölyeden Geri Al</button>';
                                }
                                ?>
                                <button type="button" class="btn btn-sm btn-primary mb-2 btnModalSupplierList" data-toggle="modal" data-target="#modalSupplierList" name="button">Tedarikçiye Gönder</button>
                                <button type="button" class="btn btn-sm btn-primary mb-2 btnPrintSale" name="button">Yazdır</button>
                                <?php
                                if ($this->saleInformations["sale_sent_factory_id"] == null) {
                                  echo '<a href="'.$this->pathHtml.'sale/update-sale/'.$this->saleInformations["sale_id"].'" class="btn btn-sm btn-warning mb-2" sale-id="'.$this->saleInformations["sale_id"].'" name="button">Düzenle</a>';
                                }
                                ?>
                                <button type="button" class="btn btn-sm btn-primary mb-2" name="button" data-toggle="modal" sale-id="" data-target="#modalTakeSaleCollection">Tahsilat Yap</button>
                                <button type="button" class="btn btn-sm btn-primary mb-2 btnModalSaleCollections" name="button" data-toggle="modal" sale-id="<?php echo $this->saleInformations["sale_id"]; ?>" data-target="#modalSaleCollections">Tahsilatlar</button>
                                <button type="button" class="btn btn-sm btn-primary mb-2 btnSendEmailToCustomer" data-toggle="modal" sale-id="" data-target="#modalSendEmailToCustomer" name="button">Müşteriye E-Posta Gönder</button>
                                <button type="button" class="btn btn-sm btn-primary mb-2 btnSendSmsToCustomer" data-toggle="modal" customer-id="<?php echo $this->saleInformations["sale_customer_id"]; ?>" sale-id="<?php echo $this->saleInformations["sale_id"]; ?>" data-target="#modalSendSmsToCustomer" name="button">Müşteriye Sms Gönder</button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <?php

                    for ($i=0; $i < count($this->saleRoomInformations); $i++) {
                      echo '<div class="col-md-12 printScale div-rooms">';
                      echo '<h3>'.$this->saleRoomInformations[$i]["sale_information_room_name"].'</h3>';
                      echo '<div class="display-flex">';
                      echo '<div class="col-md-6 column2">';
                      echo '<div class="brillant-measurements">';
                      echo '<label for=""><strong> TÜL </strong>  </label>';

                      $brillantWidths = json_decode($this->saleRoomInformations[$i]["sale_information_brillant_widths"],true);
                      $brillantHeights = json_decode($this->saleRoomInformations[$i]["sale_information_brillant_heights"],true);
                      $storCodes = json_decode($this->saleRoomInformations[$i]["sale_information_stor_codes"],true);

                      for ($a=0; $a < count($brillantWidths); $a++) {
                        echo '<div class="form-group">';
                        echo '<input class="form-control form-control-sm" value="'.$brillantWidths[$a].'" />';
                        echo '<input class="form-control form-control-sm" value="'.$brillantHeights[$a].'" />';
                        echo '</div>';
                      }
                      echo '</div>';
                      echo '<div class="stor-measurements">';
                      echo '<label for=""><strong> STOR </strong>  </label>';

                      $storWidths = json_decode($this->saleRoomInformations[$i]["sale_information_stor_widths"],true);
                      $storHeights = json_decode($this->saleRoomInformations[$i]["sale_information_stor_heights"],true);

                      for ($a=0; $a < count($storWidths); $a++) {
                        echo '<div class="form-group">';
                        echo '<input class="form-control form-control-sm stor-widths" value="'.$storWidths[$a].'" />';
                        echo '<input class="form-control form-control-sm stor-heigts" value="'.$storHeights[$a].'" />';
                        echo '</div>';
                      }

                      echo '</div>';
                      echo '<div class="col-md-12 column2 inline-flex">';
                      echo '<div class="form-group mb-0 divRoomDescription">';
                      echo '<label for=""><strong> STOR KODU:</strong>  </label>';
                      echo '<span class="span-stor-codes">'.$storCodes[0].'</span>';
                      echo '</div>';

                      echo '</div>';
                      echo '<div class="col-md-12 column2 inline-flex">';
                      echo '<div class="form-group divRoomDescription">';
                      echo '<label for=""><strong> ODA AÇIKLAMASI:</strong>  </label>';
                      echo $this->saleRoomInformations[$i]["sale_information_room_description"];
                      echo '</div>';

                      echo '</div>';
                      echo '</div>';

                      echo '<div class="col-lg-6 col-sm-6 no-print">';
                      echo '<div class="table-responsive">';
                      echo '<table class="table">';
                      echo '<thead>';
                      echo '<tr>';
                      echo '<th>KATEGORİ</th>';
                      echo '<th>ÜRÜN</th>';
                      if ($this->employeePermissions[2]) {
                        echo '<th>ALIŞ FİYATI</th>';
                      }else {
                        echo '<th class="d-none">ALIŞ FİYATI</th>';
                      }
                      echo '<th>MİKTAR</th>';
                      echo '<th>FİYAT </th>';
                      echo '<th>TOPLAM</th>';
                      echo '</tr>';
                      echo '</thead>';
                      echo '<tbody>';

                      $productPurchasePrices = json_decode($this->saleRoomInformations[$i]["sale_information_product_purchase_prices"],true);
                      $productPieces = json_decode($this->saleRoomInformations[$i]["sale_information_product_pieces"],true);
                      $productAmounts = json_decode($this->saleRoomInformations[$i]["sale_information_product_amounts"],true);
                      $productTotals = json_decode($this->saleRoomInformations[$i]["sale_information_product_totals"],true);

                      for ($a=0; $a < count($this->saleRoomInformations[$i]["sale_information_product_names"]); $a++) {
                        echo '<tr>';
                        echo '<td>'.$this->saleRoomInformations[$i]["sale_information_category_names"][$a].'</td>';
                        echo '<td>'.$this->saleRoomInformations[$i]["sale_information_product_names"][$a].'</td>';
                        if ($this->employeePermissions[2]) {
                          echo '<td>'.$productPurchasePrices[$a].' ₺ </td>';
                        }else {
                          echo '<td class="d-none">'.$productPurchasePrices[$a].' ₺ </td>';
                        }
                        echo '<td>'.$productPieces[$a].' </td>';
                        echo '<td>'.$productAmounts[$a].' </td>';
                        echo '<td>'.$productTotals[$a].' ₺ </td>';
                        echo '</tr>';

                      }
                      echo '</tbody>';
                      echo '</table>';
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';



                    }
                    ?>
                  </div>

                  <hr class="seperator">
                  <div class="row row-under-invoice">
                    <div class="col-lg-8">

                    </div>
                    <div class="col-lg-4">
                      <div class="table-responsive">
                        <table class="table table-bordered tblTotalInformations">
                          <tbody>
                            <tr>
                              <td class="float-right font-weight-bold">Toplam :</td>
                              <td><?php echo $this->saleInformations["sale_sub_total"]; ?> ₺ </td>
                            </tr>
                            <tr>
                              <td class="float-right font-weight-bold">İndirim :</td>
                              <td><?php echo $this->saleInformations["sale_discount_amount"]; ?>  ₺</td>
                            </tr>
                            <tr>
                              <td class="float-right font-weight-bold">Tahsil Edilen :</td>
                              <td> <?php echo $this->saleCollectionTotal; ?> ₺ </td>
                            </tr>
                            <tr>
                              <td class="float-right font-weight-bold">Kalan :</td>
                              <td> <?php echo $this->saleInformations["sale_remain"]; ?> ₺ </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>





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

  <?php require $this->pathPhp."arayuz/modals/modalNewDiscount.php"; ?>
  <?php require $this->pathPhp."arayuz/modals/modalFactoryList.php"; ?>
  <?php require $this->pathPhp."arayuz/modals/modalWorkshopList.php"; ?>
  <?php require $this->pathPhp."arayuz/modals/modalSupplierList.php"; ?>
  <?php require $this->pathPhp."arayuz/modals/modalSendEmailToCustomer.php"; ?>
  <?php require $this->pathPhp."arayuz/modals/modalSendSmsToCustomer.php"; ?>
  <?php require $this->pathPhp."arayuz/modals/modalTakeSaleCollection.php"; ?>
  <?php require $this->pathPhp."arayuz/modals/modalSaleCollections.php"; ?>

  <?php require $this->pathPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->pathHtml; ?>views/apps/sale/sale-profile/sale-profile.js"></script>
  <script src="<?php echo $this->pathHtml; ?>assets/js/sale.js"></script>
  <script src="<?php echo $this->pathHtml; ?>assets/js/jquery-barcode.min.js"></script>
  <script src="<?php echo $this->pathHtml; ?>assets/js/sms.js"></script>



</body>


</html>
