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
                            'order_inactive_time' =>  $currentTimeFormatted,
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
            /*
            if (!empty($productsArr)) {
                $existingOrder = Order::where('user_id', $this->userid)
                    ->whereDate('order_date', $current_date)
                    ->first();
                if (!$existingOrder) {
                    // If no existing order found, proceed with the insertion
                    Order::insert($productsArr);
                }
            }
            */
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

    public function assignOrder(Request $request)
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

        // Define the current date
        $current_date   = date("Y-m-d");

        // Query Mystore to find stores where the end_date is on or after the current date
        $active_stores  = MystoreHistory::where('end_date', '>=', $current_date)->get();

        $min_price      = 0;
        // Output the results
        if ($active_stores->isNotEmpty()) {
            $productsArr = [];
            foreach ($active_stores as $store) {

                $response       = app('App\Http\Controllers\Dropshipping\DropUserController')->getCurrentBalanceCheckAdminIndivUser($store->user_id);
                $currentBalance = $response instanceof JsonResponse ? $response->getData(true)['currentbalance'] : 0;
                $amount         = $currentBalance * 2;
                $max_price      = $amount;

                //echo "My Store ID: " . $store->mystore_id . ": CategoryID:". $store->category_id. " - End Date: " . $store->end_date . "\n";
                $category_id = $store->category_id;
                $user_id = $store->user_id;
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
                            'order_inactive_time' =>  $currentTimeFormatted,
                            'profit'            => $pro_row->profit,
                            'user_id'           => $user_id,
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

            //  dd($productsArr);
            // Insert multiple records into the database
            if (!empty($productsArr)) {
                $existingOrder = Order::whereDate('order_date', $current_date)->first();
                if (!$existingOrder) {
                    // If no existing order found, proceed with the insertion
                    Order::insert($productsArr);
                }
            }
            $productsArr = Order::where('user_id', $this->userid)
                ->where('order_date', $current_date)
                ->where('status', 1)->get();
            // dd($productsArr);
            $data['product_count'] = count($productsArr);
            $data['products']      = $productsArr;
            return response()->json($data, 200);
        } else {
            //echo "No active stores found.";
            return response()->json("No active stores found", 200);
        }
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

    public function filterOrderList(Request $request)
    {

        // Get search query from the request
        $page = $request->input('page', 1);
        $pageSize = $request->input('pageSize', 10);

        $searchUserEmail    = $request->searchUserEmail;
        $searchOrderId      = $request->searchOrderId;
        $startDate          = $request->startDate;
        $endDate            = $request->endDate;
        $selectedStatus     = $request->selectedStatus;

        // dd($selectedFilter);
        $query = Order::orderBy('orders.id', 'desc')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.order_date', 'orders.order_status', 'orders.id', 'orders.orderId', 'orders.product_name', 'orders.buying_price as costing_price', 'orders.profit', 'users.name as username', 'users.telegram', 'users.phone_number', 'users.whtsapp', 'users.email', 'orders.selling_price');

        if ($searchUserEmail !== null) {
            $query->where('users.email', 'like', '%' . $searchUserEmail . '%');
            //$query->where('users.email', $searchUserEmail);
        }

        if ($searchOrderId !== null) {
            $query->where('orders.orderId', 'like', '%' . $searchOrderId . '%');
            //$query->where('users.email', $searchOrderId);
        }

        if ($selectedStatus !== null) {
            $query->where('orders.order_status', $selectedStatus);
        }

        // Apply date range filtering if start and end dates are provided
        if ($startDate !== null && $endDate !== null) {
            $query->whereBetween('orders.order_date', [$startDate, $endDate]);
        }

        // $query->where('users.role_id', 2);
        $paginator = $query->paginate($pageSize, ['*'], 'page', $page);

        $modifiedCollection = $paginator->getCollection()->map(function ($item) {

            $checkOrStatus  = OrderStatus::where('id', $item->order_status)->first();
            $telegram       = !empty($item->telegram) ? $item->telegram : "None";
            $phone          = !empty($item->phone_number) ? $item->phone_number : "";
            $whtsapp        = !empty($item->whtsapp) ? $item->whtsapp : "None";

            return [
                'id'            => $item->id,
                'orderId'       => $item->orderId,
                'product_name'  => $item->product_name,
                'userInfo_1'    => $item->username,
                'userInfo_2'    => $phone,
                'userInfo_3'    => $item->email,
                'userInfo_4'    => $telegram,
                'userInfo_5'    => $whtsapp,
                'order_date'    => date("Y-M-d", strtotime($item->order_date)),
                'selling_price' => $item->selling_price,
                'costing_price' => $item->costing_price,
                'profit'        => number_format($item->profit, 2),
                'status'        => !empty($checkOrStatus) ? $checkOrStatus->name : "",
            ];
        });

        // Return the modified collection along with pagination metadata
        return response()->json([
            'data' => $modifiedCollection,
            'current_page' => $paginator->currentPage(),
            'total_pages' => $paginator->lastPage(),
            'total_records' => $paginator->total(),
        ], 200);
    }


    public function updateOrder(Request $request){


        $order_id               = $request->order_id; 
        $data['order_status']   = (int)$request->selectedStatus;
        $data['status']         = (int)$request->status;
        Order::where('orderId', $order_id)->update($data);

        return response()->json("Update successfully", 200);

    }

    public function getOrderStatus()
    {
        $status  = OrderStatus::where('status', 1)->get();
        return response()->json($status, 200);
    }
}
