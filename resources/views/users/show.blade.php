@extends('layouts.show')

@section('jumbotron-header')
    {{$user->name}}
@endsection


@section('jumbotron-under-header')
    {{ $user->role }}
@endsection


@section('jumbotron-content')
    <h3> Email: <strong> {{ $user->email }}</strong></h3>
    <h4>{{$user->created_at->diffForHumans()}}</h4>
@endsection


@section('jumbotron-buttons')
    <div>
        @if($user->email != 'innovativetim06@gmail.com')
            <button type="button" class="btn btn-success mb-2 " onclick="handleEdit()">Edit</button>
        @endif
    </div>
@endsection


@section('table-header')
    <th>Task</th>
    <th>Completed</th>
    <th>By User</th>
    <th>Added Later</th>
@endsection


@section('table-body')
    <tr>
        <td colspan="4">
            Nothing to show.
        </td>
    </tr>
@endsection


@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">{{$user->name}} : Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <select name="role" id="role" class="form-control">
                                <option value="">---</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection


@section('scripts')
    <script>
        function handleEdit() {
            console.log('Opening Modal from users.show.blade.php file scripts section')

            $('#editModal').modal('show')
        }
    </script>
@endsection