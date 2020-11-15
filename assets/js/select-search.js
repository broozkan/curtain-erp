$(document).ready(function () {


  $(document).on("click",".select2",function () {

    var selectSearch = new SelectSearch();

    var slct = $(this);
    var model = $(this).attr("object");
    model = supplier;
    selectSearch.loadSelect(model,slct);

  })

})



class SelectSearch {


  /* loading data */
  loadSelect(model,select) {

    var modelUrl = model.replace("_", "-");

    var json = {
      "model":model
    }
    json = JSON.stringify(json);

    jQuery.ajax({
      type: "POST",
      url: "/"+modelUrl+"/"+modelUrl+"-select-search/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        select.append("<option value='' disabled selected>Yükleniyor...</option>");

      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(ajaxResponse)
      {
        select.html("");



        var ajaxResponse = $.parseJSON(ajaxResponse);
        if (ajaxResponse.data) {

          for (var i = 0; i < ajaxResponse.data.length; i++) {


            var data = {
                id: ajaxResponse.data[i][""+model+"_id"],
                text: ajaxResponse.data[i][""+model+"_name"]
            };
            alert(data);
            var newOption = new Option(data.text, data.id, false, false);
            select.append(newOption).trigger('change');

            // var html = '<option value="'+ajaxResponse.data[i][""+model+"_id"]+'">'+ajaxResponse.data[i][""+model+"_name"]+'</option>';
            // select.append(html);
          }

          // select.select();
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
  }
  /* loading data */


}
