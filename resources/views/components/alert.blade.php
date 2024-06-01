   @if (session()->has($type))
        {{-- <div class="alert alert-{{$style}}" role="alert"> --}}
        <div class="alert alert-{{$style}}" role="alert">
            {{ session($type) }}
        </div>
    @endif