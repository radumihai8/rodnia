<div class="col-lg-10">
    <div class="item-grid">


        @foreach($items->chunk(3) as $chunk)
            <div class="row items-row row-cols-3">
                @foreach($chunk as $item)
                    @include('components.item', ['item' => $item])
                @endforeach
            </div>
        @endforeach
    </div>
</div>
