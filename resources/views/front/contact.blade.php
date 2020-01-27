@extends('front.layouts.master')
@section('title', 'Contact Me')
@section('bg',  'https://blackrockdigital.github.io/startbootstrap-clean-blog/img/contact-bg.jpg')

@section('content')  
    <!-- Main Content -->
        <div class="col-lg-8 col-md-10 mx-auto">
        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif 
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible</p>
         
          <form method="POST" action="{{ route('contactPost') }}">
            @csrf
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Name</label>
                <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Name" id="name" required>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Email Address</label>
                <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email Address" id="email" required>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Topic</label>
                <input type="text" class="form-control" value="{{ old('topic') }}" name="topic" placeholder="Topic" id="topic" required>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Message</label>
                <textarea rows="5" class="form-control" value="{{ old('message') }}" name="message" placeholder="Message" id="message" required></textarea>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
            </div>
          </form>
        </div>
    <hr>
@endsection










    