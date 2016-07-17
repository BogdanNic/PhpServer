<?php
function send($message){
 //	echo "Asd";
	$url = 'https://api.parse.com/1/push';
    $APPLICATION_ID = 'VixxPiH9qFNjAWzvH8E99zM0BtBKXQKoagOl1Y37';
	$REST_API_KEY = 'Gdz8U0HjgEmXsJvIIqOwT9lDKwfuPDffAu8lUHRY';  
	$MESSAGE = "your-alert-message";

        $url = 'https://api.parse.com/1/push';
        $data = array(
            'channel' => '',
            'type' => 'android',
            'expiry' => 1451606400,
            'data' => array(
                'alert' => $message,
            ),
        );
        $_data = json_encode($data);
        $headers = array(
            'X-Parse-Application-Id: ' . $APPLICATION_ID,
            'X-Parse-REST-API-Key: ' . $REST_API_KEY,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        );
		//echo $APPLICATION_ID;
		//echo $REST_API_KEY;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);   
} 
function send2($message,$headMessage){
 //	echo "Asd";
 $target_device = 'L5VYOYpln9';
	$url = 'https://api.parse.com/1/push';
    $APPLICATION_ID = 'VixxPiH9qFNjAWzvH8E99zM0BtBKXQKoagOl1Y37';
	$REST_API_KEY = 'Gdz8U0HjgEmXsJvIIqOwT9lDKwfuPDffAu8lUHRY';  
	$MESSAGE = "your-alert-message";

        $url = 'https://api.parse.com/1/push';
        $data = array(
              'channel' => '',

            'type' => 'android',
            'expiry' => 1451606400, 
            'data' => array(
                'alert' => $message,
				'title' =>$headMessage  
            ),   
        );
        $_data = json_encode($data);
        $headers = array(
            'X-Parse-Application-Id: ' . $APPLICATION_ID,
            'X-Parse-REST-API-Key: ' . $REST_API_KEY,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        );
		//echo $APPLICATION_ID;
		//echo $REST_API_KEY;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);   
}
function send3($message){
 //	echo "Asd";
	$url = 'https://api.parse.com/1/push';
    $APPLICATION_ID = 'VixxPiH9qFNjAWzvH8E99zM0BtBKXQKoagOl1Y37';
	$REST_API_KEY = 'Gdz8U0HjgEmXsJvIIqOwT9lDKwfuPDffAu8lUHRY';  
	$MESSAGE = "your-alert-message";

        $url = 'https://api.parse.com/1/push';
        $data = array(
			'where'=>array(
                'idBog' => 1,  
			),  
            'data' => array(
                'alert' => $message,  
            ), 
        );
        $_data = json_encode($data);
        $headers = array(
            'X-Parse-Application-Id: ' . $APPLICATION_ID,
            'X-Parse-REST-API-Key: ' . $REST_API_KEY,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        );
		//echo $APPLICATION_ID;
		//echo $REST_API_KEY;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		echo $_data;
	   $response = curl_exec($curl);   
}    
function send4($message){ 
 //	echo "Asd";
	$url = 'https://api.parse.com/1/push';
    $APPLICATION_ID = 'VixxPiH9qFNjAWzvH8E99zM0BtBKXQKoagOl1Y37';
	$REST_API_KEY = 'Gdz8U0HjgEmXsJvIIqOwT9lDKwfuPDffAu8lUHRY';  
	$MESSAGE = "your-alert-message";

        $url = 'https://api.parse.com/1/push';
        $data = array(
			'where'=>array(
                'idBog' => array('$ne'=>0),    
			),   
            'data' => array(
                'alert' => $message,  
            ), 
        );
        $_data = json_encode($data);
        $headers = array(
            'X-Parse-Application-Id: ' . $APPLICATION_ID,
            'X-Parse-REST-API-Key: ' . $REST_API_KEY,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        );
		//echo $APPLICATION_ID;
		//echo $REST_API_KEY;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		echo $_data;
	   $response = curl_exec($curl);   
}
function send5($message){  
 //	echo "Asd";
	$url = 'https://api.parse.com/1/push';
    $APPLICATION_ID = 'D4qRI513LE4vZVQtwg8TIYOgaQVcCLrHZO61Uokg';
	$REST_API_KEY = 'QqTsOqUm5iAnvI1uU3XDj3ngcJqpf1gwmkcNPpA5';  
	$MESSAGE = "your-alert-message";

        $url = 'https://api.parse.com/1/push';
        $data = array(
			'where'=>array(
                'objectId' =>'Zo3rylGQNr',    
			),   
            'data' => array(
                'alert' => $message,  
            ), 
        );
        $_data = json_encode($data);
        $headers = array(
            'X-Parse-Application-Id: ' . $APPLICATION_ID,
            'X-Parse-REST-API-Key: ' . $REST_API_KEY,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        );
		//echo $APPLICATION_ID;
		//echo $REST_API_KEY;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		echo $_data;
	   $response = curl_exec($curl);   
}
function send6($message){  
 //	echo "Asd";
	$url = 'https://api.parse.com/1/push';
    $APPLICATION_ID = 'D4qRI513LE4vZVQtwg8TIYOgaQVcCLrHZO61Uokg';
	$REST_API_KEY = 'QqTsOqUm5iAnvI1uU3XDj3ngcJqpf1gwmkcNPpA5';  
	$MESSAGE = "your-alert-message";

        $url = 'https://api.parse.com/1/push';
        $data = array(
			'where'=>array(
                'objectId' =>'Zo3rylGQNr',    
			),   
            'data' => array(
                'data' => $message,   
            ), 
        );
        $_data = json_encode($data);
        $headers = array(
            'X-Parse-Application-Id: ' . $APPLICATION_ID,
            'X-Parse-REST-API-Key: ' . $REST_API_KEY,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        );
		//echo $APPLICATION_ID;
		//echo $REST_API_KEY;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		echo $_data;
	   $response = curl_exec($curl);   
}  
function send7($user,$command){        
 //	echo "Asd";
	$url = 'https://api.parse.com/1/push';
    $APPLICATION_ID = 'D4qRI513LE4vZVQtwg8TIYOgaQVcCLrHZO61Uokg';
	$REST_API_KEY = 'QqTsOqUm5iAnvI1uU3XDj3ngcJqpf1gwmkcNPpA5';  
	//$MESSAGE = "your-alert-message";
//$message2=$message." bog";

//verificam daca in installation este cine cu numele de "bog"(user)
//users este array (nu conteaza) si daca gaseste trimite
        $url = 'https://api.parse.com/1/push';
        $data = array(
			'where'=>array(
                'users' =>$user,                
			),   
            'data' => array(
                'user' => $user,
				'command'=>$command
            ), 
        );
        $_data = json_encode($data);
        $headers = array(
            'X-Parse-Application-Id: ' . $APPLICATION_ID,
            'X-Parse-REST-API-Key: ' . $REST_API_KEY,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        );
		//echo $APPLICATION_ID;
		//echo $REST_API_KEY;  
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
		
		//if you want Curl to return the transfer data instead of printing it out directly.        		
		//curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);      
		//echo $_data;
	 
//	 $response = curl_exec($curl);  
curl_exec($curl);     
} 
function sendParseNotification2($user,$command,$deviceType){          
 //http://blog.markturansky.com/archives/205  
// echo "Asd";
	$url = 'https://api.parse.com/1/push';      
    $APPLICATION_ID = 'D4qRI513LE4vZVQtwg8TIYOgaQVcCLrHZO61Uokg';
	$REST_API_KEY = 'QqTsOqUm5iAnvI1uU3XDj3ngcJqpf1gwmkcNPpA5';  
	//$MESSAGE = "your-alert-message";
//$message2=$message." bog";
$platforms=array('android','windphone');

//verificam daca in installation este cine cu numele de "bog"(user)
//users este array (nu conteaza) si daca gaseste trimite
        $url = 'https://api.parse.com/1/push';
        $data = array( 
			'where'=>array(  
                'users' =>$user,        
				'deviceType' =>array('$in'=>['android','winphone']),                            
			),   
            'data' => array(
                'user' => $user,
				'command'=>$command
            ), 
        );
        $_data = json_encode($data);
        $headers = array(
            'X-Parse-Application-Id: ' . $APPLICATION_ID,
            'X-Parse-REST-API-Key: ' . $REST_API_KEY,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        );
		//echo $APPLICATION_ID;
		//echo $REST_API_KEY;  
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);    
		
		//if you want Curl to return the transfer data instead of printing it out directly.        		
		//curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);      
		echo $_data;    
	  
