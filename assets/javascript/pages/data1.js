
function showdata(){
  var table = $('#myTable2').DataTable({
    dom: '<\'text-muted\'Bi>\n        <\'table-responsive\'tr>\n        <\'mt-4\'p>',
    paging: false, // Disable paging
    scrollY: '200px', // Vertical scroll height
     info: false, 
     ordering: false,
  scrollX: true,    // Enable horizontal scrolling
  scrollCollapse: true,
    autoWidth: false,
    ajax: 'www/get/GETALLBOOKSD=' + $('#myTable2').attr('data-id'),
    deferRender: true,
    order: [1, 'asc'],
    language: {
      zeroRecords: "Please fill the input fields below to add a new row",
    },
    
    columns: [
      { data: 'IDNo', className: 'col-checker align-middle', orderable: false, searchable: false }, 
     { data: 'ItemNo', className: 'align-middle' },
      { data: 'CourseID', className: 'align-middle' }, 
      { data: 'CopyRightYear', className: 'align-middle' },
       { data: 'DateReceived', className: 'align-middle' },
       { data: 'ISBNNumber', className: 'align-middle' },
        { data: 'EditionNumber', className: 'align-middle' },
         { data: 'PurchasePrice', className: 'align-middle' }, 
         { data: 'Supplier', className: 'align-middle' }, 
         { data: 'Recommendedby', className: 'align-middle' }, 
         { data: 'BPages', className: 'align-middle' }, 
         { data: 'Encoder', className: 'align-middle' }],
    columnDefs: [{
      targets: 0,
      render: function render(data, type, row, meta) {
        return ' <span id="'+row.IDNo+'" class="" name="IDNo" class=""></span>';
      }
    },{
      targets: 1,
      render: function render(data, type, row, meta) {
        return ' <span id="'+row.IDNo+'" class="editable" name="ItemNo" class="">'+row.ItemNo+ '</span>';
      }
    }, {
      targets: 2,
      render: function render(data, type, row, meta) {
        return ' <span id="'+row.IDNo+'" class="editable" name="CourseID" class="">'+row.CourseID+ '</span>';
      }
    }, {
      targets: 3,
      render: function render(data, type, row, meta) {
        return ' <span id="'+row.IDNo+'"  class="editable" name="CopyRightYear" class="">'+row.CopyRightYear+ '</span>';
      }
    }, {
      targets: 4,
      render: function render(data, type, row, meta) {
        return ' <span id="'+row.IDNo+'" class="editable_date" name="DateReceived" class="">'+row.DateReceived+ '</span>';
      }
    }, {
      targets: 5,
      render: function render(data, type, row, meta) {
        return ' <span id="'+row.IDNo+'" class="editable" name="ISBNNumber" class="">'+row.ISBNNumber+ '</span>';
      }
    }, {
      targets: 6,
      render: function render(data, type, row, meta) {
        return ' <span id="'+row.IDNo+'" class="editable" name="EditionNumber" class="">'+row.EditionNumber+ '</span>';
      }
    }, {
      targets: 7,
      render: function render(data, type, row, meta) {
        return ' <span id="'+row.IDNo+'" class="editable" name="PurchasePrice" class="">'+row.PurchasePrice+ '</span>';
      }
    }, {
      targets: 8,
      render: function render(data, type, row, meta) {
        return ' <span id="'+row.IDNo+'" class="editable" name="Supplier" class="">'+row.Supplier+ '</span>';
      }
    }, {
      targets: 9,
      render: function render(data, type, row, meta) {
        return ' <span id="'+row.IDNo+'" class="editable" name="Recommendedby" class="">'+row.Recommendedby+ '</span>';
      }
    }, {
      targets: 10,
      render: function render(data, type, row, meta) {
        return ' <span id="'+row.IDNo+'" class="editable" name="BPages" class="">'+row.BPages+ '</span>';
      }
    }, {
      targets: 11,
      render: function render(data, type, row, meta) {
        return ' <span id="'+row.IDNo+'" name="Encoder" class="">'+row.Encoder+ '</span>';
      }
    }]
  });
}
$(document).ready(function () {



    $(document).ready(function() {
      // Make an AJAX request to www/get/GETALLMEMBERGR
      $.ajax({
        ajax: 'www/get/GETALLBOOKSD=' + $('#myTable2').attr('data-id'),
        dataType: 'json', // Assumes the response is in JSON format
        success: function(response) {
          var tableContainer = $('.table-responsive'); // Get the table container element
    
          if (JSON.stringify(response) === JSON.stringify([{"data":[]}])) {
            // Response is empty, add "No data" message
            tableContainer.html('<p>No data</p>');
    
            // Set the DOM option for no data
            var dataTable = $('#myTable2').DataTable({
              dom: '<\'text-muted\'Bi>\n<\'table-responsive\'tr>\n<\'mt-4\'p>',
              buttons: []
            });
          } else {
            showdata();
          }
        },
        error: function(xhr, status, error) {
          console.error("Error fetching data:", error);
        }
      });
    });

      // Show input fields when DataTable is empty


      table.on('draw', function () {
        showEmptyRowAtEnd();
        emptyRowAdded = true;
    });






 
  function getCookie(name) {
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.startsWith(name + '=')) {
            return decodeURIComponent(cookie.substring(name.length + 1));
        }
    }
    return null;
}

