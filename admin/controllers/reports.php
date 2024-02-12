<?php 
include '../web/selfconfig.php';
include_once '../home/classes/creports.php';
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
            case "dashboard":
                echo '<ul>
                    <li><strong><a href="#reports">Dashboard</a></strong></li>
                </ul>'; 
                echo '<div id="reports" class="div-content">';
                include_once '../home/pages/reports/pdashboard.php';
                echo '</div>';
                break;
            case "audit":
                echo '<ul>
                    <li><strong><a href="#list">Audit Log</a></strong></li>
                </ul>'; 
                echo '<div id="list" class="div-content">';
                include_once '../home/pages/logs/pauditlog.php';
                echo '</div>';
                break;
            case "error":
                echo '<ul>
                    <li><strong><a href="#list">Error Log</a></strong></li>
                </ul>'; 
                echo '<div id="list" class="div-content">';
                include_once '../home/pages/logs/perrorlog.php';
                echo '</div>';
                break;
            case "recententries":
                echo '<ul>
                    <li><strong><a href="#reports">Recent / All Entries</a></strong></li>
                </ul>'; 
                echo '<div id="reports" class="div-content">';
                include_once '../home/pages/reports/precententries.php';
                echo '</div>';
                break;
            case "byquestions":
                echo '<ul>
                    <li><strong><a href="#reports">Reports by Survey Questions</a></strong></li>
                </ul>'; 
                echo '<div id="reports" class="div-content">';
                include_once '../home/pages/reports/pbyquestions.php';
                echo '</div>';
                break;
            case "byusers":
                echo '<ul>
                    <li><strong><a href="#reports">Reports by Users</a></strong></li>
                </ul>'; 
                echo '<div id="reports" class="div-content">';
                include_once '../home/pages/reports/pbyusers.php';
                echo '</div>';
                break;
            case "bydepartments":
                echo '<ul>
                    <li><strong><a href="#reports">Reports by Units / Departments</a></strong></li>
                </ul>'; 
                echo '<div id="reports" class="div-content">';
                include_once '../home/pages/reports/pbydepartments.php';
                echo '</div>';
                break;
            case "suggestions":
                echo '<ul>
                    <li><strong><a href="#reports">Suggestions for Target Units / Departments</a></strong></li>
                </ul>'; 
                echo '<div id="reports" class="div-content">';
                include_once '../home/pages/reports/psuggestions.php';
                echo '</div>';
                break;
            case "appraisals":
                echo '<ul>
                    <li><strong><a href="#reports">Comprehensive / Individual Appraisals Report</a></strong></li>
                </ul>'; 
                echo '<div id="reports" class="div-content">';
                include_once '../home/pages/reports/pcomprehensiveappraisals.php';
                echo '</div>';
                break;
            default :
                break;
        }
        ?>       
</div>
<?php include_once '../app/footer.php'; ?>