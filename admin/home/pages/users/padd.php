<!DOCTYPE html>
<form name="Add" action="" method="POST">
    <input type="hidden" value="add_user" name="form" />
<table id="add" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>User Name</label><span class="star">(FIC Number)</span><br>
            <input name="u_username" class="ui-widget-content ui-corner-all" type="text" />
        </td>
        <td class="td">
            <label>User Full Name</label><span class="star">*</span><br>
            <input name="u_fullname" class="ui-widget-content ui-corner-all" type="text" />
        </td>
        <td class="td">
            <label>Email</label><span class="star">*</span><br>
            <input name="u_email" class="ui-widget-content ui-corner-all" type="text" />
        </td>
        
    </tr>
    <tr class="tr">
        <td class="td">
            <label>Enabled</label><span class="star">*</span><br>
            <select name="u_enable" class="ui-widget-content ui-corner-all" >
                <option value="<?php echo ENABLE ;?>" selected=""><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                <option value="<?php echo DISABLE ;?>"><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
        <td class="td">
            <label>Department</label><span class="star">*</span><br>
            <select name="u_dept_id" class="ui-widget-content ui-corner-all" >
                <?php  
                //$grp = array();
                $g = $cControllers->ListAll("departments","d_c_id",$_SESSION['DEFAULT']['c_id'],"d_name");//("departments");
                foreach ($g as $k => $v) { 
                    ?>
                        <option value="<?php echo $v["d_id"] ;?>"><?php echo $v["d_name"] ;?></option>
                   <?php //} 
                }
                ?>
            </select>
        </td>
        <td class="td">
<!--            <label>Special (send to GMD alert)</label><span class="star">*</span><br>
            <select name="special" class="ui-widget-content ui-corner-all" >
                   <option value="<?php // echo ENABLE ;?>"><?php // echo $cApp->EnableStatus(ENABLE) ;?></option>
                    <option value="<?php // echo DISABLE ;?>"><?php // echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>-->
        </td>
    </tr>
</table>
<hr class="hr">
<input name="btnadd" class="" type="submit" value="Add New User" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=users";?>');" /> 

</form>
<br>
<br><br>
<p><h3>Upload Users from file (.csv) only to the default survey [ <?php echo $_SESSION['DEFAULT']['c_name'] ;?> ]</h3><hr class="hr"><p>
<form name="Users" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" value="users_upload" name="form" />
    <?php // var_dump($_SESSION['DEFAULT']['c_id']);?>
    Select file : <input type="file" class="ui-widget-content ui-corner-all" name="filename" > &nbsp;&nbsp;&nbsp;
    <input name="btnupload" class="" type="submit" value="Upload Users" /><br>
    <br>Please <strong>do not alter</strong> the headers from the upload file. <br>
    Upload format <strong>[ FullName, Email, Department Id ]</strong>. <a class="button" href="<?php echo BASE_DIR ."web/users.csv" ;?>"> Download format here</a>
</form>