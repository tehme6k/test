@extends('layouts.projects')

@section('first-card-header')
    <div class="d-flex justify-content-between">
        <div>
            <a href="{{ route('projects.index') }}" type="button" class="btn btn-primary mb-2 ">Back to all projects</a>
        </div>

        <div>
            <button type="button" class="btn btn-success mb-2 " onclick="handleAdd()">New Version</button>
        </div>
    </div>
@endsection

@section('first-card-body')
    <h2>{{ $project->name }} -
        {{ $project->flavor }}
    </h2>
    <h5>
        By <strong>{{ $project->createdBy->name }}</strong> -
        {{ $project->created_at->diffForHumans() }}
    </h5>
@endsection

@section('second-card-header')
    All MPR Versions
@endsection


@section('second-card-body')
    @if($mprs->count() > 0)
        <table class="table">
            <thead>
            <th>Version</th>
            <th>Serving Size</th>
            <th>Created By</th>
            <th>Status</th>
            </thead>


            <tbody>
            @foreach($mprs as $mpr)
                <tr>
                    <td>
                        {{ $mpr->version }}
                    </td>

                    <td>
                        {{ $mpr->serving_size}}
                    </td>

                    <td>
                        {{ $mpr->createdBy->name }}
                    </td>

                    <td>
                        <a href="{{ route('mprs.show', $mpr->id) }}" class="btn btn-link btn-md">
                            {{$mpr->status}}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h3 class="text-center">No MPRs at this time</h3>
    @endif
@endsection


@section('third-card-header')
    Batch Issues
@endsection


@section('third-card-body')
    @if($bprs->count() > 0)
        <table class="table">
            <thead>
            <th>Lot Number</th>
            <th>Bottle Count</th>
            <th>Created By</th>
            <th>Status</th>
            </thead>


            <tbody>
            @foreach($bprs as $bpr)
                <tr>
                    <td>
                        {{ $bpr->lot_number }}
                    </td>

                    <td>
                        {{ $bpr->bottle_count}}
                    </td>

                    <td>
                        {{ $mpr->createdBy->name }}
                    </td>

                    <td>
                        <a href="{{ route('bprs.show', $bpr->id) }}" class="btn btn-link btn-md">
                            {{$bpr->status == 'approved' ? 'Issued' : $bpr->status}}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h3 class="text-center">No Batch Issues at this time</h3>
    @endif
@endsection


@section('content')
    <form action="{{ route('mprs.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Start next version for: {{ $project->name }} - {{ $project->flavor }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="project_id" value="{{$project->id}}">

                        <input type="hidden" name="version" value="{{$mprs->count()}}">

                        <div class="form-group">
                            <label for="serving_size">Serving Size</label>
                            <input type="number" name="serving_size" class="form-control">
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
        function handleStart() {
            console.log('Opening Modal from projects.show.blade.php file scripts section')

            $('#startModal').modal('show')
        }
    </script>
@endsection