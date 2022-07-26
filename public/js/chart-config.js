/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/chart-config.js ***!
  \**************************************/
$(document).ready(function () {
  var salesPurchasesBar = document.getElementById('salesPurchasesChart');
  $.get('/sales-purchases/chart-data', function (response) {
    console.log(response.purchases.original.data)
    var salesPurchasesChart = new Chart(salesPurchasesBar, {
      type: 'bar',
      data: {
        labels: response.sales.original.days,
        datasets: [{
          label: 'Ventas',
          data: response.sales.original.data,
          backgroundColor: ['#F16363'],
          borderColor: ['#F16363'],
          borderWidth: 1
        }, {
          label: 'Compras',
          data: response.purchases.original.data,
          backgroundColor: ['#A5B4FC'],
          borderColor: ['#A5B4FC'],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
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
  var paymentChart = document.getElementById('paymentChart');
  $.get('/payment-flow/chart-data', function (response) {
    console.log(response);
    var cashflowChart = new Chart(paymentChart, {
      type: 'line',
      data: {
        labels: response.months,
        datasets: [{
          label: 'Pagos realizados',
          data: response.payment_sent,
          fill: false,
          borderColor: '#EA580C',
          tension: 0
        }, {
          label: 'Pagos recibidos',
          data: response.payment_received,
          fill: false,
          borderColor: '#2563EB',
          tension: 0
        }]
      }
    });
  });
});
/******/ })()
;
