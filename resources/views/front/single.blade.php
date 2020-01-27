@extends('front.layouts.master')
@section('title', $articles->title)
@section('bg',  asset('admin').'/'.$articles->image )

@section('content')
  <!-- Post Content -->
    <div class="col-md-9 mx-auto">
      {!! $articles->content !!}
      <span class="text-danger mt-2 float-right text-underline">
        <b><u>{{ $articles->hit  }}</u> people read this article. </b> 
      </span>
    </div>
    @include('front.widgets.category_widget')
@endsection






    