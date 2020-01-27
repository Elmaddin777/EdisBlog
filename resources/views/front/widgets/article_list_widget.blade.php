@foreach ($articles as $article)
  <div class="post-preview">
    <a href="{{ route('single', [$article->getCategory->slug, $article->slug] ) }}">
      <h2 class="post-title">
        {{ $article->title }}
      </h2>
      <div class="mb-3">
        @if (Str::contains($article->image, 'htt'))
          <img src="{{$article->image }}" alt="):" width="820" height="500">
        @else
          <img src="{{asset('admin').'/'.$article->image }}" alt="):" width="820" height="500">
        @endif
      </div>
      <h3 class="post-subtitle">
        {{ strip_tags(str_limit($article->content, '80')) }}
      </h3>
    </a>
    <p class="post-meta">Category: 
      <a href="#">{{$article->getCategory->name}}</a>
        <span class="float-right">{{ $article->created_at->diffForHumans() }}</span></p>
  </div>
  @if(!$loop->last)
    <hr>
  @endif
@endforeach
<!-- Pager -->
<div class="clearfix">
  {{ $articles->links() }}
</div>