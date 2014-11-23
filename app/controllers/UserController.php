<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e){
    return Response::make('Not Found', 404);
});

class UserController extends \BaseController {


    protected $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //If the URL includes query string 'search'
        $input = Input::all();

        if (Request::ajax()){
            if (array_key_exists('search', $input) && $input['search'] === 'true'){
                // get the rest of query string.
                $qs = array_except($input, ['search']);

                //Search and filter out the data.
                $users =$this->user->search($qs)->select(['id', 'username', 'type', 'name', 'email', 'phone'])->get()->toJson();

                return $users;
            }
            else{
                //Show a list of all the user
                $users = $this->user->select(['id', 'username', 'type', 'name', 'email', 'phone'])->get()->toJson();

                return $users;
            }
        }

        return View::make('user.index');
    }


    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //Show a form to create new user.
        return View::make('user.create');
    }


    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
        //Redirect back to the index after storing.
        $input = Input::all();

        //Validation
        if( ! $this->user->fill($input)->isValid()){
            return Redirect::back()->withInput()->withErrors($this->user->errors)->with('flash_message_danger', 'Invalid input');
        }

        // Hash the password
        $this->user->password = Hash::make($this->user->password);

        // Deleted the password_confirmation before save
        unset($this->user['password_confirmation']);

        $this->user->save();

        return Redirect::route('user.index')->with('flash_message_success', 'New entry have been created');
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
        $user = $this->user->findOrFail($id);

        return View::make('user.show', ['user' => $user]);
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
        $user = $this->user->findOrFail($id);

        return View::make('user.edit', ['user'=>$user]);
    }


    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        //Get input then update
        $input = Input::all();

        $user = $this->user->findOrFail($id);

        //Check for access
        if (!Auth::user()->isAdmin()){
            $credentials = ['username' => $user->username, 'password' => $input['current_password']];
            if (! Auth::validate($credentials))
            {
                return Redirect::back()->with('flash_message_danger', 'Invalid current password.');
            }
        }

        if(! $user->fill($input)->isValid()){
            return Redirect::back()->withInput()->withErrors($user->errors)->with('flash_message_danger', 'Invalid input');
        }

        // Hash the password
        $user->password = Hash::make($user->password);

        // Deleted the password_confirmation before save
        unset($user['password_confirmation']);

        $user->save();

        return Redirect::route('user.show', $id)->with('flash_message_success', 'The entry has been updated.');
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
        $this->user->findOrFail($id)->delete();

        return Redirect::route('user.index')->with('flash_message_info', 'The entry has been deleted.');
    }

    public function search(){
        //Makes a URL with query string then redecirts to it.
        $keyword = Input::get('keyword');

        $url = qs_url('user', ['search' => 'true', 'keyword' => $keyword]);

        // Redirect to /user/?search={$keyword}
        return Redirect::to($url)->with('flash_message_success', 'Search completed.');
    }

    public function ajax(){
        $input = Input::all();

        //For mass delete request
        if ($input['action'] === 'delete'){
            foreach ($input['input'] as $users){
                $this->destroy($users['id']);
            }
        }
        return "successfully deleted";
    }

}