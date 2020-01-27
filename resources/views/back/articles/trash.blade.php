@extends('back.layouts.master')
@section('title', 'Articles')
@section('content')
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold float-left text-primary">Table: Articles(deleted)</h6>
      <h6 class="m-0 font-weight-bold float-right text-primary"><strong><u>{{ $articles->count() }}</u></strong> data found</h6>
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
                <a href="{{ route('trash.restore', $article->id) }}" title="Restore Article" class="btn btn-sm btn-success"><i class="fa fa-recycle"></i></a>
                <a href="{{ route('trash.delete', $article->id) }}" title="Delete Permanently"  class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
              </td>
            </tr>
          @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection






