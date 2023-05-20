<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;

//template para correo


use function PHPUnit\Framework\isEmpty;

class NotificarUsuarios extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    private $tiempoValidarFormEstudiante=48;// horas
    private $tiempoValidarFormEmpleador=72;// horas
    private $tiempoValidarOfertaLaboral=72;// horas
    private $tiempoSeleccionarPostulante=192;//horas //8 dias
    private $tiempoDePublicacionOfertaLaboralGestor=24;
    protected $signature = 'command:notificarUsuarios';
    //reutilizando el codigo con los correos
    //use TemplateCorreo;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cuando pasa 48 se envia la notifiacion ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

/*      $this->notificarEstudiante();
     $this->notificarEmpleador();
     $this->notificarOfertaLaboralExpirada();
     $this->notificarOfertaLaboralExpiradaDePublicarGestor();
     $this->notificarSeleccionarPostulanteEmpleador(); */

    }

    //nofiticar al postulante que su registro ha expirado

    //el tiempo de validacion del formulario re registro del empleador expiro

    //comunicar al gestor para que publique la oferta

}

