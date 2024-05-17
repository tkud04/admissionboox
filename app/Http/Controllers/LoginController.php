<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 
use App\Models\User;

class LoginController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;            
    }
	
		/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSignup()
    {
		return redirect()->intended('/?xx=1');
    }

    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getLogin(Request $request)
    {
       $user = null;
       $req = $request->all();
       $return = isset($req['return']) ? $req['return'] : '/';
		
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended($return);
		}
		$signals = $this->helpers->signals;
    	return view('login',compact(['user','return','signals']));
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postSignin(Request $request)
    {
        $req = $request->all();
        $ret = ['status' => 'error','message' => "nothing happened"];
        #dd($req);
        
        $validator = Validator::make($req, [
                             'password' => 'required|min:6',
                             'email' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             $ret['message'] = "validation";
         }
         
         else
         {
			
         	$remember = true; 
             $return = isset($req['return']) ? $req['return'] : 'dashboard';
             
         	//authenticate this login
            if(Auth::attempt(['email' => $req['email'],'password' => $req['password'],'status'=> "ok"],$remember))
            {
            	//Login successful   
             
               $user = Auth::user(); 
               $request->session()->regenerate();       
               # dd($user); 
				              
                 $ret = ['status'=> "ok",'message' => $user->id];
            }
			
			else
			{
				$ret['message'] = "auth";
			}
         }
         return json_encode($ret);        
    }

    public function postSignup(Request $request)
    {
        $req = $request->all();
        #dd($req);
        $ret = ['status' => 'error','message' => "nothing happened"];
        
        $validator = Validator::make($req, [
                             'password' => 'required|min:6|confirmed',
                             'email' => 'required|email', 
                             'fname' => 'required', 
                             'lname' => 'required',
                             'phone' => 'required|numeric',
                             'gender' => 'required',
                             'country' => 'required',
                             'city' => 'required',
                             'address' => 'required',
                             #'g-recaptcha-response' => 'required',
                           # 'terms' => 'accepted',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             $ret['message'] = "validation";
         }
         
         else
         {
			 #dd($req);
             $req['role'] = "user";
           $req['status'] = "ok";  
           $req['verified'] = "yes";       			
           $req['complete_signup'] = "yes";       			
            
                       #dd($req);            

            $user =  $this->helpers->createUser($req); 
            
			$req['user_id'] = $user->id;
            $this->helpers->createUserAddress($req);
			
                                                    
             //after creating the user, send back to the registration view with a success message
             #$this->helpers->sendEmail($user->email,'Welcome To Disenado!',['name' => $user->fname, 'id' => $user->id],'emails.welcome','view');
             $ret = ['status'=> "ok"];
          }
          return json_encode($ret);    
    }

    public function postSchoolSignup(Request $request)
    {
        /*
      schoolName,email,country,phone,hbu,hbuOther,
                boardingType,schoolFees,
                wcu,
                ownerName,ownerEmail,ownerPhone,
                url,schoolType,schoolCurriculum
        */
        $req = $request->all();
        #dd($req);
        $ret = ['status' => 'error','message' => "nothing happened"];
  
        $validator = Validator::make($req, [
                             'schoolName' => 'required',
                             'email' => 'required|email', 
                             'country' => 'required', 
                             'phone' => 'required|numeric',
                             'hbu' => 'required',
                             //'hbuOther' => 'required',
                             'boardingType' => 'required',
                             'schoolFees' => 'required',
                             'wcu' => 'required',
                             'ownerName' => 'required',
                             'ownerEmail' => 'required|email',
                             'ownerPhone' => 'required|numeric',
                             'url' => 'required',
                             'schoolType' => 'required',
                             'schoolCurriculum' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             $ret['message'] = "validation";
         }
         
         else
         {
			 #dd($req);
             $userPayload = [
                'email' => $req['email'],
                'fname' => $req['schoolName'],
                'lname' => "",
                'phone' => $req['phone'],
                'complete_signup' => "no",
                'gender' => "",
                'role' => 'school',
                'verified' => 'yes',
                'password' => "",
                'status' => "ok",
             ];       

            $user =  $this->helpers->createUser($userPayload); 

            $schoolPayload = [
                'name' => $req['schoolName'],
                'email' => $user->email,
                'country' => $req['country'],
                'phone' => $user->phone,
                'url' => $req['url'],
                'status' => "pending",
                'logo' => "",
                'landing_page_pic' => "",
            ];

            $school = $this->helpers->addSchool($schoolPayload);
            $schoolInfoPayload = [
                'school_id' => $school->id,
                'hbu' => $req['hbu'],
                'boarding_type' => $req['boardingType'],
                'hbu_other' => (isset($req['hbuOther']) && $req['hbu'] === "other") ? $req['hbuOther'] : "none",
                'school_name' => $req['schoolName'],
                'school_type' => $req['schoolType'],
                'school_curriculum' => $req['schoolCurriculum'],
                'school_fees' => $req['schoolFees'],
                'wcu' => $req['wcu'],
                'school_coords' => "",
            ];

            $schoolInfo = $this->helpers->addSchoolInfo($schoolInfoPayload);
			
            $schoolOwnerPayload = [
                'school_id' => $school->id,
                'name' => $req['ownerName'],
                'email' => $req['ownerEmail'],
                'phone' => $req['ownerPhone'],
            ];

            $schoolOwner = $this->helpers->addSchoolOwner($schoolOwnerPayload);

           
                                                    
             //TODO: after creating the user/school, send email with link to verify email andcomplete signup
             #$this->helpers->sendEmail($user->email,'Welcome To Disenado!',['name' => $user->fname, 'id' => $user->id],'emails.welcome','view');
             $ret = ['status'=> "ok"];
          }
          return json_encode($ret);    
    }
	
	 public function getForgotPassword()
    {
    	$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended('/');
		}
		$signals = $this->helpers->signals;
         return view('reset-password', compact(['user']));
    }
    
    /**
     * Send username to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postForgotPassword(Request $request)
    {
    	$req = $request->all(); 
        $validator = Validator::make($req, [
                             'id' => 'required'
                  ]);
                  
        if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else{
         	$ret = $req['id'];

                $user = User::where('email',$ret)
                                  ->orWhere('phone',$ret)->first();

                if(is_null($user))
                {
                        return redirect()->back()->withErrors("No admin account exists with that email or phone number!","errors"); 
                }
                
                //get the reset code 
                $code = $this->helpers->getPasswordResetCode($user);
              
                //Configure the smtp sender
                $sender = $this->helpers->emailConfig;              
                $sender['sn'] = 'KloudTransact Support'; 
                #$sender['se'] = 'kloudtransact@gmail.com'; 
                $sender['em'] = $user->email; 
                $sender['subject'] = 'Reset Your Password'; 
                $sender['link'] = 'www.kloudtransact.com'; 
                $sender['ll'] = url('reset').'?code='.$code; 
                
                //Send password reset link
                $this->helpers->sendEmailSMTP($sender,'emails.password','view');                                                         
            session()->flash("forgot-password-status","ok");           
            return redirect()->intended('login');

      }
                  
    }    

    
    public function getLogout()
    {
        if(Auth::check())
        {  
           Auth::logout();       	
        }
        
        return redirect()->intended('/');
    }

}