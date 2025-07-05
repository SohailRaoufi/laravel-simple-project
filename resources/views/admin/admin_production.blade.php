@extends('layouts.admin_content')

@section('main-content')
@section('title' , 'Production')
  @section('button')
  <div class="button-post">
    <a href="" style="text-decoration-line: none">
      <button type="button" class="btn btn-success">
        <span><img src="{{asset('assets/img/admin-page-icons/plus.svg')}}" alt="plus-icon"></span>
        <span style="margin-right:0.1rem">Add post</span>
      </button>
    </a>
  </div>
  @endsection
  @section('data')
      <div class="d-flex justify-content-center align-items-center h-50" style="margin-left: 50%">
        <h6 class="text-center">No Post!</h6>
      </div>  
    @endsection
@endsection