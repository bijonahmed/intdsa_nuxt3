<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Categorys;
use Illuminate\Http\Request;
use App\Models\Product;
//use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use Validator;
use App\Models\OrderStatus;
use App\Models\OrderHistory;
use App\Models\ProductCategory;
use App\Models\CategoryCommissionHistory;
use App\Models\Mystore;
use App\Models\MystoreHistory;
use App\Models\WishList;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class OrderController extends Controller
{

    protected $userid;
    protected $email;
    public function __construct()
    {
        $this->middleware('auth:api');
        $id = auth('api')->user();
        if (!empty($id)) {
            $user = User::find($id->id);
            $this->userid = $user->id;
            $this->email = $user->email;
        }
    }

    public function orderlist()
    {

        $customTimeZone = 'Asia/Dhaka';
        $startTime = Carbon::now($customTimeZone);
        $currentHour = $startTime->hour;
        //echo $currentHour;exit; 
        // Get the current datetime in the custom time zone
        $currentTime = Carbon::now($customTimeZone);
        // Add 8 hours to the current datetime
        $currentTime->addHours(10);
        // Format the datetime as needed
        $currentTimeFormatted = $currentTime->format('Y-m-d H:i:s');

       // echo "Current Time in $customTimeZone after adding 3 hours: $currentTimeFormatted";
        $response       = app('App\Http\Controllers\Dropshipping\DropUserController')->getCurrentBalance();
        $currentBalance = $response instanceof JsonResponse ? $response->getData(true)['currentbalance'] : 0;
        // Define the current date
        $current_date   = date("Y-m-d");

        // Query Mystore to find stores where the end_date is on or after the current date
        $active_stores  = MystoreHistory::where('end_date', '>=', $current_date)->where('user_id', $this->userid)->get();
        $amount         = $currentBalance * 2;
        $min_price      = 0;
        $max_price      = $amount;
        // Output the results
        if ($active_stores->isNotEmpty()) {
            $productsArr = [];
            foreach ($active_stores as $store) {
                //echo "My Store ID: " . $store->mystore_id . ": CategoryID:". $store->category_id. " - End Date: " . $store->end_date . "\n";
                $category_id = $store->category_id;
                $pro_category = ProductCategory::where('category_id', $category_id)->pluck('product_id')->toArray();
                //Start Logic
                if (!empty($pro_category)) {
                    $products_in_range = Product::whereIn('id', $pro_category)
                        ->whereBetween('selling_price', [$min_price, $max_price])
                        ->select('id', 'name', 'selling_price', 'thumnail_img', 'profit', 'buying_price')
                        ->get();
                    // Loop through the products and populate the array
                    foreach ($products_in_range as $pro_row) {

                        //$startTime      = date('Y-m-d H:i:s');
                        //       $order_end_time = date('Y-m-d H:i:s',strtotime('+10 hour',strtotime($startTime)));
                        $productsArr[] = [
                            'product_id'        => $pro_row->id,
                            'product_name'      => $pro_row->name,
                            'selling_price'     => $pro_row->selling_price,
                            'order_date'        => date("Y-m-d"),
                            'created_at'        =>  $startTime,
                            'order_inactive_time'=>  $currentTimeFormatted,
                            'profit'            => $pro_row->profit,
                            'user_id'           => $this->userid,
                            'orderId'           => $this->generateUniqueRandomNumber(),
                            'product_qty'       => 1,
                            'buying_price'      => $pro_row->buying_price,
                            'user_balance'      => $currentBalance,
                            'user_mul_balance'  => $amount,
                            'order_status'      => 1, //To be paid.
                            'thumnail_img'      => !empty($pro_row->thumnail_img) ? url($pro_row->thumnail_img) : "",
                        ];
                    }
                }
                //END Logic
            }

            //dd($productsArr);
            // Insert multiple records into the database
            if (!empty($productsArr)) {
                $existingOrder = Order::where('user_id', $this->userid)
                    ->whereDate('order_date', $current_date)
                    ->first();
                if (!$existingOrder) {
                    // If no existing order found, proceed with the insertion
                    Order::insert($productsArr);
                }
            }
            $productsArr = Order::where('user_id', $this->userid)
                        ->where('order_date', $current_date)
                        ->where('status', 1)
                        ->whereRaw("HOUR(order_inactive_time) > ?", [$currentHour])->get();
            // dd($productsArr);
            $data['product_count'] = count($productsArr);
            $data['products']      = $productsArr;
            return response()->json($data, 200);
        } else {
            //echo "No active stores found.";
            return response()->json("No active stores found", 200);
        }
    }

    public function save_order(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'           => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = array(
            'name'        => $request->name,
            'description' => $request->description,
        );
        if (empty($request->id)) {
            OrderStatus::insertGetId($data);
        } else {
            OrderStatus::where('id', $request->id)->update($data);
        }

        $response = [
            'data' => $data,
            'message' => 'success'
        ];
        return response()->json($response, 200);
    }


    function generateUniqueRandomNumber($length = 5)
    {
        do {
            $randomNumber = mt_rand(pow(10, $length - 1), pow(10, $length) - 1);
        } while (Order::where('id', $randomNumber)->exists());

        return $randomNumber;
    }


    public function orderDetails($order_id)
    {

        $orderStatus     = orderStatus::all();
        $findorder       = Order::join('order_status', 'order_status.id', '=', 'orders.order_status')->select('orders.*', 'order_status.name as orderstatus', 'order_status.id as orderstatus_id')->where('orderId', $order_id)->first();
        $data['orders']  = OrderHistory::join('product', 'product.id', '=', 'order_history.product_id')
            ->select('product.name as product_name', 'product.thumnail_img', 'order_history.*')
            ->where('order_id', $findorder->id)->get();
        foreach ($data['orders'] as $v) {
            $orders[] = [
                'product_name'    => $v->product_name,
                'thumbnail_img'   => url($v->thumnail_img),
                'quantity'        => $v->quantity,
                'price'           => $v->price,
                'total'           => $v->quantity * $v->price,
            ];
        }

        $findCustomer = User::where('id', $findorder->customer_id)->first();
        $order['customername']  = !empty($findCustomer->name) ? $findCustomer->name : "";
        $order['customeremail'] = !empty($findCustomer->email) ? $findCustomer->email : "";
        $order['orderdata']     = $orders;
        $order['orderrow']      = !empty($findorder->orderstatus) ? $findorder->orderstatus : "";
        $order['order_status']  = !empty($findorder->order_status) ? $findorder->order_status : "";
        $order['orderstatus_id'] = !empty($findorder->orderstatus_id) ? $findorder->orderstatus_id : "";
        $order['orderData']     = !empty($findorder) ? $findorder : "";
        $order['OrderStatus']   = $orderStatus;
        // dd($order['order_status']);
        return response()->json($order, 200);
    }

    public function allOrders()
    {

        $data['orders']  = Order::join('order_status', 'orders.order_status', '=', 'order_status.id')
            ->select('orders.*', 'order_status.name')
            ->where('orders.customer_id', $this->userid)
            ->orderBy('created_at', 'desc')
            ->get(); //Order::where('customer_id', $this->userid)->get();
        foreach ($data['orders'] as $v) {
            $orders[] = [
                'name'         => $v->name,
                'orderId'      => $v->orderId,
                'placeOn'      => date_format(date_create($v->created_at), "Y-m-d"),
                'total'        => number_format($v->total, 2),
            ];
        }

        $order['orderdata']      = $orders;

        return response()->json($order, 200);
    }
}
