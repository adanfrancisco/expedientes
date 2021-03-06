<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>MESA</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="popup/bundled.css">
    <script src="popup/bundled.js"></script>
    <link rel="stylesheet" type="text/css" href="popup/jquery-confirm.css"/>     
    <script type="text/javascript"  src="popup/jquery-confirm.js"></script>

            
        <script type="text/javascript">
           $(document).ready(function(e) {  
               $("#inicial").hide();
               $("#primaria").hide();
               $("#secundarias").hide();
               $("#agrarias").hide();
               $("#superiors").hide();
               $("#tecnicas").hide();
               $("#especials").hide();
               $("#modalidades").hide();
               $("#carrga").hide();
               $("#otrox").hide();
              
               
           // Cuando le dás click muestra #content
                $('.inicio').click(function(){
                    $(".primaria").toggleClass("hide"); 
                    $(".secundaria").toggleClass("hide");
                    $(".agraria").toggleClass("hide");
                    $(".tecnica").toggleClass("hide"); 
                    $(".especial").toggleClass("hide");   
                    $(".artistica").toggleClass("hide"); 
                    $(".adultos").toggleClass("hide"); 
                    $(".fisica").toggleClass("hide"); 
                    $(".psicologia").toggleClass("hide"); 
                    $(".superior").toggleClass("hide"); 
                    $(".modalidades").toggleClass("hide"); 
                    if( $("#inicial").is(":visible") ){
                        $("#inicial").hide();
                        $("#otrox").hide();
                    }else{
                        $("#inicial").show();
                    }
                });
/////////JARDINES ///////
                $('.901').click(function(){
                    $servicio='0099JI0901';
                    console.log($servicio);
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                });
                $('.902').click(function(){
                    $servicio='0099JI0902';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                });
                $('.903').click(function(){
                    $servicio='0099JI0903';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                });
                $('.904').click(function(){
                    $servicio='0099JI0904';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                });                
                $('.905').click(function(){
                    $servicio='0099JI0905';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                });                
                $('.906').click(function(){
                    $servicio='0099JI0906';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                });                
                $('.907').click(function(){
                    $servicio='0099JI0907';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                }); 
                $('.908').click(function(){
                    $servicio='0099JI0908';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                }); 
                $('.909').click(function(){
                    $servicio='0099JI0909';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                }); 
                $('.910').click(function(){
                    $servicio='0099JI0910';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                }); 
                $('.911').click(function(){
                    $servicio='0099JI0911';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                }); 
                $('.912').click(function(){
                    $servicio='0099JI0912';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                }); 
                $('.913').click(function(){
                    $servicio='0099JI0913';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                });
                $('.914').click(function(){
                    $servicio='0099JI0914';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                });
                $('.915').click(function(){
                    $servicio='0099JI0914';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                });
                $('.JIRIM1').click(function(){
                    $servicio='0099JS0001';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                });
                $('.JIRIM2').click(function(){
                    $servicio='0099JS0002';
                    console.log($servicio);
                    
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM3").toggleClass("hide"); 
                });
                $('.JIRIM3').click(function(){
                    $servicio='0099JS0003';
                    console.log($servicio);
                    $(".901").toggleClass("hide"); 
                    $(".902").toggleClass("hide"); 
                    $(".903").toggleClass("hide"); 
                    $(".904").toggleClass("hide"); 
                    $(".905").toggleClass("hide"); 
                    $(".906").toggleClass("hide"); 
                    $(".907").toggleClass("hide"); 
                    $(".908").toggleClass("hide"); 
                    $(".909").toggleClass("hide"); 
                    $(".910").toggleClass("hide"); 
                    $(".911").toggleClass("hide"); 
                    $(".912").toggleClass("hide"); 
                    $(".913").toggleClass("hide"); 
                    $(".914").toggleClass("hide"); 
                    $(".915").toggleClass("hide"); 
                    $(".JIRIM1").toggleClass("hide"); 
                    $(".JIRIM2").toggleClass("hide"); 
                });

                $('.primaria').click(function(){
                    $servicio='0099JS0003';
                    console.log($servicio);
                    $(".inicio").toggleClass("hide"); 
                    $(".secundaria").toggleClass("hide");
                    $(".agraria").toggleClass("hide");
                    $(".tecnica").toggleClass("hide"); 
                    $(".especial").toggleClass("hide");   
                    $(".artistica").toggleClass("hide"); 
                    $(".adultos").toggleClass("hide"); 
                    $(".fisica").toggleClass("hide"); 
                    $(".psicologia").toggleClass("hide"); 
                    $(".superior").toggleClass("hide"); 
                    $(".modalidades").toggleClass("hide");
                    if( $("#primaria").is(":visible") ){
                        $("#primaria").hide();
                        $("#otrox").hide();
                    }else{
                        $("#primaria").show();
                    }
                });
/////////PRIMARIAS ///////
                $('.EP1').click(function(){
                    $servicio='0099PP0001';
                    console.log($servicio);
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP3').click(function(){
                    $servicio='0099PP0003';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP4').click(function(){
                    $servicio='0099PP0004';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP5').click(function(){
                    $servicio='0099PP0005';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP6').click(function(){
                    $servicio='0099PP0006';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP7').click(function(){
                    $servicio='0099PP0007';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP8').click(function(){
                    $servicio='0099PP0008';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP9').click(function(){
                    $servicio='0099PP0009';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });

                $('.EP10').click(function(){
                    $servicio='0099PP0010';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP11').click(function(){
                    $servicio='0099PP0011';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP12').click(function(){
                    $servicio='0099PP0012';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP15').click(function(){
                    $servicio='0099PP0015';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP16').click(function(){
                    $servicio='0099PP0016';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP22').click(function(){
                    $servicio='0099PP0022';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP23').click(function(){
                    $servicio='0099PP0023';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP25').click(function(){
                    $servicio='0099PP0025';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP26').click(function(){
                    $servicio='0099PP0026';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP27').click(function(){
                    $servicio='0099PP0027';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });

                $('.EP28').click(function(){
                    $servicio='0099PP0028';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP29").toggleClass("hide"); 
                });
                $('.EP29').click(function(){
                    $servicio='0099PP0029';
                    console.log($servicio);
                    $(".EP1").toggleClass("hide"); 
                    $(".EP3").toggleClass("hide"); 
                    $(".EP4").toggleClass("hide"); 
                    $(".EP5").toggleClass("hide"); 
                    $(".EP6").toggleClass("hide"); 
                    $(".EP7").toggleClass("hide"); 
                    $(".EP8").toggleClass("hide"); 
                    $(".EP9").toggleClass("hide"); 
                    $(".EP10").toggleClass("hide"); 
                    $(".EP11").toggleClass("hide"); 
                    $(".EP12").toggleClass("hide"); 
                    $(".EP15").toggleClass("hide"); 
                    $(".EP16").toggleClass("hide"); 
                    $(".EP22").toggleClass("hide"); 
                    $(".EP23").toggleClass("hide"); 
                    $(".EP25").toggleClass("hide"); 
                    $(".EP26").toggleClass("hide"); 
                    $(".EP27").toggleClass("hide"); 
                    $(".EP28").toggleClass("hide"); 
                });

                $('.secundaria').click(function(){
                    $(".inicio").toggleClass("hide"); 
                    $(".primaria").toggleClass("hide");
                    $(".agraria").toggleClass("hide");
                    $(".tecnica").toggleClass("hide"); 
                    $(".especial").toggleClass("hide");   
                    $(".artistica").toggleClass("hide"); 
                    $(".adultos").toggleClass("hide"); 
                    $(".fisica").toggleClass("hide"); 
                    $(".psicologia").toggleClass("hide"); 
                    $(".modalidades").toggleClass("hide");
                    $(".superior").toggleClass("hide"); 
                    if( $("#secundarias").is(":visible") ){
                        $("#secundarias").hide();
                        $("#otrox").hide();
                    }else{
                        $("#secundarias").show();
                    }
                });
/////////SECUNDARIAS ///////
                $('.EES2').click(function(){
                    $servicio='0099MS0002';
                    console.log($servicio);
                    console.log($servicio);
                        $(".EES4").toggleClass("hide"); 
                        $(".EES5").toggleClass("hide");
                        $(".EES5-A").toggleClass("hide");
                        $(".EES6").toggleClass("hide"); 
                        $(".EES7").toggleClass("hide");   
                        $(".EES8").toggleClass("hide"); 
                        $(".EES9").toggleClass("hide"); 
                        $(".EES9-A").toggleClass("hide"); 
                        $(".EES10").toggleClass("hide"); 
                        $(".EES10-A").toggleClass("hide");
                        $(".EES11").toggleClass("hide"); 
                        $(".EES12").toggleClass("hide");
                        $(".EES13").toggleClass("hide");
                         })
                $('.EES4').click(function(){
                    $servicio='0099MS0004';

                    console.log($servicio);
                        $(".EES2").toggleClass("hide"); 
                        $(".EES5").toggleClass("hide");
                        $(".EES5-A").toggleClass("hide");
                        $(".EES6").toggleClass("hide"); 
                        $(".EES7").toggleClass("hide");   
                        $(".EES8").toggleClass("hide"); 
                        $(".EES9").toggleClass("hide"); 
                        $(".EES9-A").toggleClass("hide"); 
                        $(".EES10").toggleClass("hide"); 
                        $(".EES10-A").toggleClass("hide");
                        $(".EES11").toggleClass("hide"); 
                        $(".EES12").toggleClass("hide");
                        $(".EES13").toggleClass("hide");
                         })
                $('.EES5').click(function(){
                    $servicio='0099MS0005';
                    console.log($servicio);
                        $(".EES2").toggleClass("hide"); 
                        $(".EES4").toggleClass("hide");
                        $(".EES5-A").toggleClass("hide");
                        $(".EES6").toggleClass("hide"); 
                        $(".EES7").toggleClass("hide");   
                        $(".EES8").toggleClass("hide"); 
                        $(".EES9").toggleClass("hide"); 
                        $(".EES9-A").toggleClass("hide"); 
                        $(".EES10").toggleClass("hide"); 
                        $(".EES10-A").toggleClass("hide");
                        $(".EES11").toggleClass("hide"); 
                        $(".EES12").toggleClass("hide");
                        $(".EES13").toggleClass("hide");
                         })
                $('.EES5-A').click(function(){
                    $servicio='0099MS3051';
                    console.log($servicio);
                        $(".EES2").toggleClass("hide"); 
                        $(".EES4").toggleClass("hide");
                        $(".EES5").toggleClass("hide");
                        $(".EES6").toggleClass("hide"); 
                        $(".EES7").toggleClass("hide");   
                        $(".EES8").toggleClass("hide"); 
                        $(".EES9").toggleClass("hide"); 
                        $(".EES9-A").toggleClass("hide"); 
                        $(".EES10").toggleClass("hide"); 
                        $(".EES10-A").toggleClass("hide");
                        $(".EES11").toggleClass("hide"); 
                        $(".EES12").toggleClass("hide");
                        $(".EES13").toggleClass("hide");
                         })
                    $('.EES6').click(function(){
                        $servicio='0099MS0006';
                        console.log($servicio);
                        $(".EES2").toggleClass("hide"); 
                        $(".EES4").toggleClass("hide");
                        $(".EES5").toggleClass("hide");
                        $(".EES5-A").toggleClass("hide"); 
                        $(".EES7").toggleClass("hide");   
                        $(".EES8").toggleClass("hide"); 
                        $(".EES9").toggleClass("hide"); 
                        $(".EES9-A").toggleClass("hide"); 
                        $(".EES10").toggleClass("hide"); 
                        $(".EES10-A").toggleClass("hide");
                        $(".EES11").toggleClass("hide"); 
                        $(".EES12").toggleClass("hide");
                        $(".EES13").toggleClass("hide");
                         })
                $('.EES7').click(function(){
                    $servicio='0099MS0007';
                    console.log($servicio);
                        $(".EES2").toggleClass("hide"); 
                        $(".EES4").toggleClass("hide");
                        $(".EES5").toggleClass("hide");
                        $(".EES5-A").toggleClass("hide"); 
                        $(".EES6").toggleClass("hide");   
                        $(".EES8").toggleClass("hide"); 
                        $(".EES9").toggleClass("hide"); 
                        $(".EES9-A").toggleClass("hide"); 
                        $(".EES10").toggleClass("hide"); 
                        $(".EES10-A").toggleClass("hide");
                        $(".EES11").toggleClass("hide"); 
                        $(".EES12").toggleClass("hide");
                        $(".EES13").toggleClass("hide");
                         })
                $('.EES8').click(function(){
                    $servicio='0099MS0008';
                    console.log($servicio);
                        $(".EES2").toggleClass("hide"); 
                        $(".EES4").toggleClass("hide");
                        $(".EES5").toggleClass("hide");
                        $(".EES5-A").toggleClass("hide"); 
                        $(".EES6").toggleClass("hide");   
                        $(".EES7").toggleClass("hide"); 
                        $(".EES9").toggleClass("hide"); 
                        $(".EES9-A").toggleClass("hide"); 
                        $(".EES10").toggleClass("hide"); 
                        $(".EES10-A").toggleClass("hide");
                        $(".EES11").toggleClass("hide"); 
                        $(".EES12").toggleClass("hide");
                        $(".EES13").toggleClass("hide");
                         })
                $('.EES9').click(function(){
                    $servicio='0099MS0009';
                    console.log($servicio);
                        $(".EES2").toggleClass("hide"); 
                        $(".EES4").toggleClass("hide");
                        $(".EES5").toggleClass("hide");
                        $(".EES5-A").toggleClass("hide"); 
                        $(".EES6").toggleClass("hide");   
                        $(".EES7").toggleClass("hide"); 
                        $(".EES8").toggleClass("hide"); 
                        $(".EES9-A").toggleClass("hide"); 
                        $(".EES10").toggleClass("hide"); 
                        $(".EES10-A").toggleClass("hide");
                        $(".EES11").toggleClass("hide"); 
                        $(".EES12").toggleClass("hide");
                        $(".EES13").toggleClass("hide");
                         })
                $('.EES9-A').click(function(){
                    $servicio='099MS3091';
                    console.log($servicio);
                        $(".EES2").toggleClass("hide"); 
                        $(".EES4").toggleClass("hide");
                        $(".EES5").toggleClass("hide");
                        $(".EES5-A").toggleClass("hide"); 
                        $(".EES6").toggleClass("hide");   
                        $(".EES7").toggleClass("hide"); 
                        $(".EES8").toggleClass("hide"); 
                        $(".EES9").toggleClass("hide"); 
                        $(".EES10").toggleClass("hide"); 
                        $(".EES10-A").toggleClass("hide");
                        $(".EES11").toggleClass("hide"); 
                        $(".EES12").toggleClass("hide");
                        $(".EES13").toggleClass("hide");
                         })
                $('.EES10').click(function(){
                    $servicio='0099MS0010';
                    console.log($servicio);
                        $(".EES2").toggleClass("hide"); 
                        $(".EES4").toggleClass("hide");
                        $(".EES5").toggleClass("hide");
                        $(".EES5-A").toggleClass("hide"); 
                        $(".EES6").toggleClass("hide");   
                        $(".EES7").toggleClass("hide"); 
                        $(".EES8").toggleClass("hide"); 
                        $(".EES9").toggleClass("hide"); 
                        $(".EES9-A").toggleClass("hide"); 
                        $(".EES10-A").toggleClass("hide");
                        $(".EES11").toggleClass("hide"); 
                        $(".EES12").toggleClass("hide");
                        $(".EES13").toggleClass("hide");
                         })
                $('.EES10-A').click(function(){
                    $servicio='0099MS3101';
                    console.log($servicio);
                        $(".EES2").toggleClass("hide"); 
                        $(".EES4").toggleClass("hide");
                        $(".EES5").toggleClass("hide");
                        $(".EES5-A").toggleClass("hide"); 
                        $(".EES6").toggleClass("hide");   
                        $(".EES7").toggleClass("hide"); 
                        $(".EES8").toggleClass("hide"); 
                        $(".EES9").toggleClass("hide"); 
                        $(".EES9-A").toggleClass("hide"); 
                        $(".EES10").toggleClass("hide");
                        $(".EES11").toggleClass("hide"); 
                        $(".EES12").toggleClass("hide");
                        $(".EES13").toggleClass("hide");
                         })
                $('.EES11').click(function(){
                    $servicio='0099MS0011';
                    console.log($servicio);
                        $(".EES2").toggleClass("hide"); 
                        $(".EES4").toggleClass("hide");
                        $(".EES5").toggleClass("hide");
                        $(".EES5-A").toggleClass("hide"); 
                        $(".EES6").toggleClass("hide");   
                        $(".EES7").toggleClass("hide"); 
                        $(".EES8").toggleClass("hide"); 
                        $(".EES9").toggleClass("hide"); 
                        $(".EES9-A").toggleClass("hide"); 
                        $(".EES10").toggleClass("hide");
                        $(".EES10-A").toggleClass("hide"); 
                        $(".EES12").toggleClass("hide");
                        $(".EES13").toggleClass("hide");
                         })
                $('.EES12').click(function(){
                    $servicio='0099MS0012';
                    console.log($servicio);
                        $(".EES2").toggleClass("hide"); 
                        $(".EES4").toggleClass("hide");
                        $(".EES5").toggleClass("hide");
                        $(".EES5-A").toggleClass("hide"); 
                        $(".EES6").toggleClass("hide");   
                        $(".EES7").toggleClass("hide"); 
                        $(".EES8").toggleClass("hide"); 
                        $(".EES9").toggleClass("hide"); 
                        $(".EES9-A").toggleClass("hide"); 
                        $(".EES10").toggleClass("hide");
                        $(".EES10-A").toggleClass("hide"); 
                        $(".EES11").toggleClass("hide");
                        $(".EES13").toggleClass("hide");
                         })
                $('.EES13').click(function(){
                    $servicio='0099MS0013';
                    console.log($servicio);
                        $(".EES2").toggleClass("hide"); 
                        $(".EES4").toggleClass("hide");
                        $(".EES5").toggleClass("hide");
                        $(".EES5-A").toggleClass("hide"); 
                        $(".EES6").toggleClass("hide");   
                        $(".EES7").toggleClass("hide"); 
                        $(".EES8").toggleClass("hide"); 
                        $(".EES9").toggleClass("hide"); 
                        $(".EES9-A").toggleClass("hide"); 
                        $(".EES10").toggleClass("hide");
                        $(".EES10-A").toggleClass("hide"); 
                        $(".EES11").toggleClass("hide");
                        $(".EES12").toggleClass("hide");
                         })

 /////////AGRARIA ///////
                $('.agraria').click(function(){
                    $servicio='0099MA0001';
                    console.log($servicio);
                    $(".inicio").toggleClass("hide"); 
                    $(".primaria").toggleClass("hide");
                    $(".secundaria").toggleClass("hide");
                    $(".tecnica").toggleClass("hide"); 
                    $(".especial").toggleClass("hide");   
                    $(".artistica").toggleClass("hide"); 
                    $(".adultos").toggleClass("hide"); 
                    $(".fisica").toggleClass("hide"); 
                    $(".psicologia").toggleClass("hide"); 
                    $(".modalidades").toggleClass("hide");
                    $(".superior").toggleClass("hide"); 
                    if( $("#agrarias").is(":visible") ){
                        $("#agrarias").hide();
                        $("#otrox").hide();
                    }else{
                        $("#agrarias").show();
                    }
                });
/////////TECNICA ///////
                $('.tecnica').click(function(){
                    $servicio='0099MT0002';
                    console.log($servicio);
                    $(".inicio").toggleClass("hide"); 
                    $(".primaria").toggleClass("hide");
                    $(".secundaria").toggleClass("hide");
                    $(".agraria").toggleClass("hide"); 
                    $(".especial").toggleClass("hide");   
                    $(".artistica").toggleClass("hide"); 
                    $(".adultos").toggleClass("hide"); 
                    $(".fisica").toggleClass("hide"); 
                    $(".psicologia").toggleClass("hide"); 
                    $(".modalidades").toggleClass("hide");
                    $(".superior").toggleClass("hide"); 
                    if( $("#tecnicas").is(":visible") ){
                        $("#tecnicas").hide();
                        $("#otrox").hide();
                    }else{
                        $("#tecnicas").show();
                    }
                }); 
/////////SUPERIOR ///////                  
                $('.ISFD99').click(function(){
                    $servicio='0099IS0099';
                    console.log($servicio);
                    $(".ISFDyT93").toggleClass("hide"); 
                })
                $('.ISFDyT93').click(function(){
                    $servicio='0099IS0093';
                    console.log($servicio);
                    $(".ISFD99").toggleClass("hide"); 
                })

                $('.superior').click(function(){
                    $(".inicio").toggleClass("hide"); 
                    $(".primaria").toggleClass("hide");
                    $(".secundaria").toggleClass("hide");
                    $(".agraria").toggleClass("hide"); 
                    $(".tecnica").toggleClass("hide");   
                    $(".especial").toggleClass("hide"); 
                    $(".artistica").toggleClass("hide"); 
                    $(".adultos").toggleClass("hide"); 
                    $(".fisica").toggleClass("hide"); 
                    $(".modalidades").toggleClass("hide");
                    $(".psicologia").toggleClass("hide"); 
                    if( $("#superiors").is(":visible") ){
                        $("#superiors").hide();
                        $("#otrox").hide();
                    }else{
                        $("#superiors").show();
                    }
                });

      /////////SUPERIOR ///////            
                $('.modalidades').click(function(){
                    $(".primaria").toggleClass("hide"); 
                    $(".secundaria").toggleClass("hide");
                    $(".agraria").toggleClass("hide");
                    $(".tecnica").toggleClass("hide"); 
                    $(".especial").toggleClass("hide");   
                    $(".artistica").toggleClass("hide"); 
                    $(".adultos").toggleClass("hide"); 
                    $(".fisica").toggleClass("hide"); 
                    $(".psicologia").toggleClass("hide"); 
                    $(".superior").toggleClass("hide"); 
                    $(".inicio").toggleClass("hide"); 
                    if( $("#modalidades").is(":visible") ){
                        $("#modalidades").hide();
                        $("#otrox").hide();
                    }else{
                        $("#modalidades").show();
                    }
                }); 
                $('.EEE501').click(function(){
                    $servicio='0099EE0501';
                    console.log($servicio);
                    $(".EEEA1").toggleClass("hide"); 
                    $(".EEPA-701").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA702").toggleClass("hide"); 
                    $(".CEA703").toggleClass("hide"); 
                    $(".CEA704").toggleClass("hide"); 
                    $(".CENS451").toggleClass("hide"); 
                    $(".CENS452").toggleClass("hide"); 
                    $(".CENS453").toggleClass("hide"); 
                    $(".CEF93").toggleClass("hide"); 
                    $(".CFP401").toggleClass("hide"); 
                    $(".CIIE200").toggleClass("hide");   
                    $(".PSICO").toggleClass("hide"); 
                    $(".OTRO").toggleClass("hide");
                })
                $('.EEEA1').click(function(){
                    $servicio='0099AE0001';
                    console.log($servicio);
                    $(".EEE501").toggleClass("hide"); 
                    $(".EEPA-701").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA702").toggleClass("hide"); 
                    $(".CEA703").toggleClass("hide"); 
                    $(".CEA704").toggleClass("hide"); 
                    $(".CENS451").toggleClass("hide"); 
                    $(".CENS452").toggleClass("hide"); 
                    $(".CENS453").toggleClass("hide"); 
                    $(".CEF93").toggleClass("hide"); 
                    $(".CFP401").toggleClass("hide"); 
                    $(".CIIE200").toggleClass("hide");   
                    $(".PSICO").toggleClass("hide"); 
                    $(".OTRO").toggleClass("hide");
                })
                $('.EEPA-701').click(function(){
                    $servicio='0099DE0701';
                    console.log($servicio);
                    $(".EEE501").toggleClass("hide"); 
                    $(".EEEA1").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA702").toggleClass("hide"); 
                    $(".CEA703").toggleClass("hide"); 
                    $(".CEA704").toggleClass("hide"); 
                    $(".CENS451").toggleClass("hide"); 
                    $(".CENS452").toggleClass("hide"); 
                    $(".CENS453").toggleClass("hide"); 
                    $(".CEF93").toggleClass("hide"); 
                    $(".CFP401").toggleClass("hide"); 
                    $(".CIIE200").toggleClass("hide");   
                    $(".PSICO").toggleClass("hide"); 
                    $(".OTRO").toggleClass("hide");
                })

                $('.CEA702').click(function(){
                    $servicio='0099DC0702';
                    console.log($servicio);
                    $(".EEE501").toggleClass("hide"); 
                    $(".EEEA1").toggleClass("hide"); 
                    $(".EEPA-701").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA703").toggleClass("hide"); 
                    $(".CEA704").toggleClass("hide"); 
                    $(".CENS451").toggleClass("hide"); 
                    $(".CENS452").toggleClass("hide"); 
                    $(".CENS453").toggleClass("hide"); 
                    $(".CEF93").toggleClass("hide"); 
                    $(".CFP401").toggleClass("hide"); 
                    $(".CIIE200").toggleClass("hide");   
                    $(".PSICO").toggleClass("hide"); 
                    $(".OTRO").toggleClass("hide");
                })
                $('.CEA703').click(function(){
                    $servicio='0099DC0703';
                    console.log($servicio);
                    $(".EEE501").toggleClass("hide"); 
                    $(".EEEA1").toggleClass("hide"); 
                    $(".EEPA-701").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA702").toggleClass("hide"); 
                    $(".CEA704").toggleClass("hide"); 
                    $(".CENS451").toggleClass("hide"); 
                    $(".CENS452").toggleClass("hide"); 
                    $(".CENS453").toggleClass("hide"); 
                    $(".CEF93").toggleClass("hide"); 
                    $(".CFP401").toggleClass("hide"); 
                    $(".CIIE200").toggleClass("hide");   
                    $(".PSICO").toggleClass("hide"); 
                    $(".OTRO").toggleClass("hide");
                })
                $('.CEA704').click(function(){
                    $servicio='0099DC0704';
                    console.log($servicio);
                    $(".EEE501").toggleClass("hide"); 
                    $(".EEEA1").toggleClass("hide"); 
                    $(".EEPA-701").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA702").toggleClass("hide"); 
                    $(".CEA703").toggleClass("hide"); 
                    $(".CENS451").toggleClass("hide"); 
                    $(".CENS452").toggleClass("hide"); 
                    $(".CENS453").toggleClass("hide"); 
                    $(".CEF93").toggleClass("hide"); 
                    $(".CFP401").toggleClass("hide"); 
                    $(".CIIE200").toggleClass("hide");   
                    $(".PSICO").toggleClass("hide"); 
                    $(".OTRO").toggleClass("hide");
                })
                $('.CENS451').click(function(){
                    $servicio='0099DM0451';
                    console.log($servicio);
                    $(".EEE501").toggleClass("hide"); 
                    $(".EEEA1").toggleClass("hide"); 
                    $(".EEPA-701").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA702").toggleClass("hide"); 
                    $(".CEA703").toggleClass("hide"); 
                    $(".CEA704").toggleClass("hide"); 
                    $(".CENS452").toggleClass("hide"); 
                    $(".CENS453").toggleClass("hide"); 
                    $(".CEF93").toggleClass("hide"); 
                    $(".CFP401").toggleClass("hide"); 
                    $(".CIIE200").toggleClass("hide");   
                    $(".PSICO").toggleClass("hide"); 
                    $(".OTRO").toggleClass("hide");
                })
                $('.CENS452').click(function(){
                    $servicio='0099DM0452';
                    console.log($servicio);
                    $(".EEE501").toggleClass("hide"); 
                    $(".EEEA1").toggleClass("hide"); 
                    $(".EEPA-701").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA702").toggleClass("hide"); 
                    $(".CEA703").toggleClass("hide"); 
                    $(".CEA704").toggleClass("hide"); 
                    $(".CENS451").toggleClass("hide"); 
                    $(".CENS453").toggleClass("hide"); 
                    $(".CEF93").toggleClass("hide"); 
                    $(".CFP401").toggleClass("hide"); 
                    $(".CIIE200").toggleClass("hide");
                    $(".PSICO").toggleClass("hide"); 
                    $(".OTRO").toggleClass("hide");
                })
                $('.CENS453').click(function(){
                    $servicio='0099DM0453';
                    console.log($servicio);
                    $(".EEE501").toggleClass("hide"); 
                    $(".EEEA1").toggleClass("hide"); 
                    $(".EEPA-701").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA702").toggleClass("hide"); 
                    $(".CEA703").toggleClass("hide"); 
                    $(".CEA704").toggleClass("hide"); 
                    $(".CENS451").toggleClass("hide"); 
                    $(".CENS452").toggleClass("hide"); 
                    $(".CEF93").toggleClass("hide"); 
                    $(".CFP401").toggleClass("hide"); 
                    $(".CIIE200").toggleClass("hide");   
                    $(".PSICO").toggleClass("hide"); 
                    $(".OTRO").toggleClass("hide");
                })
                $('.CEF93').click(function(){
                    $servicio='0099FC0093';
                    console.log($servicio);
                    $(".EEE501").toggleClass("hide"); 
                    $(".EEEA1").toggleClass("hide"); 
                    $(".EEPA-701").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA702").toggleClass("hide"); 
                    $(".CEA703").toggleClass("hide"); 
                    $(".CEA704").toggleClass("hide"); 
                    $(".CENS451").toggleClass("hide"); 
                    $(".CENS452").toggleClass("hide"); 
                    $(".CENS453").toggleClass("hide"); 
                    $(".CFP401").toggleClass("hide"); 
                    $(".CIIE200").toggleClass("hide");   
                    $(".PSICO").toggleClass("hide"); 
                    $(".OTRO").toggleClass("hide");
                })
                $('.CFP401').click(function(){
                    $servicio='0099DF0401';
                    console.log($servicio);
                    $(".EEE501").toggleClass("hide"); 
                    $(".EEEA1").toggleClass("hide"); 
                    $(".EEPA-701").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA702").toggleClass("hide"); 
                    $(".CEA703").toggleClass("hide"); 
                    $(".CEA704").toggleClass("hide"); 
                    $(".CENS451").toggleClass("hide"); 
                    $(".CENS452").toggleClass("hide"); 
                    $(".CENS453").toggleClass("hide"); 
                    $(".CEF93").toggleClass("hide"); 
                    $(".CIIE200").toggleClass("hide");   
                    $(".PSICO").toggleClass("hide"); 
                    $(".OTRO").toggleClass("hide");
                })
                $('.CIIE200').click(function(){
                    $servicio='0099IC0200';
                    console.log($servicio);
                    $(".EEE501").toggleClass("hide"); 
                    $(".EEEA1").toggleClass("hide"); 
                    $(".EEPA-701").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA702").toggleClass("hide"); 
                    $(".CEA703").toggleClass("hide"); 
                    $(".CEA704").toggleClass("hide"); 
                    $(".CENS451").toggleClass("hide"); 
                    $(".CENS452").toggleClass("hide"); 
                    $(".CENS453").toggleClass("hide"); 
                    $(".CEF93").toggleClass("hide"); 
                    $(".CFP401").toggleClass("hide");   
                    $(".PSICO").toggleClass("hide"); 
                    $(".OTRO").toggleClass("hide");
                })
                    $('.PSICO').click(function(){
                    $servicio='1000000000';
                    console.log($servicio);
                    $(".EEE501").toggleClass("hide"); 
                    $(".EEEA1").toggleClass("hide"); 
                    $(".EEPA-701").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA702").toggleClass("hide"); 
                    $(".CEA703").toggleClass("hide"); 
                    $(".CEA704").toggleClass("hide"); 
                    $(".CENS451").toggleClass("hide"); 
                    $(".CENS452").toggleClass("hide"); 
                    $(".CENS453").toggleClass("hide"); 
                    $(".CEF93").toggleClass("hide"); 
                    $(".CFP401").toggleClass("hide");   
                    $(".CIIE200").toggleClass("hide"); 
                    $(".OTRO").toggleClass("hide");
                })
                $('.OTRO').click(function(){
                    $servicio='9999OO9999';
                    console.log($servicio);
                    $(".EEE501").toggleClass("hide"); 
                    $(".EEEA1").toggleClass("hide"); 
                    $(".EEPA-701").toggleClass("hide"); 
                    $(".CEA701").toggleClass("hide"); 
                    $(".CEA702").toggleClass("hide"); 
                    $(".CEA703").toggleClass("hide"); 
                    $(".CEA704").toggleClass("hide"); 
                    $(".CENS451").toggleClass("hide"); 
                    $(".CENS452").toggleClass("hide"); 
                    $(".CENS453").toggleClass("hide"); 
                    $(".CEF93").toggleClass("hide"); 
                    $(".CFP401").toggleClass("hide");   
                    $(".CIIE200").toggleClass("hide"); 
                })
$('.carga').click(function(){
    if( $("#carrga").is(":visible") ){
                        $("#carrga").hide();
                    }else{
                        $("#carrga").show();
                    }
//Verifico si la procedencia es otra!!
if($servicio=='9999OO9999'){
    console.log('es otro');
    $("#otrox").show();
}else{
    $("#otrox").hide();
}   
                
$('input:text[name=detalle]').val("");
})
               
$("#combo").change(function () {$("#combo option:selected").each( function () { combo=$(this).val();});});





$('.grabar').on('click', function () 
    {
        var quien=$('input:text[name=otro_detalle]').val();
        var mensaje=$('input:text[name=detalle]').val();
        var atendio=$('input:text[name=atendio]').val();
        var derivado=combo;
        var servicio=$servicio;

            $.confirm({
                title: 'Confirme!',
                content: '<b>LO TRAJO:</b> '
                + servicio + ' '+ quien
                +'<br><b>VA A GUARDAR:</b>'
                +mensaje
                +'<BR> <b>ATENDIO:</b> '
                +atendio
                +'<BR> <b>LO DERIVA A:</b>' 
                +derivado,

                buttons: {
                    SI: function () {
                        $.alert('GUARDADO!');
            //****************************************************************************/
                        $.post("grabar.php", { 
                            quien: quien,
                            servicio: servicio, 
                            mensaje: mensaje,
                            atendio:atendio,
                            derivado:derivado },
                        function(data){$("#resultado").html(data);});
            //****************************************************************************/
            //          Limpio las variables, excepto el servicio que queda activo
            //          por si trajo mas de una cosa para cargar
                        $('input:text[name=detalle]').val("")
                        $("#carrga").hide();
                        console.log('se guardo..'+mensaje+' '+atendio+' ' +derivado);

                    },
                    NO: function () {
                        $.alert('No se guardo!');
                        console.log('NO SE HA ALMACENADO....');
                    },
                }
            });

    });
        


// RUTINA QUE GRABA..
/*                         $.post("grabar.php", { 
                            servicio: servicio, 
                            mensaje: mensaje,
                            atendio:atendio,
                            derivado:derivado },
                        function(data){$("#resultado").html(data);});  */

   /*  $('input:text[name=detalle]').val("")
        $("#carrga").hide();  */

//limpio variables
// $servicio='';
   
    //location.reload();

   /*  }); */


   

});