//	 $response = curl_exec($curl);  
curl_exec($curl);     
}

function sendParseNotification3($user,$command,$deviceType){          
 //	echo "Asd";
	$url = 'https://api.parse.com/1/push';
    $APPLICATION_ID = 'D4qRI513LE4vZVQtwg8TIYOgaQVcCLrHZO61Uokg';
	$REST_API_KEY = 'QqTsOqUm5iAnvI1uU3XDj3ngcJqpf1gwmkcNPpA5';  
//$platforms=array('android','winphone');   
$platforms=array('android');          
if (($key = array_search($deviceType, $platforms)) !== false) {
    //deletes only the element not index 
	unset($platforms[$key]);
}   
//restore the array indexs to normal 1,2,3..
//removes the empty index
$platforms2 = array_values($platforms);
      
//verificam daca in installation este cine cu numele de "bog"(user)
//users este array (nu conteaza) si daca gaseste trimite
        $url = 'https://api.parse.com/1/push';
        $data = array( 
			'where'=>array(  
                'users' =>$user,        
				'deviceType' =>array('$in'=>$platforms2),                               
				                            
				                            
			),   
            'data' => array(
                'user' => $user,
				'command'=>$command
            ), 
        );
        $_data = json_encode($data);
        $headers = array(
            'X-Parse-Application-Id: ' . $APPLICATION_ID,
            'X-Parse-REST-API-Key: ' . $REST_API_KEY,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        );
		//echo $APPLICATION_ID;
		//echo $REST_API_KEY;  
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
		
		//if you want Curl to return the transfer data instead of printing it out directly.        		
		//curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);      
		echo $_data;    
	  
//	 $response = curl_exec($curl);  
curl_exec($curl);     
}


