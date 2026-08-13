<ul class="header-nav nav" >
                <!-- .nav-item -->
                <li class="nav-item dropdown header-nav-dropdown has-notified">
                  <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="oi oi-pulse"></span>
                  </a>
                  <div class="dropdown-arrow"></div>
                  <!-- .dropdown-menu -->
                  <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
                    <h6 class="dropdown-header stop-propagation">
                      <span>Activities
                        <span class="badge"></span>
                      </span>
          
                    <!-- .dropdown-scroll -->
                    <div class="dropdown-scroll has-scrollable">
                      <?php
                      /*
                      Template for activities
                      <!-- .dropdown-item -->
                      <a href="#" class="dropdown-item unread">
                        <div class="user-avatar">
                          <img src="assets/images/avatars/uifaces15.jpg" alt=""> </div>
                        <div class="dropdown-item-body">
                          <p class="text"> Jeffrey Wells created a schedule </p>
                          <span class="date">Just now</span>
                        </div>
                      </a>
                      <!-- /.dropdown-item -->
                 
                      <!-- /.dropdown-item -->
                      */
                      ?>
                      <p v class="row justify-content-center"> No activities yet </p>
                    </div>
                    <!-- /.dropdown-scroll -->
                    
                    <a href="user-activities.html" class="dropdown-footer">All activities
                      <i class="fa fa-fw fa-long-arrow-alt-right"></i>
                    </a>
                  </div>
                  <!-- /.dropdown-menu -->
                </li>
                <!-- /.nav-item -->
                <!-- .nav-item -->
                
                <!-- /.nav-item -->
                <!-- .nav-item -->
                <li class="nav-item dropdown header-nav-dropdown">
                  <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="oi oi-grid-three-up"></span>
                  </a>
                  <div class="dropdown-arrow"></div>
                  <!-- .dropdown-menu -->
                  <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
                    <!-- .dropdown-sheets -->
                    <div class="dropdown-sheets">
                      <!-- .dropdown-sheet-item -->
                      
                      <!-- /.dropdown-sheet-item -->
                      
                      <!-- /.dropdown-sheet-item -->
                      <!-- .dropdown-sheet-item -->
                      <div class="dropdown-sheet-item">
                        <a href="#" class="tile-wrapper">
                          <span class="tile tile-lg bg-cyan">
                            <i class="oi oi-document"></i>
                          </span>
                          <span class="tile-peek">Generated Reports</span>
                        </a>
                      </div>
                      <!-- /.dropdown-sheet-item -->
                    </div>
                    <!-- .dropdown-sheets -->
                  </div>
                  <!-- .dropdown-menu -->
                </li>
                <!-- /.nav-item -->
</ul>


      <!-- .app-header -->
      <header class="app-header"style="background-color:#408080;">
        <!-- .top-bar -->
        <div class="top-bar">
          <!-- .top-bar-brand -->
          <div class="top-bar-brand">
            <a href="index.php">
              <img src="assets/images/brand-inverse.png" height="32" alt="">
            </a>
          </div>
          <!-- /.top-bar-brand -->
          <!-- .top-bar-list -->
          <div class="top-bar-list">
            <!-- .top-bar-item -->
            <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
              <!-- toggle menu -->
              <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="Menu" aria-controls="navigation">
                <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                </span>
              </button>
              <!-- /toggle menu -->
            </div>
            <!-- /.top-bar-item -->
            <!-- .top-bar-item -->
         
            <!-- /.top-bar-item -->
            <!-- .top-bar-item -->
            <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
              <div class="dropdown">
                <button class="btn-account d-none d-md-flex" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php $name = $_SESSION['username'];
                  $asl = substr($name, 0, 1);
                  ?>
                    <a href="profile" class='user-avatar' style='font-size:20px;text-decoration:none;text-shadow:1px 0px 0px 0px black;' ><?php echo $asl ?></a>
                 
                  <span class="account-summary pr-lg-4 d-none d-lg-block">
                    <span class="account-name"><?php echo $_SESSION['username']; ?></span>
                    <span class="account-description"><?php echo $_SESSION['staff_name']; ?></span>
                  </span>
                </button>
                <div class="dropdown-arrow dropdown-arrow-left"></div>
                <!-- .dropdown-menu -->
                <div class="dropdown-menu">
                  <h6 class="dropdown-header d-none d-md-block d-lg-none"><?php echo $_SESSION['username']; ?></h6>
                  

                  <a id='logout' class="dropdown-item" style="text-decoration:none;">
                    <span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
        
                 
                </div>
                <!-- /.dropdown-menu -->
              </div>


              </div>



            <!-- /.top-bar-item -->
          </div>
          <!-- /.top-bar-list -->
        </div>
        <!-- /.top-bar -->
      </header>
      <!-- /.app-header -->
      <!-- .app-aside -->
      <aside class="app-aside">
        <!-- .aside-content -->
        <div class="aside-content">
          <!-- .aside-header -->
          <header class="aside-header d-block d-md-none">
            <!-- .btn-account -->
            <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside">
            <a href="profile" class='user-avatar user-avatar-lg' style='font-size:30px;text-decoration:none;text-shadow:1px 0px 0px 0px black;background-color:black;color:white;' ><?php echo $asl ?></a>
                 
           
              <span class="account-icon">
                <span class="fa fa-caret-down fa-lg"></span>
              </span>
              <span class="account-summary">
              <span class="account-name"><?php echo $_SESSION['username']; ?></span>
                    <span class="account-description"><?php echo $_SESSION['staff_name']; ?></span>
              </span>
            </button>
            <!-- /.btn-account -->
            <!-- .dropdown-aside -->
            <div id="dropdown-aside" class="dropdown-aside collapse">
              <!-- dropdown-items -->
              <div class="pb-3">

                  <a id='logout2'  class="dropdown-item" style="text-decoration:none;">
                    <span class="dropdown-icon oi oi-account-logout"></span> Logout</a>

              </div>
              <!-- /dropdown-items -->
            </div>
            <!-- /.dropdown-aside -->
          </header>
          <!-- /.aside-header -->
          <?php include 'asidebar.php'; ?>
          <!-- /.aside-menu -->
        </div>
        <!-- /.aside-content -->
      </aside>
   
      <script>
        let out = 0;
    var logoutBtn = document.getElementById('logout');

    logoutBtn.addEventListener('click', function() {
      // Show a confirmation dialog box
      var confirmed = confirm('Are you sure you want to logout?');

      // If the user clicked "Yes", redirect to the logout page
      if (confirmed) {
        location.replace("/logout");

     
      }
    });


    var logoutBtn2 = document.getElementById('logout2');

    logoutBtn2.addEventListener('click', function() {

        location.href = 'logout';
      
    });
  </script>
     <main class="app-main" style="padding-top: 1rem;">

    