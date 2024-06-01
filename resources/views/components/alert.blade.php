   @if (session()->has($type))
        <div class="alert" role="alert">
            {{ session($type) }}
        </div>
    @endif