var addcount = 0;
showEmptyRowAtEnd();
function showEmptyRowAtEnd() {
  var cookieValue = getCookie("username");
  addcount++;

  const emptyRowHtml = `
  <tr id="emptyRow">
    <td><i class="fas fa-star"></i></td>
    <td><input data-id='${addcount}' value="0" type="text" name="ItemNo" class="itemno form-control"></td>
    <td><input data-id='${addcount}' type="text" name="CourseID" class="courseid form-control"></td>
    <td><input data-id='${addcount}' type="text" name="CopyRightYear" class="cpyear form-control"></td>
    <td><input data-id='${addcount}' type="text" id="burecieve" name="DateReceived" class="daterecive form-control"></td>
    <td><input data-id='${addcount}' type="text" name="ISBNNumber" class="isbn form-control"></td>
    <td><input data-id='${addcount}' type="text" name="EditionNumber" class="editionnumber form-control"></td>
    <td><input data-id='${addcount}' type="text" name="PurchasePrice" class="pprice form-control"></td>
    <td><input data-id='${addcount}' type="text" name="Supplier" class="supplier form-control"></td>
    <td><input data-id='${addcount}' type="text" name="Recommendedby" class="recomend form-control"></td>
    <td><input data-id='${addcount}' type="text" name="BPages" class="bpages form-control"></td>
    <td><input data-id='${addcount}' type="text" name="Encoder" class="ed form-control" style="width:120px;" value='${cookieValue}'></td>
  </tr>
  `;

  $('#myTable2 tbody').append(emptyRowHtml);

  // Initialize pickers after adding the row
  pickers.init();

  $('#emptyRow input[name="Encoder"]').on('input', function () {
    // Get the original value from the "encoderCookie" cookie
    var originalEncoderValue = getCookie("username");
    
    if ($(this).val() !== originalEncoderValue) {
      // If the value has changed, reset it to the original value
      $(this).val(originalEncoderValue);
    }
  });
  
}
var clickCount = 0;
var addcount2 = 0;
function showEmptyRowAtEnd2() {
  var cookieValue = getCookie("username");
  addcount2++;

  const emptyRowHtml = `
  <tr id="emptyRow">
    <td><i class="fas fa-star"></i></td>

  
    <td><input data-id='${addcount2}' value="0" type="text" name="ItemNo" style="width: 84px;" class="itemno1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="AccessionNo"  style="width: 84px;" class="accessionno1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="Copies"  style="width: 84px;" class="copies1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="Location"  style="width: 84px;" class="location1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="BookLocation"  style="width: 84px;" class="booklocation1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="Source"  style="width: 84px;" class="source1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="Donor"  style="width: 84px;" class="donor1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="SubClass1"  style="width: 84px;" class="subclass11 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="SubClass2"  style="width: 84px;" class="subclass21 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="SubClass3"  style="width: 84px;" class="subclass31 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="SubClass4"  style="width: 84px;" class="subclass41 form-control "></td>
      <td> <select data-id='${addcount2}' name="Replacedfor"  style="width: 200px;" class="replacefor1 form-control"></select></td>
    <td><input data-id='${addcount2}' value ="In" type="text" name="Remarks"  style="width: 84px;" class="remarks1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="MR Page	"  style="width: 84px;" class="mrpage1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="Status"  style="width: 84px;" value='E' class="status1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="Encoder"  style="width: 84px;" class="encoder1 form-control " style="width:120px;" value='${cookieValue}'  style="border-radius: 0;"  style="border-radius: 0;"></td>
  </tr>
  `;

  $('#myTable3 tbody').append(emptyRowHtml);

  // Initialize pickers after adding the row
  pickers.init();

  $('#emptyRow input[name="Encoder"]').on('input', function () {
    // Get the original value from the "encoderCookie" cookie
    var originalEncoderValue = getCookie("username");
    
    if ($(this).val() !== originalEncoderValue) {
      // If the value has changed, reset it to the original value
      $(this).val(originalEncoderValue);
    }
  });
  clickCount = 0;

  $.ajax({
    url: 'GPLACE',
    dataType: 'json',
    success: function(data) {
    
      // Populate the select element with the data
      var select = $(`.replacefor1[data-id="${addcount2}"]`);


      select.append("$('<option value='null' class='formgroup' selected >Select</option>");
  
      $.each(data, function(index, item) {
        select.append($('<option>', {
          value: item.ID ,
          text: item.Title+", Accession No - "+item.AccessionNo
        }));
      });

      select.css({
        width: "100px",
        padding: "10px",
        "max-height": "200px",
        "overflow-y": "auto"
    });


    }
  });

  setTimeout(showempty, 1000); 

  function showempty(){

  
  $(".editable1").each(function() {
    var value = $(this).text().trim();
    if (value === "") {
        $(this).text("Not Set");
        value = "Not Set";
    }

});

  }
  
}
  jQuery(window).on("load", function () {
    localStorage.setItem("clickon", false);
    localStorage.setItem("ttopen", "false");
    if(localStorage.localid != ''){
      var id = localStorage.getItem("localid");
      $.ajax({
        url: 'getapid=' + id, // Pass the ID in the URL
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.length === 0) {
              var table = $('#myTable3');
              table.find('tr').not(':first').remove();
                $('#myTable3').find('tbody').append('<tr id="no-data-row"><td colspan="100" class="text-center">To add Fill the form above</td></tr>');
   

            }
            
            // Assuming all objects in 'data' have the same structure
            var firstItem = data[0];
            
            // Create table headers based on object properties
            var tableHeaders = '<tr>';
            for (var key in firstItem) {
                if (firstItem.hasOwnProperty(key)) {
                    tableHeaders += '<th>' + key + '</th>';
                }
            }
            tableHeaders += '</tr>';
           
            $('#myTable thead').html(tableHeaders); // Set table headers

            // Loop through the data and append rows
            $.each(data, function(index, item) {
                var newRow = '<tr>';
 
                for (var key in item) {
                  if (item.hasOwnProperty(key)) {
                    if (key === 'AccID') {
                      newRow += '<td ><span id="' + item.AccID + '"  style="display:none;" class="editable" name="' + key + '">' + item[key] + '</span></td>';
                    }else if (key === 'Replacedfor') {
                      newRow += '<td> <span id="' + item.AccID + '" class="editable2" name="' + key + '">' + item.Title + '</span></td>';
                    }else if(key =='Title'){
                      
                    } else {
                      newRow += '<td> <span id="' + item.AccID + '" class="editable1" name="' + key + '">' + item[key] + '</span></td>';
                    }
                  }
                }
                newRow += '</spa></tr>';

                $('#myTable3 tbody').append(newRow);
         
            });

            var addertm = setTimeout(showEmptyRowAtEnd2, 1000);

        },
        error: function(err) {
            console.error('Error fetching data:', err);
        }
    });

    }
    
    $(document).ready(function() {



      $('#myTable2').on('click', 'tr', function() {
        if(localStorage.getItem("clickon") != null && localStorage.getItem("clickon") =="true"){
          alert("Please finish the current transaction first or reload this page")
        }else{
        var id = $(this).attr('id');
   
        if (clickCount > 0) {

        }else{
          clickCount++;
        

        if (id === 'emptyRow') {
         
        }else{
          var table = $('#myTable3');

          // Remove all tr elements from the table except for the first row
          table.find('tr').not(':first').remove();
        var span = $(this).find('span');
       
        // Get the ID of the <span> element
        var id = span.attr('id');
        localStorage.setItem("localid", id);

      
        $.ajax({
          url: 'getapid=' + id, // Pass the ID in the URL
          method: 'GET',
          dataType: 'json',
          success: function(data) {
              if (data.length === 0) {
                var table = $('#myTable3');
                table.find('tr').not(':first').remove();
                  $('#myTable3').find('tbody').append('<tr id="no-data-row"><td colspan="100" class="text-center">To add Fill the form above</td></tr>');
     

              }
              
              // Assuming all objects in 'data' have the same structure
              var firstItem = data[0];
              
              // Create table headers based on object properties
              var tableHeaders = '<tr>';
              for (var key in firstItem) {
                  if (firstItem.hasOwnProperty(key)) {
                      tableHeaders += '<th>' + key + '</th>';
                  }
              }
              tableHeaders += '</tr>';
             
              $('#myTable thead').html(tableHeaders); // Set table headers
      
              // Loop through the data and append rows
              $.each(data, function(index, item) {
                  var newRow = '<tr>';
   
                  for (var key in item) {
                      if (item.hasOwnProperty(key)) {
                        if (key === 'AccID') {
                          newRow += '<td ><span id="' + item.AccID + '"  style="display:none;" class="editable" name="' + key + '">' + item[key] + '</span></td>';
                        }else if (key === 'Replacedfor') {
                          newRow += '<td> <span id="' + item.AccID + '" class="editable2" name="' + key + '">' + item[key] + '</span></td>';
                        } else {
                          newRow += '<td> <span id="' + item.AccID + '" class="editable1" name="' + key + '">' + item[key] + '</span></td>';
                        }
                      }
                  }
                  newRow += '</tr>';

                  $('#myTable3 tbody').append(newRow);
           
              });

              var addertm = setTimeout(showEmptyRowAtEnd2, 1000);

          },
          error: function(err) {
              console.error('Error fetching data:', err);
          }
      });
 
    }
  }
}
      });
      
      
      
    });

    setTimeout(reloads1, 1000);
    let add = 0;
    
    const inputValue = $('.itemno[data-id="' + addcount + '"]').val();
    let latestGeneratedDataId = 0;
    let isFirstClick = true;
    
    $(document).on('click', '.itemno', function() {
        const clickedDataId = $(this).data('id');
        
        if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
            const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
            const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
            const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
            const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
            const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
            const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
            const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
            const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
            const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
            const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
            const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
            let itemval = 0;
            let courseval = 0;
            let cpyearval = 0;
            let datereciveval = 0;
            let isbnval = 0;
            let editionnumberval = 0;
            let ppriceval = 0;
            let supplierval = 0;
            let recomendval = 0;
            let bpagesval = 0;
            let edval = 0;
            if(itemno.length === 0 || itemno.val().trim() !== "" ) {
                itemval = itemno.val();
            }else{
              itemval = null;
            }

            if(courseid.length === 0 || courseid.val().trim() !== "" ) {
                courseval = courseid.val();
            }else{
              courseval = null;
            }

            if(cpyear.length === 0 || cpyear.val().trim() !== "" ) {
                cpyearval = cpyear.val();
            }else{
              cpyearval = null;
            }

            if(daterecive.length === 0 || daterecive.val().trim() !== "" ) {
                datereciveval = daterecive.val();
            }else{
              datereciveval = null;
            }

            if(isbn.length === 0 || isbn.val().trim() !== "" ) {
                isbnval = isbn.val();
            }else{
              isbnval = null;
            }

            if(editionnumber.length === 0 || editionnumber.val().trim() !== "" ) {
                editionnumberval = editionnumber.val();
            }else{
              editionnumberval = null;
            }

            if(pprice.length === 0 || pprice.val().trim() !== "" ) {
                ppriceval = pprice.val();
            }else{
              ppriceval = null;

            }

            if(supplier.length === 0 || supplier.val().trim() !== "" ) {
                supplierval = supplier.val();
            }else{
              supplierval = null;

            }

            if(recomend.length === 0 || recomend.val().trim() !== "" ) {
                recomendval = recomend.val();
            }else{
              recomendval = null;

            }

            if(bpages.length === 0 || bpages.val().trim() !== "" ) {
                bpagesval = bpages.val();
            }else{
              bpagesval = null;

            }

            if(ed.length === 0 || ed.val().trim() !== "" ) {
                edval = ed.val();
            }else{
              edval = null;

            }



                if (!isFirstClick) {
                  if (cpyearval == null) {
                    alert("Please dont leave Copyright Field blanks");
                  }else if (datereciveval == null) {
                    alert("Please dont leave Date Recieve Field blanks");
                  }else{
                    const table = $('#myTable2').DataTable();
                    
                      isFirstClick = true;
                      setTimeout(showEmptyRowAtEnd, 1000);
                      setTimeout(reloads1, 1000);

                      $.ajax({
                        url: 'insertbookprop',
                        type: 'POST',
                        data: {
                            itemno: itemval,
                            courseid: courseval,
                            cpyear: cpyearval,
                            daterecives: datereciveval,
                            isbn: isbnval,
                            editionnumber: editionnumberval,
                            pprice: ppriceval,
                            supplier: supplierval,
                            recomend: recomendval,
                            bpages: bpagesval,
                            encoder: edval,
                            bookid: $('#drop').attr('data-id')
                
                            // Add any additional data you want to send
                        },
                        success: function (response) {
                            // Handle the successful response here
                            console.log('Success:', response);
                            table.ajax.reload();
                         location.reload();

                        },
                        error: function (xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                        }
                    });
                    
                 
                  }
    

                    
                } else {
                    isFirstClick = false;
                    showEmptyRowAtEnd();
                    latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
                }

        } else {
            // Handle other cases if needed
        }
    });


    $(document).on('click', '.courseid', function() {
      const clickedDataId = $(this).data('id');
      
      if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
          const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
          const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
          const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
          const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
          const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
          const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
          const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
          const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
          const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
          const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
          const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
          let itemval = 0;
          let courseval = 0;
          let cpyearval = 0;
          let datereciveval = 0;
          let isbnval = 0;
          let editionnumberval = 0;
          let ppriceval = 0;
          let supplierval = 0;
          let recomendval = 0;
          let bpagesval = 0;
          let edval = 0;
          if(itemno.length === 0 || itemno.val().trim() !== "" ) {
              itemval = itemno.val();
          }else{
            itemval = null;
          }

          if(courseid.length === 0 || courseid.val().trim() !== "" ) {
              courseval = courseid.val();
          }else{
            courseval = null;
          }

          if(cpyear.length === 0 || cpyear.val().trim() !== "" ) {
              cpyearval = cpyear.val();
          }else{
            cpyearval = null;
          }

          if(daterecive.length === 0 || daterecive.val().trim() !== "" ) {
              datereciveval = daterecive.val();
          }else{
            datereciveval = null;
          }

          if(isbn.length === 0 || isbn.val().trim() !== "" ) {
              isbnval = isbn.val();
          }else{
            isbnval = null;
          }

          if(editionnumber.length === 0 || editionnumber.val().trim() !== "" ) {
              editionnumberval = editionnumber.val();
          }else{
            editionnumberval = null;
          }

          if(pprice.length === 0 || pprice.val().trim() !== "" ) {
              ppriceval = pprice.val();
          }else{
            ppriceval = null;

          }

          if(supplier.length === 0 || supplier.val().trim() !== "" ) {
              supplierval = supplier.val();
          }else{
            supplierval = null;

          }

          if(recomend.length === 0 || recomend.val().trim() !== "" ) {
              recomendval = recomend.val();
          }else{
            recomendval = null;

          }

          if(bpages.length === 0 || bpages.val().trim() !== "" ) {
              bpagesval = bpages.val();
          }else{
            bpagesval = null;

          }

          if(ed.length === 0 || ed.val().trim() !== "" ) {
              edval = ed.val();
          }else{
            edval = null;

          }



              if (!isFirstClick) {
                if (cpyearval == null) {
                  alert("Please dont leave Copyright Field blanks");
                }else if (datereciveval == null) {
                  alert("Please dont leave Date Recieve Field blanks");
                }else{
                  const table = $('#myTable2').DataTable();
      
                    isFirstClick = true;
                    setTimeout(showEmptyRowAtEnd, 1000);
                    setTimeout(reloads1, 1000);

                    $.ajax({
                      url: 'insertbookprop',
                      type: 'POST',
                      data: {
                          itemno: itemval,
                          courseid: courseval,
                          cpyear: cpyearval,
                          daterecives: datereciveval,
                          isbn: isbnval,
                          editionnumber: editionnumberval,
                          pprice: ppriceval,
                          supplier: supplierval,
                          recomend: recomendval,
                          bpages: bpagesval,
                          encoder: edval,
                          bookid: $('#drop').attr('data-id')
              
                          // Add any additional data you want to send
                      },
                      success: function (response) {
                          // Handle the successful response here
                          console.log('Success:', response);
                          table.ajax.reload();
                       location.reload();

                      },
                      error: function (xhr, status, error) {
                          // Handle any errors here
                          console.error('Error:', error);
                      }
                  });
                  
              
                }
  

                  
              } else {
                  isFirstClick = false;
                  showEmptyRowAtEnd();
                  latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
              }

      } else {
          // Handle other cases if needed
      }
  });

  $(document).on('click', '.cpyear', function() {
    const clickedDataId = $(this).data('id');
    
    if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
        const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
        const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
        const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
        const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
        const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
        const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
        const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
        const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
        const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
        const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
        const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
        let itemval = 0;
        let courseval = 0;
        let cpyearval = 0;
        let datereciveval = 0;
        let isbnval = 0;
        let editionnumberval = 0;
        let ppriceval = 0;
        let supplierval = 0;
        let recomendval = 0;
        let bpagesval = 0;
        let edval = 0;
        if(itemno.length === 0 || itemno.val().trim() !== "" ) {
            itemval = itemno.val();
        }else{
          itemval = null;
        }

        if(courseid.length === 0 || courseid.val().trim() !== "" ) {
            courseval = courseid.val();
        }else{
          courseval = null;
        }

        if(cpyear.length === 0 || cpyear.val().trim() !== "" ) {
            cpyearval = cpyear.val();
        }else{
          cpyearval = null;
        }

        if(daterecive.length === 0 || daterecive.val().trim() !== "" ) {
            datereciveval = daterecive.val();
        }else{
          datereciveval = null;
        }

        if(isbn.length === 0 || isbn.val().trim() !== "" ) {
            isbnval = isbn.val();
        }else{
          isbnval = null;
        }

        if(editionnumber.length === 0 || editionnumber.val().trim() !== "" ) {
            editionnumberval = editionnumber.val();
        }else{
          editionnumberval = null;
        }

        if(pprice.length === 0 || pprice.val().trim() !== "" ) {
            ppriceval = pprice.val();
        }else{
          ppriceval = null;

        }

        if(supplier.length === 0 || supplier.val().trim() !== "" ) {
            supplierval = supplier.val();
        }else{
          supplierval = null;

        }

        if(recomend.length === 0 || recomend.val().trim() !== "" ) {
            recomendval = recomend.val();
        }else{
          recomendval = null;

        }

        if(bpages.length === 0 || bpages.val().trim() !== "" ) {
            bpagesval = bpages.val();
        }else{
          bpagesval = null;

        }

        if(ed.length === 0 || ed.val().trim() !== "" ) {
            edval = ed.val();
        }else{
          edval = null;

        }



            if (!isFirstClick) {
              if (cpyearval == null) {
                alert("Please dont leave Copyright Field blanks");
              }else if (datereciveval == null) {
                alert("Please dont leave Date Recieve Field blanks");
              }else{
                const table = $('#myTable2').DataTable();
  
                  isFirstClick = true;
                  setTimeout(showEmptyRowAtEnd, 1000);
                  setTimeout(reloads1, 1000);

                  $.ajax({
                    url: 'insertbookprop',
                    type: 'POST',
                    data: {
                        itemno: itemval,
                        courseid: courseval,
                        cpyear: cpyearval,
                        daterecives: datereciveval,
                        isbn: isbnval,
                        editionnumber: editionnumberval,
                        pprice: ppriceval,
                        supplier: supplierval,
                        recomend: recomendval,
                        bpages: bpagesval,
                        encoder: edval,
                        bookid: $('#drop').attr('data-id')
            
                        // Add any additional data you want to send
                    },
                    success: function (response) {
                        // Handle the successful response here
                        console.log('Success:', response);
                        table.ajax.reload();
                     location.reload();

                    },
                    error: function (xhr, status, error) {
                        // Handle any errors here
                        console.error('Error:', error);
                    }
                });
           
              }


                
            } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
            }

    } else {
        // Handle other cases if needed
    }
});


