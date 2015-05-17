<?php
use Facebook\FacebookSession;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\FacebookRedirectLoginHelper;
class LoginFacebookController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    private $fb;
    public function  __construct(FacebookHelper $fb)
    {
        $this->fb = $fb;
    }
    public function login()
    {
        $helper = new FacebookRedirectLoginHelper(URL::asset('login/fb/callback'));
        $session = $helper->getSessionFromRedirect();
        try {

        } catch(FacebookRequestException $ex) {
            // When Facebook returns an error
        } catch(\Exception $ex) {
            // When validation fails or other local issues
        }
        if ($session) {
            // Logged in
        }
        return Redirect::to($this->fb->getUrlLogin());
    }
    public function callback()
    {
//        if($this->fb->generateSessionFromRedirect())
//        {
//            echo "Session login";
//        }
//        dd($this->fb->getGraph());
        return Config::get('facebook.app_id');
    }
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
