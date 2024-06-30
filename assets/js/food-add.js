

jQuery(document).ready(function($){
    $('.food-add-btn').click(function(e){
        e.preventDefault();
        var formSelected = $('form#'+$(this).data('form'));
        let product_id = $('#'+formSelected.attr('id')+'-hidden').val();
        console.log(product_id);
        var values = Array.from(document.querySelectorAll('input[type=checkbox]:checked')).map(item => item.value);

            $.ajax({
                url:ajax_object.ajax_url,
                data:{
                    'action':'food_ajax_add_to_cart',
                    'product_id':product_id,
                    'variations':values,
                },
                type:'post',
                success:function(res){
                    console.log('success');
                },
                error:function(err){
                    console.log('error');
                }
            });

        formSelected[0].reset();
        window.location.reload();
        
        // console.log(formSelected);
        // console.log(values);
    })
});