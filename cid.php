<?php
// $cid = $Page->username->getViewValue();
// if(empty($_SESSION['user'])){
//         $cid[1] = 'X';
//         $cid[2] = 'X';
//         //echo $cid;
//         //exit();
//     }
// elseif($_SESSION['user']['username'] != $cid && $_SESSION['user']['user_type'] != 'admin'){
//         $cid[1] = 'X';
//         $cid[2] = 'X';
// }
//  {
// // $cid[1] = 'X';
// // $cid[2] = 'X';
// echo $cid;
//  }

if(empty($_SESSION['user'])){
        $Page->username->ViewValue[1] = 'X';
        $Page->username->ViewValue[2] = 'X';
        //echo $cid;
        //exit();
    }
elseif($_SESSION['user']['username'] != $Page->username->ViewValue && $_SESSION['user']['user_type'] != 'admin'){
    $Page->username->ViewValue[1] = 'X';
    $Page->username->ViewValue[2] = 'X';
}
 {
// $cid[1] = 'X';
// $cid[2] = 'X';
//echo $cid;
 }


 ?>