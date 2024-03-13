<?php

require __DIR__."/../../config/bootstrap.php";


// Check if PHP session exists
$r = checkLoggedIn();
// if $GLOBALS['auth_required'] force login
if ($GLOBALS['auth_required']) {
    redirect("../login.php");
}

// Recover guest user
if (isset($_REQUEST['id']) && $_REQUEST['id']) {
    if (!checkUserLoginExists($_REQUEST['id'])) {
        unset($_REQUEST['id']);
    }
    $r = loadUser($_REQUEST['id'],false);

}
// Do not create guest here, deferred to VRE start

if ($GLOBALS['RunningMode'] != 'local') {
  $group_box_item_class = 'group-box-item-disabled';
} else {
  $group_box_item_class = 'group-box-item';
}

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
          <div class="group-box-title">Data Management</div>
          <div class="group-box-content">
            <div class="group-box-item">
              <a href="https://catalogue.datatools4heart.bsc.es" target="_blank"><img src="gui/img/METADATA-CATALOGUE.jpg"/>
              <p>Data Catalogue</p></a>
            </div>
            <div class="group-box-item">
              <a href="https://va.datatools4heart.eu"  target="_blank"><img src="gui/img/ARTIFICIAL-INTELLIGENCE.jpg"/>
              <p>Virtual Assistant</p></a>
            </div>

            <div class="<?= $group_box_item_class ?>">
              <a href="#" ><img src="gui/img/COMMON-DATA-MODEL.jpg"/>
              <p>Data Processing</p></a>
            </div>

            <div class="<?= $group_box_item_class ?>">
              <a href="#" ><img src="gui/img/MULTILINGUAL-NATURAL-LANGUAGE-PROCESSING-SUITE.jpg"/>
              <p>Natural Language Processing</p></a>
            </div>
          </div>
        </div>
        <div class="group-box">
          <div class="group-box-title">Federated processing</div>
          <div class="group-box-content">
            <div class="group-box-item">
              <a href="gui/sitesDT4H.php" >
                <img src="gui/img/network.png" style="width:70px">
                <p>DT4H Network</p>
              </a>
            </div>
            <div class="group-box-item">
              <a href="gui/toolsDT4H.php" >
                <img src="gui/img/tools.png" style="width:70px">
                <p>Available Tools</p>
              </a>
            </div>
            <div class="group-box-item">
              <a href="index.php" target="_blank">
                <img src="gui/img/FEDERATED-LEARNING.jpg">
                <p>Federated processing<br/>environment</p>
              </a>
            </div>
            <div class="group-box-item">
              <a href="https://hbpmip.link" target="_blank">
                <img src="https://hbpmip.link/services/assets/logo.png" style="width:70px">
                <p>Medical Informatics Platform</p>
              </a>
            </div>
            <div class="group-box-item">
              <a href="https://fl.bsc.es/flmanager/API/v1/docs" target="_blank">
                <img src="gui/img/openAPI.png">
                <p>FLManager API <br/>Documentation</p>
              </a>
            </div>

            <div class="<?= $group_box_item_class ?>">
              <a href="gui/runJupyterLab.php" target="_blank">
                <img src="gui/img/jupyter.png">
                <p>Jupyter Lab</p>
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
<?php require "htmlib/jsDT4H.inc.php";
