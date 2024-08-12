<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\userrequest;

use Illuminate\Support\Facades\Validator;
class rstudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $u=new User();
        $validator=Validator::make($request->all(),[
            'First_Name'=>  ['alpha',

                            ],

            'Last_Name'=>   ['alpha',

                            ],

            'University_id'=> ['unique:users,code',

                            ],

        ],
        [
            'University_id'=>'The University id already exists'
        ]);


        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }
        $u->first_name= ucfirst($request->First_Name);
        $u->last_name= ucfirst($request->Last_Name);
        $u->gender= $request->sub;
        $u->year= $request->year;
        $u->code= $request->University_id;
        $u->birth= $request->Birth;
        $u->phone= $request->phone;
        $u->adress= $request->adress;
        $u->email='';
        $u->password='';
        $u->type= "student";
        $u->save();
        $blan='ook';
        return view('admin_add_user',compact('blan'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}

