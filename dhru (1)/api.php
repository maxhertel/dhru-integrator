<?php
/**
 * DHRU Fusion api standards V6.1
 */

session_name("DHRUFUSION");
session_set_cookie_params(0, "/", null, false, true);
session_start();
error_reporting(0);
$apiversion = '6.1';
foreach ($_POST as $k => $v) {
    if ($k == 'parameters') {
        ${$k} = $v; // Asignar el valor sin filtrar
    } else {
        ${$k} = filter_var($v, FILTER_SANITIZE_STRING);
    }
   
}

$apiresults = array();
if ($parameters){
    $parameters = json_decode(json_encode(simplexml_load_string($parameters)),TRUE);
}

if ($User = validateAuth($username, $apiaccesskey)) {
    $con = mysqli_connect('localhost', 'u126464773_dhru', 'Shetouane123', 'u126464773_dhru');
    $check_serv = mysqli_query($con, "SELECT * FROM `apiservices` WHERE `status`= '1'");
    switch ($action) {
        
        case "accountinfo":
            $AccountInfo['credit'] = $User['credit'];
            $AccountInfo['mail'] = $User['email'];
            $AccountInfo['currency'] = 'USD'; /* Currency code */
            $apiresults['SUCCESS'][] = array('message' => 'Your Account Info', 'AccountInfo' => $AccountInfo);
            break;

        case "imeiservicelist":
            $ServiceList = NULL;
            $Group = 'Bypass Tool';
            $ServiceList[$Group]['GROUPNAME'] = $Group;
            $ServiceList[$Group]['GROUPTYPE'] = 'IMEI'; // IMEI OR SERVER OR REMOTE

            while($serv = mysqli_fetch_assoc($check_serv))
            {
                {
                    $SERVICEID = $serv['id'];
                    $ServiceList[$Group]['GROUPTYPE'] = 'IMEI';  //IMEI OR SERVER
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['SERVICEID'] = $SERVICEID;
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['SERVICETYPE'] = 'IMEI'; // IMEI OR SERVER OR REMOTE
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['SERVICENAME'] = $serv['services'];
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['CREDIT'] = $serv['price'];
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['INFO'] = utf8_encode($serv['info']);
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['TIME'] = 'Instant';
                    
                    /* Other Fields if required only */
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['Requires.Network'] = 'None';
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['Requires.Mobile'] = 'None';
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['Requires.Provider'] = 'None';
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['Requires.PIN'] = 'None';
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['Requires.KBH'] = 'None';
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['Requires.MEP'] = 'None';
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['Requires.PRD'] = 'None';
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['Requires.Type'] = 'None';
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['Requires.Reference'] = 'None';
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['Requires.Locks'] = 'None';
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['Requires.SN'] = 'None';
                    $ServiceList[$Group]['SERVICES'][$SERVICEID]['Requires.SecRO'] = 'None';
                }
            }
            $apiresults['SUCCESS'][] = array('MESSAGE' => 'IMEI Service List', 'LIST' => $ServiceList);
            break;

        case "placeimeiorder":
            $ServiceId = $parameters["ID"];
            $imei = $parameters["IMEI"];
            $CustomField = json_decode(base64_decode($parameters['customfield']), true);
            
            $check_ordr = mysqli_query($con, "SELECT * FROM `apiservices` WHERE `id`= '$ServiceId'");
            $result = mysqli_fetch_array($check_ordr);
            $user_data = $User['username'];
            $api = $result['link'];
            $name = $result['services'];
            $price = $result['price'];
            if ($User['credit'] > $result['price']) {
                $check_his = mysqli_query($con, "SELECT * FROM `apiorders` WHERE `imei`= '$imei'");
			    if(mysqli_num_rows($check_his) < 1)
			    {
			        $url = $api."".$imei;
					$ch = curl_init(); 
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
					curl_setopt($ch, CURLOPT_TIMEOUT,10);
					$output = curl_exec($ch);
					curl_close($ch);
					if(preg_match("/successfully/i", $output) || preg_match("/already/i", $output))
					{
						$output = "Order Successfully";
					}
					$cut = mysqli_query($con, "UPDATE `apiusers` SET `credit`= (`credit` - '$price') WHERE `username` = '$user_data'");
			    }
			    else
			    {
			        $check_tool = mysqli_fetch_array($check_his);
				    $history = $check_tool['services'];
				    if($history == $name)
				    {
				        $output = "Reject";
				    }
				    else
				    {
				        $url = $api."".$imei;
						$ch = curl_init(); 
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
						curl_setopt($ch, CURLOPT_TIMEOUT,10);
						$output = curl_exec($ch);
						curl_close($ch);
						if(preg_match("/successfully/i", $output) || preg_match("/already/i", $output))
						{
							$output = "Order Successfully";
						}
						$cut = mysqli_query($con, "UPDATE `apiusers` SET `credit`= (`credit` - '$price') WHERE `username` = '$user_data'");
				    }
				    
			    }
			    $add = mysqli_query($con, "INSERT INTO `apiorders`(`services`, `imei`, `reply`, `price`, `username`) VALUES ('$name', '$imei','$output','$price','$user_data')");
			    $order_reff_id = rand(1111, 9999);
				$apiresults['SUCCESS'][] = array('MESSAGE' => 'Order received', 'REFERENCEID' => $order_reff_id);
            }
            else {
			    $apiresults['ERROR'][] = array('MESSAGE' => 'Not enough credits');
			}
            break;

        case "getimeiorder":
            $OrderID = (int)$parameters['ID'];
            $check = mysqli_query($con, "SELECT * FROM `apiorders` ORDER BY `id` DESC LIMIT 1");
            $get_code = mysqli_fetch_array($check);
            $code = $get_code['reply'];
            if(preg_match("/error/i", $code))
            {
                $apiresults['SUCCESS'][] = array(
                'STATUS' => 3, /* 0 - New , 1 - InProcess, 3 - Reject(Refund), 4- Available(Success)  */
                'CODE' => "API Connection Error");
            }
			else if(preg_match("/reject/i", $code))
			{
				$apiresults['SUCCESS'][] = array(
                'STATUS' => 3, /* 0 - New , 1 - InProcess, 3 - Reject(Refund), 4- Available(Success)  */
                'CODE' => "Duplicate Orders");
			}
            else
            {
                $apiresults['SUCCESS'][] = array(
                'STATUS' => 4, /* 0 - New , 1 - InProcess, 3 - Reject(Refund), 4- Available(Success)  */
                'CODE' => $code);
            }
            break; 
            
        default:
            $apiresults['ERROR'][] = array('MESSAGE' => 'Invalid Action');
    }
} else {
    $apiresults['ERROR'][] = array('MESSAGE' => 'Authentication Failed');
}

function validateAuth($username, $apiaccesskey)
{
    $var = array('status'=>'false');
    $con = mysqli_connect('localhost', 'u126464773_dhru', 'Shetouane123', 'u126464773_dhru');
    $check_user = mysqli_query($con, "SELECT * FROM `apiusers` WHERE `username` = '$username'");
    if(mysqli_num_rows($check_user) > 0)
    {
        $data = mysqli_fetch_array($check_user);
        $email = $data['email'];
        $balance = $data['credit'];
        if($data['apiaccess'] == $apiaccesskey)
        {
            $var = array('status'=>'true','username'=>$username,'email'=>$email,'credit'=>$balance);
        }
    }
    return $var;
}

if (count($apiresults)) {
    header("X-Powered-By: DHRU-FUSION");
    header("dhru-fusion-api-version: $apiversion");
    header_remove('pragma');
    header_remove('server');
    header_remove('transfer-encoding');
    header_remove('cache-control');
    header_remove('expires');
    header('Content-Type: application/json; charset=utf-8');
    $apiresults['apiversion'] = $apiversion;
    exit(json_encode($apiresults));
}