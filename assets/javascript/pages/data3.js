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
      buttons: ['copyHtml5'],
      language: {
        zeroRecords: "No records found.",
        paginate: {
          previous: '<i class="fa fa-lg fa-angle-left"></i>',
          next: '<i class="fa fa-lg fa-angle-right"></i>'
        }
        
      },
      autoWidth: false,
         ajax: 'www/get/GETALLMEMBER',
      deferRender: true,
      order: [1, 'asc'],
      columns: [
        { data: 'id', className: 'col-checker align-middle', orderable: false, searchable: false }, 
       { data: 'MemberID', className: 'align-middle' },
        { data: 'LastName', className: 'align-middle' }, 
        { data: 'FirstName', className: 'align-middle' },
         { data: 'MiddleName', className: 'align-middle' },
         { data: 'Address', className: 'align-middle' },
          { data: 'BooksBorrowed', className: 'align-middle' },
           { data: 'PhoneNo', className: 'align-middle' }, 
           { data: 'Course', className: 'align-middle' }, 
           { data: 'Year', className: 'align-middle' }, 
           { data: 'Type', className: 'align-middle' }, 
           { data: 'SchoolYearFrom', className: 'align-middle' }, 
           { data: 'SchoolYearTo', className: 'align-middle' }, 
           { data: 'BirthDate', className: 'align-middle' }, 
           { data: 'DateEnlist', className: 'align-middle' }, 
           { data: 'DatetoGrad', className: 'align-middle' }, 
           { data: 'CurBooksBorrowed', className: 'align-middle' }, 
           { data: 'Employment', className: 'align-middle' }, 
           { data: 'OfficeAddress', className: 'align-middle' }, 
           { data: 'HeadOfSchool', className: 'align-middle' }, 
           { data: 'ParentGuardian', className: 'align-middle' }, 
           { data: 'Remarks', className: 'align-middle' }, 
           { data: 'Borrowed', className: 'align-middle' }, 
           { data: 'Banned', className: 'align-middle' }, 
           { data: 'TranstoAlumni', className: 'align-middle' }, 
           { data: 'Encoder', className: 'align-middle' }, 
           { data: 'DateEncoded', className: 'align-middle' },  
           { data: 'id', className: 'align-middle text-right', orderable: false, searchable: false }],
      columnDefs: [{
        targets: 0,
        render: function render(data, type, row, meta) {
          return '<div class="custom-control custom-control-nolabel custom-checkbox">\n            <input type="checkbox"  class="memberid custom-control-input" name="selectedRow[]" id="p' + row.id + '" value="' + row.id + '">\n            <label class="custom-control-label" for="p' + row.id + '"></label>\n          </div>';
        }
      }, {
        targets: 27,
        render: function render(data, type, row, meta) {
          return '<a class="btn btn-sm btn-secondary" href="edit_u=' + data + '">Edit</a>\n          <a href="#" class="btn drop btn-sm btn-secondary" data-id="' + data + '">Drop</a>';
        }
      }, {
        targets: 1,
        render: function render(data, type, row, meta) {
          return ' <span id="'+row.id+'" name="MemberID" class="editable">'+row.MemberID+ '</span>';
        }
      }, {
        targets: 2,
        render: function render(data, type, row, meta) {
          return ' <span id="'+row.id+'" name="LastName" class="editable">'+row.LastName+ '</span>';
        }
      }, {
        targets: 3,
        render: function render(data, type, row, meta) {
          return ' <span id="'+row.id+'"  name="FirstName" class="editable">'+row.FirstName+ '</span>';
        }
      }, {
        targets: 4,
        render: function render(data, type, row, meta) {
          return ' <span id="'+row.id+'" name="MiddleName" class="editable">'+row.MiddleName+ '</span>';
        }
      }, {
        targets: 5,
        render: function render(data, type, row, meta) {
          return ' <span id="'+row.id+'" name="Address" class="editable">'+row.Address+ '</span>';
        }
      }, {
        targets: 6,
        render: function render(data, type, row, meta) {
          return ' <span id="'+row.id+'" name="BooksBorrowed" class="editable_num2">'+row.BooksBorrowed+ '</span>';
        }
      }, {
        targets: 7,
        render: function render(data, type, row, meta) {
          return ' <span id="'+row.id+'" name="PhoneNo" class="editable_num2">'+row.PhoneNo+ '</span>';
        }
      }, {
        targets: 8,
        render: function render(data, type, row, meta) {
          return ' <span id="'+row.id+'" name="CourseID" class="editable_c">'+row.Course+ '</span>';  
        }
      }, {
        targets: 9,
        render: function render(data, type, row, meta) {
          return ' <span id="'+row.id+'" name="YearID" class="editable_y">'+row.Year+ '</span>';
        }
      }, {
        targets: 10,
        render: function render(data, type, row, meta) {
          return ' <span id="'+row.id+'" name="TypeID" class="editable_t">'+row.Type+ '</span>';
        }
      }, {
        targets: 11,
        render: function render(data, type, row, meta) {
          return ' <span id="'+row.id+'"  data-id="sf'+row.id+'" name="SchoolYearFrom" class="editable_num">'+row.SchoolYearFrom+ '</span>';
          }
        }, {
          targets: 12,
          render: function render(data, type, row, meta) {
            return ' <span id="'+row.id+'" data-id="st'+row.id+'" name="SchoolYearTo" class="editable_num">'+row.SchoolYearTo+ '</span>';
          }
        }, {
          targets: 13,
          render: function render(data, type, row, meta) {
            return ' <span id="'+row.id+'" name="BirthDate" class="editable_date">'+row.BirthDate+ '</span>';
          }
        }, {
          targets: 14,
          render: function render(data, type, row, meta) {
            return ' <span id="'+row.id+'" name="DateEnlist" class="editable_date">'+row.DateEnlist+ '</span>';
          }
        }, {
          targets: 15,
          render: function render(data, type, row, meta) {
            return ' <span id="'+row.id+'" name="DatetoGrad" class="editable_date">'+row.DatetoGrad+ '</span>';
          }
        }, {
          targets: 16,
          render: function render(data, type, row, meta) {
            return ' <span id="'+row.id+'" name="CurBooksBorrowed" class="editable_num2">'+row.CurBooksBorrowed+ '</span>';
          }
        }, {
          targets: 17,
          render: function render(data, type, row, meta) {
            return ' <span id="'+row.id+'" name="Employment" class="editable">'+row.Employment+ '</span>';
          }
        }, {
          targets: 18,
          render: function render(data, type, row, meta) {
            return ' <span id="'+row.id+'" name="OfficeAddress" class="editable">'+row.OfficeAddress+ '</span>';
          }
        }, {
          targets: 19,
          render: function render(data, type, row, meta) {
            return ' <span id="'+row.id+'" name="HeadOfSchool" class="editable">'+row.HeadOfSchool+ '</span>';
          }
        }, {
          targets: 20,
          render: function render(data, type, row, meta) {
            return ' <span id="'+row.id+'" name="ParentGuardian" class="editable">'+row.ParentGuardian+ '</span>';
          }
          }, {
            targets: 21,
            render: function render(data, type, row, meta) {
              return ' <span id="'+row.id+'" data-id="rm'+row.id+'" name="Remarks" class="editable">'+row.Remarks+ '</span>';
            }
          }, {
            targets: 22,
            render: function render(data, type, row, meta) {
              return ' <span id="'+row.id+'" name="Borrowed" class="editable_num2">'+row.Borrowed+ '</span>';
            }
          }, {
            targets: 23,
            render: function render(data, type, row, meta) {
              return ' <span id="'+row.id+'" name="Banned" class="editable_num2">'+row.Banned+ '</span>';
            }
          }, {
            targets: 24,
            render: function render(data, type, row, meta) {
              return ' <span id="'+row.id+'" name="TranstoAlumni" class="editable_num2">'+row.TranstoAlumni+ '</span>';
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

getMembersAll.init();
