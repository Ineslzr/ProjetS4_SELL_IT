$(document).ready(function(){

    var id_discu = $(".chat-box").data("id");
    setInterval(function(){
        $.ajax({
            url:'../php/loadMessage.php',
            method: 'POST',
            data:{id_discu:id_discu},
            success:function(response){
                $(".chat-box").html(response);
            }
        }); 

    },500);

	$('#send').on("click", function(event) {
		event.preventDefault();
		var message=$('#message').val();
		var id_discu=$(this).attr("name");

		$.ajax({
            url:'../php/sendMessage.php',
            method: 'POST',
            data:{message:message,id_discu:id_discu},
            success:function(response){
                $(".chat-box").html(response);
            }
        });
        $('#message').val('');
        
	});
});