function sendParseNotification($user,$command,$deviceType){
	sendParseNotificationSocket($user,$command,$deviceType);
}

function sendParseNotificationSocket($user,$command,$deviceType){            
 //	echo "Asd";
	$url = 'https://api.parse.com/1/push';
    $APPLICATION_ID = 'D4qRI513LE4vZVQtwg8TIYOgaQVcCLrHZO61Uokg';
	$REST_API_KEY = 'QqTsOqUm5iAnvI1uU3XDj3ngcJqpf1gwmkcNPpA5';  
  
$platforms=array('android','winphone');              
if (($key = array_search($deviceType, $platforms)) !== false) {
    //deletes only the element not index 
	unset($platforms[$key]);     
}   
//restore the array indexs to normal 1,2,3..
//removes the empty index
$platforms2 = array_values($platforms);
 $data = array( 
			'where'=>array(  
                'users' =>$user,        
				'deviceType' =>array('$in'=>$platforms2),                               
				                            
				                            
			),   
               'data' => array(
                'user' => $user,
				'command'=>$command      
            ), 
        );
		//
		//'data' => array(
        //        'alert' => 'sas'
        //  ),
		
		
  $_data = json_encode($data);

 //echo $content = http_build_query($_data);  
 $url='tls://api.parse.com';  
 $urlBog='bogdan.w.pw';      
   
$fp = fsockopen($url, 443, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";    
} else {  
  	  
//fwrite($fp,"POST /v1/sock2.php HTTP/1.1\r\n");   
 fwrite($fp,"POST /1/push HTTP/1.1\r\n"); 
fwrite($fp,"Host: bogdan.w.pw \r\n");   
fwrite($fp,"X-Parse-Application-Id: D4qRI513LE4vZVQtwg8TIYOgaQVcCLrHZO61Uokg\r\n");
fwrite($fp,"X-Parse-REST-API-Key: QqTsOqUm5iAnvI1uU3XDj3ngcJqpf1gwmkcNPpA5\r\n");        
//fwrite($fp,"Content-Type: application/json\r\n");        
fwrite($fp,"Content-Length: ".strlen($_data)."\r\n");   
fwrite($fp,"Connection: Close\r\n\r\n");    
fwrite($fp, $_data);   
    //while (!feof($fp)) { 
    //    echo fgets($fp, 4096);   
    //}
fclose($fp);  
}     
    
}

