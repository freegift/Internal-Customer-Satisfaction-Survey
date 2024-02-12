<form name="Reports" action="" method="GET">
    <input type="hidden" value="recententries" name="p" />
    <div class="form-table" style="margin-bottom: 10px;">
        <table>
            <tr>
                <td>
                    <label>Active Users</label><br>
                    <select name="users" class="ui-widget-content ui-corner-all">
                        <option value="">---Select All---</option>
                    <?php
                        $users = (isset($_GET["users"]))? $_GET["users"]:'';
                        $p_u = $cReports->ListAll("users", "u_c_id", $_SESSION["DEFAULT"]["c_id"]);
                        foreach ($p_u as $key => $value) {
                            echo "<option value='".$value["u_id"]."' ". $cApp->IsSelected($users, $value["u_id"])." >".$value["u_fullname"]."</option>";
                        }
                    ?>
                    </select>&nbsp;&nbsp;
                </td>
                <td>
                    <label>Default Questions</label><br>
                    <select name="questions" class="ui-widget-content ui-corner-all">
                        <option value="">---Select All---</option>
                    <?php
                        $questions = (isset($_GET["questions"]))? $_GET["questions"]:'';
                        $p_q = $cReports->ListAll("questions", "q_cat_id", $_SESSION["DEFAULT"]["c_id"]);
                        foreach ($p_q as $key => $value) {
                            echo "<option value='".$value["q_id"]."' ". $cApp->IsSelected($questions, $value["q_id"])." >".$value["q_name"]."</option>";
                        }
                    ?>
                    </select>&nbsp;&nbsp;
                </td>
                <td>
                    <label>User Units/Dept</label><br>
                    <select name="departments_s" class="ui-widget-content ui-corner-all">
                        <option value="">---Select All---</option>
                    <?php
                        $departments_s = (isset($_GET["departments_s"]))? $_GET["departments_s"]:'';
                        $p_d_s = $cReports->ListAll("departments","d_c_id",$_SESSION['DEFAULT']['c_id'],"d_name");//("departments");
                        foreach ($p_d_s as $key => $value) {
                            echo "<option value='".$value["d_id"]."' ". $cApp->IsSelected($departments_s, $value["d_id"])." >".$value["d_name"]."</option>";
                        }
                    ?>
                    </select>&nbsp;&nbsp;
                </td>
                <td>
                    <label>Target Unit/Dept</label><br>
                    <select name="departments_t" class="ui-widget-content ui-corner-all">
                        <option value="">---Select All---</option>
                    <?php
                        $departments_t = (isset($_GET["departments_t"]))? $_GET["departments_t"]:'';
                        $p_d_t = $p_d_s;// $cReports->ListAll("departments");
                        foreach ($p_d_t as $key => $value) {
                            echo "<option value='".$value["d_id"]."' ". $cApp->IsSelected($departments_t, $value["d_id"])." >".$value["d_name"]."</option>";
                        }
                    ?>
                    </select>&nbsp;&nbsp;
                </td>
            </tr>
        </table><br>
        &nbsp;&nbsp;<input name="btnsearch" class="" type="submit" value="Run Search" /><!-- | <a href="https://pdfcrowd.com/url_to_pdf/?pdf_name=report.pdf">Save to PDF</a>-->
        &nbsp;&nbsp;&nbsp;&nbsp;Total Submitted Survey Entries : ( <strong><?php echo $cReports->TotalDefaultEntries($_SESSION["DEFAULT"]["c_id"]) ;?></strong> )
        &nbsp;&nbsp;&nbsp;&nbsp;Total Search Result Entries : ( <strong><?php echo count($record) ;?></strong> )
        <?php if($cReports->HasData()){ ?>
        &nbsp;&nbsp;&nbsp;&nbsp;<input name="btndownload" class="edit" type="button" value="Export to CSV" onclick="link_direct('<?php echo BASE_DIR."app/download.php?p=download&type=recententries";?>');" />
        <?php } ?>
        <hr class="hr"/>
    </div>
</form>