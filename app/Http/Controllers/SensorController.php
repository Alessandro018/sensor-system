<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sensor;
use App\API\ApiError;

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
        return response()->json($this->sensor->paginate(6));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:2|max:30',
            'tipo' => 'required'
        ]);
        Sensor::create($request->all());
    }
}
