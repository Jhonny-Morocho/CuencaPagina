<!-- Footer -->
<footer class="page-footer font-small special-color-dark ">

  <!-- Footer Elements -->
  <div class="container">

    <!-- Grid row-->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-12 py-5">
        <div class="mb-5 flex-center">

          <!-- Facebook -->
        
          <a class="fb-ic"  href="https://www.facebook.com/latinedit" target="_blank">
            <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          <!-- Twitter -->
          <a class="tw-ic" href="https://twitter.com/marcoariasdjmix" target="_blank">
            <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          <!--Instagram-->
          <a class="ins-ic" href="https://www.instagram.com/teamlatinedit" target="_blank">
            <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          <!--Instagram-->
          <a class="ins-ic" href="https://www.youtube.com/channel/UCaocBZQ9TkxuqNWW3ncSXxg?view_as=subscriber" target="_blank">
            <i class="fab fa-youtube fa-lg white-text mr-md-5 mr-3 fa-2x" aria-hidden="true"></i>
          </a>
        </div>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

  </div>
  <!-- Footer Elements -->


  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="../../">latinedit.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

</body>
        <!-- jQuery -->
       <script type="text/javascript" src="js/jquery.min.js?v=1.0.0"></script> 
      
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="js/popper.min.js?v=1.0.0"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="js/bootstrap.min.js?v=1.0.0"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="js/mdb.min.js?v=1.0.0"></script>
        <!-- Your custom scripts (optional) -->
        <script type="text/javascript"></script>

        <!-- APP -->
        <script type="text/javascript" src="../js/appLatinEdits.js?v=1.0.0"></script>
        <!-- ======================AJAX================================== -->
        <script type="text/javascript" src="../../controler/js/ajaxProveedor.js?v=1.0.0"></script>
        <script type="text/javascript" src="../../controler/js/ajaxCliente.js?v=1.0.0"></script>
        <script src="https://unpkg.com/moment"></script>
        <script type="text/javascript" src="../../controler/js/carritoCompras.js?v=1.0.1"></script>
        <script type="text/javascript" src="../../controler/js/ajaxPagar.js?v=1.0.1"></script>
        

        <!-- =============================REPRODUCTOR DE AUDIO=============================== -->
        <link rel="stylesheet" type="text/css" href="../../jPlayer Flat Audio Theme/css/jplayer-flat-audio-theme.css" />
        <script type="text/javascript" src="../../jPlayer Flat Audio Theme/js/jquery.jplayer.min.js?v=1.0.0"></script> 
        <script type="text/javascript" src="../../controler/js/jPlayerPersonalizado.js?v=1.0.0"></script>


        <!--========================ANIMACION DE ESPERA==================================================== -->
         <script type="text/javascript" src="../../controler/js/animacionEspera.js?v=1.0.0"></script> 
         <!--========================ANIMACION DE ESPERA==================================================== -->

         <!-- =============================TOSTADAS BOOSTRAP====================================== -->
         <script type="text/javascript" src="../../Toast-Notification/src/bootoast.js?v=1.0.0"></script> 
         <link rel="stylesheet" href="../../Toast-Notification/src/bootoast.css?v=1.0.0">

    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167467233-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-167467233-1');
        </script>

          <script type="text/javascript">
            $(document).ready(function () {
                //Disable full page
                $("body").on("contextmenu",function(e){
                    return false;
                });
              
                //Disable part of page
                $("#id").on("contextmenu",function(e){
                    return false;
                });
            });

          $(document).keydown(function (event) {
                  if (event.keyCode == 123) { // Prevent F12
                      return false;
                  } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
                      return false;
                  }
              });
          </script>
          
            <!-- Facebook Pixel Code -->
            <script>
              !function(f,b,e,v,n,t,s)
              {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
              n.callMethod.apply(n,arguments):n.queue.push(arguments)};
              if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
              n.queue=[];t=b.createElement(e);t.async=!0;
              t.src=v;s=b.getElementsByTagName(e)[0];
              s.parentNode.insertBefore(t,s)}(window, document,'script',
              'https://connect.facebook.net/en_US/fbevents.js');
              fbq('init', '287666872670128');
              fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" style="display:none"
              src="https://www.facebook.com/tr?id=287666872670128&ev=PageView&noscript=1"
            /></noscript>
            <!-- End Facebook Pixel Code -->

            <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/43e7b358c17a50edbc12de074/271195d8d40a356a969dcfac7.js");</script>

</html>        

