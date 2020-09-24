<div id="jquery_jplayer_1" class="jp-jplayer"></div>
    <div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
        <div class="jp-type-single">
            <div class="jp-gui jp-interface">
                <div class="jp-controls">
                    <a class="jp-play"><i class="fa fa-play"></i></a>
                    <a class="jp-pause"><i class="fa fa-pause"></i></a>
                    <a class="jp-stop"><i class="fa fa-stop"></i></a>
                </div>
                <div class="jp-progress">
                    <div class="jp-seek-bar">
                        
                        <!-- ============= conetendedor de la onda ============== -->
                        <div id="waveform"></div>
                        <div class="jp-play-bar"></div>
                    </div>
                </div>
                <div class="jp-volume-controls">
                    <a class="jp-mute"><i class="fa fa-volume-off"></i></a>
                    <a class="jp-volume-max"><i class="fa fa-volume-up"></i></a>
                    <div class="jp-volume-bar">
                        <div class="jp-volume-bar-value"></div>
                    </div>
                </div>
                <div class="jp-time-holder">
                    <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                    <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                </div>
            </div>
        </div>
    </div> 




<style>
    .reproducir{

    clear: both;
    width: 100%;
    left: 1px;
    position: fixed;
    overflow: hidden;
    bottom: -3px; 
    z-index: 9999;
}
</style>

   
<!-- =============================REPRODUCTOR DE AUDIO=============================== -->
<link rel="stylesheet" type="text/css" href="../../jPlayer Flat Audio Theme/css/jplayer-flat-audio-theme.css" />
<script type="text/javascript" src="../../jPlayer Flat Audio Theme/js/jquery.jplayer.min.js?v=1.0.1"></script> 
<script type="text/javascript" src="../../controler/js/jPlayerPersonalizado.js?v=1.0.0"></script>

<!-- =================== SCRIPT PARA DIBUJAR ONDA =============== -->
<script src="https://unpkg.com/wavesurfer.js"></script>
