@extends('back.layouts.master')
@section('title', 'Articles')
@section('content')
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold float-left text-primary">Table: Articles</h6>
      <h6 class="m-0 font-weight-bold float-right text-primary"><strong ><u>{{ $articles->count() }}</u></strong> data found</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Image</th>
              <th>Title</th>
              <th>Category</th>
              <th>Hit</th>
              <th>Creation Date</th>
              <th>Status</th>
              <th>Operations</th>
            </tr>
          </thead>
          <tbody>
        
          @foreach ($articles as $article)
            <tr>
              <td><img src="{{ $article->image }}" width="250" alt=""></td>
              <td>{{ $article->title }}</td>
              <td>{{ $article->getCategory->name }}</td>
              <td>{{ $article->hit }}</td>
              <td>{{ $article->created_at->diffForHumans()}}</td>
              <td> 
                {{-- {!! $article->status == 0 ? '<span class = "text-danger" >passive</span>' : '<span class = "text-success" >active</span>'  !!}  --}}
                <input type="checkbox" id="{{ $article->id }}" class="status" data-on="Active" data-off="Deactive" data-onstyle="success"  data-offstyle="danger" data-toggle="toggle" @if ($article->status == 1)  checked @endif >
              </td> 
              <td>
                <a href="{{ route('single', [ $article->getCategory->slug,  $article->slug]) }}" target="_blank" title="Show" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                <a href="{{ route('articles.edit', $article->id) }}" title="Edit" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                <form  action="{{ route('articles.destroy', $article->id) }}" method="post">
                  @csrf
                  @method('delete')
                  <button title="Delete" type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                </form>
                
              </td>
            </tr>
          @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('css')
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script>
    $(function(){
      $(".status").change(function(){
        var id = $(this)[0].getAttribute('id');
        var state = $(this).prop('checked');
        
        $.get("{{route('switch')}}", { id:id, state:state } ,function( data, status ) {
            console.log(state);
        });
      }) 
    })        
  </script>
@endsection




