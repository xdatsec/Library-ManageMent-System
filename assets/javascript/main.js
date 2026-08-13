$show_errors = false;
$rememberme = " ";
$(document).ready(function() {


$("#signin").click(function(event) {
    event.preventDefault();
    let username= $("#inputUser").val();
    let password= $("#inputPassword").val();
    $.ajax({
        url: 'modules/inc/auth.php',
        type: 'POST',
        data: {
            username: username,password: password
        },
        success: function(response) {
            response = response.trim(); // remove whitespace
          if(response == 'success') {
            window.location.href = "index.php";
            if(username != $rememberme){
                document.cookie = "rememberusername=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

            }

          }else{
            $(".general_err").text(response);
            $(".general_err").show();

            if ($("#remember-me").is(":checked")) {
                document.cookie = "rememberusername=" + username + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
            }else{

            }
            $show_errors = true;
          }
        },
        error: function(xhr, status, error) {
          // handle errors
        }
      });
    });

    $('.auth-form').submit(function(event) {
        event.preventDefault(); // prevent the form from submitting
        // your code to handle the form submission goes here
      });

    
        $('#inputUser, #inputPassword').on('input', function() {
            if ($show_errors == true) {
                $('.username_err, .password_err, .general_err').hide();
                $show_errors = false;
            }else{

            }
          });



var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.indexOf("rememberusername=") == 0) {
            var rememberusername = cookie.substring("rememberusername=".length, cookie.length);
            document.getElementById("inputUser").value = rememberusername;
            document.getElementById("remember-me").checked = true;
            $rememberme = rememberusername;
            break;
        }
    }
let memberidmissing = true;
let firstnamemissing = true;
let middlenamemissing = true;
let lastnamemissing = true;
let addressmissing = true;
let phonenummissing = true;
let birthdatemissing = true;
let dateenlistmissing = true;
let typemissing = true;
$("#memberid").on('input', function() {
  
 
  if($(this).val() == '') {
    $("#memberidl").html('Member_ID <span class="badge badge-danger">Missing</span>');
    memberidmissing = true;
  }else{
    if(memberidmissing == true) {
      $("#memberidl").html('Member_ID');
      memberidmissing = false;
    }else{
      $("#memberidl").html('Member_ID');
      memberidmissing = false;
    }
  }


});

$("#firstName").on('input', function() {
  if($(this).val() == '') {
    $('#namel').html('Name <span class="badge badge-danger">Incomplete</span>');
    firstnamemissing = true;
  }else{
    firstnamemissing = false;
    if(firstnamemissing == false && lastnamemissing == false && middlenamemissing == false) {
      $('#namel').html('Name');
    }
  }

});

$("#middleName").on('input', function() {
  if($(this).val() == '') {
    $('#namel').html('Name <span class="badge badge-danger">Incomplete</span>');
    middlenamemissing = true;
  }else{
    middlenamemissing = false;
    if(firstnamemissing == false && lastnamemissing == false && middlenamemissing == false) {
      $('#namel').html('Name');
    }
  }
});

$("#lastName").on('input', function() {
  if($(this).val() == '') {
    $('#namel').html('Name <span class="badge badge-danger">Incomplete`</span>');
    lastnamemissing = true;
  }else{
    lastnamemissing = false;
    if(firstnamemissing == false && lastnamemissing == false && middlenamemissing == false) {
      $('#namel').html('Name');
    }
  }
});


$("#adress").on('input', function() {
  if($(this).val() == '') {
    $('#adressl').html('Address <span class="badge badge-danger">Missing</span>');
    addressmissing == true
  }else{
    if(addressmissing == true) {
      $('#adressl').html('Address');
      addressmissing = false;
    }else{
      $('#adressl').html('Address');
      addressmissing = false;
    }
  }
});

$("#phonenum").on('input', function() {
  if($(this).val() == '') {
    $('#phonenuml').html('Phone Number <span class="badge badge-danger">Missing</span>');
    phonenummissing == true
  }else{
    if(phonenummissing == true) {
      $('#phonenuml').html('Phone Number');
      phonenummissing = false;
    }else{
      $('#phonenuml').html('Phone Number');

      phonenummissing = false;
    }
  }
});

