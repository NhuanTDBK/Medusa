<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *tested
	 * @return Response
	 */
	public function index()
	{
		//
        $users= User::all();
        //print_r($users);
//        foreach($users as $user)
//        {
//            echo '<br>';
//            echo $user['user_name'];
//        }
        return $users;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		return $this->login();

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		//create a folder
        $user = new User;
        $userName = Input::get('userName');
        //Ma hoa password truoc khi luu vao db
        $password = Input::get('password');
        $hashPassword = Hash::make($password);
        $description = Input::get('description') or ("");
        $email = Input::get('email');
        $valid = User::checkValidEmail($email);
        if(!$valid) return false;
        //Luu thong tin
        $user->userName = $userName;
        $user->password = $hashPassword;
        $user->description = $description;
        $user->email = $email;
        //$user->save();
        //Tao thu muc dua theo ten cua userName
        $folderName =  str_replace(" ","",$userName);
        //$success = File::copyDirectory(defaultFolder,$folderName);
        //return $success;

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
        $users = User::all();
        foreach($users as $user)
        {
            //print_r($user);
            $post = $user->posts();
        }
        //print_r($user);
        return Response::json($post);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
     * tested
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
     * tested
	 */
	public function destroy($id)
	{
        $user = User::where('_id',$id)->delete();
        return $user;
	}
    /*
     * Login to website
     * tested
     */
    public function getLogin()
    {
        //echo Cookie::get("api_token");
        return View::make('user.login');
    }

    public function postLogin()
    {
	//echo "Touch"; 	
	    $credentials = array(
                'user_input' => Input::get('user_input'),
                'password' => Input::get('password')
        );
        $rules = array(
            'user_input' => 'required',
            'password' => 'required'
        );
        
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) { //kiem tra dieu kien credentials da thoa man rule hay chua
            $check = User::check_login($credentials['user_input'],$credentials['password']);          
            // dd(Session::get('user_name'));
            if($check){
                $username=Auth::user()->username;
		        $userId = $check['_id'];
                return Redirect::to($username.'/backend');
            }
            else{
                return Redirect::back()->with('success',"Tài khoản không chính xác. Đăng nhập thất bại");
            }
        }
    }
    public function getRegister()
    {
    	return View::make('user.register');
    }

    public function postRegister()
    {
        $credentials = array(
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'email' => Input::get('email'),
        );
        $rules = array(
            'username' => 'required|min:3|max:30|unique:users',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users',
        );
        if (!Validator::make($credentials, $rules)->fails()) {
            $user = new User();
            $user->username=$credentials['username'];
            //$credentials['password'] = Hash::make($credentials['password']);
            $user->password=Hash::make($credentials['password']);
            $user->email=$credentials['email'];
	        $user->remember_token ="";
            $user->avatar_link ="";
            $user->cover_link = "";
            $user->save();
            return Redirect::to('/login')->with('success', 'User is registered!');
        } else
            return Redirect::back();
    }

    public function getProfile()
    {
    	return View::make('user.profile');
    }

    public function check_username(){
        if (User::check_username(Input::get('username'))){
            return "false"; //AJAX chỉ nhận giá trị chuỗi. Nếu username tồn tại, trả về "false" để báo lỗi
        }else{
            return "true";
        }
    }

    public function check_email(){
        if (User::check_email(Input::get('email'))){
            return "false"; //AJAX chỉ nhận giá trị chuỗi. Nếu email tồn tại, trả về "false" để báo lỗi
        }else{
            return "true";
        }
    }

    public function getLogout(){
        User::logout();
        return Redirect::to('/');
    }

    public function postSyncfb(){

        $fbid = Input::get('fbid');
        $avatar_link = "https://graph.facebook.com/".Input::get('fbid')."/picture?type=large";
        $userid=Auth::user()->_id;
        $user = new User();
        $user = User::getUserById($userid);
//        $check=User::addFieldToUser($userid,$fbid);
//        //$check=User::addFieldToUser($userid,$avatar_link);
        $user["fbid"] = $fbid;
        $user["avatar_link"] = $avatar_link;
        $user->save();
   //     echo ($check) ? true : false;
        return Response::json($fbid);
    }
	  public function postLoginwithfb(){
        if (Auth::check()) {
            return Response::json(Auth::user()->username);
//        }else{
//            $fbid=Input::get('fbid');
//            $user=User::where('fbid',$fbid)->first();
//            Auth::login($user);
//            echo Auth::user()->username;
//            return Response::json(Auth::user()->username);
//        }
        }
        else{
            $response = Input::get('response');

        }
      }
      public function postChangecover()
      {
          $file = Input::file("image");
          $r = new ResourceController();
         // $response = $r->uploadImage($file);
          return Response::json(Input::all());
      }
}
