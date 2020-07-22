<tr>
    <td><input class="checkItem" name="items[{{ $source->id }}]" type="checkbox"></td>
    <td>{{ $source->id }}</td>
    <td>{{ $source->FullName }}</td>
    <td>{{ $source->email }}</td>
    <td>{{ $source->phone }}</td>
    <td>{{ $source->price }}</td>
    <td class="table-action">
        <a href="{{route('sources.show', $source->id)}}"><i class="align-middle mr-2 fas fa-fw fa-eye"></i></a>
        <a href="{{route('sources.edit', $source->id)}}"><i class="align-middle" data-feather="edit-2"></i></a>
    </td>
</tr>