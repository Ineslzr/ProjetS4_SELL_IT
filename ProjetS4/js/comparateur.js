$(document).ready(function(){

	const produits= document.querySelectorAll("#prod_comp");
	produits.forEach(b => {b.addEventListener("click", function(){
    	var val=$(this).val();
        $.ajax({
            url:'../php/comp_produit.php',
            method: 'POST',
            data:{produit:val},
            success:function(response){
                $("#produit_selected").html(response);
                $("#indication").text("Votre produit sélectionné ");
            }
        });
		$.ajax({
            url:'../php/comp_produit.php',
            method: 'POST',
            data:{val:val},
            success:function(response){
            	$("#result").html(response);
            }
        });

    }); 
	});
});