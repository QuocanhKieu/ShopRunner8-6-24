@if($permission->deleted_at)
    <button type="button" class="btn btn-success"
            onclick="restorePermission(this, {{ $permission->id }})" title="Restore"
            data-url="{{ route('permissions.restore', $permission->id) }}"
            id="restoreBtn_{{ $permission->id }}">
        <i class="fas fa-eye"></i>
    </button>
@else
    <a title="Hide" href="javascript:void(0);" class="btn btn-danger delete-permission"
       onclick="deletePermission(this, {{ $permission->id }})"
       data-url="{{ route('permissions.delete', $permission->id) }}">
        <i class="fas fa-eye-slash"></i>
    </a>
@endif

