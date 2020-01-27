@extends('back.layouts.master')
@section('title', 'Update Article')
@section('content')
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>      
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach      
    </ul>
  </div>
  @endif
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold float-left text-primary">Update: Article</h6>
    </div>
    <div class="card-body">
      <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
          <label for="title">Article Title:</label>
          <input type="text" name="title" value="{{ $article->title }}" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="category">Article Category:</label>
          <select name="category" class="form-control" value="{{ $article->getCategory->name }}">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                  @if ($article->category_id == $category->id)
                    selected
                  @endif>{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="image">Article Image:</label><br>
          <img src="{{ asset('admin/'.$article->image) }}" alt="):" class="rounded" width="300">
          <input type="file" name="article_image" class="form-control">
        </div>
        <div class="form-group">
          <label for="content">Article Content:</label>
          <textarea name="content" rows="8" cols="80" class="form-control" id="summernote">
            {!! $article->content !!}
          </textarea>
        </div>
        <div class="form-group">
          <button type="submit" name="button" class="btn btn-primary btn-block">Update Article</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#summernote').summernote({
          height: 300
        });
      });
    </script>
@endsection






