<?php
$void = "javascript:void(0)";
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta name="author" content="">
    <meta name="description" content="">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> | AdmissionBoox</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.png">
    <!-- Style CSS -->
    <!--<link rel="stylesheet" href="css/stylesheet.css">-->
    <link rel="stylesheet" href="css/mmenu.css">
    <link rel="stylesheet" href="css/stylesheet_1.css" id="colors">
    <link rel="stylesheet" href="lib/sweet-alert/sweetalert2.css">
    <link rel="stylesheet" href="lib/apex-charts/apexcharts.css">
    
    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&display=swap&subset=latin-ext,vietnamese"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800" rel="stylesheet"
        type="text/css">
        
      <?php echo $__env->yieldContent('styles'); ?>

      <style type="text/css">
        .dataTables_wrapper .dataTables_filter input{
	         padding: 0px !important;
        }
      </style>
</head>

<?php
$v = isset($isDashboard) && $isDashboard;
$headerClass = $v ? "fixed fullwidth_block dashboard" : "fullwidth";
$headerDivClass = $v ? "not-sticky":"";

?>
<?php
if(isset($isBlankLayout) && $isBlankLayout)
{
?>
<body>
  <?php echo $__env->yieldContent('content'); ?>
</body>
<?php
}
else
{
  ?>
<body class="header-one"> 
  <div id="main_wrapper">
    <!-- Header -->
    <header id="header_part" class="<?php echo e($headerClass); ?>">
            <div id="header" class="<?php echo e($headerDivClass); ?>">
                <div class="container">
                    <div class="utf_left_side">
                        <div id="logo"> <a href="<?php echo e(url('/')); ?>"><img src="images/logo.png" alt=""></a> </div>
                        <div class="mmenu-trigger">
                            <button class="hamburger utfbutton_collapse" type="button">
                                <span class="utf_inner_button_box">
                                    <span class="utf_inner_section"></span>
                                </span>
                            </button>
                        </div>
                        <nav id="navigation" class="style_one">
                            <ul id="responsive">
                                <li>
                                  <a class="current" href="<?php echo e(url('/')); ?>">Home</a>  
                                </li>
                                <li>
                                   <a href="<?php echo e(url('schools')); ?>">Schools</a>
                                </li>
                                <li><a href="#">More</a>
                                    <ul>
                                       <li><a href="<?php echo e(url('scholarships')); ?>">Scholarships</a></li>
                                       <li><a href="<?php echo e(url('help')); ?>">Help</a> </li>
                                    </ul>
                                </li>
                                <li><a href="#">About Us</a>
                                    <ul>
                                       <li><a href="<?php echo e(url('about')); ?>">Who We Are</a></li>
                                       <li><a href="<?php echo e(url('vision-mission')); ?>">Vision/Mission</a></li>
                                       <li><a href="<?php echo e(url('contact')); ?>">Contact Us</a> </li>
                                    </ul>
                                </li>
                                
                               
                               
                            </ul>
                        </nav>
                        <div class="clearfix"></div>
                    </div>
                     <div class="utf_right_side">
                       <div class="header_widget"> 
                        <?php if(isset($user)): ?>
                         <?php echo $__env->make('components.auth-menu',[
                            'user' => $user,
                         ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                         <?php else: ?>
                         <?php echo $__env->make(
        'components.button',
        [
            'href' => "#dialog_signin_part",
            'classes' => "sign-in popup-with-zoom-anim",
            'icon' => "<i class='fa fa-sign-in'></i>",
            'title' => "Sign In"
        ]
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                         
                         <?php endif; ?>
                       </div>
                     </div>

                    <div id="dialog_signin_part" class="zoom-anim-dialog mfp-hide">
                        <div class="small_dialog_header">
                            <h3>Sign In</h3>
                        </div>
                        <div class="utf_signin_form style_one">
                            <ul class="utf_tabs_nav">
                                <li class=""><a href="#tab1">Log In</a></li>
                                <li><a href="#tab2">Register</a></li>
                            </ul>
                            <div class="tab_container alt">
                                <div class="tab_content" id="tab1" style="display:none;">
                                    <form method="post" class="login">
                                        <input type="hidden" id="tk" value="<?php echo e(csrf_token()); ?>">
                                        <p class="utf_row_form utf_form_wide_block">
                                            <?php echo $__env->make('components.form-validation', ['id' => "login-email-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <label for="username">
                                                <input type="text" class="input-text" id="login-email"
                                                    value="" placeholder="Email address" />
                                            </label>
                                        </p>
                                        <p class="utf_row_form utf_form_wide_block has_validation">
                                           <?php echo $__env->make('components.form-validation', ['id' => "login-password-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <label for="password">
                                                <input class="input-text" type="password"  id="login-password"
                                                    placeholder="Password" />
                                            </label>
                                        </p>
                                        <div class="utf_row_form utf_form_wide_block form_forgot_part"> <span
                                                class="lost_password fl_left"> <a href="<?php echo e(url('forgot-password')); ?>">Forgot
                                                    Password?</a> </span>
                                            <div class="checkboxes fl_right">
                                                <input id="remember-me" type="checkbox" name="check">
                                                <label for="remember-me">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="utf_row_form">
                                            <?php echo $__env->make('components.generic-loading', ['message' => 'Signing you in', 'id' => "login-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           
                                        </div>
                                        <div class="utf_row_form">
                                            <a href="#" id="login-btn" class="button border margin-top-5 text-center">Login</a>
                                        </div>
                                        <div class="utf-login_with my-3">
                                            <span class="txt">Or Login in With</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <a href="javascript:void(0);" class="social_bt facebook_btn mb-0"><i
                                                        class="fa fa-facebook"></i> Facebook</a>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <a href="javascript:void(0);" class="social_bt google_btn mb-0"><i
                                                        class="fa fa-google"></i> Google</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab_content" id="tab2" style="display:none;">
                                 <div class="row" id="signup-type-div">
                                    <div class="col-md-12">
                                        <h2>Sign up as:</h2>
                                    </div>
                                    <div class="col-md-6">
                                      <a href="#" onClick="sua('s'); return false;" class="utf_category_small_box_part" style="width: 90%; background-color: #ff7600;"> <i class="im im-icon-Hotel"></i>
			                            <h4>School</h4>
                                      </a>
                                    </div>
                                    <div class="col-md-6">
                                    <a href="#" onClick="sua('p'); return false;" class="utf_category_small_box_part" style="width: 90%; background-color: #ff7600;"> <i class="im im-icon-Business-Mens"></i>
			                            <h4>Parent/Guardian</h4>
                                      </a>
                                    </div>
                                  </div>
                                   <form id="school-signup-form" method="post" class="register">
                                     <h3 id="school-signup-title">School Signup</h3>
                                     <div id="school-signup-section-1">
                                     <p class="utf_row_form utf_form_wide_block">
                                           <?php echo $__env->make('components.form-validation', ['id' => "school-signup-school-name-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           <label for="fname">
                                              <input type="text" class="input-text" id="school-signup-school-name" value="" placeholder="School name" />
                                           </label>
                                        </p>
                                        <p class="utf_row_form utf_form_wide_block">
                                           <?php echo $__env->make('components.form-validation', ['id' => "school-signup-email-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           <label for="fname">
                                              <input type="email" class="input-text" id="school-signup-email" value="" placeholder="Email address" />
                                           </label>
                                        </p>
                                        <p class="utf_row_form utf_form_wide_block">
                                         <?php echo $__env->make('components.form-validation', ['id' => "school-signup-country-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                         <label for="fname">
                                           <select class="selectpicker default" data-selected-text-format="count" value="none" data-size="5" title="Country" id="school-signup-country">
                                             			
                                           </select>
                                         </label>
                                       </p>
                                        <p class="utf_row_form utf_form_wide_block">
                                           <?php echo $__env->make('components.form-validation', ['id' => "school-signup-phone-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           
                                               <label for="fname">
                                                 <input type="number" class="input-text" id="school-signup-phone" value="" placeholder="Phone number" />
                                               </label>
                                        </p>
                                        <p class="utf_row_form utf_form_wide_block">
                                         <?php echo $__env->make('components.form-validation', ['id' => "school-signup-hbu-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                         <label for="fname">
                                           <select class="selectpicker default" data-selected-text-format="count" value="none" data-size="3" title="How did you hear about us?" id="school-signup-hbu">
                                             	<option value="none">Select an option</option>
                                             	<option value="google">Google</option>
                                             	<option value="social">Social Media</option>
                                             	<option value="referral">Referral/Word of mouth</option>
                                             	<option value="event">Event/seminar</option>
                                             	<option value="other">Others (specify)</option>
                                           </select>
                                         </label>
                                       </p>
                                       <p class="utf_row_form utf_form_wide_block">
                                           <?php echo $__env->make('components.form-validation', ['id' => "school-signup-hbu-other-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           
                                               <label for="fname">
                                                 <input type="text" class="input-text" id="school-signup-hbu-other" value="" placeholder="How did you hear about us?" />
                                               </label>
                                        </p>
                                      
                                       <a href="#" id="school-signup-proceed-1" class="button border margin-top-5 text-center">Proceed</a>
                                       <a href="#" id="school-signup-back-1" class="button border margin-top-5 text-center">Back</a>
                                     </div>
                                     <div id="school-signup-section-2">
                                        <p class="utf_row_form utf_form_wide_block">
                                        <?php echo $__env->make('components.form-validation', ['id' => "school-signup-boarding-type-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                         <label for="fname">
                                           <select class="selectpicker default" data-selected-text-format="count" value="none" data-size="3" title="Boarding Type" id="school-signup-boarding-type">
                                             	<option value="none">Select an option</option>
                                             	<option value="both">Day & Boarding</option>
                                             	<option value="day">Boarding Only</option>
                                             	<option value="boarding">Day only</option>
                                           </select>
                                         </label>
                                        </p>
                                        <p class="utf_row_form utf_form_wide_block">
                                           <?php echo $__env->make('components.form-validation', ['id' => "school-signup-school-fees-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           <label for="fname">
                                           <select class="selectpicker default" data-selected-text-format="count" value="none" data-size="3" title="School Fees" id="school-signup-school-fees">
                                             	<option value="none">Select an option</option>
                                             	<option value="50-100">&#8358;50,000 - &#8358;150,000</option>
                                             	<option value="151-300">&#8358;151,000 - &#8358;300,000</option>
                                             	<option value="301-500">&#8358;301,000 - &#8358;500,000</option>
                                             	<option value="501-750">&#8358;501,000 - &#8358;750,000</option>
                                             	<option value="751-1m">&#8358;751,000 - &#8358;1,000,000</option>
                                             	<option value="above-1m">Above &#8358;1,000,000</option>
                                           </select>
                                         </label>
                                        </p>
                                       
                                       
                                        <a href="#" id="school-signup-proceed-2" class="button border margin-top-5 text-center">Proceed</a>
                                        <a href="#" id="school-signup-back-2" class="button border margin-top-5 text-center">Back</a>
                                     </div>
                                     <div id="school-signup-section-3">
                                         <h4>Description</h4>
                                         <p style="color: #000000;">Write about your school. Why should parentsand guardians entrust their wards with you?</p>
                                         <p class="text-danger text-bold">Not more than 400 characters.</p>
                                         <p class="utf_row_form utf_form_wide_block">
                                           <?php echo $__env->make('components.form-validation', ['id' => "school-signup-wcu-validation",'message' => "This field is required and cannot be more than 400 characters"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           <label for="fname">
                                              <textarea class="input-text" id="school-signup-wcu" value="" rows="8" placeholder="Why should parents/guardians choose you?"></textarea>

                                           </label>
                                        </p>
                                       
                                        <a href="#" id="school-signup-proceed-3" class="button border margin-top-5 text-center">Proceed</a>
                                        <a href="#" id="school-signup-back-3" class="button border margin-top-5 text-center">Back</a>
                                     </div>
                                     <div id="school-signup-section-4">
                                     <h4>School Owner</h4>
                                      <p style="color: #000000;">Information about school owner</p>
                                        <p class="utf_row_form utf_form_wide_block">
                                           <?php echo $__env->make('components.form-validation', ['id' => "school-signup-owner-name-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           <label for="fname">
                                           <input class="input-text" type="text" id="school-signup-owner-name" placeholder="Full name" />
                                           </label>
                                        </p>
                                        <p class="utf_row_form utf_form_wide_block">
                                           <?php echo $__env->make('components.form-validation', ['id' => "school-signup-owner-phone-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           <label for="fname">
                                           <input class="input-text" type="email" id="school-signup-owner-phone" placeholder="Phone number" />
                                           </label>
                                        </p>
                                        <p class="utf_row_form utf_form_wide_block">
                                           <?php echo $__env->make('components.form-validation', ['id' => "school-signup-owner-email-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           <label for="fname">
                                           <input class="input-text" type="email"  id="school-signup-owner-email" placeholder="Email address" />
                                           </label>
                                        </p>
                                        
                                        
                                        <a href="#" id="school-signup-proceed-4" class="button border margin-top-5 text-center">Proceed</a>
                                        <a href="#" id="school-signup-back-4" class="button border margin-top-5 text-center">Back</a>
                                     </div>
                                     <div id="school-signup-section-5">
                                       <p class="utf_row_form utf_form_wide_block">
                                           <?php echo $__env->make('components.form-validation', ['id' => "school-signup-url-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           <label for="fname">
                                           <input class="input-text" type="text" id="school-signup-url" placeholder="Preferred URL" />
                                           </label>
                                           <p style="color: #000000; font-style: 'italics';"><span id="school-signup-url-display"></span>.admissionboox.com</p>
                                        </p>
                                       <p class="utf_row_form utf_form_wide_block">
                                           <?php echo $__env->make('components.form-validation', ['id' => "school-signup-school-type-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           <label for="fname">
                                           <select class="selectpicker default" data-selected-text-format="count" value="none" data-size="3" title="School Type" id="school-signup-school-type">
                                             	<option value="none">Select an option</option>
                                             	<option value="early-only">Early years only</option>
                                             	<option value="primary-only">Primary only</option>
                                             	<option value="secondary-only">Secondary only</option>
                                             	<option value="early-primary-secondary">Early years, primary, secondary</option>
                                             	<option value="primary-secondary">Primary, Secondary</option>
                                           </select>
                                         </label>
                                        </p>

                                        <p class="utf_row_form utf_form_wide_block">
                                           <?php echo $__env->make('components.form-validation', ['id' => "school-signup-school-curriculum-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           <label for="fname">
                                           <select class="selectpicker default" data-selected-text-format="count" value="none" data-size="3" title="School Curriculum" id="school-signup-school-curriculum">
                                             	<option value="none">Select an option</option>
                                             	<option value="nigeria">Nigeria</option>
                                             	<option value="british">British</option>
                                             	<option value="british-nigeria">British Nigeria</option>
                                             	<option value="montessori">Montessori</option>
                                           </select>
                                         </label>
                                        </p>

                                        <div class="utf_row_form">
                                         <?php echo $__env->make('components.generic-loading', ['message' => 'Registering your school info', 'id' => "school-signup-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>

                                        <a href="#" id="school-signup-btn" class="button border margin-top-5 text-center">Proceed</a>
                                        <a href="#" id="school-signup-back-5" class="button border margin-top-5 text-center">Back</a>
                                     </div>
                                    
                                     
                                 </form>
                                    <form id="parent-signup-form" method="post" class="register">
                                    <h3 id="parent-signup-title">Parent Signup</h3>
                                        <div id="parent-signup-section-1">
                                          <p class="utf_row_form utf_form_wide_block">
                                            <?php echo $__env->make('components.form-validation', ['id' => "parent-signup-fname-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <label for="fname">
                                                <input type="text" class="input-text" id="parent-signup-fname"
                                                    value="" placeholder="First Name" />
                                            </label>
                                          </p>
                                          <p class="utf_row_form utf_form_wide_block">
                                            <?php echo $__env->make('components.form-validation', ['id' => "parent-signup-lname-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <label for="fname">
                                                <input type="text" class="input-text" id="parent-signup-lname"
                                                    value="" placeholder="Last Name" />
                                            </label>
                                          </p>
                                          <p class="utf_row_form utf_form_wide_block">
                                            <?php echo $__env->make('components.form-validation', ['id' => "parent-signup-gender-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <label for="fname">
                                              <select class="selectpicker default" data-selected-text-format="count" value="none" data-size="2" title="Gender" id="parent-signup-gender">
					                            <option value="male">Male</option>				
					                            <option value="female">Female</option>				
					                          </select>
                                            </label>
                                          </p>
                                          <a href="#" id="parent-signup-proceed-1" class="button border margin-top-5 text-center">Proceed</a>
                                          <a href="#" id="parent-signup-back-1" class="button border margin-top-5 text-center">Back</a>
                                        </div>
                                        <div id="parent-signup-section-2">
                                           <p class="utf_row_form utf_form_wide_block">
                                              <?php echo $__env->make('components.form-validation', ['id' => "parent-signup-email-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                              <label for="fname">
                                                 <input type="text" class="input-text" id="parent-signup-email" value="" placeholder="Email address" />
                                              </label>
                                           </p>
                                           <p class="utf_row_form utf_form_wide_block">
                                              <?php echo $__env->make('components.form-validation', ['id' => "parent-signup-phone-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                              <label for="fname">
                                                 <input type="text" class="input-text" id="parent-signup-phone" value="" placeholder="Phone number" />
                                              </label>
                                           </p>
                                          
                                           <a href="#" id="parent-signup-proceed-2" class="button border margin-top-5 text-center">Proceed</a>
                                           <a href="#" id="parent-signup-back-2" class="button border margin-top-5 text-center">Back</a>
                                        </div>
                                        <div id="parent-signup-section-3">
                                           <p class="utf_row_form utf_form_wide_block">
                                              <?php echo $__env->make('components.form-validation', ['id' => "parent-signup-country-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                              <label for="fname">
                                              <select class="selectpicker default" data-selected-text-format="count" value="none" data-size="2" title="Country" id="parent-signup-country">
					                            <option value="nigeria">Nigeria</option>					
					                          </select>
                                              </label>
                                           </p>
                                           <p class="utf_row_form utf_form_wide_block">
                                              <?php echo $__env->make('components.form-validation', ['id' => "parent-signup-city-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                              <label for="fname">
                                                 <input type="text" class="input-text" id="parent-signup-city" value="" placeholder="City" />
                                              </label>
                                           </p>
                                           <p class="utf_row_form utf_form_wide_block">
                                              <?php echo $__env->make('components.form-validation', ['id' => "parent-signup-address-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                              <label for="fname">
                                                 <input type="text" class="input-text" id="parent-signup-address" value="" placeholder="Address" />
                                              </label>
                                           </p>
                                           <a href="#" id="parent-signup-proceed-3" class="button border margin-top-5 text-center">Proceed</a>
                                           <a href="#" id="parent-signup-back-3" class="button border margin-top-5 text-center">Back</a>
                                        </div>
                                        <div id="parent-signup-section-4">
                                           <p class="utf_row_form utf_form_wide_block">
                                              <?php echo $__env->make('components.form-validation', ['id' => "parent-signup-password-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                              <label for="fname">
                                              <input class="input-text" type="password" id="parent-signup-password" placeholder="Password" />
                                              </label>
                                           </p>
                                           <p class="utf_row_form utf_form_wide_block">
                                              <?php echo $__env->make('components.form-validation', ['id' => "parent-signup-password2-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                              <label for="fname">
                                              <input class="input-text" type="password" name="password2" id="parent-signup-password2" placeholder="Confirm Password" />
                                              </label>
                                           </p>
                                           <div class="utf_row_form">
                                            <?php echo $__env->make('components.generic-loading', ['message' => 'Signing you up', 'id' => "parent-signup-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           </div>
                                           
                                           <a href="#" id="parent-signup-btn" class="button border margin-top-5 text-center">Signup</a>
                                           <a href="#" id="parent-signup-back-4" class="button border margin-top-5 text-center">Back</a>
                                        </div>
                                       
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="clearfix"></div>

        <?php echo $__env->yieldContent('content'); ?>

    <?php
     if($v){
      //Do nothing
     }
     else{
    ?>
     <!-- Footer -->
      <div id="footer" class="footer_sticky_part">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <h4>About Us</h4>
                        <p>AdmissionBOOX serves as a comprehensive, all-in-one solution for optimizing the admissions process and providing a superior user experience for all stakeholders involved.</p>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6">
                        <h4>Useful Links</h4>
                        <ul class="social_footer_link">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Listing</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6">
                        <h4>My Account</h4>
                        <ul class="social_footer_link">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">My Listing</a></li>
                            <li><a href="#">Favorites</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6">
                        <h4>Pages</h4>
                        <ul class="social_footer_link">
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Our Partners</a></li>
                            <li><a href="#">How It Work</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6">
                        <h4>Help</h4>
                        <ul class="social_footer_link">
                            <li><a href="#dialog_signin_part">Sign In</a></li>
                            <li><a href="#dialog_signin_part">Register</a></li>
                            <li><a href="#">Add Listing</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="footer_copyright_part">Copyright &copy; <?php echo e(date('Y')); ?>, All Rights Reserved.</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="bottom_backto_top"><a href="#"></a></div>
  </div>
  <?php
     }
  ?>
    <!-- Scripts 
    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '1789324864895693',
      xfbml            : true,
      version          : 'v19.0'
    });
  };
</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>-->
   

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/chosen.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/rangeslider.min.js"></script>
    <script src="js/magnific-popup.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/dropzone.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/mmenu.js"></script>
    <script src="js/tooltips.min.js"></script>
    <script src="js/jquery_custom.js"></script>
    <script src="js/lists.js"></script>
    <script src="lib/sweet-alert/sweetalert2.js"></script>
    <script type="module" src="lib/micromodal/micromodal.min.js"></script>
    <script src="lib/apex-charts/apexcharts.min.js"></script>
    <script src="js/helpers.js?ver=<?php echo e(rand(999, 9999999)); ?>"></script>
    
    <script>
      const parentDestinations = ['signup-type-div','parent-signup-section-1','parent-signup-section-2','parent-signup-section-3','parent-signup-section-4'],
            schoolDestinations = ['signup-type-div','school-signup-section-1','school-signup-section-2','school-signup-section-3','school-signup-section-4','school-signup-section-5']
      
            const sua = (t) => {
         if(t === 'p'){
            $('#signup-type-div').hide()
            $('#parent-signup-section-1').fadeIn()
            $('#school-signup-form').hide()
            $('#parent-signup-form').fadeIn()
            $('#school-signup-title').hide()
            $('#parent-signup-title').fadeIn()
         }
         else if(t === 's'){
            $('#signup-type-div').hide()
            $('#school-signup-section-1').fadeIn()
            $('#parent-signup-form').hide()
            $('#school-signup-form').fadeIn()
            $('#parent-signup-title').hide()
            $('#school-signup-title').fadeIn()
         }
       }

       const goBack = (type='',dest='') => {
         const dests = type === 'p' ? parentDestinations : schoolDestinations
      
         if(dests.length > 0){
          for(const d of dests){
            if(d === dest){
              $(`#${d}`).fadeIn()
            }
            else{
              $(`#${d}`).hide()
            }
          }
         }
       }

        $(document).ready(async () => {
          $('.form-loading').hide()
          $('.form-validation').hide()
          $('#school-signup-form').hide()
          $('#parent-signup-form').hide()
          $('#parent-signup-title').hide()
          $('#school-signup-title').hide()
          $('#parent-signup-section-2').hide()
          $('#parent-signup-section-3').hide()
          $('#parent-signup-section-4').hide()

          $('#school-signup-section-2').hide()
          $('#school-signup-section-3').hide()
          $('#school-signup-section-4').hide()
          $('#school-signup-section-5').hide()

          $('#school-signup-hbu-other').hide()

          $('#school-signup-hbu').change(() => {
            const v = $('#school-signup-hbu').val()

            if(v === 'other'){
              $('#school-signup-hbu-other').fadeIn()
            }
            else{
              $('#school-signup-hbu-other').hide()
            }
          })

          $('#school-signup-url').on('input',() => {
            const v = $('#school-signup-url').val()

            $('#school-signup-url-display').html(v)
          })

          let temp = `<option value="Nigeria">Nigeria (234)</option><hr>`
          for(const c of countryCodes){
            temp += `<option value="${c.country}">${c.country}(${c.code})</option>`
          }
          $('#school-signup-country').html(temp)

       

          $('#login-btn').click((e) => {
            e.preventDefault()
            $('.form-validation').hide()

            const u = $('#login-email').val(), p = $('#login-password').val(),
                  tk = $('#login-tk').val()

            if(u === '' || p === ''){
                if(u === '') $('#login-email-validation').fadeIn()
                if(p === '') $('#login-password-validation').fadeIn()
            }
            else{
                $('#login-btn').hide()
                $('#login-loading').fadeIn()
                const fd = new FormData()
                fd.append('_token',tk)
                fd.append('email',u)
                fd.append('password',p)
                login(fd,
                 (responseJSON) => {
                    $('#login-loading').hide()
                    $('#login-btn').fadeIn()
                    let responseMessage = ''

                    if(responseJSON.status === "ok"){
                      window.location = 'dashboard'
                    }
                    else{
                        if(responseJSON.message === 'auth'){
                         responseMessage = 'Failed to sign in: Username or password incorrect'
                        }
                        else if(responseJSON.message === 'validation'){
                          responseMessage = 'Failed to sign in: All fields are required'
                        }
                        else{
                          responseMessage = responseJSON?.message
                        }
                        alert(responseMessage)
                    }
                 },
                 (errJSON) => {
                    $('#login-loading').hide()
                    $('#login-btn').fadeIn()
                    alert(`Failed to sign in: ${errJSON?.message}`)
                 }
                )
            }
          })

          $('#school-signup-proceed-1').click(e => {
            e.preventDefault()
            $('.form-validation').hide()

            const schoolName = $('#school-signup-school-name').val(), email = $('#school-signup-email').val(),
                  country = $('#school-signup-country').val(), phone = $('#school-signup-phone').val(),
                   hbu = $('#school-signup-hbu').val(), hbuOther = $('#school-signup-hbu-other').val()

            const v = schoolName === '' || email === '' || country === 'none' || phone === '' ||
                      (hbu === 'none' || hbu === '') || (hbu === 'other' && hbuOther === '')
      
            if(v){
              if(schoolName === '') $('#school-signup-school-name-validation').fadeIn()
              if(email === '') $('#school-signup-email-validation').fadeIn()
              if(country === '') $('#school-signup-country-validation').fadeIn()
              if(phone === '') $('#school-signup-phone-validation').fadeIn()
              if(hbu === 'none' || hbu === '') $('#school-signup-hbu-validation').fadeIn()
              if(hbu === 'other' && hbuOther === '') $('#school-signup-hbu-other-validation').fadeIn()
            }
            else{
              $('#school-signup-section-1').hide()
              $('#school-signup-section-3').hide()
              $('#school-signup-section-4').hide()
              $('#school-signup-section-5').hide()
              $('#school-signup-section-2').fadeIn()
            }
          })

          $('#school-signup-back-1').click(e => {
            e.preventDefault()
            $('#school-signup-section-1').hide()
            $('#school-signup-section-3').hide()
            $('#school-signup-section-4').hide()
            $('#school-signup-section-2').hide()
            $('#school-signup-title').hide()
            
            $('#signup-type-div').fadeIn()
          })

          $('#school-signup-proceed-2').click(e => {
            e.preventDefault()
            $('.form-validation').hide()

            const boardingType = $('#school-signup-boarding-type').val(), schoolFees = $('#school-signup-school-fees').val()

            const v = (boardingType === 'none' || boardingType === '') || (schoolFees === 'none' || schoolFees === '')
      
            if(v){
              if(boardingType === 'none' || boardingType === '') $('#school-signup-boarding-type-validation').fadeIn()
              if(schoolFees === 'none' || schoolFees === '') $('#school-signup-school-fees-validation').fadeIn()
            }
            else{
              $('#school-signup-section-1').hide()
              $('#school-signup-section-2').hide()
              $('#school-signup-section-4').hide()
              $('#school-signup-section-5').hide()
              $('#school-signup-section-3').fadeIn()
            }
          })

          $('#school-signup-back-2').click(e => {
            e.preventDefault()
            $('#school-signup-section-2').hide()
            $('#school-signup-section-3').hide()
            $('#school-signup-section-4').hide()
            $('#school-signup-section-5').hide()
             $('#school-signup-section-1').fadeIn()
          })

          $('#school-signup-proceed-3').click(e => {
            e.preventDefault()
            $('.form-validation').hide()

            const wcu = $('#school-signup-wcu').val()

            const v = wcu === '' || wcu.length > 400
      
            if(v){
               $('#school-signup-wcu-validation').fadeIn()
            }
            else{
              $('#school-signup-section-1').hide()
              $('#school-signup-section-2').hide()
              $('#school-signup-section-3').hide()
              $('#school-signup-section-5').hide()
              $('#school-signup-section-4').fadeIn()
            }
          })

          $('#school-signup-back-3').click(e => {
            e.preventDefault()
            $('#school-signup-section-1').hide()
            $('#school-signup-section-3').hide()
            $('#school-signup-section-4').hide()
            $('#school-signup-section-5').hide()
             $('#school-signup-section-2').fadeIn()
          })

          $('#school-signup-proceed-4').click(e => {
            e.preventDefault()
            $('.form-validation').hide()

            const ownerName = $('#school-signup-owner-name').val(), ownerEmail = $('#school-signup-owner-email').val(),
                  ownerPhone = $('#school-signup-owner-phone').val()

            const v = ownerName === '' || ownerEmail === '' || ownerPhone === ''
      
            if(v){
              if(ownerName === '') $('#school-signup-owner-name-validation').fadeIn()
              if(ownerEmail === '') $('#school-signup-owner-email-validation').fadeIn()
              if(ownerPhone === '') $('#school-signup-owner-phone-validation').fadeIn()
            }
            else{
              $('#school-signup-section-1').hide()
              $('#school-signup-section-2').hide()
              $('#school-signup-section-3').hide()
              $('#school-signup-section-4').hide()
              $('#school-signup-section-5').fadeIn()
            }
          })

          $('#school-signup-back-4').click(e => {
            e.preventDefault()
            $('#school-signup-section-2').hide()
            $('#school-signup-section-1').hide()
            $('#school-signup-section-4').hide()
            $('#school-signup-section-5').hide()
             $('#school-signup-section-3').fadeIn()
          })

          $('#school-signup-back-5').click(e => {
            e.preventDefault()
            $('#school-signup-section-2').hide()
            $('#school-signup-section-3').hide()
            $('#school-signup-section-1').hide()
            $('#school-signup-section-5').hide()
             $('#school-signup-section-4').fadeIn()
          })

          $('#school-signup-btn').click(e => {
            e.preventDefault()
            $('.form-validation').hide()

            const schoolName = $('#school-signup-school-name').val(), email = $('#school-signup-email').val(),
                  country = $('#school-signup-country').val(), phone = $('#school-signup-phone').val(),
                   hbu = $('#school-signup-hbu').val(), hbuOther = $('#school-signup-hbu-other').val(),
                   v1 = schoolName === '' || email === '' || country === 'none' || phone === '' ||
                      (hbu === 'none' || hbu === '') || (hbu === 'other' && hbuOther === '')

            const boardingType = $('#school-signup-boarding-type').val(), schoolFees = $('#school-signup-school-fees').val(),
                  v2 = (boardingType === 'none' || boardingType === '') || (schoolFees === 'none' || schoolFees === '')

            const wcu = $('#school-signup-wcu').val(), v3 = wcu === ''

            const ownerName = $('#school-signup-owner-name').val(), ownerEmail = $('#school-signup-owner-email').val(),
                  ownerPhone = $('#school-signup-owner-phone').val(), v4 = ownerName === '' || ownerEmail === '' || ownerPhone === ''

            const url = $('#school-signup-url').val(), schoolType = $('#school-signup-school-type').val(),
                  schoolCurriculum = $('#school-signup-school-curriculum').val(),
                  v5 = url === '' ||schoolType === '' || schoolCurriculum === ''
            
            const v = v1 || v2 || v3 || v4 || v5


           if(v){
             if(v5){
               if(url === '') $('#school-signup-url-validation').fadeIn()
               if(schoolName === '') $('#school-signup-school-type-validation').fadeIn()
               if(schoolCurriculum === '') $('#school-signup-school-curriculum-validation').fadeIn()
             }
             else{
              alert('All fields are required')
             }
            }
            else{
              const payload = {
                schoolName,email,country,phone,hbu,hbuOther,
                boardingType,schoolFees,
                wcu,
                ownerName,ownerEmail,ownerPhone,
                url,schoolType,schoolCurriculum
              }

              $('#school-signup-btn').hide()
              $('#school-signup-loading').fadeIn()

              const fd = new FormData()
                    fd.append('schoolName',schoolName)
                    fd.append('email',email)
                    fd.append('phone',phone)
                    fd.append('country',country)
                    fd.append('hbu',hbu)
                    fd.append('hbuOther',hbuOther)
                    fd.append('boardingType',boardingType)
                    fd.append('schoolFees',schoolFees)
                    fd.append('wcu',wcu)
                    fd.append('ownerName',ownerName)
                    fd.append('ownerEmail',ownerEmail)
                    fd.append('ownerPhone',ownerPhone)
                    fd.append('url',url)
                    fd.append('schoolType',schoolType)
                    fd.append('schoolCurriculum',schoolCurriculum)

                    schoolSignup(fd,
                 (responseJSON) => {
                  $('#school-signup-loading').hide()
                $('#school-signup-btn').fadeIn()
                    let responseMessage = ''

                    if(responseJSON.status === "ok"){
                        alert('Signup successful! Please check your email to continue. (Check your spam if you dont get it in your inbox.)')
                      window.location = '/'
                    }
                    else{
                        if(responseJSON.message === 'validation'){
                          responseMessage = 'Failed to sign up: All fields are required'
                        }
                        else if(responseJSON.message === 'existing-user'){
                          responseMessage = 'Failed to sign up: User already exists!'
                        }
                        else{
                          responseMessage = responseJSON?.message
                        }
                        alert(responseMessage)
                    }
                 },
                 (errJSON) => {
                  $('#school-signup-loading').hide()
                $('#school-signup-btn').fadeIn()
                    alert(`Failed to sign up: ${errJSON?.message}`)
                 }
                )
              
            }
          })

          $('#parent-signup-proceed-1').click(e => {
            e.preventDefault()
            $('.form-validation').hide()

            const fname = $('#parent-signup-fname').val(),lname = $('#parent-signup-fname').val(), gender = $('#parent-signup-gender').val(),
            v = fname === '' || lname === '' || gender === ''
      
            if(v){
              if(fname === '') $('#parent-signup-fname-validation').fadeIn()
              if(lname === '') $('#parent-signup-lname-validation').fadeIn()
              if(gender === '') $('#parent-signup-gender-validation').fadeIn()
            }
            else{
              $('#parent-signup-section-1').hide()
              $('#parent-signup-section-3').hide()
              $('#parent-signup-section-4').hide()
              $('#parent-signup-section-2').fadeIn()
            }
          })

          $('#parent-signup-back-1').click(e => {
            e.preventDefault()
            $('#parent-signup-section-1').hide()
            $('#parent-signup-section-3').hide()
            $('#parent-signup-section-4').hide()
            $('#parent-signup-section-2').hide()
            $('#parent-signup-title').hide()
            
            $('#signup-type-div').fadeIn()
          })

          $('#parent-signup-proceed-2').click(e => {
            e.preventDefault()
            $('.form-validation').hide()

            const email = $('#parent-signup-email').val(), phone = $('#parent-signup-phone').val(),
            v = email === '' || phone === ''

            if(v){
                if(email === '' || phone === ''){
                    if(email === '') $('#parent-signup-email-validation').fadeIn()
                    if(phone === '') $('#parent-signup-phone-validation').fadeIn()
                }
            }
            else{
              $('#parent-signup-section-1').hide()
              $('#parent-signup-section-2').hide()
              $('#parent-signup-section-4').hide()
              $('#parent-signup-section-3').fadeIn()
            }
          })

          $('#parent-signup-back-2').click(e => {
            e.preventDefault()
            $('#parent-signup-section-3').hide()
            $('#parent-signup-section-4').hide()
            $('#parent-signup-section-2').hide()
            $('#parent-signup-section-1').fadeIn()
          })

          $('#parent-signup-proceed-3').click(e => {
            e.preventDefault()
            $('.form-validation').hide()

            const country = $('#parent-signup-country').val(), city = $('#parent-signup-city').val(), address = $('#parent-signup-address').val(),
            v = country === '' || city === '' || address === ''

            if(v){
                 if(country === '') $('#parent-signup-country-validation').fadeIn()
                    if(city === '') $('#parent-signup-city-validation').fadeIn()
                    if(address === '') $('#parent-signup-address-validation').fadeIn()
            }
            else{
              $('#parent-signup-section-1').hide()
              $('#parent-signup-section-2').hide()
              $('#parent-signup-section-3').hide()
              $('#parent-signup-section-4').fadeIn()
            }
          })

          $('#parent-signup-back-3').click(e => {
            e.preventDefault()
            $('#parent-signup-section-3').hide()
            $('#parent-signup-section-1').hide()
            $('#parent-signup-section-2').hide()
            $('#parent-signup-section-4').fadeIn()
          })

          $('#parent-signup-btn').click(e => {
            e.preventDefault()
            $('.form-validation').hide()

            const fname = $('#parent-signup-fname').val(),lname = $('#parent-signup-lname').val(), gender = $('#parent-signup-gender').val(), 
            email = $('#parent-signup-email').val(), phone = $('#parent-signup-phone').val(),
            country = $('#parent-signup-country').val(), city = $('#parent-signup-city').val(), address = $('#parent-signup-address').val(),
            pass = $('#parent-signup-password').val(), pass2 = $('#parent-signup-password2').val()

            const v1 = fname === '' || lname === '' || gender === '',
                  v2 = email === '' || phone === '',
                  v3 = country === '' || city === '' || address === '',
                  v4 = pass === '' || pass.length < 6 || pass !== pass2

            if(v1 || v2 || v3 || v4){
                if(v4){
                    if(pass === '') $('#parent-signup-password-validation').fadeIn()
                    if(pass2 === '') $('#parent-signup-password2-validation').fadeIn()
                    if(pass !== pass2){
                        alert('Passwords must match!')
                    }
                }
            }
            else{
                if(v1 || v2 || v3){
                    alert('All fields are required')
                }
                else{
                    $('#signup-btn').hide()
                    $('#signup-loading').fadeIn()
                    const fd = new FormData()
                    fd.append('fname',fname)
                    fd.append('lname',lname)
                    fd.append('gender',gender)
                    fd.append('email',email)
                    fd.append('phone',phone)
                    fd.append('country',country)
                    fd.append('city',city)
                    fd.append('address',address)
                    fd.append('password',pass)
                    fd.append('password_confirmation',pass2)

                    signup(fd,
                 (responseJSON) => {
                    $('#signup-loading').hide()
                    $('#signup-btn').fadeIn()
                    let responseMessage = ''

                    if(responseJSON.status === "ok"){
                        alert('Signup successful! Please sign in to continue')
                      window.location = '/'
                    }
                    else{
                        if(responseJSON.message === 'validation'){
                          responseMessage = 'Failed to sign up: All fields are required'
                        }
                        else if(responseJSON.message === 'existing-user'){
                          responseMessage = 'Failed to sign up: User already exists!'
                        }
                        else{
                          responseMessage = responseJSON?.message
                        }
                        alert(responseMessage)
                    }
                 },
                 (errJSON) => {
                    $('#signup-loading').hide()
                    $('#signup-btn').fadeIn()
                    alert(`Failed to sign up: ${errJSON?.message}`)
                 }
                )
                }
            }
          })
        })
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>

    <!--------- Session notifications-------------->
 <?php
$pop = "";
$val = "";

if (isset($signals)) {
    foreach ($signals['okays'] as $key => $value) {
        if (session()->has($key)) {
            $pop = $key;
            $val = session()->get($key);
        }
    }
}
              
             ?> 

                 <?php if($pop != "" && $val != ""): ?>
                   <?php echo $__env->make('session-status', ['pop' => $pop, 'val' => $val], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <?php endif; ?>


<!--------- Plugins: DO NOT EDIT ------>
<?php
    foreach ($plugins as $p) {
?>
<?php echo $p['value']; ?>

<?php
    }
?>
<!------------------------------------->

</body>
<?php
}
?>

</html><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/layout.blade.php ENDPATH**/ ?>