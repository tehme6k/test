@if($retentions->count() > 0)
    <table class="table">
        <thead>
        <th>Lot #</th>
        <th>Name</th>
        <th>Production</th>
        <th>Expiration</th>
        <th>Added By</th>
        </thead>

        <tbody>
        @foreach($retentions as $retention)
            <tr>
                <td>
                    {{substr($retention->lot_number, 0, 4)}} -
                    {{substr($retention->lot_number, 4, 2)}} -
                    {{substr($retention->lot_number, 6, 3)}}
                </td>

                <td>
                    {{$retention->project->name}} -
                    {{$retention->project->flavor}}
                </td>

                <td>
                    {{\Carbon\Carbon::parse($retention->production_date)->format('d M Y')}}
                </td>

                <td>
                    {{\Carbon\Carbon::parse($retention->expiration_date)->format('d M Y')}}
                </td>

                <td>
                    {{ $retention->user->name }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@else
    <h3 class="text-center">No bottles at this time</h3>
@endif