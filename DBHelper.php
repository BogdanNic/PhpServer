<?php
require '../include/Config.php';   
class DbHelper   
{  
public function updateMetaRaport($command,$lastUpdate,$metaRaportID,$userAgent,$deviceType){
  
$response = array();
       // echo $command;  
        //echo ($lastUpdate);  

        $mysql = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $stmt = $mysql->prepare("UPDATE MetaRaport SET Command=?,LastUpdate=?,UserAgent=?,DeviceType=? WHERE MetaRaportID=?");
        $stmt->bind_param("sissi", $command, $lastUpdate,$userAgent,$deviceType, $metaRaportID);      

        $result = $stmt->execute();    
        $nrRows = $stmt->affected_rows;       
        switch ($nrRows)           
        {  
            case - 1:  
                $response['error'] = true;  
                $response['message'] = 'db error';
                break;
            case 0:
                $response['error'] = true;
                $response['message'] = 'no recods finded';
                break;
            case 1:
                $response['error'] = false;
                $response['message'] = 'doneUploading';
                break;
            default:
        }
        return $response;     

   
}




public function selectRaport($user_id,$user_name,$Partener,$Month,$Ore,$Minute,$Reviste,$Brosuri,$Visite,$Studi,$Carti){
// echo $user_id;
//echo $user_name+'/n';
 //  echo $Partener;
 // echo $Month;
//   echo $Ore;
//   echo $Minute;
//   echo $Reviste;  
//   echo $Brosuri;
//   echo $Visite;
//   echo $Studi;
   //return $Partener;   
  
   $mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
    $stmt = $mysql->prepare("SELECT r.RaportID, m.LastUpdate,r.Month,m.Command FROM Raport r JOIN MetaRaport m ON r.RaportID = m.RaportID WHERE r.Ore =? and r.Minute=? and r.Partener=? and r.Reviste=? and r.Visite=? and r.Month=? and r.Studi=? and r.Brosuri=? and r.Carti=? and r.Username=?");
   $stmt->bind_param("iisiisiiis",$Ore,$Minute,$Partener,$Reviste,$Visite,$Month,$Studi,$Brosuri,$Carti,$user_name);  
  
    $result = $stmt->execute();    
	
	   $res=$stmt->bind_result($raport_id,$lastUpdate,$rMonth,$command);   

	$response=array();
	$raport=array();
	//$response['no']=true;
	////echo $result;
	if($res){
		while($stmt->fetch()){
			$raport['raportID']=$raport_id;
			$raport['LastUpdate']=$lastUpdate;
			$raport['Command']=$command;
			$raport['Month']=$rMonth;
			$raport['Nr']=$res;
			$raport['results']=$result;
			//echo "este"; 
			$response[]=$raport;  
		}
		 
		//$response['no']=false;
		return $response;   
		//return $raport;
	}
	
}    
public function selectRaport2($user_id,$email,$Partener,$Month,$Ore,$Minute,$Materiale,$Vizualizari,$Visite,$Studi){
// echo $user_id;
//echo $user_name+'/n';
 //  echo $Partener;
 // echo $Month;
//   echo $Ore;
//   echo $Minute;
//   echo $Reviste;  
//   echo $Brosuri;
//   echo $Visite;
//   echo $Studi;
   //return $Partener;   
  
   $mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
    $stmt = $mysql->prepare("SELECT r.RaportID, m.LastUpdate,r.Month,m.Command FROM RaportNew r JOIN MetaRaport m ON r.RaportID = m.RaportID WHERE r.Ore =? and r.Minute=? and r.Partener=? and  r.Materiale=? and r.Visite=? and r.Month=? and r.Studi=? and r.Vizualizari=?  and r.Email=?");
   $stmt->bind_param("iisiisiis",$Ore,$Minute,$Partener,$Materiale,$Visite,$Month,$Studi,$Vizualizari,$email);  
  
    $result = $stmt->execute();      
	
	
	   $res=$stmt->bind_result($raport_id,$lastUpdate,$rMonth,$command);   

	$response=array();
	$raport=array();
	//$response['no']=true;
	////echo $result;
	if($res){
		while($stmt->fetch()){
			$raport['raportID']=$raport_id;
			$raport['LastUpdate']=$lastUpdate;
			$raport['Command']=$command;
			$raport['Month']=$rMonth;
			$raport['Nr']=$res;
			$raport['results']=$result;
			//echo "este"; 
			$response[]=$raport;  
		}
		 
		//$response['no']=false;
		return $response;   
		//return $raport;
	}
	
}    




public function selectMetaByRaportId($user_id,$user_name,$raport_id,$lastUpdate){
   //echo $user_id;
   //echo $raport_id;
   //echo $user_name;     
//echo $lastUpdate;
$response=array();  
$response['error']=true;
 $mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
 $stmt = $mysql->prepare("SELECT m.Command, m.RaportID, m.LastUpdate,m.MetaRaportID FROM MetaRaport m INNER JOIN Raport r ON m.RaportID = r.RaportID WHERE m.userRaportID=? and r.RaportID =?");
    
		$stmt->bind_param("ii",$user_id,$raport_id);      
        $result = $stmt->execute();  
		$res=$stmt->bind_result($command,$raport_id,$lastUpdateRez,$metaID);
		// $res=$stmt->bind_result($raport_id,$lastUpdate,$rMonth,$command);
		//echo $result;    
		//echo $res;  
if($res){   
 while($stmt->fetch()){ 
 $response['error']=false;
 $response['metaRaportID']=$metaID; 
$response['raport_id']=$raport_id;
$response['lastUpdate']=$lastUpdateRez;
$response['command']=$command;  
 }
 return $response;

}
return $response;
}  

public function selectMetaByRaportId2($user_id,$user_name,$raport_id,$lastUpdate){
   //echo $user_id;
   //echo $raport_id;
   //echo $user_name;     
//echo $lastUpdate;
$response=array();  
$response['error']=true;
 $mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
 $stmt = $mysql->prepare("SELECT m.Command, m.RaportID, m.LastUpdate,m.MetaRaportID FROM MetaRaport m INNER JOIN RaportNew r ON m.RaportID = r.RaportID WHERE m.userRaportID=? and r.RaportID =?");
    
		$stmt->bind_param("ii",$user_id,$raport_id);      
        $result = $stmt->execute();  
		$res=$stmt->bind_result($command,$raport_id,$lastUpdateRez,$metaID);
		// $res=$stmt->bind_result($raport_id,$lastUpdate,$rMonth,$command);
		//echo $result;    
		//echo $res;  
if($res){   
 while($stmt->fetch()){ 
 $response['error']=false;
 $response['metaRaportID']=$metaID; 
$response['raport_id']=$raport_id;
$response['lastUpdate']=$lastUpdateRez;
$response['command']=$command;  
 }
 return $response;

}
return $response;  
}  


public function addNew(){
 $response=array();
 $mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
     $stmt = $mysql->prepare("SELECT r.RaportID, m.LastUpdate,r.Month FROM Raport r JOIN MetaRaport m ON r.RaportID = m.RaportID WHERE r.Ore =? and r.Minute=? and r.Partener=? and r.Reviste=? and r.Visite=? and r.Month=? and r.Studi=? and r.Brosuri=? and r.Carti=? and r.Username=?");
   $stmt->bind_param("iisiisiiis",$Ore,$Minute,$Partener,$Reviste,$Visite,$Month,$Studi,$Brosuri,$Carti,$user_name);  
  
    $result = $stmt->execute();    
   $res=$stmt->bind_result($raport_id,$lastUpdate,$rMonth);  

if($res){

$response['error']=false;
return $response;          
}
  

$response['error']=true;  
return $response;  
}


public function updateRaport2($raport_id,$email,$Partener,$Month,$Ore,$Minute,$Materiale,$Vizualizari,$Visite,$Studi){
$res=array();
$res['error']=true; 
$res['message']='test';  
$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
$stmt = $mysql->prepare("UPDATE RaportNew Set Partener=? ,Month=?,Ore=?,Minute=?,Vizualizari=?,Studi=?,Visite=?,Materiale=? WHERE RaportID=? and Email=? ");
			  $stmt->bind_param("ssiiiiiiis",$Partener,$Month,$Ore,$Minute,$Vizualizari,$Studi,$Visite,$Materiale,$raport_id,$email);
$stmt->execute(); 
$stmt->store_result();
$affected_rows=$stmt->affected_rows;   
$insert_id=$stmt->insert_id;
$num_rows=$stmt->num_rows;  
 
//echo "insert :$insert_id Num: $num_rows a: $affected_rows"; 
switch ($affected_rows) {
    case -1:
		$res['error']=true; 
		$res['message']='that the query has returned an error';
		break;
	case 0:
        $res['error']=false; 
		$res['message']='no records where updated';
        break;   
    case 1:
       $res['error']=false;  
		$res['message']='great';  
        break; 
    case 2:
        $res['error']=true;
		 $res['message']='to many row update'; 
        break;
}
$stmt->close();
$mysql->close();  
        
return $res;
}
public function updateRaport($raport_id,$user_name,$Partener,$Month,$Ore,$Min,$Reviste,$Carti,$Brosuri,$Visite,$Studi){
$res=array();
$res['error']=true; 
$res['message']='test';  
$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
$stmt = $mysql->prepare("UPDATE Raport Set Partener=? ,Month=?,Ore=?,Minute=?,Brosuri=?,Studi=?,Visite=?,Carti=?,Reviste=? WHERE RaportID=? and Username=? ");
			  $stmt->bind_param("ssiiiiiiiis",$Partener,$Month,$Ore,$Min,$Brosuri,$Studi,$Visite,$Carti,$Reviste,$raport_id,$user_name);
$stmt->execute(); 
$stmt->store_result();
$affected_rows=$stmt->affected_rows; 
$insert_id=$stmt->insert_id;
$num_rows=$stmt->num_rows;  
 
//echo "insert :$insert_id Num: $num_rows a: $affected_rows"; 
switch ($affected_rows) {
    case -1:
		$res['error']=true; 
		$res['message']='that the query has returned an error';
		break;
	case 0:
        $res['error']=false; 
		$res['message']='no records where updated';
        break;   
    case 1:
       $res['error']=false;  
		$res['message']='great';  
        break; 
    case 2:
        $res['error']=true;
		 $res['message']='to many row update'; 
        break;
}
$stmt->close();
$mysql->close();  
        
return $res;
}


public function deleteRaport($raport_id,$user_name){  
$res=array(); 

$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$stmt = $mysql->prepare("DELETE FROM Raport WHERE RaportID=? and Username=? "); 
$stmt->bind_param("ss",$raport_id,$user_name); 
$stmt->execute(); 
$stmt->store_result();
$num_rows=$stmt->num_rows;	//pt select
$insert_id=$stmt->insert_id;
//Returns the number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query. 
$affected_rows=$stmt->affected_rows; 
	//echo "affect: $affected_rows row: $num_rows ins $insert_id";

switch ($affected_rows) {
    case -1:
		$res['error']=true; 
		$res['message']='that the query has returned an error';
		break;
	case 0:
        $res['error']=true; 
		$res['message']='no records where deleted';
        break;  
    case 1:
       $res['error']=false;  
		$res['message']='great'; 
        break; 
    case 2:
        $res['error']=true;
		 $res['message']='to many row deleted'; 
        break;
}

return $res; 
}  
public function insertRaport($user_id,$user_name,$partener,$month,$ore,$minute,$reviste,$carti,$brosuri,$visite,$studi){
$res=array(); 
//echo $brosuri;  

$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$stmt = $mysql->prepare("INSERT INTO Raport(Username, Partener, Month, Ore, Minute, Brosuri,Studi, Visite, Carti, Reviste) VALUES (?,?,?,?,?,?,?,?,?,?)");  
$stmt->bind_param("sssiiiiiii",$user_name,$partener,$month,$ore,$minute,$brosuri,$studi,$visite,$carti,$reviste);          
$stmt->execute();           
$stmt->store_result();
$num_rows=$stmt->num_rows;	//pt select
$insert_id=$stmt->insert_id;
//Returns the number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query. 
$affected_rows=$stmt->affected_rows; 
//echo "insert :$insert_id Num: $num_rows a: $affected_rows"; 
$stmt->close();  

if($affected_rows==-1) { 
	$res['error']=true;      
	$res['message']='check param';}
	else{
	$res['error']=true;  
	$res['message']='Fail to insert'; 

};
if($affected_rows>0){ 
	$res['error']=false;     
	$res['raport_id']=$insert_id; 
	//echo "bine1";   
} 
return $res;   
}

public function insertRaport2($user_id,$email,$partener,$month,$ore,$minute,$materiale,$vizualizari,$visite,$studi){
$res=array(); 
/* echo $user_id;  
echo $user_name;  
echo $partener;
echo $month;
echo $ore;
echo $minute;
echo $materiale;
echo $vizualizari;
echo $visite;
echo $studi;  
 */
 $mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
//                                              ($user_id,$user_name,$Partener,$Month,$Ore,$Minute,$Materiale,$Vizualizari,$Visite,$Studi);
$stmt = $mysql->prepare("INSERT INTO RaportNew(Email, Partener, Month, Ore, Minute, Materiale,Studi, Visite, Vizualizari) VALUES (?,?,?,?,?,?,?,?,?)");  
$stmt->bind_param("sssiiiiii",$email,$partener,$month,$ore,$minute,$materiale,$studi,$visite,$vizualizari);             
$stmt->execute();             
$stmt->store_result();
$num_rows=$stmt->num_rows;	//pt select
$insert_id=$stmt->insert_id;
//Returns the number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query. 
$affected_rows=$stmt->affected_rows;   
//echo "insert :$insert_id Num: $num_rows a: $affected_rows"; 
$stmt->close();  

if($affected_rows==-1) { 
	$res['error']=true;      
	$res['message']='check param';}  
	else{
	$res['error']=true;  
	$res['message']='Fail to insert'; 

};
if($affected_rows>0){ 
	$res['error']=false;     
	$res['raport_id']=$insert_id; 
	//echo "bine1";     
} 
return $res;   
}




public function getAllRaports($userID,$userName){ 
 
	$name='bog'; 
	$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$stmt = $mysql->prepare("SELECT RaportID,Username,Ore,Partener,Reviste,Visite,Date_FORMAT(Month , '%Y-%m-%d 00:00:00' )as Month,Minute,Brosuri,Carti,Studi FROM Raport  WHERE Username = ? ORDER BY MONTH ASC ");
    $stmt->bind_param("s", $userName);
	$result = $stmt->execute();  
 
$res=$stmt->bind_result($id,$name, $ore,$partener,$reviste,$visite,$month,$minute,$brosuri,$carti,$studi);
$response=array();
if($res=true){
 while($stmt->fetch()){
 $raport=array();
 $raport['id']=$id;
 $raport['month']=$month;
 $raport['username']=$name;
 $raport['ore']=$ore;
 $raport['partener']=$partener;
 $raport['visite']=$visite;
 $raport['reviste']=$reviste;
$raport['minute']=$minute; 
$raport['brosuri']=$brosuri;
$raport['carti']=$carti;
$raport['studi']=$studi;  
// echo $name,$ore,$partener;  
$response[]=$raport;
	}
	 
	
}
return $response;	  
}
public function getSingleRaport($raportID){

	$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$stmt = $mysql->prepare("SELECT RaportId,Username,Ore,Minute,Studi,Partener,Reviste,Visite,Month,Brosuri,Carti FROM Raport WHERE RaportID = ?");
    $stmt->bind_param("s", $raportID);
	$result = $stmt->execute();
	$res=$stmt->bind_result($id,$name, $ore,$minute,$studi,$partener,$reviste,$visite,$month,$brosuri,$carti);
$res2=array();
$res2['error']=true;
 $raport=array();
if($res=true){
 while($stmt->fetch()){
$raport['id']=$id;
 $raport['month']=$month;
 $raport['username']=$name;
 $raport['ore']=$ore;
 $raport['partener']=$partener;
 $raport['visite']=$visite;
 $raport['reviste']=$reviste;
$raport['minute']=$minute;   
$raport['brosuri']=$brosuri;
$raport['carti']=$carti;
	}
	 if($raport!=null) {
	$res2['error']=false;
	$res2['raport']=$raport;}else {
	$res2['error']=true; 
	$res2['message']='imposible to find';}  
	} else{
	$res2['error']=true;
	$res2['message']='db problem';
	}
	return $res2;  
} 
public function createUserRaport($raport_id,$user_id){
echo "tes $raport_id $user_id" ;
$res=array();
$res['error']=true;  
$res['message']='bun'; 
$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$stmt = $mysql->prepare("INSERT INTO  user_raports (user_ID,RaportID) VALUES (?,?) ");
	$stmt->bind_param("ii",$raport_id,$user_id);
	$resE=$stmt->execute();
	//$resA=$stmt->bind_result($id,$userId,$rapID);  
	$stmt->store_result(); //pt a stoca num_row 
	$num_rows = $stmt->num_rows;  
$insert_id=$stmt->insert_id;  
//Returns the number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query. 
$affected_rows=$stmt->affected_rows; 
	//$stmt->fetch();  
	//echo "Id: $id,$userId,$rapID";  
echo " Num: $num_rows a: $affected_rows i: $insert_id";   
 
return $res; 
}
public function isUserAuth($api_key){
$res=array();
$res['error']=true;
$res['id']=2;

$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$stmt = $mysql->prepare("SELECT ID,Username,Email FROM userRaport WHERE api_key = ?");
	$stmt->bind_param("s", $api_key);
	$resE=$stmt->execute();
	$resA=$stmt->bind_result($id,$name,$email);
	$stmt->store_result(); //pt a stoca num_row
	$num_rows = $stmt->num_rows;
	//echo "resE $resE";  
	if($resA){  
	$stmt->fetch(); //pt a aduce rezultatele
	//echo "id: $id,name: $name row: $num_rows";
		//print_r($res); 
		if($num_rows>0){
			$res['id']=$id;
			$res['username']=$name;
			$res['email']=$email;
			//echo $name; 
			$res['error']=false;
			}
	}
return $res; 
}
public function login($email,$password,$username){
	
	//echo  $password_hash;
	$error=array();
	$error['error']=true;
$error['message']='Not reach login fnc';
	$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
	
	
	$stmt = $mysql->prepare("SELECT ID,Name,api_key,Password_hash,Email,Username FROM userRaport WHERE Email = ? or Username = ?");
	$stmt->bind_param("ss", $email,$username);
	$stmt->execute();
	//$stmt->store_result(); 
 $res=$stmt->bind_result($id,$name,$api_key,$password_hash,$email,$username);
	$num_rows = $stmt->num_rows;  
	if($res=true){   
	$stmt->fetch(); 
	$error=array();
 if (PassHash::check_password($password_hash, $password)) {
                // User password is correct
                 
					$error['error']=false;
					$error['api_key']=$api_key;
					$error['name']=$name;
					$error['email']=$email;
					$error['username']=$username;   
				return	$error;
            } else {
				$error['error']=true;
                $error['message']='user password is incorrect';
                
            }	
	//echo  "id $id,name $name,api $api_key pass $password_hash" ;
	} 
	else{
	$error['error']=true;
	$error['message']='cant reach db';
	}
return $error; 
}
public function createUser($username,$name,$password,$email){
			require_once '../include/PassHash.php'; 
 
            // Generating password hash
            $password_hash = PassHash::hash($password);

            // Generating API key  
            $api_key = $this->generateApiKey();   
 
			if(!$this->checkUserExist($email)){
			   
			$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);    
			$stmt = $mysql->prepare("INSERT INTO userRaport(Username,Name, Email, Password_hash, api_key, status) values(?,?, ?, ?, ?, 1)");
 
			//$stmt = $mysql->prepare("INSERT INTO users(Name, Email, Password_hash, api_key, status) values(?, ?, ?, ?, 1)");
                       
		   $stmt->bind_param("sssss",$username, $name, $email, $password_hash, $api_key);

            $result = $stmt->execute();       
   
            $stmt->close();    
			 $error=array();  
			//echo $result; 1  
            if ($result) {
                // User successfully inserted
                $error['message']='USER_CREATED_SUCCESSFULLY';
				$error['api_key']=$api_key;
				return  $error;
            } else {
                // Failed to create user
				 $error['message']='USER_CREATE_FAILED';
                return $error;
            }  
}
	else {
		$error['message']='USER_ALREADY_EXISTED';
		return $error;
}
			 
}

