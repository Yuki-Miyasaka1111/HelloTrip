<section class="category-bar py-1 px-1 flex justify-between items-center bg-tertiary">
    @foreach($categories as $index => $category)
    <a href="{{ $category->slug }}">
        <img src="{{ asset('assets/img/icons/c-navigation_categoryBar'. sprintf('%02d', $index+1) .'.svg') }}" alt="">
        <p>{{ $category->name }}</p>
    </a>
    @endforeach
</section>