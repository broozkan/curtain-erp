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
            <div class="col-xl-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    Alış Faturasıler Listesi
                    <a href="<?php echo $this->pathHtml; ?>purchase-invoice/new-purchase-invoice" class="btn btn-primary btn-sm float-right"> <span class="fa fa-plus"></span> Yeni Alış Faturası Ekle</a>
                  </h4>
                  <p class="card-subtitle mb-4">Alış Faturasılerinizin listesine buradan ulaşabilirsiniz</p>
                  <div class="table-responsive">
                    <form class="form-inline frmTableSearch" model="purchase-invoice" action="" method="post">
                      <div class="form-group">
                        <label for="txtPurchaseInvoiceSupplierId">Alış Faturası Tedarikçisi : </label>
                        <input type="text" class="form-control" name="txtPurchaseInvoiceSupplierId" id="txtPurchaseInvoiceSupplierId" value="">
                      </div>
                      <div class="form-group">
                        <label for="txtPurchaseInvoiceMaturityDate">Alış Faturası Vade Tarihi : </label>
                        <input type="date" class="form-control" name="txtPurchaseInvoiceMaturityDate" id="txtPurchaseInvoiceMaturityDate" value="">
                      </div>
                      <div class="form-group">
                        <label for="txtPurchaseInvoiceCashId">Alış Faturası Kasası : </label>
                        <input type="text" class="form-control" name="txtPurchaseInvoiceCashId" id="txtPurchaseInvoiceCashId" value="">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm" name="button">Ara</button>
                      </div>
                    </form>
                    <table class="table mb-0" id="purchase-invoice-list" model="purchase_invoice" is-override="false" page-number="1" item-per-page="1">
                      <thead class="thead-light">
                        <tr>
                          <th>#</th>
                          <th>Tedarikçi</th>
                          <th>Vade Tarihi</th>
                          <th>Tutar</th>
                          <th>İşlem</th>
                        </tr>
                      </thead>
                      <tbody>
                        <div class="loading d-none">
                          <img src='<?php echo $this->pathHtml; ?>assets/images/table-loading.gif' class="table-spinner"/>
                        </div>
                        <?php
                        // for ($i=0; $i < count($this->purchase-invoices); $i++) {
                        // echo '<tr id='.$this->purchase-invoices[$i]["purchase-invoice_id"].'">';
                        // echo '<td>'.$this->purchase-invoices[$i]["purchase-invoice_id"].'</td>';
                        // echo '<td>'.$this->purchase-invoices[$i]["purchase-invoice_name"].'</td>';
                        // echo '<td>'.$this->purchase-invoices[$i]["purchase-invoice_phone_number"].'</td>';
                        // echo '<td>'.$this->purchase-invoices[$i]["purchase-invoice_email"].'</td>';
                        // echo '<td>'.$this->purchase-invoices[$i]["purchase-invoice_username"].'</td>';
                        // echo '<td>';
                        // echo '<div class="btn-group mb-2">';
                        // echo '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">İşlem <i class="mdi mdi-chevron-down"></i></button>';
                        // echo '<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">';
                        // echo '<a class="dropdown-item" href="#">Profil</a>';
                        // echo '<a class="dropdown-item" href="#">Düzenle</a>';
                        // echo '<a class="dropdown-item" href="#">Sil</a>';
                        // echo '</div>';
                        // echo '</div>';
                        // echo '</td>';
                        // echo '</tr>';
                        // }
                        ?>

                      </tbody>
                    </table>
                    <div class="card-footer ">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="pagination">
                            <?php
                            // for ($i=1; $i < ($this->totalPageNumber + 1); $i++) {
                            //   echo '<a href="#" value="'.$i.'">'.$i.'</a>';
                            // }
                            ?>
                          </div>
                          <div class="itemPerPage display-inline-block float-right">
                            Sayfa başı
                            <select class="form-control form-control-sm txtItemPerPage">
                              <option value="1" selected>1</option>
                              <option value="5">5</option>
                              <option value="7">7</option>
                              <option value="10">10</option>
                              <option value="25">25</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                              <option value="500">500</option>
                            </select>
                            satır göster
                          </div>
                        </div>

                      </div>

                    </div>
                  </div>

                </div>
                <!-- end card-body-->

              </div>
              <!-- end card -->

            </div>
            <!-- end col -->

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
  <script src="<?php echo $this->pathHtml; ?>views/apps/accounting/purchase-invoice/purchase-invoice-list/purchase-invoice-list.js"></script>

</body>


</html>
