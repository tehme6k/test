@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary my-2" onclick="handleAdd()">
            Add User
        </button>
    </div>
    <div class="card card-default">
        <div class="card-header">Users</div>
        <div class="card-body">
            @if($users->count() > 0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>When</th>
                    <th>Created By</th>
                    <th></th>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{$user->name}}
                            </td>

                            <td>
                                {{ $user->email }}
                            </td>

                            <td>
                                {{ $user->role }}
                            </td>

                            <td>
                                {{ $user->created_at->diffForHumans() }}
                            </td>

                            <td>
                                @if($user->created_by == 0)
                                    {{ $user->name }}
                                @else
                                    {{ $user->createdBy->name }}
                                @endif
                            </td>

                            <td>
                                <a href="#" class="btn btn-info btn-sm">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No users at this time</h3>
            @endif

        </div>
    </div>


    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add new user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">---</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('scripts')

@endsection