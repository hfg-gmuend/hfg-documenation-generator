<?php

session_start();

Kirby::plugin("k3/google-oauth", [

    "routes" => [
        [
            "pattern" => "oauth/panel/login",
            "method" => "GET",
            "auth" => false,
            "action" => function () {

                loginUser($_SESSION['googleAccountInfo']);

                return [
                    "code" => 200,
                    "status" => "ok",
                ];
            },
        ],
        [
            "pattern" => "oauth/panel/redirect",
            "method" => "GET",
            "auth" => false,
            "action" => function () {

                $_SESSION['instance'] = kirby()->site()->url();

                go('https://accounts.google.com/o/oauth2/auth?response_type=code&access_type=online&client_id=914414992322-db2h9cuc69dhmfor6vrk6hblnrakucnn.apps.googleusercontent.com&redirect_uri=http%3A%2F%2Flocalhost%2Foauth%2Flogin%2Fgoogle&state&scope=email&prompt=consent');
                
                return [
                    "code" => 200,
                    "status" => "ok1",
                ];
            },
        ],
        [
            "pattern" => "oauth/url",
            "method" => "GET",
            "auth" => false,
            "action" => function () {
                return [
                    "redirect" => kirby()->site()->url()."/oauth/panel/redirect",
                ];
            },
        ],
    ],
]);

function loginUser($oauthUser)
{
    $vars = ['email', 'verifiedEmail', 'hd'];

    $oauthUserData = (array) $oauthUser;
    var_dump($oauthUserData);
    foreach ($vars as $var) {
        $$var = isset($oauthUserData[$var]) ? $oauthUserData[$var] : null;
    }

    if (!$email) {
        $this->error("E-mail address missing missing!");
    }

    if ($verifiedEmail === false) {
        $this->error("E-mail address not verified!");
    }

    if (!$kirbyUser = kirby()->user($email)) {
        kirby()->impersonate('kirby');
        $kirbyUser = kirby()->users()->create([
            'email' => $email,
            'role' => kirby()->option('google-oauth.defaultRole', 'editor'),
        ]);
    }

    $kirbyUser->loginPasswordless();
    go('panel');
}
