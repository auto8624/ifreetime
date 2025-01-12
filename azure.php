<?php
$curl = curl_init();
$text = $_GET['text'];
$voiceName = $_GET['voiceName'];
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:3000/api/azure',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>' 
 <speak xmlns="http://www.w3.org/2001/10/synthesis" xmlns:mstts="http://www.w3.org/2001/mstts" xmlns:emo="http://www.w3.org/2009/10/emotionml" version="1.0" xml:lang="zh-CN">
    <voice name="' . $voiceName . '">
        <lexicon uri="https://github.com/iranee/ifreetime/raw/main/lexicon.xml"/>
            <mstts:express-as style="general" styledegree="1.0">
            <prosody rate="0%" pitch="0%">' . $text . '</prosody>
        </mstts:express-as>
    </voice>
</speak>',
  CURLOPT_HTTPHEADER => array(
    'FORMAT: audio-24khz-48kbitrate-mono-mp3',
    'Content-Type: audio/mp3;codec=opus'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
