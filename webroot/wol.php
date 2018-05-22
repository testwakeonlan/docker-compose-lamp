<?php 

flush();
include 'config.php';
 
function WakeOnLan($addr, $mac, $socket_number){

	if (strlen($mac) != 17)
		return FALSE;

	if (preg_match('/[^A-Fa-f0-9:]/',$mac)) 
		return FALSE;

	$addr_byte = explode(':', $mac);
	$hw_addr   = '';
	
	for ($a=0; $a <6; $a++) 
		$hw_addr .= chr(hexdec($addr_byte[$a]));
	
	$msg = chr(255).chr(255).chr(255).chr(255).chr(255).chr(255);
	
	for ($a = 1; $a <= 16; $a++) 
		$msg .= $hw_addr;
	
	$s = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
	
	if ($s == FALSE) {
		echo "<div class=\"messageNOK\">Can't create socket!</div>\n";
		echo "Error: '".socket_last_error($s)."' - " . socket_strerror(socket_last_error($s));
		return FALSE;
	} 
	else {
		$opt_ret = socket_set_option($s, SOL_SOCKET, SO_BROADCAST, TRUE);
	
		if ($opt_ret < 0) {
			echo "setsockopt() failed, error: " . strerror($opt_ret) . "<br />\n";
			return FALSE;
		}
	
		if (socket_sendto($s, $msg, strlen($msg), 0, $addr, $socket_number)) {
			$content = bin2hex($msg);
			echo "<hr />\n";
			echo "<div class=\"messageOK\">Magic Packet Sent!</div>\n";
			echo "<b>Port:</b> ".$socket_number." <b>MAC:</b> ".$_GET['wake_machine']." <b>Data:</b>\n";
			echo "<textarea readonly class=\"textarea\" name=\"content\" >".$content."</textarea><br />\n";
			socket_close($s);
			return TRUE;
		}
		else {
			echo "<div class=\"messageNOK\">Magic Packet failed to send!</div>\n";
			return FALSE;
		} 
	}
}
 
function PopulateMACList($maclist) {

	foreach ($maclist as $host => $mac) 
		if (!preg_match('/[^A-Fa-f0-9\.-:]/',$mac)) {
			$mac=preg_replace('/[^A-Fa-f0-9]/', "",$mac);
			$mac=join(":",str_split($mac,2));
			if (strlen($mac) == 17) {
				echo "<option value=\"".$mac."\">".$host."</option>\n";
			}
		}
}

?>
