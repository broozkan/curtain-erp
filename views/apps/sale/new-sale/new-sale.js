$(document).ready(function () {


  /* new sale submit */
  $("form#frmNewSale").on("submit",function (e) {
    e.preventDefault();

    var permission = true;

    var formValues = $("form#frmNewSale").serializeJSON();
    $("#frmNewSale input").each(function () {
      if ($(this).hasClass("input-search")) {
        if ($(this).val() != "") {
          if (!$(this).attr("data-id")) {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: "Lütfen boş alan bırakmayınız!"
            },{
              // settings
              type: 'danger'
            });
            permission = false;
            return false;
          }
          formValues[""+$(this).attr("name")+""] = $(this).attr("data-id");
        }
      }
    });

    if (permission == false) {
      return false;
    }

    var roomValuesArray = new Array();
    $(".rowRoom").each(function () {
      var roomValues = new Array();

      var roomName = $(this).find(".txtSaleItemRoomName").val();

      var brillantWidths = new Array();
      var brillantHeights = new Array();
      var storWidths = new Array();
      var storHeights = new Array();
      var storCodes = new Array();

      var productCategoryIds = new Array();
      var productIds = new Array();
      var productPurchasePrices = new Array();
      var productPieces = new Array();
      var productAmounts = new Array();
      var productTotals = new Array();

      $(this).find(".txtSaleItemProductCategoryId").each(function () {
        productCategoryIds.push($(this).attr("data-id"));
      });

      $(this).find(".txtSaleItemSaleProductId").each(function () {
        productIds.push($(this).attr("data-id"));
      });

      $(this).find(".txtSaleItemPurchasePrice").each(function () {
        productPurchasePrices.push($(this).val());
      });

      $(this).find(".txtSaleItemPiece").each(function () {
        productPieces.push($(this).val());
      });

      $(this).find(".txtSaleItemPrice").each(function () {
        productAmounts.push($(this).val());
      });

      $(this).find(".txtSaleItemTotal").each(function () {
        productTotals.push($(this).val());
      });


      $(this).find(".txtSaleItemBrillantWidth").each(function () {
        var saleItemBrillantWidth = $(this).val();
        var saleItemBrillantHeight = $(this).closest(".form-group").find(".txtSaleItemBrillantHeight").val();
        brillantWidths.push(saleItemBrillantWidth);
        brillantHeights.push(saleItemBrillantHeight);
      });

      $(this).find(".txtSaleItemStorWidth").each(function () {
        var saleItemStorWidth = $(this).val();
        var saleItemStorHeight = $(this).closest(".form-group").find(".txtSaleItemStorHeight").val();


        var storCode = $(this).closest(".rowRoom").find(".txtSaleItemStorCode").val();

        if (saleItemStorWidth != "") {
          if (storCode == "") {
            storCodes.push("-");
          }else {
            storCodes.push(storCode);
          }
        }else {
          storCodes.push("");
        }


        storWidths.push(saleItemStorWidth);
        storHeights.push(saleItemStorHeight);
      });

      var pileDensity = $(this).find(".txtSaleItemPileDensity").val();
      var roomDescription = $(this).find(".txtSaleItemDescription").val();

      roomValues = {
        "roomName":roomName,
        "brillantWidths":brillantWidths,
        "brillantHeights":brillantHeights,
        "storWidths":storWidths,
        "storHeights":storHeights,
        "storCodes":storCodes,
        "pileDensity":pileDensity,
        "roomDescription":roomDescription,
        "productCategoryIds":productCategoryIds,
        "productIds":productIds,
        "productPurchasePrices":productPurchasePrices,
        "productPieces":productPieces,
        "productAmounts":productAmounts,
        "productTotals":productTotals
      };

      roomValuesArray.push(roomValues);

    });



    formValues["roomValues"] = roomValuesArray;


    var json = JSON.stringify(formValues);


    var formData = new FormData();
    /* common file */
    var commonFile = document.getElementById("txtSaleCommonFile");
    if(commonFile.files[0] == "" || commonFile.files[0] == null){

    }else {
      formData.append("commonFile",commonFile.files[0]);
    }
    /* common file */

    /* room files */
    // $(".txtSaleItemFile").each(function () {
    //   var roomFile = $(this);
    //   if(roomFile.files[0] == "" || roomFile.files[0] == null){
    //
    //   }else {
    //     formData.append("roomFiles[]",roomFile.files[0]);
    //   }
    // })
    /* room files */


    formData.append("post",json);







    jQuery.ajax({
      type: "POST",
      url: "/sale/new-sale/",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $(".btnLoadingNewSale").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingNewSale").html("Kaydet");
        var ajaxResponse = $.parseJSON(response);
        if (ajaxResponse.response == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Başarılı bir şekilde kaydedildi!"
          },{
            // settings
            type: 'success'
          });
          window.location.href = '/sale/sale-profile/'+ajaxResponse.lastSaleId;
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: ajaxResponse.response
          },{
            // settings
            type: 'danger'
          });
        }
      }
    });
  })
  /* new sale submit */




})
