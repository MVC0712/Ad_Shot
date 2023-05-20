// let deleteDialog = document.getElementById("delete__dialog");
let inputData = new Object();
let fileName;
let sendData = new Object();
let ajaxReturnData;
let line_id = 1;
let ctx = document.getElementById('chart_area').getContext('2d');
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
};
const getDate = (date) => {
  const day = getTwoDigits(date.getDate());
  const month = getTwoDigits(date.getMonth() + 1);
  const year = date.getFullYear();
  return `${day}-${month}`;
}
$(function() {
  var now = new Date();
  var MonthLastDate = new Date(now.getFullYear(), now.getMonth() + 1, 0);
  // var MonthFirstDate = new Date(now.getFullYear() - (now.getMonth() > 0 ? 0 : 1), (now.getMonth() + 12) % 12, 1);
  var MonthFirstDate = new Date(now.getFullYear(), (now.getMonth() + 12) % 12, 1);
  var formatDateComponent = function(dateComponent) {
    return (dateComponent < 10 ? '0' : '') + dateComponent;
  };

  var formatDate = function(date) {
    return date.getFullYear()  + '-' + formatDateComponent(date.getMonth() + 1) + '-' + formatDateComponent(date.getDate()) ;
  };

  var a = formatDate(MonthFirstDate);
  var b = formatDate(MonthLastDate);

  $("#std").val(a);
  $("#end").val(b);
});

function round(num, decimalPlaces = 0) {
  num = Math.round(num + "e" + decimalPlaces);
  return Number(num + "e" + -decimalPlaces);
}
function makeSummaryTable() {
    var fileName = "SelSummary.php";
    var sendObj = new Object();
    sendObj["start_s"] = $('#std').val();
    sendObj["end_s"] = $("#end").val();
    myAjax.myAjax(fileName, sendObj);
    fillTableBody1(ajaxReturnData, $("#summary__table tbody"));
    Total();
}

function fillTableBody(data, tbodyDom) {
  $(tbodyDom).empty();
    data.forEach(function(trVal) {
      var newTr = $("<tr>");
      Object.keys(trVal).forEach(function(tdVal) {
          if (tdVal == "idd" && (trVal+1).idd==tdVal.idd)  {
            $("<td>").html(trVal[tdVal]).appendTo(newTr);
            $("<td>").html((trVal+1)[tdVal]).appendTo(newTr);
          } else {
              $("<td>").html(trVal[tdVal]).appendTo(newTr);
          }
      });
      $(newTr).appendTo(tbodyDom);
  });
}
function fillTableBody1(data, tbodyDom) {
  $(tbodyDom).empty();
  for (var i = 0; i < data.length -1; i++) {
    var newTr = $("<tr>");
    var newTrr = $("<tr>");
      if ((data[i]).idd==data[i+1].idd) {
        for (const a in data[i]) {
          $("<td>").html(data[i][a]).appendTo(newTr);
        }
        for (const a in data[i+1]) {
          $("<td>").html(data[i+1][a]).appendTo(newTrr);
        }
        i++;
      } else {
      }
    $(newTr).appendTo(tbodyDom);
    $(newTrr).appendTo(tbodyDom);
  }
}
$(document).on("click", "#summary__table tbody tr", function(e) {
    $(this).parent().find("tr").removeClass("selected-record");
    $(this).addClass("selected-record");
});

$(document).on("click", "#summary__table tbody td", function(e) {
  if (!$(this).hasClass("active")) {
    $("td").removeClass("active");
    $(this).addClass("active");
  } else {
    $("td").removeClass("active");
  }
});

$(document).on("change", "#std", function() {
    renderHead($('div#table'), new Date($("#std").val()), new Date($("#end").val()));
    makeSummaryTable();
});
$(document).on("change", "#end", function() {
    renderHead($('div#table'), new Date($("#std").val()), new Date($("#end").val()));
    makeSummaryTable();
});
$(function() {
    renderHead($('div#table'), new Date($("#std").val()), new Date($("#end").val()));
    makeSummaryTable();
    drawChart();
});

var weekday = ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"];
var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var months = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];

