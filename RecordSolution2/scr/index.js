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
  selStaff();
  selShift();
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
function selStaff() {
  var fileName = "SelStaff.php";
  var sendData = {
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
    console.log(sendData);
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
  checkUpdate();
});
$(document).on("change keyup", ".caculate", function() {
  let degreasing_tt_h2so4 = $("#degreasing_tt_h2so4");
  degreasing_tt_h2so4.val($("#degreasing_naoh_1n").val()*1.003*9.8);

  let etching_tt_naoh = $("#etching_tt_naoh");
  etching_tt_naoh.val($("#etching_hcl_1n1").val()*1.002*8);
  let etching_free_naoh = $("#etching_free_naoh");
  etching_free_naoh.val(($("#etching_hcl_1n1").val() - ($("#etching_hcl_1n2").val()/3))*1.002*8);
  let etching_al = $("#etching_al");
  etching_al.val($("#etching_hcl_1n2").val()*1.002*1.8);

  let chemical_polishing_tt_hno3 = $("#chemical_polishing_tt_hno3");
  chemical_polishing_tt_hno3.val(($("#chemical_polishing_fenh4_1").val()*(8/$("#chemical_polishing_fenh4_2").val())*0.00525*100)/$("#chemical_polishing_density").val());
  let chemical_polishing_tt_h3po4 = $("#chemical_polishing_tt_h3po4");
  chemical_polishing_tt_h3po4.val(($("#chemical_polishing_naoh_1n").val()*1.003*9.8)/$("#chemical_polishing_density").val());
  let chemical_polishing_tt_alpo4 = $("#chemical_polishing_tt_alpo4");
  chemical_polishing_tt_alpo4.val(($("#chemical_polishing_edta").val()*0.122*100)/($("#chemical_polishing_density").val()*5));

  let smut_tt_h2so4 = $("#smut_tt_h2so4");
  smut_tt_h2so4.val($("#smut_naoh_2n").val()*0.999*19.6);

  let anodizing1_tt_acid = $("#anodizing1_tt_acid");
  anodizing1_tt_acid.val($("#anodizing1_naoh_2n_1").val()*0.999*19.6);
  let anodizing1_free_acid = $("#anodizing1_free_acid");
  anodizing1_free_acid.val($("#anodizing1_naoh_2n_2").val()*0.999*19.6);
  let anodizing1_al = $("#anodizing1_al");
  anodizing1_al.val((anodizing1_tt_acid.val() - anodizing1_free_acid.val())*3.6*0.999);

  let anodizing2_tt_acid = $("#anodizing2_tt_acid");
  anodizing2_tt_acid.val($("#anodizing2_naoh_2n_1").val()*0.999*19.6);
  let anodizing2_free_acid = $("#anodizing2_free_acid");
  anodizing2_free_acid.val($("#anodizing2_naoh_2n_2").val()*0.999*19.6);
  let anodizing2_al = $("#anodizing2_al");
  anodizing2_al.val((anodizing2_tt_acid.val() - anodizing2_free_acid.val())*3.6*0.999);

  let anodizing3_tt_acid = $("#anodizing3_tt_acid");
  anodizing3_tt_acid.val($("#anodizing3_naoh_2n_1").val()*0.999*19.6);
  let anodizing3_free_acid = $("#anodizing3_free_acid");
  anodizing3_free_acid.val($("#anodizing3_naoh_2n_2").val()*0.999*19.6);
  let anodizing3_al = $("#anodizing3_al");
  anodizing3_al.val((anodizing3_tt_acid.val() - anodizing3_free_acid.val())*3.6*0.999);

  let anodizing4_tt_acid = $("#anodizing4_tt_acid");
  anodizing4_tt_acid.val($("#anodizing4_naoh_2n_1").val()*0.999*19.6);
  let anodizing4_free_acid = $("#anodizing4_free_acid");
  anodizing4_free_acid.val($("#anodizing4_naoh_2n_2").val()*0.999*19.6);
  let anodizing4_al = $("#anodizing4_al");
  anodizing4_al.val((anodizing4_tt_acid.val() - anodizing4_free_acid.val())*3.6*0.999);

  let acid_cleaning_tt_h2so4 = $("#acid_cleaning_tt_h2so4");
  acid_cleaning_tt_h2so4.val($("#acid_cleaning_naoh_2n").val()*0.999*19.6) ;
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