<!DOCTYPE html>
<html lang="tr">

<?php require $this->pathPhp."arayuz/head.php"; ?>
<style media="screen">
.special-table .form-group{
  display: inline-block;
}
</style>

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
                    <strong><?php echo $this->dealerInformations["dealer_name"]; ?> </strong>  Canlı Sipariş Ekranı
                    <button type="button" class="btn btn-lg btn-primary btnRefreshOrders float-right" name="button"> <span class="fa fa-undo"></span> Yenile</button>
                  </h4>
                  <p class="card-subtitle mb-4"><?php echo $this->dealerInformations["dealer_name"]; ?> Bayinize ait siparişlerinizi anlık olarak görebilirsiniz</p>
                  <div class="table-responsive">
                    <form class="form-inline d-none frmCustomTableSearch" model="sale" action="" method="post">
                      <div class="form-group d-none">
                        <label for="txtSearchDealerId">Bayi : </label>
                        <input type="text" name="txtSearchDealerId" id="txtSearchDealerId" value="<?php echo $this->dealerInformations["dealer_id"]; ?>">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm" name="button">Ara</button>
                      </div>
                    </form>
                    <table class="table mb-0 special-table" id="live-order-list" function="live-order-list" model="manufacture" is-override="true" page-number="1" item-per-page="5" override-function="overrideLiveOrderList">
                      <tbody>
                        <div class="loading d-none">
                          <img src='<?php echo $this->pathHtml; ?>assets/images/table-loading.gif' class="table-spinner"/>
                        </div>
                        <td>
                          <div class="form-group" style="width:10vw;">
                            <p> <strong>Müşteri :</strong> Veteriner Süleyman</p>
                            <p> <strong>Adres :</strong> HOCA İMAM CAMİ KARŞISI MERKEZ SİVAS</p>
                            <p> <strong>Sipariş Giren :</strong> MEHMET</p>
                            <p> <strong>Sipariş Tarihi :</strong> 27-12-2019</p>
                          </div>
                          <div class="form-group ml-5">
                            <p class="font-weight-bold">STOR KODU</p>
                            <p>SPL-12</p>
                            <p>SPL-12</p>
                            <p>SPL-12</p>
                          </div>
                          <div class="form-group ml-1">
                            <p class="font-weight-bold">MİKTAR</p>
                            <p>1</p>
                            <p>1</p>
                            <p>1</p>
                          </div>
                          <div class="form-group ml-1">
                            <p class="font-weight-bold">EN</p>
                            <p>310</p>
                            <p>310</p>
                            <p>310</p>
                          </div>
                          <div class="form-group ml-1">
                            <p class="font-weight-bold">X</p>
                            <p>x</p>
                            <p>x</p>
                            <p>x</p>
                          </div>
                          <div class="form-group ml-1">
                            <p class="font-weight-bold">BOY</p>
                            <p>255</p>
                            <p>255</p>
                            <p>255</p>
                          </div>
                          <div class="form-group ml-1">
                            <p class="font-weight-bold">MT2</p>
                            <p>8.06 Mt2</p>
                            <p>8.06 Mt2</p>
                            <p>8.06 Mt2</p>
                          </div>
                          <div class="form-group ml-1">
                            <p class="font-weight-bold">AÇIKLAMA</p>
                            <p>bambu zebra krem renkli</p>
                            <p>bambu zebra krem renkli</p>
                            <p>bambu zebra krem renkli</p>
                          </div>
                          <div class="form-group ml-3">
                            <div class="demo" barcode="5938259823">
                            </div>
                          </div>
                          <div class="form-group ml-3">
                            <label for="txtStockProductId">Ürün  <sup>Sipariş olarak girilen ürünün fabrikadaki karşılığı</sup> </label>
                            <input
                            type="text"
                            class="form-control col-12 input-search mb-3"
                            name="txtStockProductId"
                            table="tbl_stock_products"
                            model="stock_product"
                            property="name"
                            click="true"
                            value=""
                            required
                            >
                            <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>

                            <button type="button" class="btn btn-sm btn-success btnAddStockProductRow " name="button"> <span class="fa fa-plus"></span> </button>
                            <div class="form-inline-container">
                              <div class="form-inline div-stock-informations">
                                <input type="text" class="form-control form-control-sm col-6" name="" value="Alüminyum Başlık">
                                <select class="form-control form-control-sm col-4" name="">
                                  <option value="" selected disabled>-Birim Seçiniz-</option>
                                  <?php
                                  for ($i=0; $i < count($this->units); $i++) {
                                    echo '<option value="'.$this->units[$i]["unit_id"].'" >'.$this->units[$i]["unit_name"].'</option>';
                                  }
                                  ?>
                                </select>
                                <input type="text" class="form-control form-control-sm col-2" name="" value="3">
                                <button type="button" class="btn btn-sm btn-danger btnDeleteStockProductRow " name="button"> <span class="fa fa-trash"></span> </button>
                              </div>
                            </div>

                          </div>
                          <div class="form-group ml-3">
                            <button type="button" class="btn btn-lg btn-danger btnPrintOrder" name="button"> <span class="fa fa-print"></span> Onayla ve Yazdır</button>
                          </div>
                        </td>
                        <?php
                        // for ($i=0; $i < count($this->sales); $i++) {
                        // echo '<tr id='.$this->sales[$i]["sale_id"].'">';
                        // echo '<td>'.$this->sales[$i]["sale_id"].'</td>';
                        // echo '<td>'.$this->sales[$i]["sale_name"].'</td>';
                        // echo '<td>'.$this->sales[$i]["sale_phone_number"].'</td>';
                        // echo '<td>'.$this->sales[$i]["sale_email"].'</td>';
                        // echo '<td>'.$this->sales[$i]["sale_username"].'</td>';
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
                          <div class="custom-pagination">
                            <?php
                            // for ($i=1; $i < ($this->totalPageNumber + 1); $i++) {
                            //   echo '<a href="#" value="'.$i.'">'.$i.'</a>';
                            // }
                            ?>
                          </div>
                          <div class="itemPerPage display-inline-block float-right">
                            Sayfa başı
                            <select class="form-control form-control-sm txtCustomItemPerPage">
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
  <script src="<?php echo $this->pathHtml; ?>views/apps/manufacture/live-order-list/live-order-list.js"></script>
  <script src="<?php echo $this->pathHtml; ?>assets/js/jquery-barcode.min.js"></script>

</body>


</html>
