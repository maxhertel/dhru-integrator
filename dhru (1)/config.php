<?php
session_start();

$alert = "";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Get Country From IP address
function getCountry($ip)
{
	$get = file_get_contents("http://ip-api.com/json/".$ip);	
	return $get;
}

//Get Api Access key
function generate_license($suffix = null) {
    // Set default number of segments and segment characters
    $num_segments = 5;
    $segment_chars = 3;

    // Tokens used for license generation (ambiguous characters removed)
    $tokens = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

    // Initialize license string
    $license_string = '';

    // Build default license string
    for ($i = 0; $i < $num_segments; $i++) {
        $segment = '';
        for ($j = 0; $j < $segment_chars; $j++) {
            $segment .= $tokens[rand(0, strlen($tokens) - 1)];
        }
        $license_string .= $segment;

        // Add separator unless at the last segment
        if ($i < ($num_segments - 1)) {
            $license_string .= '-';
        }
    }

    // Handle optional suffix
    if (isset($suffix)) {
        if (is_numeric($suffix)) {
            $license_string .= '-' . strtoupper(base_convert($suffix, 10, 36));
        } else {
            $long = sprintf("%u", ip2long($suffix), true);
            if ($suffix === long2ip($long)) {
                $license_string .= '-' . strtoupper(base_convert($long, 10, 36));
            } else {
                $license_string .= '-' . strtoupper(str_ireplace(' ', '-', $suffix));
            }
        }
    }

    // Generate alphanumeric checksum and append it to the license string
    $checksum = strtoupper(base_convert(md5($license_string), 16, 36));

    // Adjust the length of the checksum to match segment_chars
    $checksum = substr($checksum, 0, $segment_chars);

    $license_string .= '-' . $checksum;

    return $license_string;
}

$address = $_SERVER['REMOTE_ADDR'];

