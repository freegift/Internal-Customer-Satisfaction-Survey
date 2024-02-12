<!DOCTYPE html>
<div class="" style="/*float: left;*/ width: auto;margin: 5px; /*height: 540px; overflow: auto;*/">
    <div id="accordion" class="mainmenu">
       <h5>Survey Reports & Statistics</h5>
       <div>
           <ul>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/reports.php?p=dashboard#reports');"><span class="ui-icon ui-icon-cart"></span>Dashboard</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/reports.php?p=recententries#reports');"><span class="ui-icon ui-icon-cart"></span>Survey Entries / Run Search</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/reports.php?p=byquestions#reports');"><span class="ui-icon ui-icon-cart"></span>Report by Survey Questions</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/reports.php?p=byusers#reports');"><span class="ui-icon ui-icon-cart"></span>Report by Users / Customers</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/reports.php?p=bydepartments#reports');"><span class="ui-icon ui-icon-cart"></span>Report by Units / Departments</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/reports.php?p=suggestions#reports');"><span class="ui-icon ui-icon-cart"></span>Suggestions for Target Units</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/reports.php?p=appraisals#reports');"><span class="ui-icon ui-icon-cart"></span>Comprehensive Appraisals</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/reports.php?p=error#error');"><span class="ui-icon ui-icon-cart"></span>Error Log Reports</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/reports.php?p=audit#audit');"><span class="ui-icon ui-icon-cart"></span>Audit Log Reports</a></li>
           </ul>
       </div>
       <h5>Questions & Options Management</h5>
       <div>
           <ul>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=questions#questions');"><span class="ui-icon ui-icon-cart"></span>Create / Edit Question(s)</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=options#options');"><span class="ui-icon ui-icon-cart"></span>Create / Edit Option(s)</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=mapquestions#listmapquestions');"><span class="ui-icon ui-icon-cart"></span>Question / Options Mapping</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=mapdepartmentquestions#listmapdepartmentquestions');"><span class="ui-icon ui-icon-cart"></span>Department / Questions Mapping</a></li>
            </ul>
       </div>
       <h5>Global Configuration Setting</h5>
       <div>
           <ul>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=categories');"><span class="ui-icon ui-icon-cart"></span>Default Survey Setup</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=departments');"><span class="ui-icon ui-icon-cart"></span>Units / Department Setup</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=login');"><span class="ui-icon ui-icon-cart"></span>Administrators Login Setup</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=users#users-list');"><span class="ui-icon ui-icon-cart"></span>Users / Customers Setup</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=mapusers#mapusers-list');"><span class="ui-icon ui-icon-cart"></span>User-to-Units Mapping</a></li>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=mapping#mapping-list');"><span class="ui-icon ui-icon-cart"></span>Unit-to-Units Mapping </a></li>
                <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=unit-heads#heads-list');"><span class="ui-icon ui-icon-cart"></span>Unit Heads / Managers Mapping</a></li>
                <!--<li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=setup&#category');"><span class="ui-icon ui-icon-cart"></span>Survey Controllers</a></li>-->
           </ul>
       </div>
       <h5>My Account</h5>
       <div>
           <ul>
               <li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=changepassword&amp;id=<?php echo $_SESSION["LOGIN"]["l_id"] ;?>&amp;#change');"><span class="ui-icon ui-icon-cart"></span>Change Password</a></li>
                <!--<li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/reports.php?p=audit&amp;id=&amp;#audit');"><span class="ui-icon ui-icon-cart"></span>Survey Questions Reports</a></li>-->
                <!--<li><a target="rightFrame" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR ;?>controllers/controllers.php?p=setup&#category');"><span class="ui-icon ui-icon-cart"></span>Survey Controllers</a></li>-->
           </ul>
       </div>
       
   </div>
</div>