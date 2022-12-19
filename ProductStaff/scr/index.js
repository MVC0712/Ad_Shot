let deleteDialog = document.getElementById("delete__dialog");
let inputData = new Object();
let fileName;
let sendData = new Object();
let ajaxReturnData;
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
  selStaff();
  selProduct();
  selPosition();
});
function selStaff() {
  var fileName = "SelStaff.php";
  var sendData = {
  };
  myAjax.myAjax(fileName, sendData);
  fillTableBody(ajaxReturnData, $("#staff tbody"));
};
function selProduct() {
  var fileName = "SelProduct.php";
  var sendData = {
  };
  myAjax.myAjax(fileName, sendData);
  fillTableBody(ajaxReturnData, $("#product tbody"));
};
function fillTableBody(data, tbodyDom) {
  $(tbodyDom).empty();
  data.forEach(function(trVal) {
      let newTr = $("<tr>");
      Object.keys(trVal).forEach(function(tdVal) {
        if (tdVal == "position_id") {
          $("<td>").append(makePosition(trVal[tdVal])).appendTo(newTr);
        } else if ((tdVal == "name") || (tdVal == "code") || (tdVal == "product_name")) {
          $("<td>").append(makeInput(trVal[tdVal])).appendTo(newTr);
        } else if (tdVal == "join_date" || tdVal == "leave_date") {
          $("<td>").append(makeDate(trVal[tdVal])).appendTo(newTr);
        } else {
            $("<td>").html(trVal[tdVal]).appendTo(newTr);
        }
    });
      $(newTr).appendTo(tbodyDom);
  });
};
function selPosition() {
  var fileName = "SelPosition.php";
  var sendData = {
  };
  myAjax.myAjax(fileName, sendData);
  $("#position_id option").remove();
  $("#position_id").append($("<option>").val(0).html("NO"));
  ajaxReturnData.forEach(function(value) {
      $("#position_id").append(
          $("<option>").val(value["id"]).html(value["position"])
      );
  });
};
function makePosition(seletedId) {
  let targetDom = $("<select>");
  fileName = "SelPosition.php";
  sendData = {
  };
  myAjax.myAjax(fileName, sendData);
  ajaxReturnData.forEach(function(element) {
      if (element["id"] == seletedId) {
          $("<option>")
              .html(element["position"])
              .val(element["id"])
              .prop("selected", true)
              .appendTo(targetDom);
      } else {
          $("<option>")
              .html(element["position"])
              .val(element["id"])
              .appendTo(targetDom);
      }
  });
  return targetDom;
}
function makeDate(datePlan) {
  let targetDom = $("<input>");
  targetDom.attr("type", "date");
  targetDom.val(datePlan);
  return targetDom;
}
function makeInput(qty) {
  let targetDom = $("<input>");
  targetDom.attr("type", "text");
  targetDom.val(qty);
  return targetDom;
}
$(document).on("click", "#staff tbody tr", function (e) {
  if (!$(this).hasClass("selected-record")) {
    $(this).parent().find("tr").removeClass("selected-record");
    $(this).addClass("selected-record");
    $("#staff__tr").removeAttr("id");
    $(this).attr("id", "staff__tr");
  } else {
  }
});
$(document).on("click", "#product tbody tr", function (e) {
  if (!$(this).hasClass("selected-record")) {
    $(this).parent().find("tr").removeClass("selected-record");
    $(this).addClass("selected-record");
    $("#product__tr").removeAttr("id");
    $(this).attr("id", "product__tr");
  } else {
  }
});
$(document).on("change keyup", ".save-data-product", function() {
  if ($(this).val() != ""||$(this).val() != 0) {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInputProduct();
});
$(document).on("change keyup", ".save-data-staff", function() {
  if ($(this).val() != ""||$(this).val() != 0) {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInputStaff();
});
function getStaffData() {
  let inputData = new Object();
    $(".down__wrapper input.save-data-staff").each(function (index, element) {
      inputData[$(this).attr("id")] = $(this).val();
    });
    $(".down__wrapper select.save-data-staff").each(function (index, element) {
      inputData[$(this).attr("id")] = $(this).val();
    });
    console.log(inputData);
  return inputData;
};
function getProductData() {
  let inputData = new Object();
    $(".top__wrapper input.save-data-product").each(function (index, element) {
      inputData[$(this).attr("id")] = $(this).val();
    });
    $(".top__wrapper select.save-data-product").each(function (index, element) {
      inputData[$(this).attr("id")] = $(this).val();
    });
    console.log(inputData);
  return inputData;
}
function clearInputData() {
  $("input.need-clear").each(function (index, element) {
    $(this).val("").removeClass("complete-input").addClass("no-input");
  });
  $("select.need-clear").each(function (index, element) {
    $(this).val("0").removeClass("complete-input").addClass("no-input");
  });
};
$(document).on("click", "#save_staff", function () {
  fileName = "InsDataStaff.php";
  inputData = getStaffData();
  sendData = inputData;
  myAjax.myAjax(fileName, sendData);
  clearInputData();
  selStaff();
  $("#save_staff").attr("disabled", true);
});
$(document).on("click", "#save_product", function () {
  fileName = "InsDataProduct.php";
  inputData = getProductData();
  sendData = inputData;
  myAjax.myAjax(fileName, sendData);
  clearInputData();
  selProduct();
  $("#save_product").attr("disabled", true);
});
$(document).on("change", "#product tbody tr td", function () {
  let sendData = new Object();
  let fileName;
  fileName = "UpdateProductData.php";
  sendData = {
    targetId : $("#product__tr td:nth-child(1)").html(),
    product_name : $("#product__tr td:nth-child(2) input").val(),
  };
  myAjax.myAjax(fileName, sendData);
  selProduct();
});
$(document).on("change", "#staff tbody tr td", function () {
  let sendData = new Object();
  let fileName;
  fileName = "UpdateStaffData.php";
  sendData = {
    targetId : $("#staff__tr td:nth-child(1)").html(),
    name : $("#staff__tr td:nth-child(2) input").val(),
    code : $("#staff__tr td:nth-child(3) input").val(),
    position_id : $("#staff__tr td:nth-child(4) select").val(),
    join_date : $("#staff__tr td:nth-child(5) input").val(),
    leave_date : $("#staff__tr td:nth-child(6) input").val(),
  };
  myAjax.myAjax(fileName, sendData);
  selStaff();
});
function putDataToInput(data) {
    data.forEach(function (trVal) {
      Object.keys(trVal).forEach(function (tdVal) {
        $("#" + tdVal).val(trVal[tdVal]); 
      });
  });
};
function checkInputProduct() {
  let check_product = true;
  $(".save-data-product").each(function() {
    if ($(this).hasClass("no-input")) {
      check_product = false;
    }
  });
  if (check_product) {
    $("#save_product").attr("disabled", false);
  } else {
    $("#save_product").attr("disabled", true);
  } 
  return check_product;
};
function checkInputStaff() {
  let check_staff = true;
  $(".save-data-staff").each(function() {
    if ($(this).hasClass("no-input")) {
      check_staff = false;
    }
  });
  if (check_staff) {
    $("#save_staff").attr("disabled", false);
  } else {
    $("#save_staff").attr("disabled", true);
  } 
  return check_staff;
};