<?php
namespace App\Helpers;

use App\Helpers\Contracts\HelperContract; 
use App\Models\SchoolClubs;
use Crypt;
use Carbon\Carbon; 
use App\Models\User;
use App\Models\Senders;
use App\Models\Plugins;
use App\Models\Settings;
use App\Models\UserAddresses;
use App\Models\Clubs;
use App\Models\Facilities;
use App\Models\Schools;
use App\Models\SchoolInfo;
use App\Models\SchoolFacilities;
use App\Models\SchoolOwners;
use App\Models\SchoolResources;
use GuzzleHttp\Client;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class Helper implements HelperContract
{    

            public $emailConfig = [
                           'ss' => 'smtp.gmail.com',
                           'se' => 'uwantbrendacolson@gmail.com',
                           'sp' => '587',
                           'su' => 'uwantbrendacolson@gmail.com',
                           'spp' => 'kudayisi',
                           'sa' => 'yes',
                           'sec' => 'tls'
                       ];     
                        
             public $signals = ['okays'=> ["login-status" => "Sign in successful",            
                     "add-sender-status" => "Sender added!",
                     "update-profile-status" => "Profile updated!",
                     "new-tracking-status" => "Tracking added!",
                     "tracking-status" => "Tracking updated!",
                     "remove-tracking-status" => "Tracking removed!",
                     "contact-status" => "Message sent! Our customer service representatives will get back to you shortly.",
                     ],
                     'errors'=> ["login-status-error" => "There was a problem signing in, please contact support.",
					 "add-sender-status-error" => "There was a problem adding sender.",
					 "update-status-error" => "There was a problem updating the account, please contact support.",
					 "contact-status-error" => "There was a problem sending your message, please contact support.",
                     "tracking-status-error" => "Tracking info does not exist!",
                    ]
                   ];
 
             public $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
             public $nums = '0123456789';

           function symfonySendMail($data){
            
              $email = (new Email())
               ->from(new Address($data['se'],$data['sn']))
               ->to($data['to'])
               //->cc('cc@example.com')
               //->bcc('bcc@example.com')
               //->replyTo('fabien@example.com')
               //->priority(Email::PRIORITY_HIGH)
               ->subject($data['subject'])
               //->text('Sending emails is fun again!')
               ->html($data['htmlContent']);
               $dsn = "smtp://{$data['su']}:{$data['spp']}@{$data['ss']}:{$data['sp']}";
              
              $transport = Transport::fromDsn($dsn);
              $mailer = new Mailer($transport);
              $mailer->send($email);
           }

           function getEmailContent($type='', $data= [])
           {
             $ret = '';

             if($type === 'verify-school-signup' && (isset($data['link']) && isset($data['name'])))
             {
                $name = $data['name']; $link = $data['link'];
                $ret = <<<EOD
                <div style="padding: 10px;">
                <h4 style="">Welcome to AdmissionBOOX!</h4>
                <p style="">Hello $name,<br> We are excited to get you started. First, you need to verify your account. Just click the button below:</p>
                <a href="$link" style="padding: 8px 15px; background: #ff7600; border: 1px solid transparent; color: #fff; margin: 0 5px; min-width: 110px; text-align: center; position: relative; line-height: 26px; font-weight: 700;">Verify Account</a>
                <p style="">If that doesn't work, copy and paste the link below to your browser:</p>
                <a href="$link" style="">$link</a>
             </div>
EOD;
             }

             return $ret;
           }

          

           
           function addSettings($data)
           {
           	$ret = Settings::create(['item' => $data['item'],                                                                                                          
                                                      'value' => $data['value'], 
                                                      'type' => $data['type'], 
                                                      ]);
                                                      
                return $ret;
           }
           
           function getSetting($i)
          {
          	$ret = "";
          	$settings = Settings::where('item',$i)->first();
               
               if($settings != null)
               {
               	//get the current withdrawal fee
               	$ret = $settings->value;
               }
               
               return $ret; 
          }
          
 
          function createUser($data)
          {
           
              $ret = User::create(['fname' => $data['fname'], 
                                                     'lname' => $data['lname'], 
                                                     'email' => $data['email'], 
                                                     'phone' => $data['phone'], 
                                                     'role' => $data['role'], 
                                                     'gender' => $data['gender'], 
                                                     'status' => $data['status'], 
                                                    'verified' => $data['verified'], 
                                                    'complete_signup' => $data['complete_signup'], 
                                                     'password' => bcrypt($data['password']), 
                                                     'remember_token' => "default",
                                                     'reset_code' => "default"
                                                     ]);
                                                     
               return $ret;
          }
           
           function getUser($email)
           {
           	$ret = [];
               $u = User::where('email',$email)
			            ->orWhere('id',$email)->first();
 
              if($u != null)
               {
                   	$temp['fname'] = $u->fname; 
                       $temp['lname'] = $u->lname; 
                       $temp['phone'] = $u->phone;
                       $temp['email'] = $u->email; 
                       $temp['role'] = $u->role; 
                       $temp['status'] = $u->status; 
                       $temp['verified'] = $u->verified; 
                       $temp['complete_signup'] = $u->complete_signup; 
                       $temp['id'] = $u->id; 
                       $temp['date'] = $u->created_at->format("jS F, Y");  
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }
		   
		   function getUsers($id="all")
           {
           	$ret = [];
               if($id == "all") $uu = User::where('id','>','0')->get();
               else $uu = User::where('role',$id)->get();
 
              if($uu != null)
               {
				  foreach($uu as $u)
				    {
                       $temp = $this->getUser($u->id);
                       array_push($ret,$temp); 
				    }
               }                          
                                                      
                return $ret;
           }	  

           function updateUser($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['email']))
               {
               	$u = User::where('email', $data['email'])->first();
 
                        if($u != null)
                        {
							$role = $u->role;
							$payload = [];
                            if(isset($data['fname'])) $payload['fname'] = $data['fname'];
                            if(isset($data['lname'])) $payload['lname'] = $data['lname'];
                            if(isset($data['password'])) $payload['password'] = $data['password'];
                            if(isset($data['gender'])) $payload['gender'] = $data['gender'];
                            if(isset($data['role'])) $payload['role'] = $data['role'];
                            if(isset($data['status'])) $payload['status'] = $data['status'];
                            if(isset($data['verified'])) $payload['verified'] = $data['verified'];
                            if(isset($data['complete_signup'])) $payload['complete_signup'] = $data['complete_signup'];
                           
                        	$u->update($payload);
                             $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }

           function createUserAddress($data)
           {
            
               $ret = UserAddresses::create(['user_id' => $data['user_id'], 
                                                      'country' => $data['country'], 
                                                      'city' => $data['city'], 
                                                      'address' => $data['address']
                                                      ]);
                                                      
                return $ret;
           }

           function getUserAddress($user_id)
           {
           	$ret = [];
               $ua = UserAddresses::where('user_id',$user_id)->first();
 
              if($ua != null)
               {
                   	$temp['id'] = $ua->id; 
                   	$temp['user_id'] = $ua->user_id; 
                   	$temp['country'] = $ua->country; 
                   	$temp['city'] = $ua->city; 
                   	$temp['address'] = $ua->address; 
                    $temp['date'] = $ua->created_at->format("jS F, Y");  
                    $ret = $temp; 
               }                          
                                                      
                return $ret;
           }

           function updateUserAddress($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['user_id']))
               {
               	$ua = UserAddresses::where('user_id', $data['user_id'])->first();
 
                        if($ua != null)
                        {
							$payload = [];
                            if(isset($data['country'])) $payload['country'] = $data['country'];
                            if(isset($data['city'])) $payload['city'] = $data['city'];
                            if(isset($data['address'])) $payload['address'] = $data['address'];
                           
                        	$ua->update($payload);
                             $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }

           function removeUserAddress($id)
           {
            $ua = UserAddresses::where('user_id', $id)->first();

               if($ua != null) $ua->delete();
           }

           
           function createPlugin($data)
           {
               $ret = Plugins::create([
                   'name' => $data['name'],
                   'value' => $data['value'],
                   'status' => $data['status']
               ]);

               return $ret;
           }

           function getPlugins()
           {
               $ret = [];
               $plugins = Plugins::where('id','>','0')->get();

               if($plugins != null)
               {
                  foreach($plugins as $p)
                  {
                      $temp = $this->getPlugin($p->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getPlugin($id)
           {
               $ret = [];
               $p = Plugins::where('id',$id)->first();

               if($p != null)
               {
                   $ret['id'] = $p->id;
                   $ret['name'] = $p->name;
                   $ret['value'] = $p->value;
                   $ret['status'] = $p->status;
               }

               return $ret;
           }

           function updatePlugin($data)
           {
            $ret = [];
            $p = Plugins::where('id',$data['id'])->first();
            
            if($p != null)
            {
                $p->update([
                    'name' => $data['name'],
                    'value' => $data['value'],
                    'status' => $data['status']
                ]);
            }
           }

           function removePlugin($id)
           {
               $p = Plugins::where('id',$id)->first();

               if($p != null) $p->delete();
           }
          
           function hasKey($arr,$key) 
           {
           	$ret = false; 
               if( isset($arr[$key]) && $arr[$key] != "" && $arr[$key] != null ) $ret = true; 
               return $ret; 
           }  
           
           function addSchool($data)
           {
            //'email', 'country', 'phone', 'url','status','landing_page_pic'
            $ret = Schools::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'country' => $data['country'],
                'phone' => $data['phone'],
                'url' => $data['url'],
                'logo' => $data['logo'],
                'landing_page_pic' => $data['landing_page_pic'],
                'status' => $data['status']
            ]);

            return $ret;
           }

           function getSchools()
           {
               $ret = [];
               $schools = Schools::where('id','>','0')->get();

               if($schools != null)
               {
                  foreach($schools as $s)
                  {
                      $temp = $this->getSchool($s->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getSchool($id)
           {
               $ret = [];
               $s = Schools::where('id',$id)
                           ->orWhere('email',$id)->first();

               if($s != null)
               {
                   $ret['id'] = $s->id;
                   $ret['name'] = $s->name;
                   $ret['email'] = $s->email;
                   $ret['country'] = $s->country;
                   $ret['phone'] = $s->phone;
                   $ret['url'] = $s->url;
                   $ret['logo'] = $s->logo;
                   $ret['landing_page_pic'] = $s->landing_page_pic;
                   $ret['status'] = $s->status;
                   $ret['owner'] = $this->getSchoolOwner($s->id);
                   $ret['info'] =$this->getSchoolInfo($s->id);
                   $ret['facilities'] =$this->getSchoolFacilities($s->id);
                   $ret['resources'] =$this->getSchoolResources($s->id);
                   $ret['clubs'] =$this->getSchoolClubs($s->id);
               }

               return $ret;
           }

           function updateSchool($data)
           {
            $ret = [];
            $s = Schools::where('id',$data['id'])->first();
            
            if($s != null)
            {
                    $payload = [];
                    if(isset($data['name'])) $payload['name'] = $data['name'];
                    if(isset($data['email'])) $payload['email'] = $data['email'];
                    if(isset($data['phone'])) $payload['phone'] = $data['phone'];
                    if(isset($data['url'])) $payload['url'] = $data['url'];
                    if(isset($data['country'])) $payload['country'] = $data['country'];
                    if(isset($data['logo'])) $payload['logo'] = $data['logo'];
                    if(isset($data['status'])) $payload['status'] = $data['status'];
                    if(isset($data['landing_page_pic'])) $payload['landing_page_pic'] = $data['landing_page_pic'];
                   
                    
                    $s->update($payload);
                     $ret = "ok";      
            }
           }

           function removeSchool($id)
           {
               $p = Schools::where('id',$id)->first();
               if($p != null) $p->delete();
           }

           function addSchoolInfo($data)
           {
            $ret = SchoolInfo::create([
                'school_id' => $data['school_id'],
                'boarding_type' => $data['boarding_type'],
                'hbu' => $data['hbu'],
                'hbu_other' => $data['hbu_other'],
                'school_name' => $data['school_name'],
                'school_type' => $data['school_type'],
                'school_curriculum' => $data['school_curriculum'],
                'school_fees' => $data['school_fees'],
                'wcu' => $data['wcu'],
                'school_coords' => $data['school_coords'],
            ]);

            return $ret;
           }

           function getSchoolInfo($school_id)
           {
               $ret = [];
               $s = SchoolInfo::where('id',$school_id)->first();

               if($s != null)
               {
                   $ret['id'] = $s->id;
                   $ret['school_id'] = $s->school_id;
                   $ret['boarding_type'] = $s->boarding_type;
                   $ret['hbu'] = $s->hbu;
                   $ret['hbu_other'] = $s->hbu_other;
                   $ret['school_name'] = $s->school_name;
                   $ret['school_type'] = $s->school_type;
                   $ret['school_curriculum'] = $s->school_curriculum;
                   $ret['school_fees'] = $s->school_fees;
                   $ret['wcu'] = $s->wcu;
                   $ret['school_coords'] = $s->school_coords;
               }

               return $ret;
           }

           function updateSchoolInfo($data)
           {      
                  
            $ret = [];
            $s = SchoolInfo::where('id',$data['school_id'])->first();
            
            if($s != null)
            {
                    $payload = [];
                    if(isset($data['boarding_type'])) $payload['boarding_type'] = $data['boarding_type'];
                    if(isset($data['hbu'])) $payload['hbu'] = $data['hbu'];
                    if(isset($data['hbu_other'])) $payload['hbu_other'] = $data['hbu_other'];
                    if(isset($data['school_name'])) $payload['school_name'] = $data['school_name'];
                    if(isset($data['school_type'])) $payload['school_type'] = $data['school_type'];
                    if(isset($data['school_curriculum'])) $payload['school_curriculum'] = $data['school_curriculum'];
                    if(isset($data['school_fees'])) $payload['school_fees'] = $data['school_fees'];
                    if(isset($data['wcu'])) $payload['wcu'] = $data['wcu'];
                    if(isset($data['school_coords'])) $payload['school_coords'] = $data['school_coords'];
                    
                    $s->update($payload);
                     $ret = "ok";      
            }
           }

           function removeSchoolInfo($id)
           {
               $p = SchoolInfo::where('id',$id)->first();
               if($p != null) $p->delete();
           }

           function addSchoolFacility($data)
           {
            $ret = SchoolFacilities::create([
                'school_id' => $data['school_id'],
                'facility_id' => $data['facility_id']
            ]);

            return $ret;
           }

           function getSchoolFacilities($school_id)
           {
               $ret = [];
               $facilities = SchoolFacilities::where('school_id',$school_id)->get();

               if($facilities != null)
               {
                  foreach($facilities as $f)
                  {
                      $temp = $this->getSchoolFacility($f->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getSchoolFacility($id)
           {
               $ret = [];
               $s = SchoolFacilities::where('id',$id)->first();

               if($s != null)
               {
                   $ret['id'] = $s->id;
                   $ret['school_id'] = $s->school_id;
                   $ret['facility'] = $this->getFacility($s->facility_id);
               }

               return $ret;
           }

          

           function removeSchoolFacility($id)
           {
               $p = SchoolFacilities::where('id',$id)->first();
               if($p != null) $p->delete();
           }

           function addFacility($data)
           {
            $ret = Facilities::create([
                'facility_name' => $data['facility_name'],
                'facility_value' => $data['facility_value'],
                'icon' => $data['hbu'],
            ]);

            return $ret;
           }

           function getFacilities()
           {
               $ret = [];
               $facilities = Facilities::where('id','>',0)->get();

               if($facilities != null)
               {
                  foreach($facilities as $f)
                  {
                      $temp = $this->getFacility($f->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getFacility($id)
           {
               $ret = [];
               $s = Facilities::where('id',$id)->first();

               if($s != null)
               {
                   $ret['id'] = $s->id;
                   $ret['facility_name'] = $s->facility_name;
                   $ret['facility_value'] = $s->facility_value;
                   $ret['icon'] = $s->icon;
               }

               return $ret;
           }

           function removeFacility($id)
           {
               $p = Facilities::where('id',$id)->first();
               if($p != null) $p->delete();
           }

           function addSchoolOwner($data)
           {
            $ret = SchoolOwners::create([
                'school_id' => $data['school_id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);

            return $ret;
           }

          
           function getSchoolOwner($school_id)
           {
               $ret = [];
               $s = SchoolOwners::where('id',$school_id)->first();

               if($s != null)
               {
                   $ret['id'] = $s->id;
                   $ret['school_id'] = $s->school_id;
                   $ret['name'] = $s->name;
                   $ret['email'] = $s->email;
                   $ret['phone'] = $s->phone;
               }

               return $ret;
           }

           function updateSchoolOwner($data)
           {      
                  
            $ret = [];
            $s = SchoolOwners::where('id',$data['school_id'])->first();
            
            if($s != null)
            {
                    $payload = [];
                    if(isset($data['name'])) $payload['name'] = $data['name'];
                    if(isset($data['email'])) $payload['email'] = $data['email'];
                    if(isset($data['phone'])) $payload['phone'] = $data['phone'];
                    
                    $s->update($payload);
                     $ret = "ok";      
            }
           }

           function removeSchoolOwner($id)
           {
               $p = SchoolOwners::where('id',$id)->first();
               if($p != null) $p->delete();
           }

           function addSchoolResource($data)
           {
            $ret = SchoolResources::create([
                'school_id' => $data['school_id'],
                'url' => $data['url']
            ]);

            return $ret;
           }

           function getSchoolResources($school_id)
           {
               $ret = [];
               $resources = SchoolResources::where('school_id',$school_id)->get();

               if($resources != null)
               {
                  foreach($resources as $r)
                  {
                      $temp = $this->getSchoolResource($r->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

          
           function getSchoolResource($id)
           {
               $ret = [];
               $r = SchoolResources::where('id',$id)->first();

               if($r != null)
               {
                   $ret['id'] = $r->id;
                   $ret['school_id'] = $r->school_id;
                   $ret['url'] = $r->url;
               }

               return $ret;
           }

           function removeSchoolResource($id)
           {
               $p = SchoolResources::where('id',$id)->first();
               if($p != null) $p->delete();
           }

           function addClub($data)
           {
            $ret = Clubs::create([
                'club_name' => $data['club_name'],
                'club_value' => $data['club_value'],
                'img_url' => $data['img_url'],
            ]);

            return $ret;
           }

           function getClubs()
           {
               $ret = [];
               $clubs = Clubs::where('id','>',0)->get();

               if($clubs != null)
               {
                  foreach($clubs as $c)
                  {
                      $temp = $this->getClub($c->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getClub($id)
           {
               $ret = [];
               $c = Clubs::where('id',$id)->first();

               if($c != null)
               {
                   $ret['id'] = $c->id;
                   $ret['club_name'] = $c->club_name;
                   $ret['club_value'] = $c->club_value;
                   $ret['img_url'] = $c->img_url;
               }

               return $ret;
           }

           function removeClub($id)
           {
               $p = Clubs::where('id',$id)->first();
               if($p != null) $p->delete();
           }

           function addSchoolClub($data)
           {
            $ret = SchoolClubs::create([
                'school_id' => $data['school_id'],
                'club_id' => $data['club_id']
            ]);

            return $ret;
           }

           function getSchoolClubs($school_id)
           {
               $ret = [];
               $clubs = SchoolClubs::where('school_id',$school_id)->get();

               if($clubs != null)
               {
                  foreach($clubs as $c)
                  {
                      $temp = $this->getClub($c->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getSchoolClub($id)
           {
               $ret = [];
               $s = SchoolClubs::where('id',$id)->first();

               if($s != null)
               {
                   $ret['id'] = $s->id;
                   $ret['school_id'] = $s->school_id;
                   $ret['club'] = $this->getClub($s->club_id);
               }

               return $ret;
           }

          

           function removeSchoolClub($id)
           {
               $p = SchoolClubs::where('id',$id)->first();
               if($p != null) $p->delete();
           }

		   
		  
		   
		   function getTestimonials()
           {

           	 $ret = [
				     ['job' => "Eye Insurance",'name' => "George",'img' => "images/locations/loc-3.jpg",'content' => "Kudos to mtb I have been receiving a lot of orders since I began advertising with them"],
				     ['job' => "Maternity drugs",'name' => "Seun",'img' => "images/locations/loc-3.jpg",'content' => "I highly recommend this company for your adverts in Nigeria. I am completely satisfied with their service"],
				     ['job' => "Diabetes",'name' => "Tayo",'img' => "images/locations/loc-3.jpg",'content' => "This guys are awesome! Its very hard to find a service like this in Nigeria today"],
				  
				  ];
				  
              	  
                return $ret;
           }

           function getPasswordResetCode($user)
           {
           	$u = $user; 
               
               if($u != null)
               {
               	//We have the user, create the code
                   $code = bcrypt(rand(125,999999)."rst".$u->id);
               	$u->update(['reset_code' => $code]);
               }
               
               return $code; 
           }
           
           function verifyPasswordResetCode($code)
           {
           	$u = User::where('reset_code',$code)->first();
               
               if($u != null)
               {
               	//We have the user, delete the code
               	$u->update(['reset_code' => '']);
               }
               
               return $u; 
           }	
           
           
           function createSender($data)
           {
            //dd($data);
               $ret = Senders::create([
                   'ss' => $data['ss'],
                   'sp' => $data['sp'],
                   'sa' => $data['sa'],
                   'sec' => $data['sec'],
                   'su' => $data['su'],
                   'spp' => $data['spp'],
                   'sn' => $data['sn'],
                   'se' => $data['se'],
                   'current' => $data['current'],
                   'status' => $data['status']
               ]);

               return $ret;
           }

           function getSenders()
           {
               $ret = [];
               $senders = Senders::where('id','>','0')->get();

               if($senders != null)
               {
                  foreach($senders as $s)
                  {
                      $temp = $this->getSender($s->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }



           function getSender($id)
           {
               $ret = [];
               $s = Senders::where('id',$id)->first();

               if($s != null)
               {
                   $ret['id'] = $s->id;
                   $ret['ss'] = $s->ss;
                   $ret['sp'] = $s->sp;
                   $ret['sa'] = $s->sa;
                   $ret['sec'] = $s->sec;
                   $ret['su'] = $s->su;
                   $ret['spp'] = $s->spp;
                   $ret['sn'] = $s->sn;
                   $ret['se'] = $s->se;
                   $ret['current'] = $s->current;
                   $ret['status'] = $s->status;
               }

               return $ret;
           }

           function getCurrentSender()
           {
            $ret = [];
            $s = Senders::where('current','yes')->first();

            if($s != null)
            {
                $ret = $this->getSender($s->id);
            }

            return $ret;
           }

           function removeSender($id)
           {
               $s = Senders::where('id',$id)->first();

               if($s != null) $s->delete();
           }

           function generateRandomNumber($length=2,$type='alphanumeric')
           {
            $container = $this->chars;
            if($type === 'numeric') $container = $this->nums;
            $result = ''; $temp = []; $temp3 = [];
            for ($i = $length; $i > 0; --$i)
            {
               $temp2 = rand(1,strlen($container)-1);
               if(strlen($container) > $temp2)
               {
                $result .= $container[$temp2];
               } 
            }
            return $result;
          }

          function getUniqueLinkValue($id,$extraText='')
          {
            $ret = $extraText.$this->generateRandomNumber(3)."_r".$id."_r".$this->generateRandomNumber(3);
            return $ret;
          }

          function checkSchoolSignup($s)
          {
            $ret = true;
            if(count($s['resources']) < 1) $ret = false; 
            if(count($s['clubs']) < 1) $ret = false; 
            if(count($s['facilities']) < 1) $ret = false; 
            if(strlen($s['logo']) < 1) $ret = false;
            if(strlen($s['landing_page_pic']) < 1) $ret = false;
            $info = $s['info'];
            if(strlen($info['school_coords']) < 1) $ret = false;

            return $ret;
          }
          
		   

           function callAPI($data) 
           {
           	//form query string
               
              $validation = isset($data['url']) || isset($data['method']) || 
              ($data['method'] === "POST" && isset($data['body']));

			   if($validation)
			   { 
			     $client = new Client([
                 // Base URI is used with relative requests
                 'base_uri' => 'http://httpbin.org',
                 // You can set any number of default request options.
                 //'timeout'  => 2.0,
                 ]);

                 if($data['method'] === 'POST'){
                    $res = $client->request($data['method'], $data['url'],[
                        'json' => $data['body']
                    ]);
                 }
                 else{
                    $res = $client->request($data['method'], $data['url']);
                 }
			     
			  
                 $ret = $res->getBody()->getContents(); 
			 
			     $rett = json_decode($ret);
                 dd($ret);
			     if($rett->status == "ok")
			     {
					//  $this->setNextLead();
			    	//$lead->update(["status" =>"sent"]);					
			     }
			     else
			     {
			    	// $lead->update(["status" =>"pending"]);
			     }
			    }
                else{
				    $ret = json_encode(["status" => "ok","message" => "Validation"]);
			   }
			    
              return $ret; 
           }

           function getSenders2(){
            $ret = $this->callAPI([
                'method' => 'GET',
                'url' => 'http://x1.infinityfreeapp.com/api/senders.php?type=senders'
            ]);

            return $ret;
           }
		          
}
?>