const myAjax = {
  myAjax: function (fileName, sendData) {
    $.ajax({
      type: "POST",
      url: "./php/"+fileName,
      dataType: "json",
      data: sendData,
      async: false,
    })
      .done(function (data) {
        ajaxReturnData = data;
      })
      .fail(function () {
        alert("DB connect error");
      });
  },
};
function ajaxSelSummary() {
  var fileName = "SelOrderSheet.php";
  var sendData = {
    search: "",
  };
  myAjax.myAjax(fileName, sendData);
  fillTableBody(ajaxReturnData, $("#summary__table tbody"));
};
function fillTableBody(data, tbodyDom) {
  $(tbodyDom).empty();
  data.forEach(function(trVal) {
      let newTr = $("<tr>");
      Object.keys(trVal).forEach(function(tdVal) {
        if (tdVal == "Position" || tdVal == "id") {
            $("<td>").html(trVal[tdVal]).appendTo(newTr);
        } else if (tdVal == "code_id") {
            $("<td>").append(errorCodeOption(trVal[tdVal])).appendTo(newTr);
        } else if (tdVal == "start_time" || tdVal == "end_time") {
            $("<td>")
                .append(makeTime(trVal[tdVal]))
                .appendTo(newTr);
        } else {
            $("<td>").html(trVal[tdVal]).appendTo(newTr);
        }
    });
      $(newTr).appendTo(tbodyDom);
  });
};

$(function () {
  ajaxSelSummary();
});

$(document).on("click", "#summary__table tr", function (e) {
  if (!$(this).hasClass("selected-record")) {
    $(this).parent().find("tr").removeClass("selected-record");
    $(this).addClass("selected-record");
    $("#selected__tr").removeAttr("id");
    $(this).attr("id", "selected__tr");
  } else {
    let ordersheetId = $(this).find("td").eq(0).html();
    let ordersheetNumber = $(this).find("td").eq(1).html();
    let product = $(this).find("td").eq(5).html();
    $(window.opener.document)
      .find("#order_sheet_id")
      .empty()
      .append($("<option>").val("0").html("No"))
      .append($("<option>").val(ordersheetId).html(ordersheetNumber));

      $(window.opener.document).find("#product_id").find("option").each(function(){
        if ($(this).val() == product)
          $(this).attr("selected","selected");
      });
      $(window.opener.document).find("#product_id").removeClass("no-input").addClass("complete-input");

    open("about:blank", "_self").close();
  }
});