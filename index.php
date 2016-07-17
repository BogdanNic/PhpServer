<?php
        
require_once 'DBHelper.php'; 
require_once '../include/PassHash.php';
require '../libPhp/Slim/Slim.php';
require  'pushHelper.php';  
\Slim\Slim::registerAutoloader();
 
$app = new \Slim\Slim(array(  
    'mode' => 'development'
)); 
     
$app->options("/raports/:raport_id",function()use ($app){  
 $app = \Slim\Slim::getInstance();      
cors();       
//$app->response->headers->set('Content-Type','application/json');
$app->response->headers->set('Access-Control-Allow-Origin','*');  
resJson(212,"");       
});
$app->options("/raportsNew/:raport_id",function()use ($app){  
 $app = \Slim\Slim::getInstance();      
cors();     
//$app->response->headers->set('Content-Type','application/json');
$app->response->headers->set('Access-Control-Allow-Origin','*');  
resJson(212,"");       
});
    
//user new Raport2        
//.............
    
$app->options("/raports2",function()use ($app){    
 $app = \Slim\Slim::getInstance();  
cors();    
//$app->response->headers->set('Content-Type','application/json');
$app->response->headers->set('Access-Control-Allow-Origin','*');  
resJson(212,"");               
});
$app->options("/raports2/:raport_id",function()use ($app){    
 $app = \Slim\Slim::getInstance();          
cors();     
//$app->response->headers->set('Content-Type','application/json');
$app->response->headers->set('Access-Control-Allow-Origin','*');  
resJson(212,"");       
});
//............
//end

$app->options("/raportsNew",function()use ($app){  
 $app = \Slim\Slim::getInstance();  
cors();    
//$app->response->headers->set('Content-Type','application/json');
$app->response->headers->set('Access-Control-Allow-Origin','*');  
resJson(212,"");       
});



$app->options("/login",function()use ($app){    
 $app = \Slim\Slim::getInstance();  
cors();    
//$app->response->headers->set('Content-Type','application/json');
$app->response->headers->set('Access-Control-Allow-Origin','*');  
resJson(212,"");     
});
$app->options("/register",function()use ($app){    
 $app = \Slim\Slim::getInstance();  
cors();    
//$app->response->headers->set('Content-Type','application/json');
$app->response->headers->set('Access-Control-Allow-Origin','*');  
resJson(212,"");     
});    
function cors() {  

    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");  
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE, OPTIONS");           

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    echo "You have CORS!";  
}
$app->options("/raports",function()use ($app){  
 $app = \Slim\Slim::getInstance();  
cors();  
//$app->response->headers->set('Content-Type','application/json');
$app->response->headers->set('Access-Control-Allow-Origin','*');  
resJson(212,"");     
});
////new Raport2
//..................
$app->get('/raports2',auth,function() use ($app){  
   	global $user_name;
	global $user_id;   
	$db=new DBHelper();  
	$timeUnix=time();   
	//echo $timeUnix;  
	//echo $user_id;

	$res=$db->getAllRaportsNew2($user_id,$user_name);
	$result=array();
	$result['error']=false;  
	$result['raports']=$res;
	resJson(200,$res);    
  
});


