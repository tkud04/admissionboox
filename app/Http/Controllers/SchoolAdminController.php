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


}