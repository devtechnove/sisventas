/**
 * DataTables Basic
 */

 $(function () {
    'use strict';

    var dt_basic_table = $('#tableExport'),
      dt_date_table = $('.dt-date'),
      dt_complex_header_table = $('.dt-complex-header'),
      dt_row_grouping_table = $('.dt-row-grouping'),
      dt_multilingual_table = $('.dt-multilingual'),
      assetPath = '../../../app-assets/';

    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');
    }

    // DataTable with buttons
    // --------------------------------------------------------------------

    if (dt_basic_table.length) {
      var dt_basic = dt_basic_table.DataTable({

        order: [[2, 'desc']],

        displayLength: 10,


        buttons: [
          {
            extend: 'collection',
            className: 'btn btn-outline-secondary dropdown-toggle mr-2',
            text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Exportar datos',
            buttons: [
              {
                extend: 'print',
                text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
                className: 'dropdown-item',
                exportOptions: { columns: [3, 4, 5, 6, 7] }
              },
              {
                extend: 'csv',
                text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
                className: 'dropdown-item',
                exportOptions: { columns: [3, 4, 5, 6, 7] }
              },
              {
                extend: 'excel',
                text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
                className: 'dropdown-item',
                exportOptions: { columns: [3, 4, 5, 6, 7] }
              },
              {
                extend: 'pdf',
                text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
                className: 'dropdown-item',
                exportOptions: { columns: [3, 4, 5, 6, 7] }
              },
              {
                extend: 'copy',
                text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
                className: 'dropdown-item',
                exportOptions: { columns: [3, 4, 5, 6, 7] }
              }
            ],
            init: function (api, node, config) {
              $(node).removeClass('btn-secondary');
              $(node).parent().removeClass('btn-group');
              setTimeout(function () {
                $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
              }, 50);
            }
          },

        ],

        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
                }
            }
      });

    }

    // Flat Date picker
    if (dt_date_table.length) {
      dt_date_table.flatpickr({
        monthSelectorType: 'static',
        dateFormat: 'm/d/Y'
      });
    }

    // Add New record
    // ? Remove/Update this code as per your requirements ?
    var count = 101;
    $('.data-submit').on('click', function () {
      var $new_name = $('.add-new-record .dt-full-name').val(),
        $new_post = $('.add-new-record .dt-post').val(),
        $new_email = $('.add-new-record .dt-email').val(),
        $new_date = $('.add-new-record .dt-date').val(),
        $new_salary = $('.add-new-record .dt-salary').val();

      if ($new_name != '') {
        dt_basic.row
          .add({
            responsive_id: null,
            id: count,
            full_name: $new_name,
            post: $new_post,
            email: $new_email,
            start_date: $new_date,
            salary: '$' + $new_salary,
            status: 5
          })
          .draw();
        count++;
        $('.modal').modal('hide');
      }
    });

    // Delete Record
    $('.datatables-basic tbody').on('click', '.delete-record', function () {
      dt_basic.row($(this).parents('tr')).remove().draw();
    });

    // Complex Header DataTable
    // --------------------------------------------------------------------

    if (dt_complex_header_table.length) {
      var dt_complex = dt_complex_header_table.DataTable({
        ajax: assetPath + 'data/table-datatable.json',
        columns: [
          { data: 'full_name' },
          { data: 'email' },
          { data: 'city' },
          { data: 'post' },
          { data: 'salary' },
          { data: 'status' },
          { data: '' }
        ],
        columnDefs: [
          {
            // Label
            targets: -2,
            render: function (data, type, full, meta) {
              var $status_number = full['status'];
              var $status = {
                1: { title: 'Current', class: 'badge-light-primary' },
                2: { title: 'Professional', class: ' badge-light-success' },
                3: { title: 'Rejected', class: ' badge-light-danger' },
                4: { title: 'Resigned', class: ' badge-light-warning' },
                5: { title: 'Applied', class: ' badge-light-info' }
              };
              if (typeof $status[$status_number] === 'undefined') {
                return data;
              }
              return (
                '<span class="badge badge-pill ' +
                $status[$status_number].class +
                '">' +
                $status[$status_number].title +
                '</span>'
              );
            }
          },
          {
            // Actions
            targets: -1,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
              return (
                '<div class="d-inline-flex">' +
                '<a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">' +
                feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                '</a>' +
                '<div class="dropdown-menu dropdown-menu-right">' +
                '<a href="javascript:;" class="dropdown-item">' +
                feather.icons['file-text'].toSvg({ class: 'mr-50 font-small-4' }) +
                'Details</a>' +
                '<a href="javascript:;" class="dropdown-item">' +
                feather.icons['archive'].toSvg({ class: 'mr-50 font-small-4' }) +
                'Archive</a>' +
                '<a href="javascript:;" class="dropdown-item delete-record">' +
                feather.icons['trash-2'].toSvg({ class: 'mr-50 font-small-4' }) +
                'Delete</a>' +
                '</div>' +
                '</div>' +
                '<a href="javascript:;" class="item-edit">' +
                feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                '</a>'
              );
            }
          }
        ],
        dom:
          '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 7,
        lengthMenu: [7, 10, 25, 50, 75, 100],
        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          }
        }
      });
    }

    // Row Grouping
    // --------------------------------------------------------------------

    var groupColumn = 2;
    if (dt_row_grouping_table.length) {
      var groupingTable = dt_row_grouping_table.DataTable({
        ajax: assetPath + 'data/table-datatable.json',
        columns: [
          { data: 'responsive_id' },
          { data: 'full_name' },
          { data: 'post' },
          { data: 'email' },
          { data: 'city' },
          { data: 'start_date' },
          { data: 'salary' },
          { data: 'status' },
          { data: '' }
        ],
        columnDefs: [
          {
            // For Responsive
            className: 'control',
            orderable: false,
            targets: 0
          },
          { visible: false, targets: groupColumn },
          {
            // Label
            targets: -2,
            render: function (data, type, full, meta) {
              var $status_number = full['status'];
              var $status = {
                1: { title: 'Current', class: 'badge-light-primary' },
                2: { title: 'Professional', class: ' badge-light-success' },
                3: { title: 'Rejected', class: ' badge-light-danger' },
                4: { title: 'Resigned', class: ' badge-light-warning' },
                5: { title: 'Applied', class: ' badge-light-info' }
              };
              if (typeof $status[$status_number] === 'undefined') {
                return data;
              }
              return (
                '<span class="badge badge-pill ' +
                $status[$status_number].class +
                '">' +
                $status[$status_number].title +
                '</span>'
              );
            }
          },
          {
            // Actions
            targets: -1,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
              return (
                '<div class="d-inline-flex">' +
                '<a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">' +
                feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                '</a>' +
                '<div class="dropdown-menu dropdown-menu-right">' +
                '<a href="javascript:;" class="dropdown-item">' +
                feather.icons['file-text'].toSvg({ class: 'mr-50 font-small-4' }) +
                'Details</a>' +
                '<a href="javascript:;" class="dropdown-item">' +
                feather.icons['archive'].toSvg({ class: 'mr-50 font-small-4' }) +
                'Archive</a>' +
                '<a href="javascript:;" class="dropdown-item delete-record">' +
                feather.icons['trash-2'].toSvg({ class: 'mr-50 font-small-4' }) +
                'Delete</a>' +
                '</div>' +
                '</div>' +
                '<a href="javascript:;" class="item-edit">' +
                feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                '</a>'
              );
            }
          }
        ],
        order: [[groupColumn, 'asc']],
        dom:
          '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 7,
        lengthMenu: [7, 10, 25, 50, 75, 100],
        drawCallback: function (settings) {
          var api = this.api();
          var rows = api.rows({ page: 'current' }).nodes();
          var last = null;

          api
            .column(groupColumn, { page: 'current' })
            .data()
            .each(function (group, i) {
              if (last !== group) {
                $(rows)
                  .eq(i)
                  .before('<tr class="group"><td colspan="8">' + group + '</td></tr>');

                last = group;
              }
            });
        },
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (row) {
                var data = row.data();
                return 'Details of ' + data['full_name'];
              }
            }),
            type: 'column',
            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
              tableClass: 'table'
            })
          }
        },
        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          }
        }
      });

      // Order by the grouping
      $('.dt-row-grouping tbody').on('click', 'tr.group', function () {
        var currentOrder = groupingTable.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
          groupingTable.order([groupColumn, 'desc']).draw();
        } else {
          groupingTable.order([groupColumn, 'asc']).draw();
        }
      });
    }

    // Multilingual DataTable
    // --------------------------------------------------------------------

    var lang = 'German';
    if (dt_multilingual_table.length) {
      var table_language = dt_multilingual_table.DataTable({
        ajax: assetPath + 'data/table-datatable.json',
        columns: [
          { data: 'responsive_id' },
          { data: 'full_name' },
          { data: 'post' },
          { data: 'email' },
          { data: 'start_date' },
          { data: 'salary' },
          { data: 'status' },
          { data: '' }
        ],
        columnDefs: [
          {
            // For Responsive
            className: 'control',
            orderable: false,
            targets: 0
          },
          {
            // Label
            targets: -2,
            render: function (data, type, full, meta) {
              var $status_number = full['status'];
              var $status = {
                1: { title: 'Current', class: 'badge-light-primary' },
                2: { title: 'Professional', class: ' badge-light-success' },
                3: { title: 'Rejected', class: ' badge-light-danger' },
                4: { title: 'Resigned', class: ' badge-light-warning' },
                5: { title: 'Applied', class: ' badge-light-info' }
              };
              if (typeof $status[$status_number] === 'undefined') {
                return data;
              }
              return (
                '<span class="badge badge-pill ' +
                $status[$status_number].class +
                '">' +
                $status[$status_number].title +
                '</span>'
              );
            }
          },
          {
            // Actions
            targets: -1,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
              return (
                '<div class="d-inline-flex">' +
                '<a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">' +
                feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                '</a>' +
                '<div class="dropdown-menu dropdown-menu-right">' +
                '<a href="javascript:;" class="dropdown-item">' +
                feather.icons['file-text'].toSvg({ class: 'mr-50 font-small-4' }) +
                'Details</a>' +
                '<a href="javascript:;" class="dropdown-item">' +
                feather.icons['archive'].toSvg({ class: 'mr-50 font-small-4' }) +
                'Archive</a>' +
                '<a href="javascript:;" class="dropdown-item delete-record">' +
                feather.icons['trash-2'].toSvg({ class: 'mr-50 font-small-4' }) +
                'Delete</a>' +
                '</div>' +
                '</div>' +
                '<a href="javascript:;" class="item-edit">' +
                feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                '</a>'
              );
            }
          }
        ],
        language: {
          url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/' + lang + '.json',
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          }
        },
        dom:
          '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 7,
        lengthMenu: [7, 10, 25, 50, 75, 100],
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (row) {
                var data = row.data();
                return 'Details of ' + data['full_name'];
              }
            }),
            type: 'column',
            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
              tableClass: 'table'
            })
          }
        }
      });
    }
  });
