<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductTag;
use App\Http\Controllers\ProductDetailController;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProductManagementController extends Controller
{
    public function index()
    {
        $out = array();
        $pdc = new ProductDetailController;
        $products = Product::where('enabled', '=', 1)->paginate(20);
        $out['links'] = $products->links();
        foreach ($products as $key => $product) {
            $img = $pdc->get_product_image($product);
            $out['products'][$key] = [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $product->quantity,
                'img' => $img
            ];
        }

        return view('layouts.product_management', $out);
    }

    public function create_product_from_template($p)
    {
        if ($p['id'] != '#') {
            $p['id'] = '/p/d/s?p=' . $p['id'] . '&m=p';
        }

        return '
              <div class="col-xs-6 col-sm-4 col-md-3">
                <div class="thumbnail">
                  <a href="' . $p["id"] . '">
                    <img src="' . asset($p["img"]) . '" alt="" />
                  </a>
                  <div class="caption">
                    <div class="bid-title">' . $p["name"] . '</div>
                    <!-- <div class="pull-left bid-time">Qty: ' . $p["quantity"] . '</div> -->
                  </div>
                </div>
              </div>
            ';
    }

    public function show_products(Request $request)
    {
        if ($request->p) {
            $out = array();
            $pdc = new ProductDetailController;
            $products_1 = Product::where('name', 'like', '%' . $request->p . '%')
                ->where('enabled', '=', 1)
                ->take(5)
                ->get();
            foreach ($products_1 as $key => $product) {
                $img = $pdc->get_product_image($product);
                $out['products'][$key] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $product->quantity,
                    'img' => $img
                ];
            }

            $products_2 = ProductTag::where('tag', 'like', '%' . $request->p . '%')
                ->take(5)
                ->get();
            foreach ($products_2 as $key => $product) {
                if ($product->product()->first()->enabled == 1) {
                    $img = $pdc->get_product_image($product->product()->first());
                    $out['products'][$key] = [
                        'id' => $product->product()->first()->id,
                        'name' => $product->product()->first()->name,
                        'quantity' => $product->product()->first()->quantity,
                        'img' => $img
                    ];
                }
            }
        } else {
            $out = array();
            $products_1 = Product::where('enabled', '=', 1)->get();
            foreach ($products_1 as $key => $product) {
                $img = $product->imgs()->first();
                if ($img) {
                    $img = 'product-imgs/' . $product->imgs()->first()->img;
                } else {
                    $img = 'img/' . 'no-image.png';
                }
                $out['products'][$key] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $product->quantity,
                    'img' => $img
                ];
            }
        }
        $products = '';

        if ($out) {
            foreach ($out['products'] as $key => $product) {
                $products = $products . $this::create_product_from_template([
                        'id' => $product["id"],
                        'img' => $product["img"],
                        'name' => $product["name"],
                        'quantity' => $product["quantity"]
                    ]);
            }

            return $products;
        } else {
            $products = $this::create_product_from_template([
                'id' => '#',
                'img' => 'img/no-image.png',
                'name' => 'No Product Found'
            ]);

            return $products;
        }
    }


    public function add_product(Request $request)
    {
        $product_name = $request->p;
        if ($product_name) {
            $p = Product::where('name', '=', $product_name)->first();
            if ($p) {
                return [0, 'Product name already exists in the database'];
            } else {
                $p = new Product;
                $p->name = $product_name;
                if ($p->save()) {
                    return [1, $p->name . ' successfully added.', '/p/d/s?p=' . $p->id . '&m=p'];
                }
            }
        } else {
            return [0, 'Product name cannot be blank'];
        }
    }
}
