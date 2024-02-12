<div id="header" class=" ui-widget">
    <div style="/*width: 500px;*/ float: left;">
        <div style="float: left; background-color: white;">
            <img src="<?php echo BASE_DIR ;?>web/images/fbn-logo-blue.png" height="65" width="200" alt=""
             style=" border-radius: 4px; float: left; vertical-align: top; margin-right: 5px; margin-left: 10px; margin-top: 3px; z-index: 3"/>
        </div>
        <div class="" style="padding: 1px 5px; margin-top: 7px; color:white; 
            position:relative; font-weight: normal; /*width: 100%; */ z-index: 1; float: left;">
            <h1 style="margin: 0px; padding: 0px; "><?php echo cApp::AppTitle() ;?></h1>
            <span class=""><?php //echo $_SESSION["LOGIN"]["US_ID"];?></span>
            <!--<span>Department / Unit: <strong><?php // echo $_SESSION["LOGIN"]["US_DEPT_NAME"];?></strong></span><br>-->
            <br><span>Welcome ! <strong><?php echo $_SESSION["LOGIN"]["l_fullname"];?></strong> </span>
                <!--<span><?php // echo isset($_SESSION["ROLE"])?$_SESSION["ROLE"]["NAME"]:'';?></span>-->
        </div>
    </div>

    <div class="" style="z-index: 0; float: right; width: auto; /*border-color: red; border-width: 1px; border-style: dotted;*/
         margin-right: 10px; margin-top: 5px; height: 70px; font-weight: normal; text-align: right; /*position: absolute; margin-left: 600px;*/">
        <a target="_parent" href="<?php echo BASE_DIR."login/logout.php" ;?>" title="logout here" class="button"><span class="ui-icon ui-icon-power" style="float:left; margin:0 0px 0px 0;"></span>Logout</a><br>
        <div id="timer"></div>
    </div>
</div>         
            
          <!-- <div class="ui-state-active" style="padding: 1px 5px; margin-top: 7px; opacity: 1; color: blue; 
                position: absolute; /*width: 100%; */top: 40px; z-index: 0; float: left;">
                <span class=""><?php echo $_SESSION["LOGIN"]["_id"];?></span>
                <span><?php echo cApp::AppTitle() ;?> - News : Jonathan plans of 3rd term bill</span>
            </div> -->
            
        </div>
        
        
        <!-- begin body page -->
        <!--<div style="margin: 5px; clear: both; /*overflow: scroll;*/">
            <table >
                <tr>
                    <td style="width: 250px; vertical-align: top;">
                        <?php //include_once 'menu.php'; ?>
                    </td>
                    <td style="width: 100%; vertical-align: top;">
                        <div style="border: 1px dashed red; font-size: 12px; border-radius: 3px;" >
                            Pending Request (2) | Recent Updates (3) | SelfService | Management | Enterprise | <?php echo session_id();?>
                        </div>
            <!-- begin of left detail content page -->
         <!-- <div id="page" class="page" style="overflow: scroll; height: 560px; /*width: 100%; float: left; margin-left: 240px; position: absolute;*/ ">
           -->   