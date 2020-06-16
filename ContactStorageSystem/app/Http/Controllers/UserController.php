<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;
use App\Http\Controllers\StatusController;

class UserController extends Controller
{

    use ApiResponser;

    /**
     * The controller to consume the status controller.
     * @var StatusController
     */
    public $statusController;

    /**
     * Create a new controller instance.P
     *
     * @return void
     */
    public function __construct(StatusController $statusController)
    {
        $this->statusController = $statusController;
    
    }
    /**
     * Return the list of users.
     * @return.Illuminate/Http/Response
     */
    public function showAllUsers()
    {
        $users = User::all();
        return $this->successResponse($users);
        return $users;

    }


   /**
     * create an User.
     * @return.Illuminate/Http/Response
     */
    public function registerUser(Request $request)
    {

        $this->statusController->store($request);

        $rules = [
            'name' => 'required|regex:/(?=^.{0,150}$)^[a-zA-Z-]+\s[a-zA-Z-]+$/|max:255', //requires your first and last name
            'email'=> 'required|email|unique:users|max:255',
            'gender' => 'required|max:255|in:male,female',
            'phone_number' => 'required|unique:users|regex:/(^[0]\d{10}$)/',
            'house_address'=> 'required|max:255',
        ];

        

        $this->validate($request, $rules);
        $user = User::create($request->all());
        $user = User::findorfail($user['id']);
        $user['status_id'] = $this->statusController->status_id;
        $user ->save();

        return $this->successResponse($user, Response::HTTP_CREATED);

        
    }

   /**
     *get an User.
     * @return.Illuminate/Http/Response
     */ 
    public function showUser($user)
    {
        $user = User::findorfail($user);
        return $this->successResponse($user);

    }

   /**
     * update a user.
     *.@return.Illuminate/Http/Response
     */    
    public function updateUser(Request $request, $user )
    {
      
        $rules = [
            'name' => 'regex:/(?=^.{0,150}$)^[a-zA-Z-]+\s[a-zA-Z-]+$/|max:255', //requires your first and last name
            'email'=> 'email|unique:users|max:255',
            'gender' => 'max:255|in:male,female',
            'phone_number' => 'unique:users|regex:/(^[0]\d{10}$)/',
            'house_address'=> 'max:255',
        ];

        $this->validate($request, $rules);

        $user = User::findorfail($user);
        $user -> fill($request->all());
        if ($user->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user ->save();
        return $this->successResponse($user);
    }

   /**
     * delete a user.
     * @return.Illuminate/Http/Response
     */
    public function destroyUser($user )
    {
        $user = User::findorfail($user);
        $user ->delete();
        return $this->successResponse($user);
    }

   /**
     *search for users with the same name or similar name.
     * @return.Illuminate/Http/Response
     */
    public function searchForUser($user){
        $user = User::query()
        ->where('name', 'LIKE', "%{$user}%") 
        ->get();

        return $this->successResponse($user);
        
    }

   
}
