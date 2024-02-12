<html>
    <head>
        <title><?php echo $mail->Subject //$email["subject"];?></title>
        <style>
            .body {font-style: normal; background-color: #ffffff; width: 640px;}
            .button1 { padding: 10px 5px !important; min-width: 200px !important; border-radius:3px; box-shadow: 0px 1px 2px #777; }
            .emenu {color: #1a206d; font-size: 1.2em; font-style: normal;}
            .table td {border: 1px solid #a8b400;}
            p { margin-bottom: 1.5em;}
            bold, label { font-weight: bold;}
        </style>
    </head>
    <body style="font-style: normal;">
        <div class="body" style=" color: black; border: 1px solid #a8b400; border-radius: 3px; margin: 0px; margin-right: 50px; padding: 15px;">
        <div style="border-radius: 3px; color: #1a206d">
            <table >
                <tr>
                    <td ><div style="font-size: 1.2em; padding-top: 10px;"><strong><?php echo $mail->Subject;?></strong></div></td>
                </tr>
            </table>
        </div>
        <br>
