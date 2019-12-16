<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicao;
use App\Sensor;

class MedicaoController extends Controller
{
    private $medicao;
	public function __construct(Medicao $medicao)
	{
		$this->medicao = $medicao;
    }
    
    public function index()
    {
        $medicao = Medicao::all();
        return response()->json($this->medicao->paginate(6), 200);
    }

    public function store(Request $request)
    {
        $sensor = Sensor::find($request->sensor_id);
        if(!empty($sensor)){
            if($sensor->tipo == 'temperatura'){
                $request->validate([
                    'sensor_id' => 'required|integer',
                    'valor' => 'required|integer|min:-100|max:100',
                    'data_horario' => 'required|date',
                ]);

                Medicao::create($request->all());
                return response()->json(['mensagem' => 'Medicao cadastrado com sucesso'], 201);
            }elseif($sensor->tipo == 'luminosidade'){
                $request->validate([
                    'sensor_id' => 'required|integer',
                    'valor' => 'required|integer|min:0|max:100',
                    'data_horario' => 'required|date',
                ]);

                Medicao::create($request->all());
                return response()->json(['mensagem' => 'Medicao cadastrado com sucesso'], 201);
            }elseif($sensor->tipo == 'presença'){
                $request->validate([
                    'sensor_id' => 'required|integer',
                    'valor' => 'required|integer|min:0|max:1',
                    'data_horario' => 'required|date',
                ]);

                Medicao::create($request->all());
                return response()->json(['mensagem' => 'Medicao cadastrado com sucesso'], 201);
            }elseif($sensor->tipo == 'magnético'){
                $request->validate([
                    'sensor_id' => 'required|integer',
                    'valor' => 'required|integer|min:0|max:1',
                    'data_horario' => 'required|date',
                ]);

                Medicao::create($request->all());
                return response()->json(['mensagem' => 'Medicao cadastrado com sucesso'], 201);
            }
                
        }else{
            return response()->json(['data' => ['error' => 'sensor não encontrado']], 404);
        }

    }

    public function show($id)
    {
    	$medicao = Medicao::find($id);
        if(!$medicao) 
        {
            return response()->json(['data' => ['error' => 'Medicão não encontrado']], 404);
        }
        $data = ['data' => $medicao];
	    return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $medicao = $this->medicao->find($id);
        if(!$medicao) 
        {
            return response()->json(['data' => ['error' => 'Medicão não encontrado']], 404);
        }
        $medicao->update($request->all());

        $return = ['data' => ['mensagem' => 'Medicão atualizado com sucesso!']];
        return response()->json($return, 200);
    }

    public function destroy($id)
    {
        $medicao = $this->medicao->find($id);
        if(!$medicao) 
        {
            return response()->json(['data' => ['error' => 'Medicão não encontrado']], 404);
        }
        $medicao->delete();
        return response()->json(['data'=> ['mensagem' => 'Medicão excluído com sucesso']], 200);
    }
}
