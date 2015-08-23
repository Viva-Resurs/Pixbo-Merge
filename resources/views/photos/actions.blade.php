<div class="btn-group pull-right">
    <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
        <i class="glyphicon glyphicon-fire"></i> Actions <span class="caret"></span>
    </button>

    <ul class="dropdown-menu" role="menu">

        <li><a href="{{ route('admin.photos.show', array($item['id'])) }}">View</a></li>
        <li><a href="{{ route('admin.photos.edit', array($item['id'])) }}">Edit</a></li>
        <li>
            {!!
                Form::open(['method' => 'DELETE',
                    'route' => ['admin.photos.destroy', $item['id']],
                    'style' => 'display:inline']) !!}
                <button
                    class="delete-button"
                    type="button"
                    data-toggle="modal"
                    data-target="#confirmDelete"
                    data-title="Delete Client"
                    data-message="Are you sure you want to delete this client ?"
                >
                    Delete
                </button>
                @include('shared.delete_message')
            {!! Form::close() !!}
        </li>
    </ul>
</div>