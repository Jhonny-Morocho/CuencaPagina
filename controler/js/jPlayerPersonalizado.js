// Create a WaveSurfer instance
var wavesurfer;

// Init on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    wavesurfer = WaveSurfer.create({
        container: '#waveform',
        waveColor: '#c8e6c9 ',
        progressColor: '#c8e6c9',
        cursorColor: '#c8e6c9',
        barWidth:0,
        barHeight:1.2,
        height: 40
    });
});
$('.reproducirContenedor').on('click',function(e){// click en el elento a reproduccopm
    e.preventDefault();

    var url_destino=$(this).attr('data-demo');// obtengo el url y reproduzo la cancoon
    console.log("url_destino ",url_destino);
    $('.reproducirContenedor').removeClass('active');
    $(this).addClass('active');

    // $(this).css("display","block");
    // $(".playIcono").css("display","block");
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


      wavesurfer.load(url_destino);
      wavesurfer.on('loading', function(X, evt) {
     
        UpdateLoadingFlag(X);
      });
  
      function UpdateLoadingFlag(Percentage) {
       
        //hideStickyPlayer();
        if (document.getElementById("loading_flag")) {
          document.getElementById("loading_flag").innerText = "Loading " + Percentage + "%";
          if (Percentage >= 100) {
            document.getElementById("loading_flag").style.display = "none";
          } else {
            document.getElementById("loading_flag").style.display = "block";
          }
        }
      }

    jQuery("#jquery_jplayer_1").jPlayer("play");
});

// .song__item:hover {
//   background: #2c2c2c;
// }

// $(".song__item").css("color", "red");
