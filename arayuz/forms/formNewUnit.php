<form id="frmNewUnit" class="new" method="post" model="unit">

  <!-- form group -->
  <div class="form-group">
    <label for="txtUnitName">Birim Adı (*)</label>
    <input type="text" class="form-control" name="txtUnitName" id="txtUnitName" required>
  </div>
  <!-- form group -->


  <button type="submit" class="btn btn-primary btnLoadingNewUnit">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>unit/unit-list/" class="btn btn-danger">İptal</a>
</form>
