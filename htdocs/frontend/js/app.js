/** Toggle main menu */
$.when($.ready).then(function () {

    // Document is ready.
    console.log('Document is ready')


    $("#navicon").click(function(){
        console.log('Open Navigation')
        $("#navicon").css('display','none');
        $("#navicon-close").css('display','inline');
        $("#mainnavi").slideDown();
    });

    $("#navicon-close").click(function(){
        console.log('Close Navigation')
        $("#navicon").css('display','inline');
        $("#navicon-close").css('display','none');
        $("#mainnavi").slideUp();
    });

});