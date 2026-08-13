'use strict';


var getMembersAll = {
  init: function init() {

    this.bindUIActions();
  },
  bindUIActions: function bindUIActions() {

    // event handlers
    this.table = this.handleDataTables();
    this.handleSearchRecords();
    this.handleSelecter();
    this.handleClearSelected();

    // add buttons

  },
  handleDataTables: function handleDataTables() {
    return $('#myTable').DataTable({
      dom: '<\'text-muted\'Bi>\n        <\'table-responsive\'tr>\n        <\'mt-4\'p>',
      buttons: [],
      language: {
        zeroRecords: "No records found.",
        paginate: {
          previous: '<i class="fa fa-lg fa-angle-left"></i>',
          next: '<i class="fa fa-lg fa-angle-right"></i>'
        }
        
      },
      autoWidth: false,
         ajax: 'www/get/GETALLBOOKS',
      deferRender: true,
      order: [[7, 'asc']], 
      columns: [
        { data: 'Count', className: 'align-middle' },
        { data: 'Title',  className: 'align-middle'}, 
       { data: 'SubjectID', className: 'align-middle' },
        { data: 'PublisherName', className: 'align-middle' }, 
        { data: 'PlaceofPublication', className: 'align-middle' },
         { data: 'CallNum1', className: 'align-middle' },
         { data: 'CallNum2', className: 'align-middle' },
         { data: 'Quantity', className: 'align-middle' }],
         columnDefs: [ {
          targets: 0,
          render: function render(data, type, row, meta) {
            return ' <span id="'+row.Count+'" name="Title" class="editable">'+row.Count+ '</span>';
          }
        },
        {
          targets: 1,
          render: function render(data, type, row, meta) {
            return ' <span id="'+row.Count+'" name="Title" class="editable">'+row.Title+ '</span>';
          }
        },
          {
            targets: 2,
            render: function render(data, type, row, meta) {
              return ' <span id="'+row.Count+'" name="SubjectID" class="editable">'+row.SubjectID+ '</span>';
            }
          },
          {
            targets: 3,
            render: function render(data, type, row, meta) {
              return ' <span id="'+row.Count+'" name="PublisherName" class="editable">'+row.PublisherName+ '</span>';
            }
          },
          {
            targets: 4,
            render: function render(data, type, row, meta) {
              return ' <span id="'+row.Count+'" name="PlaceofPublication" class="editable">'+row.PlaceofPublication+ '</span>';
            }
          },
          {
            targets: 5,
            render: function render(data, type, row, meta) {
              return ' <span id="'+row.Count+'" name="CallNum1" class="editable">'+row.CallNum1+ '</span>';
            }
          },
            {
              targets: 6,
              render: function render(data, type, row, meta) {
                return ' <span id="'+row.Count+'" name="CallNum2" class="editable">'+row.CallNum2+ '</span>';
              }
            },
            {
              targets: 7,
              render: function render(data, type, row, meta) {
                return '<span id="'+row.Count+'" name="Quantity" class="editable">'+row.Quantity+ '</span>';
              }
            }]
    });
  },
  handleSearchRecords: function handleSearchRecords() {
    var self = this;

    $('#table-search, #filterBy').on('keyup change focus', function (e) {
      var filterBy = $('#filterBy').val();
      var hasFilter = filterBy !== '';
      var value = $('#table-search').val();

      // clear selected rows
      if (value.length && (e.type === 'keyup' || e.type === 'change')) {
        self.clearSelectedRows();
      }

      // reset search term
      self.table.search('').columns().search('').draw();

      if (hasFilter) {
        self.table.columns(filterBy).search(value).draw();
      } else {
        self.table.search(value).draw();
      }
    });
  },
  handleSelecter: function handleSelecter() {
    var self = this;

    $(document).on('change', '#check-handle', function () {
      var isChecked = $(this).prop('checked');
      $('input[name="selectedRow[]"]').prop('checked', isChecked);

      // get info
      self.getSelectedInfo();
    }).on('change', 'input[name="selectedRow[]"]', function () {
      var $selectors = $('input[name="selectedRow[]"]');
      var $selectedRow = $('input[name="selectedRow[]"]:checked').length;
      var prop = $selectedRow === $selectors.length ? 'checked' : 'indeterminate';

      // reset props
      $('#check-handle').prop('indeterminate', false).prop('checked', false);

      if ($selectedRow) {
        $('#check-handle').prop(prop, true);
      }

      // get info
      self.getSelectedInfo();
    });
  },
  handleClearSelected: function handleClearSelected() {
    var self = this;
    // clear selected rows
    $('#myTable').on('page.dt', function () {
      self.clearSelectedRows();
    });
    $('#clear-search').on('click', function () {
      self.clearSelectedRows();
    });
  },
  getSelectedInfo: function getSelectedInfo() {
    var $selectedRow = $('input[name="selectedRow[]"]:checked').length;
    var $info = $('.thead-btn');
    var $badge = $('<span/>').addClass('selected-row-info text-muted pl-1').text($selectedRow + ' selected');
    // remove existing info
    $('.selected-row-info').remove();
    // add current info
    if ($selectedRow) {
      $info.prepend($badge);
    }
  },
  clearSelectedRows: function clearSelectedRows() {
    $('#check-handle').prop('indeterminate', false).prop('checked', false).trigger('change');
  }
};

$(document).ready(function() {
  // Make an AJAX request to www/get/GETALLMEMBERGR
  $.ajax({
    url: 'www/get/GETALLBOOKS',
    dataType: 'json', // Assumes the response is in JSON format
    success: function(response) {
      var tableContainer = $('.table-responsive'); // Get the table container element

      if (JSON.stringify(response) === JSON.stringify([{"data":[]}])) {
        // Response is empty, add "No data" message
        tableContainer.html('<p>No data</p>');

        // Set the DOM option for no data
        var dataTable = $('#myTable').DataTable({
          dom: '<\'text-muted\'Bi>\n<\'table-responsive\'tr>\n<\'mt-4\'p>',
          buttons: []
        });
      } else {
        
        // Initialize getMembersAll
        getMembersAll.init();
      }
    },
    error: function(xhr, status, error) {
      console.error("Error fetching data:", error);
    }
  });
});

