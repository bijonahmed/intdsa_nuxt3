<?php

namespace App\Http\Controllers\Dropshipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Helper;
use App\Models\Holiday;
use App\Models\User;
use App\Models\ManualAdjustment;
use App\Models\ProductAttributeValue;
use App\Models\ProductVarrientHistory;
use App\Models\Categorys;
use App\Models\ProductAttributes;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductAdditionalImg;
use App\Models\ProductVarrient;
use App\Models\AttributeValues;
use App\Models\CurrencyType;
use App\Models\Deposit;
use App\Models\ExpenseHistory;
use App\Models\MakeBank;
use App\Models\Order;
use App\Models\Withdraw;
use App\Models\Setting;
use Illuminate\Support\Str;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\MystoreHistory;
use Session;
use DB;
use Curl\Curl;

class DropUserController extends Controller
{
    protected $userid;
    public function __construct()
    {
        $this->middleware('auth:api');
        $id = auth('api')->user();
        $user = User::find($id->id);
        $this->userid = $user->id;
    }


    public function report(){


        $currentMonthStart = Carbon::now()->startOfMonth();  // First day of the current month
        $currentMonthEnd   = Carbon::now()->endOfMonth();  // Last day of the current month

        $lastMonthStart    = Carbon::now()->subMonth()->startOfMonth(); // First day of last month
        $lastMonthEnd      = Carbon::now()->subMonth()->endOfMonth(); // Last day of last month


        $chkPendingOrderStatus    = Order::where('user_id',$this->userid)->whereIn('order_status',[2,3,4,5])->count();
        $availableBalatransection = Order::where('user_id',$this->userid)->whereIn('order_status',[2,3,4,5])->sum('buying_price');
        $numberOfComplatation     = Order::where('user_id',$this->userid)->whereIn('order_status',[6])->count();




        $currentMonth             = Order::where('user_id', $this->userid)
                                    ->whereBetween('order_date', [$currentMonthStart, $currentMonthEnd]) // Orders within current month
                                    ->whereIn('order_status', [2, 3, 4, 5, 6]) // Specific statuses
                                    ->count();  // Get the total count of such orders 

        $lastMonthOrders          = Order::where('user_id', $this->userid)
                                    ->whereBetween('order_date', [$lastMonthStart, $lastMonthEnd]) // Orders from last month
                                    ->whereIn('order_status', [2, 3, 4, 5, 6]) // Specific statuses
                                    ->count(); // Get all matching orders


        $totalSale               = Order::where('user_id', $this->userid)
                                 ->whereIn('order_status', [2, 3, 4, 5, 6]) // Specific statuses
                                 ->sum('selling_price'); // Get all matching orders

        //Total Seles 
        $toalSalescurrentMonth  = Order::where('user_id', $this->userid)
                                 ->whereBetween('order_date', [$currentMonthStart, $currentMonthEnd]) // Orders within current month
                                 ->whereIn('order_status', [2, 3, 4, 5, 6]) // Specific statuses
                                 ->sum('selling_price');  // Get the total count of such orders 


        $toalSaleslastMonth       = Order::where('user_id', $this->userid)
                                    ->whereBetween('order_date', [$lastMonthStart, $lastMonthEnd]) // Orders from last month
                                    ->whereIn('order_status', [2, 3, 4, 5, 6]) // Specific statuses
                                    ->sum('selling_price');  // Get all matching orders

   
        $data['pendingOrders']  = $chkPendingOrderStatus;
        $data['currentMonth']   = $currentMonth;
        $data['lastMonthOrders']= $lastMonthOrders;
        $data['totalSale']      = number_format($totalSale,2);

        $data['toalSalescurrentMonth']     = number_format($toalSalescurrentMonth,2);
        $data['toalSaleslastMonth']        = number_format($toalSaleslastMonth,2);
        $data['availableBalatransection']  = number_format($availableBalatransection,2);
        $data['numberOfComplatation']      = $numberOfComplatation;

        return response()->json($data, 200);

    }



