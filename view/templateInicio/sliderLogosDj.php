<div class="row">
      <ul id="rcbrand2">
        <?php
            $logosDjs=ModeloLogosDjs::sqlListarLogosDJs();
            foreach ($logosDjs as $key => $value) {
                # code...
                echo  '<li><img src="../../img/logosDjs/'.$value['img'].'" /></li>';
            }
        ?>
      </ul>
</div>
