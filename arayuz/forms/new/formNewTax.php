<form id="frmNewTax" class="new" method="post" model="tax">

  <!-- form group -->
  <div class="form-group">
    <label for="txtTaxName">Vergi Adı (*)</label>
    <input type="text" class="form-control" name="txtTaxName" id="txtTaxName" required>
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtTaxPercentage">Vergi Yüzdesi</label>
    <input type="text" class="form-control" name="txtTaxPercentage" id="txtTaxPercentage" required>
  </div>
  <!-- form group -->


  <button type="submit" class="btn btn-primary btnLoadingNewTax">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>tax/tax-list/" class="btn btn-danger">İptal</a>
</form>
