<?php
require __DIR__."/../../config/bootstrap.php";

# Check running mode
if ($GLOBALS['RunningMode'] != 'local') {
    redirect('index.php');
}

$cmd = "jupyter lab --allow-root --ip=0.0.0.0 --notebook-dir=/shared_data/notebooks --json &";

exec($cmd, $output);
print_r($output);