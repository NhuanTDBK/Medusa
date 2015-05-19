<?php
class PostController extends \BaseController {
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $posts = Post::getAllVisiblePost();
        $format="F j, Y, g:i a";
        foreach($posts as $post)
        {
            $date = new DateTime($post['created_at']);
            $formatDate = $date->format($format);
            $post["create_time"]=$formatDate;
            $user = User::getUserById($post["author_id"]);
            $post["username"] = $user["username"];
        }
        return View::make("home.index",
            [
                'posts'=>$posts
            ]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        try {
            $result = Auth::check();
            if($result)
                return View::make('post.create');
        }
        catch(Exception $ex)
        {
            Redirect::to('/login');
        }

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $title = Input::get('title');
        $content= Input::get('content');
        $type = Input::get('post');
        $tags="";
        if(isset($tags)||strlen($tags)!=0)
            $tags = explode(",",Input::get('tags'));
        $post = new Post();
        $post->title=$title;
        $post->content=$content;
        $post->author_id = Auth::id();
        $post->tags = $tags;
		print_r(Input::all());
        if($type=="Draft")
        {
            $post->type="Draft";
        }
        else
            $post->type="Public";
        $result = $post->save();
	    return Redirect::to(Auth::user()->username.'/'.'backend');
    }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $post = Post::getPostById($id);
        $format="F j, Y, g:i a";
        $date = new DateTime($post['created_at']);
        $formatDate = $date->format($format);
        $post["create_time"]=$formatDate;
        $user = User::getUserById($post['author_id']);
        $post["username"] = $user["username"];
        return View::make("home.show", ['post'=>$post]);
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
        $post = Post::getPostById($id);
        $title = Input::get('title');
        $content= Input::get('content');

        $tags = explode(",",Input::get('tags'));
        $post->title=$title;
        $post->content=$content;
        $post->tags = $tags;

        $result = $post->save();
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
        $result = post::destroy($id);
        return $result;
	}
    public function getComment($post_id)
    {
        $comments = Post::getCommentsOfPost($post_id);
        return Response::json($comments);
    }
    public function getDelete($id){
        $result = $this->destroy($id);
        return Response::json(array("success"=>$result));
    }
    public function getUpdate($id)
    {
        $post = Post::getPostById($id);
        return View::make('post.update',array('post'=>$post));
    }
    public function postUpdate($id)
    {
        $this->update($id);
        return Redirect::to(Auth::user()->username.'/'.'backend');
    }
    public function getIndex($username)
    {
        $userId = User::where('username','=',$username)->get(array("_id"));
        $format="F j, Y, g:i a";
        $posts = Post::where("author_id",$userId[0]["_id"])->where('type','=','Public')->get();
        foreach($posts as $post)
        {
            $date = new DateTime($post['created_at']);
            $formatDate = $date->format($format);
            $post["create_time"]=$formatDate;
            $user = User::getUserById($post["author_id"]);
            $post["username"] = $user["username"];
        }
        return View::make('home.index',array("posts"=>$posts));
    }
    public function postStatusOnFacebook($url)
    {

    }
}
