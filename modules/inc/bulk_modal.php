                       <!-- Modal -->
                       <div class="modal fade" id="bulkdrop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you would like to drop these data?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="confirm_d btn btn-secondary" >Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <!-- Add any other buttons you need here -->
                    </div>
                </div>
            </div>

        </div>
   <!-- Modal -->
   <script src="assets/vendor/jquery/jquery.min.js"></script>
   <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>

   <script>
    $(".confirm_d").click(function(){
      var selectedItems = [];

// Get all the checked checkboxes' values
$(".memberid:checked").each(function() {
    selectedItems.push($(this).val());
});

if (selectedItems.length > 0) {
  $.ajax({
                url: "BULKDELETE",
                type: "POST",
                data: { items: selectedItems },
                success: function(response) {
                    // Handle the server response if needed
                    alert(response);
                    $('#myTable').DataTable().ajax.reload();
                    $('#bulkdrop').modal('hide');
                },
                error: function(xhr, status, error) {
                    // Handle any error that occurred during the AJAX request
                    console.error(error);
                }
            });
}else{
  alert("Please select atleast one item");
  $('#bulkdrop').modal('hide');
  return false;
}


      
    });
    </script>