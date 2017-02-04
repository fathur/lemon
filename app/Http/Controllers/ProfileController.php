<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $this->grant('edit-profile');

        $user = \Auth::user();

        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $this->grant('edit-profile');

        $this->validateProfile($request);

        $user = \Auth::user();
        $user->email = $request->get('email');
        $user->name = $request->get('name');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return redirect()->back()
            ->with('success', 'Your profile successfully updated.');

    }

    /**
     * @param Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    private function validateProfile(Request $request)
    {
        if ($request->get('password') == '' and $request->get('password-confirm') == '') {
            $rules = [
                'email'    => 'required|email',

            ];

            $message = [];
        } else {
            $rules = [
                'email'            => 'required|email',
                'password'         => 'required|min:7',
                'password-confirm' => 'required|same:password'
            ];

            $message = [
                'password-confirm.required' => 'The confirm password field is required.',
                'password-confirm.same'     => 'The confirm password and password must match.'
            ];
        }

        \Validator::make($request->all(), $rules, $message)
            ->validate();
    }
}
