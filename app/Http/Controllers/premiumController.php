<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\premium;
use App\Models\premiumDetail;
use App\Models\userPremium;
use Auth;

use Validator;
use URL;
use Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class premiumController extends Controller
{
    private $_api_context;
    public function __construct()
    {
            
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }
    //
    function getPrice(){
        if(Auth::check() && (Auth::user()->type == '1' || Auth::user()->type == '3')){

            $data = premium::where('account_type', Auth::user()->type)->first();

            return view('web.response.premium', ['data' => $data]);
        }else{
            return 'Error';
        }

    }

    function subscribe(Request $request){
        if(Auth::check() && (Auth::user()->type == '1' || Auth::user()->type == '3')){
            $da = $request->all();
            $data = premiumDetail::find($da['account_type']);
            Session::put('account_type', $da['account_type']);
            //dd($data);
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_1 = new Item();

            $item_1->setName($data['premium_id'])
                ->setCurrency('SGD')
                ->setQuantity(1)
                ->setPrice($data['price']);

            $item_list = new ItemList();
            $item_list->setItems(array($item_1));

            $amount = new Amount();
            $amount->setCurrency('SGD')
                ->setTotal($data['price']);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Enter Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('premium.status.success'))
                ->setCancelUrl(URL::route('premium.status.success'));

            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));            
            try {
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                if (\Config::get('app.debug')) {
                    \Session::put('error','Connection timeout');
                    return Redirect::route('premium.status.failed');                
                } else {
                    \Session::put('error','Some error occur, sorry for inconvenient');
                    return Redirect::route('premium.status.failed');                
                }
            }

            foreach($payment->getLinks() as $link) {
                if($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }
            
            Session::put('paypal_payment_id', $payment->getId());

            if(isset($redirect_url)) {            
                return Redirect::away($redirect_url);
            }

            \Session::put('error','Unknown error occurred');
            return Redirect::route('premium.status.failed');

        }else{
            return redirect('/');
        }
    }


    function statusSuccess(Request $request){
        $id = Session::get('account_type');
        Session::forget('account_type');

        $data = premiumDetail::find($id);
        userPremium::subscribe($data);
        return redirect('/')->with('subscribed', 'true');
    }

    function statusFailed(Request $request){
        $data = $request->all();

        dd('Payment Failed');
    }
}
