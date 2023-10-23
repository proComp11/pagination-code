<?php 
include_once('DbUtil.php');

$obj = new DbUtil();
$limit = 5;
$page = "";
if(isset($_POST['page_no'])){
    $page = $_POST['page_no'];
}else{
    $page = 1;
} 
$response = $obj->getData($page, $limit);

if($response == 0){
    $msg = [
        'code' => 0,
        'result' => "",
        'staus' => "No Record Found"
    ];    

}else{
    $msg = [
        'code' => 1,
        'result' => $response,
        'staus' => "Found"
    ];
}
echo json_encode($msg);
?>