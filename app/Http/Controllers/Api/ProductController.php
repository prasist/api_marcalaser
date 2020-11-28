<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $queryBuilder = Product::query()
        ->with('images')
        ->with('categories')
        ->with('subcategories')
        ->with('colors');

        $params = $request->all();

        foreach ($params as $key => $value) {

            if ($key == "base_code" || $key == "base_code" || $key == "product_code") {

                $queryBuilder->where($key, $value);

            } elseif ($key == "product_title" || $key == "product_description") {

                $queryBuilder->where($key, 'like', '%' . $value . '%');

            } else {

                // Search over relationships
                if ($key == "category" || $key == "subcategory") {
                    $queryBuilder->orWhereHas(Str::plural($key), function($q) use ($key, $value)
                    {
                        $q->where($key, 'like', '%'. $value . '%');
                    });
                }
            }
        }

        //lad($queryBuilder->dd());

        return new ProductResource($queryBuilder->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
