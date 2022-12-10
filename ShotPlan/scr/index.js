let deleteDialog = document.getElementById("delete__dialog");
let inputData = new Object();
let fileName;
let sendData = new Object();
let ajaxReturnData;
let line_id = 2;
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
$(function() {
  var formatDateComponent = function(dateComponent) {
    return (dateComponent < 10 ? '0' : '') + dateComponent;
  };
  var formatDate = function(date) {
    return date.getFullYear()  + '-' + formatDateComponent(date.getMonth() + 1) + '-' + formatDateComponent(date.getDate()) ;
  };
  var a = new Date();
  $("#plan_start").val(formatDate(new Date(a.setDate(a.getDate() - 5))))
  $("#plan_end").val(formatDate(new Date(a.setDate(a.getDate() + 10))))

  makeSummaryTable();
  makeProductionNumber();
});
$(document).on("keyup", "#production_number", function (e) {
  var fileName = "SelProduct.php";
  var sendData = {
    production_number: $(this).val(),
  };
  myAjax.myAjax(fileName, sendData);
  fillTableBody(ajaxReturnData, $("#production__table tbody"));
});
function makeProductionNumber() {
  var fileName = "SelProduct.php";
  var sendData = {
    production_number: $("#production_number").val(),
  };
  myAjax.myAjax(fileName, sendData);
  fillTableBody(ajaxReturnData, $("#production__table tbody"));
}
function makeSummaryTable() {
  var fileName = "SelSummary.php";
  var sendData = {
    start : $("#plan_start").val(),
    end : $("#plan_end").val(),
    product_name : $("#product_name").val(),
  };
  myAjax.myAjax(fileName, sendData);
  fillTableBody(ajaxReturnData, $("#summary__table tbody"));
};
function fillTableBody(data, tbodyDom) {
  $(tbodyDom).empty();
    data.forEach(function(trVal) {
      var newTr = $("<tr>");
      Object.keys(trVal).forEach(function(tdVal) {
          if (tdVal == "machine_id") {
              $("<td>").append(makeMachineSel(trVal[tdVal])).appendTo(newTr);
          } else if (tdVal == "product_date") {
              $("<td>")
                  .append(makeDatePlan(trVal[tdVal])).appendTo(newTr);
          } else if ((tdVal == "quantity")||(tdVal == "note")||(tdVal == "ordinal")) {
              $("<td>")
                  .append(makeInput(trVal[tdVal])).appendTo(newTr);
          } else {
              $("<td>").html(trVal[tdVal]).appendTo(newTr);
          }
      });
      $(newTr).appendTo(tbodyDom);
  });
};
function makeMachineSel(seletedId) {
  let targetDom = $("<select>");

  fileName = "SelMachine.php";
  sendData = {
  };
  myAjax.myAjax(fileName, sendData);

  ajaxReturnData.forEach(function(element) {
      if (element["id"] == seletedId) {
          $("<option>")
              .html(element["machine"])
              .val(element["id"])
              .prop("selected", true)
              .appendTo(targetDom);
      } else {
          $("<option>")
              .html(element["machine"])
              .val(element["id"])
              .appendTo(targetDom);
      }
  });
  return targetDom;
}
function makeDatePlan(datePlan) {
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
$(document).on("change", "#shot_date_at", function (e) {
  if ($(this).val() != 0 && $(this).val() != "") {
    $(this).removeClass("no-input").addClass("complete-input");
  } else {
    $(this).removeClass("complete-input").addClass("no-input");
  }
  checkSave();
});
$(document).on("keyup", "#product_name", function (e) {
  makeSummaryTable();
});
function checkSave() {
  if ($("#add__table tbody tr").length==0 || $("#shot_date_at").val()=="") {
    $("#save__button").prop("disabled", true);
  } else {
    $("#save__button").prop("disabled", false);
  }
};
$(document).on("change", "#plan_start", function (e) {
  makeSummaryTable();
});
$(document).on("change", "#plan_end", function (e) {
  makeSummaryTable();
});
$(document).on("click", "#summary__table tbody tr", function (e) {
  if (!$(this).hasClass("selected-record")) {
    $(this).parent().find("tr").removeClass("selected-record");
    $(this).parent().find("tr").removeClass("same-date");
    $(this).addClass("selected-record");
    $("#selected__tr").removeAttr("id");
    $(this).attr("id", "selected__tr");
    $("#selected__tr td:nth-child(3) input").attr("id", "selected__date");
    var plDate = $(this).find("td input").val();
    console.log(plDate);
    $("#summary__table tbody tr").each(function (index, element) {
      if ($(this).find("td input").val() == plDate) {
        $(this).addClass("same-date");
      } else {
        $(this).removeClass("same-date");
      }
    });
  } else {
    deleteDialog.showModal();
  }
});
$(document).on("click", "#production__table tbody tr", function (e) {
  if (!$(this).hasClass("selected-record")) {
    $(this).parent().find("tr").removeClass("selected-record");
    $(this).addClass("selected-record");
    $("#selected__tr").removeAttr("id");
    $(this).attr("id", "selected__tr");
  } else {
    let pro_id = $(this).find("td:nth-child(1)").html();
    let pro = $(this).find("td:nth-child(2)").html();
      var newTr = $("<tr>");
      $("<td>").html(pro_id).appendTo(newTr);
      $("<td>").html(pro).appendTo(newTr);
      $("<td>").append(makeMachineSel("")).appendTo(newTr);
      $("<td>").append(makeInput("0")).appendTo(newTr);
      $("<td>").append(makeInput("")).appendTo(newTr);
      $(newTr).appendTo("#add__table tbody");
      // $(this).remove();
  }
  checkSave();
});
$(document).on("click", "#add__table tbody tr", function (e) {
  if (!$(this).hasClass("selected-record")) {
    $(this).parent().find("tr").removeClass("selected-record");
    $(this).addClass("selected-record");
    $("#selected__tr").removeAttr("id");
    $(this).attr("id", "selected__tr");
  } else {
      // $(this).remove();
  }
  checkSave();
});
function getTableDataInput(tableTrObj) {
  var tableData = [];
  tableTrObj.each(function (index, element) {
    var tr = [];
    $(this).find("td")
      .each(function (index, element) {
          if ($(this).find("select").length) {
              tr.push($(this).find("select").val());
          } else if ($(this).find("input").length) {
              tr.push($(this).find("input").val());
          } else {
              tr.push($(this).html());
          }
      });
      tableData.push(tr);
  });
  return tableData;
};
$(document).on("click", "#delete-dialog-cancel__button", function () {
  deleteDialog.close();
});

$(document).on("click", "#delete-dialog-delete__button", function () {
  var fileName = "DelPlan.php";
  var sendData = {
    targetId : $("#selected__tr td:nth-child(1)").html(),
  };
  myAjax.myAjax(fileName, sendData);
  deleteDialog.close();
  makeSummaryTable();
});
$(document).on("click", "#save__button", function () {
  var fileName = "InsshotPlan.php";
  tableData = getTableDataInput($("#add__table tbody tr"))
    console.log(tableData); 
    jsonData = JSON.stringify(tableData);
    var sendData = {
        data : jsonData,
        shot_date_at : $("#shot_date_at").val(),
    };
    console.log(sendData);
  myAjax.myAjax(fileName, sendData);
  makeSummaryTable();
  clearInputData();
});
$(document).on("change", "#summary__table tbody tr td", function () {
  let sendData = new Object();
  let fileName;
  fileName = "UpdateData.php";
  sendData = {
    targetId : $("#selected__tr td:nth-child(1)").html(),
    date_plan : $("#selected__date").val(),
    machine_id : $("#selected__tr td:nth-child(5) select").val(),
    quantity : $("#selected__tr td:nth-child(6) input").val(),
    note : $("#selected__tr td:nth-child(7) input").val(),
  };
  console.log(sendData);
  myAjax.myAjax(fileName, sendData);
  makeSummaryTable();
});
function clearInputData() {
  $("#add__table tbody tr").remove();
}