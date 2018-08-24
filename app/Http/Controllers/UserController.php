<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Notifications\AdminAccountInvitation;
use App\Notifications\AccountActivated;
use App\User;
use Auth;
use Mail;
use App\Mail\register;
use App\Mail\ElimiaAccount;
use Session;
use App\Cart;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->paginate(20);
        return view('backend.pages.users',[
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($email, $password)
    {

        $user = User::where('email', $email)->first();

        if ($user->status != 0) {
            return 'Utente già verificato';
        }

        if (\Hash::check(decrypt($password), $user->password)) {

            return view('backend.pages.auth.activate',[

                'user' => $user,

            ]);

        } else {
            return 'Non ti ho riconosciuto';
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|string|email|max:255|unique:users',
        ]);

        if ($validator->fails()) {
                 return redirect()->back()->withErrors($validator)->withInput();
        }

        $password = str_random(10);

        $user           = new User();
        $user->email    = $request->input('email');
        $user->password = bcrypt($password);
        $user->status   = 0;

        $user->save();

        $user->roles()->sync($request->input('roles', []));
        $user->permissions()->sync($request->input('permissions', []));

        Mail::to($user->email)->send(new register);

        return redirect()->back()->with([
            'message' => [
                'text' => 'Invitation sent to ' . $request->input('email'),
                'type' => 'success',
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        return 'ciao';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return $user;
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


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function activate(Request $request) {
        $validations = [
            'name'     => 'required|string|max:255',
            'last'     => 'required|string|max:255',
            'password' => 'string|min:6|confirmed',
        ];

        $validator = Validator::make($request->all(), $validations);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user           = User::findOrFail($request->input('id'));
        $user->name     = $request->input('name');
        $user->last     = $request->input('last');
        $user->full     = $request->input('name') . ' ' . $request->input('last');
        $user->password = bcrypt($request->input('password'));
        $user->status   = 1;

        $user->save();

        $user->notify(new AccountActivated());

        return redirect(route('admin::dashboard'))->with([
            'message' => [
                'text' => 'Account activated. Welcome  ' . $user->full,
                'type' => 'success',
            ]
        ]);
    }
    public function delete() 
    {
        $user=User::find(Auth::user()->id);
        Mail::to($user->email)->send(new ElimiaAccount);
        $user->delete();
        Auth::logout();
        return redirect('/');
    }

    public function getLogout() {
        Auth::logout();
        return redirect('/');
    }

    public function logout()
    {
        if(Session::has('cart')) {
            Session::forget('cart');
        }

        Auth::logout();
        return redirect('/');
    }
}