</script>

<style type="text/css">
  body {
    color: purple;
    background-color: #d8da3d }

.inputstyle {
    font-family: Arial; 
    font-size: 20pt; 
    ;
    }
.btn{font-family: Arial; font-size: 18pt; }

</style>

    </head>
    <body>
      <div class="col-lg-10">
      <br/>
        <button type="button" class="btn btn-primary inicio">INICIAL</button>
        <button type="button" class="btn btn-secondary primaria">PRIMARIA</button>
        <button type="button" class="btn btn-success secundaria">SECUNDARIA</button>
        <button type="button" class="btn btn-warning superior">SUPERIOR</button>
        <button type="button" class="btn btn-info agraria">AGRARIA</button>
        <button type="button" class="btn btn-secondary tecnica">TECNICA</button>
        <button type="button" class="btn btn-success modalidades">MODALIDADES / OTROS</button>
        
        <div id="inicial">
            <button type="button" class="btn btn-primary 901">901</button>
            <button type="button" class="btn btn-primary 902">902</button>
            <button type="button" class="btn btn-primary 903">903</button>
            <button type="button" class="btn btn-primary 904">904</button>
            <button type="button" class="btn btn-primary 905">905</button>
            <button type="button" class="btn btn-primary 906">906</button>
            <button type="button" class="btn btn-primary 907">907</button>
            <button type="button" class="btn btn-primary 908">908</button>
            <button type="button" class="btn btn-primary 909">909</button>
            <button type="button" class="btn btn-primary 910">910</button>
            <button type="button" class="btn btn-primary 911">911</button>
            <button type="button" class="btn btn-primary 912">912</button>
            <button type="button" class="btn btn-primary 913">913</button>
            <button type="button" class="btn btn-primary 914">914</button>
            <button type="button" class="btn btn-primary 915">915</button>
            <button type="button" class="btn btn-primary JIRIM1">JIRIMM1</button>
            <button type="button" class="btn btn-primary JIRIM2">JIRIMM2</button>
            <button type="button" class="btn btn-primary JIRIM3">JIRIMM3</button>
        </div>
        <div id="primaria">
            <button type="button" class="btn btn-primary EP1">EP1</button>
            <button type="button" class="btn btn-primary EP3">EP3</button>    
            <button type="button" class="btn btn-primary EP4">EP4</button>
            <button type="button" class="btn btn-primary EP5">EP5</button>
            <button type="button" class="btn btn-primary EP6">EP6</button>
            <button type="button" class="btn btn-primary EP7">EP7</button>
            <button type="button" class="btn btn-primary EP8">EP8</button>
            <button type="button" class="btn btn-primary EP9">EP9</button>
            <button type="button" class="btn btn-primary EP10">EP10</button>
            <button type="button" class="btn btn-primary EP11">EP11</button>
            <button type="button" class="btn btn-primary EP12">EP12</button>
            <button type="button" class="btn btn-primary EP15">EP15</button>
            <button type="button" class="btn btn-primary EP16">EP16</button>
            <button type="button" class="btn btn-primary EP22">EP22</button>
            <button type="button" class="btn btn-primary EP23">EP23</button>
            <button type="button" class="btn btn-primary EP25">EP25</button>
            <button type="button" class="btn btn-primary EP26">EP26</button>
            <button type="button" class="btn btn-primary EP27">EP27</button>
            <button type="button" class="btn btn-primary EP28">EP28</button>
            <button type="button" class="btn btn-primary EP29">EP29</button>
        </div>
        <div id="secundarias">
            <button type="button" class="btn btn-primary EES2">EES2</button>
            <button type="button" class="btn btn-primary EES4">EES4</button> 
            <button type="button" class="btn btn-primary EES5">EES5</button> 
            <button type="button" class="btn btn-primary EES5-A">EES5-A</button> 
            <button type="button" class="btn btn-primary EES6">EES6</button> 
            <button type="button" class="btn btn-primary EES7">EES7</button> 
            <button type="button" class="btn btn-primary EES8">EES8</button> 
            <button type="button" class="btn btn-primary EES9">EES9</button> 
            <button type="button" class="btn btn-primary EES9-A">EES9-A</button> 
            <button type="button" class="btn btn-primary EES10">EES10</button> 
            <button type="button" class="btn btn-primary EES10-A">EES10-A</button> 
            <button type="button" class="btn btn-primary EES11">EES11</button> 
            <button type="button" class="btn btn-primary EES12">EES12</button>
            <button type="button" class="btn btn-primary EES13">EES13</button> 
        </div>
        <div id="superiors">
            <button type="button" class="btn btn-primary ISFD99">ISFD99</button>
            <button type="button" class="btn btn-primary ISFDyT93">ISFDyT93</button>
        </div>
        <div id="agrarias">
             <button type="button" class="btn btn-primary EESA1">EESA1</button>
        </div>
        <div id="tecnicas">
             <button type="button" class="btn btn-primary EEST2">EEST2</button>
        </div>   
        <div id="modalidades">
                <button type="button" class="btn btn-dark EEE501">EEE 501(Especial)</button>
                <button type="button" class="btn btn-secondary EEEA1">EEE 1 (Artistica)</button>
                <button type="button" class="btn btn-danger EEPA-701">EEPA-701</button>
                <button type="button" class="btn btn-danger CEA702">CEA-702</button>
                <button type="button" class="btn btn-danger CEA703">CEA-703</button>
                <button type="button" class="btn btn-danger CEA704">CEA-704</button>
                <button type="button" class="btn btn-warning CENS451">CENS-451</button>
                <button type="button" class="btn btn-warning CENS452">CENS-452</button>
                <button type="button" class="btn btn-warning CENS453">CENS-453</button>
                <button type="button" class="btn btn-secondary CEF93">CEF 93</button>
                <button type="button" class="btn btn-info CFP401">CFP 401</button>
                <button type="button" class="btn btn-danger CIIE200">CIIE 200</button>
                <button type="button" class="btn btn-secondary OTRO">OTROS</button>
            <!-- <button type="button" class="btn btn-danger PSICO">PSICOLOGIA</button> -->
         </div>

    <hr>

   <button type="button" class="btn btn-dark carga">CARGAR</button>

<div id="carrga">
    <div id="otrox">
    <input type="text" name="otro_detalle" id="otro_detalle "  maxlength="604" size="60" class="inputstyle" placeholder="DESCRIBA PROCEDENCIA" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onfocus="javascript:this.value='';"
required="">
    </div>

<input type="text" name="detalle" id="detalle "  maxlength="604" size="60" 
class="inputstyle" placeholder="ESCRIBA LO QUE INGRESA" style="text-transform:uppercase;" 
onkeyup="javascript:this.value=this.value.toUpperCase();" 
required="">
<input type="text" name="atendio" id="atendio" maxlength="150" size="50" class="inputstyle" 
placeholder="ATENDIO" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" 
onfocus="javascript:this.value='';" required="">


<BR>
    <label class="inputstyle">DERIVADO A:</label>
    <select name="derivado" id="combo" class="inputstyle" >
    <option>seleccione..</option>
        <option>INICIAL</option>
        <option>PRIMARIA</option>
        <option>SECUNDARIA</option>
        <option>SECUNDARIA TECNICA</option>
        <option>PSICOLOGIA - (PC Y PS)</option>
        <option>ED. FISICA</option>
        <option>ESPECIAL</option>
        <option>ADULTOS</option>
        <option>POL. SOCIOEDUCATIVAS</option>
        <option>JEFATURA DISTRITAL</option>
        <option>OTROS</option>
    </select>
<!--    <input type="text" name="derivado" id="derivado" maxlength="150" size="50" class="inputstyle" placeholder="DERIVADO" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onfocus="javascript:this.value='';" required="">//-->
<button type="button" class="btn btn-dark-secondary grabar">GRABAR</button>
</div>

<div id="resultado" class="inputstyle">

</div>
    </body>
</html>