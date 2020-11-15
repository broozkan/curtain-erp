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
                    Fabrika Listesi
                  </h4>
                  <p class="card-subtitle mb-4">Fabrikaye gelen siparişlerin listesini görmek için bir atölye seçin</p>


                  <?php
                  for ($i=0; $i < count($this->factorys); $i++) {
                    echo '<div class="col-lg-4">';
                    echo '<div class="card card-body">';
                    echo '<h4 class="card-title">'.$this->factorys[$i]["factory_name"].'</h4>';
                    echo '<p class="card-text">'.$this->factorys[$i]["factory_address"].'</p>';
                    echo '<a href="'.$this->pathHtml.'factory/factory-queue/'.$this->factorys[$i]["factory_id"].'" class="btn btn-primary">Fabrika Sipariş Listesi</a>';
                    echo '</div>';
                    echo '</div>';
                  }
                  ?>






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

</body>


</html>
