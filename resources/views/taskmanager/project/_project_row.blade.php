<tr>
    <td><input class="checkItem" name="items[{{ $project->id }}]" type="checkbox"></td>
    <td>{{ $project->id }}</td>
    <td>{{ $project->name }}</td>
    <td class="table-action">
        <a href="{{route('projects.show', $project->id)}}"><i class="align-middle mr-2 fas fa-fw fa-eye"></i></a>
        <a href="{{route('projects.edit', $project->id)}}"><i class="align-middle" data-feather="edit-2"></i></a>
    </td>
</tr>