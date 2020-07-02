

    // $(document).ready(function(){

        function configureLoadingScreen(screen){

                $(document)
                    .ajaxStart(function () {
                        screen.fadeIn();
                    })
                    .ajaxStop(function () {
                        screen.fadeOut();
                    });
                }
                
                function animacion(){
                    
                    var screen = $('#loading-screen');
                    
                    configureLoadingScreen(screen);
                    $.get('http://jsonplaceholder.typicode.com/posts')
                            .done(function(result){
                
                            })
                            .fail(function(error){
                
                })
            }

    // });