<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class MainController extends Controller {

	protected $helpers; //Helpers implementation
	protected $compactValues;
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;        
		$this->compactValues = ['user','plugins','senders','signals'];         
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();
		}

		$signals = $this->helpers->signals;
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins();
		$c = $this->compactValues;

		$testUniqueLink = $this->helpers->getUniqueLinkValue("4","dasf");
	
		
		$typedTexts = ['Student','School'];
		array_push($c,'typedTexts');

		$categories = [
			[
				'name' => 'Early Years',
				'image' => 'images/popular-location-01.jpg',
				'numListings' => 18
			],
			[
				'name' => 'Primary',
				'image' => 'images/popular-location-02.jpg',
				'numListings' => 26
			],
			[
				'name' => 'Secondary',
				'image' => 'images/popular-location-03.jpg',
				'numListings' => 19
			],
			[
				'name' => 'Tertiary',
				'image' => 'images/popular-location-04.jpg',
				'numListings' => 22
			],
			[
				'name' => 'Faith-based',
				'image' => 'images/popular-location-05.jpg',
				'numListings' => 19
			],
			[
				'name' => 'Boarding',
				'image' => 'images/popular-location-06.jpg',
				'numListings' => 33
			]
		];
		array_push($c,'categories');

		$viewMoreCategories = [
			[
				'name' => 'Private',
				'image' => 'images/popular-location-01.jpg',
				'numListings' => 11
			],
			[
				'name' => 'Public',
				'image' => 'images/popular-location-01.jpg',
				'numListings' => 18
			],
			[
				'name' => 'Boys',
				'image' => 'images/popular-location-01.jpg',
				'numListings' => 13
			],
			[
				'name' => 'Girls',
				'image' => 'images/popular-location-01.jpg',
				'numListings' => 19
			],
			[
				'name' => 'Day Care',
				'image' => 'images/popular-location-01.jpg',
				'numListings' => 10
			],
		];
		array_push($c,'viewMoreCategories');

		$locations = [
			[
				'name' => "Abaji",
				'value' => "abaji"
			],
			[
				'name' => "AOP District",
				'value' => "aop-district"
			],
			[
				'name' => "Asokoro",
				'value' => "asokoro"
			],
			[
				'name' => "Central Business",
				'value' => "central-business"
			],
			[
				'name' => "Dakibiyu",
				'value' => "dakibiyu"
			],
			[
				'name' => "Duboyi",
				'value' => "duboyi"
			]
		];
        array_push($c,'locations');
        

        return view('index',compact($c));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDashboard()
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();
		}
		else{
			return redirect()->intended('/');
		}

		$signals = $this->helpers->signals;
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins();
		$c = $this->compactValues;

		if($user->role === 'school')
		{
            $school =$this->helpers->getSchool($user->email);
		  
		   $hasCompletedSignup = $this->helpers->checkSchoolSignup($school);
		   array_push($c,'school','hasCompletedSignup');

		   $notifications = [
			['id' => "1",'type' => "success",'content' => "<p>This is a success notification</p>"],
			['id' => "2",'type' => "warning",'content' => "<p>This is a warning notification</p>"],
			['id' => "3",'type' => "notice",'content' => "<p>This is an info notification</p>"],
		];
		array_push($c,"notifications");

		   return view('school-dashboard',compact($c));
		}
		else if($user->role === 'admin' || $user->role === 'su')
		{
          dd($user);
		}
		else
		{
            $notifications = [
				['id' => "1",'type' => "success",'content' => "<p>This is a success notification</p>"],
				['id' => "2",'type' => "warning",'content' => "<p>This is a warning notification</p>"],
				['id' => "3",'type' => "notice",'content' => "<p>This is an info notification</p>"],
			];
			array_push($c,"notifications");
	        return view('dashboard',compact($c));	
		}

		
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postUpdateSchoolInfo(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school')
			{
				$req = $request->all();

				#dd($req);
				$validator = Validator::make($req, [
					/*'to' => 'required',
					'sn' => 'required',
					'se' => 'required',
					'subject' => 'required',
					'msg' => 'required',*/
					'xf' => 'required',
					'file' => 'required|file'
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation"];
	              //dd($messages);
                }
				else
				{
					$school = $this->helpers->getSchool($req['xf']);
					$uu = $this->helpers->cloudinaryUploadImage($request->file('file'));
					$ret['message'] = "ok";
					$ret['url'] = $uu;
				}

			}
			else
			{
				$ret = ['status' => "error",'message' => 'invalid-session'];

			}
			
		}

    	
		
         else
         {
			$ret['message'] = "invalid-session";
         } 

		 return json_encode($ret); 
    }


		/**
	 * Show the application welcome screen to the user.
	 *
	 */
    public function postUpdateSchoolResources(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school')
			{
				$req = $request->all();
				$payload = [];

				
                
				$validator = Validator::make($req, [
					'xf' => 'required'
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation"];
                }
				else
				{
					if($request->hasFile('file'))
				    {
					   $file = $request->file('file');
					   $payload['file'] = $file;
				    }
				}
				

			}
			else
			{
				$ret = ['status' => "error","message" => "invalid-session"];
			}
			
		}

    	
		
         else
         {
			$ret['message'] = "invalid-session";
         } 

		 return json_encode($ret); 
    }



   


	 /**
	 * Show the application contact view to the user.
	 *
	 * @return Response
	 */
	public function getContact(Request $request)
    {
       $user = null;
	   $signals = $this->helpers->signals;
	   $plugins = $this->helpers->getPlugins();

		if(Auth::check())
		{
			$user = Auth::user();
		}

    	return view('contact',compact(['user','signals','plugins']));
    }

	 /**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getAbout(Request $request)
    {
       $user = null;
	   $signals = $this->helpers->signals;
	   $plugins = $this->helpers->getPlugins();

		if(Auth::check())
		{
			$user = Auth::user();
		}

    	return view('about',compact(['user','signals','plugins']));
    }


	
	 /**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getAddSender(Request $request)
    {
       $user = null;
	   $signals = $this->helpers->signals;
	   $plugins = $this->helpers->getPlugins();
	   $senders = $this->helpers->getSenders();

		if(Auth::check())
		{
			$user = Auth::user();
		}

    	return view('add-sender',compact(['user','senders','signals','plugins']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddSender(Request $request)
    {
		$user = null;

		if(Auth::check())
		{
			$user = Auth::user();
		}

    	$req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
                             'su' => 'required',
                             'spp' => 'required',
                             'sn' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			$req['current'] = "no";
			$req['ss'] = "smtp.gmail.com";
			$req['sp'] = "587";
			$req['status'] = "enabled";
			$req['sa'] = "yes";
			$req['sec'] = "tls";
			$req['se'] = $req['su'];
			$this->helpers->createSender($req);
			 
	        session()->flash("add-sender-status","ok");
			return redirect()->intended('add-sender');
         } 	  
    }
	
	
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getZoho()
    {
        $ret = "1535561942737";
    	return $ret;
    }


}