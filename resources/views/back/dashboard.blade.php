@extends('back.layouts.master')
@section('content')
          <!-- Content Row -->
          <div class="row" style="margin-bottom:15%;">
            
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Website Status</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            @if ($website_status->status == 1)
                              Active
                            @else
                              Deactive
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      @if ($website_status->status == 1)
                        <i class="fas fa-check fa-2x text-gray-300"></i>
                      @else
                        <i class="fas fa-ban fa-2x text-gray-300"></i>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Articles</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$article_count}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Views of Articles</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$view_count}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-eye fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Messages</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$contact_contact}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-envelope-open-text fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="m-auto mt-3">
              <img src="{{ asset('admin/'.$config->logo) }}" alt="" width="300" />
            </div>
            
          </div>
          
          

        
@endsection