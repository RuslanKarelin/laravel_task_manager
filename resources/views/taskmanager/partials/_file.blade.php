<li class="file-item">
    <a class="remove-file" data-id="{{$file->id}}" data-filename="{{$file->filename}}" href="#"><i
                class="align-middle text-danger mr-2 fas fa-fw fa-times"></i></a> <a
            href="{{route('download-file', $file->filename)}}">{{$file->filename}}</a>
</li>