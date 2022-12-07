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
  // MaterialNameCode();
  // makeSummaryTable();
  // selStaff();
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
      Object.keys(trVal).forEach(function(tdVal, index) {
          $("<td>").html(trVal[tdVal]).appendTo(newTr);
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
  } else {
    // deleteDialog.showModal();
  }
  $("#save").attr("disabled", true);
  checkUpdate();
  makeAddMaterial();
  $(".save-data").each(function (index, element) {
    $(this).removeClass("no-input").addClass("complete-input");
  });
  Total();
});
function MaterialNameCode() {
  var fileName = "SelMaterialName.php";
  var sendData = {
      dummy: "dummy",
  };
  myAjax.myAjax(fileName, sendData);
  $("#material option").remove();
  $("#material").append($("<option>").val(0).html("NO"));
  ajaxReturnData.forEach(function(value) {
      $("#material").append(
          $("<option>").val(value["id"]).html(value["material_name"])
      );
  });
};
function selStaff() {
  var fileName = "SelStaff.php";
  var sendData = {
      dummy: "dummy",
  };
  myAjax.myAjax(fileName, sendData);
  $("#staff_id option").remove();
  $("#staff_id").append($("<option>").val(0).html("NO"));
  ajaxReturnData.forEach(function(value) {
      $("#staff_id").append(
          $("<option>").val(value["id"]).html(value["name"])
      );
  });
};
$(document).on("change", "#product_date", function() {
  if ($(this).val() != "") {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("keyup", "#code", function() {
  $(this).val($(this).val().toUpperCase());
  if ($(this).val() != "") {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("change", "#product_type", function() {
  if ($(this).val() != 0) {
      $(this).removeClass("no-input").addClass("complete-input");
      var fileName = "SelMaterialElement.php";
      var sendData = {
        product_type: $("#product_type").val(),
      };
      myAjax.myAjax(fileName, sendData);
    $("#si_req").text(ajaxReturnData[0]["si"]);
    $("#mg_req").text(ajaxReturnData[0]["mg"]);
    $("#mn_req").text(ajaxReturnData[0]["mn"]);
    $("#cr_req").text(ajaxReturnData[0]["cr"]);
    $("#cu_req").text(ajaxReturnData[0]["cu"]);
    $("#fe_req").text(ajaxReturnData[0]["fe"]);
    $("#zn_req").text(ajaxReturnData[0]["zn"]);
    $("#ti_b_req").text(ajaxReturnData[0]["ti_b"]);
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("keyup", "#extrusion_scrap", function() {
  if ($(this).val() != "") {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("keyup", "#casting_scrap", function() {
  if ($(this).val() != "") {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("keyup", "#aluminium_ingot", function() {
  if ($(this).val() != "") {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("change", "#material", function() {
  add_material_check();
  if ($(this).val() != 0) {
      $(this).removeClass("no-input").addClass("complete-input");
      var fileName = "SelMaterialNameType.php";
      var sendData = {
        material_name_id: $("#material").val(),
      };
      myAjax.myAjax(fileName, sendData);
      $("#material_type option").remove();
      $("#material_type").append($("<option>").val(0).html("NO"));
      $("#material_type").removeClass("complete-input").addClass("no-input");
      ajaxReturnData.forEach(function(value) {
          $("#material_type").append(
              $("<option>").val(value["id"]).html(value["material_name_type"])
          );
      });
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("change", "#material_type", function() {
  add_material_check();
  if ($(this).val() != 0) {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("keyup", "#material_weight", function() {
  add_material_check();
  if ($(this).val() > 0) {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("change", "#staff_id", function() {
  if ($(this).val() != 0) {
    $(this).removeClass("no-input").addClass("complete-input");
  } else {
    $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("keyup", "#melting_table thead input", function() {
  if ($(this).val() != "") {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("change", "#melting_table thead input", function() {
  if ($(this).val() != "") {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("keyup", "#element_table tbody input", function() {
  if ($(this).val() != "") {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("keyup", ".casting__wrapper thead input", function() {
  if ($(this).val() != "") {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});
$(document).on("change", ".casting__wrapper thead input", function() {
  if ($(this).val() != "") {
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
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
        .append($("<td>").append(errorCodeOption($("#machine_error_code").val())))
        .append($("<td>").append(makeTime($("#machine_error_start_time").val())))
        .append($("<td>").append(makeTime($("#machine_error_end_time").val())))
        .append($("<td>").append(makeTimeDiff($("#machine_error_end_time").val(), $("#machine_error_start_time").val())))
        .appendTo("#machine_error_table tbody");
      $(this).prop("disabled", true);
      $("#machine_error_code").val("0").focus().removeClass("complete-input").addClass("no-input");
      $("#machine_error_start_time").val("").removeClass("complete-input").addClass("no-input");
      $("#machine_error_end_time").val("").removeClass("complete-input").addClass("no-input");
    break;
    case "Add":
      let fileName;
      let sendData = new Object();
      fileName = "AddMachineRuntime.php";
      sendData = {
        record_anod_id: $("#selected__tr td:nth-child(1)").text(),
        material: $("#machine_error_code").val(),
        material_type: $("#machine_error_start_time").val(),
        weight: $("#machine_error_end_time").val(),
      };
      myAjax.myAjax(fileName, sendData);
      makeAddMaterial();
      $("#machine_error_code").val("0").focus().removeClass("complete-input").addClass("no-input");
      $("#machine_error_start_time").val("").removeClass("complete-input").addClass("no-input");
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
    machine_error_code : $("#machine_error_selected td:nth-child(2) select").val(),
    machine_error_start_time: $("#machine_error_selected td:nth-child(3) input").val(),
    machine_error_end_time: $("#machine_error_selected td:nth-child(4) input").val(),
  };
  console.log(sendData);
  myAjax.myAjax(fileName, sendData);
});
$("#add_stop_human_table").on("click", function () {
  switch ($(this).text()) {
    case "Save":
      $("<tr>")
        .append("<td></td>")
        .append($("<td>").append(makeTime($("#stop_human_start_time").val())))
        .append($("<td>").append(makeTime($("#stop_human_end_time").val())))
        .append($("<td>").append(makeTimeDiff($("#stop_human_end_time").val(), $("#stop_human_start_time").val())))
        .appendTo("#stop_human_table tbody");
      $(this).prop("disabled", true);
      $("#stop_human_start_time").val("").focus().removeClass("complete-input").addClass("no-input");
      $("#stop_human_end_time").val("").removeClass("complete-input").addClass("no-input");
    break;
    case "Add":
      let fileName;
      let sendData = new Object();
      fileName = "AddStopHuman.php";
      sendData = {
        record_anod_id: $("#selected__tr td:nth-child(1)").text(),
        stop_human_start_time: $("#stop_human_start_time").val(),
        stop_human_end_time: $("#stop_human_end_time").val(),
      };
      myAjax.myAjax(fileName, sendData);
      makeAddMaterial();
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
    stop_human_start_time: $("#stop_human_selected td:nth-child(2) input").val(),
    stop_human_end_time: $("#stop_human_selected td:nth-child(3) input").val(),
  };
  console.log(sendData);
  myAjax.myAjax(fileName, sendData);
});
function addMachineError() {
  if ($("#machine_error_code").val() == 0 ||
      $("#machine_error_start_time").val() == "" ||
      $("#machine_error_end_time").val() == "") {
      $("#add_machine_error").prop("disabled", true);
  } else {
      $("#add_machine_error").prop("disabled", false);
  }
};
function addStopHuman() {
  if ($("#stop_human_start_time").val() == "" ||
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
function makeTime(time) {
  let targetDom = $("<input>");
  targetDom.attr("type", "time");
  targetDom.val(time);
  return targetDom;
}
function makeTimeDiff(time1, time2) {
  var timeDifference = (new Date("1970-1-1 " + time1) - new Date("1970-1-1 " +  time2) ) / 1000 / 60 / 60;
  return timeDifference;
}

$(document).on("keyup", ".number-input", function() {
  if($.isNumeric($(this).val())){
      $(this).removeClass("no-input").addClass("complete-input");
  } else {
      $(this).removeClass("complete-input").addClass("no-input");
  }
  checkInput();
  checkUpdate();
});

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
  $(".material__wrapper .right__material input.save-data").each(function (index, element) {
    inputData[$(this).attr("id")] = $(this).val();
  });
  $(".material__wrapper .right__material input.date-time").each(function (index, element) {
    inputData[$(this).attr("id")] = $(this).val();
  });
  $(".element__wrapper input.save-data").each(function (index, element) {
    inputData[$(this).attr("id")] = $(this).val();
  });
  $(".casting__wrapper input.save-data").each(function (index, element) {
    inputData[$(this).attr("id")] = $(this).val();
  });
  $(".casting__wrapper input.date-time").each(function (index, element) {
    inputData[$(this).attr("id")] = $(this).val();
  });
  console.log(inputData);
  console.log(Object.keys(inputData).length);
  return inputData;
}
function clearInputData() {
  $(".top__wrapper input.need-clear").each(function (index, element) {
    $(this).val("").removeClass("complete-input").addClass("no-input");
  });
  $(".top__wrapper input.no-need").each(function (index, element) {
    $(this).val("").removeClass("no-input").addClass("complete-input");
  });
  $(".top__wrapper select.need-clear").each(function (index, element) {
    $(this).val("0").removeClass("complete-input").addClass("no-input");
  });

  $("#file_url").html("No file");

  $(".material__wrapper .right__material input.need-clear").each(function (index, element) {
    $(this).val("").removeClass("complete-input").addClass("no-input");
  });
  $(".material__wrapper .right__material input.no-need").each(function (index, element) {
    $(this).val("").removeClass("no-input").addClass("complete-input");
  });
  $(".element__wrapper input.need-clear").each(function (index, element) {
    $(this).val("").removeClass("complete-input").addClass("no-input");
  });
  $(".element__wrapper input.no-need").each(function (index, element) {
    $(this).val("").removeClass("no-input").addClass("complete-input");
  });
  $(".casting__wrapper input.need-clear").each(function (index, element) {
    $(this).val("").removeClass("complete-input").addClass("no-input");
  });
  $(".casting__wrapper input.no-need").each(function (index, element) {
    $(this).val("").removeClass("no-input").addClass("complete-input");
  });
  $("#material_table tbody").empty();
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
  $(".material__wrapper .right__material input").each(function() {
    if ($(this).hasClass("no-input")) {
      check = false;
    }
  });
  $("#element_table tbody input").each(function() {
    if ($(this).hasClass("no-input")) {
      check = false;
    }
  });
  $(".casting__wrapper input").each(function() {
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
  $(".material__wrapper .right__material input").each(function() {
    if ($(this).val() == "") {
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

function calTotal(id, type) {
  var total = 0;
  $("#material_table tbody tr").each(function (index, element) {
    if ($(this).find("td:nth-child(2) select").val() == type) {
      total += parseInt($(this).find("td:nth-child(4) input").val());
// console.log(total);
    }
    $("#" + id).html(total);
  });
};
function Total() {
  calTotal("plextrusion", 1);
  calTotal("pldiscard", 2);
  calTotal("plcut", 3);
  calTotal("plcast", 4);
  calTotal("plgcng", 5);
  calTotal("plingot", 6);
  calTotal("plalloy", 7);
  calTotal("plorther", 8);
  var total = 0;
    $("#material_table tbody tr").each(function (index, element) {
      total += parseInt($(this).find("td:nth-child(4) input").val());
    }
  );
  $("#ttmate").html(total);
};