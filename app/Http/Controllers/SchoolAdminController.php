<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class SchoolAdminController extends Controller {

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
    public function postUpdateSchoolInfo(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school_admin')
			{
				$req = $request->all();

				#dd($req);
				$validator = Validator::make($req, [
					'address' => 'required',
					'state' => 'required',
					'latitude' => 'required|numeric',
					'longitude' => 'required|numeric',
					'clubs' => 'required',
					'facilities' => 'required',
					'xf' => 'required|numeric'
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation"];
	              //dd($messages);
                }
				else
				{
					$xf = $req['xf'];
					
					//Clubs
					$clubs = json_decode($req['clubs']);
					if(count($clubs) > 0)
					{
						foreach($clubs as $c)
						{
							$this->helpers->addSchoolClub([
								'school_id' => $xf,
								'club_id' => $c
							]);
						}
					}

					//Facilities
					$facilities = json_decode($req['facilities']);
					if(count($facilities) > 0)
					{
						foreach($facilities as $f)
						{
							$this->helpers->addSchoolFacility([
								'school_id' => $xf,
								'facility_id' => $f
							]);
						}
					}

					//Address
					$addressPayload = [
                      'school_id' => $xf,
                      'school_state' => $req['state'],
                      'school_address' => $req['address'],
                      'latitude' => $req['latitude'],
                      'longitude' => $req['longitude']
					];

					$this->helpers->updateSchoolAddress($addressPayload);
					
					$ret = ['status' => 'ok'];
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

			if($user->role === 'school_admin')
			{
				$req = $request->all();
				$payload = [];
				$school = $this->helpers->getSchool($user->email);

				
                
				$validator = Validator::make($req, [
					'file' => 'required|file'
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

					   $uu = $this->helpers->cloudinaryUploadImage($file);
					   $payload = [
						'school_id' => $school['id'],
						'url' => $uu
					   ];

					   $this->helpers->addSchoolResource($payload);
					   $ret = ['status' => "ok"];
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
	 * Show the application welcome screen to the user.
	 *
	 */
    public function postUpdateSchoolLogo(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school_admin')
			{
				$req = $request->all();
				$payload = [];
				$school = $this->helpers->getSchool($user->email);

				
                
				$validator = Validator::make($req, [
					'file' => 'required|file'
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

					   $uu = $this->helpers->cloudinaryUploadImage($file);
					   $payload = [
						'id' => $school['id'],
						'logo' => $uu
					   ];

					   $this->helpers->updateSchool($payload);
					   $ret = ['status' => "ok"];
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
	 * Show the application welcome screen to the user.
	 *
	 */
    public function postUpdateSchoolLandingPage(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school_admin')
			{
				$req = $request->all();
				$payload = [];
				$school = $this->helpers->getSchool($user->email);

				
                
				$validator = Validator::make($req, [
					'file' => 'required|file'
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation",'req' => $req];
                }
				else
				{
					if($request->hasFile('file'))
				    {
					   $file = $request->file('file');

					   $uu = $this->helpers->cloudinaryUploadImage($file);
					   $payload = [
						'id' => $school['id'],
						'landing_page_pic' => $uu
					   ];

					   $this->helpers->updateSchool($payload);
					   $ret = ['status' => "ok"];
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
	 * Show the application welcome screen to the user.
	 *
	 */
    public function getSendEmail(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school_admin')
			{
				
			}
			else
			{
				return redirect()->intended('dashboard');
			}
			
		}

         else
         {
			return redirect()->intended('dashboard');
         } 

		 return json_encode($ret); 
    }

	public function getSchoolAdmissions(Request $request)
    {
		$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school_admin')
			{
				$signals = $this->helpers->signals;
		        $senders = $this->helpers->getSenders();
	 	        $plugins = $this->helpers->getPlugins();
		        $c = $this->compactValues;

				$school = $this->helpers->getSchool($user->email);
				$admissions = $this->helpers->getSchoolAdmissions($school['id']);
				array_push($c,'school','admissions');
				return view('my-admissions',compact($c));
			}
			else
			{
				return redirect()->intended('dashboard');
			}
			
		}

         else
         {
			return redirect()->intended('dashboard');
         } 
    }

	public function getAddSchoolAdmission(Request $request)
    {
		$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school_admin')
			{
				$signals = $this->helpers->signals;
		        $senders = $this->helpers->getSenders();
	 	        $plugins = $this->helpers->getPlugins();
		        $c = $this->compactValues;

				$school = $this->helpers->getSchool($user->email);
				$availableSessions = [];
				$currentYear = date('Y');
				$next5Years = $currentYear + 5;

				$schoolClasses = $this->helpers->getSchoolClasses($school['id']);
				$terms = $this->helpers->getTerms();
				
				for($i = $currentYear; $i < $next5Years - 1; $i++)
				{
					$i2 = $i + 1;
					$ret = "{$i}/{$i2}";
					array_push($availableSessions,$ret);
				}

				
				array_push($c,'school','availableSessions','schoolClasses','terms');
				return view('new-admission',compact($c));
			}
			else
			{
				return redirect()->intended('dashboard');
			}
			
		}

         else
         {
			return redirect()->intended('dashboard');
         } 
    }


	public function postAddSchoolAdmission(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school_admin')
			{
				$req = $request->all();
				$payload = [];
				$school = $this->helpers->getSchool($user->email);

				
                
				$validator = Validator::make($req, [
					'session' => 'required|not_in:none',
					'term' => 'required|not_in:none',
					'classes' => 'required',
					'end_date' => 'required'
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation",'req' => $req];
                }
				else
				{
					$admissionPayload = [
						'school_id' => $school['id'],
						'session' => $req['session'],
						'term_id' => $req['term'],
						'form_id' => '',
						'end_date' => $req['end_date']
					];

					$admission = $this->helpers->addSchoolAdmission($admissionPayload);

					 $classes = json_decode($req['classes']);
					if(count($classes) > 0)
					{
						foreach($classes as $c)
						{
							$this->helpers->addAdmissionClass([
								'admission_id' => $admission->id,
								'class_id' => $c
							]);
						}
					}

					 $ret = ['status' => "ok"];
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
	

	public function getSchoolAdmission(Request $request)
    {
		$user = null;
		$ret = ['status' => 'error','message' => "nothing happened"];

	   $req = $request->all();


	   if(Auth::check())
	   {
		   $user = Auth::user();
		   if($user->role === 'school_admin')
		   {
			  if(isset($req['xf']))
			  {
				
				$signals = $this->helpers->signals;
		        $senders = $this->helpers->getSenders();
	 	        $plugins = $this->helpers->getPlugins();
		        $c = $this->compactValues;
				$availableSessions = [];
				$currentYear = date('Y');
				$next5Years = $currentYear + 5;
				$terms = $this->helpers->getTerms();

				for($i = $currentYear; $i < $next5Years - 1; $i++)
				{
					$i2 = $i + 1;
					$ret = "{$i}/{$i2}";
					array_push($availableSessions,$ret);
				}

				$school = $this->helpers->getSchool($user->email);
				$admission = $this->helpers->getSchoolAdmission($req['xf']);
				$admissionClasses = $this->helpers->getAdmissionClasses($req['xf']);
				$schoolClasses = $this->helpers->getSchoolClasses($school['id']);
				$acList = $this->helpers->extractAdmissionClasses($admissionClasses);

				#dd(['sc' => $schoolClasses,'admissionClasses' => $admissionClasses, 'ac' => $acList]);
				array_push($c,'school','admission','availableSessions','acList','schoolClasses','terms');
				return view('my-admission',compact($c));
			  }
			  else
			  {
				return redirect()->intended('my-admissions');
			  }
		   }
		   else
		   {
			return redirect()->intended('dashboard');
		   }
	   }
	   else
	   {
		return redirect()->intended('/');
	   }
    }

	public function postSchoolAdmission(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school_admin')
			{
				$req = $request->all();
				$payload = [];
				$school = $this->helpers->getSchool($user->email);

				
                
				$validator = Validator::make($req, [
					'xf' => 'required',
					'session' => 'required|not_in:none',
					'term' => 'required|not_in:none',
					'classes' => 'required',
					'end_date' => 'required'
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation",'req' => $req];
                }
				else
				{
					$xf = $req['xf'];

					$admissionPayload = [
						'admission_id' => $xf,
						'session' => $req['session'],
						'term_id' => $req['term'],
						'form_id' => '',
						'end_date' => $req['end_date']
					];

					 $this->helpers->updateSchoolAdmission($admissionPayload);

					 $classes = json_decode($req['classes']);
					if(count($classes) > 0)
					{
						$this->helpers->removeAdmissionClasses($xf);

						foreach($classes as $c)
						{
						
								$this->helpers->addAdmissionClass([
									'admission_id' => $xf,
									'class_id' => $c
								]);

						}
					}

					 $ret = ['status' => "ok"];
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


	public function getSchoolApplications(Request $request)
    {
		$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school_admin')
			{
				$signals = $this->helpers->signals;
		        $senders = $this->helpers->getSenders();
	 	        $plugins = $this->helpers->getPlugins();
		        $c = $this->compactValues;

				$school = $this->helpers->getSchool($user->email);
				dd($school);
			}
			else
			{
				return redirect()->intended('dashboard');
			}
			
		}

         else
         {
			return redirect()->intended('dashboard');
         } 
    }

	public function getSchoolClasses(Request $request)
    {
		$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school_admin')
			{
				$signals = $this->helpers->signals;
		        $senders = $this->helpers->getSenders();
	 	        $plugins = $this->helpers->getPlugins();
		        $c = $this->compactValues;

				$school = $this->helpers->getSchool($user->email);
				$classes = $this->helpers->getSchoolClasses($school['id']);
				array_push($c,'school','classes');
				return view('my-classes',compact($c));
			}
			else
			{
				return redirect()->intended('dashboard');
			}
			
		}

         else
         {
			return redirect()->intended('dashboard');
         } 
    }

	public function getAddSchoolClass(Request $request)
    {
		$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school_admin')
			{
				$signals = $this->helpers->signals;
		        $senders = $this->helpers->getSenders();
	 	        $plugins = $this->helpers->getPlugins();
		        $c = $this->compactValues;

				$school = $this->helpers->getSchool($user->email);
				return view('new-class',compact($c));
			}
			else
			{
				return redirect()->intended('dashboard');
			}
			
		}

         else
         {
			return redirect()->intended('dashboard');
         } 
    }


	public function postAddSchoolClass(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		if(Auth::check())
		{
			$user = Auth::user();

			if($user->role === 'school_admin')
			{
				$req = $request->all();
				$payload = [];
				$school = $this->helpers->getSchool($user->email);

				
                
				$validator = Validator::make($req, [
					'class_name' => 'required',
					'class_value' => 'required',
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation",'req' => $req];
                }
				else
				{
					$payload = [
						'school_id' => $school['id'],
						'class_name' => $req['class_name'],
						'class_value' => $req['class_value'],
					];

					 $this->helpers->addSchoolClass($payload);
					 $ret = ['status' => "ok"];
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

	public function getRemoveSchoolClass(Request $request)
    {
		$user = null;
		$ret = ['status' => 'error','message' => "nothing happened"];

	   $req = $request->all();


	   if(Auth::check())
	   {
		   $user = Auth::user();
		   if($user->role === 'school_admin')
		   {
			  if(isset($req['xf']))
			  {
				$p = $this->helpers->getSchoolClass($req['xf']);
	
				if(count($p) > 0)
				{
					$this->helpers->removeSchoolClass($req['xf']);
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


}