$(document).on('click', '.daterecive', function() {
  const clickedDataId = $(this).data('id');
  
  if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
      const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
      const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
      const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
      const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
      const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
      const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
      const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
      const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
      const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
      const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
      const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
      let itemval = 0;
      let courseval = 0;
      let cpyearval = 0;
      let datereciveval = 0;
      let isbnval = 0;
      let editionnumberval = 0;
      let ppriceval = 0;
      let supplierval = 0;
      let recomendval = 0;
      let bpagesval = 0;
      let edval = 0;
      if(itemno.length === 0 || itemno.val().trim() !== "" ) {
          itemval = itemno.val();
      }else{
        itemval = null;
      }

      if(courseid.length === 0 || courseid.val().trim() !== "" ) {
          courseval = courseid.val();
      }else{
        courseval = null;
      }

      if(cpyear.length === 0 || cpyear.val().trim() !== "" ) {
          cpyearval = cpyear.val();
      }else{
        cpyearval = null;
      }

      if(daterecive.length === 0 || daterecive.val().trim() !== "" ) {
          datereciveval = daterecive.val();
      }else{
        datereciveval = null;
      }

      if(isbn.length === 0 || isbn.val().trim() !== "" ) {
          isbnval = isbn.val();
      }else{
        isbnval = null;
      }

      if(editionnumber.length === 0 || editionnumber.val().trim() !== "" ) {
          editionnumberval = editionnumber.val();
      }else{
        editionnumberval = null;
      }

      if(pprice.length === 0 || pprice.val().trim() !== "" ) {
          ppriceval = pprice.val();
      }else{
        ppriceval = null;

      }

      if(supplier.length === 0 || supplier.val().trim() !== "" ) {
          supplierval = supplier.val();
      }else{
        supplierval = null;

      }

      if(recomend.length === 0 || recomend.val().trim() !== "" ) {
          recomendval = recomend.val();
      }else{
        recomendval = null;

      }

      if(bpages.length === 0 || bpages.val().trim() !== "" ) {
          bpagesval = bpages.val();
      }else{
        bpagesval = null;

      }

      if(ed.length === 0 || ed.val().trim() !== "" ) {
          edval = ed.val();
      }else{
        edval = null;

      }



          if (!isFirstClick) {
            if (cpyearval == null) {
              alert("Please dont leave Copyright Field blanks");
            }else if (datereciveval == null) {
              alert("Please dont leave Date Recieve Field blanks");
            }else{
              const table = $('#myTable2').DataTable();
  
                isFirstClick = true;
                setTimeout(showEmptyRowAtEnd, 1000);
                setTimeout(reloads1, 1000);

                $.ajax({
                  url: 'insertbookprop',
                  type: 'POST',
                  data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')
          
                      // Add any additional data you want to send
                  },
                  success: function (response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                   location.reload();

                  },
                  error: function (xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                  }
              });
              
         
            }


              
          } else {
              isFirstClick = false;
              showEmptyRowAtEnd();
              latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
          }

  } else {
      // Handle other cases if needed
  }
});

