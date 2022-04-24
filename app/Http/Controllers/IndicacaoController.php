<?php

namespace App\Http\Controllers;

use App\Models\Indicacao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\ResourceRegistrar;

class IndicacaoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $indicacoes = Indicacao::get();
        return response($indicacoes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $indicacao = new Indicacao();
        $request->validate($indicacao->rules());
        $indicacao->fill($request->all());

        $indicacao->save();

        return response()->json($indicacao);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $indicacao = Indicacao::find($id);
        return response()->json($indicacao);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $indicacao = Indicacao::find($id);
        $indicacao->fill($request->all());

        $indicacao->save();

        return response()->json($indicacao);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $indicacao = Indicacao::find($id);
        $indicacao->delete();
        return response()->json([], 200);
    }

    public function alterarSituacaoIndicacao($id) {
        $indicacao = Indicacao::find($id);
        $indicacao->alterarSituacao();
        return response()->json([], 200);
    }
}
