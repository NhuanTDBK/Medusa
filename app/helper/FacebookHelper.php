<?php
/**
 * Created by PhpStorm.
 * User: Nhuan
 * Date: 5/16/2015
 * Time: 3:19 PM
 */
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

class FacebookHelper
{
    public $helper;
    public $session;
    public function __construct()
    {
        FacebookSession::setDefaultApplication(Config::get('facebook.app_id'), Config::get('facebook.app_secret'));
        $helper = new FacebookRedirectLoginHelper(URL::asset('login/fb/callback'));
        $this->helper = $helper;
    }
    public function getUrlLogin()
    {
        return $this->helper->getLoginUrl(Config::get('facebook.app_scope'));
    }
    public function generateSessionFromRedirect()
    {
        $this->session = null;
        try{
            $this->session = $this->helper->getSessionFromRedirect();
        }
        catch(\Facebook\FacebookRequestException $ex)
        {

        }
        return $this->session;
    }
    public function getToken()
    {
        return $this->session->getToken();
    }
    public function getGraph()
    {
        $request = new \Facebook\FacebookRequest($this->session, 'GET', '/me');
        $response = $request->execute();
        return $response->getGraphObject();
    }
}