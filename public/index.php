<?php


use App\Models\Message;
use App\Models\MoneyTranferRecord;
use App\Models\Profile;
use App\Models\SlideShow;
use App\Models\User;

require_once "../app/config/init.php";

$user = new User();
echo $user->update(["phone" => "999999", "name" => "cho99"], "id", 1);


