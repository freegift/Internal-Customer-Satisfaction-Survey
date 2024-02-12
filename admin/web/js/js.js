//disable right click events on page
document.onmousedown=disableclick;
function disableclick(event)
{
  if(event.button == 2)
   { //alert("not enabled");
     return false;    
   }
}

//redirect button/url/link to page
function link_direct(link){
    window.open(link,"rightFrame");
    //window.location.href = link;
    //event.preventDefault();
}
function link_popup(link){
    window.open(link, "rightFrame", "height=200,width=150");
    
}
//redirect button/url/link to page
function link_direct_new(link){
    window.open(link,"_blank");
    //window.location.href = link;
    event.preventDefault();
}

$(function(){
//    function link_ajax(link)
//    {
//        alert(link);
//    }
    
        ///$( "#ajax-form" ).dialog( "open" );
        
        //$("#ajax-content").html(link);
    $("#btnexcel").click(function(e) { //alert('export');
//        window.open('data:application/vnd.ms-excel,' + $('#excel').html());
//        e.preventDefault();
window.print();
  return false;
    });
        
    $( ".details" )
        .button()
        .click(function() {
            var listItem = document.getElementsByClassName('details');// getElementById('bar');
            //alert('Index: ' + $('li').index(listItem));
        var id = $(this).index(listItem);   
        $.post('../home/Ajax/test.php', function(data) {
          $("#ajax-content").html(data + id);
        });
        $( "#ajax-form" ).dialog( "open" );
        //$("#ajax-content").html('this is it too you'+'too');
    });
                        
    $( "#ajax-form" ).dialog({
        autoOpen: false,
        /*height: 300,
        width: 350,*/
        modal: true,
        buttons: {
                Ok: function() {
                        $( this ).dialog( "close" );
                }
        }
    });

 });
 
//run timer function - display system time
var myVar = setInterval(function(){myTimer()},1000);
function myTimer()
{
    var d = new Date();
    var t = d.toLocaleTimeString();
    document.getElementById("timer").innerHTML=t;
}


//ajax checkbox enable/disable function
function ajax_activate_checkbox(idfield) {//,idvalue,entryfield,table){
    //var id = window.document.getElementById("sta[]").value;
    //alert('val2='+id);
    
//alert(idfield);
    //alert(idvalue);
    //alert(entryfield);
    //alert(table);
}

function pdf(link)
{
    alert('pdf');
    window.open(link,"_blank");
}


$(function(){
    
    $( document ).tooltip({track: true});
    
    $( "#menu1" ).menu();
    
    $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
        /*showOn: "button",*/
        buttonImage: "../web/images/calendar.gif",
        buttonImageOnly: true
        //inline: true
    });
    
    
    $( "#accordion" ).accordion({
	collapsible: true,
        heightStyle: "content"
    });
    
    //$( ".spinner" ).spinner();
    
    
    $( "input[type=submit], input[type=button],a.button, button" )
        .button()
        .click(function( /*event*/ ) {
                //event.preventDefault();
        });
                        
                        
   $( ".tabs" ).tabs({
        collapsible: true,
        //show: { effect: "fold", duration: 800 },
        //heightStyle: "auto"
       // event: "mouseover"
   });
   /*$("#tabs").bind("tabsselect", function(e, tab) {
        alert("The tab at index " + tab.index + " was selected");
   });*/
  
  //confirm enable action
  /*$(".enable").click(function(event){
  $( ".enable" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                    "Enable all items": function() {
                         $( this ).dialog( "close" );
                    },
                    Cancel: function() {
                        //event.preventDefault();
                        $( this ).dialog( "close" );
                    }
            }
    });
   });*/
   $(".enable").click(function(event){
       var r = confirm("ENABLE! Confirm your action?");
        if (r === true)
        {} else {
            event.preventDefault();
        }
   });
   //confirm disable action
   $(".disable").click(function(event){
       var r = confirm("DISABLE! Confirm your action?");
        if (r === true)
        {} else {
            event.preventDefault();
        }
   });
  //confirm delete action
   $(".delete").click(function(event){
       var r = confirm("DELETE! Confirm your action?");
        if (r === true)
        {} else {
            event.preventDefault();
        }
   });
   //confirm delete action
   $(".approve").click(function(event){
       var r = confirm("APPROVE! Confirm your action?");
        if (r === true)
        {} else {
            event.preventDefault();
        }
   });
   
   //hide message display
   $(".message").click(function(){
       //$(".message").fadeOut(10000);
       $(this).hide()
   });
   //hide message display
   $(".error").click(function(){
       //$(".message").fadeOut(10000);
       $(this).hide()
   });
   
  /* $(".editpage").click(function(){
       
        //alert("thank you EDIT.");
        
        var data = "section=1&page=1";
        $.ajax({
          type:"GET",
          url:"ajax-route-page.php",    
          data: data,        
          success: function (text) { 
              //window.location.href = "index.php";
              $(".page").html(text);
              //alert("thanks");
          }  
        });   
        return false;
    });*/
    
});

