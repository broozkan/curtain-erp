$(document).ready(function () {

  var purchaseInvoiceId = $(".txtUpdatePurchaseInvoiceId").val();

  if (purchaseInvoiceId) {
    loadPurchaseInvoiceInformations(purchaseInvoiceId);
  }

})
