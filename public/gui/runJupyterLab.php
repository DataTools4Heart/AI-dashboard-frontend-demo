<?php
require __DIR__."/../../config/bootstrap.php";

# Check running mode
if ($GLOBALS['RunningMode'] != 'local') {
    redirect('index.php');
}

$cmd = "jupyter lab --allow-root --ip=0.0.0.0 --notebook-dir=/shared_data/notebooks &";
exec($cmd, $output);
print("Waiting for JupyterLab to start...<br>");
print_r($output);
sleep(3);
redirect('https://localhost:8888/lab');

