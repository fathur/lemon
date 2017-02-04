@inject('permission', '\App\Repositories\Permission')

<div class="btn-group btn-group-xs" role="group" aria-label="...">
    @if($permission->grant($ability['edit']))
        <a href="{{ $action['edit'] }}" class="btn btn-default btn-warning">
            <i class="fa fa-pencil"></i> <span class="hidden-sm">Edit</span>
        </a>
    @endif

    @if($permission->grant($ability['delete']))
        <button type="button" class="btn btn-default btn-danger"
                data-action="{{ $action['destroy'] }}"
                data-table="{{ $action['name'] }}-list"
                onclick="helper.confirmDelete(this)">
            <i class="fa fa-trash"></i> <span class="hidden-sm">Delete</span>
        </button>
    @endif
</div>

@if($permission->grant($ability['edit']))
<a href="{{ $action['password'] }}" class="btn btn-default btn-info btn-xs">
    <i class="fa fa-lock"></i> <span class="hidden-sm">Password</span>
</a>
@endif
