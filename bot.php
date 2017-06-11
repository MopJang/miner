<?php
$access_token = 'C7IiFfFdabUmN+u+0jjzCfpgHpuEnqn5VYGKP4nuZVF4NYhKSzvcr3vJFjWOYny2QSx5wwlrvL+ayiaAPrh7Fw7WXHr53DGQEK6ed84xM+KgK4//YizknTrTv4tu0owQ0k8LMdnHPCn3rWcwXnu/aAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;