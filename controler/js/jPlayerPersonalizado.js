//===========================================JSQUERY REPRODUCTOr===================///

$('.reproducirContenedor').on('click',function(e){// click en el elento a reproduccopm
    e.preventDefault();

    var url_destino=$(this).attr('data-demo');// obtengo el url y reproduzo la cancoon
    console.log("url_destino ",url_destino);

    jQuery("#jquery_jplayer_1").jPlayer({
        swfPath: "http://www.jplayer.org/latest/js/Jplayer.swf",
        supplied: "mp3",
        wmode: "window",
        preload:"auto",
        autoPlay: true,
        errorAlerts:false,
        warningAlerts:false
      });
   
    jQuery("#jquery_jplayer_1").jPlayer("setMedia", {
        mp3:url_destino
      });

    jQuery("#jquery_jplayer_1").jPlayer("play");
});
   
