$('.button-donate').click(async function(data){
    let id_pricelist = $(this).data('id')
    , url = $(this).data('url')
    , payment_url = $(this).data('payment-url');

    $.ajax(
        {
            url,
            type:'post',
            data: {
                id_pricelist,
            },
            success : function(snapToken){
                // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                window.snap.pay(snapToken, {
                    onSuccess: async function(result){
                        /* You may add your own implementation here */
                        await Swal.fire({
                            title: "payment success!",
                            icon: "success",
                            text: "Your Package has been processed."
                        }); 

                        $.ajax({
                            url: payment_url,
                            type: 'post',
                            data : result,
                            success : () => ''//window.location.reload() 
                        })
                        
                    },
                    onClose: function(){
                    /* You may add your own implementation here */
                        Swal.fire({
                            title :'warning',
                            icon : "warning",
                            text: 'you closed the popup without finishing the payment',
                        })
                    }
                })
            }
        })
})