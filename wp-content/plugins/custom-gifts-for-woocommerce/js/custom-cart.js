(function($){
  $(document).ready(function(){
    $('.gift-pro-message').on('change keyup paste',function(){
     var cart_id = $(this).data('cart-id');
     $.ajax(
        {
          type: 'POST',
          url: ajax_url.ajaxurl,
          data: {
            action: 'custom_cart_message',
            security: $('#woocommerce-cart-nonce').val(),
            message: $('#cart_message_' + cart_id).val(),
            cart_id: cart_id
          },
          success: function( response ) {
            $('.cart_totals').unblock();
          }
        }
      )
    });
  });
})(jQuery);