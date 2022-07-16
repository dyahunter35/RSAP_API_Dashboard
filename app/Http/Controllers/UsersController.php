<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Activitylog\Models\Activity;

class UsersController extends Controller
{
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::latest()->paginate(10);

        //return $users;

        return view('users.index2', compact('users'))
            ->with('i', (($request->input('page', 1) - 1) * $users->perPage()) + 1);
    }

    /**
     * Show form for creating user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user
     *
     * @param User $user
     * @param StoreUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request)
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user

        $password = $this->randomPassword();

        $user->create(array_merge($request->validated(), [
            'password' => bcrypt($password)
        ]));

        $details = [
            'title' => $request->name,
            'body' => $password,
        ];

        Mail::to($request->email)->send(new TestMail($details));
        /*
        $messageBody = "Welcome ".$user->name."your password is : \n" . $password."</b>";

        Mail::raw($messageBody, function ($message) {
            $message->from('dyahunter35@gmail.com', 'Rapid Response Application for Patients (RSAP)');
            $message->to('dyahunter35@gmail.com');
            $message->subject('Registration is done');
        });*/

        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }
    public function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 10; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    /**
     * Show user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function log(Request $request, User $user)
    {
        $logs = Activity::where('causer_id', $user->id)->paginate(15);

        return view('users.logs', compact('logs'))
            ->with('id', $user->id)
            ->with('i', (($request->input('page', 1) - 1) * $logs->perPage()) + 1);
    }

    /**
     * Edit user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::all()
        ]);
    }

    /**
     * Update user data
     *
     * @param User $user
     * @param UpdateUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $user->update($request->validated());

        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }

    /**
     * Delete user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
}
