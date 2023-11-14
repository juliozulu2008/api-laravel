<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email|unique:clientes,email',
            'telefone' => 'nullable|string',
            // Adicione outras regras de validação conforme necessário
        ]);

        // Criação do novo cliente
        $cliente = Cliente::create([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            // Adicione outros campos conforme necessário
        ]);

        // Resposta JSON com o novo cliente criado
        return response()->json($cliente, 201); // 201 significa "Created"
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Recupera o cliente pelo ID
        $cliente = Cliente::findOrFail($id);

        // Retorna uma resposta JSON com os detalhes do cliente
        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validação dos dados recebidos
        $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email|unique:clientes,email,' . $id,
            'telefone' => 'nullable|string',
            // Adicione outras regras de validação conforme necessário
        ]);

        // Recupera o cliente pelo ID
        $cliente = Cliente::findOrFail($id);

        // Atualiza os dados do cliente
        $cliente->update([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            // Adicione outros campos conforme necessário
        ]);

        // Retorna uma resposta JSON com os detalhes do cliente atualizado
        return response()->json($cliente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recupera o cliente pelo ID
        $cliente = Cliente::findOrFail($id);

        // Exclui o cliente
        $cliente->delete();

        // Retorna uma resposta JSON indicando que o cliente foi excluído com sucesso
        return response()->json(['message' => 'Cliente excluído com sucesso']);
    }
}
