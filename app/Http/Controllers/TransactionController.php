<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    public function kasir()
    {
        $products = Product::active()
            ->notDelete()
            ->where('product_qty', '>', 0)
            ->get()->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->product_name,
                    'price' => (int)$product->product_price,
                    'image' => $product->product_photo,
                    'qty' => (int)$product->product_qty,
                    'option' => '',
                ];
            });
        return view('kasir.kasir', compact('products'));
    }

    public function kasirPost(Request $request)
    {
        // return $request->all();
        $validation  = Validator::make($request->all(), [
            'cart' => 'required',
            'cash' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'change' => 'required|numeric|min:0',
            'order_code' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation)
                ->withInput();
        }

        $cart = json_decode($request->cart, true);

        // $latestIdOrder = Order::max('id') + 1;
        $order = Order::create([
            'order_code' => $request->order_code,
            'order_date' => now(),
            'order_amount' => $request->total,
            'order_change' =>  $request->change,
            'order_status' =>  1,
            'customer_name' => "John Doe",
        ]);

        foreach ($cart as $item) {
            $product = Product::find($item['productId']);
            if ($product) {
                $product->product_qty -= $item['qty'];
                $product->save();
            }

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['productId'],
                'qty' => $item['qty'],
                'order_price' => $item['price'],
                'order_subtotal' => $item['qty'] * $item['price'],
            ]);
        }

        Alert::success('Success', 'Transaction successful');
        return redirect()->route('kasir');
    }


    // private function generateOrderCode($orderId)
    // {
    //     $prefix = 'POS';
    //     $date = now()->format('Ymd');

    //     return "{$prefix}-{$date}-" . str_pad($orderId, 6, '0', STR_PAD_LEFT);
    // }

    public function report()
    {
        // orderBy('category_name', 'asc')
        $orders = Order::orderBy('order_date', 'desc')->get();
        // return $orders;
        return view('pimpinan.laporan', compact('orders'));
    }

    public function reportDetail(string $id)
    {
        $order = Order::with('orderDetails.product')->findOrFail($id);
        // return $order;
        return view('pimpinan.detail-laporan', compact('order'));
    }

    public function print()
    {
        $orders = Order::get();
        return view('report.print', compact('orders'));
    }


}