function renderHead(div, start, end) {
    var c_year = start.getFullYear();
    var r_year = "<tr> <th rowspan='4' style ='width: 150px;'>Production number</th> ";
    var r_year1 = "<tr style='display:none;'><th style='display:none;'></th><th style='display:none;'></th>";
    var daysInYear = 0;

    var c_month = start.getMonth();
    var r_month = "<tr>";
    var r_month1 = "<tr style='display:none;'><th style='display:none;'></th><th style='display:none;'></th>";
    var daysInMonth = 0;

    var r_days = "<tr><th style='display:none;'></th><th style='display:none;'></th><th style='display:none;'></th>";
    var r_days2 = "<tr><th style='display:none;'></th><th style='display:none;'></th><th style='display:none;'></th>";
    for (start; start <= end; start.setDate(start.getDate() + 1)) {
        if (start.getFullYear() !== c_year) {
            r_year += '<th colspan="' + daysInYear + '">' + c_year + '</th>';
            c_year = start.getFullYear();
            daysInYear = 0;
        }
        daysInYear++;
        if (start.getMonth() !== c_month) {
            r_month += '<th colspan="' + daysInMonth + '">' + months[c_month] + '</th>';
            // r_month1 += '<th>' + months[c_month] + '</th>';
            c_month = start.getMonth();
            daysInMonth = 0;
        }
        daysInMonth++;

        r_days += '<th>' + start.getDate() + '</th>';
        r_days2 += '<th>' + weekday[start.getDay()] + '</th>';
        r_month1 += '<th>' + months[c_month] + '</th>';
        r_year1 += '<th>' + c_year + '</th>';
    }
    r_days += "</tr>";
    r_days2 += "</tr>";
    r_year += '<th colspan="' + (daysInYear) + '">' + c_year + '</th>';
    r_year1 += '<th>' + c_year + '</th>';
    // r_year += "<th rowspan='4' style ='width: 40px;'>Total</th><th rowspan='4' style ='width: 45px;'>Per</th></tr>";
    r_year += "</tr>";
    r_year += "</tr>";
    r_year1 += "</tr>";
    r_month += '<th colspan="' + (daysInMonth) + '">' + months[c_month] + '</th>';
    r_month1 += '<th>' + months[c_month] + '</th>';
    r_month += "</tr>";
    r_month1 += "</tr>";
    table = "<table id='summary__table'> <thead>" + r_year + r_year1 + r_month + r_month1 + r_days + "</thead> <tbody> </tbody> </table>";

    div.html(table);
}

function Total() {
  hideValue();
  $('#summary__table tbody tr').each(function(){
    var sum = 0;
    if ((Number($(this).find("td").eq(0).html()) == 1) || (Number($(this).find("td").eq(0).html()) == 2)) {
      $(this).find('td').each(function(){
        if(!isNaN(Number($(this).text()))){
          sum = sum + Number($(this).text());
        }
      });
      sum = sum - Number($(this).find("td").eq(0).html())
      - Number($(this).find("td").eq(1).html());
      $(this).append('<td>'+sum+'</td>');
    }
    if ((Number($(this).find("td").eq(0).html()) == 3) || (Number($(this).find("td").eq(0).html()) == 4)) {
      $(this).find('td').each(function(){
        if((Number($(this).text()) > 0 )){
          max = Number($(this).text());
        }
      });
      $(this).append('<td>'+max+'</td>');
    }
  });
};

function hideValue() {
  var table = document.getElementById("summary__table");
  var tbody = table.getElementsByTagName("tbody")[0];
  var tr = tbody.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i += 1) {
    for(var j = 0; j < tr[i].getElementsByTagName("td").length; j +=1) {
      var td =  tr[i].getElementsByTagName("td")[0];
      if($(td).html() == 1) {
        var tdh =  tr[i].getElementsByTagName("td")[j];
        if($(tdh).html() == "") {
          var tdh2 =  tr[i+2].getElementsByTagName("td")[j];
          $(tdh2).html("");
        }
      }
      if($(td).html() == 2) {
        var tdh =  tr[i].getElementsByTagName("td")[j];
        if($(tdh).html() == "") {
          var tdh2 =  tr[i+2].getElementsByTagName("td")[j];
          $(tdh2).html("");
        }
      }
    }
  }
};

