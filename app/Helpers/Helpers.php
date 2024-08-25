<?php
namespace App\Helpers;

use App\Helpers\Contracts\HelperContract; 
use App\Models\AdmissionClasses;
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
use App\Models\SchoolAddresses;
use App\Models\SchoolFacilities;
use App\Models\SchoolOwners;
use App\Models\SchoolResources;
use App\Models\SchoolBanners;
use App\Models\Terms;
use App\Models\SchoolClasses;
use App\Models\SchoolAdmissions;
use App\Models\AdmissionForms;
use App\Models\FormFields;
use App\Models\SchoolApplications;
use App\Models\ApplicationData;
use App\Models\FormSections;
use App\Models\SchoolBookmarks;
use App\Models\SchoolFaqs;
use App\Models\SchoolNotifications;
use App\Models\SchoolReviews;
use GuzzleHttp\Client;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Helper //implements HelperContract
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

             public $im_icons = [
                "im-icon-A-Z",
                "im-icon-Aa",
                "im-icon-Add-Bag",
                "im-icon-Add-Basket",
                "im-icon-Add-Cart",
                "im-icon-Add-File",
                "im-icon-Add-SpaceAfterParagraph",
                "im-icon-Add-SpaceBeforeParagraph",
                "im-icon-Add-User",
                "im-icon-Add-UserStar",
                "im-icon-Add-Window",
                "im-icon-Add",
                "im-icon-Address-Book",
                "im-icon-Address-Book2",
                "im-icon-Administrator",
                "im-icon-Aerobics-2",
                "im-icon-Aerobics-3",
                "im-icon-Aerobics",
                "im-icon-Affiliate",
                "im-icon-Aim",
                "im-icon-Air-Balloon",
                "im-icon-Airbrush",
                "im-icon-Airship",
                "im-icon-Alarm-Clock",
                "im-icon-Alarm-Clock2",
                "im-icon-Alarm",
                "im-icon-Alien-2",
                "im-icon-Alien",
                "im-icon-Aligator",
                "im-icon-Align-Center",
                "im-icon-Align-JustifyAll",
                "im-icon-Align-JustifyCenter",
                "im-icon-Align-JustifyLeft",
                "im-icon-Align-JustifyRight",
                "im-icon-Align-Left",
                "im-icon-Align-Right",
                "im-icon-Alpha",
                "im-icon-Ambulance",
                "im-icon-AMX",
                "im-icon-Anchor-2",
                "im-icon-Anchor",
                "im-icon-Android-Store",
                "im-icon-Android",
                "im-icon-Angel-Smiley",
                "im-icon-Angel",
                "im-icon-Angry",
                "im-icon-Apple-Bite",
                "im-icon-Apple-Store",
                "im-icon-Apple",
                "im-icon-Approved-Window",
                "im-icon-Aquarius-2",
                "im-icon-Aquarius",
                "im-icon-Archery-2",
                "im-icon-Archery",
                "im-icon-Argentina",
                "im-icon-Aries-2",
                "im-icon-Aries",
                "im-icon-Army-Key",
                "im-icon-Arrow-Around",
                "im-icon-Arrow-Back3",
                "im-icon-Arrow-Back",
                "im-icon-Arrow-Back2",
                "im-icon-Arrow-Barrier",
                "im-icon-Arrow-Circle",
                "im-icon-Arrow-Cross",
                "im-icon-Arrow-Down",
                "im-icon-Arrow-Down2",
                "im-icon-Arrow-Down3",
                "im-icon-Arrow-DowninCircle",
                "im-icon-Arrow-Fork",
                "im-icon-Arrow-Forward",
                "im-icon-Arrow-Forward2",
                "im-icon-Arrow-From",
                "im-icon-Arrow-Inside",
                "im-icon-Arrow-Inside45",
                "im-icon-Arrow-InsideGap",
                "im-icon-Arrow-InsideGap45",
                "im-icon-Arrow-Into",
                "im-icon-Arrow-Join",
                "im-icon-Arrow-Junction",
                "im-icon-Arrow-Left",
                "im-icon-Arrow-Left2",
                "im-icon-Arrow-LeftinCircle",
                "im-icon-Arrow-Loop",
                "im-icon-Arrow-Merge",
                "im-icon-Arrow-Mix",
                "im-icon-Arrow-Next",
                "im-icon-Arrow-OutLeft",
                "im-icon-Arrow-OutRight",
                "im-icon-Arrow-Outside",
                "im-icon-Arrow-Outside45",
                "im-icon-Arrow-OutsideGap",
                "im-icon-Arrow-OutsideGap45",
                "im-icon-Arrow-Over",
                "im-icon-Arrow-Refresh",
                "im-icon-Arrow-Refresh2",
                "im-icon-Arrow-Right",
                "im-icon-Arrow-Right2",
                "im-icon-Arrow-RightinCircle",
                "im-icon-Arrow-Shuffle",
                "im-icon-Arrow-Squiggly",
                "im-icon-Arrow-Through",
                "im-icon-Arrow-To",
                "im-icon-Arrow-TurnLeft",
                "im-icon-Arrow-TurnRight",
                "im-icon-Arrow-Up",
                "im-icon-Arrow-Up2",
                "im-icon-Arrow-Up3",
                "im-icon-Arrow-UpinCircle",
                "im-icon-Arrow-XLeft",
                "im-icon-Arrow-XRight",
                "im-icon-Ask",
                "im-icon-Assistant",
                "im-icon-Astronaut",
                "im-icon-At-Sign",
                "im-icon-ATM",
                "im-icon-Atom",
                "im-icon-Audio",
                "im-icon-Auto-Flash",
                "im-icon-Autumn",
                "im-icon-Baby-Clothes",
                "im-icon-Baby-Clothes2",
                "im-icon-Baby-Cry",
                "im-icon-Baby",
                "im-icon-Back2",
                "im-icon-Back-Media",
                "im-icon-Back-Music",
                "im-icon-Back",
                "im-icon-Background",
                "im-icon-Bacteria",
                "im-icon-Bag-Coins",
                "im-icon-Bag-Items",
                "im-icon-Bag-Quantity",
                "im-icon-Bag",
                "im-icon-Bakelite",
                "im-icon-Ballet-Shoes",
                "im-icon-Balloon",
                "im-icon-Banana",
                "im-icon-Band-Aid",
                "im-icon-Bank",
                "im-icon-Bar-Chart",
                "im-icon-Bar-Chart2",
                "im-icon-Bar-Chart3",
                "im-icon-Bar-Chart4",
                "im-icon-Bar-Chart5",
                "im-icon-Bar-Code",
                "im-icon-Barricade-2",
                "im-icon-Barricade",
                "im-icon-Baseball",
                "im-icon-Basket-Ball",
                "im-icon-Basket-Coins",
                "im-icon-Basket-Items",
                "im-icon-Basket-Quantity",
                "im-icon-Bat-2",
                "im-icon-Bat",
                "im-icon-Bathrobe",
                "im-icon-Batman-Mask",
                "im-icon-Battery-0",
                "im-icon-Battery-25",
                "im-icon-Battery-50",
                "im-icon-Battery-75",
                "im-icon-Battery-100",
                "im-icon-Battery-Charge",
                "im-icon-Bear",
                "im-icon-Beard-2",
                "im-icon-Beard-3",
                "im-icon-Beard",
                "im-icon-Bebo",
                "im-icon-Bee",
                "im-icon-Beer-Glass",
                "im-icon-Beer",
                "im-icon-Bell-2",
                "im-icon-Bell",
                "im-icon-Belt-2",
                "im-icon-Belt-3",
                "im-icon-Belt",
                "im-icon-Berlin-Tower",
                "im-icon-Beta",
                "im-icon-Betvibes",
                "im-icon-Bicycle-2",
                "im-icon-Bicycle-3",
                "im-icon-Bicycle",
                "im-icon-Big-Bang",
                "im-icon-Big-Data",
                "im-icon-Bike-Helmet",
                "im-icon-Bikini",
                "im-icon-Bilk-Bottle2",
                "im-icon-Billing",
                "im-icon-Bing",
                "im-icon-Binocular",
                "im-icon-Bio-Hazard",
                "im-icon-Biotech",
                "im-icon-Bird-DeliveringLetter",
                "im-icon-Bird",
                "im-icon-Birthday-Cake",
                "im-icon-Bisexual",
                "im-icon-Bishop",
                "im-icon-Bitcoin",
                "im-icon-Black-Cat",
                "im-icon-Blackboard",
                "im-icon-Blinklist",
                "im-icon-Block-Cloud",
                "im-icon-Block-Window",
                "im-icon-Blogger",
                "im-icon-Blood",
                "im-icon-Blouse",
                "im-icon-Blueprint",
                "im-icon-Board",
                "im-icon-Bodybuilding",
                "im-icon-Bold-Text",
                "im-icon-Bone",
                "im-icon-Bones",
                "im-icon-Book",
                "im-icon-Bookmark",
                "im-icon-Books-2",
                "im-icon-Books",
                "im-icon-Boom",
                "im-icon-Boot-2",
                "im-icon-Boot",
                "im-icon-Bottom-ToTop",
                "im-icon-Bow-2",
                "im-icon-Bow-3",
                "im-icon-Bow-4",
                "im-icon-Bow-5",
                "im-icon-Bow-6",
                "im-icon-Bow",
                "im-icon-Bowling-2",
                "im-icon-Bowling",
                "im-icon-Box2",
                "im-icon-Box-Close",
                "im-icon-Box-Full",
                "im-icon-Box-Open",
                "im-icon-Box-withFolders",
                "im-icon-Box",
                "im-icon-Boy",
                "im-icon-Bra",
                "im-icon-Brain-2",
                "im-icon-Brain-3",
                "im-icon-Brain",
                "im-icon-Brazil",
                "im-icon-Bread-2",
                "im-icon-Bread",
                "im-icon-Bridge",
                "im-icon-Brightkite",
                "im-icon-Broke-Link2",
                "im-icon-Broken-Link",
                "im-icon-Broom",
                "im-icon-Brush",
                "im-icon-Bucket",
                "im-icon-Bug",
                "im-icon-Building",
                "im-icon-Bulleted-List",
                "im-icon-Bus-2",
                "im-icon-Bus",
                "im-icon-Business-Man",
                "im-icon-Business-ManWoman",
                "im-icon-Business-Mens",
                "im-icon-Business-Woman",
                "im-icon-Butterfly",
                "im-icon-Button",
                "im-icon-Cable-Car",
                "im-icon-Cake",
                "im-icon-Calculator-2",
                "im-icon-Calculator-3",
                "im-icon-Calculator",
                "im-icon-Calendar-2",
                "im-icon-Calendar-3",
                "im-icon-Calendar-4",
                "im-icon-Calendar-Clock",
                "im-icon-Calendar",
                "im-icon-Camel",
                "im-icon-Camera-2",
                "im-icon-Camera-3",
                "im-icon-Camera-4",
                "im-icon-Camera-5",
                "im-icon-Camera-Back",
                "im-icon-Camera",
                "im-icon-Can-2",
                "im-icon-Can",
                "im-icon-Canada",
                "im-icon-Cancer-2",
                "im-icon-Cancer-3",
                "im-icon-Cancer",
                "im-icon-Candle",
                "im-icon-Candy-Cane",
                "im-icon-Candy",
                "im-icon-Cannon",
                "im-icon-Cap-2",
                "im-icon-Cap-3",
                "im-icon-Cap-Smiley",
                "im-icon-Cap",
                "im-icon-Capricorn-2",
                "im-icon-Capricorn",
                "im-icon-Car-2",
                "im-icon-Car-3",
                "im-icon-Car-Coins",
                "im-icon-Car-Items",
                "im-icon-Car-Wheel",
                "im-icon-Car",
                "im-icon-Cardigan",
                "im-icon-Cardiovascular",
                "im-icon-Cart-Quantity",
                "im-icon-Casette-Tape",
                "im-icon-Cash-Register",
                "im-icon-Cash-register2",
                "im-icon-Castle",
                "im-icon-Cat",
                "im-icon-Cathedral",
                "im-icon-Cauldron",
                "im-icon-CD-2",
                "im-icon-CD-Cover",
                "im-icon-CD",
                "im-icon-Cello",
                "im-icon-Celsius",
                "im-icon-Chacked-Flag",
                "im-icon-Chair",
                "im-icon-Charger",
                "im-icon-Check-2",
                "im-icon-Check",
                "im-icon-Checked-User",
                "im-icon-Checkmate",
                "im-icon-Checkout-Bag",
                "im-icon-Checkout-Basket",
                "im-icon-Checkout",
                "im-icon-Cheese",
                "im-icon-Cheetah",
                "im-icon-Chef-Hat",
                "im-icon-Chef-Hat2",
                "im-icon-Chef",
                "im-icon-Chemical-2",
                "im-icon-Chemical-3",
                "im-icon-Chemical-4",
                "im-icon-Chemical-5",
                "im-icon-Chemical",
                "im-icon-Chess-Board",
                "im-icon-Chess",
                "im-icon-Chicken",
                "im-icon-Chile",
                "im-icon-Chimney",
                "im-icon-China",
                "im-icon-Chinese-Temple",
                "im-icon-Chip",
                "im-icon-Chopsticks-2",
                "im-icon-Chopsticks",
                "im-icon-Christmas-Ball",
                "im-icon-Christmas-Bell",
                "im-icon-Christmas-Candle",
                "im-icon-Christmas-Hat",
                "im-icon-Christmas-Sleigh",
                "im-icon-Christmas-Snowman",
                "im-icon-Christmas-Sock",
                "im-icon-Christmas-Tree",
                "im-icon-Christmas",
                "im-icon-Chrome",
                "im-icon-Chrysler-Building",
                "im-icon-Cinema",
                "im-icon-Circular-Point",
                "im-icon-City-Hall",
                "im-icon-Clamp",
                "im-icon-Clapperboard-Close",
                "im-icon-Clapperboard-Open",
                "im-icon-Claps",
                "im-icon-Clef",
                "im-icon-Clinic",
                "im-icon-Clock-2",
                "im-icon-Clock-3",
                "im-icon-Clock-4",
                "im-icon-Clock-Back",
                "im-icon-Clock-Forward",
                "im-icon-Clock",
                "im-icon-Close-Window",
                "im-icon-Close",
                "im-icon-Clothing-Store",
                "im-icon-Cloud--",
                "im-icon-Cloud-",
                "im-icon-Cloud-Camera",
                "im-icon-Cloud-Computer",
                "im-icon-Cloud-Email",
                "im-icon-Cloud-Hail",
                "im-icon-Cloud-Laptop",
                "im-icon-Cloud-Lock",
                "im-icon-Cloud-Moon",
                "im-icon-Cloud-Music",
                "im-icon-Cloud-Picture",
                "im-icon-Cloud-Rain",
                "im-icon-Cloud-Remove",
                "im-icon-Cloud-Secure",
                "im-icon-Cloud-Settings",
                "im-icon-Cloud-Smartphone",
                "im-icon-Cloud-Snow",
                "im-icon-Cloud-Sun",
                "im-icon-Cloud-Tablet",
                "im-icon-Cloud-Video",
                "im-icon-Cloud-Weather",
                "im-icon-Cloud",
                "im-icon-Clouds-Weather",
                "im-icon-Clouds",
                "im-icon-Clown",
                "im-icon-CMYK",
                "im-icon-Coat",
                "im-icon-Cocktail",
                "im-icon-Coconut",
                "im-icon-Code-Window",
                "im-icon-Coding",
                "im-icon-Coffee-2",
                "im-icon-Coffee-Bean",
                "im-icon-Coffee-Machine",
                "im-icon-Coffee-toGo",
                "im-icon-Coffee",
                "im-icon-Coffin",
                "im-icon-Coin",
                "im-icon-Coins-2",
                "im-icon-Coins-3",
                "im-icon-Coins",
                "im-icon-Colombia",
                "im-icon-Colosseum",
                "im-icon-Column-2",
                "im-icon-Column-3",
                "im-icon-Column",
                "im-icon-Comb-2",
                "im-icon-Comb",
                "im-icon-Communication-Tower",
                "im-icon-Communication-Tower2",
                "im-icon-Compass-2",
                "im-icon-Compass-3",
                "im-icon-Compass-4",
                "im-icon-Compass-Rose",
                "im-icon-Compass",
                "im-icon-Computer-2",
                "im-icon-Computer-3",
                "im-icon-Computer-Secure",
                "im-icon-Computer",
                "im-icon-Conference",
                "im-icon-Confused",
                "im-icon-Conservation",
                "im-icon-Consulting",
                "im-icon-Contrast",
                "im-icon-Control-2",
                "im-icon-Control",
                "im-icon-Cookie-Man",
                "im-icon-Cookies",
                "im-icon-Cool-Guy",
                "im-icon-Cool",
                "im-icon-Copyright",
                "im-icon-Costume",
                "im-icon-Couple-Sign",
                "im-icon-Cow",
                "im-icon-CPU",
                "im-icon-Crane",
                "im-icon-Cranium",
                "im-icon-Credit-Card",
                "im-icon-Credit-Card2",
                "im-icon-Credit-Card3",
                "im-icon-Cricket",
                "im-icon-Criminal",
                "im-icon-Croissant",
                "im-icon-Crop-2",
                "im-icon-Crop-3",
                "im-icon-Crown-2",
                "im-icon-Crown",
                "im-icon-Crying",
                "im-icon-Cube-Molecule",
                "im-icon-Cube-Molecule2",
                "im-icon-Cupcake",
                "im-icon-Cursor-Click",
                "im-icon-Cursor-Click2",
                "im-icon-Cursor-Move",
                "im-icon-Cursor-Move2",
                "im-icon-Cursor-Select",
                "im-icon-Cursor",
                "im-icon-D-Eyeglasses",
                "im-icon-D-Eyeglasses2",
                "im-icon-Dam",
                "im-icon-Danemark",
                "im-icon-Danger-2",
                "im-icon-Danger",
                "im-icon-Dashboard",
                "im-icon-Data-Backup",
                "im-icon-Data-Block",
                "im-icon-Data-Center",
                "im-icon-Data-Clock",
                "im-icon-Data-Cloud",
                "im-icon-Data-Compress",
                "im-icon-Data-Copy",
                "im-icon-Data-Download",
                "im-icon-Data-Financial",
                "im-icon-Data-Key",
                "im-icon-Data-Lock",
                "im-icon-Data-Network",
                "im-icon-Data-Password",
                "im-icon-Data-Power",
                "im-icon-Data-Refresh",
                "im-icon-Data-Save",
                "im-icon-Data-Search",
                "im-icon-Data-Security",
                "im-icon-Data-Settings",
                "im-icon-Data-Sharing",
                "im-icon-Data-Shield",
                "im-icon-Data-Signal",
                "im-icon-Data-Storage",
                "im-icon-Data-Stream",
                "im-icon-Data-Transfer",
                "im-icon-Data-Unlock",
                "im-icon-Data-Upload",
                "im-icon-Data-Yes",
                "im-icon-Data",
                "im-icon-David-Star",
                "im-icon-Daylight",
                "im-icon-Death",
                "im-icon-Debian",
                "im-icon-Dec",
                "im-icon-Decrase-Inedit",
                "im-icon-Deer-2",
                "im-icon-Deer",
                "im-icon-Delete-File",
                "im-icon-Delete-Window",
                "im-icon-Delicious",
                "im-icon-Depression",
                "im-icon-Deviantart",
                "im-icon-Device-SyncwithCloud",
                "im-icon-Diamond",
                "im-icon-Dice-2",
                "im-icon-Dice",
                "im-icon-Digg",
                "im-icon-Digital-Drawing",
                "im-icon-Diigo",
                "im-icon-Dinosaur",
                "im-icon-Diploma-2",
                "im-icon-Diploma",
                "im-icon-Direction-East",
                "im-icon-Direction-North",
                "im-icon-Direction-South",
                "im-icon-Direction-West",
                "im-icon-Director",
                "im-icon-Disk",
                "im-icon-Dj",
                "im-icon-DNA-2",
                "im-icon-DNA-Helix",
                "im-icon-DNA",
                "im-icon-Doctor",
                "im-icon-Dog",
                "im-icon-Dollar-Sign",
                "im-icon-Dollar-Sign2",
                "im-icon-Dollar",
                "im-icon-Dolphin",
                "im-icon-Domino",
                "im-icon-Door-Hanger",
                "im-icon-Door",
                "im-icon-Doplr",
                "im-icon-Double-Circle",
                "im-icon-Double-Tap",
                "im-icon-Doughnut",
                "im-icon-Dove",
                "im-icon-Down-2",
                "im-icon-Down-3",
                "im-icon-Down-4",
                "im-icon-Down",
                "im-icon-Download-2",
                "im-icon-Download-fromCloud",
                "im-icon-Download-Window",
                "im-icon-Download",
                "im-icon-Downward",
                "im-icon-Drag-Down",
                "im-icon-Drag-Left",
                "im-icon-Drag-Right",
                "im-icon-Drag-Up",
                "im-icon-Drag",
                "im-icon-Dress",
                "im-icon-Drill-2",
                "im-icon-Drill",
                "im-icon-Drop",
                "im-icon-Dropbox",
                "im-icon-Drum",
                "im-icon-Dry",
                "im-icon-Duck",
                "im-icon-Dumbbell",
                "im-icon-Duplicate-Layer",
                "im-icon-Duplicate-Window",
                "im-icon-DVD",
                "im-icon-Eagle",
                "im-icon-Ear",
                "im-icon-Earphones-2",
                "im-icon-Earphones",
                "im-icon-Eci-Icon",
                "im-icon-Edit-Map",
                "im-icon-Edit",
                "im-icon-Eggs",
                "im-icon-Egypt",
                "im-icon-Eifel-Tower",
                "im-icon-eject-2",
                "im-icon-Eject",
                "im-icon-El-Castillo",
                "im-icon-Elbow",
                "im-icon-Electric-Guitar",
                "im-icon-Electricity",
                "im-icon-Elephant",
                "im-icon-Email",
                "im-icon-Embassy",
                "im-icon-Empire-StateBuilding",
                "im-icon-Empty-Box",
                "im-icon-End2",
                "im-icon-End-2",
                "im-icon-End",
                "im-icon-Endways",
                "im-icon-Engineering",
                "im-icon-Envelope-2",
                "im-icon-Envelope",
                "im-icon-Environmental-2",
                "im-icon-Environmental-3",
                "im-icon-Environmental",
                "im-icon-Equalizer",
                "im-icon-Eraser-2",
                "im-icon-Eraser-3",
                "im-icon-Eraser",
                "im-icon-Error-404Window",
                "im-icon-Euro-Sign",
                "im-icon-Euro-Sign2",
                "im-icon-Euro",
                "im-icon-Evernote",
                "im-icon-Evil",
                "im-icon-Explode",
                "im-icon-Eye-2",
                "im-icon-Eye-Blind",
                "im-icon-Eye-Invisible",
                "im-icon-Eye-Scan",
                "im-icon-Eye-Visible",
                "im-icon-Eye",
                "im-icon-Eyebrow-2",
                "im-icon-Eyebrow-3",
                "im-icon-Eyebrow",
                "im-icon-Eyeglasses-Smiley",
                "im-icon-Eyeglasses-Smiley2",
                "im-icon-Face-Style",
                "im-icon-Face-Style2",
                "im-icon-Face-Style3",
                "im-icon-Face-Style4",
                "im-icon-Face-Style5",
                "im-icon-Face-Style6",
                "im-icon-Facebook-2",
                "im-icon-Facebook",
                "im-icon-Factory-2",
                "im-icon-Factory",
                "im-icon-Fahrenheit",
                "im-icon-Family-Sign",
                "im-icon-Fan",
                "im-icon-Farmer",
                "im-icon-Fashion",
                "im-icon-Favorite-Window",
                "im-icon-Fax",
                "im-icon-Feather",
                "im-icon-Feedburner",
                "im-icon-Female-2",
                "im-icon-Female-Sign",
                "im-icon-Female",
                "im-icon-File-Block",
                "im-icon-File-Bookmark",
                "im-icon-File-Chart",
                "im-icon-File-Clipboard",
                "im-icon-File-ClipboardFileText",
                "im-icon-File-ClipboardTextImage",
                "im-icon-File-Cloud",
                "im-icon-File-Copy",
                "im-icon-File-Copy2",
                "im-icon-File-CSV",
                "im-icon-File-Download",
                "im-icon-File-Edit",
                "im-icon-File-Excel",
                "im-icon-File-Favorite",
                "im-icon-File-Fire",
                "im-icon-File-Graph",
                "im-icon-File-Hide",
                "im-icon-File-Horizontal",
                "im-icon-File-HorizontalText",
                "im-icon-File-HTML",
                "im-icon-File-JPG",
                "im-icon-File-Link",
                "im-icon-File-Loading",
                "im-icon-File-Lock",
                "im-icon-File-Love",
                "im-icon-File-Music",
                "im-icon-File-Network",
                "im-icon-File-Pictures",
                "im-icon-File-Pie",
                "im-icon-File-Presentation",
                "im-icon-File-Refresh",
                "im-icon-File-Search",
                "im-icon-File-Settings",
                "im-icon-File-Share",
                "im-icon-File-TextImage",
                "im-icon-File-Trash",
                "im-icon-File-TXT",
                "im-icon-File-Upload",
                "im-icon-File-Video",
                "im-icon-File-Word",
                "im-icon-File-Zip",
                "im-icon-File",
                "im-icon-Files",
                "im-icon-Film-Board",
                "im-icon-Film-Cartridge",
                "im-icon-Film-Strip",
                "im-icon-Film-Video",
                "im-icon-Film",
                "im-icon-Filter-2",
                "im-icon-Filter",
                "im-icon-Financial",
                "im-icon-Find-User",
                "im-icon-Finger-DragFourSides",
                "im-icon-Finger-DragTwoSides",
                "im-icon-Finger-Print",
                "im-icon-Finger",
                "im-icon-Fingerprint-2",
                "im-icon-Fingerprint",
                "im-icon-Fire-Flame",
                "im-icon-Fire-Flame2",
                "im-icon-Fire-Hydrant",
                "im-icon-Fire-Staion",
                "im-icon-Firefox",
                "im-icon-Firewall",
                "im-icon-First-Aid",
                "im-icon-First",
                "im-icon-Fish-Food",
                "im-icon-Fish",
                "im-icon-Fit-To",
                "im-icon-Fit-To2",
                "im-icon-Five-Fingers",
                "im-icon-Five-FingersDrag",
                "im-icon-Five-FingersDrag2",
                "im-icon-Five-FingersTouch",
                "im-icon-Flag-2",
                "im-icon-Flag-3",
                "im-icon-Flag-4",
                "im-icon-Flag-5",
                "im-icon-Flag-6",
                "im-icon-Flag",
                "im-icon-Flamingo",
                "im-icon-Flash-2",
                "im-icon-Flash-Video",
                "im-icon-Flash",
                "im-icon-Flashlight",
                "im-icon-Flask-2",
                "im-icon-Flask",
                "im-icon-Flick",
                "im-icon-Flickr",
                "im-icon-Flowerpot",
                "im-icon-Fluorescent",
                "im-icon-Fog-Day",
                "im-icon-Fog-Night",
                "im-icon-Folder-Add",
                "im-icon-Folder-Archive",
                "im-icon-Folder-Binder",
                "im-icon-Folder-Binder2",
                "im-icon-Folder-Block",
                "im-icon-Folder-Bookmark",
                "im-icon-Folder-Close",
                "im-icon-Folder-Cloud",
                "im-icon-Folder-Delete",
                "im-icon-Folder-Download",
                "im-icon-Folder-Edit",
                "im-icon-Folder-Favorite",
                "im-icon-Folder-Fire",
                "im-icon-Folder-Hide",
                "im-icon-Folder-Link",
                "im-icon-Folder-Loading",
                "im-icon-Folder-Lock",
                "im-icon-Folder-Love",
                "im-icon-Folder-Music",
                "im-icon-Folder-Network",
                "im-icon-Folder-Open",
                "im-icon-Folder-Open2",
                "im-icon-Folder-Organizing",
                "im-icon-Folder-Pictures",
                "im-icon-Folder-Refresh",
                "im-icon-Folder-Remove-",
                "im-icon-Folder-Search",
                "im-icon-Folder-Settings",
                "im-icon-Folder-Share",
                "im-icon-Folder-Trash",
                "im-icon-Folder-Upload",
                "im-icon-Folder-Video",
                "im-icon-Folder-WithDocument",
                "im-icon-Folder-Zip",
                "im-icon-Folder",
                "im-icon-Folders",
                "im-icon-Font-Color",
                "im-icon-Font-Name",
                "im-icon-Font-Size",
                "im-icon-Font-Style",
                "im-icon-Font-StyleSubscript",
                "im-icon-Font-StyleSuperscript",
                "im-icon-Font-Window",
                "im-icon-Foot-2",
                "im-icon-Foot",
                "im-icon-Football-2",
                "im-icon-Football",
                "im-icon-Footprint-2",
                "im-icon-Footprint-3",
                "im-icon-Footprint",
                "im-icon-Forest",
                "im-icon-Fork",
                "im-icon-Formspring",
                "im-icon-Formula",
                "im-icon-Forsquare",
                "im-icon-Forward",
                "im-icon-Fountain-Pen",
                "im-icon-Four-Fingers",
                "im-icon-Four-FingersDrag",
                "im-icon-Four-FingersDrag2",
                "im-icon-Four-FingersTouch",
                "im-icon-Fox",
                "im-icon-Frankenstein",
                "im-icon-French-Fries",
                "im-icon-Friendfeed",
                "im-icon-Friendster",
                "im-icon-Frog",
                "im-icon-Fruits",
                "im-icon-Fuel",
                "im-icon-Full-Bag",
                "im-icon-Full-Basket",
                "im-icon-Full-Cart",
                "im-icon-Full-Moon",
                "im-icon-Full-Screen",
                "im-icon-Full-Screen2",
                "im-icon-Full-View",
                "im-icon-Full-View2",
                "im-icon-Full-ViewWindow",
                "im-icon-Function",
                "im-icon-Funky",
                "im-icon-Funny-Bicycle",
                "im-icon-Furl",
                "im-icon-Gamepad-2",
                "im-icon-Gamepad",
                "im-icon-Gas-Pump",
                "im-icon-Gaugage-2",
                "im-icon-Gaugage",
                "im-icon-Gay",
                "im-icon-Gear-2",
                "im-icon-Gear",
                "im-icon-Gears-2",
                "im-icon-Gears",
                "im-icon-Geek-2",
                "im-icon-Geek",
                "im-icon-Gemini-2",
                "im-icon-Gemini",
                "im-icon-Genius",
                "im-icon-Gentleman",
                "im-icon-Geo--",
                "im-icon-Geo-",
                "im-icon-Geo-Close",
                "im-icon-Geo-Love",
                "im-icon-Geo-Number",
                "im-icon-Geo-Star",
                "im-icon-Geo",
                "im-icon-Geo2--",
                "im-icon-Geo2-",
                "im-icon-Geo2-Close",
                "im-icon-Geo2-Love",
                "im-icon-Geo2-Number",
                "im-icon-Geo2-Star",
                "im-icon-Geo2",
                "im-icon-Geo3--",
                "im-icon-Geo3-",
                "im-icon-Geo3-Close",
                "im-icon-Geo3-Love",
                "im-icon-Geo3-Number",
                "im-icon-Geo3-Star",
                "im-icon-Geo3",
                "im-icon-Gey",
                "im-icon-Gift-Box",
                "im-icon-Giraffe",
                "im-icon-Girl",
                "im-icon-Glass-Water",
                "im-icon-Glasses-2",
                "im-icon-Glasses-3",
                "im-icon-Glasses",
                "im-icon-Global-Position",
                "im-icon-Globe-2",
                "im-icon-Globe",
                "im-icon-Gloves",
                "im-icon-Go-Bottom",
                "im-icon-Go-Top",
                "im-icon-Goggles",
                "im-icon-Golf-2",
                "im-icon-Golf",
                "im-icon-Google-Buzz",
                "im-icon-Google-Drive",
                "im-icon-Google-Play",
                "im-icon-Google-Plus",
                "im-icon-Google",
                "im-icon-Gopro",
                "im-icon-Gorilla",
                "im-icon-Gowalla",
                "im-icon-Grave",
                "im-icon-Graveyard",
                "im-icon-Greece",
                "im-icon-Green-Energy",
                "im-icon-Green-House",
                "im-icon-Guitar",
                "im-icon-Gun-2",
                "im-icon-Gun-3",
                "im-icon-Gun",
                "im-icon-Gymnastics",
                "im-icon-Hair-2",
                "im-icon-Hair-3",
                "im-icon-Hair-4",
                "im-icon-Hair",
                "im-icon-Half-Moon",
                "im-icon-Halloween-HalfMoon",
                "im-icon-Halloween-Moon",
                "im-icon-Hamburger",
                "im-icon-Hammer",
                "im-icon-Hand-Touch",
                "im-icon-Hand-Touch2",
                "im-icon-Hand-TouchSmartphone",
                "im-icon-Hand",
                "im-icon-Hands",
                "im-icon-Handshake",
                "im-icon-Hanger",
                "im-icon-Happy",
                "im-icon-Hat-2",
                "im-icon-Hat",
                "im-icon-Haunted-House",
                "im-icon-HD-Video",
                "im-icon-HD",
                "im-icon-HDD",
                "im-icon-Headphone",
                "im-icon-Headphones",
                "im-icon-Headset",
                "im-icon-Heart-2",
                "im-icon-Heart",
                "im-icon-Heels-2",
                "im-icon-Heels",
                "im-icon-Height-Window",
                "im-icon-Helicopter-2",
                "im-icon-Helicopter",
                "im-icon-Helix-2",
                "im-icon-Hello",
                "im-icon-Helmet-2",
                "im-icon-Helmet-3",
                "im-icon-Helmet",
                "im-icon-Hipo",
                "im-icon-Hipster-Glasses",
                "im-icon-Hipster-Glasses2",
                "im-icon-Hipster-Glasses3",
                "im-icon-Hipster-Headphones",
                "im-icon-Hipster-Men",
                "im-icon-Hipster-Men2",
                "im-icon-Hipster-Men3",
                "im-icon-Hipster-Sunglasses",
                "im-icon-Hipster-Sunglasses2",
                "im-icon-Hipster-Sunglasses3",
                "im-icon-Hokey",
                "im-icon-Holly",
                "im-icon-Home-2",
                "im-icon-Home-3",
                "im-icon-Home-4",
                "im-icon-Home-5",
                "im-icon-Home-Window",
                "im-icon-Home",
                "im-icon-Homosexual",
                "im-icon-Honey",
                "im-icon-Hong-Kong",
                "im-icon-Hoodie",
                "im-icon-Horror",
                "im-icon-Horse",
                "im-icon-Hospital-2",
                "im-icon-Hospital",
                "im-icon-Host",
                "im-icon-Hot-Dog",
                "im-icon-Hotel",
                "im-icon-Hour",
                "im-icon-Hub",
                "im-icon-Humor",
                "im-icon-Hurt",
                "im-icon-Ice-Cream",
                "im-icon-ICQ",
                "im-icon-ID-2",
                "im-icon-ID-3",
                "im-icon-ID-Card",
                "im-icon-Idea-2",
                "im-icon-Idea-3",
                "im-icon-Idea-4",
                "im-icon-Idea-5",
                "im-icon-Idea",
                "im-icon-Identification-Badge",
                "im-icon-ImDB",
                "im-icon-Inbox-Empty",
                "im-icon-Inbox-Forward",
                "im-icon-Inbox-Full",
                "im-icon-Inbox-Into",
                "im-icon-Inbox-Out",
                "im-icon-Inbox-Reply",
                "im-icon-Inbox",
                "im-icon-Increase-Inedit",
                "im-icon-Indent-FirstLine",
                "im-icon-Indent-LeftMargin",
                "im-icon-Indent-RightMargin",
                "im-icon-India",
                "im-icon-Info-Window",
                "im-icon-Information",
                "im-icon-Inifity",
                "im-icon-Instagram",
                "im-icon-Internet-2",
                "im-icon-Internet-Explorer",
                "im-icon-Internet-Smiley",
                "im-icon-Internet",
                "im-icon-iOS-Apple",
                "im-icon-Israel",
                "im-icon-Italic-Text",
                "im-icon-Jacket-2",
                "im-icon-Jacket",
                "im-icon-Jamaica",
                "im-icon-Japan",
                "im-icon-Japanese-Gate",
                "im-icon-Jeans",
                "im-icon-Jeep-2",
                "im-icon-Jeep",
                "im-icon-Jet",
                "im-icon-Joystick",
                "im-icon-Juice",
                "im-icon-Jump-Rope",
                "im-icon-Kangoroo",
                "im-icon-Kenya",
                "im-icon-Key-2",
                "im-icon-Key-3",
                "im-icon-Key-Lock",
                "im-icon-Key",
                "im-icon-Keyboard",
                "im-icon-Keyboard3",
                "im-icon-Keypad",
                "im-icon-King-2",
                "im-icon-King",
                "im-icon-Kiss",
                "im-icon-Knee",
                "im-icon-Knife-2",
                "im-icon-Knife",
                "im-icon-Knight",
                "im-icon-Koala",
                "im-icon-Korea",
                "im-icon-Lamp",
                "im-icon-Landscape-2",
                "im-icon-Landscape",
                "im-icon-Lantern",
                "im-icon-Laptop-2",
                "im-icon-Laptop-3",
                "im-icon-Laptop-Phone",
                "im-icon-Laptop-Secure",
                "im-icon-Laptop-Tablet",
                "im-icon-Laptop",
                "im-icon-Laser",
                "im-icon-Last-FM",
                "im-icon-Last",
                "im-icon-Laughing",
                "im-icon-Layer-1635",
                "im-icon-Layer-1646",
                "im-icon-Layer-Backward",
                "im-icon-Layer-Forward",
                "im-icon-Leafs-2",
                "im-icon-Leafs",
                "im-icon-Leaning-Tower",
                "im-icon-Left--Right",
                "im-icon-Left--Right3",
                "im-icon-Left-2",
                "im-icon-Left-3",
                "im-icon-Left-4",
                "im-icon-Left-ToRight",
                "im-icon-Left",
                "im-icon-Leg-2",
                "im-icon-Leg",
                "im-icon-Lego",
                "im-icon-Lemon",
                "im-icon-Len-2",
                "im-icon-Len-3",
                "im-icon-Len",
                "im-icon-Leo-2",
                "im-icon-Leo",
                "im-icon-Leopard",
                "im-icon-Lesbian",
                "im-icon-Lesbians",
                "im-icon-Letter-Close",
                "im-icon-Letter-Open",
                "im-icon-Letter-Sent",
                "im-icon-Libra-2",
                "im-icon-Libra",
                "im-icon-Library-2",
                "im-icon-Library",
                "im-icon-Life-Jacket",
                "im-icon-Life-Safer",
                "im-icon-Light-Bulb",
                "im-icon-Light-Bulb2",
                "im-icon-Light-BulbLeaf",
                "im-icon-Lighthouse",
                "im-icon-Like-2",
                "im-icon-Like",
                "im-icon-Line-Chart",
                "im-icon-Line-Chart2",
                "im-icon-Line-Chart3",
                "im-icon-Line-Chart4",
                "im-icon-Line-Spacing",
                "im-icon-Line-SpacingText",
                "im-icon-Link-2",
                "im-icon-Link",
                "im-icon-Linkedin-2",
                "im-icon-Linkedin",
                "im-icon-Linux",
                "im-icon-Lion",
                "im-icon-Livejournal",
                "im-icon-Loading-2",
                "im-icon-Loading-3",
                "im-icon-Loading-Window",
                "im-icon-Loading",
                "im-icon-Location-2",
                "im-icon-Location",
                "im-icon-Lock-2",
                "im-icon-Lock-3",
                "im-icon-Lock-User",
                "im-icon-Lock-Window",
                "im-icon-Lock",
                "im-icon-Lollipop-2",
                "im-icon-Lollipop-3",
                "im-icon-Lollipop",
                "im-icon-Loop",
                "im-icon-Loud",
                "im-icon-Loudspeaker",
                "im-icon-Love-2",
                "im-icon-Love-User",
                "im-icon-Love-Window",
                "im-icon-Love",
                "im-icon-Lowercase-Text",
                "im-icon-Luggafe-Front",
                "im-icon-Luggage-2",
                "im-icon-Macro",
                "im-icon-Magic-Wand",
                "im-icon-Magnet",
                "im-icon-Magnifi-Glass-",
                "im-icon-Magnifi-Glass",
                "im-icon-Magnifi-Glass2",
                "im-icon-Mail-2",
                "im-icon-Mail-3",
                "im-icon-Mail-Add",
                "im-icon-Mail-Attachement",
                "im-icon-Mail-Block",
                "im-icon-Mail-Delete",
                "im-icon-Mail-Favorite",
                "im-icon-Mail-Forward",
                "im-icon-Mail-Gallery",
                "im-icon-Mail-Inbox",
                "im-icon-Mail-Link",
                "im-icon-Mail-Lock",
                "im-icon-Mail-Love",
                "im-icon-Mail-Money",
                "im-icon-Mail-Open",
                "im-icon-Mail-Outbox",
                "im-icon-Mail-Password",
                "im-icon-Mail-Photo",
                "im-icon-Mail-Read",
                "im-icon-Mail-Removex",
                "im-icon-Mail-Reply",
                "im-icon-Mail-ReplyAll",
                "im-icon-Mail-Search",
                "im-icon-Mail-Send",
                "im-icon-Mail-Settings",
                "im-icon-Mail-Unread",
                "im-icon-Mail-Video",
                "im-icon-Mail-withAtSign",
                "im-icon-Mail-WithCursors",
                "im-icon-Mail",
                "im-icon-Mailbox-Empty",
                "im-icon-Mailbox-Full",
                "im-icon-Male-2",
                "im-icon-Male-Sign",
                "im-icon-Male",
                "im-icon-MaleFemale",
                "im-icon-Man-Sign",
                "im-icon-Management",
                "im-icon-Mans-Underwear",
                "im-icon-Mans-Underwear2",
                "im-icon-Map-Marker",
                "im-icon-Map-Marker2",
                "im-icon-Map-Marker3",
                "im-icon-Map",
                "im-icon-Map2",
                "im-icon-Marker-2",
                "im-icon-Marker-3",
                "im-icon-Marker",
                "im-icon-Martini-Glass",
                "im-icon-Mask",
                "im-icon-Master-Card",
                "im-icon-Maximize-Window",
                "im-icon-Maximize",
                "im-icon-Medal-2",
                "im-icon-Medal-3",
                "im-icon-Medal",
                "im-icon-Medical-Sign",
                "im-icon-Medicine-2",
                "im-icon-Medicine-3",
                "im-icon-Medicine",
                "im-icon-Megaphone",
                "im-icon-Memory-Card",
                "im-icon-Memory-Card2",
                "im-icon-Memory-Card3",
                "im-icon-Men",
                "im-icon-Menorah",
                "im-icon-Mens",
                "im-icon-Metacafe",
                "im-icon-Mexico",
                "im-icon-Mic",
                "im-icon-Microphone-2",
                "im-icon-Microphone-3",
                "im-icon-Microphone-4",
                "im-icon-Microphone-5",
                "im-icon-Microphone-6",
                "im-icon-Microphone-7",
                "im-icon-Microphone",
                "im-icon-Microscope",
                "im-icon-Milk-Bottle",
                "im-icon-Mine",
                "im-icon-Minimize-Maximize-Close-Window",
                "im-icon-Minimize-Window",
                "im-icon-Minimize",
                "im-icon-Mirror",
                "im-icon-Mixer",
                "im-icon-Mixx",
                "im-icon-Money-2",
                "im-icon-Money-Bag",
                "im-icon-Money-Smiley",
                "im-icon-Money",
                "im-icon-Monitor-2",
                "im-icon-Monitor-3",
                "im-icon-Monitor-4",
                "im-icon-Monitor-5",
                "im-icon-Monitor-Analytics",
                "im-icon-Monitor-Laptop",
                "im-icon-Monitor-phone",
                "im-icon-Monitor-Tablet",
                "im-icon-Monitor-Vertical",
                "im-icon-Monitor",
                "im-icon-Monitoring",
                "im-icon-Monkey",
                "im-icon-Monster",
                "im-icon-Morocco",
                "im-icon-Motorcycle",
                "im-icon-Mouse-2",
                "im-icon-Mouse-3",
                "im-icon-Mouse-4",
                "im-icon-Mouse-Pointer",
                "im-icon-Mouse",
                "im-icon-Moustache-Smiley",
                "im-icon-Movie-Ticket",
                "im-icon-Movie",
                "im-icon-Mp3-File",
                "im-icon-Museum",
                "im-icon-Mushroom",
                "im-icon-Music-Note",
                "im-icon-Music-Note2",
                "im-icon-Music-Note3",
                "im-icon-Music-Note4",
                "im-icon-Music-Player",
                "im-icon-Mustache-2",
                "im-icon-Mustache-3",
                "im-icon-Mustache-4",
                "im-icon-Mustache-5",
                "im-icon-Mustache-6",
                "im-icon-Mustache-7",
                "im-icon-Mustache-8",
                "im-icon-Mustache",
                "im-icon-Mute",
                "im-icon-Myspace",
                "im-icon-Navigat-Start",
                "im-icon-Navigate-End",
                "im-icon-Navigation-LeftWindow",
                "im-icon-Navigation-RightWindow",
                "im-icon-Nepal",
                "im-icon-Netscape",
                "im-icon-Network-Window",
                "im-icon-Network",
                "im-icon-Neutron",
                "im-icon-New-Mail",
                "im-icon-New-Tab",
                "im-icon-Newspaper-2",
                "im-icon-Newspaper",
                "im-icon-Newsvine",
                "im-icon-Next2",
                "im-icon-Next-3",
                "im-icon-Next-Music",
                "im-icon-Next",
                "im-icon-No-Battery",
                "im-icon-No-Drop",
                "im-icon-No-Flash",
                "im-icon-No-Smoking",
                "im-icon-Noose",
                "im-icon-Normal-Text",
                "im-icon-Note",
                "im-icon-Notepad-2",
                "im-icon-Notepad",
                "im-icon-Nuclear",
                "im-icon-Numbering-List",
                "im-icon-Nurse",
                "im-icon-Office-Lamp",
                "im-icon-Office",
                "im-icon-Oil",
                "im-icon-Old-Camera",
                "im-icon-Old-Cassette",
                "im-icon-Old-Clock",
                "im-icon-Old-Radio",
                "im-icon-Old-Sticky",
                "im-icon-Old-Sticky2",
                "im-icon-Old-Telephone",
                "im-icon-Old-TV",
                "im-icon-On-Air",
                "im-icon-On-Off-2",
                "im-icon-On-Off-3",
                "im-icon-On-off",
                "im-icon-One-Finger",
                "im-icon-One-FingerTouch",
                "im-icon-One-Window",
                "im-icon-Open-Banana",
                "im-icon-Open-Book",
                "im-icon-Opera-House",
                "im-icon-Opera",
                "im-icon-Optimization",
                "im-icon-Orientation-2",
                "im-icon-Orientation-3",
                "im-icon-Orientation",
                "im-icon-Orkut",
                "im-icon-Ornament",
                "im-icon-Over-Time",
                "im-icon-Over-Time2",
                "im-icon-Owl",
                "im-icon-Pac-Man",
                "im-icon-Paint-Brush",
                "im-icon-Paint-Bucket",
                "im-icon-Paintbrush",
                "im-icon-Palette",
                "im-icon-Palm-Tree",
                "im-icon-Panda",
                "im-icon-Panorama",
                "im-icon-Pantheon",
                "im-icon-Pantone",
                "im-icon-Pants",
                "im-icon-Paper-Plane",
                "im-icon-Paper",
                "im-icon-Parasailing",
                "im-icon-Parrot",
                "im-icon-Password-2shopping",
                "im-icon-Password-Field",
                "im-icon-Password-shopping",
                "im-icon-Password",
                "im-icon-pause-2",
                "im-icon-Pause",
                "im-icon-Paw",
                "im-icon-Pawn",
                "im-icon-Paypal",
                "im-icon-Pen-2",
                "im-icon-Pen-3",
                "im-icon-Pen-4",
                "im-icon-Pen-5",
                "im-icon-Pen-6",
                "im-icon-Pen",
                "im-icon-Pencil-Ruler",
                "im-icon-Pencil",
                "im-icon-Penguin",
                "im-icon-Pentagon",
                "im-icon-People-onCloud",
                "im-icon-Pepper-withFire",
                "im-icon-Pepper",
                "im-icon-Petrol",
                "im-icon-Petronas-Tower",
                "im-icon-Philipines",
                "im-icon-Phone-2",
                "im-icon-Phone-3",
                "im-icon-Phone-3G",
                "im-icon-Phone-4G",
                "im-icon-Phone-Simcard",
                "im-icon-Phone-SMS",
                "im-icon-Phone-Wifi",
                "im-icon-Phone",
                "im-icon-Photo-2",
                "im-icon-Photo-3",
                "im-icon-Photo-Album",
                "im-icon-Photo-Album2",
                "im-icon-Photo-Album3",
                "im-icon-Photo",
                "im-icon-Photos",
                "im-icon-Physics",
                "im-icon-Pi",
                "im-icon-Piano",
                "im-icon-Picasa",
                "im-icon-Pie-Chart",
                "im-icon-Pie-Chart2",
                "im-icon-Pie-Chart3",
                "im-icon-Pilates-2",
                "im-icon-Pilates-3",
                "im-icon-Pilates",
                "im-icon-Pilot",
                "im-icon-Pinch",
                "im-icon-Ping-Pong",
                "im-icon-Pinterest",
                "im-icon-Pipe",
                "im-icon-Pipette",
                "im-icon-Piramids",
                "im-icon-Pisces-2",
                "im-icon-Pisces",
                "im-icon-Pizza-Slice",
                "im-icon-Pizza",
                "im-icon-Plane-2",
                "im-icon-Plane",
                "im-icon-Plant",
                "im-icon-Plasmid",
                "im-icon-Plaster",
                "im-icon-Plastic-CupPhone",
                "im-icon-Plastic-CupPhone2",
                "im-icon-Plate",
                "im-icon-Plates",
                "im-icon-Plaxo",
                "im-icon-Play-Music",
                "im-icon-Plug-In",
                "im-icon-Plug-In2",
                "im-icon-Plurk",
                "im-icon-Pointer",
                "im-icon-Poland",
                "im-icon-Police-Man",
                "im-icon-Police-Station",
                "im-icon-Police-Woman",
                "im-icon-Police",
                "im-icon-Polo-Shirt",
                "im-icon-Portrait",
                "im-icon-Portugal",
                "im-icon-Post-Mail",
                "im-icon-Post-Mail2",
                "im-icon-Post-Office",
                "im-icon-Post-Sign",
                "im-icon-Post-Sign2ways",
                "im-icon-Posterous",
                "im-icon-Pound-Sign",
                "im-icon-Pound-Sign2",
                "im-icon-Pound",
                "im-icon-Power-2",
                "im-icon-Power-3",
                "im-icon-Power-Cable",
                "im-icon-Power-Station",
                "im-icon-Power",
                "im-icon-Prater",
                "im-icon-Present",
                "im-icon-Presents",
                "im-icon-Press",
                "im-icon-Preview",
                "im-icon-Previous",
                "im-icon-Pricing",
                "im-icon-Printer",
                "im-icon-Professor",
                "im-icon-Profile",
                "im-icon-Project",
                "im-icon-Projector-2",
                "im-icon-Projector",
                "im-icon-Pulse",
                "im-icon-Pumpkin",
                "im-icon-Punk",
                "im-icon-Punker",
                "im-icon-Puzzle",
                "im-icon-QIK",
                "im-icon-QR-Code",
                "im-icon-Queen-2",
                "im-icon-Queen",
                "im-icon-Quill-2",
                "im-icon-Quill-3",
                "im-icon-Quill",
                "im-icon-Quotes-2",
                "im-icon-Quotes",
                "im-icon-Radio",
                "im-icon-Radioactive",
                "im-icon-Rafting",
                "im-icon-Rain-Drop",
                "im-icon-Rainbow-2",
                "im-icon-Rainbow",
                "im-icon-Ram",
                "im-icon-Razzor-Blade",
                "im-icon-Receipt-2",
                "im-icon-Receipt-3",
                "im-icon-Receipt-4",
                "im-icon-Receipt",
                "im-icon-Record2",
                "im-icon-Record-3",
                "im-icon-Record-Music",
                "im-icon-Record",
                "im-icon-Recycling-2",
                "im-icon-Recycling",
                "im-icon-Reddit",
                "im-icon-Redhat",
                "im-icon-Redirect",
                "im-icon-Redo",
                "im-icon-Reel",
                "im-icon-Refinery",
                "im-icon-Refresh-Window",
                "im-icon-Refresh",
                "im-icon-Reload-2",
                "im-icon-Reload-3",
                "im-icon-Reload",
                "im-icon-Remote-Controll",
                "im-icon-Remote-Controll2",
                "im-icon-Remove-Bag",
                "im-icon-Remove-Basket",
                "im-icon-Remove-Cart",
                "im-icon-Remove-File",
                "im-icon-Remove-User",
                "im-icon-Remove-Window",
                "im-icon-Remove",
                "im-icon-Rename",
                "im-icon-Repair",
                "im-icon-Repeat-2",
                "im-icon-Repeat-3",
                "im-icon-Repeat-4",
                "im-icon-Repeat-5",
                "im-icon-Repeat-6",
                "im-icon-Repeat-7",
                "im-icon-Repeat",
                "im-icon-Reset",
                "im-icon-Resize",
                "im-icon-Restore-Window",
                "im-icon-Retouching",
                "im-icon-Retro-Camera",
                "im-icon-Retro",
                "im-icon-Retweet",
                "im-icon-Reverbnation",
                "im-icon-Rewind",
                "im-icon-RGB",
                "im-icon-Ribbon-2",
                "im-icon-Ribbon-3",
                "im-icon-Ribbon",
                "im-icon-Right-2",
                "im-icon-Right-3",
                "im-icon-Right-4",
                "im-icon-Right-ToLeft",
                "im-icon-Right",
                "im-icon-Road-2",
                "im-icon-Road-3",
                "im-icon-Road",
                "im-icon-Robot-2",
                "im-icon-Robot",
                "im-icon-Rock-andRoll",
                "im-icon-Rocket",
                "im-icon-Roller",
                "im-icon-Roof",
                "im-icon-Rook",
                "im-icon-Rotate-Gesture",
                "im-icon-Rotate-Gesture2",
                "im-icon-Rotate-Gesture3",
                "im-icon-Rotation-390",
                "im-icon-Rotation",
                "im-icon-Router-2",
                "im-icon-Router",
                "im-icon-RSS",
                "im-icon-Ruler-2",
                "im-icon-Ruler",
                "im-icon-Running-Shoes",
                "im-icon-Running",
                "im-icon-Safari",
                "im-icon-Safe-Box",
                "im-icon-Safe-Box2",
                "im-icon-Safety-PinClose",
                "im-icon-Safety-PinOpen",
                "im-icon-Sagittarus-2",
                "im-icon-Sagittarus",
                "im-icon-Sailing-Ship",
                "im-icon-Sand-watch",
                "im-icon-Sand-watch2",
                "im-icon-Santa-Claus",
                "im-icon-Santa-Claus2",
                "im-icon-Santa-onSled",
                "im-icon-Satelite-2",
                "im-icon-Satelite",
                "im-icon-Save-Window",
                "im-icon-Save",
                "im-icon-Saw",
                "im-icon-Saxophone",
                "im-icon-Scale",
                "im-icon-Scarf",
                "im-icon-Scissor",
                "im-icon-Scooter-Front",
                "im-icon-Scooter",
                "im-icon-Scorpio-2",
                "im-icon-Scorpio",
                "im-icon-Scotland",
                "im-icon-Screwdriver",
                "im-icon-Scroll-Fast",
                "im-icon-Scroll",
                "im-icon-Scroller-2",
                "im-icon-Scroller",
                "im-icon-Sea-Dog",
                "im-icon-Search-onCloud",
                "im-icon-Search-People",
                "im-icon-secound",
                "im-icon-secound2",
                "im-icon-Security-Block",
                "im-icon-Security-Bug",
                "im-icon-Security-Camera",
                "im-icon-Security-Check",
                "im-icon-Security-Settings",
                "im-icon-Security-Smiley",
                "im-icon-Securiy-Remove",
                "im-icon-Seed",
                "im-icon-Selfie",
                "im-icon-Serbia",
                "im-icon-Server-2",
                "im-icon-Server",
                "im-icon-Servers",
                "im-icon-Settings-Window",
                "im-icon-Sewing-Machine",
                "im-icon-Sexual",
                "im-icon-Share-onCloud",
                "im-icon-Share-Window",
                "im-icon-Share",
                "im-icon-Sharethis",
                "im-icon-Shark",
                "im-icon-Sheep",
                "im-icon-Sheriff-Badge",
                "im-icon-Shield",
                "im-icon-Ship-2",
                "im-icon-Ship",
                "im-icon-Shirt",
                "im-icon-Shoes-2",
                "im-icon-Shoes-3",
                "im-icon-Shoes",
                "im-icon-Shop-2",
                "im-icon-Shop-3",
                "im-icon-Shop-4",
                "im-icon-Shop",
                "im-icon-Shopping-Bag",
                "im-icon-Shopping-Basket",
                "im-icon-Shopping-Cart",
                "im-icon-Short-Pants",
                "im-icon-Shoutwire",
                "im-icon-Shovel",
                "im-icon-Shuffle-2",
                "im-icon-Shuffle-3",
                "im-icon-Shuffle-4",
                "im-icon-Shuffle",
                "im-icon-Shutter",
                "im-icon-Sidebar-Window",
                "im-icon-Signal",
                "im-icon-Singapore",
                "im-icon-Skate-Shoes",
                "im-icon-Skateboard-2",
                "im-icon-Skateboard",
                "im-icon-Skeleton",
                "im-icon-Ski",
                "im-icon-Skirt",
                "im-icon-Skrill",
                "im-icon-Skull",
                "im-icon-Skydiving",
                "im-icon-Skype",
                "im-icon-Sled-withGifts",
                "im-icon-Sled",
                "im-icon-Sleeping",
                "im-icon-Sleet",
                "im-icon-Slippers",
                "im-icon-Smart",
                "im-icon-Smartphone-2",
                "im-icon-Smartphone-3",
                "im-icon-Smartphone-4",
                "im-icon-Smartphone-Secure",
                "im-icon-Smartphone",
                "im-icon-Smile",
                "im-icon-Smoking-Area",
                "im-icon-Smoking-Pipe",
                "im-icon-Snake",
                "im-icon-Snorkel",
                "im-icon-Snow-2",
                "im-icon-Snow-Dome",
                "im-icon-Snow-Storm",
                "im-icon-Snow",
                "im-icon-Snowflake-2",
                "im-icon-Snowflake-3",
                "im-icon-Snowflake-4",
                "im-icon-Snowflake",
                "im-icon-Snowman",
                "im-icon-Soccer-Ball",
                "im-icon-Soccer-Shoes",
                "im-icon-Socks",
                "im-icon-Solar",
                "im-icon-Sound-Wave",
                "im-icon-Sound",
                "im-icon-Soundcloud",
                "im-icon-Soup",
                "im-icon-South-Africa",
                "im-icon-Space-Needle",
                "im-icon-Spain",
                "im-icon-Spam-Mail",
                "im-icon-Speach-Bubble",
                "im-icon-Speach-Bubble2",
                "im-icon-Speach-Bubble3",
                "im-icon-Speach-Bubble4",
                "im-icon-Speach-Bubble5",
                "im-icon-Speach-Bubble6",
                "im-icon-Speach-Bubble7",
                "im-icon-Speach-Bubble8",
                "im-icon-Speach-Bubble9",
                "im-icon-Speach-Bubble10",
                "im-icon-Speach-Bubble11",
                "im-icon-Speach-Bubble12",
                "im-icon-Speach-Bubble13",
                "im-icon-Speach-BubbleAsking",
                "im-icon-Speach-BubbleComic",
                "im-icon-Speach-BubbleComic2",
                "im-icon-Speach-BubbleComic3",
                "im-icon-Speach-BubbleComic4",
                "im-icon-Speach-BubbleDialog",
                "im-icon-Speach-Bubbles",
                "im-icon-Speak-2",
                "im-icon-Speak",
                "im-icon-Speaker-2",
                "im-icon-Speaker",
                "im-icon-Spell-Check",
                "im-icon-Spell-CheckABC",
                "im-icon-Spermium",
                "im-icon-Spider",
                "im-icon-Spiderweb",
                "im-icon-Split-FourSquareWindow",
                "im-icon-Split-Horizontal",
                "im-icon-Split-Horizontal2Window",
                "im-icon-Split-Vertical",
                "im-icon-Split-Vertical2",
                "im-icon-Split-Window",
                "im-icon-Spoder",
                "im-icon-Spoon",
                "im-icon-Sport-Mode",
                "im-icon-Sports-Clothings1",
                "im-icon-Sports-Clothings2",
                "im-icon-Sports-Shirt",
                "im-icon-Spot",
                "im-icon-Spray",
                "im-icon-Spread",
                "im-icon-Spring",
                "im-icon-Spurl",
                "im-icon-Spy",
                "im-icon-Squirrel",
                "im-icon-SSL",
                "im-icon-St-BasilsCathedral",
                "im-icon-St-PaulsCathedral",
                "im-icon-Stamp-2",
                "im-icon-Stamp",
                "im-icon-Stapler",
                "im-icon-Star-Track",
                "im-icon-Star",
                "im-icon-Starfish",
                "im-icon-Start2",
                "im-icon-Start-3",
                "im-icon-Start-ways",
                "im-icon-Start",
                "im-icon-Statistic",
                "im-icon-Stethoscope",
                "im-icon-stop--2",
                "im-icon-Stop-Music",
                "im-icon-Stop",
                "im-icon-Stopwatch-2",
                "im-icon-Stopwatch",
                "im-icon-Storm",
                "im-icon-Street-View",
                "im-icon-Street-View2",
                "im-icon-Strikethrough-Text",
                "im-icon-Stroller",
                "im-icon-Structure",
                "im-icon-Student-Female",
                "im-icon-Student-Hat",
                "im-icon-Student-Hat2",
                "im-icon-Student-Male",
                "im-icon-Student-MaleFemale",
                "im-icon-Students",
                "im-icon-Studio-Flash",
                "im-icon-Studio-Lightbox",
                "im-icon-Stumbleupon",
                "im-icon-Suit",
                "im-icon-Suitcase",
                "im-icon-Sum-2",
                "im-icon-Sum",
                "im-icon-Summer",
                "im-icon-Sun-CloudyRain",
                "im-icon-Sun",
                "im-icon-Sunglasses-2",
                "im-icon-Sunglasses-3",
                "im-icon-Sunglasses-Smiley",
                "im-icon-Sunglasses-Smiley2",
                "im-icon-Sunglasses-W",
                "im-icon-Sunglasses-W2",
                "im-icon-Sunglasses-W3",
                "im-icon-Sunglasses",
                "im-icon-Sunrise",
                "im-icon-Sunset",
                "im-icon-Superman",
                "im-icon-Support",
                "im-icon-Surprise",
                "im-icon-Sushi",
                "im-icon-Sweden",
                "im-icon-Swimming-Short",
                "im-icon-Swimming",
                "im-icon-Swimmwear",
                "im-icon-Switch",
                "im-icon-Switzerland",
                "im-icon-Sync-Cloud",
                "im-icon-Sync",
                "im-icon-Synchronize-2",
                "im-icon-Synchronize",
                "im-icon-T-Shirt",
                "im-icon-Tablet-2",
                "im-icon-Tablet-3",
                "im-icon-Tablet-Orientation",
                "im-icon-Tablet-Phone",
                "im-icon-Tablet-Secure",
                "im-icon-Tablet-Vertical",
                "im-icon-Tablet",
                "im-icon-Tactic",
                "im-icon-Tag-2",
                "im-icon-Tag-3",
                "im-icon-Tag-4",
                "im-icon-Tag-5",
                "im-icon-Tag",
                "im-icon-Taj-Mahal",
                "im-icon-Talk-Man",
                "im-icon-Tap",
                "im-icon-Target-Market",
                "im-icon-Target",
                "im-icon-Taurus-2",
                "im-icon-Taurus",
                "im-icon-Taxi-2",
                "im-icon-Taxi-Sign",
                "im-icon-Taxi",
                "im-icon-Teacher",
                "im-icon-Teapot",
                "im-icon-Technorati",
                "im-icon-Teddy-Bear",
                "im-icon-Tee-Mug",
                "im-icon-Telephone-2",
                "im-icon-Telephone",
                "im-icon-Telescope",
                "im-icon-Temperature-2",
                "im-icon-Temperature-3",
                "im-icon-Temperature",
                "im-icon-Temple",
                "im-icon-Tennis-Ball",
                "im-icon-Tennis",
                "im-icon-Tent",
                "im-icon-Test-Tube",
                "im-icon-Test-Tube2",
                "im-icon-Testimonal",
                "im-icon-Text-Box",
                "im-icon-Text-Effect",
                "im-icon-Text-HighlightColor",
                "im-icon-Text-Paragraph",
                "im-icon-Thailand",
                "im-icon-The-WhiteHouse",
                "im-icon-This-SideUp",
                "im-icon-Thread",
                "im-icon-Three-ArrowFork",
                "im-icon-Three-Fingers",
                "im-icon-Three-FingersDrag",
                "im-icon-Three-FingersDrag2",
                "im-icon-Three-FingersTouch",
                "im-icon-Thumb",
                "im-icon-Thumbs-DownSmiley",
                "im-icon-Thumbs-UpSmiley",
                "im-icon-Thunder",
                "im-icon-Thunderstorm",
                "im-icon-Ticket",
                "im-icon-Tie-2",
                "im-icon-Tie-3",
                "im-icon-Tie-4",
                "im-icon-Tie",
                "im-icon-Tiger",
                "im-icon-Time-Backup",
                "im-icon-Time-Bomb",
                "im-icon-Time-Clock",
                "im-icon-Time-Fire",
                "im-icon-Time-Machine",
                "im-icon-Time-Window",
                "im-icon-Timer-2",
                "im-icon-Timer",
                "im-icon-To-Bottom",
                "im-icon-To-Bottom2",
                "im-icon-To-Left",
                "im-icon-To-Right",
                "im-icon-To-Top",
                "im-icon-To-Top2",
                "im-icon-Token-",
                "im-icon-Tomato",
                "im-icon-Tongue",
                "im-icon-Tooth-2",
                "im-icon-Tooth",
                "im-icon-Top-ToBottom",
                "im-icon-Touch-Window",
                "im-icon-Tourch",
                "im-icon-Tower-2",
                "im-icon-Tower-Bridge",
                "im-icon-Tower",
                "im-icon-Trace",
                "im-icon-Tractor",
                "im-icon-traffic-Light",
                "im-icon-Traffic-Light2",
                "im-icon-Train-2",
                "im-icon-Train",
                "im-icon-Tram",
                "im-icon-Transform-2",
                "im-icon-Transform-3",
                "im-icon-Transform-4",
                "im-icon-Transform",
                "im-icon-Trash-withMen",
                "im-icon-Tree-2",
                "im-icon-Tree-3",
                "im-icon-Tree-4",
                "im-icon-Tree-5",
                "im-icon-Tree",
                "im-icon-Trekking",
                "im-icon-Triangle-ArrowDown",
                "im-icon-Triangle-ArrowLeft",
                "im-icon-Triangle-ArrowRight",
                "im-icon-Triangle-ArrowUp",
                "im-icon-Tripod-2",
                "im-icon-Tripod-andVideo",
                "im-icon-Tripod-withCamera",
                "im-icon-Tripod-withGopro",
                "im-icon-Trophy-2",
                "im-icon-Trophy",
                "im-icon-Truck",
                "im-icon-Trumpet",
                "im-icon-Tumblr",
                "im-icon-Turkey",
                "im-icon-Turn-Down",
                "im-icon-Turn-Down2",
                "im-icon-Turn-DownFromLeft",
                "im-icon-Turn-DownFromRight",
                "im-icon-Turn-Left",
                "im-icon-Turn-Left3",
                "im-icon-Turn-Right",
                "im-icon-Turn-Right3",
                "im-icon-Turn-Up",
                "im-icon-Turn-Up2",
                "im-icon-Turtle",
                "im-icon-Tuxedo",
                "im-icon-TV",
                "im-icon-Twister",
                "im-icon-Twitter-2",
                "im-icon-Twitter",
                "im-icon-Two-Fingers",
                "im-icon-Two-FingersDrag",
                "im-icon-Two-FingersDrag2",
                "im-icon-Two-FingersScroll",
                "im-icon-Two-FingersTouch",
                "im-icon-Two-Windows",
                "im-icon-Type-Pass",
                "im-icon-Ukraine",
                "im-icon-Umbrela",
                "im-icon-Umbrella-2",
                "im-icon-Umbrella-3",
                "im-icon-Under-LineText",
                "im-icon-Undo",
                "im-icon-United-Kingdom",
                "im-icon-United-States",
                "im-icon-University-2",
                "im-icon-University",
                "im-icon-Unlike-2",
                "im-icon-Unlike",
                "im-icon-Unlock-2",
                "im-icon-Unlock-3",
                "im-icon-Unlock",
                "im-icon-Up--Down",
                "im-icon-Up--Down3",
                "im-icon-Up-2",
                "im-icon-Up-3",
                "im-icon-Up-4",
                "im-icon-Up",
                "im-icon-Upgrade",
                "im-icon-Upload-2",
                "im-icon-Upload-toCloud",
                "im-icon-Upload-Window",
                "im-icon-Upload",
                "im-icon-Uppercase-Text",
                "im-icon-Upward",
                "im-icon-URL-Window",
                "im-icon-Usb-2",
                "im-icon-Usb-Cable",
                "im-icon-Usb",
                "im-icon-User",
                "im-icon-Ustream",
                "im-icon-Vase",
                "im-icon-Vector-2",
                "im-icon-Vector-3",
                "im-icon-Vector-4",
                "im-icon-Vector-5",
                "im-icon-Vector",
                "im-icon-Venn-Diagram",
                "im-icon-Vest-2",
                "im-icon-Vest",
                "im-icon-Viddler",
                "im-icon-Video-2",
                "im-icon-Video-3",
                "im-icon-Video-4",
                "im-icon-Video-5",
                "im-icon-Video-6",
                "im-icon-Video-GameController",
                "im-icon-Video-Len",
                "im-icon-Video-Len2",
                "im-icon-Video-Photographer",
                "im-icon-Video-Tripod",
                "im-icon-Video",
                "im-icon-Vietnam",
                "im-icon-View-Height",
                "im-icon-View-Width",
                "im-icon-Vimeo",
                "im-icon-Virgo-2",
                "im-icon-Virgo",
                "im-icon-Virus-2",
                "im-icon-Virus-3",
                "im-icon-Virus",
                "im-icon-Visa",
                "im-icon-Voice",
                "im-icon-Voicemail",
                "im-icon-Volleyball",
                "im-icon-Volume-Down",
                "im-icon-Volume-Up",
                "im-icon-VPN",
                "im-icon-Wacom-Tablet",
                "im-icon-Waiter",
                "im-icon-Walkie-Talkie",
                "im-icon-Wallet-2",
                "im-icon-Wallet-3",
                "im-icon-Wallet",
                "im-icon-Warehouse",
                "im-icon-Warning-Window",
                "im-icon-Watch-2",
                "im-icon-Watch-3",
                "im-icon-Watch",
                "im-icon-Wave-2",
                "im-icon-Wave",
                "im-icon-Webcam",
                "im-icon-weight-Lift",
                "im-icon-Wheelbarrow",
                "im-icon-Wheelchair",
                "im-icon-Width-Window",
                "im-icon-Wifi-2",
                "im-icon-Wifi-Keyboard",
                "im-icon-Wifi",
                "im-icon-Wind-Turbine",
                "im-icon-Windmill",
                "im-icon-Window-2",
                "im-icon-Window",
                "im-icon-Windows-2",
                "im-icon-Windows-Microsoft",
                "im-icon-Windows",
                "im-icon-Windsock",
                "im-icon-Windy",
                "im-icon-Wine-Bottle",
                "im-icon-Wine-Glass",
                "im-icon-Wink",
                "im-icon-Winter-2",
                "im-icon-Winter",
                "im-icon-Wireless",
                "im-icon-Witch-Hat",
                "im-icon-Witch",
                "im-icon-Wizard",
                "im-icon-Wolf",
                "im-icon-Woman-Sign",
                "im-icon-WomanMan",
                "im-icon-Womans-Underwear",
                "im-icon-Womans-Underwear2",
                "im-icon-Women",
                "im-icon-Wonder-Woman",
                "im-icon-Wordpress",
                "im-icon-Worker-Clothes",
                "im-icon-Worker",
                "im-icon-Wrap-Text",
                "im-icon-Wreath",
                "im-icon-Wrench",
                "im-icon-X-Box",
                "im-icon-X-ray",
                "im-icon-Xanga",
                "im-icon-Xing",
                "im-icon-Yacht",
                "im-icon-Yahoo-Buzz",
                "im-icon-Yahoo",
                "im-icon-Yelp",
                "im-icon-Yes",
                "im-icon-Ying-Yang",
                "im-icon-Youtube",
                "im-icon-Z-A",
                "im-icon-Zebra",
                "im-icon-Zombie",
                "im-icon-Zoom-Gesture",
                "im-icon-Zootool"
             ];

             public $statesNigeria = [
                'FCT',
                'Abia',
                'Adamawa',
                'Akwa Ibom',
                'Awka',
                'Bauchi',
                'Bayelsa',
                'Benue',
                'Borno',
                'Cross River',
                'Delta',
                'Ebonyi',
                'Edo',
                'Ekiti',
                'Enugu',
                'Gombe',
                'Imo',
                'Jigawa',
                'Kaduna',
                'Kano',
                'Katsina',
                'Kebbi',
                'Kogi',
                'Kwara',
                'Lagos',
                'Nasarawa',
                'Niger',
                'Ogun',
                'Ondo',
                'Osun',
                'Oyo',
                'Plateau',
                'Rivers',
                'Sokoto',
                'Taraba',
                'Yobe',
                'Zamfara',
             ];

        public $schoolCategories = [
			[
				'name' => 'Early Years',
				'xf' => 'early'
			],
			[
				'name' => 'Primary',
				'xf' => 'primary'
			],
			[
				'name' => 'Secondary',
				'xf' => 'secondary'
			],
			[
				'name' => 'Tertiary',
				'xf' => 'tertiary'
			],
			[
				'name' => 'Faith-based',
				'xf' => 'faith'
			],
			[
				'name' => 'Boarding',
				'xf' => 'boarding'
            ],
            [
				'name' => 'Private',
				'xf' => 'private'
			],
			[
				'name' => 'Public',
				'xf' => 'public'
			],
			[
				'name' => 'Boys',
				'xf' => 'boys'
			],
			[
				'name' => 'Girls',
				'xf' => 'girls'
			],
			[
				'name' => 'Day Care',
				'xf' => 'day-care'
			],
		];

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

             else if($type === 'contact-school' && (isset($data['contactName']) && isset($data['contactEmail'])) && isset($data['contactMessage']) && isset($data['schoolName']))
             {
                $name = $data['contactName']; $email = $data['contactEmail']; $msg = $data['contactMessage']; $schoolName = $data['schoolName'];
                $ret = <<<EOD
                <div style="padding: 10px;">
                   <h4 style="">New message for $schoolName</h4>
                   <p style="">Name: <strong>$name,</strong></p>
                   <p style="">Email address: <strong>$email</strong></p>
                   <blockquote style=" background: rgba(0, 0, 0, 0.02); padding: 20px; margin: 0 0 20px; font-size: 16px; line-height: 28px; color: #707070; border-left: 5px solid #eeeeee;">
                     $msg
                   </blockquote>
                </div>
EOD;
             }

             return $ret;
           }

           function cloudinaryUploadImage($file)
           {
             $url = Cloudinary::uploadFile($file->getRealPath())->getSecurePath();
             return $url;
           }

           function getCloudinaryImage($public_id)
           {
            $url = Cloudinary::getUrl($public_id);
            return $url;
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
                                                     'avatar' => $data['avatar'], 
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
                       $temp['avatar'] = $u->avatar; 
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
                            if(isset($data['avatar'])) $payload['avatar'] = $data['avatar'];
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

           function getPlugins($data=['mode' => 'all'])
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
                   $ret['date'] = $p->created_at->format("jS F, Y");  
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

           function getSchools($options=['id' => "","status" => "all"])
           {
               $ret = [];
               $id = $options['id']; $status = $options['status'];
               $ret2 = null;
               if($id === 'all') $ret2 = Schools::where('id','>','0');
               else $ret2 = Schools::where('email', $id);
               
              if($status === "all") $schools = $ret2->get();
              else $schools = $ret2->where('status',$status)->get();
             
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
                           ->orWhere('email',$id)
                           ->orWhere('url',$id)->first();

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
                   $ret['address'] =$this->getSchoolAddress($s->id);
                  $ret['bookmarks'] =$this->getSchoolBookmarks($s->id);
                   $ret['banners'] =$this->getSchoolBanners($s->id);
                   $ret['faqs'] =$this->getSchoolFaqs($s->id);
                   $ret['date'] = $s->created_at->format("jS F, Y");  
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
                    
                    $s->update($payload);
                     $ret = "ok";      
            }
           }

           function removeSchoolInfo($id)
           {
               $p = SchoolInfo::where('id',$id)->first();
               if($p != null) $p->delete();
           }

           function addSchoolAddress($data)
           {
            $ret = SchoolAddresses::create([
                'school_id' => $data['school_id'],
                'school_address' => $data['school_address'],
                'school_state' => $data['school_state'],
                'school_coords' => $data['longitude'].",".$data['latitude'],
            ]);

            return $ret;
           }

           function getSchoolAddress($school_id)
           {
               $ret = [];
               $s = SchoolAddresses::where('school_id',$school_id)->first();

               if($s != null)
               {
                   $ret['id'] = $s->id;
                   $ret['school_id'] = $s->school_id;
                   $ret['school_state'] = $s->school_state;
                   $ret['school_address'] = $s->school_address;

                   $coordsArr = explode(',',$s->school_coords);
                   
                   $ret['longitude'] = count($coordsArr) === 2 ? $coordsArr[0] : '';
                   $ret['latitude'] = count($coordsArr) === 2 ? $coordsArr[1] : '';
               }

               return $ret;
           }

           function updateSchoolAddress($data)
           {      
                  
            $ret = [];
            $s = SchoolAddresses::where('id',$data['school_id'])->first();
            
            if($s != null)
            {
                    $payload = [];
                    if(isset($data['school_state'])) $payload['school_state'] = $data['school_state'];
                    if(isset($data['school_address'])) $payload['school_address'] = $data['school_address'];

                   
                    if(isset($data['longitude']) && isset($data['latitude']))
                    {
                        $coords = $data['longitude'].",".$data['latitude'];
                        $payload['school_coords'] = $coords;
                    } 
                    
                    $s->update($payload);
                     $ret = "ok";      
            }
           }

           function removeSchoolAddress($id)
           {
               $p = SchoolAddresses::where('id',$id)->first();
               if($p != null) $p->delete();
           }

           function addSchoolBanner($data)
           {
            $ret = SchoolBanners::create([
                'school_id' => $data['school_id'],
                'url' => $data['url']
            ]);

            return $ret;
           }

           function getSchoolBanners($school_id)
           {
               $ret = [];
               $facilities = SchoolBanners::where('school_id',$school_id)->get();

               if($facilities != null)
               {
                  foreach($facilities as $f)
                  {
                      $temp = $this->getSchoolBanner($f->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getSchoolBanner($id)
           {
               $ret = [];
               $s = SchoolBanners::where('id',$id)->first();

               if($s != null)
               {
                   $ret['id'] = $s->id;
                   $ret['school_id'] = $s->school_id;
                   $ret['url'] = $s->url;
               }

               return $ret;
           }

          

           function removeSchoolBanner($id)
           {
               $p = SchoolBanners::where('id',$id)->first();
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
                'icon' => $data['icon'],
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
                   $ret['date'] = $s->created_at->format("jS F, Y");  
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
                   $ret['date'] = $r->created_at->format("jS F, Y");  
               }

               return $ret;
           }

           function removeSchoolResource($id)
           {
               $p = SchoolResources::where('id',$id)->first();
               if($p != null) $p->delete();
           }

           function addSchoolClass($data)
           {
            $ret = SchoolClasses::create([
                'school_id' => $data['school_id'],
                'class_name' => $data['class_name'],
                'class_value' => $data['class_value'],
            ]);

            return $ret;
           }

           function getSchoolClasses($school_id='all')
           {
               $ret = [];
               $classes = null;

               if($school_id === 'all')
               {
                $classes = SchoolClasses::where('id','>','0')->get();
               }

               else
               {
                $classes = SchoolClasses::where('school_id',$school_id)->get();
               }
              

               if($classes != null)
               {
                  foreach($classes as $c)
                  {
                      $temp = $this->getSchoolClass($c->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

          
           function getSchoolClass($id)
           {
            
               $ret = [];
               $r = SchoolClasses::where('id',$id)->first();

               if($r != null)
               {
                   $ret['id'] = $r->id;
                   $ret['school_id'] = $r->school_id;
                   $ret['class_name'] = $r->class_name;
                   $ret['class_value'] = $r->class_value;
                   $ret['date'] = $r->created_at->format("jS F, Y");  
                   $ret['url'] = $r->url;
               }

               return $ret;
           }


           function updateSchoolClass($data)
           {      
                  
            $ret = [];
            $s = SchoolClasses::where('id',$data['school_id'])->first();
            
            if($s != null)
            {
                    $payload = [];
                    if(isset($data['class_name'])) $payload['class_name'] = $data['class_name'];
                    if(isset($data['class_value'])) $payload['class_value'] = $data['class_value'];
                    
                    $s->update($payload);
                     $ret = "ok";      
            }
           }

           function removeSchoolClass($id)
           {
               $p = SchoolClasses::where('id',$id)->first();
               if($p != null) $p->delete();
           }

           function addSchoolFaq($data)
           {
            $ret = SchoolFaqs::create([
                'school_id' => $data['school_id'],
                'faq_question' => $data['faq_question'],
                'faq_answer' => $data['faq_answer']
            ]);

            return $ret;
           }

           function getSchoolFaqs($school_id='all')
           {
               $ret = [];
               $faqs = [];

               if($school_id === 'all')
               {
                $faqs = SchoolFaqs::where('id','>','0')->get();
               }

               else
               {
                $faqs = SchoolFaqs::where('school_id',$school_id)->get();
               }
              

               if($faqs != null)
               {
                  foreach($faqs as $f)
                  {
                      $temp = $this->getSchoolFaq($f->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getSchoolFaq($id)
           {
               $ret = [];
               $s = SchoolFaqs::where('id',$id)->first();

               if($s != null)
               {
                   $ret['id'] = $s->id;
                   $ret['school_id'] = $s->school_id;
                   $ret['faq_question'] = $s->faq_question;
                   $ret['faq_answer'] = $s->faq_answer;
               }

               return $ret;
           }

           function updateSchoolFaq($data)
           {         
            $ret = "";
            $s = SchoolFaqs::where('id',$data['school_id'])->first();
            
            if($s != null)
            {
                    $payload = [];
                    if(isset($data['faq_question'])) $payload['faq_question'] = $data['faq_question'];
                    if(isset($data['faq_answer'])) $payload['faq_answer'] = $data['faq_answer'];
                    
                    $s->update($payload);
                     $ret = "ok";      
            }
           }

           function removeSchoolFaq($id)
           {
               $f = SchoolFaqs::where('id',$id)->first();
               if($f != null) $f->delete();
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
                   $ret['icon'] = $c->img_url;
                   $ret['date'] = $c->created_at->format("jS F, Y");  
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

           function addTerm($data)
           {
            $ret = Terms::create([
                'name' => $data['name'],
                'value' => $data['value']
            ]);

            return $ret;
           }

           function getTerms()
           {
               $ret = []; $clubs = [];

                $terms = Terms::where('id','>','0')->get();
               
               if($terms != null)
               {
                  foreach($terms as $t)
                  {
                      $temp = $this->getTerm($t->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getTerm($id)
           {
               $ret = [];
               $t = Terms::where('id',$id)->first();

               if($t != null)
               {
                   $ret['id'] = $t->id;
                   $ret['name'] = $t->name;
                   $ret['value'] = $t->value;
               }

               return $ret;
           }

          

           function removeTerm($id)
           {
               $t = Terms::where('id',$id)->first();
               if($t != null) $t->delete();
           }

           function addSchoolAdmission($data)
           {
            $ret = SchoolAdmissions::create([
                'school_id' => $data['school_id'],
                'session' => $data['session'],
                'term_id' => $data['term_id'],
                'form_id' => $data['form_id'],
                'end_date' => $data['end_date']
            ]);

            return $ret;
           }

           function getSchoolAdmissions($school_id='all')
           {
               $ret = []; $clubs = [];
               $admissions = [];

               if($school_id === 'all')
               {
                  $admissions = SchoolAdmissions::where('id','>','0')->get();
               }
               else
               {
                $admissions = SchoolAdmissions::where('school_id',$school_id)->get();
               }
               
               if($admissions != null)
               {
                  foreach($admissions as $a)
                  {
                      $temp = $this->getSchoolAdmission($a->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getSchoolAdmission($id)
           {
               $ret = [];
               $a = SchoolAdmissions::where('id',$id)->first();

               if($a != null)
               {
                   $ret['id'] = $a->id;
                   $ret['school_id'] = $a->school_id;
                   $ret['classes'] = $this->getAdmissionClasses($a->id);
                   $ret['applications'] = $this->getSchoolApplications($a->id);
                   $ret['session'] = $a->session;
                   $ret['term_id'] = $a->term_id;
                   $ret['form_id'] = $a->form_id;
                   $ret['date'] = $a->created_at->format("jS F, Y");
                   $ret['end_date'] = $a->end_date;
                   $ret['end_date_formatted'] = Carbon::parse($a->end_date)->format("jS F, Y");
               }

               return $ret;
           }

           function updateSchoolAdmission($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['xf']))
               {
               	    $a = SchoolAdmissions::where('id', $data['xf'])->first();
 
                        if($a != null)
                        {
							$payload = [];
                            if(isset($data['session'])) $payload['session'] = $data['session'];
                            if(isset($data['term_id'])) $payload['term_id'] = $data['term_id'];
                            if(isset($data['form_id'])) $payload['form_id'] = $data['form_id'];
                            if(isset($data['end_date'])) $payload['end_date'] = $data['end_date'];
                           
                        	$a->update($payload);
                             $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }

          

           function removeSchoolAdmission($id)
           {
               $a = SchoolAdmissions::where('id',$id)->first();
               if($a != null) $a->delete();
           }


           function addAdmissionForm($data)
           {
            $ret = AdmissionForms::create([
                'admission_id' => $data['admission_id'],
                'status' => $data['status']
            ]);

            return $ret;
           }

           function getAdmissionForms($admission_id='all')
           {
               $ret = [];
               $forms = [];

               if($admission_id === 'all')
               {
                  $forms = AdmissionForms::where('id','>','0')->get();
               }
               else
               {
                $forms = AdmissionForms::where('admission_id',$admission_id)->get();
               }
               
               if($forms != null)
               {
                  foreach($forms as $f)
                  {
                      $temp = $this->getAdmissionForm($f->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getAdmissionForm($id)
           {
               $ret = [];
               $f = AdmissionForms::where('id',$id)->first();

               if($f != null)
               {
                   $ret['id'] = $f->id;
                   $ret['admission_id'] = $f->admission_id;
                   $ret['fields'] = $this->getFormFields($f->id);
                   $ret['status'] = $f->status;
                   $ret['date'] = $f->created_at->format("jS F, Y");
               }

               return $ret;
           }

           function updateAdmissionForm($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['xf']))
               {
               	    $f = AdmissionForms::where('id', $data['xf'])->first();
 
                        if($f != null)
                        {
							$payload = [];
                            if(isset($data['status'])) $payload['status'] = $data['status'];
                           
                        	$f->update($payload);
                             $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }

          

           function removeAdmissionForm($id)
           {
               $f = AdmissionForms::where('id',$id)->first();
               if($f != null) $f->delete();
           }

           function addAdmissionClass($data)
           {
            $ret = AdmissionClasses::create([
                'admission_id' => $data['admission_id'],
                'class_id' => $data['class_id']
            ]);

            return $ret;
           }

           function getAdmissionClasses($admission_id='all')
           {
               $ret = [];
               $forms = [];

               if($admission_id === 'all')
               {
                  $forms = AdmissionClasses::where('id','>','0')->get();
               }
               else
               {
                $forms = AdmissionClasses::where('admission_id',$admission_id)->get();
               }
               
            
               if($forms != null)
               {
                  foreach($forms as $f)
                  {
                      $temp = $this->getAdmissionClass($f->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getAdmissionClass($id)
           {
               $ret = [];
               $f = AdmissionClasses::where('id',$id)->first();

               if($f != null)
               {
                
                   $ret['id'] = $f->id;
                   $ret['admission_id'] = $f->admission_id;
                   $ret['class'] = $this->getSchoolClass($f->class_id);
                   $ret['date'] = $f->created_at->format("jS F, Y");
               }
               
               return $ret;
           }

          

           function removeAdmissionClass($id)
           {
               $f = AdmissionClasses::where('id',$id)->first();
               if($f != null) $f->delete();
           }

           function removeAdmissionClasses($admission_id)
           {
             $a = SchoolAdmissions::where('id',$admission_id)->first();

             if($a !== null)
             {
                $classes = $this->getAdmissionClasses($admission_id);

                foreach($classes as $c)
                {
                    $this->removeAdmissionClass($c['id']);
                }
             }
           }

           function extractAdmissionClasses($classes)
           {
            $ret = [];
            

              for($j = 0; $j < count($classes); $j++)
              {
                $c = $classes[$j]['class'];
                array_push($ret,$c);
              }

              
              return $ret;
           }

           function addFormField($data)
           {
            $ret = FormFields::create([
                'section_id' => $data['section_id'],
                'title' => $data['title'],
                'type' => $data['type'],
                'description' => $data['description'],
                'bs_length' => $data['bs_length'],
                'options' => $data['options'],
            ]);

            return $ret;
           }

         

           function getFormFields($section_id='all')
           {
               $ret = [];
               $form_fields = [];

               if($section_id === 'all')
               {
                  $form_fields = FormFields::where('id','>','0')->get();
               }
               else
               {
                $form_fields = FormFields::where('section_id',$section_id)->get();
               }
               
               if($form_fields != null)
               {
                  foreach($form_fields as $f)
                  {
                      $temp = $this->getFormField($f->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getFormField($id)
           {
               $ret = [];
               $f = FormFields::where('id',$id)->first();

               if($f != null)
               {
                   $ret['id'] = $f->id;
                   $ret['section_id'] = $f->section_id;
                   $ret['title'] = $f->title;
                   $ret['type'] = $f->type;
                   $ret['description'] = $f->description;
                   $ret['bs_length'] = $f->bs_length;
                   $ret['options'] = $f->options;
                   $ret['options'] = $f->options;
                   $ret['ui'] = $this->getFormUI($f);
               }

               return $ret;
           }

          

           function removeFormField($id)
           {
               $f = FormFields::where('id',$id)->first();
               if($f != null) $f->delete();
           }

           function removeFormFields($section_id)
           {
               $f = FormSections::where('id',$section_id)->first();
               if($f != null)
               {
                $form_fields = $this->getFormFields($f->id);

                if(count($form_fields) > 0)
                {
                    foreach($form_fields as $ff)
                    {
                        $this->removeFormField($ff['id']);
                    }
                }
               } 
           }

           function getFormUI($formField)
           {
                 $fieldType = $formField->type;
                 $title = $formField->title;
                 $id = $formField->id;
                 $description = $formField->description;
                 $bs_length = $formField->bs_length;
                 $options = json_decode($formField->options);
                 $optionsLength = count($options) + 1;
                 $optionsText = "";
                 
                 if($optionsLength > 1)
                 {
                   
                     foreach($options as $option)
                     {
                         $name = $option->name;
                         $value = $option->value;
                         $optionsText .= "<option class='bs-title-option' value='$value'>$name</option>";
                     }
                 }
 
                 $ret = "";
 
                 switch($fieldType)
                 {
                   case "text":
                     $ret = <<<EOD
                     <input type="text" class="input-text" data-bld-type="$fieldType" id="fbld-$id" placeholder="Fill in your answer">
 EOD;
                   break;
 
                   case "password":
                     $ret = <<<EOD
                     <input type="text" class="input-text" data-bld-type="$fieldType" id="fbld-$id" placeholder="Enter password">
 EOD;
                   break;
 
                   case "date":
                     $ret = <<<EOD
                     <input type="date" class="input-text" data-bld-type="$fieldType" id="fbld-$id">
 EOD;
                   break;
 
                   case "select":
                     $ret = <<<EOD
                      <select id="fbld-$id" class="selectpicker default" data-selected-text-format="count" data-bld-type="$fieldType"  data-size="{$optionsLength}"
                       title="$title" tabindex="-98">
                        <option class="bs-title-option" value="none">Select an option</option>
                        $optionsText
                      </select>
                    
 EOD;
                   break;
 
                   case "checkbox":
                     $ret = <<<EOD
                     <div class="col-md-6">
                     <h5>Description</h5>
                     @include('components.form-validation', ['id' => "fbas-description-validation",'style' => "margin-top: 10px;"])
                     <input type="text" class="input-text" name="fbas-description" id="fbas-description" placeholder="Description">
                    </div>
 EOD;
                   break;
 
                   case "radio":
                     $ret = <<<EOD
                     <div class="col-md-6">
                     <h5>Description</h5>
                     @include('components.form-validation', ['id' => "fbas-description-validation",'style' => "margin-top: 10px;"])
                     <input type="text" class="input-text" name="fbas-description" id="fbas-description" placeholder="Description">
                    </div>
 EOD;
                   break;
 
                   case "file":
                     $ret = <<<EOD
                     <div class="col-md-6">
                     <h5>Description</h5>
                     @include('components.form-validation', ['id' => "fbas-description-validation",'style' => "margin-top: 10px;"])
                     <input type="text" class="input-text" name="fbas-description" id="fbas-description" placeholder="Description">
                    </div>
 EOD;
                   break;
                 }
 
 
                 $fieldHTML = <<<EOD
                 <div class="col-md-$bs_length">
                     <h5>$title</h5>
                     $ret
                    </div>
 EOD;
 
                 return $fieldHTML;
           }

           function addFormSection($data)
           {
            $ret = FormSections::create([
                'form_id' => $data['form_id'],
                'title' => $data['title'],
                'description' => $data['description']
            ]);

            return $ret;
           }

         

           function getFormSections($form_id='all')
           {
               $ret = [];
               $form_sections = [];

               if($form_id === 'all')
               {
                  $form_sections = FormSections::where('id','>','0')->get();
               }
               else
               {
                $form_sections = FormSections::where('form_id',$form_id)->get();
               }
               
               if($form_sections != null)
               {
                  foreach($form_sections as $f)
                  {
                      $temp = $this->getFormSection($f->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getFormSection($id)
           {
               $ret = [];
               $f = FormSections::where('id',$id)->first();

               if($f != null)
               {
                   $ret['id'] = $f->id;
                   $ret['form_id'] = $f->form_id;
                   $ret['title'] = $f->title;
                   $ret['type'] = $f->type;
                   $ret['description'] = $f->description;
                   $ret['form_fields'] = $this->getFormFields($f->id);
               }

               return $ret;
           }

           function removeFormSection($id)
           {
               $f = FormSections::where('id',$id)->first();
               if($f != null)
               {
                $this->removeFormFields($f->id);
                $f->delete();
               } 
           }


           function addSchoolApplication($data)
           {
            $ret = SchoolApplications::create([
                'admission_id' => $data['admission_id'],
                'user_id' => $data['user_id'],
                'status' => $data['status'],
            ]);

            return $ret;
           }

           function getSchoolApplications($admission_id='all')
           {
               $ret = [];
               $applications = [];

               if($applications === 'all')
               {
                  $applications = SchoolApplications::where('id','>','0')->get();
               }
               else
               {
                $applications = SchoolApplications::where('admission_id',$admission_id)->get();
               }
               
               if($applications != null)
               {
                  foreach($applications as $a)
                  {
                      $temp = $this->getSchoolApplication($a->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getSchoolApplication($id)
           {
               $ret = [];
               $a = SchoolApplications::where('id',$id)->first();

               if($a != null)
               {
                   $ret['id'] = $a->id;
                   $ret['admission_id'] = $a->admission_id;
                   $ret['status'] = $a->status;
                   $ret['user'] = $this->getUser($a->user_id);
                   $ret['date'] = $a->created_at->format("jS F, Y");
               }

               return $ret;
           }

           function updateSchoolApplication($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['xf']))
               {
               	    $a = SchoolApplications::where('id', $data['xf'])->first();
 
                        if($a != null)
                        {
							$payload = [];
                            if(isset($data['status'])) $payload['status'] = $data['status'];
                           
                        	$a->update($payload);
                             $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }

          

           function removeSchoolApplication($id)
           {
               $a = SchoolApplications::where('id',$id)->first();
               if($a != null)
               {
                  $data = ApplicationData::where('application_id',$id)->get();

                  if($data !== null)
                  {
                    foreach($data as $d)
                    {
                        $d->delete();
                    }
                  }
                  $a->delete();
               } 
           }


           function addApplicationData($data)
           {
            $ret = ApplicationData::create([
                'application_id' => $data['application_id'],
                'form_field_id' => $data['form_field_id'],
                'value' => $data['value']
            ]);

            return $ret;
           }

           function getApplicationData($application_id='all')
           {
               $ret = [];
               $data = [];

               if($application_id === 'all')
               {
                  $data = ApplicationData::where('id','>','0')->get();
               }
               else
               {
                $data = ApplicationData::where('application_id',$application_id)->get();
               }
               
               if($data != null)
               {
                  foreach($data as $d)
                  {
                      $temp = $this->getApplicationDatum($d->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getApplicationDatum($id)
           {
               $ret = [];
               $a = ApplicationData::where('id',$id)->first();

               if($a != null)
               {
                   $ret['id'] = $a->id;
                   $ret['application_id'] = $a->form_id;
                   $ret['form_field_id'] = $a->form_field_id;
                   $ret['value'] = $a->value;
                   $ret['date'] = $a->created_at->format("jS F, Y");
               }

               return $ret;
           }

          

           function removeApplicationData($id)
           {
               $a = ApplicationData::where('id',$id)->first();
               if($a != null) $a->delete();
           }

           function addSchoolNotification($data)
           {
            $ret = SchoolNotifications::create([
                'school_id' => $data['school_id'],
                'action_id' => $data['action_id'],
                'notification_type' => $data['notification_type']
            ]);

            return $ret;
           }

           function getSchoolNotifications($school_id)
           {
               $ret = [];
               $data = [];

                $data = SchoolNotifications::where('id',$school_id)->get();
              
               
               if($data != null)
               {
                  foreach($data as $d)
                  {
                      $temp = $this->getSchoolNotification($d->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getSchoolNotification($id)
           {
               $ret = [];
               $a = SchoolNotifications::where('id',$id)->first();

               if($a != null)
               {
                   $ret['id'] = $a->id;
                   $ret['school_id'] = $a->school_id;
                   $ret['action_id'] = $a->action_id;
                   $ret['notification_type'] = $a->notification_type;
                   $ret['date'] = $a->created_at->format("jS F, Y");
               }

               return $ret;
           }

          

           function removeSchoolNotification($id)
           {
               $a = SchoolNotifications::where('id',$id)->first();
               if($a != null) $a->delete();
           }

           function addSchoolReview($data)
           {
            $ret = SchoolReviews::create([
                'school_id' => $data['school_id'],
                'user_id' => $data['user_id'],
                'environment' => $data['environment'],
                'service' => $data['service'],
                'price' => $data['price'],
                'comment' => $data['comment'],
                'status' => 'pending',
            ]);

            return $ret;
           }


           function getSchoolReviews($school_id)
           {
               $ret = [];
               $data = [];

                $data = SchoolReviews::where('id',$school_id)->get();
              
               
               if($data != null)
               {
                  foreach($data as $d)
                  {
                      $temp = $this->getSchoolReview($d->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getSchoolReview($id)
           {
               $ret = [];
               $a = SchoolReviews::where('id',$id)->first();

               if($a != null)
               {
                   $ret['id'] = $a->id;
                   $ret['school_id'] = $a->school_id;
                   $ret['user'] = $this->getUser($a->user_id);
                   $ret['environment'] = $a->environment;
                   $ret['service'] = $a->service;
                   $ret['price'] = $a->price;
                   $ret['comment'] = $a->comment;
                   $ret['status'] = $a->status;
                   $ret['date'] = $a->created_at->format("jS F, Y");
               }

               return $ret;
           }

           function updateSchoolReview($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['email']))
               {
               	$r = SchoolReviews::where('id', $data['xf'])->first();
 
                        if($r != null)
                        {
							$payload = [];
                            if(isset($data['status'])) $payload['status'] = $data['status'];
                           
                        	$r->update($payload);
                             $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }

          

           function removeSchoolReview($id)
           {
               $a = SchoolReviews::where('id',$id)->first();
               if($a != null) $a->delete();
           }

           function addSchoolBookmark($data)
           {
            $ret = SchoolBookmarks::create([
                'school_id' => $data['school_id'],
                'user_id' => $data['user_id'],
            ]);

            return $ret;
           }


           function getSchoolBookmarks($school_id)
           {
               $ret = [];
               $data = [];

                $data = SchoolBookmarks::where('id',$school_id)->get();
              
               
               if($data != null)
               {
                  foreach($data as $d)
                  {
                      $temp = $this->getSchoolBookmark($d->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getSchoolBookmark($id)
           {
               $ret = [];
               $a = SchoolBookmarks::where('id',$id)->first();

               if($a != null)
               {
                   $ret['id'] = $a->id;
                   $ret['school_id'] = $a->school_id;
                   $ret['user_id'] = $a->user_id;
                   $ret['date'] = $a->created_at->format("jS F, Y");
               }

               return $ret;
           }

           function removeSchoolBookmark($id)
           {
               $a = SchoolBookmarks::where('id',$id)->first();
               if($a != null) $a->delete();
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
                   $ret['date'] = $s->created_at->format("jS F, Y");
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
            if(count($s['banners']) < 1) $ret = false;
            
            $addr = $s['address'];
            
            if(strlen($addr['school_state']) < 1) $ret = false;
            if(strlen($addr['school_address']) < 1) $ret = false;
            if(strlen($addr['longitude']) < 1) $ret = false;
            if(strlen($addr['latitude']) < 1) $ret = false;

            return $ret;

          }

          function getSchoolDashboardStats($s)
          {
            $admissions = $this->getSchoolAdmissions($s['id']);
            $schoolClasses = $this->getSchoolClasses($s['id']);
           
             $ret = [
                'facilities' => count($s['facilities']),
                'admissions' => count($admissions),
                'classes' => count($schoolClasses),
                'reviews' => 0
            ];

            return $ret;
          }

          function numPages($data,$itemsPerPage=7)
           {
             return ceil(count($data) / $itemsPerPage);
           }


          function prevPage($data,$currentPage)
          {
            $ret = [];

            if ($currentPage > 1) {
                --$currentPage;
                $ret = $this->changePage($data,$currentPage);
            }
          }

          function nextPage($data,$currentPage)
          {
            $ret = [];

            if ($currentPage < $this->numPages($data)) {
                ++$currentPage;
                $ret = $this->changePage($data,$currentPage);
            }
          }

          function changePage($data=[],$currentPage=1,$itemsPerPage=7)
          {
            $ret = []; $numPages = $this->numPages($data);
           

            if ($currentPage < 1) $currentPage = 1;
            if ($currentPage > $numPages) $currentPage = $numPages;

            $temp = [];

            if($currentPage > 0)
            {
                for($i = ($currentPage - 1) * $itemsPerPage; $i < ($currentPage * $itemsPerPage) && $i < count($data); $i++)
                {
                    
                    array_push($ret,$data[$i]);
                }
            }
            
            return $ret;
          }

          function getSchoolCount($type)
          {
            $ret = 0;

            if($type === 'early')
            {
              $ret = SchoolInfo::where('school_type','early-only')
                               ->orWhere('school_type','early-primary-secondary')->count();
            }
            else if($type === 'primary')
            {
              $ret = SchoolInfo::where('school_type','primary-only')
                               ->orWhere('school_type','primary-secondary')
                               ->orWhere('school_type','early-primary-secondary')->count();
            }
            else if($type === 'secondary')
            {
              $ret = SchoolInfo::where('school_type','secondary-only')
                               ->orWhere('school_type','primary-secondary')
                               ->orWhere('school_type','early-primary-secondary')->count();
            }
            else if($type === 'day')
            {
              $ret = SchoolInfo::where('boarding_type','day')
                                ->orWhere('boarding_type','both')->count();
            }
            else if($type === 'boarding')
            {
                $ret = SchoolInfo::where('boarding_type','boarding')
                                 ->orWhere('boarding_type','both')->count();
            }

            return $ret;
          }

          

          function filterSchools($category)
          {
            $ret = []; $schools = null;

            if($category === 'all' || $category === 'active')
            {
              $ret = $this->getSchools(['id' => "all","status" => "active"]);
            }
            else if($category === 'pending')
            {
              $ret = $this->getSchools(['id' => "all","status" => "pending"]);
            }
            else
            {
                if($category === 'early')
                {
                  $schools = SchoolInfo::where('school_type','early-only')
                                   ->orWhere('school_type','early-primary-secondary')->get();
                }
                else if($category === 'primary')
                {
                  $schools = SchoolInfo::where('school_type','primary-only')
                  ->orWhere('school_type','primary-secondary')
                  ->orWhere('school_type','early-primary-secondary')->get();
                }
    
                else if($category === 'secondary')
                {
                  $schools = SchoolInfo::where('school_type','secondary-only')
                  ->orWhere('school_type','primary-secondary')
                  ->orWhere('school_type','early-primary-secondary')->get();
                }
                else if($category === 'day')
                {
                    $schools = SchoolInfo::where('boarding_type','day')
                    ->orWhere('boarding_type','both')->get();
                }
                else if($category === 'boarding')
                {
                  $schools  = SchoolInfo::where('boarding_type','day')
                  ->orWhere('boarding_type','both')->get();
                }
                
    
                if($schools !== null)
                {
                    foreach($schools as $s)
                    {
                        $temp = $this->getSchool($s->school_id);
                        array_push($ret,$temp);
                    }
                }
            }
            

            return $ret;
          }

          function parseSchoolNotifications($school,$data)
          {
            $ret = [];
            $sname = $school['name'];
            $vu = url('school')."?xf=".$school['url'];

            if(count($data) > 0)
            {
                foreach($data as $n)
                {
                    $temp = ['icon' => "", 'content' => ""];

                    switch($n['notification_type'])
                    {
                        case 'bookmark':
                            $temp['icon'] = 'sl-icon-eye';
                            $temp['content'] = <<<EOD
                            Someone Bookmarked <strong><a href="$vu">$sname</a></strong>
EOD;          
                        break;

                        case 'review':
                            $u = $this->getUser($data['action_id']);
                            $temp['icon'] = 'sl-icon-layers';
                            $uname = $u['fname']." ".$u['lname'];
                            $temp['content'] = <<<EOD
                            $uname Left A Review On <strong><a href="$vu">$sname</a></strong>
EOD;
                        break;
                    }
                    array_push($ret,$temp);

                    
                }
            /*
             [
			['id' => "1",'type' => "success",'content' => "<p>This is a success notification</p>"],
			//['id' => "2",'type' => "warning",'content' => "<p>This is a warning notification</p>"],
			//['id' => "3",'type' => "notice",'content' => "<p>This is an info notification</p>"],
		   ];
            */
            }
            
            return $ret;
          }

          function calculateRating($reviews)
          {
            //dd($reviews);
            $ret = [
                'rating' => 0,
                'environment' => 0,
                'service' => 0,
                'price' => 0
            ];

            foreach($reviews as $r)
            {
               $ret['environment'] += $r['environment'];
               $ret['service'] += $r['service'];
               $ret['price'] += $r['price'];
            }

            $ret['rating'] = (($ret['environment'] + $ret['service'] + $ret['price']) / 20) / 3; 
            
            return $ret;
          }

          function getSimilarSchools($s)
          {
            $ret = [];
           
            $schools = $this->getSchools(['id' => "all","status" => "active"]);
            

            foreach($schools as $s)
            {
                $allReviews = $this->getSchoolReviews($s['id']);
                $s['calculatedRating'] = $this->calculateRating($allReviews);
                array_push($ret,$s);
            }

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