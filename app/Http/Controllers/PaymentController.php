<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class PaymentController extends Controller {

	protected $helpers; //Helpers implementation
	protected $compactValues;
    
    public function __construct(Helper $h)
    {
    	$this->helpers = $h;      
		$this->compactValues = ['user','plugins','senders','signals'];         
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getInitPayment(Request $request)
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();
            $req = $request->all();

            $signals = $this->helpers->signals;
		    $senders = $this->helpers->getSenders();
		    $plugins = $this->helpers->getPlugins(['mode' => 'active']);
		    $c = $this->compactValues;

            $req = $request->all();
				
				$validator = Validator::make($req, [
					'xf' => 'required|numeric',
					'selectedAdmission' => 'required',
					'selectedDate' => 'required',
					'selectedTime' => 'required'
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation",'req' => $req];
                }
				else
				{

                }
		}
        else
        {
           return redirect()->intended('/');
        }
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	function postInitPayment(Request $request)
    {
       $user = null;
	   $ret = ['status' => "ok","message" => "nothing happened"];

		if(Auth::check())
		{
			$user = Auth::user();
            $req = $request->all();
			
            $signals = $this->helpers->signals;
		    $senders = $this->helpers->getSenders();
		    $plugins = $this->helpers->getPlugins(['mode' => 'active']);
		    $c = $this->compactValues;

            $req = $request->all();
				
				$validator = Validator::make($req, [
					'xf' => 'required|numeric',
					'selectedAdmission' => 'required',
					'selectedDate' => 'required',
					'selectedTime' => 'required'
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation",'req' => $req];
                }
				else
				{
                    $selectedAdmission = $this->helpers->getSchoolAdmission($req['selectedAdmission']);
					$feeKobo = floatval($selectedAdmission['application_fee']) * 100;

					$secret_key = $this->helpers->psSecretKey;
					$initResponse = $this->helpers->callAPI([
						'method' => 'POST',
						'url' => 'https://api.paystack.co/transaction/initialize',
						'headers' => [
							"Authorization" => "Bearer {$secret_key}",
                            "Cache-Control: no-cache",
						],
						'body' => [
							"email" => $user->email,
							"amount" => $feeKobo,
						]
					]);
					

					$ret = ['status'=> "ok","data" => $initResponse];
                }
		}
        else
		{
			$ret = ['status' => "error","message" => "auth"];
		}


		 return json_encode($ret); 
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	function postVerifyPayment(Request $request)
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();
            $req = $request->all();
            dd($req);
            $signals = $this->helpers->signals;
		    $senders = $this->helpers->getSenders();
		    $plugins = $this->helpers->getPlugins(['mode' => 'active']);
		    $c = $this->compactValues;

            $req = $request->all();
				
				$validator = Validator::make($req, [
					'xf' => 'required|numeric',
					'selectedAdmission' => 'required',
					'selectedDate' => 'required',
					'selectedTime' => 'required'
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation",'req' => $req];
                }
				else
				{
                    
                }
		}
        else
        {
           return redirect()->intended('/');
        }
	}

}