    public function checkWithdrawalMethod()
    {
        try {
            // $data = MakeBank::where('user_id',$this->userid)->first();
            // return response()->json(
            //     ['data'=> $data], 200);
            $data = MakeBank::join('users', 'withdrawal_method.user_id', '=', 'users.id')
                ->where('users.id', $this->userid)
                ->select('withdrawal_method.*', 'users.name') // Select columns from both tables
                ->get();

            return response()->json(['data' => $data], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error occurred.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    public function chkfindWithdraInfo()
    {

        $data = MakeBank::where('user_id', $this->userid)->get();
        return response()->json(['data' => $data], 200);
    }

    public function getCurrencyType()
    {

        try {
            $query = CurrencyType::orderBy('id', 'desc')->get();
            $chkBank = MakeBank::where('user_id', $this->userid)->first();
            return response()->json(
                [
                    'data'          => $query,
                    'chkWallet'     => !empty($chkBank->wallet_address) ? $chkBank->wallet_address : "",
                ],
                200
            );
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error occurred.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    public function depositRequest(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'depsoitAmount'  => 'required|numeric',
                'payment_method' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }


            $generateID = "D" . date("Y") . $this->generateUnique4DigitNumber();

            $data = array(
                'depositID'      => $generateID,
                'depscription'   => $generateID,
                'deposit_amount' => $request->depsoitAmount,
                'payment_method' => $request->payment_method,
                'status'         => 0,
                'user_id'        => $this->userid
            );
            $insert_id = Deposit::insertGetId($data);
            

            $merchant_no     = "3090032";
            $merchant_key     = "f82b830d09bc92f726b71066be300c50";
            $api_domain     = "http://127.0.0.1:8000/";


            $amount = $request->depsoitAmount; ///"10";
            $product = "USDT-TRC20Deposit";
            $params = array(
                'merchant_ref'      => $generateID,
                'product'           => $product,
                'amount'            => $amount,
            );
            $params_json = json_encode($params, 320);
            $data = array(
                'merchant_no'       => $merchant_no,
                'timestamp'         => time(),
                'sign_type'         => 'MD5',
                'params'            => $params_json,
            );
            //strtotime("Day")
            $data['sign'] = $this->get_sign($data, $merchant_key); //MD5签名 不区分大小写
            $payurl = "";
            $response = $this->http("https://api.dppay.vip/api/gateway/pay", 'POST', $data);
            $result = json_decode($response, true);
            $code = isset($result['code']) ? $result['code'] : 404;
            $message = isset($result['message']) ? $result['message'] : 'errorMsg:' . (string)$response;
            if ($code == 200) {
                $params = json_decode($result['params'], true);
                $payurl = isset($params['payurl']) ? $params['payurl'] : '';

                return response()->json($params);
            } else {
                exit('下单失败，返回错误信息：' . $message);
            }

            

            return response()->json("Last insert ID: $insert_id");
        } catch (QueryException $e) {
            // Log the error or handle it as needed
            return response()->json(['error' => 'Database error occurred.'], 500);
        } catch (\Exception $e) {
            // Handle other exceptions
            print_R($e);
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }


     

    //签名 signature
    public function get_sign($data = array(), $key = '')
    {
        $merchant_no = isset($data['merchant_no']) ? $data['merchant_no'] : '';
        $params = isset($data['params']) ? $data['params'] : '';
        $sign_type = isset($data['sign_type']) ? $data['sign_type'] : '';
        $timestamp = isset($data['timestamp']) ? $data['timestamp'] : '';
        $sign_str = $merchant_no . $params . $sign_type . $timestamp . $key;
        $sign = md5($sign_str);
        return $sign;
    }
    public function http($url = '', $method = 'POST', $postData = array(), $header = array())
    {
        //echo $url; exit; 
        $data = '';
        if (!empty($url)) {
            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url );
                //curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30); //30秒超时
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书  
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名
                if ($header) {
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                }
                if (strtoupper($method) == 'POST') {
                    $curlPost = is_array($postData) ? http_build_query($postData) : $postData;
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
                }
                $data = curl_exec($ch);
                curl_close($ch);
            } catch (Exception $e) {
                $data = '';
            }
        }
        return $data;
    }

    public function updateMakeBank(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'id'  => 'required|numeric',
                'currency_type_id'  => 'required|numeric',
                'wallet_address' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $existingRecord = MakeBank::where('id', $request->id)->where('user_id', $this->userid)->first();

            if ($existingRecord) {
                // Update existing record
                $existingRecord->update([
                    'currency_type_id' => $request->currency_type_id,
                    'wallet_address'   => $request->wallet_address
                ]);
                $response = $existingRecord->id; // Assuming you need to return the ID
                return response()->json($response);
            }
        } catch (QueryException $e) {
            // Log the error or handle it as needed
            return response()->json(['error' => 'Database error occurred.'], 500);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    public function makeBank(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'currency_type_id'  => 'required|numeric',
            'wallet_address' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = array(
            'currency_type_id' => $request->currency_type_id,
            'wallet_address'   => $request->wallet_address,
            'user_id'          => $this->userid
        );
        $resonse = MakeBank::insertGetId($data);
        return response()->json($resonse);
    }

    public function withdrawRequest(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'withdraw_amount'  => 'required|numeric',
                'bank_card'        => 'required',
                'payable_amount'   => 'required',
                'password'         => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $chkDeposit = Deposit::where('id', $this->userid)->first();
            $depositAmt = !empty($chkDeposit) ? $chkDeposit->deposit_amount : 0;
            $chkSetting = Setting::find(1);
            $generateID = "W" . date("Y") . $this->generateUnique4DigitNumber();
            $withAmt    = !empty($chkSetting->withdraw_minimum_amount) ? $chkSetting->withdraw_minimum_amount : 0;
            $withMethod = MakeBank::where('user_id', $this->userid)->first();
            if ($request->withdraw_amount > $withAmt) {
                //condition is true
                if ($request->withdraw_amount <= $depositAmt) {
                    //Condition is true
                    //echo "Deposit amount $depositAmt. ---price is okay $depositAmt ";
                    $currentpassword =  $request->password;
                    $checkUser       =  User::find($this->userid);
                    // Compare the hashed input password with the hashed password stored in the database
                    if (Hash::check($currentpassword, $checkUser->with_password)) {
                        $data = array(
                            'withdrawID'      => $generateID,
                            'depscription'    => $generateID,
                            'withdraw_amount' => $request->withdraw_amount,
                            'withdrawal_method_id' => !empty($withMethod->id) ? $withMethod->id : "",
                            'transection_fee' => !empty($chkSetting) ? $chkSetting->withdraw_service_charge : 0,
                            'payable_amount'  => $request->payable_amount,
                            'password'        => $request->password,
                            'status'          => 0,
                            'user_id'         => $this->userid
                        );
                        $resonse = Withdraw::insertGetId($data);
                        return response()->json(['last id' => $resonse], 200);
                    } else {
                        return response()->json(['password_error' => 'Invalid password'], 422);
                    }
                } else {
                    //Condition is false
                    $msg = "Your amount is $$depositAmt. Please valid request";
                    return response()->json(['deposit_error' => $msg], 422);
                }
            } else {
                //conditon is false; 
                $msg = "Please increase your amount. Minimum withdrawal Amount $$withAmt";
                return response()->json(['withdrawal_mini_error' => $msg], 422);
            }
        } catch (QueryException $e) {
            // Log the error or handle it as needed
            return response()->json(['error' => 'Database error occurred.'], 500);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    function generateUnique4DigitNumber($existingNumbers = [])
    {
        do {
            $uniqueNumber = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (in_array($uniqueNumber, $existingNumbers));

        return $uniqueNumber;
    }

    public function getMyDepositAmount()
    {

        $response           = $this->getCurrentBalance();
        $responseContent    = json_decode($response->getContent(), true);
        $currentBalance     = $responseContent['current_balance'];
        $checkOrder         = Order::where('user_id',$this->userid)->select('id','user_id')->first();
        try {

            $setting        = Setting::find(1);
            return response()->json(
                [
                    'data'          => $currentBalance,
                    'orderStatus'   => !empty($checkOrder) ? 1 : 0,
                    'setting' => $setting,

                ],200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error occurred.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    public function withDrawalRequestList(Request $request)
    {

        try {

            //Withdraw::where('user_id', $this->userid)->orderBy('id', 'desc');
            $query = Withdraw::select('withdraw.*', 'currency_type.name as currency_type_name', 'withdrawal_method.wallet_address as wallet_address')
                ->Leftjoin('withdrawal_method', 'withdraw.withdrawal_method_id', '=', 'withdrawal_method.id')
                ->Leftjoin('currency_type', 'withdrawal_method.currency_type_id', '=', 'currency_type.id')
                ->where('withdraw.user_id', $this->userid)
                ->orderBy('withdraw.id', 'desc');

            if ($request->has('orderId')) {
                $query->where('withdrawID', $request->orderId);
            }

            $depositArr = $query->get();

            return response()->json(['data' => $depositArr], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error occurred.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }
    public function accountDetailsList(Request $request)
    {

        try {

            $accDetails = ExpenseHistory::where('user_id', $this->userid)->orderBy('id', 'desc')->get();
            return response()->json(['data' => $accDetails], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error occurred.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    public function depositRequestList(Request $request)
    {
        try {
            $query = Deposit::where('user_id', $this->userid)->orderBy('id', 'desc');

            if ($request->has('orderId')) {
                $query->where('depositID', $request->orderId);
            }
            $depositArr = $query->get();
            return response()->json(['data' => $depositArr], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error occurred.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    public function removeProducts($id)
    {
        //echo $id;exit; 
        if (!empty($id)) {
            Product::where('id', $id)->delete();
            ProductAttributes::where('product_id', $id)->delete();
            ProductAttributeValue::where('product_id', $id)->delete();
            ProductVarrient::where('product_id', $id)->delete();
            ProductVarrientHistory::where('product_id', $id)->delete();
            ProductCategory::where('product_id', $id)->delete();
            ProductAdditionalImg::where('product_id', $id)->delete();
        }
        return response()->json("successfully delete product", 200);
    }


    public function getCurrentBalance()
    {
          // WORNING MESSAGES IF YOU CHANGE INSIDE METHOD PLEAE INSITANT CHANGE THIS METHOD: getCurrentBalanceCheckAdminIndivUser
 
        $customTimeZone = 'Asia/Dhaka';
        $currentTime = Carbon::now($customTimeZone);
        // Add 8 hours to the current datetime
        $currentTime->addHours(10);
        // Format the datetime as needed
        $current_date   = date("Y-m-d");
        $activeStore    = MystoreHistory::where('end_date', '>=', $current_date)->where('user_id', $this->userid)->sum('service_price');
     
        $fastdownloadComission      = 0;
        $seconddownloadComission    = 0;
        $thirddownloadComission     = 0;
        $fourthdownloadComission    = 0;
        $fivedownloadComission      = 0;

        $user_id           = $this->userid;
        $manAdjstSum       = ManualAdjustment::where('user_id', $user_id)->where('adjustment_type',1)->sum('adjustment_amount');
        $manAdjstMinus     = ManualAdjustment::where('user_id', $user_id)->where('adjustment_type',2)->sum('adjustment_amount');
        $depositAmt        = Deposit::where('user_id', $user_id)->where('status', 1)->sum('receivable_amount');
        $withdrawAmt       = Withdraw::where('user_id', $user_id)->where('status', 1)->sum('receivable_amount');
        $expense_history   = ExpenseHistory::where('user_id', $user_id)->sum('operation_amount');

        $chkPendingOrder   = Order::where('user_id',$this->userid)->whereIn('order_status',[2,3,4,5])->sum('buying_price');
        $completeOrders    = Order::where('user_id',$this->userid)->whereIn('order_status',[6])->sum('selling_price');
    

        $allCredit         = $depositAmt + $manAdjstSum + $completeOrders + $fastdownloadComission + $seconddownloadComission + $thirddownloadComission +       
                              $fourthdownloadComission + $fivedownloadComission;

        $allDebit          = $activeStore  + $chkPendingOrder + $manAdjstMinus +  $withdrawAmt;
        $result            = $allCredit - $allDebit;


        $data['current_balance'] = number_format($result, 2); // Formated Balance 
        $data['currentbalance']  = $result; //Without Format balance 
        $data['chkPendingOrderStatus']=$chkPendingOrder;
        //available_balance
        $udata['available_balance']=$data['current_balance'];
        User::where('id', $this->userid)->update($udata);
       
       
        return response()->json($data, 200);
    }

    public function getCurrentBalanceCheckAdminIndivUser($user_id)
    {

        $customTimeZone = 'Asia/Dhaka';
        $currentTime = Carbon::now($customTimeZone);
        // Add 8 hours to the current datetime
        $currentTime->addHours(10);
        // Format the datetime as needed
        $current_date   = date("Y-m-d");
        $activeStore  = MystoreHistory::where('end_date', '>=', $current_date)->where('user_id', $user_id)->sum('service_price');
        
        
     
        $fastdownloadComission      = 0;
        $seconddownloadComission    = 0;
        $thirddownloadComission     = 0;
        $fourthdownloadComission    = 0;
        $fivedownloadComission      = 0;

        //$user_id           = $this->userid;

        $manAdjstSum       = ManualAdjustment::where('user_id', $user_id)->where('adjustment_type',1)->sum('adjustment_amount');
        $manAdjstMinus     = ManualAdjustment::where('user_id', $user_id)->where('adjustment_type',2)->sum('adjustment_amount');
        $depositAmt        = Deposit::where('user_id', $user_id)->where('status', 1)->sum('receivable_amount');
        $withdrawAmt       = Withdraw::where('user_id', $user_id)->where('status', 1)->sum('receivable_amount');
        $expense_history   = ExpenseHistory::where('user_id', $user_id)->sum('operation_amount');

        $chkPendingOrder   = Order::where('user_id',$this->userid)->whereIn('order_status',[2,3,4,5])->sum('buying_price');
        $completeOrders    = Order::where('user_id',$this->userid)->whereIn('order_status',[6])->sum('selling_price');
    

        $allCredit         = $depositAmt + $manAdjstSum + $completeOrders + $fastdownloadComission + $seconddownloadComission + $thirddownloadComission +       
                              $fourthdownloadComission + $fivedownloadComission;

        $allDebit          = $activeStore  + $chkPendingOrder + $manAdjstMinus +  $withdrawAmt;
        $result            = $allCredit - $allDebit;

        $data['current_balance'] = number_format($result, 2); // Formated Balance 
        $data['currentbalance']  = $result; //Without Format balance 
        $data['chkPendingOrderStatus']=$chkPendingOrder;
      
        //available_balance
        $udata['available_balance']=$data['current_balance'];
        User::where('id', $this->userid)->update($udata);
      
        return response()->json($data, 200);
    }


}