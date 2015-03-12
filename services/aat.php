<?php
require_once('reconciliation_aat.php');

/*
ob_start();
print_r($_REQUEST);
$code = ob_get_clean();
file_put_contents('tmp/joske3.txt', $code);
die;
*/



$service = new AatService();
$service->Call($_REQUEST);



//file_put_contents('tmp/r.txt', $_REQUEST['queries'], FILE_APPEND);
//$service->Call($_REQUEST);
/*
ob_start();
print_r($_REQUEST);
$code = ob_get_clean();
file_put_contents('tmp/joske.txt', $code);
die;
*/
/*
if($_REQUEST['recon']){

}
else {
    $service->Call($_REQUEST);
}
*/

/*


$service->QueryInitialise();
$service->OneQuery('q0', 'Mary J Rathbun');
print_r(json_format(json_encode($service->result))); die;
*/