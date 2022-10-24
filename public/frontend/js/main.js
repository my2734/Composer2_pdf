

setTimeout(function(){
    $('.loader_bg').css({
        display: "none"});
},1500);

$(document).ready(function(){
    $('.product_detail_list img').click(function(){
        $src_image = $(this).attr('src');
        $('.image_primary_product_detail img').attr('src',$src_image);
    });

      
}
);