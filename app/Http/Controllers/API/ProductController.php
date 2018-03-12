<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->all();
        return response()->json(['data' => $products]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validate = validator($data, $this->product->rules());

        if ($validate->fails()){
            $message = $validate->messages();

            return response()->json(['validade.error' => $message]);
        }


        if (!$insert = $this->product->create($data))
            return response()->json(['error' => 'Error_insert'], 500);


        return response()->json(['result' => $insert]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$product = $this->product->find($id))
            return response()->json(['error' => 'product_not_found']);

        return response()->json(['data' => $product]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validate = validator($data, $this->product->rules($id));

        if ($validate->fails()){
            $message = $validate->messages();

            return response()->json(['validade.error' => $message]);
        }

        if (!$product = $this->product->find($id))
            return response()->json(['error' => 'product_not_found']);

        if (!$update = $product->update($data))
            return response()->json(['error' => 'product_not_update', 500]);

        return response()->json(['response' => $update]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$product = $this->product->find($id))
            return response()->json(['error' => 'product_not_found']);

        if (!$destroy = $product->delete())
            return response()->json(['error' => 'product_not_destroy', 500]);

        return response()->json(['response' => $destroy]);


    }
}
