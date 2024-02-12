<?php
//$record = array();
$record = $cControllers->ListOne("users", "u_id", $id);
if (!empty($record)){
    foreach ($record as $key => $value) {
     ?>     
<form name="edit" action="" method="POST">
    <input type="hidden" value="save_user" name="form" />
<table id="Users" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>User Name</label><span class="star">(same as email)</span><br>
            <input name="u_username" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["u_username"];?>" />            
        </td>
        <td class="td">
            <label>User Full Name</label><span class="star">*</span><br>
            <input name="u_fullname" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["u_fullname"];?>" />            
        </td>
        <td class="td">
            <label>User Email</label><span class="star">*</span><br>
            <input name="u_email" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["u_email"];?>" />            
        </td>
    </tr>
    <tr class="tr">
        <td class="td">
            <label>Enable</label><span class="star">*</span><br>
            <select name="u_enable" class="ui-widget-content ui-corner-all" >
                  <option value="<?php echo ENABLE ;?>" <?php echo $cApp->IsSelected(ENABLE, $value["u_enable"]);?>><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                  <option value="<?php echo DISABLE ;?>" <?php echo $cApp->IsSelected(DISABLE, $value["u_enable"]);?>><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
        <td class="td">
            <label>Department</label><span class="star">*</span><br>
            <select name="u_dept_id" class="ui-widget-content ui-corner-all" >
                <?php  
                $dept = array();
                $dept = $cControllers->ListAll("departments","d_c_id",$_SESSION['DEFAULT']['c_id'],"d_name");//("departments");
                foreach ($dept as $k => $v) { ?>
                    <option value="<?php echo $v["d_id"] ;?>" <?php echo $cApp->IsSelected($v["d_id"], $value["u_dept_id"]);?>><?php echo $v["d_name"] ;?></option>
               <?php } ?>
            </select>
        </td>
        <td class="td"></tr>
</table>
<hr class="hr"><input name="id" class="name" type="hidden" value="<?php echo $id;?>" />
<input name="btnsave" class="" type="submit" value="Save User" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=users";?>');" /> 

</form><br>
<?php
    }
}
?>