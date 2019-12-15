<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicao;

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
        $request->validate([
            'sensor_id' => 'required|integer',
            'valor' => 'required|integer',
            'data_horario' => 'required|date',
        ]);
        Medicao::create($request->all());
        return response()->json(['mensagem' => 'Medicao cadastrado com sucesso'], 201);
    }

    public function show($id)
    {
    	$medicao = Medicao::find($id);
        if(!$medicao) 
        {
            return response()->json(['data' => ['error' => 'Medicao não encontrado']], 404);
        }
        $data = ['data' => $medicao];
	    return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $medicao = $this->medicao->find($id);
        if(!$medicao) 
        {
            return response()->json(['data' => ['error' => 'Medicao não encontrado']], 404);
        }
        $medicao->update($request->all());

        $return = ['data' => ['mensagem' => 'Medicao atualizado com sucesso!']];
        return response()->json($return, 200);
    }

    public function destroy($id)
    {
        $medicao = $this->medicao->find($id);
        if(!$medicao) 
        {
            return response()->json(['data' => ['error' => 'Medicao não encontrado']], 404);
        }
        $medicao->delete();
        return response()->json(['data'=> ['mensagem' => 'Medicao excluído com sucesso']], 200);
    }
}
