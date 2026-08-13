
<style>
  .modal-backdrop {
  z-index: -1;
}
</style>
<section class="aside-menu has-scrollable">
            <!-- .stacked-menu -->
            <nav id="stacked-menu" class="stacked-menu">
              <!-- .menu -->
              <ul class="menu">
                <!-- .menu-item -->
                <li class='<?php
if (strpos($_SERVER['REQUEST_URI'], "index.php") !== false || $_SESSION['locator'] =='index') {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>
                  <a href="index.php" class="menu-link">
                    <span class="menu-icon oi oi-dashboard"></span>
                    <span class="menu-text">Dashboard</span>
                  </a>
                </li>
                <!-- /.menu-item -->
               
                <!-- .menu-header -->
           <!--     <li class="menu-header">Transactions </li>

                <!-- .menu-item -->
                <li class="menu-item has-child <?php if($_SESSION['locator'] =='tr'){
echo "has-active";
                }else{

                } ?>">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-list-rich"></span>
                    <span class="menu-text">Transactions</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class='<?php
if (strpos($_SERVER['REQUEST_URI'], "borrow.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>
                      <a href="borrow.php" class="menu-link">Borrow</a>
                    </li>
                    <li class='<?php
if (strpos($_SERVER['REQUEST_URI'], "return.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>
                      <a href="return.php" class="menu-link">Return</a>
                    </li>
                    <li  class='<?php
if ($_SESSION['members'] =='true') {
    echo "menu-item has-active";
  }else{
echo 'menu-item';
}
?>'>
                      <a href="library_members.php" class="menu-link">Library Members</a>
                    </li>
                    <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "books_acquisitions.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>
                      <a href="books_acquisitions.php" class="menu-link">Books Acquisition</a>
                    </li>

                    <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "borrowed.php") !== false || strpos($_SERVER['REQUEST_URI'], "returned.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>
                      <a href="borrowed_returned.php" class="menu-link">Books Borrowed and Returned</a>
                    </li>
                    <?php if($_SESSION["isSuperAdmin"] == 1){
                      ?>
                    <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "alumni2.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>

                      <a href="alumni2.php" class="menu-link">Alumni</a>
                    </li>
                    <?php
                  }
                  ?>
                      <?php if($_SESSION["isSuperAdmin"] == 1){
                      ?>
                    <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "inventory.php") !== false || strpos($_SERVER['REQUEST_URI'], "inventory_t.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>
                      <a href="inventory.php" class="menu-link">Inventory</a>
                    </li>
                    <?php
                  }
                  ?>
                  
                  </ul>
                  <!-- /child menu -->
                </li>


                <!-- /.menu-item -->
                <li class="menu-item has-child <?php if($_SESSION['locator'] =='ms'){
echo "has-active";
                }else{

                } ?>">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-justify-right"></span>
                    <span class="menu-text">Masterfiles</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                  <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "books_acquisition.php") !== false || strpos($_SERVER['REQUEST_URI'], "book_acquisition.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>
    <a href="books_acquisition.php" class="menu-link">Books Acquisition</a>
                    </li>
                    <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "thesis.php") !== false || strpos($_SERVER['REQUEST_URI'], "thesis.php") !== false ||strpos($_SERVER['REQUEST_URI'], "all_thesis_list.php") !== false  ) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>
    <a href="thesis.php" class="menu-link">Thesis</a>
                    </li>
                    
                  </ul>
                  <!-- /child menu -->
                </li>
               
                <!-- /.menu-item -->

                <!-- /.menu-item -->
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-infinity"></span>
                    <span class="menu-text">Miscellaneous</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                  <li class="menu-item">
                      <a href="entrance.php" class="menu-link">Entrance</a>
                    </li>
                    <li class="menu-item">
                      <a href="bullitenboard.php" class="menu-link">Bulletin Board </a>
                    </li>
                    
                  </ul>
                  <!-- /child menu -->
                </li>

                <!-- /.menu-item -->

                <?php
                            if ($_SESSION['isSuperAdmin'] == 1) {
                              ?>
                 <!-- /.menu-item -->
                 <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-check"></span>
                    <span class="menu-text">Reports</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                  <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "accession_reports.php") !== false || strpos($_SERVER['REQUEST_URI'], "accession_reports.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>          


<a href="accession_reports.php" class="menu-link">Accession Book Report</a>
                    </li>
                    <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "callno_reports.php") !== false || strpos($_SERVER['REQUEST_URI'], "callno_reports.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>          

                      <a href="callno_reports.php" class="menu-link">Call Number Report</a>
                    </li>
                    <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "subject_reports.php") !== false || strpos($_SERVER['REQUEST_URI'], "subject_reports.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>          
                      <a href="subject_reports.php" class="menu-link">Subject Report</a>
                    </li>
                    <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "collection_status.php") !== false || strpos($_SERVER['REQUEST_URI'], "collection_status.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>          
                      <a href="collection_status.php" class="menu-link">Collection Status</a>
                    </li>
                    <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "inventory_report.php") !== false || strpos($_SERVER['REQUEST_URI'], "inventory_report.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>          
            
                      <a href="inventory_report.php" class="menu-link">Inventory Report</a>
                    </li>
                    <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "entrance_report.php") !== false || strpos($_SERVER['REQUEST_URI'], "entrance_report.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>          
                      <a href="entrance_report.php" class="menu-link">Entrance Report</a>
                    </li>
                   
                    <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "topborrower_form.php") !== false || strpos($_SERVER['REQUEST_URI'], "topborrower_form.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'> 
                      <a href="topborrower_form.php" class="menu-link">Top Borrower</a>
                    </li>
                    
                  </ul>
                  <!-- /child menu -->
                </li>
<?php
                            } ?>
                <!-- /.menu-item -->

                <!-- /.menu-item -->
                <li class="menu-item has-child <?php if(strpos($_SERVER['REQUEST_URI'], "activity.php") !== false){
echo "has-active";
                }else{

                } ?>">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-cog"></span>
                    <span class="menu-text">Utilities</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                  <?php
                            if ($_SESSION['isSuperAdmin'] == 1) {
                              ?>
                  <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "activity.php") !== false || strpos($_SERVER['REQUEST_URI'], "activity.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>

                      <a href="activity.php" class="menu-link">Activity Logs</a>
                    </li>
                 
                    <li class="menu-item">
                      <a href="/phpmyadmin" class="menu-link">Database Window</a>
                    </li>
                    <?php
}?>
                                <li  class='<?php
if (strpos($_SERVER['REQUEST_URI'], "user.php") !== false || strpos($_SERVER['REQUEST_URI'], "user.php") !== false || strpos($_SERVER['REQUEST_URI'], "users.php") !== false || strpos($_SERVER['REQUEST_URI'], "userlist.php") !== false) {
    echo "menu-item has-active";
  }else{
echo "menu-item";
}
?>'>
                      <a href="user.php" class="menu-link">User Manager</a>
                    </li>
                    <li class="menu-item">
                      <a href="#" class="info menu-link" onclick="showinfo()">About LMS</a>
                    </li>
                   
                
                    
                  </ul>
                  <!-- /child menu -->
                </li>

                <!-- /.menu-item -->
              </ul>
              <!-- /.menu -->
            </nav>

            <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true" style="z-index: 1030 !important;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoModalLabel">About LMS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        This Library Management System is Property of CHMSU Binalbagan
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

            
            <!-- /.stacked-menu -->
          </section>
          <script>
            function showinfo(){
              $(document).ready(function(){
                $('#infoModal').appendTo("body").modal('show');
              });
            }
              
          </script>