/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/chart-config.js ***!
  \**************************************/
$(document).ready(function () {
  var overviewChart = document.getElementById('currentMonthChart');
  $.get('/current-month/chart-data', function (response) {
    var currentMonthChart = new Chart(overviewChart, {
      type: 'doughnut',
      data: {
        labels: ['Ventas', 'Compras', 'Gastos'],
        datasets: [{
          data: [response.sales, response.purchases, response.expenses],
          backgroundColor: ['#F59E0B', '#0284C7', '#EF4444'],
          hoverBackgroundColor: ['#F59E0B', '#0284C7', '#EF4444']
        }]
      }
    });
  });

});
/******/ })()
;
