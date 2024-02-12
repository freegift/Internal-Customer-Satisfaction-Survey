<?php define("APP", "External") ;?>

<?php include_once '../web/header.php';?>
<br>
<div align="center">
<div id="content" align="" class="ui-widget">

    <div class="col" style="float: left; min-width: 200px;">
        &nbsp;
    </div>
    <div class="col" style="float: left; width: 700px; vertical-align: top;border: 1px solid blue;">
        <div class="text">
            <span class="sub-title">Code of Corporate Governance</span><br>
            <span>Have you experienced or observed any unethical or unprofessional conduct on the part of any of our staff, vendors, contractors and agency?</span>
            <br><span>Your confidentiality wishes shall be fully protected.</span>
            <br><span>Help us serve you better.<br>Thank you.</span>
        </div>
        <form name="wblower" method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="form" value="wblower" />
            <?php $cApp->ShowInfo(); ?>
            <br>
            <div>
                <span class="sub-title-qty">Do you want to be anonymous?</span>
                &nbsp;&nbsp;&nbsp;&nbsp;<label for="yes">YES</label>
                <input id="yes" type="radio" name="anon" class="anon" value="Y">
                &nbsp;&nbsp;&nbsp;&nbsp;<label for="no">NO</label>
                <input id="no" type="radio" name="anon" class="anon" value="N"> 
            </div>
            <br>
            <fieldset id="anonymous" name="anonymous" hidden>
                <legend>
                    <label>
                        Please provide your personal information :
                    </label> 
                </legend>
                <dl>
                    <dt> Your Name: </dt><dd><input id="b_user_name" class="input" type="text" name="b_user_name" value=""></dd>
                    <dt> Your Phone Number: </dt><dd><input id="b_user_phone" class="input" type="text" name="b_user_phone" value=""></dd>
                    <dt> Your Email: </dt><dd><input id="b_user_email" class="input" type="text" name="b_user_email" value=""></dd>
                </dl>
            </fieldset>

            <div id="details" hidden>
                <fieldset id="content_" name="content">
                    <legend>Please provide details of whom you are reporting :</legend>
                    <dl>
                        <dt> Name of the Officer/Staff: </dt><dd><input class="input" type="text" name="b_name_of_staff" value="" /></dd>
                        <dt> Phone Number of the Officer/Staff: </dt><dd><input class="input" type="text" name="b_phone_of_staff" value="" /></dd>
                        <dt> Email of the Officer/Staff: </dt><dd><input class="input" type="text" name="b_email_of_staff" value="" /></dd>
                        <dt> Location: </dt><dd><input class="input" type="text" name="b_location_of_staff" value="" /></dd>
                        <dt> Estimated Date the Event occurred </dt><dd><input class="input datepicker" type="text" name="b_date_of_event" value="" /></dd>
                        <dt> Nature of Conduct: </dt><dd><textarea class="input" name="b_nature_of_conduct" rows="5" cols="20"></textarea></dd>
                        <dt> Any other collaborator? Please specify with names: </dt><dd><textarea class="input" name="b_collaborator" rows="5" cols="20"></textarea></dd>
                        <dt> Remarks/Comment: </dt><dd><textarea class="input" name="b_comment" rows="5" cols="20"></textarea></dd>
                        <dt> Special </dt>
                        <dd><br>
                            <div style=" min-width: 300px;">
                                <input id="g" type="radio" name="b_special" class="" value="Y" checked>
                                <label for="g">Send to GMD</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input id="a" type="radio" name="b_special" class="" value="N">
                                <label for="a">Send to Head of Audit</label>
                            </div>
                            <!--<input type="checkbox" name="b_special" value="Y" />-->                                    
                        </dd>

                    </dl>
                </fieldset>
                <div class="btnattach">
                    <span class="sub-title-qty">Do you have any evidence or supporting document(s)?</span>
                    <a class="btnattach button" name="btnReset" >Attach Document(s)</a>
                </div><br>
                <fieldset id="attachment" name="attachment" hidden>
                    <legend>Attach any evidence or supporting document(s) [ image, word, pdf ]</legend>
                    <dl>
                        <dt> Document 1: </dt><dd><input type="file" name="file[]" /></dd>
                        <dt> Document 2: </dt><dd><input type="file" name="file[]" /></dd>
                        <dt> Document 3: </dt><dd><input type="file" name="file[]" /></dd>
                        <dt> Document 4: </dt><dd><input type="file" name="file[]" /></dd>
                    </dl>
                    <a class="btnremoveattach button" name="btnReset" hidden="" >Reset / Cancel Attachment</a>

                </fieldset>

                <fieldset id="spam" name="spam">
                    <legend>To confirm this is human</legend>
                    <dl>
                        <dt> What is the value of <span class="spam_key">9 - 4 = </span></dt><dd><input type="text" name="spam_value" /></dd>
                    </dl>
                </fieldset><br>
                <div>
                    <input type="submit" value="Submit" name="btnSubmit" /> 
                    <button name="btnReset" type="reset">Reset</button>
                </div>
            </div>
        </form>
        <br><br>
    </div>
<!--    <div class="col" style="float: left; width: 200px;">
        <img src="../../admin/web/images/wblower.jpg" alt="" />
    </div>-->
    <br class="cls">
 </div>
</div>
</body>
</html>