<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $clinicId;

    public function __construct()
    {
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function index($clinicSlug, $roleId = null)
    {
        if ($roleId && in_array($roleId, config('role'))) {
            $users = User::where('role', $roleId)
                ->where('clinic_id', $this->clinicId)
                ->orderBy('created_at', 'asc')
                ->get();
            $roleName = array_search($roleId, config('role'));
        } else {
            $users = User::orderBy('created_at', 'asc')->where('clinic_id', $this->clinicId)->get();
            $roleName = 'All Roles';
        }

        return view('admin.user_list', compact('users', 'roleName'));
    }

    public function create()
    {
        return view('admin.create_user');
    }

    public function store(Request $request, $clinicSlug)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,13|unique:users,phone',
            'role' => 'required|in:1,2,3,4',
            'whatsapp' => 'nullable|digits_between:10,13|unique:users,whatsapp',
            'email' => 'nullable|email',
            'gender' => 'nullable|digits_between:1,2',
        ]);

        $user = User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make('ravi'),
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'gender' => $request->gender,
            'role' => $request->role,
            'clinic_id' => Session::get('current_clinic')['id']
        ]);

        return redirect()->route('admin.user.show', ['userId' => $user->id])->with('success', 'User registered successfully!');
    }

    public function show($clinicSlug, $userId)
    {
        $user = User::where('id', $userId)
            ->where('clinic_id', $this->clinicId)
            ->firstOrFail();

        return view('admin.view_user', ['user' => $user]);
    }

    public function update(Request $request, $clinicSlug, $userId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,13|unique:users,phone,' . $userId,
            'whatsapp' => 'nullable|digits_between:10,13|unique:users,whatsapp,' . $userId,
            'gender' => 'nullable|digits_between:1,2',
            'email' => 'nullable|email',
            'role' => 'required|in:1,2,3,4',
        ]);

        $user = User::where('id', $userId)
            ->where('clinic_id', $this->clinicId)
            ->firstOrFail();

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->whatsapp = $request->whatsapp;
        $user->gender = $request->gender;

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully!');
    }
}
