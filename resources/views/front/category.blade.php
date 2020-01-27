@extends('front.layouts.master')
@section('title', $category->name.' | '.$count.' articles found')

@section('content')
  <div class="col-md-10 mx-auto">
    <!-- Check no article case -->
    @if (!(count($articles) > 0))
        <div class="alert alert-danger m-5 text-center"><h2>No available blog for this category ):</h2></div>
    @endif
    <!-- List of articles -->
    @include('front.widgets.article_list_widget')
        
  </div>
  @include('front.widgets.category_widget')
@endsection






