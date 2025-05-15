<script>
    $(document).ready(function(){
        $('.wishlist-toggle-btn').click(function(e){
            e.preventDefault();
            let productId = $(this).data('id');
            // let icon = $('#wishlist-icon-' + productId)
            // alert(productId);


            // ajax request
            $.ajax({
                url: '{{route('wishlist.toggle')}}',
                type: "POST",
                data: {
                    product_id: productId,
                    _token: '{{ csrf_token()}}'
                },
                success: function(response)
                {
                    // console.log(response);
                    // alert(response.product_id);
                    if(response.status === "added"){
                        console.log('added successfully');
                        // icon.removeClass('bi-heart').addClass('bi-heart-fill');

                        // button.css({
                        //     'background-color' : '#000000',
                        //     'color' : 'white'
                        // })
                    }
                    else{
                        if(response.status === "removed"){
                            // icon.removeClass('bi-heart-fill').addClass('bi-heart');

                            // button.css({
                            //     'background-color' : '',
                            //     'color' : ''
                            // })
                            console.log('removed');
                        }
                    }
                },
                error: function(xhr){
                    console.error(xhr.responseText);
                    }

            });
        });
    });

</script>
