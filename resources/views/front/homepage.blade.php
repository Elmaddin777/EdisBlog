@extends('front.layouts.master')
@section('title')

@section('content')
  <div class="col-md-9 mx-auto">
  <!-- List of articles -->
    @include('front.widgets.article_list_widget')
  </div>
  
  @include('front.widgets.category_widget')
@endsection






