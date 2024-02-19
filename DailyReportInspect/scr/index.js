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
const getToday = (date) => {
    const day = getTwoDigits(date.getDate());
    const month = getTwoDigits(date.getMonth() + 1);
    const year = date.getFullYear();
    return `${year}-${month}-${day}`;
}
$(function () {
  makeSummaryTable();
  makeSelStaff();
  selStopHumanCode();
  selInspectError();
  selShift();
  selMachine();
  selProduct();
  var now = new Date();
  var MonthLastDate = new Date(now.getFullYear(), now.getMonth() + 1, 0);
  var MonthFirstDate = new Date(now.getFullYear(), (now.getMonth() + 12) % 12, 1);
  var formatDateComponent = function(dateComponent) {
    return (dateComponent < 10 ? '0' : '') + dateComponent;
  };

  var formatDate = function(date) {
    return date.getFullYear().toString().substr(-2);  + '-' + formatDateComponent(date.getMonth() + 1) + '-' + formatDateComponent(date.getDate()) ;
  };

});
function makeSummaryTable() {
  if ($("#start").val() == "") {
    st = "2022-01-01"
  } else {
    st = $("#start").val();
  }
  if ($("#end").val() == "") {
    en = "2050-01-01"
  } else {
    en = $("#end").val();
  }
  var fileName = "SelSummary.php";
  var sendData = {
      start: st,
      end: en,
      product_name: $("#pro_code").val()
  };
  myAjax.myAjax(fileName, sendData);
  fillTableBody(ajaxReturnData, $("#summary_table tbody"));
};
function makeMachineRuntime() {
  var fileName = "SelMachineRuntime.php";
  var sendData = {
      targetId: $("#selected__tr").find("td").eq(0).html(),
  };
  myAjax.myAjax(fileName, sendData);
  fillTableBody(ajaxReturnData, $("#machine_error_table tbody"));
};
function makeInspectError() {
  var fileName = "SelInspectError.php";
  var sendData = {
      targetId: $("#selected__tr").find("td").eq(0).html(),
  };
  myAjax.myAjax(fileName, sendData);
  fillTableBody(ajaxReturnData, $("#inspect_error_table tbody"));
};
function makeStopHuman() {
  var fileName = "SelStopHuman.php";
  var sendData = {
    targetId: $("#selected__tr").find("td").eq(0).html(),
  };
  myAjax.myAjax(fileName, sendData);
  fillTableBody(ajaxReturnData, $("#stop_human_table tbody"));
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
        } else if (tdVal == "inspect_error_id") {
          $("<td>").append(inspectErrorCodeOption(trVal[tdVal])).appendTo(newTr);
        } else if (tdVal == "start_time" || tdVal == "end_time") {
            $("<td>").append(makeTime(trVal[tdVal])).appendTo(newTr);
        } else if (tdVal == "ng_quantityy") {
          $("<td>").append(makeInput(trVal[tdVal])).appendTo(newTr);
        } else {
            $("<td>").html(trVal[tdVal]).appendTo(newTr);
        }
    });
      $(newTr).appendTo(tbodyDom);
  });
};
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
    $("#add_machine_error").text("Add");
    $("#add_stop_human").text("Add");
    $("#add_inspect_error").text("Add");
  } else {
    // deleteDialog.showModal();
  }
  $("#save").attr("disabled", true);
  $("#update").attr("disabled", false);
  makeMachineRuntime();
  makeStopHuman();
  makeInspectError();
  $(".save-data").each(function (index, element) {
    $(this).removeClass("no-input").addClass("complete-input");
  });
});
function selStopHumanCode() {
  var fileName = "SelCode.php";
  var sendData = {
  };
  myAjax.myAjax(fileName, sendData);
  $("#stop_human_code option").remove();
  $("#stop_human_code").append($("<option>").val(0).html("NO"));
  ajaxReturnData.forEach(function(value) {
      $("#stop_human_code").append(
          $("<option>").val(value["id"]).html(value["code"])
      );
  });
};
function selInspectError() {
  var fileName = "SelInspectErrorCode.php";
  var sendData = {
  };
  myAjax.myAjax(fileName, sendData);
  $("#inspect_error_id option").remove();
  $("#inspect_error_id").append($("<option>").val(0).html("NO"));
  ajaxReturnData.forEach(function(value) {
      $("#inspect_error_id").append(
          $("<option>").val(value["id"]).html(value["code"])
      );
  });
};
function selShift() {
  var fileName = "SelShift.php";
  var sendData = {
  };
  myAjax.myAjax(fileName, sendData);
  $("#shift_id option").remove();
  $("#shift_id").append($("<option>").val(0).html("NO"));
  ajaxReturnData.forEach(function(value) {
      $("#shift_id").append(
          $("<option>").val(value["id"]).html(value["shift"])
      );
  });
};
function selMachine() {
  var fileName = "SelMachine.php";
  var sendData = {
  };
  myAjax.myAjax(fileName, sendData);
  $("#machine_id option").remove();
  $("#machine_id").append($("<option>").val(0).html("NO"));
  ajaxReturnData.forEach(function(value) {
      $("#machine_id").append(
          $("<option>").val(value["id"]).html(value["machine"])
      );
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
function makeSelStaff() {
  var fileName = "SelStaff.php";
  var sendData = {
  };
  myAjax.myAjax(fileName, sendData);
  stafSelect(ajaxReturnData, "worker_id", 2);
  stafSelect(ajaxReturnData, "confirm_id", 1);
};
function stafSelect(data, dom, pos) {
  $("#" + dom + " > option").remove();
  $("#" + dom).append($("<option>").val(0).html("NO select"));
  data.forEach(function(value) {
      if (pos == 2) {
          $("#" + dom).append(
              $("<option>").val(value["id"]).html(value["name"])
          );
      } else {
          if (value.position_id == 1) {
              $("#" + dom).append(
                  $("<option>").val(value["id"]).html(value["name"])
              );
          }
      };
  });
};
$(document).on("change keyup", "input[type='date']", function() {
  makeSummaryTable();
});
$(document).on("change keyup", "#pro_code", function() {
  makeSummaryTable();
});
$(document).on("change keyup", ".save-data", function() {
  if ($(this).val() != ""||$(this).val() != 0) {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
});
$(document).on("change keyup", ".need-check", function() {
  if ($(this).val() != ""||$(this).val() != 0) {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  addMachineError();
  addStopHuman();
  addInspectError();
});

$(document).on("keyup", ".number-input", function() {
  if($.isNumeric($(this).val())){
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
});

function getTableData(tableTrObj) {
  var tableData = [];
  tableTrObj.each(function (index, element) {
    var tr = [];
    $(this)
      .find("td")
      .each(function (index, element) {
        if ($(this).find("input").length) {
          tr.push($(this).find("input").val());
        } else if ($(this).find("select").length) {
          tr.push($(this).find("select").val());
        } else {
          tr.push($(this).html());
        }
      });
    tableData.push(tr);
  });
  return tableData;
}
$("#file_upload").on("change", function () {
  var file = $(this).prop("files")[0];
  console.log(file.name);
  $("#file_url").html(file.name);
  $("#preview__button").prop("disabled", false);
  readNewFile = true;
});
$(document).on("click", "#preview__button", function () {

      window.open("./DailyReportSub.html");
  
});
$("#add_machine_error").on("click", function () {
  switch ($(this).text()) {
    case "Save":
      $("<tr>")
        .append("<td></td>")
        .append($("<td>").append(makeTime($("#machine_error_start_time").val())))
        .append($("<td>").append(makeTime($("#machine_error_end_time").val())))
        .append($("<td>").append(makeTimeDiff($("#machine_error_end_time").val(), $("#machine_error_start_time").val())))
        .appendTo("#machine_error_table tbody");
      $(this).prop("disabled", true);
      $("#machine_error_start_time").val("").focus().removeClass("complete-input").addClass("no-input");
      $("#machine_error_end_time").val("").removeClass("complete-input").addClass("no-input");
    break;
    case "Add":
      let fileName;
      let sendData = new Object();
      fileName = "AddMachineRuntime.php";
      sendData = {
        record_inspect_id: $("#selected__tr td:nth-child(1)").text(),
        machine_error_start_time: $("#machine_error_start_time").val(),
        machine_error_end_time: $("#machine_error_end_time").val(),
      };
      myAjax.myAjax(fileName, sendData);
      makeMachineRuntime();
      $("#machine_error_start_time").val("").focus().removeClass("complete-input").addClass("no-input");
      $("#machine_error_end_time").val("").removeClass("complete-input").addClass("no-input");
      $(this).prop("disabled", true);
    break;
  }
});
$(document).on("click", "#machine_error_table tbody tr", function() {
  if (!$(this).hasClass("selected-record")) {
      $(this).parent().find("tr").removeClass("selected-record");
      $(this).addClass("selected-record");
      $("#machine_error_selected").removeAttr("id");
      $(this).attr("id", "machine_error_selected");
  } else {
  }
});
$(document).on("change", "#machine_error_table tbody tr", function () {
  let sendData = new Object();
  let fileName;
  fileName = "UpdateMachineRuntime.php";
  sendData = {
    id: $("#machine_error_selected td:nth-child(1)").html(),
    machine_error_start_time: $("#machine_error_selected td:nth-child(2) input").val(),
    machine_error_end_time: $("#machine_error_selected td:nth-child(3) input").val(),
  };
  console.log(sendData);
  myAjax.myAjax(fileName, sendData);
  makeMachineRuntime();
});

$("#add_inspect_error").on("click", function () {
  switch ($(this).text()) {
    case "Save":
      $("<tr>")
        .append("<td></td>")
        .append($("<td>").append(inspectErrorCodeOption($("#inspect_error_id").val())))
        .append($("<td>").append($("#ng_quantity").val()))
        .appendTo("#inspect_error_table tbody");
      $(this).prop("disabled", true);
      $("#inspect_error_id").val("").focus().removeClass("complete-input").addClass("no-input");
      $("#ng_quantity").val("").removeClass("complete-input").addClass("no-input");
    break;
    case "Add":
      let fileName;
      let sendData = new Object();
      fileName = "AddInspectError.php";
      sendData = {
        record_inspect_id: $("#selected__tr td:nth-child(1)").text(),
        inspect_error_id: $("#inspect_error_id").val(),
        ng_quantity: $("#ng_quantity").val(),
      };
      myAjax.myAjax(fileName, sendData);
      makeInspectError();
      $("#inspect_error_id").val("").focus().removeClass("complete-input").addClass("no-input");
      $("#ng_quantity").val("").removeClass("complete-input").addClass("no-input");
      $(this).prop("disabled", true);
    break;
  }
});
$(document).on("click", "#inspect_error_table tbody tr", function() {
  if (!$(this).hasClass("selected-record")) {
      $(this).parent().find("tr").removeClass("selected-record");
      $(this).addClass("selected-record");
      $("#inspect_error_selected").removeAttr("id");
      $(this).attr("id", "inspect_error_selected");
  } else {
  }
});
$(document).on("change", "#inspect_error_table tbody tr", function () {
  let sendData = new Object();
  let fileName;
  fileName = "UpdateInspectError.php";
  sendData = {
    id: $("#inspect_error_selected td:nth-child(1)").html(),
    inspect_error_id: $("#inspect_error_selected td:nth-child(2) select").val(),
    ng_quantity: $("#inspect_error_selected td:nth-child(3) input").val(),
  };
  console.log(sendData);
  myAjax.myAjax(fileName, sendData);
  makeInspectError();
});
function addInspectError() {
  if ($("#inspect_error_id").val() == 0 ||
      !$.isNumeric($("#ng_quantity").val())) {
      $("#add_inspect_error").prop("disabled", true);
  } else {
      $("#add_inspect_error").prop("disabled", false);
  }
};
$(document).on("change", "#start", function () {
  downloadButton()
});
$(document).on("change", "#end", function () {
  downloadButton()
});
function downloadButton() {
  if ($("#start").val() == "" || $("#end").val() == "") {
      $("#download").prop("disabled", true);
      $("#download_ng").prop("disabled", true);
  } else {
      $("#download").prop("disabled", false);
      $("#download_ng").prop("disabled", false);
  }
};
$("#add_stop_human").on("click", function () {
  switch ($(this).text()) {
    case "Save":
      $("<tr>")
        .append("<td></td>")
        .append($("<td>").append(errorCodeOption($("#stop_human_code").val())))
        .append($("<td>").append(makeTime($("#stop_human_start_time").val())))
        .append($("<td>").append(makeTime($("#stop_human_end_time").val())))
        .append($("<td>").append(makeTimeDiff($("#stop_human_end_time").val(), $("#stop_human_start_time").val())))
        .appendTo("#stop_human_table tbody");
      $(this).prop("disabled", true);
      $("#stop_human_code").val(0).focus().removeClass("complete-input").addClass("no-input");
      $("#stop_human_start_time").val("").removeClass("complete-input").addClass("no-input");
      $("#stop_human_end_time").val("").removeClass("complete-input").addClass("no-input");
    break;
    case "Add":
      let fileName;
      let sendData = new Object();
      fileName = "AddStopHuman.php";
      sendData = {
        record_inspect_id: $("#selected__tr td:nth-child(1)").text(),
        stop_human_code: $("#stop_human_code").val(),
        stop_human_start_time: $("#stop_human_start_time").val(),
        stop_human_end_time: $("#stop_human_end_time").val(),
      };
      myAjax.myAjax(fileName, sendData);
      makeStopHuman();
      $("#stop_human_code").val(0).removeClass("complete-input").addClass("no-input");
      $("#stop_human_start_time").val("").removeClass("complete-input").addClass("no-input");
      $("#stop_human_end_time").val("").removeClass("complete-input").addClass("no-input");
      $(this).prop("disabled", true);
    break;
  }
});
$(document).on("click", "#stop_human_table tbody tr", function() {
  if (!$(this).hasClass("selected-record")) {
      $(this).parent().find("tr").removeClass("selected-record");
      $(this).addClass("selected-record");
      $("#stop_human_selected").removeAttr("id");
      $(this).attr("id", "stop_human_selected");
  } else {
  }
});
$(document).on("change", "#stop_human_table tbody tr", function () {
  let sendData = new Object();
  let fileName;
  fileName = "UpdateStopHuman.php";
  sendData = {
    id: $("#stop_human_selected td:nth-child(1)").html(),
    stop_human_code: $("#stop_human_selected td:nth-child(2) select").val(),
    stop_human_start_time: $("#stop_human_selected td:nth-child(3) input").val(),
    stop_human_end_time: $("#stop_human_selected td:nth-child(4) input").val(),
  };
  console.log(sendData);
  myAjax.myAjax(fileName, sendData);
  makeStopHuman();
});
function addMachineError() {
  if ($("#machine_error_start_time").val() == "" ||
      $("#machine_error_end_time").val() == "") {
      $("#add_machine_error").prop("disabled", true);
  } else {
      $("#add_machine_error").prop("disabled", false);
  }
};
function addStopHuman() {
  if ($("#stop_human_code").val() == 0 ||
      $("#stop_human_start_time").val() == "" ||
      $("#stop_human_end_time").val() == "") {
      $("#add_stop_human").prop("disabled", true);
  } else {
      $("#add_stop_human").prop("disabled", false);
  }
};
function errorCodeOption(seletedId) {
  let targetDom = $("<select>");

  fileName = "SelCode.php";
  sendData = {
      ng_code: "%",
  };
  myAjax.myAjax(fileName, sendData);
  ajaxReturnData.forEach(function(element) {
      if (element["id"] == seletedId) {
        $("<option>")
          .html(element["code"])
          .val(element["id"])
          .prop("selected", true)
          .appendTo(targetDom);
      } else {
        $("<option>")
          .html(element["code"])
          .val(element["id"])
          .appendTo(targetDom);
      }
  });
  return targetDom;
}
function inspectErrorCodeOption(seletedId) {
  let targetDom = $("<select>");

  fileName = "SelInspectErrorCode.php";
  sendData = {
      ng_code: "%",
  };
  myAjax.myAjax(fileName, sendData);
  ajaxReturnData.forEach(function(element) {
      if (element["id"] == seletedId) {
        $("<option>")
          .html(element["code"])
          .val(element["id"])
          .prop("selected", true)
          .appendTo(targetDom);
      } else {
        $("<option>")
          .html(element["code"])
          .val(element["id"])
          .appendTo(targetDom);
      }
  });
  return targetDom;
}
function makeTime(time) {
  let targetDom = $("<input>");
  targetDom.attr("type", "time");
  targetDom.val(time);
  return targetDom;
}
function makeInput(time) {
  let targetDom = $("<input>");
  targetDom.attr("type", "number");
  targetDom.val(time);
  return targetDom;
}
function makeTimeDiff(time1, time2) {
  var timeDifference = (new Date("1970-1-1 " + time1) - new Date("1970-1-1 " +  time2) ) / 1000 / 60 / 60;
  return timeDifference;
}
function getInputData() {
  let inputData = new Object();
    $(".top__wrapper input.save-data").each(function (index, element) {
      inputData[$(this).attr("id")] = $(this).val();
    });
    $(".top__wrapper select.save-data").each(function (index, element) {
      inputData[$(this).attr("id")] = $(this).val();
    });
  if ($("#file_upload").prop("files")[0]) {
    inputData["file_url"] = $("#file_url").html();
    ajaxFileUpload();
  } else {
    inputData["file_url"] = $("#file_url").html();
  }
  return inputData;
}
function clearInputData() {
  $(".top__wrapper input.need-clear").each(function (index, element) {
    $(this).val("").removeClass("complete-input").addClass("no-input");
  });
  $(".top__wrapper select.need-clear").each(function (index, element) {
    $(this).val("0").removeClass("complete-input").addClass("no-input");
  });
  $("#order_sheet_id").val(0).removeClass("no-input").addClass("complete-input");
  $("#file_url").html("No file");
  $("#stop_human_table tbody").empty();
  $("#machine_error_table tbody").empty();
  $("#inspect_error_table tbody").empty();
}
function getTableData(tableTrObj) {
  var tableData = [];
  tableTrObj.each(function (index, element) {
    var tr = [];
    $(this)
      .find("td")
      .each(function (index, element) {
        if ($(this).find("input").length) {
          tr.push($(this).find("input").val());
        } else if ($(this).find("select").length) {
          tr.push($(this).find("select").val());
        } else {
          tr.push($(this).html());
        }
      });
    tableData.push(tr);
  });
  console.log(tableData);
  return tableData;
}
$(document).on("change", "#file_upload", function () {
  ajaxFileUpload();
  console.log("Change file");
});
function ajaxFileUpload() {
    var file_data = $('#file_upload').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    $.ajax({
        url: "./php/FileUpload.php",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
    });
}

$(document).on("click", "#save", function () {
  fileName = "InsData.php";
  inputData = getInputData();
  sendData = inputData;
  myAjax.myAjax(fileName, sendData);
  let targetId = ajaxReturnData[0]["id"];
  tableData = getTableData($("#machine_error_table tbody tr"));
  tableData.push(targetId);
  fileName = "InsMachineRuntime.php";
  sendData = JSON.stringify(tableData);
  console.log(sendData);
  myAjax.myAjax(fileName, sendData);

  tableData = getTableData($("#stop_human_table tbody tr"));
  tableData.push(targetId);
  fileName = "InsStopHuman.php";
  sendData = JSON.stringify(tableData);
  console.log(sendData);
  myAjax.myAjax(fileName, sendData);

  tableData = getTableData($("#inspect_error_table tbody tr"));
  tableData.push(targetId);
  fileName = "InsInspectError.php";
  sendData = JSON.stringify(tableData);
  console.log(sendData);
  myAjax.myAjax(fileName, sendData);
  clearInputData();
  makeSummaryTable();
});
$(document).on("click", "#update", function () {
  fileName = "UpdateData.php";
  inputData = getInputData();
  inputData["targetId"] = $("#selected__tr").find("td").eq(0).html();
  sendData = inputData;
  myAjax.myAjax(fileName, sendData);
  clearInputData();
  makeSummaryTable();
  $("#add_machine_error").text("Save");
  $("#add_stop_human").text("Save");
  $("#add_inspect_error").text("Save");
  $("#save").attr("disabled", true);
  $("#update").attr("disabled", true);
});
function putDataToInput(data) {
    data.forEach(function (trVal) {
      Object.keys(trVal).forEach(function (tdVal) {
        $("#" + tdVal).val(trVal[tdVal]); 
      });
  });
  $("#file_url").html(data[0].file_url);
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
  $(".top__wrapper input .save-data").each(function() {
    if ($(this).val() == "") {
      check = false;
    }
  });
  $(".top__wrapper select .save-data").each(function() {
    if ($(this).val() == 0) {
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
$(document).on("click", "#add_button", function () {
  window.open(
    "./OrderSheetSelect.html",
    null,
    "width=830, height=500,toolbar=yes,menubar=yes,scrollbars=no"
  );
});

$(document).on("click", "#download", function() {
  var fileName = "SelForExcel.php";
  var sendObj = new Object();
  sendObj["start"] = $('#start').val();
  sendObj["end"] = $("#end").val();
  myAjax.myAjax(fileName, sendObj);

  ajaxReturnData.push(sendObj["start"])
  ajaxReturnData.push(sendObj["end"])
  let data = new Object();
  let donwloadFileName;
  data = ajaxReturnData;
  donwloadFileName = $('#start').val() + "_" + $("#end").val() + "_DLReport.xlsx";

  let JSONdata = JSON.stringify(data);

  $.ajax({
      async: false,
      url: "../../AD_Shot/Py/ExportDLRP.py",
      type: "post",
      data: JSONdata,
      dataType: "json",
  })
  .done(function(data) {
      console.log(data);
      downloadExcelFile(donwloadFileName);
  })
  .fail(function() {
      console.log("failed");
  });
});

function downloadExcelFile(donwloadFileName) {
const a = document.createElement("a");
document.body.appendChild(a);
a.download = donwloadFileName;
a.href = "../FileDownLoad/Excel/" + donwloadFileName;

a.click();
a.remove();
}
$(document).on("click", "#download_ng", function() {
  gennerateData()
});
function gennerateData() {
  var sendObj = new Object();
  sendObj["start_s"] = $('#start').val();
  sendObj["end_s"] = $("#end").val();

  var fileName = "SelErrorSummary.php";
  myAjax.myAjax(fileName, sendObj);
  data = ajaxReturnData;
  var ws = XLSX.utils.json_to_sheet(data);
  var wb = XLSX.utils.book_new();
  // ws['!cols'] = [];
  // ws['!cols'][0] = { hidden: true };
  XLSX.utils.book_append_sheet(wb, ws, "Data");
  XLSX.writeFile(wb, `Summary NG report ${sendObj["start_s"]}-${sendObj["end_s"]}.xlsx`);
};