$(document).on('click', '.isbn', function() {
  const clickedDataId = $(this).data('id');
  
  if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
      const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
      const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
      const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
      const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
      const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
      const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
      const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
      const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
      const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
      const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
      const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
      let itemval = 0;
      let courseval = 0;
      let cpyearval = 0;
      let datereciveval = 0;
      let isbnval = 0;
      let editionnumberval = 0;
      let ppriceval = 0;
      let supplierval = 0;
      let recomendval = 0;
      let bpagesval = 0;
      let edval = 0;
      if(itemno.length === 0 || itemno.val().trim() !== "" ) {
          itemval = itemno.val();
      }else{
        itemval = null;
      }

      if(courseid.length === 0 || courseid.val().trim() !== "" ) {
          courseval = courseid.val();
      }else{
        courseval = null;
      }

      if(cpyear.length === 0 || cpyear.val().trim() !== "" ) {
          cpyearval = cpyear.val();
      }else{
        cpyearval = null;
      }

      if(daterecive.length === 0 || daterecive.val().trim() !== "" ) {
          datereciveval = daterecive.val();
      }else{
        datereciveval = null;
      }

      if(isbn.length === 0 || isbn.val().trim() !== "" ) {
          isbnval = isbn.val();
      }else{
        isbnval = null;
      }

      if(editionnumber.length === 0 || editionnumber.val().trim() !== "" ) {
          editionnumberval = editionnumber.val();
      }else{
        editionnumberval = null;
      }

      if(pprice.length === 0 || pprice.val().trim() !== "" ) {
          ppriceval = pprice.val();
      }else{
        ppriceval = null;

      }

      if(supplier.length === 0 || supplier.val().trim() !== "" ) {
          supplierval = supplier.val();
      }else{
        supplierval = null;

      }

      if(recomend.length === 0 || recomend.val().trim() !== "" ) {
          recomendval = recomend.val();
      }else{
        recomendval = null;

      }

      if(bpages.length === 0 || bpages.val().trim() !== "" ) {
          bpagesval = bpages.val();
      }else{
        bpagesval = null;

      }

      if(ed.length === 0 || ed.val().trim() !== "" ) {
          edval = ed.val();
      }else{
        edval = null;

      }



          if (!isFirstClick) {
            if (cpyearval == null) {
              alert("Please dont leave Copyright Field blanks");
            }else if (datereciveval == null) {
              alert("Please dont leave Date Recieve Field blanks");
            }else{
              const table = $('#myTable2').DataTable();
    
                isFirstClick = true;
                setTimeout(showEmptyRowAtEnd, 1000);
                setTimeout(reloads1, 1000);

                $.ajax({
                  url: 'insertbookprop',
                  type: 'POST',
                  data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')
          
                      // Add any additional data you want to send
                  },
                  success: function (response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                   location.reload();

                  },
                  error: function (xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                  }
         
              
              });
            }


              
          } else {
              isFirstClick = false;
              showEmptyRowAtEnd();
              latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
          }

  } else {
      // Handle other cases if needed
  }
});

