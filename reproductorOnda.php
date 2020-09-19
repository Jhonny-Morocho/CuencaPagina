<html>
  <style>
  .dzsap-sticktobottom.dzsap-sticktobottom-for-skin-wave {
    bottom: 0;
    opacity: 1;
}
  </style>

  <link rel="stylesheet" href="https://arturia3.arturia.net/templates/arturia-bootstrap/assets/scripts/jquery-plugins/waveform-audio-player/audioplayer/audioplayer.css">
<body>
  
<div id="audio-gallery-0" class="audiogallery" style="opacity:0">
    <div class="items">
      <div id="audioplayer-0_0" class="audioplayer-tobe" data-scrubbg="waves/scrubbg.png" data-scrubprog="waves/scrubprog.png" data-type="normal" data-source="https://downloads.arturia.com/products/kraft_tribute/preset/audio_examples/Autobahn__Paul_Schilling.mp3" data-videoTitle="Audio Video"  data-fakeplayer="#stickyplayer">      
        <div class="meta-artist">
          <span class="the-artist">tangerine</span>
          <br/>
          <span class="the-name">title</span>
        </div>
        <div class="menu-description">
          <div class="menu-item-thumb-con">
            <div class="menu-item-thumb"></div>
          </div>
          <span class="the-artist"></span>
          <span class="the-name">Autobahn_</span>
        </div>
      </div>
 
      <div id="audioplayer-0_1" class="audioplayer-tobe" data-scrubbg="waves/scrubbg.png" data-scrubprog="waves/scrubprog.png" data-type="normal" data-source="https://downloads.arturia.com/products/kraft_tribute/preset/audio_examples/Computer_Love__Paul_Schilling.mp3" data-videoTitle="Audio Video"  data-fakeplayer="#stickyplayer">      
        <div class="meta-artist">
          <span class="the-artist">tangerine</span>
          <br/>
          <span class="the-name">title 1</span>
        </div>
        <div class="menu-description">
          <div class="menu-item-thumb-con">
            <div class="menu-item-thumb"></div>
          </div>
          <span class="the-artist"></span>
          <span class="the-name">Computer_Love</span>
        </div>
      </div>
    </div>
</div>  
  
  <!------------------------>
<!-- sticky audio player-->
<div class="dzsap-sticktobottom-placeholder dzsap-sticktobottom-placeholder-for-skin-wave"></div>
<section class="dzsap-sticktobottom dzsap-sticktobottom-for-skin-wave">
    <div id="stickyplayer" class="audioplayer-tobe" style="width:100%;" data-type="fake" data-source="fake">
        <div class="the-comments">
        </div>
        <div class="meta-artist">
            <span class="the-artist"></span>
            <span class="the-name">
                <a href="http://codecanyon.net/item/zoomsounds-wordpress-audio-player/6181433?ref=ZoomIt" target="_blank"></a>
            </span>
            <div class="goto">
                <div class="btn-prev player-but">
                    <div class="the-icon-bg"></div>                 
                </div>
                <div class="btn-next player-but">
                    <div class="the-icon-bg"></div>                
                </div>
            </div>
        </div>
    </div>
</section>

  
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://arturia3.arturia.net/templates/arturia-bootstrap/build/js/all-plugins-min.js"></script>
<script >
/*--- [ER] mod-preset ---*/

jQuery(document).ready(function($){

var presetBrowser ={
      globals:{         
          currentAudioGallery: null,
          stickyplayer:{
              status:null
          }
      }
  }

init();

function init(){
      //initIsotope();
      initAudioPlayer();
      // Listen for the event.
      document.addEventListener('mySuperEvt', function(e){
          console.log("mySuperEvt capture on document level");
          document.getElementById(presetBrowser.globals.currentAudioGallery).api_goto_next();
      }, false);
  }

   

  /**
   * Instantiate an audioGallery on each preset banks (audioGallery/player plugin)
   */
function initAudioPlayer(){

  var settings_ap = {
      autoplayNext:true,
      autoplay: 'true',
      disable_scrub: 'default',
      design_skin: 'skin-wave',
      skinwave_dynamicwaves:'on',
      cue: 'on',
      transition:'fade'
    };


  var ag_id  = "#audio-gallery-0";

  var gallery = dzsag_init(ag_id,{
    'transition':'fade'
    ,'autoplay' : 'off'
    ,'settings_ap':settings_ap
  });

  

  // listener on ended event // never raised
  $("audio" ,ag_id).on("ended",function(){
    console.log("audio audiogallery jQuery .on('ended')");
    document.getElementById(presetBrowser.globals.currentAudioGallery).api_goto_next();
  });

initStickyPlayer(this);
    
}

/**
   *  Init or reinit player sticked to bottom of page, add event listener (prev and next audio demo) at first call
   * @param audioGal
   */
function initStickyPlayer(audioGal){

 // var audioURL = $('.audioplayer-tobe',audioGal).attr("data-source");
   //$("#stickyplayer").attr("data-source",audioURL);

  var settings_ap = {
    autoplayNext:true,
    swf_location: "/templates/arturia-bootstrap/assets/scripts/jquery-plugins/waveform-audio-player/ap.swf",
    autoplay: 'true',
    preload_method: 'none',
    disable_scrub: 'default',
    design_skin: 'skin-wave',
    skinwave_dynamicwaves:'on',
    cue: 'on',
    transition:'fade',
    skinwave_mode: 'small'
  };

  dzsap_init('#stickyplayer',settings_ap);


  /**
  * Add Listeners on button prev and next in stickyplayer
  */
  if(presetBrowser.globals.stickyplayer.status != "initialized_almost_once")
  {
    $('#stickyplayer .btn-prev').on('click', function (event) {
      document.getElementById(presetBrowser.globals.currentAudioGallery).api_goto_prev();
    })
    $('#stickyplayer .btn-next').on('click', function (event) {
      document.getElementById(presetBrowser.globals.currentAudioGallery).api_goto_next();
    })
  }

  // Adding event listerners on oneded event
  // Dom way
  $('#stickyplayer audio')[0].addEventListener('ended', function (event) {
    console.log("stickyplayer ended captured from addEventListern");
  })
  $('#stickyplayer audio')[0].onended = function (event) {
    console.log("stickyplayer ended captured from onended");
  }

  // jQuery way
  $("#stickyplayer audio").on("ended",function(){
    console.log("stickyplayer jQuery .on('ended')");
    document.getElementById(presetBrowser.globals.currentAudioGallery).api_goto_next();
  })

  presetBrowser.globals.stickyplayer.status = "initialized_almost_once";
}

function showStickyPlayer(audiogaleryID){

  var packname = $('.playerInfos',audiogaleryID).data('packname');

  $(".dzsap-sticktobottom .the-artist").html(packname);

  $(".dzsap-sticktobottom").animate({
    opacity: 1
  }, 700, function() {
    $(window).trigger('resize'); // force waveform to be recalculate
  });

}

function hideStickyPlayer(){
  $(".dzsap-sticktobottom").css({
    "opacity": "0"
  });
}



});
</script>
  
</html>