public function getAllRaportsNew($userID,$userName){ 
 
 
	$name='bog';     
	$isDel=0;
	$command='REMOVE';
	$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
	//Date_FORMAT(r.Month , '%Y-%m-%d 00:00:00' )
	$stmt = $mysql->prepare("SELECT r.RaportID, r.Username, r.Ore, r.Partener, r.Reviste, r.Visite, Date_FORMAT(r.Month , '%Y-%m-%d %T' )as Month, r.Minute, r.Brosuri, r.Carti,r.Studi FROM MetaRaport m INNER JOIN Raport r ON r.RaportID = m.RaportID WHERE m.Command != ? AND m.userRaportID = ? ORDER BY r.Month DESC ");        
    $stmt->bind_param("si",$command,$userID);       
	$result = $stmt->execute();  
$res=$stmt->bind_result($id,$name, $ore,$partener,$reviste,$visite,$month,$minute,$brosuri,$carti,$studi);  
$response=array(); 
//echo "bog";  
if($res=true){
 while($stmt->fetch()){
 $raport=array();
 $raport['id']=$id;
 $raport['month']=$month;
 $raport['username']=$name;
 $raport['ore']=$ore;
 $raport['partener']=$partener;
 $raport['visite']=$visite;
 $raport['reviste']=$reviste;
$raport['minute']=$minute; 
$raport['brosuri']=$brosuri;
$raport['carti']=$carti;
$raport['studi']=$studi;  
// echo $name,$ore,$partener;  
$response[]=$raport;
	}
	 
	
}
return $response;	  
}
public function getAllRaportsNew2($userID,$userName){ 
 
 
	$name='bog';     
	$isDel=0;
	$command='REMOVE';
	$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
	//Date_FORMAT(r.Month , '%Y-%m-%d 00:00:00' )
	$stmt = $mysql->prepare("SELECT r.RaportID, r.Email, r.Ore, r.Partener, r.Visite,r.Materiale,r.Vizualizari,Date_FORMAT(r.Month , '%Y-%m-%d %T' )as Month, r.Minute, r.Studi,m.LastUpdate FROM MetaRaport m INNER JOIN RaportNew r ON r.RaportID = m.RaportID WHERE m.Command != ? AND m.userRaportID = ? ORDER BY r.Month DESC ");          
    $stmt->bind_param("si",$command,$userID);         
	$result = $stmt->execute();  
$res=$stmt->bind_result($id,$email, $ore,$partener,$visite,$materiale,$vizualizari,$month,$minute,$studi,$lastUpdate);  
$response=array(); 
//echo "bog";  
if($res=true){
 while($stmt->fetch()){  
 $raport=array();
 $raport['id']=$id;
 $raport['month']=$month;
 $raport['email']=$email;
 $raport['ore']=$ore;
 $raport['partener']=$partener;
 $raport['visite']=$visite;
 $raport['materiale']=$materiale;
$raport['minute']=$minute; 
$raport['vizualizari']=$vizualizari;
$raport['studi']=$studi;
$raport['lastUpdate']=$lastUpdate;  
// echo $name,$ore,$partener;  
$response[]=$raport;   
	}
	 
	
}
return $response;	  
}

