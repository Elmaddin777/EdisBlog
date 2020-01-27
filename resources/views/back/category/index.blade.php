@extends('back.layouts.master')
@section('title', 'Categories')
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
  <div class="row">
    <div class="card mb-4 shadow col-md-4 mr-5 ml-4" style="height:20%;">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold float-left text-primary">Insert: Category</h6>
      </div>
      <div class="card-body">
        <form action="{{ route('categories.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="title">New Category:</label>
            <input type="text" name="category" class="form-control" required>
          </div>
          <div class="form-group">
            <button type="submit" name="button" class="btn btn-primary btn-block">Create Category</button>
          </div>
        </form>
      </div>
    </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4 col-md-7">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold float-left text-primary">Table: Categories</h6>
      <h6 class="m-0 font-weight-bold float-right text-primary"><strong ><u>{{ $categories->count() }}</u></strong> data found</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Category Name</th>
              <th>Number of Articles</th>
              <th>Status</th>
              <th>Operations</th>
            </tr>
          </thead>
          <tbody>
        
          @foreach ($categories as $category)
            <tr>
              <td>{{ $category->name }}</td>
              <td>{{ $category->getArticleCount() }}</td>
              <td> 
                <input type="checkbox" id="{{ $category->id }}" class="status" data-on="Active" data-off="Deactive" data-onstyle="success"  data-offstyle="danger" data-toggle="toggle" @if ($category->status == 1)  checked @endif >
              </td> 
              <td>
                {{-- <a href="#" target="_blank" title="Show" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a> --}}
                <a title="Edit Category" id="{{ $category->id }}" class="btn btn-sm btn-primary edit"><i class="fa fa-edit text-white"></i></a>
                <a title="Delete Category" cat-name = "{{ $category->name }}" id="{{ $category->id }}" article-count="{{ $category->getArticleCount() }}" class="btn btn-sm btn-danger delete"><i class="fa fa-times text-white"></i></a>

                
              </td>
            </tr>
          @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!--Edit Modal-->

<div class="modal" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('category.update') }}" >
          @csrf
          <div class="form-group">
            <label for="title">Category Name :</label>
            <input type="text" name="category" class="form-control" id="modalCategoryName" required>
            <input type="hidden" name="id" id="hidden_id">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!--Delete Modal-->

<div class="modal" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="mb-3" id="cat_id">Delete <span id="cat">{{-- Chosen category name --}}</span> ? </div>
        <div><span id="categoryNumDanger">{{-- Num of article of the chosen category --}}</span></div>

      </div>  
      <div id="modal-footer" class="modal-footer">
        <form method="POST" action="{{ route('category.delete.cat') }}" >
          @csrf
          <input type="hidden" name="hidden_cat_id" id = "hidden-cat-id" value="">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>    
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
    
      $(".delete").click(function(){
        var id = $(this)[0].getAttribute('id');
        var article_count = $(this)[0].getAttribute('article-count');
        var cat_name = $(this)[0].getAttribute('cat-name');
  
            $("#deleteModal").modal();
            $("#cat").html(cat_name);
            
            // Reset variables inside if
            $("#categoryNumDanger").html("");
            $("#categoryNumDanger").removeClass();
            $("#modal-footer").show();
            $("#cat_id").hide();
            
            // Make deleting 'general' category unavailable
            if (id == 1) {
              $("#modal-footer").hide();
              $("#cat_id").hide();
            
              $("#categoryNumDanger").html(cat_name+" category can not be deleted. It holds articles that do not have category.");
            }
            
            // Warning for categories with articles
            if(article_count>0 && id != 1){
              $("#categoryNumDanger").addClass('alert alert-danger');
              $("#categoryNumDanger").html(article_count+" articles found for this category. You want to delete this ?");
            }
            
            // Fill hidden input
            $("#hidden-cat-id").val(id);
      });
      
      
      $(".edit").click(function(){
        var id = $(this)[0].getAttribute('id');
        // Fetch data by id with get method
        $.get("{{route('category.get.data')}}", { id:id} , function( data ) {
            console.log(data);
            $("#editModal").modal();
            $("#modalCategoryName").val(data.name);
            $("#hidden_id").val(data.id);
        });
        
      });

      $(".status").change(function(){
        var id = $(this)[0].getAttribute('id');
        var state = $(this).prop('checked');
        
        $.get("{{route('category.switch')}}", { id:id, state:state } ,function( data, status ) {
            console.log(state);
        });
      }) 
    })        
  </script>
@endsection




