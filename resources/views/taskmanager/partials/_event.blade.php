<div class="border mt-3 mb-3">
    <div class="alert-message">
        <p class="mb-0">{{ $event->created_at }} {{ $event->body }}</p>
        @if ($event->comments->count())
            <p class="mt-2 mb-2">{!! $event->comments->first()->body !!}</p>
        @endif
    </div>
</div>