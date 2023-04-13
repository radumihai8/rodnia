@props(['news'])
<div class="news-section">
<div class="container p-5">
    <h1 class="mb-5">{{__('News')}}</h1>
        @admin
            <a class="btn btn-secondary d-block col-lg-6 m-auto mb-3" href="/news/create">{{__('New Article')}}</a>
        @endadmin
        <div class="news row">
            @forelse($news as $post)
                <article class="news-content">
                    <div class="title">
                        <div class="icon">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <h2 class="title-text">
                            <a href="/news/{{$post->id}}" target="_blank">
                                {{ $post->title }} <span class="updates">[Updates]</span>
                            </a>

                        </h2>
                        <span class="title-right">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="news-desc">
                        <p>
                            {!! Str::limit($post->content, 200)  !!}
                        </p>
                    </div>
                    <div class="news-btn">
                        <a class="button type1" target="_blank" href="/news/{{$post->id}}">
                            {{__('Read More')}}
                        </a>
                    </div>
                </article>
            @empty
                {{ __("Nothing to show here") }}
            @endforelse

        </div>
</div>
</div>
