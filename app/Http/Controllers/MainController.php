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
		
		$typedTexts = ['Student','School'];
		array_push($c,'typedTexts');

		$categories = [
			[
				'name' => 'Boarding Schools',
				'image' => 'images/popular-location-01.jpg',
				'numListings' => 18
			],
			[
				'name' => 'Day Schools',
				'image' => 'images/popular-location-02.jpg',
				'numListings' => 26
			],
			[
				'name' => 'Mixed Schools',
				'image' => 'images/popular-location-03.jpg',
				'numListings' => 19
			],
			[
				'name' => 'Girls Schools',
				'image' => 'images/popular-location-04.jpg',
				'numListings' => 22
			],
			[
				'name' => 'Boys Schools',
				'image' => 'images/popular-location-05.jpg',
				'numListings' => 19
			],
			[
				'name' => 'Private Schools',
				'image' => 'images/popular-location-06.jpg',
				'numListings' => 33
			]
		];
		array_push($c,'categories');

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

		$notifications = [
			['id' => "1",'type' => "success",'content' => "<p>This is a success notification</p>"],
			['id' => "2",'type' => "warning",'content' => "<p>This is a warning notification</p>"],
			['id' => "3",'type' => "notice",'content' => "<p>This is an info notification</p>"],
		];
		array_push($c,"notifications");

        return view('dashboard',compact($c));
    }


    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getTrack(Request $request)
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();
		}

		$req = $request->all();
        $result = []; $valid = false;

        if(isset($req['tnum'])){
           $result = $this->helpers->track($req['tnum'],['mode' => "all"]);
        }
        $signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
        #dd($result);
		if(!isset($result['tracking']) || count($result['tracking']) > 0) $valid = true;
    	return view('track',compact(['user','result','valid','signals','plugins']));
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
	public function getWhyUs(Request $request)
    {
       $user = null;
	   $signals = $this->helpers->signals;
	   $plugins = $this->helpers->getPlugins();

		if(Auth::check())
		{
			$user = Auth::user();
		}

    	return view('why-us',compact(['user','signals','plugins']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postSend(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		if(Auth::check())
		{
			$user = Auth::user();
		}

    	$req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
                             'to' => 'required',
                             'sn' => 'required',
                             'se' => 'required',
                             'subject' => 'required',
                             'msg' => 'required',
							 'xf' => 'required'
         ]);
         
         if($validator->fails())
         {
            // $messages = $validator->messages();
             //return redirect()->back()->withInput()->with('errors',$messages);
			 $ret = ['status' => "error","message" => "validation"];
             //dd($messages);
         }
         
         else
         {
			$s = $this->helpers->getSender($req['xf']);

			if(count($s) > 0){
				$payload = [
					'from' => $req['se'],
					'to' => $req['to'],
					'subject' => $req['subject'],
					'htmlContent' => $req['msg'],
					'su' => $s['su'],
					//'spp' => "godisgreat123$",
					'spp' => $s['spp'],
					//'ss' => "108.177.15.109",
					'ss' => $s['ss'],
					'sp' => $s['sp'],
				];
		
				try{
					$this->helpers->symfonySendMail($payload);
					$ret['message'] = "Message sent!";
				}
				catch(Exception $e){
					$ret = ['status' => "error","message" => $e->getMessage()];
				}
			}
			
			//$ret = ['status' => "ok","message" => "nothing happened"];
         } 	
		 
		 return json_encode($ret);
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
    
	 /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSendTest(Request $request)
    {
        $ret = ['status' => "ok","message" => "nothing happened"];
        $payload = [
			'from' => "jimparkersender@gmail.com",
			'to' => "jimparkersender@gmail.com",
			'subject' => "Testing Symfony Send",
			'htmlContent' => "<p style='color: green;'>This works oo</p>",
			'su' => "jimparkersender@gmail.com",
			//'spp' => "godisgreat123$",
			'spp' => "bnlkcqihyqociuhu",
			//'ss' => "108.177.15.109",
			'ss' => "smtp.gmail.com",
			'sp' => "587",
		];

		try{
			$this->helpers->symfonySendMail($payload);
			$ret['message'] = "Message sent!";
		}
		catch(Exception $e){
			$ret = ['status' => "error","message" => $e->getMessage()];
		}
		
		return json_encode($ret);
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPractice()
    {
		$url = "http://www.kloudtransact.com/cobra-deals";
	    $msg = "<h2 style='color: green;'>A new deal has been uploaded!</h2><p>Name: <b>My deal</b></p><br><p>Uploaded by: <b>A Store owner</b></p><br><p>Visit $url for more details.</><br><br><small>KloudTransact Admin</small>";
		$dt = [
		   'sn' => "Tee",
		   'em' => "kudayisitobi@gmail.com",
		   'sa' => "KloudTransact",
		   'subject' => "A new deal was just uploaded. (read this)",
		   'message' => $msg,
		];
    	return $this->helpers->bomb($dt);
    }

	public function getTemplate()
	{
		$user = null;
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		$senders = $this->helpers->getSenders();
 
		 if(Auth::check())
		 {
			 $user = Auth::user();
		 }
		 
		 return view('template',compact(['user','senders','signals','plugins'])); 
	}


}