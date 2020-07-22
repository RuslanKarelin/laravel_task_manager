<tr>
    <td><input class="checkItem" name="items[{{ $issue->id }}]" type="checkbox"></td>
    <td>{{ $issue->id }}</td>
    <td>{{ $issue->name }}</td>
    <td>{{ $issue->project->name }}</td>
    <td>{{ $issue->created_at }}</td>
    <td>{{ $issue->beginning }}</td>
    <td>{{ $issue->completion }}</td>
    <td>{{ $issue->FormatEstimate }}</td>
    <td>{{ $issue->FullTime }}</td>
    <td>{{ $issue->EstimateTimePrice }} {!! __('app.Currency') !!}</td>
    <td>{{ $issue->FullTimePrice }} {!! __('app.Currency') !!}</td>
    <td>{{ $issue->status->name }}</td>
    <td class="table-action">
        <a href="{{route('issues.show', $issue->id)}}"><i class="align-middle mr-2 fas fa-fw fa-eye"></i></a>
        <a href="{{route('issues.edit', $issue->id)}}"><i class="align-middle" data-feather="edit-2"></i></a>
    </td>
</tr>