$app->post('/raports2',auth,function() use ($app){

//echo "meta Rap";
$response=array();    
   global $user_id;   
   global $user_name;
   global $model;
   //echo $user_id;   
	$response['ore']    =$Ore=$app->request->post('ore');
	$response['min']    =$Minute=$app->request->post('minute');
	$response['materiale']=$Materiale=$app->request->post('materiale');
	$response['vizualizari']=$Vizualizari=$app->request->post('vizualizari');
	$response['studi']  =$Studi=$app->request->post('studi');
	$response['visite'] =$Visite=$app->request->post('visite');
	$response['partener'] =$Partener=$app->request->post('partener');
	$response['month'] =$Month=$app->request->post('month'); 
	$response['ip']=$ip=$app->request->getIp(); 
	$response['lastUpdate']=$lastUpdate=$app->request->post('lastUpdate');   
	$response['userAgent']=$userAgent=$app->request->getUserAgent();
	//$response;   
	$deviceType="";
	if($userAgent){
		switch($userAgent){
			case "Android":$deviceType="android";break;
			case "WindowsPhone 8":$deviceType="winphone"; break;
			case "Windows 8":$deviceType="winrt"; break;
			default:
			$deviceType="web";break;  
		}
	}
$db=new DBHelper();  
//$res2=$db->test(111);
//$res2=db->test($user_name,$Partener,$Month,$Ore,$Minute,$Reviste,$Carti,$Brosuri,$Visite,$Studi); 
//selectRaport2($user_id,$user_name,$Partener,$Month,$Ore,$Minute,$Materiale,$Vizualizari,$Visite,$Studi) 
$res=$db->selectRaport2($user_id,$user_name,$Partener,$Month,$Ore,$Minute,$Materiale,$Vizualizari,$Visite,$Studi); 
$nr=count($res);  
//echo $nr;      
$results=array();        
switch($nr){
case 0: //echo "no";
//echo $user_name;   
		$res2=$db->insertRaport2($user_id,$user_name,$Partener,$Month,$Ore,$Minute,$Materiale,$Vizualizari,$Visite,$Studi);	   
		//echo $res2;		
			if(!$res2['error']){    
				$command='ADD';
				$raport_id=$res2['raport_id'];
				//echo "RaportID:"+ $raport_id;      
				//echo $lastUpdate;    
				//echo $command;    
					$res3=$db->insertMetaRaport($raport_id,$user_id,$ip,$command,$lastUpdate,$userAgent,$deviceType,$model);
						if(!$res3['error']){
							$metaRaportId=$res3['raport_id']; 
							//echo $raport_id;
							//echo $metaRaportId;
							$result['error']=false;   
							$result['raport_id']=$res2['raport_id'];
							
						    resJson(201, $result);   
							sendParseNotification($user_name,"insert",$deviceType);
						}else{  
							$result['error']=true;     
							$result['message']=$res3['message'];
						} 		 
			}else{
				//echo 'insert fail into metaRaport';  
				//echo $res2['message'];
				$result['error']=true;   
				$result['message']=$res2['message']; 
				resJson(200, $result);   
			}
		
		break;
case 1:	

		$result['error']=true; 
		$result['message']='it it\'s here'; 
		resJson(200, $result); 
		break;
default:$result['error']=true; 
		$result['message']='to many'; 
		resJson(200, $result); 
break;
}
  //resJson(200, $result);       
}); 


$app->put('/raports2/:raport_id',auth,function($raport_id) use ($app){
   global $user_id; 
   global $user_name;
   global $model;
	$response=array();
	$response['error']=true;   
	$response['ore']    =$Ore=$app->request->post('ore');
	$response['minute']    =$Minute=$app->request->post('minute');
	$response['materiale']=$Materiale=$app->request->post('materiale');
	$response['vizualizari']=$Vizualizari=$app->request->post('vizualizari');
	$response['studi']  =$Studi=$app->request->post('studi');
	$response['visite'] =$Visite=$app->request->post('visite');
	$response['partener'] =$Partener=$app->request->post('partener');
	$response['month'] =$Month=$app->request->post('month'); 
	$response['lastUpdate']=$lastUpdate=$app->request->post('lastUpdate');
	$response['ip']=$ip=$app->request->getIp(); 
	$response['userAgent']=$userAgent=$app->request->getUserAgent(); 
	//refactor 
		$deviceType="";
		if($userAgent){
		switch($userAgent){
		case "Android":$deviceType="android";break;
		case "WindowsPhone 8":$deviceType="winphone"; break;
		case "Windows 8":$deviceType="winrt"; break;
		default:
		$deviceType="web";break;
		}
	}
  
		$db=new DBHelper();
	    $res = $db->selectMetaByRaportId2($user_id, $user_name, $raport_id, $lastUpdate);
        $result = array();
        $result['error'] = true;
        $result['message'] = 'imposible to update2';
      
		if (!$res['error'])  
        {
            $selectedCommand = $res['command'];
            $selectedLastUpdate = $res['lastUpdate'];
            $selectedRaportID = $res['raport_id'];
            $selectedmetaRaportID = $res['metaRaportID'];
  
			//pt add si update are aceiase valoare  
            switch ($selectedCommand)
            {
                case 'REMOVE':  
                    $result['message'] = 'has been deleted';
                    break;
                case 'ADD':  
                case 'UPDATE':   
                    $result['message'] = 'it is here ';
                   // $result['metaRaportID']=$selectedmetaRaportID;
                    if($lastUpdate>$selectedLastUpdate){
						//         updateRaport2($raport_id,$user_name,$Partener,$Month,$Ore,$Minute,$Materiale,$Vizualizari,$Visite,$Studi)
                        $res2=$db->updateRaport2($raport_id,$user_name,$Partener,$Month,$Ore,$Minute,$Materiale,$Vizualizari,$Visite,$Studi);
                        //TODO: change behaviour of update to post error on 
						//update the same report no changes made  
						if(!$res2['error']){
                           $command2='UPDATE';   
						   $res3=$db->updateMetaRaport($command2,$lastUpdate,$selectedmetaRaportID,$userAgent,$deviceType);
							if(!$res3['error']){
								$result['error']=false;  
								$result['message'] = 'it great ';
								sendParseNotification($user_name,"update",$deviceType);            
							}else{							
								$result['message'] = $res3['message'];
							}
						}else{   
                            $result['message'] = $res2['message'];
                        }  
						
						    
						
                    }else{  
                        $result['message'] = 'it new version it s here';
                    }
                    break;
            }

        } else
        {
            $result['message'] ='erro fins it';
        }
		
		
		
		
        resJson(200, $result);
 
});


