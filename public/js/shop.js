//On load
$(document).ready(function(){
    //add event listeners for all items that contain .dropend-hover class



    $('li[class*="dropend-hover"]').each(function(){

        $(this).hover(function(){
            var child = $(this).children('.has-navi')[0];

            if(child && !$(child).hasClass('show')){
                $(child).dropdown('toggle');
                console.log('in');
            }
        });
        //on hoverout
        $(this).mouseleave(function(){
            var child = $(this).children('.has-navi')[0];

            if(child && $(child).hasClass('show')){
                $(child).dropdown('toggle');
                console.log('in');
            }
        });
    });

});
