<?php
$access_token = 'C7IiFfFdabUmN+u+0jjzCfpgHpuEnqn5VYGKP4nuZVF4NYhKSzvcr3vJFjWOYny2QSx5wwlrvL+ayiaAPrh7Fw7WXHr53DGQEK6ed84xM+KgK4//YizknTrTv4tu0owQ0k8LMdnHPCn3rWcwXnu/aAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['text'] == 'ตัง') {
			
			$json = file_get_contents("https://etc.ethermine.org/api/miner_new/796c1e1e32169b906139d4fb18ba5ab1bec796c9");
			$jsonde = json_decode($json, true);
			
			$unpaid = $jsonde['unpaid'];
			$address = $jsonde['address'];
			$unpaid = $unpaid / 1000000000000000000 ;
			
			$text1 = "ยอดเงินล่าสุดของคุณมี : number_format($unpaid, 5, '.', '')";
			$text2 = "หมายเลขกระเป๋า : $address";
			$text = $text1 $text2;
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