//-------- BEGIN TABLE CHECK BOX SELECT LISTING -----
$(function(){
     // add multiple select / deselect functionality
    $(".selectall").click(function () {
          $('.item').attr('checked', this.checked);
    });
 	
    // if all checkbox are selected, check the selectall checkbox and viceversa
    $(".item").click(function(){
        //alert($('.case').val());
        if($(".item").length == $(".item:checked").length) {
            $(".selectall").attr("checked", "checked");
        } else {
            $(".selectall").removeAttr("checked");
        }
        
        //alert(this.value)
    });
});
//-------- END TABLE CHECK BOX SELECT LISTING -----


/*function linkpage(m,p){
    //alert('this is employee page' + m + ' : '+p);
    $(function(){
        //var network = $('.network').val();
        //alert('this is employee page' + m + ' : '+p);
        var data = "section=" + m + "&page=" + p; // /'network=' + network;   
        /*
        $.get( "ajax-route-page.php", function( data ) {
            alert( "Data Loaded: " + data );
        });
        */
  /*      $.ajax({
          type:"GET",
          url:"ajax-route-page.php",    
          data: data,        
          success: function (text) { 
              //window.location.href = "index.php";
              $(".page").html(text);
              //alert("thanks");
          }  
        });   
        return false;
        
        
    });
    
}
*/

/* submit a form using Jquery/ajax */
$(function() {
    var name = $( "#name" ),
            email = $( "#email" ),
            password = $( "#password" ),
            allFields = $( [] ).add( name ).add( email ).add( password ),
            tips = $( ".validateTips" );

    function updateTips( t ) {
            tips
                    .text( t )
                    .addClass( "ui-state-highlight" );
            setTimeout(function() {
                    tips.removeClass( "ui-state-highlight", 1500 );
            }, 500 );
    }

    function checkLength( o, n, min, max ) {
            if ( o.val().length > max || o.val().length < min ) {
                    o.addClass( "ui-state-error" );
                    updateTips( "Length of " + n + " must be between " +
                            min + " and " + max + "." );
                    return false;
            } else {
                    return true;
            }
    }

    function checkRegexp( o, regexp, n ) {
            if ( !( regexp.test( o.val() ) ) ) {
                    o.addClass( "ui-state-error" );
                    updateTips( n );
                    return false;
            } else {
                    return true;
            }
    }

    $( "#dialog-form" ).dialog({
            autoOpen: false,
            height: 300,
            width: 350,
            modal: true,
            buttons: {
                    "Create an account": function() {
                            var bValid = true;
                            allFields.removeClass( "ui-state-error" );

                            bValid = bValid && checkLength( name, "username", 3, 16 );
                            bValid = bValid && checkLength( email, "email", 6, 80 );
                            bValid = bValid && checkLength( password, "password", 5, 16 );

                            bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
                            // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
                            bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
                            bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

                            if ( bValid ) {
                                    $( "#Roles tbody" ).append( "<tr>" +
                                            "<td class='td row'>" + name.val() + "</td>" + 
                                            "<td class='td row'>" + email.val() + "</td>" + 
                                            "<td class='td row'>" + password.val() + "</td>" +
                                    "</tr>" ); 
                                    $( this ).dialog( "close" );
                            }
                    },
                    Cancel: function() {
                            $( this ).dialog( "close" );
                    }
            },
            close: function() {
                    allFields.val( "" ).removeClass( "ui-state-error" );
            }
    });

    $( "#create-user" )
            .button()
            .click(function() {
                    $( "#dialog-form" ).dialog( "open" );
            });
});