@if(!empty($chunks))
    @foreach($chunks as $chunk)

        @if($chunk->type == 'text')
            {{$chunk->body}}
        @endif

        @if($chunk->type == 'html')
            {!! $chunk->body !!}
        @endif

    @endforeach

@endif
