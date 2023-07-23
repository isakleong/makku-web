  



function initMostViewsByPage(objData, objCategory) {
  var optionsMostViews = {
    annotations: {
      position: "back",
    },
    dataLabels: {
      enabled: false,
    },
    chart: {
      id: "mostViewsByPage",
      type: "bar",
      height: 350,
    },
    fill: {
      opacity: 1,
    },
    plotOptions: {
      bar: {
        borderRadius: 12,
      }
    },
    series: [
      {
        name: "views",
        data: objData,
      },
    ],
    colors: "#435ebe",
    xaxis: {
      categories: objCategory,
    },
  }

  var chartMostViews = new ApexCharts(
    document.querySelector("#chart-most-views"),
    optionsMostViews
  );

  chartMostViews.render();
}

function initTotalVisitorsByDate(objData, objCategory) {
  var optionsTotalVisitors = {
    annotations: {
      position: "back",
    },
    dataLabels: {
      enabled: false,
    },
    chart: {
      id: "totalVisitorsByDate",
      type: "bar",
      height: 350,
    },
    fill: {
      opacity: 1,
    },
    plotOptions: {
      bar: {
        borderRadius: 12,
      }
    },
    series: [
      {
        name: "views",
        data: objData,
      },
    ],
    colors: "#435ebe",
    xaxis: {
      categories: objCategory,
    },
  }

  var chartTotalVisitors = new ApexCharts(
    document.querySelector("#chart-total-visitors"),
    optionsTotalVisitors
  );

  chartTotalVisitors.render();
}


function filterDataMostViewsByPage(objData, objCategory) {
  ApexCharts.exec('mostViewsByPage', 'updateOptions', {
    xaxis: {
      categories: objCategory
    }
  }, false, true);

  ApexCharts.exec('mostViewsByPage', 'updateSeries', [{
    data: objData
  }], true);
}

function filterDataTotalVisitorsByDate(objData, objCategory) {
  ApexCharts.exec('totalVisitorsByDate', 'updateOptions', {
    xaxis: {
      categories: objCategory
    }
  }, false, true);

  ApexCharts.exec('totalVisitorsByDate', 'updateSeries', [{
    data: objData
  }], true);
}
