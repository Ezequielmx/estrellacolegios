<?php

namespace App\Http\Livewire\Admin\Servicios\Horarios;

use App\Models\Horarioservicio as ModelsHorarioservicio;
use App\Models\Servicio;
use App\Models\Tema;
use App\Services\simpleMensWpp;
use Livewire\Component;

class HorarioServicio extends Component
{
    public $servicio;
    public $temas;

    public $newhoraM;
    public $newhoraT;
    public $newhoraN;

    public $newcantM;
    public $newcantT;
    public $newcantN;

    public $newtemaM;
    public $newtemaT;
    public $newtemaN;

    protected $rules = [
        'newhoraM' => 'required',
        'newcantM' => 'required',
        'newtemaM' => 'required',
    ];


    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        $horarios = $this->servicio->horarios->sortBy('hora');
        $minutes_to_add = 50;
        if ($horarios->where('turno', 'm')->count() > 0) {
            $utmhoraM = $horarios->where('turno', 'm')->last()->hora;
            $this->newhoraM = date('H:i', strtotime($utmhoraM . ' + ' . $minutes_to_add . ' minutes'));
        }

        if ($horarios->where('turno', 't')->count() > 0) {
            $utmhoraT = $horarios->where('turno', 't')->last()->hora;
            $this->newhoraT = date('H:i', strtotime($utmhoraT . ' + ' . $minutes_to_add . ' minutes'));
        }

        if ($horarios->where('turno', 'n')->count() > 0) {
            $utmhoraN = $horarios->where('turno', 'n')->last()->hora;
            $this->newhoraN = date('H:i', strtotime($utmhoraN . ' + ' . $minutes_to_add . ' minutes'));
        }

        return view('livewire.admin.servicios.horarios.horario-servicio', compact('horarios'));
    }

    public function mount(Servicio $servicio)
    {
        $this->servicio = $servicio;
        $this->temas = Tema::All();
    }

    public function changeHorario(ModelsHorarioservicio $horario, $hora)
    {
        $horario->update([
            'hora' => $hora
        ]);
        $this->emit('refreshComponent');
    }

    public function changeCant(ModelsHorarioservicio $horario, $cant)
    {
        $horario->update([
            'cantidad' => $cant
        ]);
        $this->emit('refreshComponent');
    }

    public function changeTema(ModelsHorarioservicio $horario, $tema)
    {
        $horario->update([
            'tema_id' => $tema
        ]);
        $this->emit('refreshComponent');
    }

    public function addHorarioM()
    {
        $this->validate(
            [
                'newhoraM' => 'required',
                'newcantM' => 'required',
                'newtemaM' => 'required'
            ]
        );

        $horario = new ModelsHorarioservicio();
        $horario->servicio_id = $this->servicio->id;
        $horario->hora = $this->newhoraM;
        $horario->cantidad = $this->newcantM;
        $horario->tema_id = $this->newtemaM;
        $horario->turno = 'm';
        $horario->save();
        $this->reset(['newhoraM', 'newcantM', 'newtemaM']);
        $this->emit('refreshComponent');
    }

    public function addHorarioT()
    {
        $this->validate(
            [
                'newhoraT' => 'required',
                'newcantT' => 'required',
                'newtemaT' => 'required'
            ]
        );

        $horario = new ModelsHorarioservicio();
        $horario->servicio_id = $this->servicio->id;
        $horario->hora = $this->newhoraT;
        $horario->cantidad = $this->newcantT;
        $horario->tema_id = $this->newtemaT;
        $horario->turno = 't';
        $horario->save();
        $this->reset(['newhoraT', 'newcantT', 'newtemaT']);
        $this->emit('refreshComponent');
    }

    public function addHorarioN()
    {
        $this->validate(
            [
                'newhoraN' => 'required',
                'newcantN' => 'required',
                'newtemaN' => 'required'
            ]
        );

        $horario = new ModelsHorarioservicio();
        $horario->servicio_id = $this->servicio->id;
        $horario->hora = $this->newhoraN;
        $horario->cantidad = $this->newcantN;
        $horario->tema_id = $this->newtemaN;
        $horario->turno = 'n';
        $horario->save();
        $this->reset(['newhoraN', 'newcantN', 'newtemaN']);
        $this->emit('refreshComponent');
    }

    public function deleteHorario(ModelsHorarioservicio $horario)
    {
        $horario->delete();
        $this->emit('refreshComponent');
    }

    public function enviarCron()
    {
        $horariosM = "";
        $horariosT = "";
        $horariosN = "";

        foreach ($this->servicio->horarios as $horario) {
            switch ($horario->tema_id) {
                case 1:
                    $icon = "🦖";
                    break;
                case 2:
                    $icon = "🚀";
                    break;
                case 3:
                    $icon = "🪐";
                    break;
                case 4:
                    $icon = "♻️";
                    break;
                case 5:
                    $icon = "🧠";
                    break;
                case 6:
                    $icon = "👨‍👨‍👧";
                    break;
                case 7:
                    $icon = "😢";
                    break;
                default:
                    $icon = "◼";
            }


            if ($horario->turno == 'm')
                $horariosM .= $icon . " *" . strftime("%H:%M",strtotime($horario->hora)) . "* - " . $horario->tema->titulo . " - " . $horario->cantidad . " alumnos\\n\\n";
            if ($horario->turno == 't')
                $horariosT .= $icon . " *" . strftime("%H:%M",strtotime($horario->hora))  . "* - " . $horario->tema->titulo . " - " . $horario->cantidad . " alumnos\\n\\n";
            if ($horario->turno == 'n')
                $horariosN .= $icon . " *" . strftime("%H:%M",strtotime($horario->hora))  . "* - " . $horario->tema->titulo . " - " . $horario->cantidad . " alumnos\\n\\n";


            setlocale(LC_TIME, "spanish");

            $messaje = "👋¡Hola! Te adjuntamos el cronograma para el 🚀 *Planetario Móvil* en tu institución el día *";
            $messaje .= strftime('%A %d/%m/%Y' ,strtotime($this->servicio->fecha_ini_serv)) . "* \\n";
            if ($horariosM != "") {
                $messaje .= "\\n➖➖🕒 *Turno Mañana:* ➖➖➖ \\n";
                $messaje .= $horariosM;
            }
            if ($horariosT != "") {
                $messaje .= "\\n➖➖🕒 *Turno Tarde:*  ➖➖➖\\n";
                $messaje .= $horariosT;
            }
            if ($horariosN != "") {
                $messaje .= "\\n➖➖🕒 *Turno Noche:*  ➖➖➖\\n";
                $messaje .= $horariosN;
            }

            $messaje .= "\\n⚠ *A tener en cuenta:*\\n";
            $messaje .= "👉🏻 Los horarios detallados son para que el grupo que uds designen este formado en la puerta del planetario.\\n";
            $messaje .= "👉🏻 Nuestro personal tendra que ingresar al establecimiento una hora y media antes de la primer funcion para el armado.\\n";
            $messaje .= "👉🏻 Un día antes del evento nuestro personal se contactara con uds para coordinar el horario exacto de llegada.\\n";
        }

        $cel = $this->servicio->cel_cont_1;

        new simpleMensWpp($cel, $messaje);
    }
}