function put($message){
 //	echo "Asd";
	$url = 'https://api.parse.com/1/push';
    $APPLICATION_ID = 'VixxPiH9qFNjAWzvH8E99zM0BtBKXQKoagOl1Y37';
	$REST_API_KEY = 'Gdz8U0HjgEmXsJvIIqOwT9lDKwfuPDffAu8lUHRY';  
	$MESSAGE = "your-alert-message";
$target_device = 'L5VYOYpln9'; 
        $url = 'https://api.parse.com/1/push';
        $data = array(
            'where'=>array(
				'objectId'=>'L5VYOYpln9'
			),
            'type' => 'android',
            'expiry' => 1451606400,
            'data' => array(
                'alert' => $message,
            ),
        );
		$push_payload = json_encode(array(
			"where" => array(
                "objectId" => $target_device,
			),
			"data" => array(
                "alert" => "This is the alert text."
			)
		));
        $_data = json_encode($data);
        $headers = array(
            'X-Parse-Application-Id: ' . $APPLICATION_ID,
            'X-Parse-REST-API-Key: ' . $REST_API_KEY,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        );
		//echo $APPLICATION_ID;
		//echo $REST_API_KEY;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data); 
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
        $response = curl_exec($curl);   
}      

function sendTest($token,$message){
		echo "Asd";
$tokenReal='fB1j-SlhsuI:APA91bEbO26kiIgIDo8RuIWOHz34aKezb2alUSbIaFzRDfZFzJb9J3m76Le61tM-BO0nGFdlPeQR5fWN3QedueWnAWDHrY_7SZ4Bq0aVhq6xIYAakqaQ-kbzvYWQpR2GsG0LFvQ0uMmk';
	$url = 'https://fcm.googleapis.com/fcm/send';
   $headers=array(
	'Authorization:key=AIzaSyDhNYr1df8nr0pFplLdY2t8v0Xgo0W-O5c',
	'Content-Type:application/json'
   );
   $user="radu@yahoo.com";
   $command="SYNC";
   $_data=array(
	'registration_ids'=>array(
			$tokenReal,$tokenReal                     
				), 
	'data' => array(
                'user' => $user,
				'command'=>$command)     
   );
   $jsonData=json_encode($_data);
   $curl = curl_init($url);
	curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS,$jsonData);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    echo $_data;
	   $response = curl_exec($curl);
	   print $response; 
print $jsonData;	   
echo curl_error($curl);	
curl_close($curl);   
}
function sendFirebaseNotification($tokens,$email,$command)
{
    //    echo json_encode($tokens);  
    //    echo $email;
    //    echo $command;
    $url = 'https://fcm.googleapis.com/fcm/send';
   $headers=array(
	'Authorization:key=AIzaSyDhNYr1df8nr0pFplLdY2t8v0Xgo0W-O5c',
	'Content-Type:application/json'
   );
    $_data=array(
	'registration_ids'=>$tokens, 
	'data' => array(
                'user' => $email,
				'command'=>$command)     
   );
   $jsonData=json_encode($_data);
   $curl = curl_init($url);
	curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS,$jsonData);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    echo $_data;
	   $response = curl_exec($curl);
	   print $response; 
print $jsonData;     	   
echo curl_error($curl);	
curl_close($curl);   
}     

?>
