<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sensor;

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
            'tipo' => 'required'
        ]);
        Sensor::create($request->all());
        return response()->json(['mensagem' => 'Sensor cadastrado com sucesso'], 201);
    }

    public function show($id)
    {
    	$sensor = Sensor::find($id);
        if(!$sensor) 
        {
            return response()->json(['error' => 'Sensor não encontrado'], 404);
        }
        $data = ['data' => $sensor];
	    return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $sensor = $this->sensor->find($id);
        if(!$sensor) 
        {
            return response()->json(['error' => 'Sensor não encontrado'], 404);
        }
        $sensor->update($request->all());

        $return = ['data' => ['mensagem' => 'Produto atualizado com sucesso!']];
        return response()->json($return, 200);
    }
}
