<tr>
    <td><input class="checkItem" name="items[{{ $status->id }}]" type="checkbox"></td>
    <td>{{ $status->id }}</td>
    <td>{{ $status->name }}</td>
    <td class="table-action">
        <a href="{{route('issue-statuses.edit', $status->id)}}"><i class="align-middle" data-feather="edit-2"></i></a>
    </td>
</tr>