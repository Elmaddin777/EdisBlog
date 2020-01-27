@extends('back.layouts.master')
@section('title', 'New Article')
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
      <h6 class="m-0 font-weight-bold float-left text-primary">Insert: Article</h6>
    </div>
    <div class="card-body">
      <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="title">Article Title:</label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="category">Article Category:</label>
          <select name="category" class="form-control">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="image">Article Image:</label>
          <input type="file" name="article_image" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="content">Article Content:</label>
          <textarea name="content" rows="8" cols="80" class="form-control" id="summernote"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" name="button" class="btn btn-primary btn-block">Create Article</button>
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






