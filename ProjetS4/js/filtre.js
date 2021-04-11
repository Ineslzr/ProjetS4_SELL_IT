$(document).ready(function(){
    
    $("#section-select").change(function(){
        var category= $(this).val();
        $.ajax({
            url:'/ProjetS4/php/action.php',
            method: 'POST',
            data:{category:category},
            success:function(response){
                $("#result").html(response);
                $("#textChange").text("Produits filtrés");
            }
        });
    });

    $("#customRange2").change(function(){
        $("#val_range").text($(this).val());
        var prix=$(this).val();
        var category=$('#section-select').val();
        $.ajax({
            url:'/ProjetS4/php/action.php',
            method: 'POST',
            data:{prix:prix,category:category},
            success:function(response){
                $("#result").html(response);
                $("#textChange").text("Produits filtrés");
            }
        });

    });

    function get_filter_text(text_id){
        var filterData = [];
        $('#'+text_id+':checked').each(function(){
            filterData.push($(this).val());
        });
        return filterData;
    }
});