$(document).on('click', '.editionnumber', function() {
  const clickedDataId = $(this).data('id');
  
  if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
      const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
      const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
      const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
      const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
      const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
      const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
      const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
      const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
      const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
      const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
      const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
      let itemval = 0;
      let courseval = 0;
      let cpyearval = 0;
      let datereciveval = 0;
      let isbnval = 0;
      let editionnumberval = 0;
      let ppriceval = 0;
      let supplierval = 0;
      let recomendval = 0;
      let bpagesval = 0;
      let edval = 0;
      if(itemno.length === 0 || itemno.val().trim() !== "" ) {
          itemval = itemno.val();
      }else{
        itemval = null;
      }

      if(courseid.length === 0 || courseid.val().trim() !== "" ) {
          courseval = courseid.val();
      }else{
        courseval = null;
      }

      if(cpyear.length === 0 || cpyear.val().trim() !== "" ) {
          cpyearval = cpyear.val();
      }else{
        cpyearval = null;
      }

      if(daterecive.length === 0 || daterecive.val().trim() !== "" ) {
          datereciveval = daterecive.val();
      }else{
        datereciveval = null;
      }

      if(isbn.length === 0 || isbn.val().trim() !== "" ) {
          isbnval = isbn.val();
      }else{
        isbnval = null;
      }

      if(editionnumber.length === 0 || editionnumber.val().trim() !== "" ) {
          editionnumberval = editionnumber.val();
      }else{
        editionnumberval = null;
      }

      if(pprice.length === 0 || pprice.val().trim() !== "" ) {
          ppriceval = pprice.val();
      }else{
        ppriceval = null;

      }

      if(supplier.length === 0 || supplier.val().trim() !== "" ) {
          supplierval = supplier.val();
      }else{
        supplierval = null;

      }

      if(recomend.length === 0 || recomend.val().trim() !== "" ) {
          recomendval = recomend.val();
      }else{
        recomendval = null;

      }

      if(bpages.length === 0 || bpages.val().trim() !== "" ) {
          bpagesval = bpages.val();
      }else{
        bpagesval = null;

      }

      if(ed.length === 0 || ed.val().trim() !== "" ) {
          edval = ed.val();
      }else{
        edval = null;

      }



          if (!isFirstClick) {
            if (cpyearval == null) {
              alert("Please dont leave Copyright Field blanks");
            }else if (datereciveval == null) {
              alert("Please dont leave Date Recieve Field blanks");
            }else{
              const table = $('#myTable2').DataTable();
  
                isFirstClick = true;
                setTimeout(showEmptyRowAtEnd, 1000);
                setTimeout(reloads1, 1000);

                $.ajax({
                  url: 'insertbookprop',
                  type: 'POST',
                  data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')
          
                      // Add any additional data you want to send
                  },
                  success: function (response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                   location.reload();

                  },
                  error: function (xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                  }
              });
      
            }


              
          } else {
              isFirstClick = false;
              showEmptyRowAtEnd();
              latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
          }

  } else {
      // Handle other cases if needed
  }
});


