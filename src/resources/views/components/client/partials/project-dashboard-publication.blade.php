@props(['class' => '', 'hotel'])

<div class="{{ $class }}">
    <div class="bg-primary d-flex flex-col justify-center height-full p-1">
        <div class="dashboard_publication_heading d-flex justify-between items-center">
            <p>本番環境</p>
            <span> @if($hotel->last_updated)最終更新日:{{ \Carbon\Carbon::parse($hotel->last_updated)->format('Y.m.d') }}@endif</span>
        </div>
        <form action="{{ route('project.hotel.publication', ['hotel_id' => $hotel->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="action" value="publish">
            <x-client.buttons.primary class="width-full py-0-5 mt-1 publication" data-id="{{ $hotel->id }}" data-action="publish" style="font-size:0.875rem;">
                データを更新する
            </x-client.buttons.primary>
        </form>

        <form action="{{ route('project.hotel.publication', ['hotel_id' => $hotel->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="action" value="unpublish">
            <x-client.buttons.primary class="width-full py-0-5 mt-1 publication" data-id="{{ $hotel->id }}" data-action="unpublish" bgColor="#a5a5a5" style="font-size:0.875rem;">
                データを非公開にする
            </x-client.buttons.primary>
        </form>
    </div>
</div>

<script>
document.querySelectorAll('.publication').forEach(function(button) {
    button.addEventListener('click', function() {
        var id = this.getAttribute('data-id');
        var action = this.getAttribute('data-action');

        axios.post('/hotel/' + id, {
            action: action,
            _token: '{{ csrf_token() }}'
        })
        .then(function(response) {
            // 成功時の処理
        })
        .catch(function(error) {
            // エラー時の処理
        });
    });
});
</script>