<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sensor;
use Illuminate\Validation\Rule;

class SensorController extends Controller
{
    private $sensor;
	public function __construct(Sensor $sensor)
	{
		$this->sensor = $sensor;
    }
    
    public function index()
    {
        $sensor = Sensor::all();
        return response()->json($this->sensor->paginate(6), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:2|max:30',
            'tipo' => ['required',
                Rule::in(['temperatura', 'luminosidade', 'presença', 'magnético']),
            ]
        ]);
        Sensor::create($request->all());
        return response()->json(['data' => ['mensagem' => 'Sensor cadastrado com sucesso']], 201);
    }

    public function show($id)
    {
    	$sensor = Sensor::find($id);
        if(!$sensor) 
        {
            return response()->json(['data' => ['error' => 'Sensor não encontrado']], 404);
        }
        $data = ['data' => $sensor];
	    return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|min:2|max:30',
            'tipo' => ['required',
                Rule::in(['temperatura', 'luminosidade', 'presença', 'magnético']),
            ]
        ]);
        $sensor = $this->sensor->find($id);
        if(!$sensor) 
        {
            return response()->json(['data' => ['error' => 'Sensor não encontrado']], 404);
        }
        $sensor->update($request->all());

        $return = ['data' => ['mensagem' => 'Sensor atualizado com sucesso']];
        return response()->json($return, 200);
    }

    public function destroy($id)
    {
        $sensor = $this->sensor->find($id);
        if(!$sensor) 
        {
            return response()->json(['data' => ['error' => 'Sensor não encontrado']], 404);
        }
        $sensor->delete();
        return response()->json(['data'=> ['mensagem' => 'Sensor excluído com sucesso']], 200);
    }
}
