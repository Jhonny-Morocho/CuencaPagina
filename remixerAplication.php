
<?php

ini_set('display_errors', 'On');


session_start();
require'model/conexion.php';
require'model/mdlProveedor.php';


//=============================creacion de objetos==========================
//=============================creacion de objetos==========================

require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
$plantilla->ctr_header();



?>

<div class="row">
    <div class="col-lg-12 mt-5 ml-4">
        <div id="wufoo-mon648r0prff3c" class="mt-lg-5"> Fill out my <a href="https://latinedit.wufoo.com/forms/mon648r0prff3c">online form</a>. </div> 
        <script type="text/javascript"> var mon648r0prff3c; (function(d, t) { var s = d.createElement(t), options = { 'userName':'latinedit', 'formHash':'mon648r0prff3c', 'autoResize':true, 'height':'731', 'async':true, 'host':'wufoo.com', 'header':'show', 'ssl':true }; s.src = ('https:' == d.location.protocol ?'https://':'http://') + 'secure.wufoo.com/scripts/embed/form.js'; s.onload = s.onreadystatechange = function() { var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return; try { mon648r0prff3c = new WufooForm(); mon648r0prff3c.initialize(options); mon648r0prff3c.display(); } catch (e) { } }; var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr); })(document, 'script');</script>
    </div>
</div>


<?php

$plantilla->ctr_footer();
?>
