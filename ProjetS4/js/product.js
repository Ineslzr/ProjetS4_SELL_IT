$(document).ready(function(){
    let mc1=document.getElementById("liste_mot_clef_1");
    let mc2=document.getElementById("liste_mot_clef_2");
    mc1.style.display = "none";
    mc2.style.display = "none";


	$("#section-select").change(function(){
		var category= $(this).val();
		$.ajax({
            url:'./php/mot_clef.php',
            method: 'POST',
            data:{category:category},
            success:function(response){
                $("#mot_clef_1").append(response);   
                mc1.style.display = "block";          
            }
        });

	});

        
    $("#mot_clef_1").change(function(){
        var mot_clef= $(this).val();
        $.ajax({
            url:'./php/mot_clef.php',
            method: 'POST',
            data:{mot_clef:mot_clef},
            success:function(response){
                $("#mot_clef_2").append(response); 
                mc2.style.display= "block";             
            }
        });

    });

});