$app->delete('/raports2/:raport_id',auth,function($raport_id) use ($app){
	global $user_id;   
	global $user_name;
	global $model;
	$userAgent=$app->request->getUserAgent();
 
  // echo $id; 
   $newUpdate=$_GET["lastUpdate"]; 
  
	$deviceType="";
	if($userAgent){
		switch($userAgent){
			case "Android":$deviceType="android";break;
			case "WindowsPhone 8":$deviceType="winphone"; break;
			case "Windows 8":$deviceType="winrt"; break;
			default:
			$deviceType="web";break;
		}
	}
  $isNotifyUser=false;  
  $response=array();
  //$lastUpdate=$app->request->post('lastUpdate'); 
    
 //echo  $lastUpdate;                
  
  $db=new DBHelper();             
  
  $res=$db->selectMetaByRaportId2($user_id,$user_name,$raport_id,$newUpdate);
   
 // print_r($res); 
  ////move  the array up the tree so i can accest it prin argumente $res['error'] etc 
   array_shift($res);
   if(!$res['error']){  
       	$metaRaportID=$res['metaRaportID'];
		$oldUpdate=$res['lastUpdate'];
		$command=$res['command'];        
    //print_r($res);    	
	switch($command){
	case "ADD":   
	case "UPDATE":
					if($newUpdate>=$oldUpdate){
						$command2='REMOVE';
						//$lastUpdate=
						$res2=$db->updateMetaRaport($command2,$newUpdate,$metaRaportID,$userAgent,$deviceType);
						if(!$res2['error']){
							$response['error']=false;
							$response['message']='O K';
							
							
							resJson(200,$response);
							sendParseNotification($user_name,"remove",$deviceType);    
						}else{
							$response['error']=true;
							$response['message']=$res2['message'];
							resJson(404,$response);
							}
					}else{
						$response['error']=true; 
						//print_r(array_shift($res));
						$response['oldUpdate']=$oldUpdate;
						$response['newUpdate']=$newUpdate;   
						$response['id']=$metaRaportID;  
						$response['message']='you are trying to deleted a new version';         
						resJson(200,$response);
					}
				break;					
	case "REMOVE":			$response['error']=true;
							$response['message']='has been deleted';
							resJson(404,$response);
				break;	
	}
   
   }else{
   resJson(200,$res);    
   }
   
   
}); 

$app->get('/raports2/updateSince/:id',auth,function($id) use ($app){
  //echo gmdate("Y-m-d\TH:i:s\Z", $id); 

 //$date2= gmdate("Y-m-d H:i:s", $id); 
  global $user_name;
	global $user_id;
	$db=new DBHelper();    
	$res=$db->getChangesSince2($user_id,$id);    
	resJson(200,$res);     
});


$app->get('/raports2/preflight',function() use ($app){  
	$response=array('error'=>false,'message'=>"all good");
	resJson(200,$response);   
});   
  
//..................
//end

