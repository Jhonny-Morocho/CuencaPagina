
    <!-- ============================================CARROSUEL================================= -->
            <!--Carousel Wrapper-->
        <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
            <!--Indicators-->
            <?php
                $carrusel=ModeloCarrusel::sqlListarImgCarrusel();
                print_r($carrusel);
                foreach ($carrusel as $key => $value) {
                echo '  <ol class="carousel-indicators">';
                    if($key==0){
                       echo '<li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>';
                    }else{
                        echo '<li data-target="#carousel-example-2" data-slide-to="'.$key.'"></li>';
                    }
                echo '</ol>';
                }
            ?>
            <!--Slides-->
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="view">
                        <img class="d-block w-100" src="../../img/carrosul/portada latin pagina.jpg"
                        alt="First slide">
                        <div class="mask rgba-black-light"></div>
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="view">
                        <img class="d-block w-100" src="../../img/carrosul/portada latin pagina.jpg"
                        alt="First slide">
                        <div class="mask rgba-black-light"></div>
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="view">
                        <img class="d-block w-100" src="../../img/carrosul/portada latin pagina.jpg"
                        alt="First slide">
                        <div class="mask rgba-black-light"></div>
                    </div>
                </div>

            </div>
            <!--/.Slides-->
            <!--Controls-->
            <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <!--/.Controls-->
        </div>
        <!--/.Carousel Wrapper-->  
