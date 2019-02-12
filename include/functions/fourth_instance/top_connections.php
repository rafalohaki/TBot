<?php 
function top_connections()
{
	global $config;
	global $tsAdmin;
	global $connect;
	global $footer;
	global $language;
	$number = 1;
	$data ="[hr]";
	$question = "Select nickname, connections, online FROM user_stats ORDER BY connections DESC limit ".$config['function']['top_connections']['count'];
	$toptime = mysqli_query($connect, $question);	
				
				while($top = mysqli_fetch_array($toptime))
				{
					switch($top['online'])
					{
						case 1: $status = "[color=green]Online[/color]"; 
						break;
						case 0: $status = "[color=red]Offline[/color]"; 
						break;
					}
					$data1 = time();
					$data2 = time() - $top['connections'];
					$difference = $data1 - $data2;
					$m = floor($difference / 60);
					$h = floor($m/60);
					$m = $m-($h*60);
					$d = floor($h/24);
					$h = $h-($d*24);
					$data .= "[size=12][b]".$number.". ".$top['nickname']."[/b][/size]\n [img]https://www.iconfinder.com/icons/2672732/download/png/20[/img]  [size=11][b]".$language['top_connections']['connections'].": ".$top['connections']."\n[img]https://www.iconfinder.com/icons/2672790/download/png/20[/img] Status: ".$status."[hr][/b][/size]";
					$number++;
				}
				$tsAdmin->channelEdit($config['function']['top_connections']['channel'], array(
				'channel_description' => $data.$footer, 
				));
	
}
?>