
$(document).ready(function(){

$('.drop').click(function(){
  let id =$(this).attr('data-id');
  const userResponse = confirm("Do you want to proceed?");

  // Handle the user response
  if (userResponse) {
    $.ajax({
      url: "DROP",
      type: "POST",
      data: { id: id },
      success: function(response) {
          // Handle the server response if needed
          alert(response);
          location.reload();
          // Refresh the table or update the UI accordingly
          // ...
      },
      error: function(xhr, status, error) {
          // Handle any error that occurred during the AJAX request
          console.error(error);
      }
  });
  } else {
  
  }
  
  
  
  
  });
});