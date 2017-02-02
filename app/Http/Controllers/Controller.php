<?php

namespace App\Http\Controllers;

use App\Repositories\Permission;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $name = 'lemon';

    public function __construct()
    {
        view()->share('name', $this->name);
    }

    public function grant($ability)
    {
        $permission = new Permission();
        $permission->grant($ability, false);
    }
}