$(document).on('click', '.pprice', function() {
  const clickedDataId = $(this).data('id');
  
  if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
      const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
      const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
      const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
      const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
      const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
      const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
      const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
      const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
      const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
      const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
      const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
      let itemval = 0;
      let courseval = 0;
      let cpyearval = 0;
      let datereciveval = 0;
      let isbnval = 0;
      let editionnumberval = 0;
      let ppriceval = 0;
      let supplierval = 0;
      let recomendval = 0;
      let bpagesval = 0;
      let edval = 0;
      if(itemno.length === 0 || itemno.val().trim() !== "" ) {
          itemval = itemno.val();
      }else{
        itemval = null;
      }

      if(courseid.length === 0 || courseid.val().trim() !== "" ) {
          courseval = courseid.val();
      }else{
        courseval = null;
      }

      if(cpyear.length === 0 || cpyear.val().trim() !== "" ) {
          cpyearval = cpyear.val();
      }else{
        cpyearval = null;
      }

      if(daterecive.length === 0 || daterecive.val().trim() !== "" ) {
          datereciveval = daterecive.val();
      }else{
        datereciveval = null;
      }

      if(isbn.length === 0 || isbn.val().trim() !== "" ) {
          isbnval = isbn.val();
      }else{
        isbnval = null;
      }

      if(editionnumber.length === 0 || editionnumber.val().trim() !== "" ) {
          editionnumberval = editionnumber.val();
      }else{
        editionnumberval = null;
      }

      if(pprice.length === 0 || pprice.val().trim() !== "" ) {
          ppriceval = pprice.val();
      }else{
        ppriceval = null;

      }

      if(supplier.length === 0 || supplier.val().trim() !== "" ) {
          supplierval = supplier.val();
      }else{
        supplierval = null;

      }

      if(recomend.length === 0 || recomend.val().trim() !== "" ) {
          recomendval = recomend.val();
      }else{
        recomendval = null;

      }

      if(bpages.length === 0 || bpages.val().trim() !== "" ) {
          bpagesval = bpages.val();
      }else{
        bpagesval = null;

      }

      if(ed.length === 0 || ed.val().trim() !== "" ) {
          edval = ed.val();
      }else{
        edval = null;

      }



          if (!isFirstClick) {
            if (cpyearval == null) {
              alert("Please dont leave Copyright Field blanks");
            }else if (datereciveval == null) {
              alert("Please dont leave Date Recieve Field blanks");
            }else{
              const table = $('#myTable2').DataTable();
  
                isFirstClick = true;
                setTimeout(showEmptyRowAtEnd, 1000);
                setTimeout(reloads1, 1000);

                $.ajax({
                  url: 'insertbookprop',
                  type: 'POST',
                  data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')
          
                      // Add any additional data you want to send
                  },
                  success: function (response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                   location.reload();

                  },
                  error: function (xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                  }
              });
              
         
            }


              
          } else {
              isFirstClick = false;
              showEmptyRowAtEnd();
              latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
          }

  } else {
      // Handle other cases if needed
  }
});


$(document).on('click', '.supplier', function() {
  const clickedDataId = $(this).data('id');
  
  if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
      const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
      const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
      const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
      const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
      const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
      const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
      const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
      const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
      const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
      const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
      const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
      let itemval = 0;
      let courseval = 0;
      let cpyearval = 0;
      let datereciveval = 0;
      let isbnval = 0;
      let editionnumberval = 0;
      let ppriceval = 0;
      let supplierval = 0;
      let recomendval = 0;
      let bpagesval = 0;
      let edval = 0;
      if(itemno.length === 0 || itemno.val().trim() !== "" ) {
          itemval = itemno.val();
      }else{
        itemval = null;
      }

      if(courseid.length === 0 || courseid.val().trim() !== "" ) {
          courseval = courseid.val();
      }else{
        courseval = null;
      }

      if(cpyear.length === 0 || cpyear.val().trim() !== "" ) {
          cpyearval = cpyear.val();
      }else{
        cpyearval = null;
      }

      if(daterecive.length === 0 || daterecive.val().trim() !== "" ) {
          datereciveval = daterecive.val();
      }else{
        datereciveval = null;
      }

      if(isbn.length === 0 || isbn.val().trim() !== "" ) {
          isbnval = isbn.val();
      }else{
        isbnval = null;
      }

      if(editionnumber.length === 0 || editionnumber.val().trim() !== "" ) {
          editionnumberval = editionnumber.val();
      }else{
        editionnumberval = null;
      }

      if(pprice.length === 0 || pprice.val().trim() !== "" ) {
          ppriceval = pprice.val();
      }else{
        ppriceval = null;

      }

      if(supplier.length === 0 || supplier.val().trim() !== "" ) {
          supplierval = supplier.val();
      }else{
        supplierval = null;

      }

      if(recomend.length === 0 || recomend.val().trim() !== "" ) {
          recomendval = recomend.val();
      }else{
        recomendval = null;

      }

      if(bpages.length === 0 || bpages.val().trim() !== "" ) {
          bpagesval = bpages.val();
      }else{
        bpagesval = null;

      }

      if(ed.length === 0 || ed.val().trim() !== "" ) {
          edval = ed.val();
      }else{
        edval = null;

      }



          if (!isFirstClick) {
            if (cpyearval == null) {
              alert("Please dont leave Copyright Field blanks");
            }else if (datereciveval == null) {
              alert("Please dont leave Date Recieve Field blanks");
            }else{
              const table = $('#myTable2').DataTable();

                isFirstClick = true;
                setTimeout(showEmptyRowAtEnd, 1000);
                setTimeout(reloads1, 1000);

                $.ajax({
                  url: 'insertbookprop',
                  type: 'POST',
                  data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')
          
                      // Add any additional data you want to send
                  },
                  success: function (response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                   location.reload();

                  },
                  error: function (xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                  }
              });
              
            
            }


              
          } else {
              isFirstClick = false;
              showEmptyRowAtEnd();
              latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
          }

  } else {
      // Handle other cases if needed
  }
});

