<?php
    $membresias=ModeloMembresia::sqlListarMembresias();

?>
<div class="container my-5">
  <!--Section: Content-->
  <section class="text-center dark-grey-text">

    <!-- Section heading -->
    <h3 class="font-weight-bold pb-2 mb-4">Our pricing plans</h3>
    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-lg-4 col-md-12 mb-4 animated pulse">

        <!-- Pricing card -->
        <div class="card pricing-card">

          <!-- Price -->
          <div class="price header white-text blue rounded-top">
            <h2 class="number"><?php echo $membresias[0]['precio']?></h2>
            <div class="version">
              <h5 class="mb-0"><?php echo $membresias[0]['nombreMembresia']?></h5>
            </div>
          </div>

          <!-- Features -->
          <div class="card-body striped mb-1">

            <ul>
              <li>
                <p class="mt-2"><i class="fas fa-check green-text pr-2"></i><?php echo $membresias[0]['numDescargas']?> Download</p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i>30 days</p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i>Free access stock </p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i> Free access  Genero </p>
              </li>
            </ul>
            <button class="btn btn-blue pricing-action" data-toggle="modal" 
                          data-id="<?php echo $membresias[0]['id']?>"
                          data-precio="<?php echo $membresias[0]['precio']?>" 
													data-numDescargas="<?php echo $membresias[0]['numDescargas']?>"
												 data-tipo="<?php echo $membresias[0]['nombreMembresia']?>">Buy now</button>

          </div>
          <!-- Features -->

        </div>
        <!-- Pricing card -->

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-lg-4 col-md-6 mb-4 animated pulse">

        <!-- Pricing card -->
        <div class="card pricing-card">

          <!-- Price -->
          <div class="price header white-text indigo rounded-top">
            <h2 class="number"><?php echo $membresias[1]['precio']?></h2>
            <div class="version">
              <h5 class="mb-0"><?php echo $membresias[1]['nombreMembresia']?></h5>
            </div>
          </div>

          <!-- Features -->
          <div class="card-body striped mb-1">

            <ul>
              <li>
                <p class="mt-2"><i class="fas fa-check green-text pr-2"></i><?php echo $membresias[1]['numDescargas']?> Download</p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i>30 days</p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i>Free access stock</p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i> Free access  Genero </p>
              </li>
            </ul>
            <button class="btn btn-indigo pricing-action" 
                          data-precio="<?php echo $membresias[1]['precio']?>"
                          data-id="<?php echo $membresias[1]['id']?>" 
													data-numDescargas="<?php echo $membresias[1]['numDescargas']?>"
												 data-tipo="<?php echo $membresias[1]['nombreMembresia']?>">Buy now</button>

          </div>
          <!-- Features -->

        </div>
        <!-- Pricing card -->

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-lg-4 col-md-6 mb-4 animated pulse">

        <!-- Pricing card -->
        <div class="card pricing-card">

          <!-- Price -->
          <div class="price header white-text deep-purple rounded-top">
            <h2 class="number"><?php echo $membresias[2]['precio']?></h2>
            <div class="version">
              <h5 class="mb-0"><?php echo $membresias[2]['nombreMembresia']?></h5>
            </div>
          </div>

          <!-- Features -->
          <div class="card-body striped mb-1">

            <ul>
              <li>
                <p class="mt-2"><i class="fas fa-check green-text pr-2"></i><?php echo $membresias[2]['numDescargas']?> Download</p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i>30 days</p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i>Free access stock</p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i> Free access  Genero </p>
              </li>
            </ul>
            <button class="btn btn-deep-purple pricing-action" data-toggle="modal" data-target="#modalAbandonedCart" 
                          data-precio="<?php echo $membresias[2]['precio']?>" 
                          data-id="<?php echo $membresias[2]['id']?>"
													data-numDescargas="<?php echo $membresias[2]['numDescargas']?>"
												 data-tipo="<?php echo $membresias[2]['nombreMembresia']?>">Buy now</button>

          </div>
          <!-- Features -->

        </div>
        <!-- Pricing card -->

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </section>
  <!--Section: Content-->


</div>