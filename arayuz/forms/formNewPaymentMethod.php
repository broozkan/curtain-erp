<form id="frmNewPaymentMethod" class="new" method="post" model="payment-method">

  <!-- form group -->
  <div class="form-group">
    <label for="txtPaymentMethodName">Ödeme Metodu Adı (*)</label>
    <input type="text" class="form-control" name="txtPaymentMethodName" id="txtPaymentMethodName" required>
  </div>
  <!-- form group -->



  <button type="submit" class="btn btn-primary btnLoadingNewPaymentMethod">Kaydet</button>
  <a href="<?php echo $this->pathHtml; ?>payment-method/payment-method-list/" class="btn btn-danger">İptal</a>
</form>