//new raportNew
//................................................
$app->get('/raportsNew/updateSince/:id',auth,function($id) use ($app){
//echo gmdate("Y-m-d\TH:i:s\Z", $id); 

 //$date2= gmdate("Y-m-d H:i:s", $id); 
  global $user_name;
	global $user_id;
$db=new DBHelper();    
$res=$db->getChangesSince($user_id,$id);  
resJson(200,$res);     
});

$app->get('/raportsNew/preflight',function() use ($app){ 	
	$response=array('error'=>false,'message'=>"all good");
	resJson(200,$response);   
});
$app->get('/raportsNew',auth,function() use ($app){          
   global $user_name;
global $user_id;   
$db=new DBHelper();  
$timeUnix=time();   
//echo $timeUnix;  
//echo $user_id;

$res=$db->getAllRaportsNew($user_id,$user_name);
$result=array();
$result['error']=false;  
$result['raports']=$res;          
resJson(200,$res);    
  
});



$app->post('/raportsNew',auth,function() use ($app){

 //echo "meta Rap";
 $response=array();    
   global $user_id;   
   global $user_name;

   //echo $user_id;   
	$response['ore']    =$Ore=$app->request->post('ore');
	$response['min']    =$Minute=$app->request->post('minute');
	$response['reviste']=$Reviste=$app->request->post('reviste');
	$response['brosuri']=$Brosuri=$app->request->post('brosuri');
	$response['carti']  =$Carti=$app->request->post('carti'); 
	$response['studi']  =$Studi=$app->request->post('studi');
	$response['visite'] =$Visite=$app->request->post('visite');
	$response['partener'] =$Partener=$app->request->post('partener');
	$response['month'] =$Month=$app->request->post('month'); 
	$response['ip']=$ip=$app->request->getIp(); 
	$response['lastUpdate']=$lastUpdate=$app->request->post('lastUpdate'); 
	$response['userAgent']=$userAgent=$app->request->getUserAgent();

	$deviceType="";
	if($userAgent){
		switch($userAgent){
		case "Android":$deviceType="android";break;
		case "WindowsPhone 8":$deviceType="winphone"; break;
		case "Windows 8":$deviceType="winrt"; break;
		default:
		$deviceType="web";break;
		}
	}
	$db=new DBHelper();  
//$res2=$db->test(111);
//$res2=db->test($user_name,$Partener,$Month,$Ore,$Minute,$Reviste,$Carti,$Brosuri,$Visite,$Studi);  
$res=$db->selectRaport($user_id,$user_name,$Partener,$Month,$Ore,$Minute,$Reviste,$Brosuri,$Visite,$Studi,$Carti); 
$nr=count($res);
//echo $nr;  
$results=array();  
switch($nr){
case 0: //echo "no";
//echo $user_name; 
		$res2=$db->insertRaport($user_id,$user_name,$Partener,$Month,$Ore,$Minute,$Reviste,$Carti,$Brosuri,$Visite,$Studi);	   
//print $res2;		
			if(!$res2['error']){
				$command='ADD';
				$raport_id=$res2['raport_id'];
				//echo "RaportID:"+ $raport_id;      
				//echo $lastUpdate;    
				//echo $command;    
					$res3=$db->insertMetaRaport($raport_id,$user_id,$ip,$command,$lastUpdate,$userAgent,$deviceType);
						if(!$res3['error']){
							$metaRaportId=$res3['raport_id']; 
							//echo $raport_id;
							//echo $metaRaportId;
							$result['error']=false;   
							$result['raport_id']=$res2['raport_id'];
							
						    resJson(201, $result);   
							sendParseNotification($user_name,"insert",$deviceType);
						}else{  
							$result['error']=true;     
							$result['message']=$res3['message'];
						} 		 
			}else{
				//echo 'insert fail into metaRaport';  
				//echo $res2['message'];
				$result['error']=true;   
				$result['message']=$res2['message']; 
				resJson(200, $result);   
			}
		
		break;
case 1:	

		$result['error']=true; 
		$result['message']='it it\'s here'; 
		resJson(200, $result); 
		break;
default:$result['error']=true; 
		$result['message']='to many'; 
		resJson(200, $result); 
break;
}
  //resJson(200, $result);       
});   



