/*=============================================
    ACTIVAR O DESACTIVA INPUT STOCK
=============================================*/
$('.opcion').on('change', function(){
    var selected = $('select[name=opcion]').val();
    if(selected == '1'){
        $('.stock-hidden').removeAttr('hidden');
    }else{
        $('.stock-hidden').attr('hidden',true);
        $('.stock-hidden').removeAttr('required');
    }
});
/*=============================================
    ACTIVAR O DESACTIVA INPUT STOCK
=============================================*/
$(document).ready(function(){
    var selected = $('select[name=opcion]').val();
    if(selected == '1'){
        $('.stock-hidden').removeAttr('hidden');
    }else{
        $('.stock-hidden').removeAttr('required');
        $('.stock-hidden').attr('hidden',true);
    }
})
