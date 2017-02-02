<?php

namespace App\Repositories;

use App\Role;

class Permission
{
    public function roleValue($id)
    {
        return Role::find($id)->name;
    }

    public function grant($ability, $view = true)
    {
        if (!\Auth::user()->isAdmin() and \Gate::denies($ability)) {
            if ($view) {
                return false;
            } else {
                if (\Request::ajax()) {
                    return response()->json([
                        'message' => "I'm sorry you not authorized to perform this actions."
                    ], 403);
                } else {
                    abort(403, "I'm sorry you not authorized to perform this actions.");
                }
            }
        }

        return true;
    }
}