$app->post('/updateMetaRaport',auth,function() use ($app){
   global $user_id;   
   global $user_name;
   
  $command=$app->request->post('command'); 
  $lastUpdate=$app->request->post('lastUpdate');
  $metaRaportID=$app->request->post('metaRaportID');
$db=new DBHelper();
$res=$db->updateMetaRaport($command,$lastUpdate,$metaRaportID); 
  
  resJson(200,$res);
  
  }); 

  
$app->delete('/raportsNew/:raport_id',auth,function($raport_id) use ($app){
   global $user_id;   
   global $user_name;
   $userAgent=$app->request->getUserAgent();  
  // echo $id; 
  $model="GT1";
  if($model==null) $model="GT1";
  
  $deviceType="";
if($userAgent){
switch($userAgent){
case "Android":$deviceType="android";break;
case "WindowsPhone 8":$deviceType="winphone"; break;
case "Windows 8":$deviceType="winrt"; break;
default:
$deviceType="web";break;
}
}
  $isNotifyUser=false;  
  $response=array();
  //$lastUpdate=$app->request->post('lastUpdate'); 
 $newUpdate=$_GET["lastUpdate"];     
 //echo  $lastUpdate;                
  
  $db=new DBHelper();           
  
  $res=$db->selectMetaByRaportId($user_id,$user_name,$raport_id,$newUpdate);
   
 // print_r($res); 
  ////move  the array up the tree so i can accest it prin argumente $res['error'] etc 
   array_shift($res);
   if(!$res['error']){  
  $metaRaportID=$res['metaRaportID'];
   $oldUpdate=$res['lastUpdate'];
  $command=$res['command'];             
    //print_r($res);    	
	switch($command){
	case "ADD":   
	case "UPDATE":
					if($newUpdate>=$oldUpdate){
						$command2='REMOVE';
						//$lastUpdate=
						$res2=$db->updateMetaRaport($command2,$newUpdate,$metaRaportID,$userAgent,$deviceType);
						if(!$res2['error']){
							$response['error']=false;
							$response['message']='O K';
							
							
							resJson(200,$response);
							sendParseNotification($user_name,"remove",$deviceType);    
						}else{
							$response['error']=true;
							$response['message']=$res2['message'];
							resJson(404,$response);
							}
					}else{
						$response['error']=true; 
						//print_r(array_shift($res));
						$response['oldUpdate']=$oldUpdate;
						$response['newUpdate']=$newUpdate;   
						$response['id']=$metaRaportID;  
						$response['message']='you are trying to deleted a new version';         
						resJson(200,$response);
					}
				break;					
	case "REMOVE":			$response['error']=true;
							$response['message']='has been deleted';
							resJson(404,$response);
				break;	
	}
   
   }else{
   resJson(200,$res);    
   }
   
   
}); 
    
$app->put('/raportsNew/:raport_id',auth,function($raport_id) use ($app){
   global $user_id; 
   global $user_name;
$response=array();
$response['error']=true;   
$response['ore']    =$Ore=$app->request->post('ore');
$response['minute']    =$Minute=$app->request->post('minute');
$response['reviste']=$Reviste=$app->request->post('reviste');
$response['brosuri']=$Brosuri=$app->request->post('brosuri');
$response['carti']  =$Carti=$app->request->post('carti'); 
$response['studi']  =$Studi=$app->request->post('studi');
$response['visite'] =$Visite=$app->request->post('visite');
$response['partener'] =$Partener=$app->request->post('partener');
$response['month'] =$Month=$app->request->post('month'); 
$response['lastUpdate']=$lastUpdate=$app->request->post('lastUpdate');
$response['ip']=$ip=$app->request->getIp(); 
$response['userAgent']=$userAgent=$app->request->getUserAgent(); 
//refactor
$deviceType="";
if($userAgent){
switch($userAgent){
case "Android":$deviceType="android";break;
case "WindowsPhone 8":$deviceType="winphone"; break;
case "Windows 8":$deviceType="winrt"; break;
default:
$deviceType="web";break;
}
}
  
		$db=new DBHelper();
	    $res = $db->selectMetaByRaportId($user_id, $user_name, $raport_id, $lastUpdate);
        $result = array();
        $result['error'] = true;
        $result['message'] = 'imposible to update2';
      
		if (!$res['error'])  
        {
            $selectedCommand = $res['command'];
            $selectedLastUpdate = $res['lastUpdate'];
            $selectedRaportID = $res['raport_id'];
            $selectedmetaRaportID = $res['metaRaportID'];
  
			//pt add si update are aceiase valoare
            switch ($selectedCommand)
            {
                case 'REMOVE':  
                    $result['message'] = 'has been deleted';
                    break;
                case 'ADD':  
                case 'UPDATE':   
                    $result['message'] = 'it is here ';
                   // $result['metaRaportID']=$selectedmetaRaportID;
                    if($lastUpdate>$selectedLastUpdate){
                        $res2=$db->updateRaport($raport_id,$user_name,$Partener,$Month,$Ore,$Minute,$Reviste,$Carti,$Brosuri,$Visite,$Studi);
                        //TODO: change behaviour of update to post error on 
						//update the same report no changes made  
						if(!$res2['error']){
                           $command2='UPDATE';   
						   $res3=$db->updateMetaRaport($command2,$lastUpdate,$selectedmetaRaportID,$userAgent,$deviceType);
							if(!$res3['error']){
								$result['error']=false;  
								$result['message'] = 'it great ';
								sendParseNotification($user_name,"update",$deviceType);            
							}else{							
								$result['message'] = $res3['message'];
							}
						}else{   
                            $result['message'] = $res2['message'];
                        }  
						
						  
						
                    }else{  
                        $result['message'] = 'it new version it s here';
                    }
                    break;
            }

        } else
        {
            $result['message'] ='erro fins it';
        }
		
		
		
		
        resJson(200, $result);
 
});  

