<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class AdminController extends Controller {

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
	public function getPlugins()
    {
        $user = null;
       $senders = $this->helpers->getSenders();
	   //$plugins = $this->helpers->getPlugins();
       $signals = $this->helpers->signals;
	   $plugins = $this->helpers->getPlugins(['mode' => "all"]);
       $c = $this->compactValues;

		if(Auth::check())
		{
			$user = Auth::user();
            if($user->role === "admin" || $user->role === "su")
            {
			   return view('plugins',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getAddPlugin(Request $request)
    {
       $user = null;
       $senders = $this->helpers->getSenders();
	   $plugins = $this->helpers->getPlugins();
       $signals = $this->helpers->signals;
       $c = $this->compactValues;

	   if(Auth::check())
		{
			$user = Auth::user();
			
			if($user->role === "admin" || $user->role === "su")
            {
				return view('add-plugin',compact($c));
            }
		}

		return redirect()->intended('/');

    	
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddPlugin(Request $request)
    {
        $req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

        if(Auth::check())
		{
			$user = Auth::user();
            if($user->role !== "admin")
            {
                $ret['message'] = "auth";
            }
		}
        else
        {
			$ret['message'] = "auth";
        }
		
		$validator = Validator::make($req, [
                             'name' => 'required',
                             'value' => 'required',
         ]);
         
         if($validator->fails())
         {
			$ret['message'] = "validation";
         }
         
         else
         {
			 $req['status'] = "active";
             $ret = $this->helpers->createPlugin($req);
			 
			 $ret = ['status' => 'ok'];
         }

		 return json_encode($ret);
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getPlugin(Request $request)
    {
       $user = null;
	   $signals = $this->helpers->signals;
	   $req = $request->all();

	   if(Auth::check())
	   {
		   $user = Auth::user();
		   if($user->role !== "admin")
		   {
			   return redirect()->intended('/');
		   }
	   }
	   else
	   {
		   return redirect()->intended('/');
	   }

		if(isset($req['xf']))
		{
			$p = $this->helpers->getPlugin($req['xf']);

			if(count($p) < 1)
			{
				session()->flash("plugin-status","error");
			    return redirect()->intended('plugins');
			}
		}
		else
		{
			session()->flash("plugin-status","error");
			return redirect()->intended('plugins');
		}

    	return view('edit-plugin',compact(['user','signals','p']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postPlugin(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if($user->role !== "admin")
            {
                return redirect()->intended('/');
            }
		}
        else
        {
            return redirect()->intended('/');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
			                 'id' => 'required',
                             'name' => 'required',
                             'value' => 'required',
                             'status' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
             $ret = $this->helpers->updatePlugin($req);
			 
	        session()->flash("update-plugin-status","ok");
			return redirect()->intended('plugins');
         } 	  
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getRemovePlugin(Request $request)
    {
		$user = null;
		$ret = ['status' => 'error','message' => "nothing happened"];

	   $req = $request->all();


	   if(Auth::check())
	   {
		   $user = Auth::user();
		   if($user->role === "admin" || $user->role === "su")
		   {
			  if(isset($req['xf']))
			  {
				$p = $this->helpers->getPlugin($req['xf']);
	
				if(count($p) > 0)
				{
					$this->helpers->removePlugin($req['xf']);
					$ret = ['status' => "ok"];
				}
			  }
			  else
			  {
				$ret['message'] = "validation";
			  }
		   }
	   }
	   else
	   {
		 $ret['message'] = "auth";
	   }

	   return json_encode(($ret));
    }
	
	 /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getFacilities()
    {
        $user = null;
       $senders = $this->helpers->getSenders();
	   //$plugins = $this->helpers->getPlugins();
       $signals = $this->helpers->signals;
	   $plugins = $this->helpers->getPlugins(['mode' => "all"]);
       $c = $this->compactValues;

		if(Auth::check())
		{
			$user = Auth::user();
            if($user->role === "admin" || $user->role === "su")
            {
			  $facilities = $this->helpers->getFacilities();
			  array_push($c,'facilities');
			   return view('facilities',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getAddFacility(Request $request)
    {
       $user = null;
       $senders = $this->helpers->getSenders();
	   $plugins = $this->helpers->getPlugins();
       $signals = $this->helpers->signals;
       $c = $this->compactValues;

	   if(Auth::check())
		{
			$user = Auth::user();
			
			if($user->role === "admin" || $user->role === "su")
            {
				$iconsList = $this->helpers->im_icons;
				array_push($c,'iconsList');
				return view('add-facility',compact($c));
            }
		}

		return redirect()->intended('/');

    	
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddFacility(Request $request)
    {
        $req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

        if(Auth::check())
		{
			$user = Auth::user();
            if($user->role !== "admin")
            {
                $ret['message'] = "auth";
            }
		}
        else
        {
			$ret['message'] = "auth";
        }
		
		$validator = Validator::make($req, [
                             'facility_name' => 'required',
                             'facility_value' => 'required',
                             'icon' => 'required',
         ]);
         
         if($validator->fails())
         {
			$ret['message'] = "validation";
         }
         
         else
         {
			 $req['status'] = "active";
             $ret = $this->helpers->addFacility($req);
			 
			 $ret = ['status' => 'ok'];
         }

		 return json_encode($ret);
    }


	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getRemoveFacility(Request $request)
    {
		$user = null;
		$ret = ['status' => 'error','message' => "nothing happened"];

	   $req = $request->all();


	   if(Auth::check())
	   {
		   $user = Auth::user();
		   if($user->role === "admin" || $user->role === "su")
		   {
			  if(isset($req['xf']))
			  {
				$p = $this->helpers->getFacility($req['xf']);
	
				if(count($p) > 0)
				{
					$this->helpers->removeFacility($req['xf']);
					$ret = ['status' => "ok"];
				}
			  }
			  else
			  {
				$ret['message'] = "validation";
			  }
		   }
	   }
	   else
	   {
		 $ret['message'] = "auth";
	   }

	   return json_encode(($ret));
    }

	 /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getClubs()
    {
        $user = null;
       $senders = $this->helpers->getSenders();
	   //$plugins = $this->helpers->getPlugins();
       $signals = $this->helpers->signals;
	   $plugins = $this->helpers->getPlugins(['mode' => "all"]);
       $c = $this->compactValues;

		if(Auth::check())
		{
			$user = Auth::user();
            if($user->role === "admin" || $user->role === "su")
            {
			  $clubs = $this->helpers->getClubs();
			  array_push($c,'clubs');
			   return view('clubs',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getAddClub(Request $request)
    {
       $user = null;
       $senders = $this->helpers->getSenders();
	   $plugins = $this->helpers->getPlugins();
       $signals = $this->helpers->signals;
       $c = $this->compactValues;

	   if(Auth::check())
		{
			$user = Auth::user();
			
			if($user->role === "admin" || $user->role === "su")
            {
				$iconsList = $this->helpers->im_icons;
				array_push($c,'iconsList');
				return view('add-club',compact($c));
            }
		}

		return redirect()->intended('/');

    	
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddClub(Request $request)
    {
        $req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

        if(Auth::check())
		{
			$user = Auth::user();
            if($user->role !== "admin")
            {
                $ret['message'] = "auth";
            }
		}
        else
        {
			$ret['message'] = "auth";
        }
		
		$validator = Validator::make($req, [
                             'club_name' => 'required',
                             'club_value' => 'required',
                             'img_url' => 'required',
         ]);
         
         if($validator->fails())
         {
			$ret['message'] = "validation";
         }
         
         else
         {
			 $req['status'] = "active";
             $ret = $this->helpers->addClub($req);
			 
			 $ret = ['status' => 'ok'];
         }

		 return json_encode($ret);
    }


	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getRemoveClub(Request $request)
    {
		$user = null;
		$ret = ['status' => 'error','message' => "nothing happened"];

	   $req = $request->all();


	   if(Auth::check())
	   {
		   $user = Auth::user();
		   if($user->role === "admin" || $user->role === "su")
		   {
			  if(isset($req['xf']))
			  {
				$p = $this->helpers->getClub($req['xf']);
	
				if(count($p) > 0)
				{
					$this->helpers->removeClub($req['xf']);
					$ret = ['status' => "ok"];
				}
			  }
			  else
			  {
				$ret['message'] = "validation";
			  }
		   }
	   }
	   else
	   {
		 $ret['message'] = "auth";
	   }

	   return json_encode(($ret));
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


}