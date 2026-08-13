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
         ajax: 'inventory',
      deferRender: true,
      order: [[7, 'asc']], 
      columns: [
        { data: 'AccID',  className: 'align-middle', searchable: false},
        { data: 'Status',  className: 'align-middle', searchable: false},
        { data: 'AccessionNo',  className: 'align-middle'},
        { data: 'Copies',  className: 'align-middle', searchable: false},
        { data: 'Title',  className: 'align-middle', searchable: false},
        { data: 'Author1LN',  className: 'align-middle', searchable: false},
        { data: 'Author1FN',  className: 'align-middle', searchable: false},
        { data: 'Author1MI',  className: 'align-middle', searchable: false},
        { data: 'PublisherName',  className: 'align-middle', searchable: false},
        { data: 'PlaceofPublication',  className: 'align-middle', searchable: false},
        { data: 'Subject',  className: 'align-middle', searchable: false},
        { data: 'CallNum1',  className: 'align-middle', searchable: false},
        { data: 'CallNum2',  className: 'align-middle', searchable: false},
        { data: 'CopyrightYear',  className: 'align-middle', searchable: false},
        { data: 'DateReceived',  className: 'align-middle', searchable: false},
        { data: 'ISBNNumber',  className: 'align-middle', searchable: false},
        { data: 'EditionNumber',  className: 'align-middle', searchable: false},
        { data: 'Location',  className: 'align-middle', searchable: false},
        { data: 'BPages',  className: 'align-middle', searchable: false},
        { data: 'MR Page',  className: 'align-middle', searchable: false},
        { data: 'Remarks',  className: 'align-middle', searchable: false}

      ],
      columnDefs: [{
        targets: 0,
        render: function render(data, type, row, meta) {
            if(row.Existing ==1){

              return '<select class="form-control inventoryhandler"  data-id="'+row.AccID+'"  style="width:100px;"><option value=""></option> <option value="yes" selected>Yes</option><option value="no">No</option></select>';
            }else if(row.Existing ==0){

              return '<select class="form-control inventoryhandler"  data-id="'+row.AccID+'"  style="width:100px;"><option value=""></option> <option value="yes">Yes</option><option value="no" selected>No</option></select>';
            }else if(row.Existing ==2){

              return '<select class="form-control inventoryhandler"  data-id="'+row.AccID+'"  style="width:100px;"><option value="" selected></option> <option value="yes">Yes</option><option value="no" >No</option></select>';
            }else{
              return '<select class="form-control inventoryhandler"  data-id="'+row.AccID+'"  style="width:100px;display:none;"><option value="" selected></option> <option value="yes">Yes</option><option value="no" >No</option></select>';
            }
                 }
      }]

         
    });
  },
  handleSearchRecords: function handleSearchRecords() {
   
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

getMembersAll.init();
