<?php
class LoginFacebookController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function callback()
    {
        return Response::json(Config::get('facebook.app_id'));
    }
}
