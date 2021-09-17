<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Product;
use App\Models\Merchant;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\MerchantResource;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->except('index')
        ;
    }

    public function getMerchantProducts()
    {
        return ProductResource::collection(auth()->user()->merchant->products);
    }

    public function index()
    {
        return ProductResource::collection(Product::latest()->get());
    }

    public function store(ProductRequest $request, Merchant $merchant)
    {
        if(auth()->user()->isNot($merchant->user)){
            abort(403);
        }

        DB::beginTransaction();
        try {
            $product = auth()->user()->merchant->products()->create($request->validated());
            DB::commit();
            return response()->json([
                'message' => "{$product->name} product is created"
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        DB::beginTransaction();
        try {
            $update = $product->update($request->validated());
            DB::commit();
            return response()->json([
                'message' => "{$product->name} product is updated"
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        DB::beginTransaction();
        try {
            $product->delete();
            DB::commit();
            return response()->json([
                'message' => "{$product->name} product is created"
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
            ], 200);
        }
    }

}
