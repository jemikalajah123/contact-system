<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Http\Response;

class ContactController extends Controller
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
     * Return the list of authors.
     * @return.Illuminate/Http/Response
     */
    public function showAllContacts()
    {
        $users = Contact::all();
        return $this->successResponse($users);
        return $users;

    }


   /**
     * create a contact.
     * @return.Illuminate/Http/Response
     */
    public function registerContact(Request $request)
    {

        $this->statusController->store($request);

        $rules = [
            'user_id' => 'required|max:255',
            'name' => 'required|regex:/(?=^.{0,150}$)^[a-zA-Z-]+\s[a-zA-Z-]+$/|max:255', //requires your first and last name 
            'email'=> 'required||email|unique:contacts|max:255',
            'phone_number' => 'required|unique:contacts|regex:/(^[0]\d{10}$)/',
            'house_address'=> 'required|max:255',
        ];

        $this->validate($request, $rules);
        $user = Contact::create($request->all());
        $user = Contact::findorfail($user['id']);
        $user['status_id'] =  $this->statusController->status_id;
        $user ->save();
        return $this->successResponse($user, Response::HTTP_CREATED);

        
    }

   /**
     *get a contact.
     * @return.Illuminate/Http/Response
     */ 
    public function showContact($user)
    {
        $user = Contact::findorfail($user);
        return $this->successResponse($user);

    }

   /**
     * update a contact.
     *.@return.Illuminate/Http/Response
     */    
    public function updateContact(Request $request, $user )
    {
      
        $rules = [
            'status_id' => 'max:255',
            'user_id' => 'max:255',
            'name' => 'regex:/(?=^.{0,150}$)^[a-zA-Z-]+\s[a-zA-Z-]+$/|max:255', //requires your first and last name
            'email'=> '|unique:contacts|max:255',
            'phone_number' => 'unique:contacts|max:255|regex:/(^[0]\d{10}$)/',
            'house_address'=> 'max:255',
        ];

        $this->validate($request, $rules);

        $user = Contact::findorfail($user);
        $user -> fill($request->all());
        if ($user->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user ->save();
        return $this->successResponse($user);
    }

   /**
     * delete a contact.
     * @return.Illuminate/Http/Response
     */
    public function destroyContact($user )
    {
        $user = Contact::findorfail($user);
        $user ->delete();

        return $this->successResponse($user);
    }


   /**
     *diaplay all contacts stored by a particular user.
     * @return.Illuminate/Http/Response
     */
    public function viewUserContacts($user){
        $user = Contact::query()
        ->where('user_id', 'LIKE', "%{$user}%") 
        ->get();

        return $this->successResponse($user);
  
    }

   /**
     *search for a particular contact with the same name or similar name.
     * @return.Illuminate/Http/Response
     */
    public function searchForContact($user){

        $user = Contact::query()
        ->where('name', 'LIKE', "%{$user}%") 
        ->get();

        return $this->successResponse($user);
  
    }

   
}
