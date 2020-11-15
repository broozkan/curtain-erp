<form id="frmNewFactory" class="new" method="post" model="factory">

  <!-- form group -->
  <div class="form-group">
    <label for="txtFactoryUniqueId">Fabrika ID (*)</label>
    <input type="text" class="form-control" name="txtFactoryUniqueId" id="txtFactoryUniqueId" required>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtFactoryName">Fabrika Adı (*)</label>
    <input type="text" class="form-control" name="txtFactoryName" id="txtFactoryName" required>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtFactoryAddress">Fabrika Adresi</label>
    <input type="text" class="form-control" name="txtFactoryAddress" id="txtFactoryAddress">
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtFactoryPhoneNumber">Fabrika Telefon Numarası</label>
    <input type="text" class="form-control" name="txtFactoryPhoneNumber" id="txtFactoryPhoneNumber">
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtFactoryEmail">Fabrika E-Posta Adresi</label>
    <input type="text" class="form-control email" name="txtFactoryEmail" id="txtFactoryEmail">
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtFactoryDbServer">Fabrika Veritabanı Sunucusu (*)</label>
    <input type="text" class="form-control ip" name="txtFactoryDbServer" id="txtFactoryDbServer" required>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtFactoryDbName">Fabrika Veritabanı Adı (*)</label>
    <input type="text" class="form-control" name="txtFactoryDbName" id="txtFactoryDbName" required>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtFactoryDbUsername">Fabrika Veritabanı Kullanıcı Adı (*)</label>
    <input type="text" class="form-control" name="txtFactoryDbUsername" id="txtFactoryDbUsername" required>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtFactoryDbPassword">Fabrika Veritabanı Parolası (*)</label>
    <input type="password" class="form-control" name="txtFactoryDbPassword" id="txtFactoryDbPassword" required>
  </div>
  <!-- form group -->



  <button type="submit" class="btn btn-primary btnLoadingNewFactory">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>factory/factory-list/" class="btn btn-danger">İptal</a>
</form>
