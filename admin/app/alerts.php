<!DOCTYPE html>
<div class="alert">
    <?php   
        if ($cApp->ItemsInOrderCart()){
            echo "Stock Requisition Cart( " . $cApp->ItemsInOrderCart() . " )";
        }
        
        if ($cApp->ItemsInReceivableCart()){
            echo "Delivery Cart( " . $cApp->ItemsInReceivableCart() . " )";
        }
        
        if ($cApp->ItemsInRequestCart()){
            echo "User Request Cart( " . $cApp->ItemsInRequestCart() . " )";
        }
        
        $cConnect->SetDefaultSurvey();
        echo "Default Survey: ".$_SESSION["DEFAULT"]["c_name"];
    ?>
</div>