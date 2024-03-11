<?php

require __DIR__."/../../config/bootstrap.php";

#redirect("index_vre.php");

// Check if PHP session exists
$r = checkLoggedIn();
// if $GLOBALS['auth_required'] force login
if ($GLOBALS['auth_required']) {
    redirect("login.php");
}

// Recover guest user
if (isset($_REQUEST['id']) && $_REQUEST['id']) {
    if (!checkUserLoginExists($_REQUEST['id'])) {
        unset($_REQUEST['id']);
    }
    $r = loadUser($_REQUEST['id'],false);

}
// Do not create guest here, deferred to VRE start

?>

<?php require "htmlib/headerDT4H.inc.php"; ?>

<body class="page-header-fixed page-content-white ">
  <div class="page-wrapper">

    <?php require "htmlib/topDT4H.inc.php"; ?>
    <!-- BEGIN CONTENT -->

    <div class="page-content-wrapper">
      <!-- BEGIN CONTENT BODY -->
      <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE-->
        <p class=page-title>DT4H User Interface</p>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="group-box">
          <div class="group-box-title">Data</div>
          <div class="group-box-content">
            <div class="group-box-item">
              <a href="https://catalog.dt4h.bsc.es"><img src="gui/img/METADATA-CATALOGUE.jpg"/>
              <p>Meta-Data Catalogue</p></a>
            </div>
            <div class="group-box-item">
              <a href="#"><img src="gui/img/COMMON-DATA-MODEL.jpg"/>
              <p>Data Processing</p></a>
            </div>
            <div class="group-box-item">
              <a href="#"><img src="gui/img/MULTILINGUAL-NATURAL-LANGUAGE-PROCESSING-SUITE.jpg"/>
              <p>Natural Language processing</p></a>
            </div>
          </div>
        </div>
        <div class="group-box">
          <div class="group-box-title">Federated analysis</div>
          <div class="group-box-content">
            <div class="group-box-item">
              <a href="gui/sitesDT4H.php">
                <img src="gui/img/network.png" style="width:75px">
                <p>DT4H Network</p>
              </a>
            </div>
            <div class="group-box-item">
              <a href="index.php" target="_blank">
                <img src="gui/img/FEDERATED-LEARNING.jpg">
                <p>Federated processing</p>
              </a>
            </div>
          </div>
        </div>
       </div>
        <!-- END CONTENT BODY -->
    </div>
      <!-- END CONTENT -->
  <?php require "htmlib/footerDT4H.inc.php";?>
</div>
