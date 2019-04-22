<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Access\AuthorizationException;

use App\User;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->cant('list', User::class))
            throw new AuthorizationException("Access denied");

        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('create', User::class)) {
          $u = new User;
          $u->name          = $request->name;
          $u->email         = $request->email;
          $u->administrator = $request->administrator;
          $u->active        = $request->active;
          $u->password      = Hash::make($request->password);
          $u->save();
          return $u;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $u = User::find($id);
        if (Auth::user()->can('view', $u)) {
          return $u;
        }
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
        $u = User::find($id);
        $logged = Auth::user();

        if ($u && $logged->can('update', $u)) {
            $u->name          = $request->name;
            $u->email         = $request->email;

            if ($logged->id != $u->id && $logged->administrator) {
              $u->administrator = $request->administrator;
              $u->active        = $request->active;
            }

            if ($request->password != '') {
              $u->password = Hash::make($request->password);
            }

            $rs = $u->save();
            return "{'success':'".($rs ? "true" : "false")."'}";
        }
        return "{'success':false, 'message':'unauthorized'}";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u = User::find($id);
        if ($u && Auth::user()->can('delete', $u)) {
            $rs = $u->delete();
            return "{'success':'".($rs ? "true" : "false")."'}";
        }
        return "{'success':false, 'message':'unauthorized'}";
    }

    public function me() {
        return User::with('rights')->where('id', Auth::id())->first();
    }
}
