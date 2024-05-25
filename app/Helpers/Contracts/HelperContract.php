<?php
namespace App\Helpers\Contracts;

Interface HelperContract
{
        public function symfonySendMail($data);
        public function getEmailContent($type, $data);
        public function createUser($data);
        public function callAPI($data);	
        public function cloudinaryUploadImage($data);
}
 ?>