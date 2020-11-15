$(document).ready(function () {

  $(document).on("click",".btnInputResult",function () {
    var resultId = $(this).closest("li").attr("id");
    var resultName = $(this).closest("li").find(".spanResultName").html();
    $(this).closest("div.form-group").find("input").val(resultName);
    $(this).closest("div.form-group").find("input").attr("data-id",resultId);
    $(this).closest("div.form-group").find("input").trigger("select");
    $(this).closest("div.form-group").find("ul.list-group").remove();

  });


  $(document).on("input",".input-search",function () {
    if ($(this).val() == "") {
      $(this).closest("div.form-group").find("ul.list-group").remove();
      $(this).attr("data-id","");
      return false;
    }
    var input =$(this);
    var table = $(this).attr("table");
    var model = $(this).attr("model");
    var property = $(this).attr("property");
    var arg = $(this).val();
    var click = $(this).attr("click");
    var inputSearch = new InputSearch();

    inputSearch.search(input,table,model,property,arg,click);
  })
})


class InputSearch {


  search(input, table, model, property, arg, click=false) {

    var modelUrl = model.replace("_", "-");
    var json = {
      "table":table,
      "model":model,
      "property":property,
      "arg":arg
    }
    json = JSON.stringify(json);

    jQuery.ajax({
      type: "POST",
      url: "/search/input-search/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        input.closest("div").find(".spanInputSearchLoading").removeClass("d-none");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(ajaxResponse)
      {
        $(".list-group-flush").remove();
        var ajaxResponse = $.parseJSON(ajaxResponse);
        input.closest("div").find(".spanInputSearchLoading").addClass("d-none");
        var html = '<ul class="list-group list-group-flush">';
        for (var i = 0; i < ajaxResponse.results.length; i++) {
          if (click == "true") {
            html += '<li class="list-group-item" id="'+ajaxResponse.results[i][""+model+"_id"]+'"><span class="spanResultName">'+ajaxResponse.results[i][""+model+"_"+property+""]+'</span> <button class="btn btn-primary btn-xs float-right btnInputResult"><span class="fa fa-arrow-right"></span></button> </li>';
          }else {
            html += '<li class="list-group-item" id="'+ajaxResponse.results[i][""+model+"_id"]+'"><span class="spanResultName">'+ajaxResponse.results[i][""+model+"_"+property+""]+'</span></li>';
          }
        }
        html += '</ul>';

        input.after(html);
      }
    });
  }
}
