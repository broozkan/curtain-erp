<form id="frmNewDiscount" class="new" method="post" model="discount">

  <!-- form group -->
  <div class="form-group">
    <label for="txtDiscountName">İndirim Adı (*)</label>
    <input type="text" class="form-control" name="txtDiscountName" id="txtDiscountName" required>
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtDiscountType">İndirim Tipi (*)</label>
    <select class="form-control" name="txtDiscountType" required>
      <option value="" selected disabled>-Seçiniz-</option>
      <option value="0">Yüzde</option>
      <option value="1">Tutar</option>
    </select>
  </div>
  <!-- form group -->
  <!-- form group -->
  <div class="form-group">
    <label for="txtDiscountAmount">İndirim Miktarı</label>
    <input type="text" class="form-control" name="txtDiscountAmount" id="txtDiscountAmount" required>
  </div>
  <!-- form group -->


  <button type="submit" class="btn btn-primary btnLoadingNewDiscount">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>discount/discount-list/" class="btn btn-danger">İptal</a>
</form>
