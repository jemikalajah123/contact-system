<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Status;
use Illuminate\Http\Response;

class StatusController extends Controller
{

    use ApiResponser;
    public $status_id;
    /**
     * Create a new controller instance.P
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

   /**
     * create an author.
     * @return.Illuminate/Http/Response
     */
    public function store(Request $request)
    {
        $rule = [
            'is_saved' => 'max:255|in:1,2',
        ];

        $this->validate($request, $rule);
        $status = Status::create($request->all());
        $this->status_id = $status['id'];

        return $this->successResponse($status, Response::HTTP_CREATED);

        
    }
   
}
