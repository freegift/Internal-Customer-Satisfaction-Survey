<?php
$copy_map = $cControllers->GetUnitMappingCategory($_SESSION["DEFAULT"]["c_id"]);
 if(!empty($copy_map)):
?>
<form name="copy" action="" method="POST">
    <input type="hidden" value="copy_users_mapping" name="form" />
    Copy existing users-to-units mapping to default survey mapping:
    <select name="select_copy_units_mapping" class="ui-widget-content ui-corner-all">
        <option value="" selected="" >--Select--</option>
        <?php
        foreach ($copy_map as $key_c => $value_c) {
            echo '<option value="'.$value_c["c_id"].'">'.$value_c["c_name"].'</option>';
        }
        ?>
    </select>
    &nbsp;&nbsp;&nbsp;<input type="submit" value="Copy Users Mapping" name="btncopymap" />
</form>
<br>
<?php endif; ?>