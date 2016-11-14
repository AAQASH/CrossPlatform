<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
<!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo SITEROOTADMIN ?>/">Home</a>
    </div>
  
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo SITEROOTADMIN ?>/#" class="dropdown-toggle" data-toggle="dropdown">Network <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo SITEROOTADMIN ?>/network/admin-list.php">Admin User</a></li>
            <li><a href="<?php echo SITEROOTADMIN ?>/network/network-list.php">Network User</a></li>
            <li><a href="<?php echo SITEROOTADMIN ?>/network/staff-list.php">Staff User</a></li>
          </ul>
        </li>
        
        <li><a href="<?php echo SITEROOTADMIN ?>/#" class="dropdown-toggle" data-toggle="dropdown">Master <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo SITEROOTADMIN ?>/master/exam-list.php">Examination</a></li>
            <li><a href="<?php echo SITEROOTADMIN ?>/master/event-list.php">Event</a></li>
            <li><a href="<?php echo SITEROOTADMIN ?>/master/notice-list.php">Notice</a></li>
            <li><a href="<?php echo SITEROOTADMIN ?>/master/assignment-list.php">Assignment</a></li>
            <li><a href="<?php echo SITEROOTADMIN ?>/master/subject-list.php">Subject</a></li>
            <li><a href="<?php echo SITEROOTADMIN ?>/master/class-list.php">Class</a></li>
            <li><a href="<?php echo SITEROOTADMIN ?>/master/practical-list.php">Practical</a></li>
            <li><a href="<?php echo SITEROOTADMIN ?>/master/timetable-list.php">Time Table</a></li>
          </ul>
        </li>
        <!--<li><a href="<?php echo SITEROOTADMIN ?>/#" class="dropdown-toggle" data-toggle="dropdown">Newsletter <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo SITEROOTADMIN ?>/newsletter/newsletter-subscriber-list.php">Newsletter Subscriber</a></li>
          </ul>
        </li>-->
        <!--<li><a href="<?php echo SITEROOTADMIN ?>/#" class="dropdown-toggle" data-toggle="dropdown">Settings <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo SITEROOTADMIN ?>/setting/systememails-list.php">System Emails</a></li>
            <li><a href="<?php echo SITEROOTADMIN ?>/setting/sitesetting-list.php">Sitesettings</a></li>
          </ul>
        </li>-->
        <li><a href="<?php echo SITEROOTADMIN ?>/#" class="dropdown-toggle" data-toggle="dropdown">Reports <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo SITEROOTADMIN ?>/reports/login-log-list.php">Login Log</a></li>
            <!--<li><a href="<?php echo SITEROOTADMIN ?>/reports/contact-us-list.php">Contact Us</a></li>-->
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