$("#birthdate").on('input', function() {
  if($(this).val() == '') {
    $('#birthdatel').html('Birthdate <span class="badge badge-danger">Missing</span>');
    birthdatemissing == true
  }else{
    if(birthdatemissing == true) {
      $('#birthdatel').html('Birthdate');
      birthdatemissing = false;
    }else{
      $('#birthdatel').html('Birthdate');
      birthdatemissing = false;
    }
  }
});

$("#dateenlist").on('input', function() {
  if($(this).val() == '') {
    $('#dateenlistl').html('Date Enlist <span class="badge badge-danger">Missing</span>');
    dateenlistmissing == true
  }else{
    if(dateenlistmissing == true) {
      $('#dateenlistl').html('Date Enlist');
      dateenlistmissing = false;
    }else{
      $('#dateenlistl').html('Date Enlist');
      dateenlistmissing = false;
    }
  }
});

$("#type").on('change', function() {
  if($(this).val() == '') {
    $('#typel').html('Type <span class="badge badge-danger">Missing</span>');
    typemissing = true;
  } else {
    if(typemissing == true) {
      $('#typel').html('Type');
      typemissing = false;
    } else {
      $('#typel').html('Type');
      typemissing = false;
    }
  }
});


$("#save").click(function() {
  // Get the values of the form elements
let memberid = $('#memberid').val();
let firstName = $('#firstName').val();
let lastName = $('#lastName').val();
let middleName = $('#middleName').val();
let address = $('#adress').val();
let phonenum = $('#phonenum').val();
let type = $('#type').val();
let course = $('#course').val();
let banned = 0;
if ($('.banned').is(':checked')) {
  banned = 1;
} else {
  banned = 0;
}
let remarks = $('#remarks').val();
let schoolyearfrom = $('#schoolyearfrom').val();
let schoolyearto = $('#schoolyearto').val();
let books_borrowed = $('#books_borrowed').val();
let birthdate = $('#birthdate').val();
let dateenlist = $('#dateenlist').val();
let dategraduate = $('#dategraduate').val();
let parent_guardian = $('#parent_guardian').val();
let school_officeswe = $('#school_officeswe').val();
let office_address = $('#office_address').val();
let head_school = $('#head_school').val();
 
if(memberid == '' || firstName == '' || lastName == '' || middleName == '' || address == '' || phonenum == '' || type == ''   || birthdate == '' || dateenlist == '' ) {
  alert('Please correct the errors in the form!');
  if(memberid == '') {
    $("#memberidl").html('Member_ID <span class="badge badge-danger">Missing</span>');
    memberidmissing = true;
  }
  if(firstName == '') {
    $('#namel').html('Name <span class="badge badge-danger">Missing</span>');
    namemissing = true;
  }
  if(lastName == '') {
    $('#namel').html('Name <span class="badge badge-danger">Missing</span>');
    namemissing = true;
  }
  if(middleName == '') {
    $('#namel').html('Name <span class="badge badge-danger">Missing</span>');
    namemissing = true;
  }
  if(address == '') {
    $('#adressl').html('Address <span class="badge badge-danger">Missing</span>');
    addressmissing = true;
  }
  if(phonenum == '') {
    $('#phonenuml').html('Phone Number <span class="badge badge-danger">Missing</span>');
    phonenummissing = true;
  }
  if(type == '') {
    $('#typel').html('Type <span class="badge badge-danger">Missing</span>');
    typemissing = true;
  }
  if(birthdate == '') {
    $('#birthdatel').html('Birthdate <span class="badge badge-danger">Missing</span>');
    birthdatemissing = true;
  }
  if(dateenlist == '') {
    $('#dateenlistl').html('Date Enlist<span class="badge badge-danger">Missing</span>');
    dateenlistmissing = true;
  }
}else if(schoolyearfrom > schoolyearto){
  alert('School Year From cannot be greater than School Year To');
  
  
}else{
  if($('#type').val() ==1){
    
    if($('#course').val()== '' || $('#section').val() == '' || $('#syear').val() == '' || $('#dategraduate').val() == '' || $('#parent_guardian').val() == ''){
      let err ="Please correct the errors in the form!\n";
      if($('#course').val() == '') {
       err += 'Please Select Course\n';
      }
      if($('#section').val() == '') {
        err += 'Please Select Section\n';
      }
      if($('#syear').val()  == '') {
        err += 'Please Select Year\n';
      }
      if($('#dategraduate').val()== '') {
        err += 'Please Select Date Graduate\n';
      }
      if($('#parent_guardian').val() == '') {
        err += 'Please Select Parent Guardian\n';
      }
      alert(err);

    }else{
      $.ajax({
        url: 'getstudent',
        type: 'POST',
        data: {
          memberid: $('#memberid').val(),
          firstName: $('#firstName').val(),
          lastName: $('#lastName').val(),
          middleName: $('#middleName').val(),
          address: $('#adress').val(),
          phonenum: $('#phonenum').val(),
          type: $('#type').val(),
          course: $('#course').val(),
          section: $('#section').val(),
          year: $('#syear').val(),
          banned: banned,
          remarks: $('#remarks').val(),
          schoolyearfrom: $('#schoolyearfrom').val(),
          schoolyearto: $('#schoolyearto').val(),
          books_borrowed: $('#books_borrowed').val(),
          birthdate: $('#birthdate').val(),
          dateenlist: $('#dateenlist').val(),
          dategraduate: $('#dategraduate').val(),
          parent_guardian: $('#parent_guardian').val(),
          school_officeswe: $('#school_officeswe').val(),
          office_address: $('#office_address').val(),
          head_school: $('#head_school').val()
        },
        success: function(response) {
          let ls = response.replace(/\s/g, '');
          if(ls == "ok"){
          alert('Successfully Added!');
          location.reload();
          }else{
            alert(response);
          }
        },
        error: function(xhr, status, error) {
          // Handle the error here
          alert('Error: ' + error.message);
        }
      });
    }
  }else{
    $.ajax({
      url: 'getstudent',
      type: 'POST',
      data: {
        memberid: $('#memberid').val(),
        firstName: $('#firstName').val(),
        lastName: $('#lastName').val(),
        middleName: $('#middleName').val(),
        address: $('#adress').val(),
        phonenum: $('#phonenum').val(),
        type: $('#type').val(),
        course: $('#course').val(),
        section: $('#section').val(),
        year: $('#syear').val(),
        banned: banned,
        remarks: $('#remarks').val(),
        schoolyearfrom: $('#schoolyearfrom').val(),
        schoolyearto: $('#schoolyearto').val(),
        books_borrowed: $('#books_borrowed').val(),
        birthdate: $('#birthdate').val(),
        dateenlist: $('#dateenlist').val(),
        dategraduate: $('#dategraduate').val(),
        parent_guardian: $('#parent_guardian').val(),
        school_officeswe: $('#school_officeswe').val(),
        office_address: $('#office_address').val(),
        head_school: $('#head_school').val()
      },
      success: function(response) {
        let ls = response.replace(/\s/g, '');
        if(ls == "ok"){
        alert('Successfully Added!');
        location.reload();
        }else{
          alert(response);
        }
      },
      error: function(xhr, status, error) {
        // Handle the error here
        alert('Error: ' + error.message);
      }
    });
  }

}
});

$('#type').change(function() {
  // Get the selected value
  if($(this).val() == 1){
    $('#coursel').html('Course <span class="badge badge-danger">Required</span>');
    $('#sectionl').html('Section <span class="badge badge-danger">Required</span>');
    $('#yearl').html('Year <span class="badge badge-danger">Required</span>');
    $('#ddgl').html('Date Graduate <span class="badge badge-danger">Required</span>');
    $('#parentl').html('Parent Guardian <span class="badge badge-danger">Required</span>');

    $('#coursef').show();
    $('#sectionf').show();
    $('#yearf').show();
    $('#ddgf').show();
    $('#parentf').show();

  }else{
    $('#ddgf').hide();
    $('#parentf').hide();
    $('#coursef').hide();
    $('#sectionf').hide();
    $('#yearf').hide();
  }
});


});

