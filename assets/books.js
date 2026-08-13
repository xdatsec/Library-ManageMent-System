let name = "<?php echo $username ?>";
$('document').ready(function() {
  $('#encoder2').val(name);
});

$(document).on('input', '#encoder2', function() {
  $('#encoder2').val(name);
});
$('form').submit(function(event) {
  event.preventDefault();
  var data = {
    title2: $('#title2').val(),
    lastname2: $('#lastname2').val(),
    firstname2: $('#firstname2').val(),
    middlename2: $('#middlename2').val(),
    joint_lastname2: $('#joint_lastname2').val(),
    joint_firstname2: $('#joint_firstname2').val(),
    joint_middlename2: $('#joint_middlename2').val(),
    joint_lastname22: $('#joint_lastname22').val(),
    joint_firstname22: $('#joint_firstname22').val(),
    joint_middlename22: $('#joint_middlename22').val(),
    subject2: $('#subject2').val(),
    publisher2: $('#publisher2').val(),
    place_of_publication2: $('#place_of_publication2').val(),
    booknumber2: $('#booknumber2').val(),
    authornumber2: $('#authornumber2').val(),
    encoder2: $('#encoder2').val()
  };
  if (data.title2 == "" || data.lastname2 == "" || data.firstname2 == "" || data.middlename2 == "" || data.joint_lastname2 == "" || data.joint_firstname2 == "" || data.joint_middlename2 == "" || data.joint_lastname22 == "" || data.joint_firstname22 == "" || data.joint_middlename22 == "" || data.subject2 == "" || data.publisher2 == "" || data.place_of_publication2 == "" || data.booknumber2 == "" || data.authornumber2 == "" || data.encoder2 == "") {
    alert("Please fill up all fields");
  } else {

    $.ajax({
      url: 'ADD_BOOK',
      type: 'POST',
      data: data,
      success: function(response) {
        alert(response);

        $('#title2').val("");
        $('#lastname2').val("");
        $('#firstname2').val("");
        $('#middlename2').val("");
        $('#joint_lastname2').val("");
        $('#joint_firstname2').val("");
        $('#joint_middlename2').val("");
        $('#joint_lastname22').val("");
        $('#joint_firstname22').val("");
        $('#joint_middlename22').val("");
        $('#publisher2').val("");
        $('#place_of_publication2').val("");
        $('#booknumber2').val("");
        $('#authornumber2').val("");
        reloadItems();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + textStatus + ' - ' + errorThrown);
      }
    });
  }
});
var oldValue = null;
$(document).on('dblclick', '.editable', function() {

  if ($(this).attr('name') == 'EditionNumber') {
    oldValue = $(this).text();
    if (typeof oldValue === 'string') {
      var numericStr = oldValue.replace(/\D/g, '');
      $(this).removeClass('editable');
      $(this).html('<input type="text" style="width:150px;" class="update" value="' + numericStr + '" />');
      $(this).find('.update').focus();
    }
  } else if ($(this).attr('name') == 'PurchasePrice') {
    oldValue = $(this).text();
    if (typeof oldValue === 'string') {
      var numericStr = oldValue.replace(/\D/g, '');
      var numericValue = parseFloat(numericStr) / 100; // Convert to decimal

      $(this).removeClass('editable');
      $(this).html('<input type="text" style="width:150px;" class="update" value="' + numericValue + '" />');
      $(this).find('.update').focus();
    }



  } else {



    oldValue = $(this).html();

    $(this).removeClass('editable'); // to stop from making repeated request

    $(this).html('<input type="text" style="width:150px;" class="update" value="' + oldValue + '" />');
    $(this).find('.update').focus();
  }
});

