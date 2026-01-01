$(document).ready(function() {
    try {
        $('.btn-touchspin').click(function(e) {
            try {
                var elementQty = $(this).closest('.quantity');
                if (elementQty.length === 0) return;
                
                var inputGroup = elementQty.find('.input-group');
                var currentValue = parseInt(inputGroup.val()) || 1;
                var productIdElement = elementQty.find('.product-id');
                
                if (productIdElement.length === 0) return;
                
                var product_id = productIdElement.val();
                
                if($(this).hasClass('bootstrap-touchspin-up')){
                    currentValue++;
                    if($(this).hasClass('cart')){
                        window.location.href = `/cart/increase/${product_id}`;
                        return;
                    }
                } else {
                    if (currentValue > 1) {
                        currentValue--;
                        if($(this).hasClass('cart')){
                            window.location.href = `/cart/decrease/${product_id}`;
                            return;
                        }
                    }
                }
                inputGroup.val(currentValue);
            } catch (error) {
                console.warn('Touchspin button error:', error);
            }
        });
    } catch (error) {
        console.warn('Touchspin initialization error:', error);
    }
})