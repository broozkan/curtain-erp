$(document).ready(function () {

  var saleInvoiceId = $(".txtUpdateSaleInvoiceId").val();

  if (saleInvoiceId) {
    loadSaleInvoiceInformations(saleInvoiceId);
  }

})
