<form id="frmSendSmsToCustomer" method="post" model="sms">

  <!-- form group -->
  <div class="form-group">
    <label for="txtSmsCustomerId">Müşteri (*)</label>
    <input
    type="text"
    class="form-control input-search"
    name="txtSmsCustomerId[]"
    table="tbl_customers"
    model="customer"
    property="name"
    id="txtSmsCustomerId"
    click="true"
    data-id=""
    required
    >
    <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>
  </div>
  <!-- form group -->

  <!-- form group -->
  <div class="form-group">
    <label for="txtSmsText">Sms İçeriği</label>
    <input type="hidden" class="txtSmsCustomerId" value="">
    <textarea name="txtSmsText" id="txtSmsText" class="form-control" rows="8" cols="80">
      Degerli müsterimiz dogan birlik perde dünyasina hosgeldiniz siparisiniz isleme alinmistir hazir oldugunda size bilgi mesaji verilecektir bizi tercih ettiginiz icin tesekkür ederiz..firsatlarimizdan ve yeniliklerden haberdar olmak icin insigram sayfamizi takip edebilirsiniz https://www.instagram.com/dogan_birlik/


    </textarea>
  </div>
  <!-- form group -->

  <!-- form group -->
  <!-- <div class="form-group">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" checked class="custom-control-input" id="txtSmsSendSaleFile">
      <label class="custom-control-label" for="txtSmsSendSaleFile">Satış bilgileri dosyası gönderilsin</label>
    </div>
  </div> -->
  <!-- form group -->


  <button type="submit" class="btn btn-primary btnLoadingSms">Gönder</button>
  <a href="<?php echo $this->pathHtml; ?>tax/tax-list/" class="btn btn-danger">İptal</a>
</form>
