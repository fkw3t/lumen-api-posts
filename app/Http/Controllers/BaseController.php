<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected object $class;

    public function index()
    {
        return response()->json($this->class->get(), 201);
    }

    public function get(int $id)
    {
        $issetClass = $this->class::find($id);
        if($issetClass)
        {
            return response()->json($this->class->get(), 201);
        }
        else
        {
            return response()->json(['error' => 'Recurso não encontrado'], 204);
        }
    }

    public function store(Request $request)
    {
        return response()->json($this->class::create([$request->all]), 201);
    }

    public function update(Request $request, int $id)
    {
        $issetClass = $this->class::find($id);
        if($issetClass)
        {
            $this->class->fill($request->all());
            $this->class->save();
            
            return response()->json($this->class, 200);
        }
        else
        {
            return response()->json(['error' => 'Recurso não encontrado'], 204);
        }

    }

    public function destroy(int $id)
    {
        $qtdRecursosRemovidos = $this->class::destroy($id);
        if($qtdRecursosRemovidos === 0)
        {
            return response()->json(['error' => 'Recurso não encontrado'], 404);
        }
        return response()->json(['msg' => 'Recurso removido'], 204);
    }

}

