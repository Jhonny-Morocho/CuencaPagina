
    <!-- ============================================CARROSUEL================================= -->
            <!--Carousel Wrapper-->

            <div class="row mt-4">
                <div class="col-lg-12 mt-5">
                    <div id="carousel-example-2" class="carousel slide carousel-fade " data-ride="carousel">
                        <!--Indicators-->
                        <?php
                            $carrusel=ModeloCarrusel::sqlListarImgCarrusel();
                            echo '  <ol class="carousel-indicators">';
                            foreach ($carrusel as $key => $value) {

                                if($key==0){
                        
                                echo '<li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>';
                                }else{
            
                                    echo '<li data-target="#carousel-example-2" data-slide-to="'.$key.'"></li>';
                                }
                            }
                            echo '</ol>';
                        ?>
                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">

                            <?php
                                foreach ($carrusel as $key => $value) {
                                    if($key==0){
                                    echo'    <div class="carousel-item active ">
                                            <div class="view">
                                                <img class="d-block w-100" src="../../img/carrosul/'.$value['img'].'"
                                                alt="First slide">
                                            
                                            </div>
                                        </div>';
                                    }else{
                                    echo' <div class="carousel-item ">
                                            <div class="view">
                                                <img class="d-block w-100" src="../../img/carrosul/'.$value['img'].'"
                                                alt="">
                                            
                                            </div>
                                        </div>';
                                    }
                                }
                            ?>
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
            </div>
                </div>