$(document).on('click', '.recomend', function() {
  const clickedDataId = $(this).data('id');
  
  if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
      const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
      const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
      const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
      const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
      const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
      const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
      const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
      const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
      const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
      const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
      const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
      let itemval = 0;
      let courseval = 0;
      let cpyearval = 0;
      let datereciveval = 0;
      let isbnval = 0;
      let editionnumberval = 0;
      let ppriceval = 0;
      let supplierval = 0;
      let recomendval = 0;
      let bpagesval = 0;
      let edval = 0;
      if(itemno.length === 0 || itemno.val().trim() !== "" ) {
          itemval = itemno.val();
      }else{
        itemval = null;
      }

      if(courseid.length === 0 || courseid.val().trim() !== "" ) {
          courseval = courseid.val();
      }else{
        courseval = null;
      }

      if(cpyear.length === 0 || cpyear.val().trim() !== "" ) {
          cpyearval = cpyear.val();
      }else{
        cpyearval = null;
      }

      if(daterecive.length === 0 || daterecive.val().trim() !== "" ) {
          datereciveval = daterecive.val();
      }else{
        datereciveval = null;
      }

      if(isbn.length === 0 || isbn.val().trim() !== "" ) {
          isbnval = isbn.val();
      }else{
        isbnval = null;
      }

      if(editionnumber.length === 0 || editionnumber.val().trim() !== "" ) {
          editionnumberval = editionnumber.val();
      }else{
        editionnumberval = null;
      }

      if(pprice.length === 0 || pprice.val().trim() !== "" ) {
          ppriceval = pprice.val();
      }else{
        ppriceval = null;

      }

      if(supplier.length === 0 || supplier.val().trim() !== "" ) {
          supplierval = supplier.val();
      }else{
        supplierval = null;

      }

      if(recomend.length === 0 || recomend.val().trim() !== "" ) {
          recomendval = recomend.val();
      }else{
        recomendval = null;

      }

      if(bpages.length === 0 || bpages.val().trim() !== "" ) {
          bpagesval = bpages.val();
      }else{
        bpagesval = null;

      }

      if(ed.length === 0 || ed.val().trim() !== "" ) {
          edval = ed.val();
      }else{
        edval = null;

      }



          if (!isFirstClick) {
            if (cpyearval == null) {
              alert("Please dont leave Copyright Field blanks");
            }else if (datereciveval == null) {
              alert("Please dont leave Date Recieve Field blanks");
            }else{
              const table = $('#myTable2').DataTable();
     
                isFirstClick = true;
                setTimeout(showEmptyRowAtEnd, 1000);
                setTimeout(reloads1, 1000);

                $.ajax({
                  url: 'insertbookprop',
                  type: 'POST',
                  data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')
          
                      // Add any additional data you want to send
                  },
                  success: function (response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                   location.reload();

                  },
                  error: function (xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                  }
              });
              
       
            }


              
          } else {
              isFirstClick = false;
              showEmptyRowAtEnd();
              latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
          }

  } else {
      // Handle other cases if needed
  }
});


