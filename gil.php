	<?php
$pin="031101";
error_reporting(E_ERROR | E_PARSE);;
error_reporting(E_ERROR | E_PARSE);
$header = array();
$header[] = "X-Platform:Android";
$header[] = 'X-UniqueId:c'.mt_rand(0,9).'ff'.mt_rand(100,999).'d'.mt_rand(10,99).'ad'.mt_rand(1000,9999);
$header[] = 'D'.mt_rand(0,9).':E'.mt_rand(0,9).':'.mt_rand(10,99).':'.mt_rand(10,99).':'.mt_rand(10,99).':'.mt_rand(0,9).'F:F'.mt_rand(0,9).':'.mt_rand(10,99).':'.mt_rand(10,99).':FB:CD:'.mt_rand(10,99).':'.mt_rand(10,99).':'.mt_rand(0,9).'E:FF:'.mt_rand(0,9).'F:'.mt_rand(10,99).':'.mt_rand(0,9).'A:'.mt_rand(10,99).':D'.mt_rand(0,9).':'.mt_rand(10,99).':'.mt_rand(0,9).'E:'.mt_rand(10,99).':'.mt_rand(0,9).'C:'.mt_rand(0,9).'E:'.mt_rand(10,99).':B'.mt_rand(0,9).':'.mt_rand(10,99).':'.mt_rand(10,99).':'.mt_rand(10,99).':'.mt_rand(0,9).'D:'.mt_rand(0,9).'A:BD';
$header[] = "X-AppVersion:3.39.1";
$header[] = "X-AppId:com.gojek.app";
$header[] = "Accept:application/json";
$header[] = 'X-Session-ID:'.mt_rand(0,9).'c'.mt_rand(100,999).'ba'.mt_rand(0,9).'-'.mt_rand(10,99).'c'.mt_rand(0,9).'-'.mt_rand(0,9).'a'.mt_rand(10,99).'-'.mt_rand(1000,9999).'-'.mt_rand(10,99).'e'.mt_rand(0,9).'bc'.mt_rand(10000,99999).'b'; 
$PhoneModel=array("G960F","G892A","G930VC","G935S","G920V","G928X");
$header[] = "X-PhoneModel:samsung,SM-".$PhoneModel[mt_rand(0,5)]; 
$header[] = "X-PushTokenType:FCM";    
$header[] = 'X-DeviceOS:Android,'.mt_rand(7,9).'.0';
$header[] = 'X-DeviceToken:e'.mt_rand(0,9).'_'.generateRandomString(90).'-KIL'.generateRandomString(40).'--'.generateRandomString(13);
$header[] = 'Accept-Language:en-ID'; 
$header[] = 'X-User-Locale:en_ID'; 
$header[] = 'X-Location:'.mt_rand(10,99).'.9858'.mt_rand(10,99).',-'.mt_rand(100,999).'.25411'.mt_rand(10,99).''; 
$header[] = 'X-Location-Accuracy:3.9'; 
$header[] = 'X-M1:1:__'.generateRandomString(32).','.mt_rand(0,9).':'.generateRandomString(16).','.mt_rand(0,9).':'.mt_rand(1000000000000,9999999999999).'-'.mt_rand(100000000000000000,999999999999999999).','.mt_rand(0,9).':'.mt_rand(10000,99999).','.mt_rand(0,9).':msm'.mt_rand(1000,9999).'|'.mt_rand(1000,9999).'|'.mt_rand(0,9).','.mt_rand(0,9).':'.mt_rand(01,24).':'.mt_rand(00,60).':'.mt_rand(00,60).':'.mt_rand(0,9).'E:'.mt_rand(10,99).':F'.mt_rand(0,9).','.mt_rand(0,9).':dream2lteks'.generateRandomString(16).',8:720x1280,9:passive\,gps,10:1,11:UNKNOWN'; 
$header[] = 'Content-Type:application/json; charset=UTF-8'; 
$header[] = 'Host:api.gojekapi.com'; 
$header[] = 'Connection:Keep-Alive';
$header[] = 'User-Agent:okhttp/3.12.1';
echo "TOOLS\n";
############# DAPTAR #############
echo "[+] Nomor Mane = ";
$nomer=trim(fgets(STDIN));
$gennama=curl('https://randomuser.me/api/?inc=name&nat=us');
$nama=get_between($gennama, '"first":"', '"').' '.get_between($gennama, '"last":"', '"');
$email = strtolower(str_replace(" ", "", $nama) . mt_rand(100,999) . "@yahoo.co.id");
$register=curl('https://api.gojekapi.com/v5/customers','{"email":"'.$email.'","name":"'.$nama.'","phone":"+62'.$nomer.'","signed_up_country":"ID"}',$header,$proxy);
if (get_between($register,'"otp_token":"','"'!==null)){
$otptoken=get_between($register,'"otp_token":"','","');
while(true){
echo "[+] OTP = ";
$otp=trim(fgets(STDIN));
$verif=curl('https://api.gojekapi.com/v5/customers/phone/verify','{"client_name":"gojek:cons:android","client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e","data":{"otp":"'.$otp.'","otp_token":"'.$otptoken.'"}}',$header,$proxy);
if(get_between($verif,'"access_token":"','"'!==null)){
$token=get_between($verif,'"access_token":"','"');
$r_token=get_between($verif,'"refresh_token":"','"');
$uuid=get_between($verif,'"resource_owner_id":',',');
############# SET PIN #############
$header[] = "User-uuid: $uuid";
$header[] = "Authorization: Bearer $token";
$setpin=curl('https://api.gojekapi.com/wallet/pin','{"pin":"'.$pin.'"}',$header,$proxy);
echo "[+] Pin = ";
$otp_pin=trim(fgets(STDIN));
$header[] = "otp: $otp_pin"; 
$verif_setpin=curl('https://api.gojekapi.com/wallet/pin','{"pin":"'.$pin.'"}',$header,$proxy);
echo "[+] Process Redeem GOFOODSANTAI19 = ";
$GOFOODSANTAI19=curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments','{"promo_code":"GOFOODSANTAI19"}',$header,$proxy);
if (get_between($GOFOODSANTAI19,'"success":',',')=="true"){
	echo "Yeay bisa makan luu... \n";	
	$live = "token-accounts.php";
	$fopen1 = fopen($live, "a+");
	$fwrite1 = fwrite($fopen1, "TOKEN => ".$token." \n NOMOR => ".$nomer." \n");
	fclose($fopen1);
	echo "[+] File Token saved in ".$live." \n";
}
else{
	echo "Gagal Mamankkkk Euy \n";
}
system('clear');
print "\033[01;31m"; // Merah tua
print "=================================== \n";
print "   ____                             \n";
print "  / ___| ___ _ __ ___  _ __   __ _  \n";
print " | |  _ / _ \ '_ ` _ \| '_ \ / _` | \n";
print " | |_| |  __/ | | | | | |_) | (_| | \n";
print "  \____|\___|_| |_| |_| .__/ \__,_| \n";
print "                      |_|   TERKINI \n";
print "=================================== \n";
print "\033[0m"; // Normal
main();
sleep(3);
     break;
}
else{
	echo get_between($verif,'"message":"','"')."\n";
}}}
else{
	die(get_between($register,'"message":"','"')."\n");
}
function curl($url, $fields = null, $header = null,$proxy=null)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
		if ($proxy !== null) {
		curl_setopt($c, CURLOPT_HTTPPROXYTUNNEL, 0);
		curl_setopt($c, CURLOPT_PROXY, $proxy);
		}
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        if ($fields !== null) {
            curl_setopt($c, CURLOPT_POST, 1);
            curl_setopt($c, CURLOPT_POSTFIELDS, $fields);
			//array_push($header,'Content-Length:'.filesize($fields)); 
        }
		else if ($fields == null) {
		curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");
		}			
        if ($header !== null) {
            curl_setopt($c, CURLOPT_HTTPHEADER, $header);
        }
        $response   = curl_exec($c);
        $httpcode = curl_getinfo($c, CURLINFO_HTTP_CODE);
		curl_close($c);
		return $response;
        
	}
function get_between($string, $start, $end) 
	{
	    $string = " ".$string;
	    $ini = strpos($string,$start);
	    if ($ini == 0) return "";
	    $ini += strlen($start);
	    $len = strpos($string,$end,$ini) - $ini;
	    return substr($string,$ini,$len);
	}
function generateRandomString($length) {
    $caracters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $caractersLength = strlen($caracters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $caracters[rand(0, $caractersLength - 1)];
    }
    return $randomString;
	}