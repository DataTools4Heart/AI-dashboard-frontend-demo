<?php

$conf = [];

if (($F = fopen($GLOBALS['flapi_credentials'], "r")) !== FALSE) {
    while (($data = fgetcsv($F, 1000, ";")) !== FALSE) {
	    foreach ($data as $a){
        	$r = explode(":",$a);
            if (isset($r[1])){
                array_push($conf,$r[1]);
            }
	    }
    }
    fclose($F);
}
#Get Token
$GLOBALS['FLToken'] = flAPIToken($conf[0], $conf[1], $conf[2], $conf[3])['access_token'];


function doGet($url, $oauthToken='') {
    $fullURL = $GLOBALS['FLAPIPrefix']."/$url";
    if ($oauthToken) {
        $headers = [
            'Authorization: Bearer '. $oauthToken,
            'Accept: application/json'
        ];
        $context = stream_context_create([
            'http' => [
              'header' => $headers
            ]
        ]);
    } else {
        $context = Null;
    }
    return json_decode(file_get_contents($fullURL, false, $context), $assoc=True);
}

function doPost($url, $contents, $method="POST", $oauthToken='') {
    $fullURL = $GLOBALS['FLAPIPrefix']."/$url";
    $headers = ['Content-type: application/x-www-form-urlencoded'];
    if ($oauthToken) {
        $headers[] = 'Authorization: Bearer '. $oauthToken;
        $headers[] = 'Accept: application/json';
    }
    $options = [
        'http' => [
          'header'  => $headers,
          'method'  => $method,
          'content' => http_build_query($contents)
        ]
      ];
      $context  = stream_context_create($options);
      $resp = file_get_contents($fullURL, false, $context);
    return json_decode($resp, $assoc=True);
}
// API endpoints
function flAPIToken($username, $password, $client_id, $client_secret) { // Possibly use token from keycloak
    $data = [
        'grant_type' => 'password',
        'username' => $username,
        'password' => $password,
        'client_id' => $client_id,
        'client_secret' => $client_secret
    ];
    return doPost('token', $data);
}

function getToolList($oauthToken='') {
    return doGet('tools', $oauthToken);
}

function getTool($toolId, $oauthToken='') {
    return doGet('tools/$toolId', $oauthToken);
}

function getTaskList($oauthToken='') {
    return doGet('tasks', $oauthToken);
}

function getJob($toolName, $oauthToken='') {
    return doGet('job/$toolName', $oauthToken);
}

function getHostsList($oauthToken='') {
    return doGet('hosts', $oauthToken);
}

function getHostHealth($nodes, $oauthToken='') {
    foreach ($node as $nodes) {
        $query .= 'nodes='.$node;
    }
    return doGet('hosts/health/?$query', $oauthToken);
}

function getHost ($hostId, $oauthToken='') {
    return doGet('hosts/$hostId', $oauthToken);
}

function getFileList ($oauthToken='') {
    return doGet('files', $oauthToken);
}

function getFile ($fileId, $oauthToken='') {
    return doGet('files/$fileId', $oauthToken);
}

function getFileAccessURI ($fileId, $oauthToken='') {
    return doGet('files/$fileId/access', $oauthToken);
}

function putNewPath($filePath, $oauthToken='') {
    return doPost('files/$filePath', $method='PUT', $oauthToken);
}