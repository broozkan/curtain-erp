$(document).ready(function () {

  /* clicking stock dates */
  $(".btnCommonAnalyseToday").on("click",function () {
    var d = new Date();
    var year = d.getFullYear();
    var month = ("0"+d.getMonth()+1).slice(-2);
    var today = ("0"+d.getDate()).slice(-2);

    $("#txtBeginningDate").val(""+year+"-"+month+"-"+today+"");
    $("#txtEndingDate").val(""+year+"-"+month+"-"+today+"");
  })

  $(".btnCommonAnalyseLastWeek").on("click",function () {
    var d = new Date();
    var year = d.getFullYear();
    var month = ("0"+d.getMonth()+1).slice(-2);
    var today = ("0"+d.getDate()).slice(-2);

    var lastWeekDay = (d.getDate() -7);
    lastWeekDay= ("0"+lastWeekDay).slice(-2);

    $("#txtBeginningDate").val(""+year+"-"+month+"-"+lastWeekDay+"");
    $("#txtEndingDate").val(""+year+"-"+month+"-"+today+"");
  })

  $(".btnCommonAnalyseLastMonth").on("click",function () {
    var d = new Date();
    var year = d.getFullYear();
    var month = ("0"+d.getMonth()).slice(-2);
    var today = ("0"+d.getDate()).slice(-2);

    $("#txtBeginningDate").val(""+year+"-"+month+"-"+today+"");
    $("#txtEndingDate").val(""+year+"-"+month+"-"+today+"");
  })

  $(".btnCommonAnalyseLastYear").on("click",function () {
    var d = new Date();
    var year = d.getFullYear();
    var lastYear = d.getFullYear() - 1;
    var month = ("0"+d.getMonth() + 1).slice(-2);
    var today = ("0"+d.getDate()).slice(-2);

    $("#txtBeginningDate").val(""+lastYear+"-"+month+"-"+today+"");
    $("#txtEndingDate").val(""+year+"-"+month+"-"+today+"");
  })
  /* clicking stock dates */



  /* get analyses */
  $("#frmCommonAnalyse").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("#frmCommonAnalyse").serializeJSON();
    var json = JSON.stringify(formValues);


    jQuery.ajax({
      type: "POST",
      url: "/analyse/common-analyse/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $("#frmCommonAnalyse").find("button[type=submit]").html('<span class="fa fa-spinner fa-spin fa-2x fa-fw"></span>');
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $("#frmCommonAnalyse").find("button[type=submit]").html('Getir');
        var ajaxResponse = $.parseJSON(response);

        if (ajaxResponse.response == true) {
          $(".spanTotalSaleAmount").html("0.00");
          $(".spanTotalSaleCostAmount").html("0.00");
          $(".spanTotalPaymentAmount").html("0.00");
          $(".spanTotalProfit").html("0.00");


          $(".tbl-total-sale tbody").html("");
          if (ajaxResponse.saleAnalyses) {
            for (var i = 0; i < ajaxResponse.saleAnalyses.length; i++) {
              var html = '<tr>';
              html += '<td>'+ajaxResponse.saleAnalyses[i]["employee_name"]+'</td>';
              html += '<td>'+ajaxResponse.saleAnalyses[i]["total_sale_sub_total"]+'</td>';
              html += '<td>'+ajaxResponse.saleAnalyses[i]["total_discount_total"]+'</td>';
              html += '<td>'+ajaxResponse.saleAnalyses[i]["total_sale_total"]+'</td>';
              html += '</tr>';
              $(".tbl-total-sale tbody").append(html);
              $(".spanTotalSaleAmount").html(ajaxResponse.totalSaleAmount);
            }
          }

          $(".tbl-total-sale-cost tbody").html("");
          if (ajaxResponse.saleCostAnalyses) {
            for (var i = 0; i < ajaxResponse.saleCostAnalyses.length; i++) {
              var html = '<tr>';
              html += '<td>'+ajaxResponse.saleCostAnalyses[i]["employee_name"]+'</td>';
              html += '<td>'+(ajaxResponse.saleCostAnalyses[i]["users_total_cost_amount"])+'</td>';
              html += '</tr>';
              $(".tbl-total-sale-cost tbody").append(html);
              $(".spanTotalSaleCostAmount").html(ajaxResponse.totalSaleCostAmount);
            }
          }

          $(".tbl-payments tbody").html("");
          if (ajaxResponse.paymentAnalyses) {
            for (var i = 0; i < ajaxResponse.paymentAnalyses.length; i++) {
              var html = '<tr>';
              html += '<td>'+ajaxResponse.paymentAnalyses[i]["category_name"]+'</td>';
              html += '<td>'+(ajaxResponse.paymentAnalyses[i]["total_payment_amount"])+'</td>';
              html += '</tr>';
              $(".tbl-payments tbody").append(html);

              $(".spanTotalPaymentAmount").html(ajaxResponse.totalPaymentAmount);
            }
          }

          if (ajaxResponse.totalProfit < 0) {
            $(".spanTotalProfit").html('<span class="text-danger" >'+ajaxResponse.totalProfit+'</span>');
          }else {
            $(".spanTotalProfit").html('<span class="text-success" >'+ajaxResponse.totalProfit+'</span>');
          }
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
    /* get analyses */

  })
})
