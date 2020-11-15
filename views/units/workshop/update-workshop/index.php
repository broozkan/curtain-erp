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

                  <h4 class="card-title">Atölye Bilgilerini Düzenle</h4>
                  <p class="card-subtitle mb-4">Atölyeınızın bilgilerini buradan düzenleyebilirsiniz.</p>

                  <form id="frmUpdateWorkshop" method="post" model="workshop">


                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtWorkshopName">Atölye Adı (*)</label>
                      <input type="hidden" name="txtWorkshopId" value="<?php echo $this->workshopInformations["workshop_id"]; ?>">
                      <input type="text" value="<?php echo $this->workshopInformations["workshop_name"]; ?>" class="form-control" name="txtWorkshopName" id="txtWorkshopName" required>
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtWorkshopAddress">Atölye Adresi</label>
                      <input type="text" value="<?php echo $this->workshopInformations["workshop_address"]; ?>" class="form-control" name="txtWorkshopAddress" id="txtWorkshopAddress">
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtWorkshopPhoneNumber">Atölye Telefon Numarası</label>
                      <input type="text" value="<?php echo $this->workshopInformations["workshop_phone_number"]; ?>" class="form-control" name="txtWorkshopPhoneNumber" id="txtWorkshopPhoneNumber">
                    </div>
                    <!-- form group -->

                    <!-- form group -->
                    <div class="form-group">
                      <label for="txtWorkshopEmail">Atölye E-Posta Adresi</label>
                      <input type="text" value="<?php echo $this->workshopInformations["workshop_email"]; ?>" class="form-control email" name="txtWorkshopEmail" id="txtWorkshopEmail">
                    </div>
                    <!-- form group -->



                    <button type="submit" class="btn btn-primary btnLoadingUpdateWorkshop">Kaydet</button>
                    <a href="<?php echo $this->pathHtml; ?>workshop/workshop-list/" class="btn btn-danger">İptal</a>
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
  <script src="<?php echo $this->pathHtml; ?>views/units/workshop/update-workshop/update-workshop.js"></script>

</body>


</html>
