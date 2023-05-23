let deleteDialog = document.getElementById("delete__dialog");
let inputData = new Object();
let fileName;
let sendData = new Object();
let ajaxReturnData;
let line_id = 1;
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

const getTwoDigits = (value) => value < 10 ? `0${value}` : value;
const getDateTime = (date) => {
    const day = getTwoDigits(date.getDate());
    const month = getTwoDigits(date.getMonth() + 1);
    const year = date.getFullYear();
    const hours = getTwoDigits(date.getHours());
    const mins = getTwoDigits(date.getMinutes());
    return `${year}-${month}-${day} ${hours}:${mins}:00`;
}
$(function () {
  makeSummaryTable();
  selProduct();
});
function makeSummaryTable() {
  var fileName = "SelSummary.php";
  var sendData = {
      dummy: "dummy",
  };
  myAjax.myAjax(fileName, sendData);
  fillTableBody(ajaxReturnData, $("#summary_table tbody"));
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
function selProduct() {
  var fileName = "SelProduct.php";
  var sendData = {
  };
  myAjax.myAjax(fileName, sendData);
  $("#product_id option").remove();
  $("#product_id").append($("<option>").val(0).html("NO"));
  ajaxReturnData.forEach(function(value) {
      $("#product_id").append(
          $("<option>").val(value["id"]).html(value["product_name"])
      );
  });
};
$(document).on("change", "#product_id", function() {
  if ($(this).val() != 0) {
    var fileName = "SelProductId.php";
    var sendData = {
      id : $("#product_id").val(),
    };
    myAjax.myAjax(fileName, sendData);
    $("#area").val(ajaxReturnData[0]["area"]);
    $("#current_density").val(ajaxReturnData[0]["current_density"]);
    $("#cond_no").val(ajaxReturnData[0]["cond_no"]);
    $("#total_current").val(Math.round((($("#area").val())*($("#current_density").val())*($("#quantity").val()) + Number.EPSILON) * 100) / 100);
    $("#total_area").val(Math.round((($("#area").val())*($("#quantity").val()) + Number.EPSILON) * 100) / 100);
  } else {
    $("#area").val("")
    $("#current_density").val("")
    $("#cond_no").val("")
    $("#total_current").val("")
    $("#total_area").val("")
  }
});
$(document).on("keyup", "#quantity", function() {
    $("#total_current").val(Math.round((($("#area").val())*($("#current_density").val())*($("#quantity").val()) + Number.EPSILON) * 100) / 100);
    $("#total_area").val(Math.round((($("#area").val())*($("#quantity").val()) + Number.EPSILON) * 100) / 100);
});
$(document).on("click", "#summary_table tbody tr", function (e) {
  let fileName = "SelUpdateData.php";
  let sendData;
  if (!$(this).hasClass("selected-record")) {
    $(this).parent().find("tr").removeClass("selected-record");
    $(this).addClass("selected-record");
    $("#selected__tr").removeAttr("id");
    $(this).attr("id", "selected__tr");
    sendData = {
      targetId: $("#selected__tr").find("td").eq(0).html(),
    };
    myAjax.myAjax(fileName, sendData);
    putDataToInput(ajaxReturnData);
  } else {
  }
  $("#save").attr("disabled", true);
  $("#update").attr("disabled", false);
  $(".save-data").each(function (index, element) {
    $(this).removeClass("no-input").addClass("complete-input");
  });
});
$(document).on("change keyup", ".save-data", function() {
  if ($(this).val() != ""||$(this).val() != 0) {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
});
function getInputData() {
  let inputData = new Object();
    $(".top__wrapper input.save-data").each(function (index, element) {
      inputData[$(this).attr("id")] = $(this).val();
    });
    $(".top__wrapper select.save-data").each(function (index, element) {
      inputData[$(this).attr("id")] = $(this).val();
    });
  return inputData;
}
function clearInputData() {
  $(".top__wrapper input.need-clear").each(function (index, element) {
    $(this).val("").removeClass("complete-input").addClass("no-input");
  });
  $(".top__wrapper select.need-clear").each(function (index, element) {
    $(this).val("0").removeClass("complete-input").addClass("no-input");
  });
  $("#note").val("").removeClass("no-input").addClass("complete-input");
};
$(document).on("click", "#save", function () {
  fileName = "InsData.php";
  inputData = getInputData();
  sendData = inputData;
  myAjax.myAjax(fileName, sendData);
  clearInputData();
  makeSummaryTable();
  $("#save").attr("disabled", true);
  $("#update").attr("disabled", true);
});
$(document).on("click", "#update", function () {
  fileName = "UpdateData.php";
  inputData = getInputData();
  inputData["targetId"] = $("#selected__tr").find("td").eq(0).html();
  sendData = inputData;
  myAjax.myAjax(fileName, sendData);
  clearInputData();
  makeSummaryTable();
  $("#save").attr("disabled", true);
  $("#update").attr("disabled", true);
});
function putDataToInput(data) {
    data.forEach(function (trVal) {
      Object.keys(trVal).forEach(function (tdVal) {
        $("#" + tdVal).val(trVal[tdVal]); 
      });
  });
};
function checkInput() {
  let check = true;
  $(".save-data").each(function() {
    if ($(this).hasClass("no-input")) {
      check = false;
    }
  });
  if ($("#summary_table tbody tr").hasClass("selected-record")) {
    check = false;
  }
  if (check) {
    $("#save").attr("disabled", false);
  } else {
    $("#save").attr("disabled", true);
  } 
  return check;
};
function checkUpdate() {
  let check = true;
  $(".save-data").each(function() {
    if ($(this).hasClass("no-input")) {
      check = false;
    }
  });
  if (!$("#summary_table tbody tr").hasClass("selected-record")) {
    check = false;
  }
  if (check) {
    $("#update").attr("disabled", false);
  } else {
    $("#update").attr("disabled", true);
  } 
  return check;
};