public function insertRaportNew2($user_id,$user_name,$partener,$month,$ore,$minute,$materiale,$vizionari,$visite,$studi,$timeUnix){
$res=array();     
echo $user_name; 
$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$stmt = $mysql->prepare("INSERT INTO RaportNew(Username, Partener, Month, Ore, Minute, Brosuri,Studi, Visite, Vizualizari, Materiale,LastUpdate,isDeleted) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssiiiiiiii", $user_name,$partener,$month,$ore,$minute,$studi,$visite,$vizionari,$materiale,$timeUnix,0);  
$stmt->execute(); 
$stmt->store_result();  
$num_rows=$stmt->num_rows;	//pt select
$insert_id=$stmt->insert_id;
//Returns the number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query. 
$affected_rows=$stmt->affected_rows; 
//echo "insert :$insert_id Num: $num_rows a: $affected_rows"; 
$stmt->close();

if($affected_rows==-1) { 
	$res['error']=true;      
	$res['message']='check param';}
	else{
	$res['error']=true;  
	$res['message']='Fail to insert'; 

};
if($affected_rows>0){ 
	$res['error']=false;     
	$res['raport_id']=$insert_id; 
	//echo "bine1";   
} 
return $res;   
}

public function deleteRaportNew2($raport_id,$user_name,$timeUnix){  
$res=array();    
  
$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$stmt = $mysql->prepare("UPDATE  RaportNew set isDeleted=1,LastUpdate=? WHERE RaportID=? and Username=? "); 
$stmt->bind_param("iss",$timeUnix,$raport_id,$user_name); 
$stmt->execute(); 
$stmt->store_result();  
$num_rows=$stmt->num_rows;	//pt select
$insert_id=$stmt->insert_id;
//Returns the number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query. 
$affected_rows=$stmt->affected_rows; 
	//echo "affect: $affected_rows row: $num_rows ins $insert_id";

switch ($affected_rows) {
    case -1:
		$res['error']=true; 
		$res['message']='that the query has returned an error';
		break;
	case 0:
        $res['error']=true; 
		$res['message']='no records where deleted';
        break;  
    case 1:
       $res['error']=false;  
		$res['message']='great'; 
        break; 
    case 2:
        $res['error']=true;
		 $res['message']='to many row deleted'; 
        break;
}

return $res;  
}
public function deleteRaportNew($raport_id,$user_name,$timeUnix){  
$res=array();    
  
$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$stmt = $mysql->prepare("UPDATE  Raport set isDeleted=1,LastUpdate=? WHERE RaportID=? and Username=? "); 
$stmt->bind_param("iss",$timeUnix,$raport_id,$user_name); 
$stmt->execute(); 
$stmt->store_result();  
$num_rows=$stmt->num_rows;	//pt select
$insert_id=$stmt->insert_id;
//Returns the number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query. 
$affected_rows=$stmt->affected_rows; 
	//echo "affect: $affected_rows row: $num_rows ins $insert_id";

switch ($affected_rows) {
    case -1:
		$res['error']=true; 
		$res['message']='that the query has returned an error';
		break;
	case 0:
        $res['error']=true; 
		$res['message']='no records where deleted';
        break;  
    case 1:
       $res['error']=false;  
		$res['message']='great'; 
        break; 
    case 2:
        $res['error']=true;
		 $res['message']='to many row deleted'; 
        break;
}

return $res; 
} 


