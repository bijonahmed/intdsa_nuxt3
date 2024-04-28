<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
//use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Session;
use Cart;

class CartController extends Controller
{

    function encryptData($data, $key, $iv)
    {
        return openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
    }

    // Function to decrypt data with AES-256-CBC
    function decryptData($encryptedData, $key, $iv)
    {
        return openssl_decrypt($encryptedData, 'AES-256-CBC', $key, 0, $iv);
    }

    public function payment(Request $request)
    {
     
        // The payment API endpoint URL
        $apiUrl = 'https://api.tusdtapi.com/v1/CreateOrder';

        // Your API key
        $apiKey = '5ERm6hJidXoGE6rXQsf9F';

        // Data to send to the API
        $data = array(
            "address" => "TVShVcCdEF8MQnc8Pmn9PgUxokr2QC4hxi",
            "app_name" => "商户端产品名称",
            "attach" => "附加参数",
            "cashier_qrcode" => "https://panel.tusdtapi.com/api/qrcode?order_no=1687782852OD0B74A502FBB36525",
            "cashier_url" => "https://panel.tusdtapi.com/api/cashier?order_no=1687782852OD0B74A502FBB36525",
            "currency_rate" => 7.232,
            "currency_type" => "CNY",
            "expire_time" => 111111111,
            "legal_tender_money" => 100,
            "locale" => "zh",
            "order_money" => 13.827,
            "order_no" => "1687782852OD0B74A502FBB36525",
            "order_timestamp" => 11111111,
            "out_order_no" => "201710192541",
            "pay_money" => 13.827,
            "pay_status" => 1,
            "pay_type" => "USDT"
        );

        // Convert the data to JSON
        $jsonData = json_encode($data);

        // Initialize a CURL session
        $ch = curl_init();

        // Set CURL options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'T-API-KEY: ' . $apiKey, // Add your API key to the request header
            'Content-Type: application/json' // Specify the content type as JSON
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Get the response

        // Execute the CURL request
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // If there's a CURL error, output it
            echo 'CURL Error: ' . curl_error($ch);
        } else {
            // If no error, output the API response
            echo 'API Response: ' . $response;
        }

        // Close the CURL session
        curl_close($ch);
    }


    public function index()
    {

        Cart::add(459, 'Sample Item-5', 100.99, 2, array());
        $cartItems = \Cart::getContent();
        return response()->json(['cartItems' => $cartItems]);
        //return response()->json($cartItems, 200);
        dd($cartItems);
        // return view('cart.index', compact('cartItems'));
    }

    public function getCartData()
    {
        $cartContent = \Cart::getContent();
        dd($cartContent);
        return response()->json(['cartItems' => $cartContent]);
    }

    public function addToCart(Request $request)
    {

        $productId =  $request->product_id;
        $product   = Product::find($productId);

        \Cart::add($productId, $product->name, $product->price, 1);
        $cartContent = \Cart::getContent()->toArray();
        return response()->json(['cartItems' => $cartContent]);
        exit;
        //return response()->json(['message' => 'Item added to cart']);

        exit;
        //Cart::add(464, 'Sample Item-4', 100.99, 2, array());
        \Cart::add([
            'id' => 1,
            'name' => 'Product Name',
            'price' => 19.99,
            'quantity' => 1,
        ]);

        $cartCollection = \Cart::getContent();
        dd($cartCollection);
        //dd($request->all());
        //add to cart
        $productId = $request->product_id;
        $product   = Product::find($productId);
        Cart::add($product->id, $product->name, $product->price, 2, array());
        // Cart::add([
        //     'id'       => $product->id,
        //     'name'     => $product->name,
        //     'price'    => $product->price,
        //     'quantity'      => 1
        // ]);
        return response()->json('Item has been add to your cart!', 200);

        //return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart!');
    }

    public function removeFromCart($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('cart.index')->with('success_message', 'Item has been removed from your cart!');
    }

    public function updateCart($rowId)
    {
        Cart::update($rowId, request()->quantity);
        return redirect()->route('cart.index')->with('success_message', 'Cart has been updated!');
    }

    public function clearCart()
    {
        Cart::destroy();
        return response()->json("Your cart has been cleared!", 200);
        //return redirect()->route('cart.index')->with('success_message', 'Your cart has been cleared!');
    }
}
