<?php

namespace App\Repositories;

use App\Role;

class Permission
{
    public function roleValue($id)
    {
        return Role::find($id)->name;
    }
}