<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class AdminController extends Controller {

	protected $helpers; //Helpers implementation
    protected $compactValues;
    
    public function __construct(Helper $h)
    {
    	$this->helpers = $h;
		$this->compactValues = ['user','plugins','senders','signals'];                     
    }


    /**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getAddSender(Request $request)
    {
       $user = null;
	   $senders = $this->helpers->getSenders();
	   $signals = $this->helpers->signals;
	   $plugins = $this->helpers->getPlugins(['mode' => "all"]);
       $c = $this->compactValues;

	   $menuSchools = $this->helpers->getSchools(['id' => 'all','status' => 'all']);

		if(Auth::check())
		{
			$user = Auth::user();
		}

		array_push($c,'menuSchools');

    	return view('add-sender',compact($c));
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
	public function getPlugins()
    {
        $user = null;
		$senders = $this->helpers->getSenders();
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins(['mode' => "all"]);
		$c = $this->compactValues;

	    $menuSchools = $this->helpers->getSchools(['id' => 'all','status' => 'all']);
        array_push($c,'menuSchools');

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
	   $signals = $this->helpers->signals;
	   $plugins = $this->helpers->getPlugins(['mode' => "all"]);
	   $c = $this->compactValues;

	   $menuSchools = $this->helpers->getSchools(['id' => 'all','status' => 'all']);
	   array_push($c,'menuSchools');

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
            if($user->role !== "admin" || $user->role !== "su")
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
	   $senders = $this->helpers->getSenders();
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins(['mode' => "all"]);
		$c = $this->compactValues;

	    $menuSchools = $this->helpers->getSchools(['id' => 'all','status' => 'all']);
        array_push($c,'menuSchools');

	   $req = $request->all();

	   if(Auth::check())
	   {
		   $user = Auth::user();
		   if($user->role !== "admin" || $user->role !== "su")
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
            if($user->role !== "admin" || $user->role !== "su")
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
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins(['mode' => "all"]);
		$c = $this->compactValues;

	    $menuSchools = $this->helpers->getSchools(['id' => 'all','status' => 'all']);
        array_push($c,'menuSchools');

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
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins(['mode' => "all"]);
		$c = $this->compactValues;

	    $menuSchools = $this->helpers->getSchools(['id' => 'all','status' => 'all']);
        array_push($c,'menuSchools');

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
            if($user->role !== "admin" || $user->role !== "su")
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
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins(['mode' => "all"]);
		$c = $this->compactValues;

	    $menuSchools = $this->helpers->getSchools(['id' => 'all','status' => 'all']);
        array_push($c,'menuSchools');

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
	   $signals = $this->helpers->signals;
	   $plugins = $this->helpers->getPlugins(['mode' => "all"]);
	   $c = $this->compactValues;

	   $menuSchools = $this->helpers->getSchools(['id' => 'all','status' => 'all']);
	   array_push($c,'menuSchools');
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
            if($user->role !== "admin" || $user->role !== "su")
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
	public function getSchools(Request $request)
    {
        $user = null;
       $senders = $this->helpers->getSenders();
	   $signals = $this->helpers->signals;
	   $plugins = $this->helpers->getPlugins(['mode' => "all"]);
       $c = $this->compactValues;
	   $menuSchools = $this->helpers->getSchools(['id' => 'all','status' => 'all']);
	   array_push($c,'menuSchools');

		if(Auth::check())
		{
			$user = Auth::user();
            if($user->role === "admin" || $user->role === "su")
            {
				$req = $request->all();
				$status = isset($req['xf']) ? $req['xf'] : "active";
			  $currentPage = isset($req['page']) ? $req['page'] : "1";
		       $currentPage = intval($currentPage);	
             
		      $allSchools = $this->helpers->filterSchools($status);
		      $numPages = $this->helpers->numPages($allSchools);
		      $schools = $this->helpers->changePage($allSchools,$currentPage);

			  array_push($c,'schools','numPages','currentPage');
			   return view('my-schools',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	 /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSchoolAdmissions(Request $request)
    {
        $user = null;
       $senders = $this->helpers->getSenders();
	   $signals = $this->helpers->signals;
	   $plugins = $this->helpers->getPlugins(['mode' => "all"]);
       $c = $this->compactValues;
	   $menuSchools = $this->helpers->getSchools(['id' => 'all','status' => 'all']);
	   array_push($c,'menuSchools');
      
		if(Auth::check())
		{
			$user = Auth::user();
			
            if($user->role === "admin" || $user->role === "su")
            {
			  $req = $request->all();
			  $currentPage = isset($req['page']) ? $req['page'] : "1";
		      $currentPage = intval($currentPage);	
             
		      $ret2 = $this->helpers->getSchoolAdmissions(['school' => true]);
			  $allAdmissions = [];

			  foreach($ret2 as $r2)
			  {
				$ret = $r2;
				$r2['school'] = $this->helpers->getSchool(($r2['school_id']));
                array_push($allAdmissions,$r2);
			  }
		     # $allAdmissions = $this->helpers->getSchoolAdmissions(['school' => true]);
		      $numPages = $this->helpers->numPages($allAdmissions);
		      $admissions = $this->helpers->changePage($allAdmissions,$currentPage);
             # dd($admissions);
			  $terms = $this->helpers->getTerms();
			  array_push($c,'terms','admissions','numPages','currentPage');
			  return view('school-admissions',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postUpdateSchool(Request $request)
    {
        $req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

        if(Auth::check())
		{
			$user = Auth::user();
            if($user->role !== "admin" || $user->role !== "su")
            {
                $ret['message'] = "auth";
            }
		}
        else
        {
			$ret['message'] = "auth";
        }
		
		$validator = Validator::make($req, [
                             'xf' => 'required',
                             'ss' => 'required'
         ]);
         
         if($validator->fails())
         {
			$ret['message'] = "validation";
         }
         
         else
         {
			 $req['status'] = "active";
             $ret = $this->helpers->updateSchool([
				'id' => $req['xf'],
				'status' => $req['ss']
			 ]);
			 
			 $ret = ['status' => 'ok'];
         }

		 return json_encode($ret);
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