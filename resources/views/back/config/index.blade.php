@extends('back.layouts.master')
@section('title', 'Website Configurations')
@section('content')

  <div class="card shadow">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold float-left text-primary">Current Configurations</h6>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('config.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" required class="form-control" name="title" value="{{ $config->title }}">
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
              <label for="title">Status</label>
              <select class="form-control" name="status">
                <option value="1" @if ($config->status == 1) selected @endif>Active</option>
                <option value="0" @if ($config->status == 0) selected @endif>Deactive</option>
              </select>
           </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="logo">Logo</label>
            <input type="file" class="form-control" name="logo" value="">
          </div>
          <div class="col-md-6">
            <label for="favicon">Favicon</label>
            <input type="file" class="form-control" name="favicon" value="">
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <label for="fb">Facebook</label>
            <input type="text" class="form-control" name="fb" value="{{ $config->fb }}">
          </div>
          <div class="col-md-6">
            <label for="ig">Instagram</label>
            <input type="text" class="form-control" name="ig" value="{{ $config->ig }}">
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <label for="tw">Twitter</label>
            <input type="text" class="form-control" name="tw" value="{{ $config->tw }}">
          </div>
          <div class="col-md-6">
            <label for="gh">Github</label>
            <input type="text" class="form-control" name="gh" value="{{ $config->gh }}">
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <label for="li">Linkedin</label>
            <input type="text" class="form-control" name="li" value="{{ $config->li }}">
          </div>
          <div class="col-md-6">
            <label for="yt">Youtube</label>
            <input type="text" class="form-control" name="yt" value="{{ $config->yt }}">
          </div>
        </div>
        <div class="form-group mt-3">
          <button type="submit" class="btn btn-block btn-md btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
@endsection





