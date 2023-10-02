<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use Ramsey\Collection\Collection;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $product = Product::create($request->only('title', 'description', 'image', 'price'));

        return response($product, Response::HTTP_CREATED);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->only('title', 'description', 'image', 'price'));

        return response($product, Response::HTTP_ACCEPTED);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function frontend()
    {
        if ($products = \Cache::get('products_frontend')) {
            return $products;
        }

        sleep(2);
        $products = Product::all();
        \Cache::set('products_frontend', $products, 30 * 60); //30 min

        return $products;
    }

    public function backend(Request $request)
    {
        $page = $request->input('page', 1);
        $products = \Cache::remember('products_backend', 30 * 60, fn() => Product::all());
        $total = $products->count();

        /** @var Collection $products */
        return [
            'data' => $products->forPage($page, 9),
            'meta' => [
                'total' => $total,
                'page' => $page,
                'last_page' => ceil($total / 9),
            ]
        ];
    }

}