function drawChart() {
  var fileName = "SelSummaryForChart.php";
  var sendObj = new Object();
  sendObj["start_s"] = $('#std').val();
  sendObj["end_s"] = $("#end").val();
  myAjax.myAjax(fileName, sendObj);
  dataPl = ajaxReturnData[0];
  dataAc = ajaxReturnData[1];
  Pl = [];
  Ac = [];
  for (const el in dataPl) {
    Pl.push(dataPl[el]);
  }
  Pl.shift();
  for (const el in dataAc) {
    Ac.push(dataAc[el]);
  }
  Ac.shift();
  var daysOfYear = [];
  for (var d = new Date($("#std").val()); d <= new Date($("#end").val()); d.setDate(d.getDate() + 1)) {
      daysOfYear.push(getDate(new Date(d)));
  }
  var data = {
    labels: daysOfYear,
    datasets: [{
        label: "Actual",
        fill: false,
        lineTension: 0.1,
        backgroundColor: "rgba(225,0,0,0.4)",
        borderColor: "red",
        borderCapStyle: 'square',
        borderDash: [],
        borderDashOffset: 0.0,
        borderJoinStyle: 'miter',
        pointBorderColor: "black",
        pointBackgroundColor: "white",
        pointBorderWidth: 1,
        pointHoverRadius: 8,
        pointHoverBackgroundColor: "yellow",
        pointHoverBorderColor: "brown",
        pointHoverBorderWidth: 2,
        pointRadius: 4,
        pointHitRadius: 10,
        data: Pl,
        spanGaps: true,
        type: 'line',
      }, {
        label: "Plan",
        fill: false,
        lineTension: 0.1,
        backgroundColor: "rgba(167,105,0,0.4)",
        borderColor: "rgb(167, 105, 0)",
        borderCapStyle: 'butt',
        borderDash: [],
        borderDashOffset: 0.0,
        borderJoinStyle: 'miter',
        pointBorderColor: "white",
        pointBackgroundColor: "black",
        pointBorderWidth: 1,
        pointHoverRadius: 8,
        pointHoverBackgroundColor: "brown",
        pointHoverBorderColor: "yellow",
        pointHoverBorderWidth: 2,
        pointRadius: 4,
        pointHitRadius: 10,
        data: Ac,
        spanGaps: false,
        type: 'line',
      }, 
  
    ]
  };
  var options = {
    scales: {
    }  
  };
  new Chart(ctx, {
    data: data,
    options: options
  });
  };


  // used for example purposes
function getRandomIntInclusive(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

// create initial empty chart
var ctx_live = document.getElementById("mycanvas");
var myChart = new Chart(ctx_live, {
  type: 'bar',
  data: {
    labels: [],
    datasets: [{
      data: [],
      borderWidth: 1,
      borderColor:'#00c0ef',
      label: 'liveCount',
    }]
  },
  options: {
    responsive: true,
    title: {
      display: true,
      text: "Chart.js - Dynamically Update Chart Via Ajax Requests",
    },
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,
        }
      }]
    }
  }
});

// this post id drives the example data
var postId = 1;

// logic to get new data
var getData = function() {
  $.ajax({
    url: 'https://jsonplaceholder.typicode.com/posts/' + postId + '/comments',
    success: function(data) {
      // process your data to pull out what you plan to use to update the chart
      // e.g. new label and a new data point
      
      // add new label and data point to chart's underlying data structures
      myChart.data.labels.push("Post " + postId++);
      myChart.data.datasets[0].data.push(getRandomIntInclusive(1, 25));
      
      // re-render the chart
      myChart.update();
    }
  });
};

// get new data every 3 seconds
// setInterval(getData, 3000);


$(document).on("click", "#download", function() {
  var fileName = "SelForExcel.php";
  var sendObj = new Object();
  sendObj["start_s"] = $('#std').val();
  sendObj["end_s"] = $("#end").val();
  myAjax.myAjax(fileName, sendObj);

  // console.log(ajaxReturnData);
  ajaxReturnData.push(sendObj["start_s"])
  ajaxReturnData.push(sendObj["end_s"])
  let data = new Object();
  let donwloadFileName;
  data = ajaxReturnData;
  donwloadFileName = $('#std').val() + "_" + $("#end").val() + "_ReportAnod.xlsx";

  let JSONdata = JSON.stringify(data);

  $.ajax({
      async: false,
      url: "../../AD_Shot/Py/ExportDataAnod.py",
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