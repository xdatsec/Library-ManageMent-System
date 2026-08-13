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
         ajax: 'www/get/GETALLALUMNI2',
      deferRender: true,
      order: [1, 'asc'],
      columns: [
        { data: 'id', className: 'col-checker align-middle', orderable: false, searchable: false, visible: false }, 
      { data: 'name', className: 'align-middle' },
        { data: 'LastName', className: 'align-middle' }, 
        { data: 'FirstName', className: 'align-middle' },
         { data: 'MiddleName', className: 'align-middle' },
         { data: 'id2', className: 'col-checker align-middle', orderable: false, searchable: false },
        ],
      columnDefs: [{
        targets: 0,
        render: function render(data, type, row, meta) {
          return '';

        }
      }, {
        targets: 1,
        render: function render(data, type, row, meta) {
          return '<a   class="tile tile-img mr-1">\n            <img class="img-fluid" style="display:none;" src="assets/images/dummy/img-' + row.img + '.jpg" alt="Card image cap">\n          </a>\n          <a  style="color:black;text-decoration:none;" href="#' + row.id + '" >' + row.name + '</a>';
        }
      }, {
        targets: 5,
        render: function render(data, type, row, meta) {
          return '<button class="btn btn-sm" id="remove" data-id="'+row.id+'">Remove</button>';
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
    url: 'www/get/GETALLALUMNI2',
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