$app->post('/raports2/token',auth,function() use ($app){
   global $user_id; 
   global $user_name;
   global $email;   
   global $model; 
$device=$app->request->post('device');
$os=$app->request->post('os');
$token=$app->request->post('token');   

$response=array();      
$response['error']=true;       
// $response['device']   =$device=$app->request->post('device');
// $response['os']   =$os=$app->request->post('os');
// $response['token']   =$token=$app->request->post('token');
// $response['userId']   =$user_id;

$db=new DBHelper();
	    $res = $db->getTokens($user_id,$model); 
		$tokens=$res['tokens'];  
		$command='SYNC';
		 sendFirebaseNotification($tokens,$email,$command);
		$response=$res;
		// if($res['nr']==1){
		// 	$result=$res['result'];
		// 	$responseToken=$result[0]['token'];
		// 	if($responseToken==$token)    
		// 	{  
		// 		$response['result']='it is here!';
		// 		$response['error']=false;   
		// 	} else{
		// 		$res3=$db->updateToken($user_id,$device,$os,$token);
		// 		$response=$res3;  
		// 	}    
				      
		// 	}else{
		// 		$res2=$db->insertToken($user_id,$device,$os,$token);
		// 		$response=$res2;  
		// 		//$response['error']=$res2['error'];
		// }
resJson(200,$response);                   
});  




//end
//...............................................................................


function basicAuth(){
  $headers=$app->request->headers;
  //$respHead=$app->response->set('WWW-Authenticate: Basic realm',"My Realm");
 $user=  $headers['Php-Auth-User'];
 $password=$headers['Php-Auth-Pw'];
 //echo $user,$password;
  // resJson(200,$headers);  
 print_r($headers);
};


function auth(\Slim\Route $route){ 

 $app = \Slim\Slim::getInstance();
  $response=array();
  $app->setCookie('foo', 'bar', '2 days');
$headers=$app->request->headers;
if(isset($headers['Authorization']))
	{
		$api_key=$headers['Authorization'];
		$db=new DBHelper();
		$res=$db->isUserAuth($api_key);
		if(!$res['error']){
			global $user_id;
			global $user_name;
			global $model;
			global $email;
			$user_id=$res['id']; 
			$user_name=$res['username'];
			$email=$res['email'];  
//echo $user_id;			 

			//echo $user_id;    
			//echo $user_name; 
if(isset($headers['Model']))
	{
		 $model=$headers['Model'];
	}else{
		$model="NoName";
	}



		}else{
			$response['error']=true;
			$response['message']='Authorization false';
			resJson(401, $response);
            $app->stop(); 
			}
	}else{
		$response['error']=true;
		$response['message']='No Authorization code supplied';
		resJson(400, $response);
		$app->stop();
		}
}
	