$(document).on('click', '.bpages', function() {
  const clickedDataId = $(this).data('id');
  
  if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
      const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
      const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
      const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
      const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
      const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
      const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
      const pprice = $('.pprice[data-id=wedValues "' + (clickedDataId - 1) + '"]');
      const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
      const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
      const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
      const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
      let itemval = 0;
      let courseval = 0;
      let cpyearval = 0;
      let datereciveval = 0;
      let isbnval = 0;
      let editionnumberval = 0;
      let ppriceval = 0;
      let supplierval = 0;
      let recomendval = 0;
      let bpagesval = 0;
      let edval = 0;
      if(itemno.length === 0 || itemno.val().trim() !== "" ) {
          itemval = itemno.val();
      }else{
        itemval = null;
      }

      if(courseid.length === 0 || courseid.val().trim() !== "" ) {
          courseval = courseid.val();
      }else{
        courseval = null;
      }

      if(cpyear.length === 0 || cpyear.val().trim() !== "" ) {
          cpyearval = cpyear.val();
      }else{
        cpyearval = null;
      }

      if(daterecive.length === 0 || daterecive.val().trim() !== "" ) {
          datereciveval = daterecive.val();
      }else{
        datereciveval = null;
      }

      if(isbn.length === 0 || isbn.val().trim() !== "" ) {
          isbnval = isbn.val();
      }else{
        isbnval = null;
      }

      if(editionnumber.length === 0 || editionnumber.val().trim() !== "" ) {
          editionnumberval = editionnumber.val();
      }else{
        editionnumberval = null;
      }

      if(pprice.length === 0 || pprice.val().trim() !== "" ) {
          ppriceval = pprice.val();
      }else{
        ppriceval = null;

      }

      if(supplier.length === 0 || supplier.val().trim() !== "" ) {
          supplierval = supplier.val();
      }else{
        supplierval = null;

      }

      if(recomend.length === 0 || recomend.val().trim() !== "" ) {
          recomendval = recomend.val();
      }else{
        recomendval = null;

      }

      if(bpages.length === 0 || bpages.val().trim() !== "" ) {
          bpagesval = bpages.val();
      }else{
        bpagesval = null;

      }

      if(ed.length === 0 || ed.val().trim() !== "" ) {
          edval = ed.val();
      }else{
        edval = null;

      }



          if (!isFirstClick) {
            if (cpyearval == null) {
              alert("Please dont leave Copyright Field blanks");
            }else if (datereciveval == null) {
              alert("Please dont leave Date Recieve Field blanks");
            }else{
              const table = $('#myTable2').DataTable();

                isFirstClick = true;
                setTimeout(showEmptyRowAtEnd, 1000);
                setTimeout(reloads1, 1000);

                $.ajax({
                  url: 'insertbookprop',
                  type: 'POST',
                  data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')
          
                      // Add any additional data you want to send
                  },
                  success: function (response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                   location.reload();

                  },
                  error: function (xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                  }
              });
              
          
            }


              
          } else {
              isFirstClick = false;
              showEmptyRowAtEnd();
              latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
          }

  } else {
      // Handle other cases if needed
  }
});
    function reloads1(){
      const table = $('#myTable2').DataTable();
      var $scrollBody = $(table.table().node()).parent();
      $scrollBody.scrollTop($scrollBody.get(0).scrollHeight);
    }
    
  
    
    
    
    
    
    
  


    let add1 = 0;
    
    const inputValue1 = $('.itemno1[data-id="' + addcount2 + '"]').val();
    let latestGeneratedDataId1 = 0;
    let isFirstClick1 = true;

    $(document).on('click', '.itemno1', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0 ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });

    $(document).on('click', '.accessionno1', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });

    $(document).on('click', '.copies1', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0  ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });

    $(document).on('click', '.location1', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0 ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });
  

    $(document).on('click', '.booklocation1', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0  ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });


    $(document).on('click', '.source1', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });


    $(document).on('click', '.donor1', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0  ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });


    $(document).on('click', '.subclass11', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0  ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });


    $(document).on('click', '.subclass21', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0  ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });


    $(document).on('click', '.subclass31', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0  ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });


    $(document).on('click', '.subclass41', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0  ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });


    $(document).on('click', '.replacefor1', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0  ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });


    $(document).on('click', '.remarks1', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0  ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });


    $(document).on('click', '.mrpage1', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0  ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });


    $(document).on('click', '.status1', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0  ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });
  
    $(document).on('click', '.encoder1', function() {
      const clickedDataId1= $(this).data('id');


      if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
          const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
          const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
          const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
          const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
          const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
          const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
          const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
          const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
          const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
          const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
          const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
          const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
          let item1val = 0;
          let accessionno1val = 0;
          let copies1val = 0;
          let location1val = 0;
          let booklocation1val = 0;
          let source1val = 0;
          let donor1val = 0;
          let subclass11val = 0;
          let subclass21val = 0;
          let subclass31val = 0;
          let subclass41val = 0;
          let replacefor1val = 0;
          let remarks1val = 0;
          let mrpage1val = 0;
          let status1val = 0;
          let encoder1val = 0;

          if(itemno1.length === 0 || itemno1.val().trim() !== "" ) {
              item1val = itemno1.val();
          }else{
            item1val = null;
          }
          if(accessionno1.length === 0 || accessionno1.val().trim() !== "" ) {
              accessionno1val = accessionno1.val();
          }else{
            accessionno1val = null;
          }
          if(copies1.length === 0 || copies1.val().trim() !== "" ) {
              copies1val = copies1.val();
          }else{
            copies1val = null;
          }
          if(location1.length === 0 || location1.val().trim() !== "" ) {
              location1val = location1.val();
          }else{
            location1val = null;
          }
          if(booklocation1.length === 0 || booklocation1.val().trim() !== "" ) {
              booklocation1val = booklocation1.val();
          }else{
            booklocation1val = null;
          }
          if(source1.length === 0 || source1.val().trim() !== "" ) {
              source1val = source1.val();
          }else{
            source1val = null;
          }

          if(donor1.length === 0 || donor1.val().trim() !== "" ) {
              donor1val = donor1.val();        
          }else{
            donor1val = null;
          }
          if(subclass11.length === 0 || subclass11.val().trim() !== "" ) {
              subclass11val = subclass11.val();
          }else{
            subclass11val = null;
          }
          if(subclass21.length === 0 || subclass21.val().trim() !== "" ) {
              subclass21val = subclass21.val();
          }else{
            subclass21val = null;
          }
          if(subclass31.length === 0 || subclass31.val().trim() !== "" ) {
              subclass31val = subclass31.val();
          }else{
            subclass31val = null;
          }
          if(subclass41.length === 0 || subclass41.val().trim() !== "" ) {
              subclass41val = subclass41.val();
          }else{
            subclass41val = null;
          }
          if(replacefor1.length === 0  ) {
              replacefor1val = replacefor1.val();
          }else{
            replacefor1val = null;
          } 
          if(remarks1.length === 0 || remarks1.val().trim() !== "" ) {
              remarks1val = remarks1.val();
          }else{
            remarks1val = null;
          }
          
          if(mrpage1.length === 0 || mrpage1.val().trim() !== "" ) {
              mrpage1val = mrpage1.val();
          }else{
            mrpage1val = null;
          }
          if(status1.length === 0 || status1.val().trim() !== "" ) {
              status1val = status1.val();
          }else{
            status1val = null;
          }

          if(encoder1.length === 0 || encoder1.val().trim() !== "" ) {
              encoder1val = encoder1.val();
          }else{
            encoder1val = null;
          }


    
    
    
              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];
              
                var isValuesallowed = statusvalues.includes(status1val);
                
                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                }else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                }else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                }else  if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
              }else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                }else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                }else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                }else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                }else{
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: { accessionNumber: accessionno1val},
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                       alert("Accession Number already exist");
                       
                    } else {
                      isFirstClick1 = true;
                      const table = $('#myTable3');
        
        
                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                        data: {
                            bookid:$('#drop').attr('data-id'),
                              itemno: itemno1.val(),
                              accessionno: accessionno1.val(),
                              copies: copies1.val(),
                              location: location1.val(),
                              booklocation: booklocation1.val(),
                              source: source1.val(),
                              donor: donor1.val(),
                              subclass1: subclass11.val(),
                              subclass2: subclass21.val(),
                              subclass3: subclass31.val(),
                              subclass4: subclass41.val(),
                              replacefor: replacefor1.val(),
                              remarks: remarks1.val(),
                              mrpage: mrpage1.val(),
                              status: status1.val(),
                              encoder: encoder1.val(),
                              idno: localStorage.getItem('localid')
                  
                              // Add any additional data you want to send
                          },
                          success: function (response) {
                            localStorage.setItem("clickon", false);
                           location.reload();
        
                          },
                          error: function (xhr, status, error) {
                              // Handle any errors here
                              console.error('Error:', error);
                          }
                      });
                    }
                    },
                    error: function() {
                        $('#result').text('Error checking AccessionNo.');
                    }
                });


/*
                
                  */
              
                }
    
    
                  
              } else {
                localStorage.setItem("clickon", true);
                  isFirstClick1 = false;
                  showEmptyRowAtEnd2();
                  latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }
    
      } else {
          // Handle other cases if needed
      }
    });


    
  });

    $('#tab2-tab').on('click', function () {
      $('#myTable2').DataTable().ajax.reload();
    });






  });