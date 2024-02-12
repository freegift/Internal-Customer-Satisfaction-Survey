<?php require_once 'config.php';
//if (!isset($_SESSION)){
//    session_start();
//}

//switch ($_SESSION['LOGIN']['US_ROLE_ID']) {
//    case 1: 
//        include_once '../home/pages/Customers/pIndividualAccountStatement.php';
//    case 2:
//    case 3:
//        echo "<script>window.open('".BASE_DIR ."controllers/reports.php?p=recententries#reports','rightFrame');</script>";
        echo "<script>window.open('".BASE_DIR ."controllers/reports.php?p=dashboard#reports','rightFrame');</script>";
//        include_once '../home/pages/Customers/pIndividualAccountStatement.php';
//        echo $url;
//        $page = implode('', file( $url ));
//        echo $page;
//        break;
//    default: 
       //include '../Requisitions/Requisitions.php';
//       break;
//}
//echo 'seen here';
?>