<div class="btn-group btn-group-xs" role="group" aria-label="...">
    <a href="{{ $action['edit'] }}" class="btn btn-default btn-warning">
        <i class="fa fa-pencil"></i> <span class="hidden-sm">Edit</span>
    </a>
    <button type="button" class="btn btn-default btn-danger"
            data-action="{{ $action['destroy'] }}"
            data-table="{{$action['name']}}-list"
            onclick="helper.confirmDelete(this)">
        <i class="fa fa-trash"></i> <span class="hidden-sm">Delete</span>
    </button>
</div>