<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Permission
 */
class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    public function index()
    {
        $this->grant('view-user');

        return view('permission.user.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    public function create()
    {
        $this->grant('create-user');

        return view('permission.user.create');
    }

    /**
     * @param Request $request
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->grant('create-user');

        \Validator::make($request->all(), [
            'username'  => 'required|unique:users,username',
            'email'    => 'required|email',
            'role_id'  => 'required',
            'password' => 'required|min:7'
        ])->validate();

        $user = new User();
        $user->email = $request->get('email');
        $user->username = $request->get('username');
        $user->role_id = $request->get('role_id');
        $user->name = $request->get('name');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User ' . $request->get('name') . ' successfully created.');
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author   Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    public function edit(User $user)
    {
        $this->grant('edit-user');

        return view('permission.user.edit', compact('user'));
    }

    /**
     * @param User    $user
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * @author   Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    public function update(User $user, Request $request)
    {
        $this->grant('edit-user');

        \Validator::make($request->all(), [
            'username'  => 'required|unique:users,username',
            'email'    => 'required|email',
            'role_id'  => 'required',
        ])
            ->validate();

        $user->email = $request->get('email');
        $user->username = $request->get('username');
        $user->role_id = $request->get('role_id');
        $user->name = $request->get('name');
        $user->save();

        return redirect()->back()
            ->with('success', 'User ' . $request->get('name') . ' successfully updated.');
    }

    /**
     * @param User $user
     *
     *
     * @return int
     * @author   Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    public function destroy(User $user)
    {
        $this->grant('delete-user');

        return User::destroy($user->id);
    }

    /**
     * @return mixed
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    public function data()
    {
        $this->grant('view-user');

        return \Datatables::of(User::select('*'))
            ->editColumn('email', function ($user) {
                return "<a href='mailto:{$user->email}'>{$user->email}</a>";
            })
            ->addColumn('action', function ($user) {
                return view('permission.user.action')
                    ->with('action', [
                        'name'     => $this->name,
                        'edit'     => route('users.edit', $user->id),
                        'destroy'  => route('users.destroy', $user->id),
                        'password' => route('users.password.index', $user->id)
                    ])
                    ->with('ability', [
                        'edit'   => 'edit-user',
                        'delete' => 'delete-user'
                    ])
                    ->render();
            })
            ->editColumn('active', function ($user) {
                if ($user->active) {
                    return '<i class="fa fa-check text-success" aria-hidden="true"></i>';
                } else {
                    return '<i class="fa fa-times text-danger" aria-hidden="true"></i>';
                }
            })
            ->addColumn('role', function ($user) {
                return $user->role->name;
            })
            ->make(true);
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    public function password(User $user)
    {
        $this->grant('edit-user');

        return view('permission.user.password', compact('user'));
    }

    /**
     * @param User    $user
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    public function changePassword(User $user, Request $request)
    {
        $this->grant('edit-user');

        \Validator::make($request->all(), [
            'password'         => 'required|min:7',
            'password-confirm' => 'required|same:password'
        ], [
            'password-confirm.required' => 'The confirm password field is required.',
            'password-confirm.same'     => 'The confirm password and password must match.'
        ])->validate();

        $user->password = bcrypt($request->get('password'));
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Password user ' . $user->name . ' successfully updated.');
    }
}