if (isset($_POST['signin']))
{
	$username = $_POST['login-username'];
	$password = $_POST['login-password'];
	
	$check_username = mysqli_query($con, "SELECT * FROM `apiusers` WHERE `username` = '$username'");
	if(mysqli_num_rows($check_username) > 0)
	{
		$check_pass = mysqli_fetch_array($check_username);
		$fix_pass = $check_pass['password'];
		if($fix_pass == base64_encode($password))
		{
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			header('location: main.php');
		}
		else
		{
			$alert = "One.helpers('jq-notify', {align: 'center', message: 'Please check your password!'});";
		}
	}
	else
	{
		$alert = "One.helpers('jq-notify', {align: 'center', message: 'Please check your username!'});";
	}
}
if (isset($_POST['signup']))
{
	$username = $_POST['signup-username'];
	$email = $_POST['signup-email'];
	$password = $_POST['signup-password'];
	$cpassword = $_POST['signup-password-confirm'];
	
	$check_username = mysqli_query($con, "SELECT * FROM `apiusers` WHERE `username` = '$username'");
	if(mysqli_num_rows($check_username) > 0)
	{
		$alert = "One.helpers('jq-notify', {align: 'center', message: 'Username already exist!'});";
	}
	else
	{
		$check_email = mysqli_query($con, "SELECT * FROM `apiusers` WHERE `email` = '$email'");
		if(mysqli_num_rows($check_email) > 0)
		{
			$alert = "One.helpers('jq-notify', {align: 'center', message: 'Email already exist!'});";
		}
		else
		{
			$getkey = generate_license();
			$data = json_decode(getCountry($address));
			$country = $data->country;
			$pass_fix = base64_encode($password);
			$insert = mysqli_query($con, "INSERT INTO `apiusers`(`username`, `email`, `password`, `apiaccess`, `country`, `ip`) VALUES ('$username','$email','$pass_fix','$getkey','$country','$address')");
			if($insert)
			{
				$alert = "One.helpers('jq-notify', {type: 'success', align: 'center', message: 'Account Successfully Registered'});";
			}
			else
			{
				$alert = "One.helpers('jq-notify', {align: 'center', message: 'Database error!'});";
			}
		}
	}
	
}
if (isset($_POST['service-add']))
{
	$name = $_POST['service-name'];
	$price = $_POST['service-price'];
	$api = $_POST['service-api'];
	$info = $_POST['service-info'];
	
	$add = mysqli_query($con, "INSERT INTO `apiservices`(`services`, `info`, `price`, `link`) VALUES ('$name','$info','$price','$api')");
	if($add)
	{
		$alert = "One.helpers('jq-notify', {type: 'success', align: 'center', message: 'Services Successfully Added'});";
	}
	else
	{
		$alert = "One.helpers('jq-notify', {align: 'center', message: 'Database error!'});";
	}
}
if (isset($_POST['user-update']))
{
	$balance = $_POST['user-balance'];
	$id = $_GET['id'];
	
	$update = mysqli_query($con, "UPDATE `apiusers` SET `credit` = '$balance' WHERE `id` = '$id'");
	if($update)
	{
		$alert = "One.helpers('jq-notify', {type: 'success', align: 'center', message: 'Users Successfully Updated'});";
	}
	else
	{
		$alert = "One.helpers('jq-notify', {align: 'center', message: 'Database error!'});";
	}
}
if (isset($_POST['user-delete']))
{
	$id = $_GET['id'];
	
	$check = mysqli_query($con, "SELECT * FROM `apiusers` WHERE `id` = '$id'");
	$check_admin = mysqli_fetch_array($check);
	if($check_admin['level'] == 1)
	{
		$alert = "One.helpers('jq-notify', {align: 'center', message: 'Admin Cant Deleted!'});";
	}
	else
	{
		$delete = mysqli_query($con, "DELETE FROM `apiusers` WHERE `id` = '$id'");
		if($delete)
		{
			$alert = "One.helpers('jq-notify', {type: 'success', align: 'center', message: 'Users Successfully Deleted'});";
		}
		else
		{
			$alert = "One.helpers('jq-notify', {align: 'center', message: 'Database error!'});";
		}
	}
}
if (isset($_POST['order-delete']))
{
	$id = $_GET['id'];
	
	$delete = mysqli_query($con, "DELETE FROM `apiorders` WHERE `id` = '$id'");
	if($delete)
	{
		$alert = "One.helpers('jq-notify', {type: 'success', align: 'center', message: 'Orders Successfully Deleted'});";
	}
	else
	{
		$alert = "One.helpers('jq-notify', {align: 'center', message: 'Database error!'});";
	}
}
if (isset($_POST['service-update']))
{
	$name = $_POST['service-name'];
	$price = $_POST['service-price'];
	$api = $_POST['service-api'];
	$status = $_POST['service-status'];
	$id = $_GET['id'];
	
	if(strtolower($status) == "actived")
	{
		$status = "1";
	}
	else
	{
		$status = "0";
	}
	$update = mysqli_query($con, "UPDATE `apiservices` SET `services` = '$name', `price` = '$price', `status` = '$status', `link` = '$api' WHERE `id` = '$id'");
	if($update)
	{
		$alert = "One.helpers('jq-notify', {type: 'success', align: 'center', message: 'Services Successfully Updated'});";
	}
	else
	{
		$alert = "One.helpers('jq-notify', {align: 'center', message: 'Database error!'});";
	}
}
if (isset($_POST['service-delete']))
{
	$id = $_GET['id'];
	
	$delete = mysqli_query($con, "DELETE FROM `apiservices` WHERE `id` = '$id'");
	if($delete)
	{
		$alert = "One.helpers('jq-notify', {type: 'success', align: 'center', message: 'Services Successfully Deleted'});";
	}
	else
	{
		$alert = "One.helpers('jq-notify', {align: 'center', message: 'Database error!'});";
	}
}
if (isset($_POST['update-api']))
{
	$update_key = generate_license();
	$id = $_GET['id'];
	
	$update = mysqli_query($con, "UPDATE `apiusers` SET `apiaccess` = '$update_key' WHERE `id` = '$id'");
	if($update)
	{
		$alert = "One.helpers('jq-notify', {type: 'success', align: 'center', message: 'API Key Successfully Updated'});";
	}
	else
	{
		$alert = "One.helpers('jq-notify', {align: 'center', message: 'Database error!'});";
	}
}
if (isset($_POST['forgot-pass']))
{
	$data = $_POST['reminder-credential'];
	$check_user = mysqli_query($con, "SELECT * FROM `apiusers` WHERE `username` = '$data'");
	if(mysqli_num_rows($check_user) > 0)
	{
		$check = mysqli_fetch_array($check_user);
		$email = $check['email'];
		$pass = base64_decode($check['password']);
		
		$message = "<html>
					<body>
					<p>Hi</p>
					<p>Thanks for join with One Server</p>
					<p>This your account details</p>
					<br />
					<p>Username : $data</p>
					<p>Email : $email</p>
					<p>Password : $pass</p>
					<br />
					<p>Dont share this to other people</p>
					<br />
					<p>This message was generated automatically. Dont reply this message</p>
		            <p>Copyright © One Server 2022</p>
					</body>
					</html>";
    	$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Mailer = "smtp";

    	$mail->SMTPDebug  = 0;  
    	$mail->SMTPAuth   = TRUE;
    	$mail->SMTPSecure = "ssl";
    	$mail->Port       = 465;
	    $mail->Host       = "smtp.gmail.com";
	    $mail->Username   = "grsunlock@gmail.com";
	    $mail->Password   = "anrlrefwceyyzxhr";

	    $mail->IsHTML(true);
		$mail->AddAddress($email, "One-Reseller");
		$mail->SetFrom("No-Reply@oneserver.my.id", "One Server No-Reply");
		$mail->AddReplyTo("No-Reply@oneserver.my.id", "One Server No-Reply");
		$mail->Subject = "User Account Info";
		$content = $message;
		$mail->MsgHTML($content); 
              
		if(!$mail->Send()) {
			$alert = "One.helpers('jq-notify', {align: 'center', message: 'SMTP error!'});";
		} else {
  			$alert = "One.helpers('jq-notify', {type: 'success', align: 'center', message: 'We send your account info to your email'});";
		}
	}
	else
	{
		$check_user = mysqli_query($con, "SELECT * FROM `apiusers` WHERE `email` = '$data'");
		if(mysqli_num_rows($check_user) > 0)
		{
			$check = mysqli_fetch_array($check_user);
			$username = $check['username'];
			$pass = base64_decode($check['password']);
			
			$message = "<html>
					<body>
					<p>Hi</p>
					<p>Thanks for join with One Server</p>
					<p>This your account details</p>
					<br />
					<p>Username : $username</p>
					<p>Email : $data</p>
					<p>Password : $pass</p>
					<br />
					<p>Dont share this to other people</p>
					<br />
					<p>This message was generated automatically. Dont reply this message</p>
		            <p>Copyright © One Server 2022</p>
					</body>
					</html>";
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Mailer = "smtp";

			$mail->SMTPDebug  = 0;  
			$mail->SMTPAuth   = TRUE;
			$mail->SMTPSecure = "ssl";
			$mail->Port       = 465;
			$mail->Host       = "smtp.gmail.com";
			$mail->Username   = "on3server@gmail.com";
			$mail->Password   = "anrlrefwceyyzxhr";

			$mail->IsHTML(true);
			$mail->AddAddress($data, "One-Reseller");
			$mail->SetFrom("No-Reply@oneserver.my.id", "One Server No-Reply");
			$mail->AddReplyTo("No-Reply@oneserver.my.id", "One Server No-Reply");
			$mail->Subject = "User Account Info";
			$content = $message;
			$mail->MsgHTML($content); 
              
			if(!$mail->Send()) {
				$alert = "One.helpers('jq-notify', {align: 'center', message: 'SMTP error!'});";
			} else {
				$alert = "One.helpers('jq-notify', {type: 'success', align: 'center', message: 'We send your account info to your email'});";
			}
		}
		else
		{
			$alert = "One.helpers('jq-notify', {align: 'center', message: 'Username or Email not found!'});";
		}
	}
}
?>
