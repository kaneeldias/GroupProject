<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
set_include_path(APPPATH . 'third_party/' . PATH_SEPARATOR . get_include_path());
require_once APPPATH . 'third_party/Google/vendor/autoload.php';

class Google extends Google_Client {

    private $client;

    function __construct($params = array()) {
        parent::__construct();
        $client = new Google_Client();
        $client->setApplicationName('UCSC Academic Support System');
        $client->setScopes(Google_Service_Calendar::CALENDAR);
        $client->setAuthConfig(APPPATH . 'third_party/Google/credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        $this->client = $client;
    }

    public function getClient(){


        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $this->client->setAccessToken($accessToken);
            //var_dump($accessToken);
        }


        // If there is no previous token or it's expired.
        if ($this->client->isAccessTokenExpired()) {

            // Refresh the token if possible, else fetch a new one.
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                if (!file_exists(dirname($tokenPath))) {
                    mkdir(dirname($tokenPath), 0700, true);
                }
                file_put_contents($tokenPath, json_encode($this->client->getAccessToken()));
            }
            else {
               return false;
            }
        }
        return $this->client;
    }

    public function getAuthUrl(){
        $authUrl = $this->client->createAuthUrl();
        return $authUrl;

    }

    public function checkAuthorize($authCode){
        try{
            $accessToken = $this->client->fetchAccessTokenWithAuthCode($authCode);
            $this->client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }

            $tokenPath = 'token.json';

            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($this->client->getAccessToken()));

            return true;
        }
        catch(Exception $ex){
            return false;
        }

    }
}

?>