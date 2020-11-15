<form id="frmTakeSaleCollection" method="post" model="sale-collection">

  <!-- form group -->
  <input type="hidden" name="txtSaleCollectionSaleId" value="<?php echo $this->saleInformations["sale_id"]; ?>">
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleCollectionAmount">Tahsilat Tutarı (*)</label>
    <input type="text" class="form-control" name="txtSaleCollectionAmount" id="txtSaleCollectionAmount" required>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtSaleCollectionPaymentMethodId">Tahsilat Ödeme Türü (*)</label>
    <select class="form-control" name="txtSaleCollectionPaymentMethodId">
      <?php
      for ($i=0; $i < count($this->paymentMethods); $i++) {
        echo '<option value="'.$this->paymentMethods[$i]["payment_method_id"].'" >'.$this->paymentMethods[$i]["payment_method_name"].'</option>';
      }
      ?>
    </select>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" checked class="custom-control-input" name="txtSaleCollectionSendSmsToCustomer" id="txtSaleCollectionSendSmsToCustomer" value="1">
      <label class="custom-control-label" for="txtSaleCollectionSendSmsToCustomer">Ödemeden sonra sms gönderme penceresini aç</label>
    </div>
  </div>
  <!-- form group -->


  <button type="submit" class="btn btn-primary btnLoadingTakeSaleCollection">Kaydet</button>
</form>
