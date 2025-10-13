$(document).ready(function() {
    $('.btn-touchspin').click(function(e) {
        var elementQty = $(this).closest('.quantity');
        var currentValue = elementQty.find('.input-group').val();
        var product_id = elementQty.find('.product-id').val();
        if($(this).hasClass('bootstrap-touchspin-up')){
            currentValue++;
            if($(this).hasClass('cart')){
                window.location.href = `/cart/increase/${product_id}`
            }
        }   
        else{
            if (currentValue > 1) {
                currentValue--;
                if($(this).hasClass('cart')){
                    window.location.href = `/cart/decrease/${product_id}`
                }
            }
        }
        elementQty.find('.input-group').val(currentValue);
    })

   
})