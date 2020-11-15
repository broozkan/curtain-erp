<form id="frmNewCategory" class="new" method="post" model="category">

  <!-- form group -->
  <div class="form-group">
    <label for="txtCategoryName">Kategori Adı (*)</label>
    <input type="text" class="form-control" name="txtCategoryName" id="txtCategoryName" required>
  </div>
  <!-- form group -->



  <button type="submit" class="btn btn-primary btnLoadingNewCategory">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>category/category-list/" class="btn btn-danger">İptal</a>
</form>
