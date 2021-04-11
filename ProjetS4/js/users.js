$(document).ready(function(){

	const buttons= document.querySelectorAll("#contact");
    buttons.forEach(b => {b.addEventListener("click", function(){
    	var idUser2=$(this).data("id");
        $.ajax({
            url:'./php/contacter.php',
            method: 'POST',
            data:{idUser2:idUser2},
            success:function(response){
            	window.location= "./www/chat.php?id_discu="+response;
            }
        });
    });   

	});

	const searchBar = document.querySelector(".users .search input");
	const searchButton= document.querySelector(".users .search button");

	searchButton.onclick = ()=>{
		searchBar.classList.toggle("active");
		searchBar.focus();
		searchButton.classList.toggle("active");
	}



});