var newValue = null;
$(document).on('blur', '.update', function() {
  var elem = $(this);
  newValue = $(this).val();
  var empId = $(this).parent().attr('id');
  var colName = $(this).parent().attr('name');

  if (newValue != oldValue) {
    if (newValue == '') {
      newValue = oldValue;
    }
    $.ajax({
      url: 'updatebookprop',
      method: 'post',
      data: {
        empId: empId,
        colName: colName,
        newValue: newValue,
      },
      success: function(respone) {
        if (colName == 'EditionNumber') {
          var suffix = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];

          if ((newValue % 100) >= 11 && (newValue % 100) <= 13) {
            var newValue1 = newValue + 'th Ed.';


            $(elem).parent().addClass('editable');
            $(elem).parent().html(newValue1);
          } else {
            var newValue1 = newValue + suffix[newValue % 10] + ' Ed.';

            $(elem).parent().addClass('editable');
            $(elem).parent().html(newValue1);
          }


        } else if (colName == "PurchasePrice") {
          var formattedPrice = '';
          if (typeof newValue === 'number') {
            formattedPrice = '₱' + newValue.toFixed(2);
          } else {
            formattedPrice = '₱' + parseFloat(newValue).toFixed(2);
          }
          $(elem).parent().addClass('editable');
          $(elem).parent().html(formattedPrice);
        } else {

          $(elem).parent().addClass('editable');
          $(elem).parent().html(newValue);
        }
      }
    });



  } else {
    $(elem).parent().addClass('editable');
    $(this).parent().html(newValue);
  }
});


//date


var oldValue = null;
let topen = false;

$(document).on('dblclick', '.editable_date', function() {
  if (topen == false) {


    oldValue = $(this).html();

    $(this).removeClass('editable_date'); // to stop from making repeated request

    $(this).html('<input id="birthdate" value="' + oldValue + '" class="update_date" type="text" placeholder="Click to Select" class="form-control"> </div>');
    pickers.init();
    $(this).find('.update_date').focus();
    topen = true;
  } else {
    alert("Please save the changes on open input first");
  }
});

var newValue = null;
$(document).on('change', '.update_date', function() {
  $(this).find('.update_date').focus();
  var elem = $(this);
  newValue = $(this).val();
  var empId = $(this).parent().attr('id');
  var colName = $(this).parent().attr('name');

  if (newValue != "") {
    $.ajax({
      url: 'updatebookprop',
      method: 'post',
      data: {
        empId: empId,
        colName: colName,
        newValue: newValue,
      },
      success: function(respone) {
        $(elem).parent().addClass('editable_date');
        $(elem).parent().html(newValue);
        topen = false;
      }
    });
  } else {
    $(elem).parent().addClass('editable_date');
    $(this).parent().html(oldValue);
    topen = false;
  }
});


//second


var oldValue = null;
$(document).on('dblclick', '.editable1', function() {
  if (localStorage.getItem("ttopen") === "true") {
    // Value in local storage is "true" (as a string)
    alert("Please save the changes on open input first");
  } else {


    oldValue = $(this).html();

    $(this).removeClass('editable1'); // to stop from making repeated request

    $(this).html('<input type="text" style="width:150px;" class="update1" value="' + oldValue + '" />');
    $(this).find('.update1').focus();
  }
});

