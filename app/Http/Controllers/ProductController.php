<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    // Usando a inversão de dependência para injetar o ProductService
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // Listar todos os produtos
    public function index()
    {
        return response()->json($this->productService->getAll(), 200);
    }

    // Criar um novo produto
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer'
        ]);

        $product = $this->productService->create($data);

        return response()->json($product, 201);
    }

    // Atualizar um produto
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'price' => 'numeric',
            'quantity' => 'integer'
        ]);

        $this->productService->update($product, $data);

        return response()->json($product, 200);
    }

    // Deletar um produto
    public function destroy(Product $product)
    {
        $this->productService->delete($product);

        return response()->json(null, 204);
    }
}
