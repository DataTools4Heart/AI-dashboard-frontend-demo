<?php

require __DIR__ . "/../../config/bootstrap.php";

//Retrieve sites

$tools = getToolsInfo();

$progress = ['pending', 'testing', 'active'];
$types = ['comp'=> 'Computational', 'data'=> 'Data', 'both'=>'Data & Computational'];
$status = ['inactive', 'active'];
// Print page

?>

<?php require "htmlib/headerDT4H.inc.php"; ?>

<body class="page-header-fixed page-content-white">
  <div class="page-wrapper">

    <?php require "htmlib/topDT4H.inc.php"; ?>

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
      <!-- BEGIN CONTENT BODY -->
      <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">
          <a href="javascript:;" target="_blank"><img src="assets/layouts/layout/img/icon.png" width=100></a>
          DT4H Available Federated Tools
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

	<?php

	// print PHP ERROR MESSAGES
	if (isset($_SESSION['errorData'])) {
		foreach ($_SESSION['errorData'] as $subTitle => $txts){
			if (count($txts) == 0){
				unset($_SESSION['errorData'][$subTitle]);
			}
		}
	}
	if (isset($_SESSION['errorData']) && $_SESSION['errorData']) {
		if (isset($_SESSION['errorData']['Info'])) {
			?><div class="alert alert-info"><?php
		} else {
			?><div class="alert alert-warning"><?php
		}
		foreach ($_SESSION['errorData'] as $subTitle => $txts) {
			print "$subTitle<br/>";
			foreach ($txts as $txt) {
				print "<div style=\"margin-left:20px;\">$txt</div>";
			}
		}
		unset($_SESSION['errorData']);
		?></div><?php
	}
	?>
        <div class="row">
          <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light portlet-fit bordered">
              <div class="portlet-title">
                <div class="caption">
                  <i class="icon-share font-red-sunglo hide"></i>
                  <span class="caption-subject font-dark bold">DT4H available tools</span>
                </div>
              </div>
              <div class="portlet-body">
                <table class="table table-striped table-hover table-bordered" id="table-sites">
                  <thead>
                    <tr>
                      <th> Tool Id </th>
                      <th> Full Name </th>
                      <th> Description </th>
                      <th> Operation(s) </th>
                      <th> Group </th>
                      <th> Inputs </th>
                      <th> Outputs</th>
                      <th> Available at </th>
                    </tr>
                  </thead>

                  <tbody>
                    <!-- process and display each result row -->
                <?php foreach ($tools as $obj) { ?>
                    <tr>
                        <td> <?= $obj["_id"] ?> </td>
                        <td> <?= $obj["name"] ?> </td>
                        <td> <?= $obj["short_description"] ?> </td>
                        <td>
                <?php   foreach ($obj['ops'] as $i => $op) { ?>
                            <a href="tools/<?=$obj['_id']?>/input.php?op=<?=$i?>"><?=$obj['ops'][$i]?></a><br/>
                <?php   } ?>
                        <td> <?= join(", ", $obj["keywords"]) ?> </td>
                        <td> <?= join("<br/>\n",$obj["inputs"]) ?> </td>
                        <td> <?= join("<br/>\n",$obj["outputs"]) ?> </td>
                        <td> <?= $obj["nodes"] ?> </td>
                    </tr>
                <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
          </div>
        </div>
      </div>
      <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

<?php
require "htmlib/footerDT4H.inc.php";
//require "htmlib/jsDT4H.inc.php";

