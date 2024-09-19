<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon;

use function PHPUnit\Framework\greaterThanOrEqual;

class MainController extends Controller {

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
	public function getIndex()
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();
		}

		$signals = $this->helpers->signals;
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;

		$testUniqueLink = $this->helpers->getUniqueLinkValue("4","dasf");
	
		$facilities = $this->helpers->getFacilities();
       $typedTexts = ['Student','School'];
		array_push($c,'typedTexts','facilities');

		$schoolCategories = $this->helpers->schoolCategories;

		$categories = [];
		for($i = 0; $i < 6 && $i < count($schoolCategories); $i++)
		{
			$temp = $schoolCategories[$i];
			$id = $i + 1;
			$temp['image'] = "images/popular-location-0{$id}.jpg";
			$temp['numListings'] = $this->helpers->getSchoolCount($temp['xf']);
			array_push($categories,$temp);
		}
		
		array_push($c,'categories');

		$viewMoreCategories = [];

		for($i = 6; $i < 10 && $i < count($schoolCategories); $i++)
		{
			$temp = $schoolCategories[$i];
			$temp['image'] = 'images/popular-location-01.jpg';
			$temp['numListings'] = 11;
			array_push($viewMoreCategories,$temp);
		}
			
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
        
		#dd($plugins);

        return view('index',compact($c));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSchools(Request $request)
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();
		}

		$req = $request->all();
		$signals = $this->helpers->signals;
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$category = isset($req['category']) ? $req['category'] : "all";
		$currentPage = isset($req['page']) ? $req['page'] : "1";
		$currentPage = intval($currentPage);	

		$allSchools = $this->helpers->filterSchools($category);
		$numPages = $this->helpers->numPages($allSchools);
		$schools = $this->helpers->changePage($allSchools,$currentPage);
		$schoolCategories = $this->helpers->schoolCategories;

		array_push($c,'schools','category','schoolCategories','numPages','currentPage');

        
		#dd($plugins);

        return view('schools',compact($c));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSchool(Request $request)
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();
		}

		$req = $request->all();
		
		if(isset($req['xf']))
		{
			$signals = $this->helpers->signals;
			$senders = $this->helpers->getSenders();
			$plugins = $this->helpers->getPlugins(['mode' => 'active']);
			$c = $this->compactValues;
			
			$school = $this->helpers->getSchool($req['xf']);

			if(count($school) > 0)
			{
                $schoolCategories = $this->helpers->schoolCategories;
			$schoolAdmissions = $this->helpers->getSchoolAdmissions($school['id']);
            
			$hasActiveAdmission = false;
			if(count($schoolAdmissions) > 0)
			{
              foreach($schoolAdmissions as $sa)
			  {
                if($sa['status']) $hasActiveAdmission = true;
			  }
			}
			

			$currentPage = isset($req['page']) ? $req['page'] : "1";
		$currentPage = intval($currentPage);	

		$allReviews = $this->helpers->getSchoolReviews($school['id']);
		$numPages = $this->helpers->numPages($allReviews);
		$reviews = $this->helpers->changePage($allReviews,$currentPage);
		$schoolCategories = $this->helpers->schoolCategories;
		$calculatedRating = $this->helpers->calculateRating($allReviews);

		$tags = [
			'day' => false,
			'boarding' => false,
			'early' => false,
			'primary' => false,
			'secondary' => false,
			'tertiary' => false,
			'boys' => false,
			'girls' => false,
			'faith' => false,
			'private' => false,
			'public' => false,
		];

		$similarSchools = $this->helpers->getSimilarSchools($school);

		$applicationTimeSlots = $this->helpers->applicationTimeSlots;
		$hbsa = $this->helpers->getPendingSchoolApplication($user->id);
	
		$applicationDeadlines = [];

		foreach($schoolAdmissions as $sa)
		{
			array_push($applicationDeadlines,['xf' => $sa['id'],'ed' => $sa['end_date']]);
		}
		 $adls = json_encode($applicationDeadlines);
	
			array_push($c,
			'school','schoolCategories','calculatedRating','hbsa',
			'currentPage','numPages','reviews','tags','similarSchools',
			'hasActiveAdmission','applicationTimeSlots','schoolAdmissions',
			'adls'
		);
	       # dd($applicationDeadlines);
			return view('school',compact($c));
			}

		else
		{
           return redirect()->intended('schools');
		}
			
		}
		else
		{
           return redirect()->intended('schools');
		}
		
    }

	public function postAddSchoolReview(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		if(Auth::check())
		{
			$user = Auth::user();

			$req = $request->all();
				$payload = [];
				$validator = Validator::make($req, [
					'xf' => 'required',
					'environment' => 'required|numeric',
					'service' => 'required|numeric',
					'price' => 'required|numeric',
					'comment' => 'required',
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation",'req' => $req];
                }
				else
				{
					$school = $this->helpers->getSchool($req['xf']);
					if($user->email === $school['email'])
					{
						$ret = ['status' => "error","message" => "own",'req' => $req];
					}
					else
					{
						$payload = [
						  'user_id' => $user->id,
						  'school_id' => $req['xf'],
						  'environment' => $req['environment'],
						  'service' => $req['service'],
						  'price' => $req['price'],
						  'comment' => $req['comment'],
					    ];

					    $this->helpers->addSchoolReview($payload);
					    $ret = ['status' => "ok"];
					}
					
				}
			
		}

    	
		
         else
         {
			$ret['message'] = "invalid-session";
         } 

		 return json_encode($ret); 
    }

	public function postContactSchool(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		    if(Auth::check())
		    {
			    $user = Auth::user();
				$req = $request->all();
				
				$validator = Validator::make($req, [
					'contactEmail' => 'required|email',
					'contactName' => 'required',
					'contactMessage' => 'required',
					'xf' => 'required'
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation",'req' => $req];
                }
				else
				{
					$school = $this->helpers->getSchool($req['xf']);

					if(count($school) > 0)
					{
						$htmlContentData = [
							'contactName' => $req['contactName'],
							'contactEmail' => $req['contactEmail'],
							'contactMessage' => $req['contactMessage'],
							'schoolName' => $school['name']
						];
						$emailPayload = $this->helpers->getCurrentSender();
						$emailPayload['se'] = $emailPayload['se'];
						$emailPayload['sn'] = $school['name'];
						$emailPayload['to'] = $school['email'];
						$emailPayload['subject'] = $req['contactName']." sent a message to ".$school['name'];
						$emailPayload['htmlContent'] = $this->helpers->getEmailContent('contact-school',$htmlContentData);
						$this->helpers->symfonySendMail($emailPayload);
						$ret = ['status'=> "ok"];
					}
					else
					{
                        $ret = ['status' => "error","message" => "invalid-session"];
					}
					
				}
				
			}
			else
			{
				$ret = ['status' => "error","message" => "auth"];
			}


		 return json_encode($ret); 
    }

	public function postAddSchoolBookmark(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		    if(Auth::check())
		    {
			    $user = Auth::user();
				$req = $request->all();
				
				$validator = Validator::make($req, [
					'xf' => 'required'
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation",'req' => $req];
                }
				else
				{
					$school = $this->helpers->getSchool($req['xf']);

					if(count($school) > 0)
					{
						$payload = [
							'user_id' => $user->id,
							'school_id' => $req['xf'],
						];

						$this->helpers->addSchoolBookmark($payload);
						$ret = ['status'=> "ok"];
					}
					else
					{
                        $ret = ['status' => "error","message" => "invalid-session"];
					}
					
				}
				
			}
			else
			{
				$ret = ['status' => "error","message" => "auth"];
			}


		 return json_encode($ret); 
    }

	public function postRemoveSchoolBookmark(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		    if(Auth::check())
		    {
			    $user = Auth::user();
				$req = $request->all();
				
				$validator = Validator::make($req, [
					'xf' => 'required'
               ]);

               if($validator->fails())
                {
                  $ret = ['status' => "error","message" => "validation",'req' => $req];
                }
				else
				{
					$b = $this->helpers->getSchoolBookmark($req['xf']);

					if(count($b) > 0)
					{
						$this->helpers->removeSchoolBookmark($b['id']);
						$ret = ['status'=> "ok"];
					}
					else
					{
                        $ret = ['status' => "error","message" => "invalid-session"];
					}
					
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
	public function getInitSchoolApplication(Request $request)
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();
		}

		$signals = $this->helpers->signals;
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;

		return redirect()->intended('/');
    }

	public function postInitSchoolApplication(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		    if(Auth::check())
		    {
			    $user = Auth::user();
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

					if(count($selectedAdmission) > 0)
					{
						$ret2 = $this->helpers->getPendingSchoolApplication($user->id);
						if(count($ret2) > 0)
						{
							$ret = ['status' => "error","message" => "has-pending-application"];
						}
						else
						{
							
							$applicantDate = Carbon::parse($req['selectedDate']);
							$deadlineDate = Carbon::parse($selectedAdmission['end_date']);
	
							if($applicantDate->greaterThan($deadlineDate))
							{
								$ret = ['status' => "error","message" => "is-past-deadline"];
							}
							else
							{
								$applicant = $this->helpers->addSchoolApplication([
									'admission_id' => $req['selectedAdmission'],
									'user_id' => $user->id,
									'date_slot' => $req['selectedDate'],
									'time_slot' => $req['selectedTime'],
									'paystack_id' => '0',
									'status' => 'unpaid',
								]);
	
								$ret = ['status'=> "ok",'data' => ['xf' => $applicant->id]];
							}
							
						}
					}
					else
					{
						$ret = ['status' => "error","message" => "invalid-session"];
					}
					
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
	public function getCompleteSchoolApplication(Request $request)
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();

			$signals = $this->helpers->signals;
		    $senders = $this->helpers->getSenders();
		    $plugins = $this->helpers->getPlugins(['mode' => 'active']);
		    $c = $this->compactValues;
			$req = $request->all();

			if(isset($req['xf']))
			{
               $applicant = $this->helpers->getSchoolApplication($req['xf'],true);
			   $school = $this->helpers->getSchool($applicant['admission']['school_id']);
			   $selectedTime = $this->helpers->applicationTimeSlots[$applicant['time_slot']];
			   $allReviews = $this->helpers->getSchoolReviews($school['id']);
			   $calculatedRating = $this->helpers->calculateRating($allReviews);
			   #dd($selectedTime);

			   if(count($applicant) > 0)
			   {
                 array_push($c,'applicant','school','selectedTime',
				           'allReviews','calculatedRating');
				 return view('complete-application',compact($c));
			   }
			   else
			   {
				 return redirect()->intended('/');
			   }
			}
			else
			{
				return redirect()->intended('/');
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
	public function getVerifySchoolApplication(Request $request)
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();
		}

		$signals = $this->helpers->signals;
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;

		return redirect()->intended('/');
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getFillSchoolApplicationForm(Request $request)
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();

			$signals = $this->helpers->signals;
		    $senders = $this->helpers->getSenders();
		    $plugins = $this->helpers->getPlugins(['mode' => 'active']);
		    $c = $this->compactValues;
			$req = $request->all();

			if(isset($req['xf']))
			{
               $applicant = $this->helpers->getSchoolApplication($req['xf'],true);
			   $admission = $applicant['admission'];
			   $school = $this->helpers->getSchool($admission['school_id']);
			   #dd($selectedTime);

			   if(count($applicant) > 0)
			   {
                 array_push($c,'applicant','school');
				 return view('fill-admission-form',compact($c));
			   }
			   else
			   {
				 return redirect()->intended('/');
			   }
			}
			else
			{
				return redirect()->intended('/');
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
	public function getSchoolApplication(Request $request)
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();

			$signals = $this->helpers->signals;
		    $senders = $this->helpers->getSenders();
		    $plugins = $this->helpers->getPlugins(['mode' => 'active']);
		    $c = $this->compactValues;
			$req = $request->all();

			if(isset($req['xf']))
			{
               $applicant = $this->helpers->getSchoolApplication($req['xf'],true);
			   $school = $this->helpers->getSchool($applicant['admission']['school_id']);
			   #dd($selectedTime);

			   if(count($applicant) > 0)
			   {
                 array_push($c,'applicant','school');
				 return view('upload-application-resources',compact($c));
			   }
			   else
			   {
				 return redirect()->intended('/');
			   }
			}
			else
			{
				return redirect()->intended('/');
			}
		}
		else
		{
			return redirect()->intended('/');
		}
		
    }

	public function postUploadApplicationResources(Request $request)
    {
		$user = null;
		$ret = ['status' => "ok","message" => "nothing happened"];

		    if(Auth::check())
		    {
			    $user = Auth::user();
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

					if(count($selectedAdmission) > 0)
					{
						if($this->helpers->hasPendingSchoolApplication($user->id))
						{
							$ret = ['status' => "error","message" => "has-pending-application"];
						}
						else
						{
							
							$applicantDate = Carbon::parse($req['selectedDate']);
							$deadlineDate = Carbon::parse($selectedAdmission['end_date']);
	
							if($applicantDate->greaterThan($deadlineDate))
							{
								$ret = ['status' => "error","message" => "is-past-deadline"];
							}
							else
							{
								$applicant = $this->helpers->addSchoolApplication([
									'admission_id' => $req['selectedAdmission'],
									'user_id' => $user->id,
									'date_slot' => $req['selectedDate'],
									'time_slot' => $req['selectedTime'],
									'status' => 'unpaid',
								]);
	
								$ret = ['status'=> "ok",'data' => ['xf' => $applicant->id]];
							}
							
						}
					}
					else
					{
						$ret = ['status' => "error","message" => "invalid-session"];
					}
					
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
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;

		$currentClass = "dashboard";

		$notifications = [
			['id' => "1",'type' => "success",'content' => "<p>This is a success notification</p>"],
			['id' => "2",'type' => "warning",'content' => "<p>This is a warning notification</p>"],
			['id' => "3",'type' => "notice",'content' => "<p>This is an info notification</p>"],
		];
		array_push($c,"notifications","currentClass");

		if($user->role === 'school_admin')
		{
            $school =$this->helpers->getSchool($user->email);
			
			$hasCompletedSignup = $this->helpers->checkSchoolSignup($school);
			$facilities = $this->helpers->getFacilities();
			$clubs = $this->helpers->getClubs();
			$ngStates = $this->helpers->statesNigeria;
			$terms = $this->helpers->getTerms();
			$schoolApplications = $this->helpers->fetchAllSchoolApplications($school['id']);

			array_push(
				$c,'school','hasCompletedSignup',
			    'facilities','clubs','ngStates',
				'schoolApplications','terms'
			);

			$rawNotifications = $this->helpers->getSchoolNotifications($school['id']);

		   $notifications = $this->helpers->parseSchoolNotifications($school,$rawNotifications);
		   $dashboardStats = $this->helpers->getSchoolDashboardStats($school);
	
		   array_push($c,"notifications",'dashboardStats');

		   return view('school-dashboard',compact($c));
		}
		else if($user->role === 'admin' || $user->role === 'su')
		{
		  $schools = $this->helpers->getSchools(['id' => "all","status" => "all"]);
		   $facilities = $this->helpers->getFacilities();
		  $clubs = $this->helpers->getClubs();
		  $users = $this->helpers->getUsers(); 
		  
		  $menuSchools = $this->helpers->getSchools(['id' => 'all','status' => 'all']);
			array_push($c,'menuSchools');
			$rawNotifications = $this->helpers->getAdminNotifications();
            $schoolApplications = $this->helpers->getSchoolApplications('all');
		   $notifications = $this->helpers->parseAdminNotifications($rawNotifications);
		   $dashboardStats = $this->helpers->getAdminDashboardStats();
		  array_push($c,
		  'notifications','schools','facilities',
		  'clubs','users','dashboardStats','schoolApplications'
		);
		
		  return view('admin-dashboard',compact($c));
		}
		else
		{
			$rawNotifications = [];
			$notifications = $this->helpers->getUserNotifications($rawNotifications);
            $notifications = [
				//['id' => "1",'type' => "success",'content' => "<p>This is a success notification</p>"],
				//['id' => "2",'type' => "warning",'content' => "<p>This is a warning notification</p>"],
				//['id' => "3",'type' => "notice",'content' => "<p>This is an info notification</p>"],
			];
			$schoolApplications = $this->helpers->getUserSchoolApplications($user->id);
			$terms = $this->helpers->getTerms();

			array_push($c,"notifications","schoolApplications","terms");
	        return view('dashboard',compact($c));	
		}

		
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getProfile()
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
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;

		$currentClass = "dashboard";

		array_push($c,"currentClass");

		if($user->role === 'school_admin')
		{
            $school =$this->helpers->getSchool($user->email);
			array_push($c,'school');
			return view('school-profile',compact($c));
		}
		else
		{
		   $ua = $this->helpers->getUserAddress($user->id);
		   array_push($c,'ua');
		   if($user->role === 'admin')
		   {
			$menuSchools = $this->helpers->getSchools(['id' => 'all','status' => 'all']);
			$schoolApplications = $this->helpers->getUserSchoolApplications('all');
			array_push($c,'menuSchools','schoolApplications');
		   }
		  #dd($ua);
           return view('user-profile',compact($c));	
		}

		
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
	   $plugins = $this->helpers->getPlugins(['mode' => 'active']);

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
	   $plugins = $this->helpers->getPlugins(['mode' => 'active']);

		if(Auth::check())
		{
			$user = Auth::user();
		}

    	return view('about',compact(['user','signals','plugins']));
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