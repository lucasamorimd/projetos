<nav aria-label="breadcrumb">
    <ol class="breadcrumbs">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        @foreach ($paths as $path)
        <li class="breadcrumb-item
                    {{ $loop->last ? 'active' : '' }}">
            <a href="{{ url($path) }}">
                {{ str_replace('-', ' ', $path) }}
            </a>
        </li>
        @endforeach
    </ol>
</nav>