$app->get('/change', function () {   
   // echo "Hello, $name ";   
$app = \Slim\Slim::getInstance();
$app->response->setStatus(200); 
$app->response->headers->set('Access-Control-Allow-Origin','*');              
$app->response->headers->set('Content-Type',' text/event-stream');       
$app->response->headers->set('Cache-Control',' no-cache');  
//   $time = date('r');
//echo "data: The server time is: {$time}\n\n";
//flush();  
//echo "retry: 10000\n";        
	  $time = date('r');   
global  $isNewDataAvailable;        
	//$isNewDataAvailable=true;    
if($isNewDataAvailable){
	
	$isNewDataAvailable=false;      
	
	echo "event: userlogon\n\n";   
//echo "data: The server time is: {$time}\n\n";
echo "data:updateRaport";
$raport=array();

			$raport['raportID']=2;
			$raport['LastUpdate']=4;
			$raport['Command']="add";
			$raport['Month']='2009 0-86400';
			$raport['Nr']=2;  
			$raport['results']='goot';  
echo "data:raportData ".json_encode($raport).PHP_EOL;       

	
}else{
	$isNewDataAvailable=true;  	    
	echo "data:0";   

}


  
//echo "data: The server time is:10\n\n";
//flush();             
  
});






















  $app->get('/hello/:b', function ($b) { 
    echo "Hello, $name "; 
 $app = \Slim\Slim::getInstance();
$app->response->setStatus($status);       
$app->response->headers->set('Content-Type',' text/event-stream');       
$app->response->headers->set('Cache-Control',' no-cache');  
   $time = date('r');
//echo "data: The server time is: {$time}\n\n";
echo "data: The server time is: 10\n\n"; 
flush();          
});  


  $app->get('/hello/:b', function ($b) {   
    echo "Hello, $name "; 
echo $bog2;
echo $b."\n"; 
echo time();    
});

$app->delete('/hello', function() { 
    echo "Hello, $name ";   
//  	$headers=$app->request->headers  ;   
//  if(isset($headers['Model']))
//  	{
//  		$model=$headers['Model']    
//  	}
// echo $model;  
echo $bog2;
echo $b."\n"; 
echo time();    
});

$app->post('/hello',function() use ($app){
$req=$app->request->post('name');
$headers=$app->request->headers;
if(isset($headers['Authorization'])){
//echo $headers['Authorization'];   
}
//resJson(200,$req);   
echo $req;
});  


$app->post('/login',function() use ($app){
	$response=array();
	
	$email=$app->request->post('email');
	$password = $app->request->post('password'); 
	$username = $app->request->post('username');  	
	//echo $email;
	//echo $password;  
	$db=new DBHelper(); 
	$res=$db->login($email,$password,$username);
	
	resJson(200,$res);    
});
$app->post('/register',function() use ($app){  
$response = array();


	$name=$app->request->post('name'); 
	$email=$app->request->post('email');
	$password = $app->request->post('password');
$username = $app->request->post('username'); 	
$db=new DBHelper();     
$res=$db->createUser($username,$name,$password,$email);     
  //$res=$db->checkUserExist($email); 
		if ($res["message"] == "USER_CREATED_SUCCESSFULLY") {    
                $response["error"] = false;  
				$response["api_key"]=$res["api_key"];   
                $response["message"] = "You are successfully registered";
            } else if ($res["message"] == "USER_CREATE_FAILED") {
                $response["error"] = true;
                $response["message"] = "Oops! An error occurred while registereing";
            } else if ($res["message"] == "USER_ALREADY_EXISTED") {
                $response["error"] = true;
                $response["message"] = "Sorry, this email already existed";
            }	  
	resJson(201,$response);     
	
});
 
$app->get('/raports',auth,function(){
   global $user_id;   
   global $user_name;  
  // echo $user_id;       
$db=new DBHelper();    
$res=$db->getAllRaports(-1,$user_name);
resJson(200,$res);          
});

  

