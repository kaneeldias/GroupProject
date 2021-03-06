<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
set_include_path(APPPATH . 'third_party/' . PATH_SEPARATOR . get_include_path());
require_once APPPATH . 'third_party/Google/vendor/autoload.php';

class Google extends Google_Client {

    private $client;
    private $user_id;

    function __construct($params = array()) {
        parent::__construct();
        $client = new Google_Client();
        $client->setApplicationName('UCSC Academic Support System');
        $client->setScopes(Google_Service_Calendar::CALENDAR);
        $client->setAuthConfig(APPPATH . 'third_party/Google/credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        $this->client = $client;

        /*$client = new Google_Client();
        $client->setAuthConfig(APPPATH . 'third_party/Google/credentials.json');
        $client->setAccessType("offline");        // offline access
        $client->setIncludeGrantedScopes(true);   // incremental auth
        $client->setScopes(Google_Service_Calendar::CALENDAR);
        $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
        $this->client = $client;*/
    }

    public function setUserId($id){
        $this->user_id = $id;
    }

    public function getClient(){

        /*$client = $this->client;

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
            $drive = new Google_Service_Calendar($client);
            $files = $drive->files->listFiles(array())->getItems();
            echo json_encode($files);
        } else {
            $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php';
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }

        return $client;*/


        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = 'tokens/'.$this->user_id.'_token.json';
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

            $tokenPath = 'tokens/'.$this->user_id.'_token.json';

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