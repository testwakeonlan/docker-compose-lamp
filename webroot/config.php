<?php
/*

The configuration file contains all the parameters to configure the WOL app

*/

$sitename = "WOL";

// UDP port to open socket. Usually it's port 9
$port = 9;

// Your network broadcast address
$networkbroadcast = "192.168.168.255";

/* 
  A list of MAC addresses
  The allowed chars are: A-F a-f 0-9 . : -
  So, this list can be in the form:
   Windows: 00-1e-8C-5B-C8-28
   Unix:    00:1E:8C:5B:C8:29
   Cisco:   001E.8C5B.C827
   Simple:  001E8C5bc826

*/
$c=0;
$m=0;
$d=0;
$maclist=[];
$nomi=[];
$addr=[];
$file=fopen("listapc.csv","r");
$csv=fgetcsv($file);
$max=count($csv);
foreach ($csv as $ne => $info)  {

if ($c & 1)
{
$addr[$d]=$info;
$d++;
}
else
{
  $nomi[$m]=$info;
  $m++;
}
$c++;}
$dollaro=count($nomi);
for($j=0;$j<$dollaro;$j++)
{
  $ciao=$nomi[$j];
  $maclist[$ciao]=$addr[$j];
}
//print_r((string)$addr[0]);
/*
$maclist = [
	"cane" => "00.22.15.46.C2.3B",
	"MacBook Ethernet" => "00.2332.b778.90",
	"MacBook Wifi" => "00:23:12:54:6c:53",
	"Fiel"   => "001E.8C5B.C827",
	"Serra"  => "001E8C5bc826",
];
*/
?>