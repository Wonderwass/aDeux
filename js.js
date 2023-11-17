var etape = 0;
$("#form").on("submit", function(e) {
    if(etape < 15){
        e.preventDefault();
    }
   
    etape++;
  /*  var email = $("#email").val();*/
    if(etape==1){
    $('#email').hide();
    $('#textmail').hide();
    $('#password').show();
    $('#textmdp').show();
 
 
}else if(etape==2){
    $('#password').hide();
    $('#textmdp').hide();
    $('#txtnom').show();
    $('#txtnom1').show();  
 
 
}else if(etape==3){
 
    $('#txtnom').hide();
    $('#txtnom1').hide();
    $('#txtprenom1').show();
    $('#prenom').show();
 
 
}else if(etape==4){
 
    $('#txtprenom1').hide();
    $('#prenom').hide();
    $('#txtpseudo').show();
    $('#pseudo').show();
 
 
}else if(etape==5){
 
    $('#txtpseudo').hide();
    $('#pseudo').hide();
    $('#txtage').show();
    $('#age').show();
 
 
}else if(etape==6){
 
    $('#txtage').hide();
    $('#age').hide();
    $('#sex').show();
    $('#txtsex').show();
 
 
}else if(etape==7){
 
    $('#sex').hide();
    $('#txtsex').hide();
    $('#txtpoids').show();
    $('#poids').show();
 
 
}else if(etape==8){
 
    $('#txtpoids').hide();
    $('#poids').hide();
    $('#txtyeux').show();
    $('#yeux').show();
 
 
 
}else if(etape==9){
 
    $('#txtyeux').hide();
    $('#yeux').hide();
    $('#txttaille').show();
    $('#taille').show();
 
 
 
}else if(etape==10){
 
    $('#txttaille').hide();
    $('#taille').hide();
    $('#txtcheveux').show();
    $('#cheveux').show();
 
 
 
}else if(etape==11){
    
    $('#txtcheveux').hide();
    $('#cheveux').hide();
    $('#txtorigine').show();
    $('#origine').show();
 
 
}else if(etape==12){
 
    $('#txtorigine').hide();
    $('#origine').hide();
    $('#txtville').show();
    $('#ville').show();
 
 
}else if(etape==13){
 
    $('#txtville').hide();
    $('#ville').hide();
    $('#txtrelation').show();
    $('#relation').show();
 
}else if(etape==14){
 
    $('#txtrelation').hide();
    $('#relation').hide();
    $('#txtreligion').show();
    $('#religion').show();
 
 
}else if(etape==15){
    
    $('#txtreligion').hide();
    $('#religion').hide();
    $('#txtimg').show();
    $('#photo').show();
}
    
});
 