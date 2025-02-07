<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="assets/images/backgrounds/02.jpg">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
          <li class="nav-item mr-auto"><a class="navbar-brand" href=""><img class="brand-logo" alt="WBoT admin logo" src="assets/images/logo/logo.png"/>
              <h4 class="brand-text"> WhatsApp CRM </h4></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
      </div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li id="sid-main"><a href="index.php"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>
          <li  id="sid-add" class=" nav-item"><a href="add-license.php"><i class="ft-plus-circle"></i><span class="menu-title" data-i18n=""> Create License</span></a>
          </li>
          <li id="sid-all" class=" nav-item"><a href="all-licenses.php"><i class="ft-list"></i><span class="menu-title" data-i18n=""> ALl Licenses</span></a>
          </li>
<?php 
if ($_SESSION['user_type'] == 'admin' || $_SESSION['user_type'] == 'user')
{ 
  ?>
          <li  id="sid-radd" class=" nav-item"><a href="add-reseller.php"><i class="ft-plus-circle"></i><span class="menu-title" data-i18n="">Add Reseller</span></a>
          </li>
          <li id="sid-rall" class=" nav-item"><a href="all-reseller.php"><i class="ft-list"></i><span class="menu-title" data-i18n="">All Resellers</span></a>
          </li>
          <li  id="sid-radd" class=" nav-item"><a href="add-admin.php"><i class="ft-plus-circle"></i><span class="menu-title" data-i18n="">Add Admin</span></a>
          </li>
          <li id="sid-rall" class=" nav-item"><a href="all-admin.php"><i class="ft-list"></i><span class="menu-title" data-i18n="">All Admin</span></a>
          </li>
          <?php } ?>
        </ul>
      </div>
      <a class="btn btn-dark btn-block btn-glow btn-upgrade-pro mx-1" href="#" target="_blank">Welcome</a>
    
    </div>