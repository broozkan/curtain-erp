<form id="frmNewWorkshop" class="new" method="post" model="workshop">


  <!-- form group -->
  <div class="form-group">
    <label for="txtWorkshopName">Atölye Adı (*)</label>
    <input type="text" class="form-control" name="txtWorkshopName" id="txtWorkshopName" required>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtWorkshopAddress">Atölye Adresi</label>
    <input type="text" class="form-control" name="txtWorkshopAddress" id="txtWorkshopAddress">
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtWorkshopPhoneNumber">Atölye Telefon Numarası</label>
    <input type="text" class="form-control" name="txtWorkshopPhoneNumber" id="txtWorkshopPhoneNumber">
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtWorkshopEmail">Atölye E-Posta Adresi</label>
    <input type="text" class="form-control email" name="txtWorkshopEmail" id="txtWorkshopEmail">
  </div>
  <!-- form group -->



  <button type="submit" class="btn btn-primary btnLoadingNewWorkshop">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>workshop/workshop-list/" class="btn btn-danger">İptal</a>
</form>