public function insertRaportNew($user_id,$user_name,$partener,$month,$ore,$minute,$reviste,$carti,$brosuri,$visite,$studi,$timeUnix){
$res=array();   
echo $user_name; 
$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$stmt = $mysql->prepare("INSERT INTO Raport(Username, Partener, Month, Ore, Minute, Brosuri,Studi, Visite, Carti, Reviste,LastUpdate,isDeleted) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssiiiiiiiii", $user_name,$partener,$month,$ore,$minute,$brosuri,$studi,$visite,$carti,$reviste,$timeUnix,0);
$stmt->execute(); 
$stmt->store_result();  
$num_rows=$stmt->num_rows;	//pt select
$insert_id=$stmt->insert_id;
//Returns the number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query. 
$affected_rows=$stmt->affected_rows; 
//echo "insert :$insert_id Num: $num_rows a: $affected_rows"; 
$stmt->close();

if($affected_rows==-1) { 
	$res['error']=true;      
	$res['message']='check param';}
	else{
	$res['error']=true;  
	$res['message']='Fail to insert'; 

};
if($affected_rows>0){ 
	$res['error']=false;     
	$res['raport_id']=$insert_id; 
	//echo "bine1";   
} 
return $res;   
}

public function updateRaportNew($raport_id,$user_name,$Partener,$Month,$Ore,$Min,$Reviste,$Carti,$Brosuri,$Visite,$Studi,$timeUnix){
$res=array();
$res['error']=true; 
$res['message']='test';  
$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
$stmt = $mysql->prepare("UPDATE Raport Set Partener=? ,Month=?,Ore=?,Minute=?,Brosuri=?,Studi=?,Visite=?,Carti=?,Reviste=?,LastUpdate=?,isDeleted=? WHERE RaportID=? and Username=? ");
			  $stmt->bind_param("ssiiiiiiiiiis",$Partener,$Month,$Ore,$Min,$Brosuri,$Studi,$Visite,$Carti,$Reviste,$timeUnix,0,$raport_id,$user_name);    
$stmt->execute(); 
$stmt->store_result();
$affected_rows=$stmt->affected_rows; 
$insert_id=$stmt->insert_id;
$num_rows=$stmt->num_rows;
 
//echo "insert :$insert_id Num: $num_rows a: $affected_rows"; 
switch ($affected_rows) {
    case -1:
		$res['error']=true; 
		$res['message']='that the query has returned an error';
		break;
	case 0:
        $res['error']=false; 
		$res['message']='no records where updated';
        break;   
    case 1:
       $res['error']=false;  
		$res['message']='great'; 
        break; 
    case 2:
        $res['error']=true;
		 $res['message']='to many row update'; 
        break;
}
$stmt->close();
$mysql->close();  
        
return $res;
}
public function insertMetaRaport($raport_id,$user_id,$ip,$command,$lastUpdate,$userAgent,$deviceType,$model){
//echo $response;   
//echo $raport_id;
//echo $ip;   
///echo $command;   
//echo $lastUpdate;          
                
         
$res=array();    
$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
$stmt = $mysql->prepare("INSERT INTO MetaRaport (RaportID,userRaportID, IP,Command,LastUpdate,UserAgent,DeviceType,Model) VALUES (?, ?, ?, ?, ?,?,?,?)");        
$stmt->bind_param("iississs",$raport_id,$user_id,$ip,$command,$lastUpdate,$userAgent,$deviceType,$model);          
$stmt->execute();     
$stmt->store_result();       
$num_rows=$stmt->num_rows;	//pt select
$insert_id=$stmt->insert_id;    
//Returns the number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query. 
$affected_rows=$stmt->affected_rows; 
//echo "insert :$insert_id Num: $num_rows a: $affected_rows"; 
$stmt->close();
//echo $affected_rows; 
  
if($affected_rows==-1) {   
	$res['error']=true;      
	$res['message']='check param';  
}    
 
if($affected_rows>0){      
	$res['error']=false;     
	$res['raport_id']=$insert_id;   
	//echo "bine1";   
} 
return $res;    
}


