@isset($categories)
  <div class="col-md-2">
    <ul class="list-group list-group-flush">
      @foreach($categories as $category)
        <li class="list-group-item">
          <a @if (Request::segment(2) == $category->slug) class="text-danger disabled"  onclick="return false;"  @else href=" {{ route('category', $category->slug) }} " @endif>{{ $category->name }} 
          <small><span class="badge badge-secondary">{{ $category->getArticleCount() }}</span></small></a></li>
      @endforeach
    </ul>
  </div>
@endif