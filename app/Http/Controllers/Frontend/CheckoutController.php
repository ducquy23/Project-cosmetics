<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use DB;

class CheckoutController extends Controller
{
    static $vnp_TmnCode = "W6YEW49O";
    static $vnp_HashSecret = "WSBCHHFZBEGYEQNOQHVKLNCGZVHQTHMU"; 
    static $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    static $vnp_Returnurl = "/checkout/vnPayCheck"; 

    public function index(){
        return view('frontend.checkout');
    }

    public function checkout(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'note' => 'nullable|string',
            'payment' => 'required|in:1,2',
        ],[
            'name.required' => 'Họ tên không được để trống.',
            'email.required' => 'Địa chỉ email không được để trống.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'address.required' => 'Địa chỉ nhận hàng không được để trống.',
            'payment.required' => 'Vui lòng chọn phương thức thanh toán.',
        ]);


        $data['total_price'] = session('total_price');
        $data['user_id'] = \Auth::id();
        $data['status'] = 2; // trang thai chờ xác nhận

        /* Nếu thanh toán COD */
        if($data['payment'] == 2){
            DB::beginTransaction();
            try {
                $order = Order::create($data);
                $this->createOrderDetail($order);
                DB::commit();

                return redirect()->route('account')->with('success_message', 'Đặt hàng thành công, đơn hàng sẽ được giao trong vòng vài ngày tới.');

            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }
        };

        /* Thanh toán VNPay */
        if($data['payment'] == 1){
            $order = Order::create($data);
            $data = [
                'vnp_TxnRef' => $order->id,
                'vnp_OrderInfo' => 'Order Payment No.' .$order->id,
                'vnp_Amount' => $order->total_price,

            ];
            $data_url = $this->vnpay_create_payment($data);
            //chuyển hướng đến URL lấy được
            \Redirect::to($data_url)->send();
        }

    }

    protected function createOrderDetail($order){
        $carts = session('cart',[]);

        foreach($carts as $item){
            $order->products()->attach($item['product_id'], [
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            $product = product::where('id',$item['product_id'])->first();  
            $product->quantity -= $item['quantity'];
            $product->save();
        }

        session()->forget(['cart','total_price']);
    }

    protected function vnpay_create_payment(array $data)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_TxnRef = $data['vnp_TxnRef'];
        $vnp_OrderInfo = $data['vnp_OrderInfo'];
        $vnp_OrderType = 200000;
        $vnp_Amount = $data['vnp_Amount'] * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0", 
            "vnp_TmnCode" => self::$vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND", 
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => env('APP_URL') . self::$vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        //thêm 'vnp_BankCode'
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        //thêm 'vnp_SecureHash'
        $vnp_Url = self::$vnp_Url . "?" . $query;
        if (isset(self::$vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, self::$vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = [
            'code' => '00', 
            'message' => 'success',
            'data' => $vnp_Url
        ];


        return $returnData['data']; 
    }

    public function vnPayCheck(Request $request){

        //Lấy data từ URL (VNPay gửi về qua $vnp_Returnurl)
        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); //Mã phản hồi kết quả thanh toán
        $vnp_TxnRef = $request->get('vnp_TxnRef'); // ID đơn  hàng

        // Kiểm tra mã phản hồi
        if($vnp_ResponseCode != null){
            $order = Order::find($vnp_TxnRef);

            //00: TH thành công
            if($vnp_ResponseCode == 00){
                $this->createOrderDetail($order);
                return redirect()->route('account')->with('success_message', 'Đặt hàng thành công, đơn hàng sẽ được giao trong vòng vài ngày tới.');

            }elseif($vnp_ResponseCode == 24){ //24: Hủy thanh toán
                $order->delete();
                return redirect()->route('checkout');
            }
            else{
                $order->delete();
                toastr()->error('Có lỗi xảy ra khi thanh toán với VNPay.');
                return redirect()->route('checkout');
            }
        }
    }

}



// Thẻ demo để test VNPay

// Ngân hàng: NCB
// Số thẻ: 9704198526191432198
// Tên chủ thẻ:NGUYEN VAN A
// Ngày phát hành:07/15
// Mật khẩu OTP:123456