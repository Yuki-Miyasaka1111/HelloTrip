@if(session('success'))
    <div class="c-flash c-flash--success">
        {{ session('success') }}
    </div>
@endif