$app->get('/raports/:id',auth,function($id){
$db=new DBHelper();  
$res=$db->getSingleRaport($id);
$response=array();

if(!$res['error']){

resJson(200,$res); 
}else{
 
 resJson(404,$res); 
}
    
});  
$app->post('/raportsTest/:id',auth,function($id) use ($app){ 
   global $user_id;   
   global $user_name;
   $db=new DBHelper();  
$t1=$db->createUserRaport($id,$user_id);
resJson(200,$t1);  
});  
$app->post('/raports',auth,function() use ($app){
$response=array();    
   global $user_id;   
   global $user_name;
   //echo $user_name;  
$response['ore']    =$Ore=$app->request->post('ore');
$response['min']    =$Min=$app->request->post('minute');
$response['reviste']=$Reviste=$app->request->post('reviste');
$response['brosuri']=$Brosuri=$app->request->post('brosuri');
$response['carti']  =$Carti=$app->request->post('carti'); 
$response['studi']  =$Studi=$app->request->post('studi');
$response['visite'] =$Visite=$app->request->post('visite');
$response['partener'] =$Partener=$app->request->post('partener');
$response['month'] =$Month=$app->request->post('month'); 
$response['ip']=$ip=$app->request->getIp(); 
//insertRaport($user_id,$ore,$minute,$reviste,$carti,$brosuri,$visite,$studi)
$db=new DBHelper(); 
$responseFinal=array();
$responseFinal['error']=true;
//to check param before enteryn
$res=$db->insertRaport($user_id,$user_name,$Partener,$Month,$Ore,$Min,$Reviste,$Carti,$Brosuri,$Visite,$Studi);
if(!$res['error']){
	$responseFinal['error']=false;
	$responseFinal['raport_id']=$res['raport_id'];
	$raport_id=$res['raport_id'];   

	//$t1=$db->createUserRaport($raport_id,$user_id);  
	//if(!$t1['error'])
	//{  
	resJson(201,$responseFinal);	
	//}else {
	//print_r($t1); 
	//}
	 
	}else{
		$responseFinal['error']=true;
		$responseFinal['message']=$res['message'];
		resJson(200,$responseFinal);  
	}
//resJson(201,$response);     
});
$app->delete('/raports/:id',auth,function($id) use ($app){
   global $user_id; 
   global $user_name;
$db=new DBHelper();  
$res=$db->deleteRaport($id,$user_name);  
if(!$res['error']){
resJson(200,$res);  
}else{

resJson(404,$res);   
}
  
});
$app->put('/raports/:id',auth,function($id) use ($app) {
   global $user_id; 
   global $user_name;
$response=array();
$response['ore']    =$Ore=$app->request->post('ore');
$response['min']    =$Min=$app->request->post('minute');
$response['reviste']=$Reviste=$app->request->post('reviste');
$response['brosuri']=$Brosuri=$app->request->post('brosuri');
$response['carti']  =$Carti=$app->request->post('carti'); 
$response['studi']  =$Studi=$app->request->post('studi');
$response['visite'] =$Visite=$app->request->post('visite');
$response['partener'] =$Partener=$app->request->post('partener');
$response['month'] =$Month=$app->request->post('month'); 
$response['ip']=$ip=$app->request->getIp();      
$db=new DBHelper();    

$res=$db->updateRaport($id,$user_name,$Partener,$Month,$Ore,$Min,$Reviste,$Carti,$Brosuri,$Visite,$Studi); 
if(!$res['error']){
		
		$res2=$db->getSingleRaport($id);
		$res['raport']=$res2['raport'];  
		//print_r($res2);
		resJson(200,$res);      
}else{  
resJson(404,$res);   
}


});


$app->get('/quiz/',function(){
  // echo $user_id;       
$db=new DBHelper();    
$res=$db->getAllQuiz();  
resJson(200,$res);
});

 
 
/**
 * Validating email address
 */
function validateEmail($email) {
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"] = true;
        $response["message"] = 'Email address is not valid';
        resJson(400, $response);
        $app->stop();
    }
}
function resJson($status,$response){
 $app = \Slim\Slim::getInstance();
$app->response->setStatus($status);     
$app->response->headers->set('Access-Control-Allow-Origin','*');      
$app->response->headers->set('Content-Type','application/json');  
$res=array();
//$res['rtasdas']="asdasd";
//$res['rtasdas3']="asdasd3";
//$app->response->write("bog");   
//$app->response->finalize();              
echo json_encode($response);     
}    
function remove_utf8_bom($text)
{
    $bom = pack('H*','EFBBBF');
    $text = preg_replace("/^$bom/", '', $text);
	//echo "dasd";
    return $text;
}
$app->run();
?>