var newValue = null;
$(document).on('blur', '.update1', function() {
  var elem = $(this);
  var newValue = $(this).val();
  var empId = $(this).parent().attr('id');
  var colName = $(this).parent().attr('name');

  if (newValue != oldValue) {
    if (newValue == '') {
      newValue = oldValue;
    }

    if (colName == "AccessionNo") {
      if (newValue.length == 0) {
        alert("Please don't leave Accession number blank");
        $(elem).parent().addClass('editable1');
        $('.update1').parent().html(oldValue);
      } else {
        $.ajax({
          url: 'APICC',
          type: 'POST',
          data: {
            accessionNumber: newValue
          },
          dataType: 'json',
          success: function(response) {
            if (response.exists) {
              alert("Accession Number already exists");
              $(elem).parent().addClass('editable1');
              $('.update1').parent().html(oldValue);
            } else {
              $.ajax({
                url: 'updatebookprop1',
                method: 'post',
                data: {
                  oldval: oldValue,
                  bookid: $('#drop').attr('data-id'),
                  empId: empId,
                  colName: colName,
                  newValue: newValue,
                },
                success: function(response) {
                  $(elem).parent().addClass('editable1');
                  $(elem).parent().html(newValue);
                }
              });
            }
          },
          error: function() {
            alert('Error checking AccessionNo.');
            $(elem).parent().addClass('editable1');
            $('.update1').parent().html(oldValue);
          }
        });
      }
    } else if (colName == "Location") {
      if (newValue.length == 0) {
        alert("Please don't leave Location blank");
        $(elem).parent().addClass('editable1');
        $('.update1').parent().html(oldValue);
      } else {
        var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];
        var isLocationallowed = locationvalues.includes(newValue);

        if (!isLocationallowed) {
          alert("Values Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR");
          $(elem).parent().addClass('editable1');
          $('.update1').parent().html(oldValue);
        } else {
          updateValue();
        }
      }
    } else if (colName == "Source") {
      if (newValue.length == 0) {
        alert("Please don't leave Source blank");
        $(elem).parent().addClass('editable1');
        $('.update1').parent().html(oldValue);
      } else {
        var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];
        var isSourceallowed = sourcevalues.includes(newValue);

        if (!isSourceallowed) {
          alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
          $(elem).parent().addClass('editable1');
          $('.update1').parent().html(oldValue);
        } else {
          updateValue();
        }
      }
    } else if (colName == "Status") {
      if (newValue.length == 0) {
        alert("Please don't leave Status blank");
        $(elem).parent().addClass('editable1');
        $('.update1').parent().html(oldValue);
      } else {
        var statusvalues = ["E", "L", "RE"];
        var isValuesallowed = statusvalues.includes(newValue);

        if (!isValuesallowed) {
          alert("Values Allowed on Status are E, L, RE");
          $(elem).parent().addClass('editable1');
          $('.update1').parent().html(oldValue);
        } else {
          if (newValue === "L") {
            if (confirm("Are you sure you want to change the Status")) {
              if (confirm("Are you sure this book is lost?")) {
                updateValue();
              } else {
                // User canceled the second confirmation, handle accordingly
                $(elem).parent().addClass('editable1');
                $('.update1').parent().html(oldValue);
              }
            } else {
              $(elem).parent().addClass('editable1');
              $('.update1').parent().html(oldValue);
            }
          } else {
            confirm("Are you sure you want to change the Status")
            if (confirm) {
              updateValue();

            } else {
              $(elem).parent().addClass('editable1');
              $('.update1').parent().html(oldValue);
            }
          }
        }
      }
    } else if (colName == "Copies") {
      if (newValue.length == 0) {
        alert("Please don't leave Copies blank");
        $(elem).parent().addClass('editable1');
        $('.update1').parent().html(oldValue);
      } else if (isNaN(newValue)) {
        alert("Copies Number must be a number");
        $(elem).parent().addClass('editable1');
        $('.update1').parent().html(oldValue);
      } else {
        updateValue();
      }
    } else {
      updateValue();
    }
  } else {
    $(elem).parent().addClass('editable1');
    $(this).parent().html(newValue);
  }



  function updateValue() {
    $.ajax({
      url: 'updatebookprop1',
      method: 'post',
      data: {
        empId: empId,
        colName: colName,
        newValue: newValue,
      },
      success: function(response) {
        $(elem).parent().addClass('editable1');
        $(elem).parent().html(newValue);

      }
    });
  }
});

var oldValue = null;
$(document).on('dblclick', '.editable2', function() {
  localStorage.setItem("ttopen", "true");




  oldValue = $(this).html();

  $(this).removeClass('editable1'); // to stop from making repeated request

  $(this).html('<select name="Replacedfor"  style="width: 200px;" class="update2 replacefor2 form-control"></select>');

  $.ajax({
    url: 'GPLACE',
    dataType: 'json',
    success: function(data) {

      // Populate the select element with the data
      var select = $(`.replacefor2`);


      select.append("$('<option value='null' class='formgroup' selected >Select</option>");
      select.append("$('<option value='' class='formgroup' >Cancel</option>");
      $.each(data, function(index, item) {
        select.append($('<option>', {
          value: item.ID,
          text: item.Title + ", Accession No - " + item.AccessionNo
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

});

var newValue = null;

$(document).on('change', '.update2', function() {
  $('selector').attr('title');
  var elem = $(this);
  var selectedOptionText = $(this).find('option:selected').text();
  var newValue = $(this).val();
  var empId = $(this).parent().attr('id');
  var colName = $(this).parent().attr('name');

  if (newValue != oldValue) {
    if (newValue == '') {
      $(elem).parent().addClass('editable2');
      $(this).parent().html(oldValue);
      localStorage.setItem("ttopen", "false");
    } else {
      updateValue2();
      localStorage.setItem("ttopen", "false");
    }




  } else {
    $(elem).parent().addClass('editable2');
    $(this).parent().html(newValue);
  }



  function updateValue2() {
    $.ajax({
      url: 'updatebookprop1',
      method: 'post',
      data: {
        empId: empId,
        colName: colName,
        newValue: newValue,
      },
      success: function(response) {
        $(elem).parent().addClass('editable2');
        $(elem).parent().html(selectedOptionText);
        localStorage.setItem("ttopen", "false");
      }
    });
  }
});
