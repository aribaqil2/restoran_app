// Mengambil data dari variabel window jika ada
var dataSales = window.pemasukanData || [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

var optionsProfileVisit = {
  annotations: {
    position: "back",
  },
  dataLabels: {
    enabled: false,
  },
  chart: {
    type: "bar",
    height: 300,
  },
  fill: {
    opacity: 1,
  },
  plotOptions: {},
  series: [
    {
      name: "Pemasukan",
      data: dataSales,
    },
  ],
  colors: "#435ebe",
  xaxis: {
    categories: [
      "Jan", "Feb", "Mar", "Apr", "May", "Jun",
      "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
    ],
  },
  yaxis: {
    labels: {
      formatter: function (val) {
        return "Rp " + new Intl.NumberFormat('id-ID').format(val);
      }
    }
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return "Rp " + new Intl.NumberFormat('id-ID').format(val);
      }
    }
  }
};

var optionsVisitorsProfile = {
  series: [70, 30],
  labels: ["Male", "Female"],
  colors: ["#435ebe", "#55c6e8"],
  chart: {
    type: "donut",
    width: "100%",
    height: "350px",
  },
  legend: {
    position: "bottom",
  },
  plotOptions: {
    pie: {
      donut: {
        size: "30%",
      },
    },
  },
};

var optionsEurope = {
  series: [
    {
      name: "series1",
      data: [310, 800, 600, 430, 540, 340, 605, 805, 430, 540, 340, 605],
    },
  ],
  chart: {
    height: 80,
    type: "area",
    toolbar: {
      show: false,
    },
  },
  colors: ["#5350e9"],
  stroke: {
    width: 2,
  },
  grid: {
    show: false,
  },
  dataLabels: {
    enabled: false,
  },
  xaxis: {
    type: "datetime",
    categories: [
      "2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z",
      "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
      "2018-09-19T06:30:00.000Z", "2018-09-19T07:30:00.000Z", "2018-09-19T08:30:00.000Z",
      "2018-09-19T09:30:00.000Z", "2018-09-19T10:30:00.000Z", "2018-09-19T11:30:00.000Z",
    ],
    axisBorder: { show: false },
    axisTicks: { show: false },
    labels: { show: false },
  },
  yaxis: { labels: { show: false } },
  tooltip: { x: { format: "dd/MM/yy HH:mm" } },
};

var optionsAmerica = { ...optionsEurope, colors: ["#008b75"] };
var optionsIndia = { ...optionsEurope, colors: ["#ffc434"] };
var optionsIndonesia = { ...optionsEurope, colors: ["#dc3545"] };

// Inisialisasi Grafik
document.addEventListener("DOMContentLoaded", function () {
  var elProfileVisit = document.querySelector("#chart-profile-visit");
  if (elProfileVisit) {
    var chartProfileVisit = new ApexCharts(elProfileVisit, optionsProfileVisit);
    chartProfileVisit.render();
  }

  var elVisitorsProfile = document.getElementById("chart-visitors-profile");
  if (elVisitorsProfile) {
    var chartVisitorsProfile = new ApexCharts(elVisitorsProfile, optionsVisitorsProfile);
    chartVisitorsProfile.render();
  }

  var elEurope = document.querySelector("#chart-europe");
  if (elEurope) new ApexCharts(elEurope, optionsEurope).render();

  var elAmerica = document.querySelector("#chart-america");
  if (elAmerica) new ApexCharts(elAmerica, optionsAmerica).render();

  var elIndia = document.querySelector("#chart-india");
  if (elIndia) new ApexCharts(elIndia, optionsIndia).render();

  var elIndonesia = document.querySelector("#chart-indonesia");
  if (elIndonesia) new ApexCharts(elIndonesia, optionsIndonesia).render();
});