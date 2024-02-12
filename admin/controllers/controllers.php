<?php 
include '../web/selfconfig.php';
include_once '../home/classes/ccontrollers.php';
include_once '../app/alerts.php';
if (!isset($_REQUEST['p']) || $_REQUEST["p"] == ''){
    die("Invalid access");
} else {
   $p = $_REQUEST['p']; 
}
?>
<?php $cApp->ShowInfo(); ?>

<div id="tabs" class="tabs">
    <?php 
        switch ($p)
        {
            case "categories":
                echo '<ul>
                        <li><strong><a href="#categories">Default Survey Category Setup</a></strong></li>';
                        //<li><strong><a href="#users">Users Setup</a></strong></li>';
                echo '</ul>
                    <div id="categories" class="div-content">';
                    if (isset($_REQUEST["id"]) && $_REQUEST["id"] !='' ){ 
                        $id = $_REQUEST["id"];
                        include_once '../home/pages/categories/pedit.php'; 
                    }else{
                        include_once '../home/pages/categories/padd.php'; 
                    }
                    include_once '../home/pages/categories/plist.php';
                echo '</div>';
                break;
            case "login":
                echo '<ul>
                        <li><strong><a href="#login">Administrators Login Setup</a></strong></li>';
                        //<li><strong><a href="#users">Users Setup</a></strong></li>';
                echo '</ul>
                    <div id="login" class="div-content">';
                    if (isset($_REQUEST["id"]) && $_REQUEST["id"] !='' ){ 
                        $id = $_REQUEST["id"];
                        include_once '../home/pages/login/pedit.php'; 
                    }else{
                        include_once '../home/pages/login/padd.php'; 
                    }
                    include_once '../home/pages/login/plist.php';
                echo '</div>';
                break;
            case "departments":
                echo '<ul>
                        <li><strong><a href="#departments">Units / Departments Setup</a></strong></li>';
                        //<li><strong><a href="#users">Users Setup</a></strong></li>';
                echo '</ul>
                    <div id="departments" class="div-content">';
                    if (isset($_REQUEST["id"]) && $_REQUEST["id"] !='' ){ 
                        $id = $_REQUEST["id"];
                        include_once '../home/pages/departments/pedit.php'; 
                    }else{
                        include_once '../home/pages/departments/padd.php'; 
                    }
                    include_once '../home/pages/departments/plist.php';
                echo '</div>';
                break;
            case "users":
                echo '<ul>
                        <li><strong><a href="#users">End-Users Setup</a></strong></li>'
                        .'<li><strong><a href="#users-list">ListView - End-Users</a></strong></li>';
                echo '</ul>
                    <div id="users" class="div-content">';
                    if (isset($_REQUEST["id"]) && $_REQUEST["id"] !='' ){ 
                        $id = $_REQUEST["id"];
                        include_once '../home/pages/users/pedit.php'; 
                    }else{
                        include_once '../home/pages/users/padd.php'; 
                    }
               echo '</div>';
                echo '<div id="users-list" class="div-content">';
                    include_once '../home/pages/users/plist.php';
                echo '</div>';
                break;
            case "changepassword":
                echo '<ul>
                    <li><strong><a href="#change">Change Password</a></strong></li>
                </ul>'; 
                echo '<div id="change" class="div-content">';
                if (isset($_REQUEST["id"]) && $_REQUEST["id"] !='' ){ 
                        $id = $_REQUEST["id"];
                    include_once '../home/pages/users/pchangepassword.php';         
                }
                echo '</div>';
                break;
            case "mapping":
                echo '<ul>
                        <li><strong><a href="#mapping">Mapping Departments Setup</a></strong></li>'
                        .'<li><strong><a href="#mapping-list">Mapping Departments List</a></strong></li>';
                echo '</ul>
                    <div id="mapping" class="div-content">';
                    if (isset($_REQUEST["id"]) && $_REQUEST["id"] !='' ){ 
                        $id = $_REQUEST["id"];
//                        include_once '../home/pages/mapping/pedit.php'; 
                        include_once '../home/pages/mapping/padd.php';
                    }else{
                         echo "No valid units/department selected for mapping.";
                    }
                echo '</div>';
                echo '<div id="mapping-list" class="div-content">';
                    include_once '../home/pages/mapping/plist.php';
                echo '</div>';
                break;
            case "questions":
                echo '<ul>
                        <li><strong><a href="#questions">Create / Edit Question(s)</a></strong></li>';
                        //<li><strong><a href="#users">Users Setup</a></strong></li>';
                echo '</ul>
                    <div id="questions" class="div-content">';
                    if (isset($_REQUEST["id"]) && $_REQUEST["id"] !='' ){ 
                        $id = $_REQUEST["id"];
                        include_once '../home/pages/questions/pedit.php'; 
                    }else{
                        include_once '../home/pages/questions/padd.php'; 
                    }
                    include_once '../home/pages/questions/plist.php';
                echo '</div>';
                break;
            case "options":
                echo '<ul>
                        <li><strong><a href="#options">Create / Edit Option(s)</a></strong></li>';
                        //<li><strong><a href="#users">Users Setup</a></strong></li>';
                echo '</ul>
                    <div id="options" class="div-content">';
                    if (isset($_REQUEST["id"]) && $_REQUEST["id"] !='' ){ 
                        $id = $_REQUEST["id"];
                        include_once '../home/pages/options/pedit.php'; 
                    }else{
                        include_once '../home/pages/options/padd.php'; 
                    }
                    include_once '../home/pages/options/plist.php';
                echo '</div>';
                break;
            case "mapquestions":
                echo '<ul>
                        <li><strong><a href="#savemapquestions">Manage Questions & Options</a></strong></li>
                        <li><strong><a href="#listmapquestions">List Questions & Options Mapping</a></strong></li>';
                echo '</ul>
                    <div id="savemapquestions" class="div-content">';
                    if (isset($_REQUEST["id"]) && $_REQUEST["id"] !='' ){ 
                        $id = $_REQUEST["id"];
                        include_once '../home/pages/questions/psavemapquestions.php'; 
                    }else{ echo "No question selected for mapping";
                        //include_once '../home/pages/questions/padd.php'; 
                    }
                echo '</div>';
                echo '<div id="listmapquestions" class="div-content">';
                    include_once '../home/pages/questions/plistmapquestions.php';
                echo '</div>';
                break;
            case "mapdepartmentquestions":
                echo '<ul>
                        <li><strong><a href="#savemapdepartmentquestions">Manage Department & Questions</a></strong></li>
                        <li><strong><a href="#listmapdepartmentquestions">List Departments & Questions Mapping</a></strong></li>';
                echo '</ul>
                    <div id="savemapdepartmentquestions" class="div-content">';
                    if (isset($_REQUEST["id"]) && $_REQUEST["id"] !='' ){ 
                        $id = $_REQUEST["id"];
                        include_once '../home/pages/questions/psavemapdepartmentquestions.php'; 
                    }else{ echo "No department selected for mapping";
                        //include_once '../home/pages/questions/padd.php'; 
                    }
                echo '</div>';
                echo '<div id="listmapdepartmentquestions" class="div-content">';
                    include_once '../home/pages/questions/plistmapdepartmentquestions.php';
                echo '</div>';
                break;
            case "mapusers":
                echo '<ul>
                        <li><strong><a href="#mapusers">Users-to-Units Mapping Setup</a></strong></li>'
                        .'<li><strong><a href="#mapusers-list">Users-to-Units Mapping List</a></strong></li>';
                echo '</ul>
                    <div id="mapusers" class="div-content">';
                    if (isset($_REQUEST["id"]) && $_REQUEST["id"] !='' ){ 
                        $id = $_REQUEST["id"];
//                        include_once '../home/pages/mapping/pedit.php'; 
                        include_once '../home/pages/Mapusers/padd.php';
                    }else{
                         echo "No valid user/units selected for mapping.";
                    }
                echo '</div>';
                echo '<div id="mapusers-list" class="div-content">';
                    include_once '../home/pages/Mapusers/plist.php';
                echo '</div>';
                break;
            case "unit-heads":
                echo '<ul>
                        <li><strong><a href="#mapheads">Unit Heads / Managers Mapping Setup</a></strong></li>'
                        .'<li><strong><a href="#heads-list">Unit Heads / Managers Mapping List</a></strong></li>';
                echo '</ul>
                    <div id="mapheads" class="div-content">';
                    if (isset($_REQUEST["id"]) && $_REQUEST["id"] !='' ){ 
                        $id = $_REQUEST["id"];
//                        include_once '../home/pages/mapping/pedit.php'; 
                        include_once '../home/pages/unitheads/padd.php';
                    }else{
                         echo "No valid user/units selected for mapping.";
                    }
                echo '</div>';
                echo '<div id="heads-list" class="div-content">';
                    include_once '../home/pages/unitheads/plist.php';
                echo '</div>';
                break;
            default :
                break;
        }
        ?>       
</div>
<?php include_once '../app/footer.php'; ?>