public function findDevice($device,$user_id){
$response=array(); 
//echo $device;
//echo $user_id;  
//return true;   
 $mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
 $stmt = $mysql->prepare("SELECT RaportUserTokenID,Token FROM RaportUserTokens WHERE UserRaportID=? and Device=?");        
 $stmt->bind_param("is",$user_id,$device);               
 $result = $stmt->execute(); 
 $stmt->store_result();
 $res=$stmt->bind_result($deviceId,$token);        
   
  //echo $stmt->num_rows;
  $num_rows = $stmt->num_rows;
//  	if($num_rows==1){  
// 			  echo $id;
//  			return true;         
//  			} 
//  		else return false; 
$ids=array();
$responseDevice=array();
if($res=true){  
 while($stmt->fetch()){
	 $responseDevice['id']=$deviceId;
	 $responseDevice['token']=$token; 
	 $ids[]=$responseDevice; 
 }} 
 $response['result']=$ids; 	 
$response['nr']=$num_rows;  
return $response;  
}
public function insertDevice($user_id,$model,$os,$token){  
	 
	$res=array();  
	$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
	$stmt = $mysql->prepare("INSERT INTO Devices( Model, UserID, OS,Token) 
	VALUES (?,?,?,?)  on duplicate key 
	update OS=? ,Token=?");        
	$stmt->bind_param("sissss",$model,$user_id,$os,$token,$os,$token);            
	$stmt->execute();       
	$stmt->store_result();           
	$num_rows=$stmt->num_rows;	//pt select
	$insert_id=$stmt->insert_id;  
	//echo $insert_id;  
	//Returns the number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query. 
	$affected_rows=$stmt->affected_rows; 
	//echo "insert :$insert_id Num: $num_rows a: $affected_rows"; 
	$stmt->close();       
	//echo $affected_rows;                
  
  	if($affected_rows==0){
		  $res['error']=false;
		   $res['message']='it;s here';
	  }
	if($affected_rows==-1) {            
		$res['error']=true;      
		$res['message']='check param';  
	}        
	
	if($affected_rows>0){      
		$res['error']=false;     
		$res['insert_id']=$insert_id;   
		//echo "bine1";     
	}
	return $res;   
}

public function getTokens($user_id,$model)
{
    $response=array();  
	$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
	$stmt = $mysql->prepare("SELECT  Token FROM Devices WHERE UserID=? and Model!=?");        
	$stmt->bind_param("is",$user_id,$model);            
	$stmt->execute();     
	$stmt->store_result(); 
	$res=$stmt->bind_result($token);              
	$affected_rows=$stmt->affected_rows;            
	$responseDevice=array();
		if($res=true){  
			while($stmt->fetch()){
				$ids[]=$token; 
			}
		} 
  	$response['tokens']=$ids;
  	$stmt->close();  
  return $response;  
}
public function insertToken($user_id,$device,$os,$token)
{	
// echo $user_id;
// echo $device;
// echo $os;
// echo $token;
	$res=array();  
$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
$stmt = $mysql->prepare("INSERT INTO RaportUserTokens(UserRaportID, Device, OS, Token) VALUES (?,?,?,?)");        
$stmt->bind_param("isss",$user_id,$device,$os,$token);          
$stmt->execute();     
$stmt->store_result();         
$num_rows=$stmt->num_rows;	//pt select
$insert_id=$stmt->insert_id;  
//echo $insert_id;  
//Returns the number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query. 
$affected_rows=$stmt->affected_rows; 
//echo "insert :$insert_id Num: $num_rows a: $affected_rows"; 
$stmt->close();
//echo $affected_rows;   
  
if($affected_rows==-1) {     
	$res['error']=true;      
	$res['message']='check param';  
}        
 
if($affected_rows>0){      
	$res['error']=false;     
	$res['insert_id']=$insert_id;   
	//echo "bine1";     
}
return $res; 
}
public function updateToken($user_id,$device,$os,$token)
{	
// echo $user_id;
// echo $device;
// echo $os;
// echo $token;
	$res=array();    
$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
$stmt = $mysql->prepare("UPDATE RaportUserTokens SET OS=?, Token=? WHERE UserRaportID=? and Device=?");        
$stmt->bind_param("ssis",$os,$token,$user_id,$device);          
$stmt->execute();       
$stmt->store_result();         
$num_rows=$stmt->num_rows;	//pt select
$insert_id=$stmt->insert_id;  
//echo $insert_id;  
//Returns the number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query. 
$affected_rows=$stmt->affected_rows; 
//echo "insert :$insert_id Num: $num_rows a: $affected_rows"; 
$stmt->close();
//echo $affected_rows;   
  
if($affected_rows==-1) {         
	$res['error']=true;      
	$res['message']='check param';  
}    
 
if($affected_rows>0){          
	$res['error']=false;     
	$res['affected_rows']=$affected_rows;     
	//echo "bine1";   
}
return $res; 
}
private function checkUserExist($email){
	$mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$stmt = $mysql->prepare("SELECT Name, Email FROM userRaport WHERE Email = ?");
    $stmt->bind_param("s", $email);
	$result = $stmt->execute();
	$stmt->store_result();
	$num_rows = $stmt->num_rows;
	if($num_rows==0){  
			return false;           
			}   
		else return true; 	  
}
public function getAllQuiz(){
  $mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$stmt = $mysql->prepare("SELECT ID, Question, answer, Vers, Level, Points FROM Quiz Order by Level asc"); 
	$result = $stmt->execute();
 
$res=$stmt->bind_result($id,$question, $answer,$vers,$level,$points);
$response=array();
if($res=true){
		 while($stmt->fetch()){
		 $raport=array();
		 $raport['id']=$id;
		 $raport['Question']=$question;
		 $raport['Answer']=$answer;
		 $raport['Vers']=$vers;
		 $raport['Level']=$level;
		 $raport['Points']=$points;
		 $response[]=$raport;
		}
	}
return $response;	  
  }
 
 public function getChangesSince($user_id,$timeUnix){
 //$command='DELETE';
 $mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$stmt = $mysql->prepare("SELECT r.RaportID, r.Username, r.Ore, r.Partener, r.Reviste, r.Visite,Date_FORMAT(r.Month , '%Y-%m-%d 00:00:00' ) as Month, r.Minute, r.Brosuri, r.Carti ,m.Command ,m.LastUpdate FROM MetaRaport m INNER JOIN Raport r ON r.RaportID = m.RaportID WHERE  m.userRaportID = ? AND m.LastUpdate>? ORDER BY r.Month DESC "); 
$stmt->bind_param("ii",$user_id,$timeUnix);     
$result = $stmt->execute(); 
$res=$stmt->bind_result($id,$name, $ore,$partener,$reviste,$visite,$month,$minute,$brosuri,$carti,$command,$lastUpdate);
$response=array();
if($res=true){
 while($stmt->fetch()){  
 $raport=array();
 $raport['id']=$id;
 $raport['month']=$month;
 $raport['username']=$name;
 $raport['ore']=$ore;
 $raport['partener']=$partener;
 $raport['visite']=$visite;
 $raport['reviste']=$reviste;
$raport['minute']=$minute; 
$raport['brosuri']=$brosuri;
$raport['carti']=$carti;
$raport['lastUpdate']=$lastUpdate;    
$raport['command']=$command;
// echo $name,$ore,$partener;    
$response[]=$raport;  
	} 
	 
	  
}
return $response;
 
 }
  public function getChangesSince2($user_id,$timeUnix){
 //$command='DELETE';
 $mysql=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$stmt = $mysql->prepare("SELECT r.RaportID, r.Username, r.Ore, r.Partener, r.Materiale, r.Visite,Date_FORMAT(r.Month , '%Y-%m-%d 00:00:00' ) as Month, r.Minute, r.Vizualizari,m.Command ,m.LastUpdate FROM MetaRaport m INNER JOIN RaportNew r ON r.RaportID = m.RaportID WHERE  m.userRaportID = ? AND m.LastUpdate>? ORDER BY r.Month DESC "); 
$stmt->bind_param("ii",$user_id,$timeUnix);       
$result = $stmt->execute(); 
$res=$stmt->bind_result($id,$name, $ore,$partener,$materiale,$visite,$month,$minute,$vizualizari,$command,$lastUpdate); 
$response=array();
if($res=true){
 while($stmt->fetch()){  
 $raport=array();  
 $raport['id']=$id;
 $raport['month']=$month;    
 $raport['ore']=$ore;
 $raport['partener']=$partener;
 $raport['visite']=$visite;
 $raport['materiale']=$materiale;
$raport['minute']=$minute; 
$raport['vizualizari']=$vizualizari; 
$raport['lastUpdate']=$lastUpdate;    
$raport['command']=$command;
// echo $name,$ore,$partener;      
$response[]=$raport;  
	} 
	 
	  
}
return $response;
 
 }
 
 
    /**
     * Generating random Unique MD5 String for user Api key
     */
    private function generateApiKey() {
        return md5(uniqid(rand(), true)); 
    }   

}
	

?>