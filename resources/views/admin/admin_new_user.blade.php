@extends('layouts.admin_content')

@section('main-content')
@section('title' , $title)


{{-- From Section Extends from Admin Layout --}}

@section('form')
 
  {{-- Form For Adding New Post --}}
  <div style="width: 30rem; margin-top:2rem">
    <form action="{{$url}}" method="POST" enctype="multipart/form-data">


      @csrf
      {{-- Name Input --}}
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{$admin->name ?? old('name')}}">
        <span class="text-danger">
          @error('name')
              {{$message}}
          @enderror
        </span>
      </div>

      {{-- Email Input --}}
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control" placeholder="Enter Email Address" value="{{$admin->email ?? old('email')}}">
        <span class="text-danger">
          @error('email')
              {{$message}}
          @enderror
        </span>
      </div>




      {{-- Password Input --}}
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" class="form-control" placeholder="Password" @if(isset($admin)) disabled @endif>
        <span class="text-danger">
          @error('password')
              {{$message}}
          @enderror
        </span>
      </div>


      {{-- Confirm Password Input --}}
      <div class="form-group">
        <label for="confirm password">Confirm Password:</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" @if(isset($admin)) disabled @endif>
        <span class="text-danger">
          @error('password_confirmation')
              {{$message}}
          @enderror
        </span>
      </div>


      {{-- Role Select --}}
      <div class="form-group">
        <label for="role">Select Role:</label>
        <select name="role" class="form-control">
          <option value="" selected>Select Role</option>
          <option value="owner" @if(isset($admin))  {{$admin->role == 'owner' ? 'selected': ''}} @endif>Owner</option>
          <option value="admin" @if(isset($admin))  {{$admin->role == 'admin' ? 'selected': ''}} @endif>Admin</option>
        </select>
        <span class="text-danger">
          @error('role')
            {{ $message }}
          @enderror
        </span>
        
      </div>
      <button type="submit" name="submit" class="btn btn-primary" style="margin-top:1rem ">Submit</button>
    </form>
  </div>


  


  {{-- Code to Disable the submit button after one click --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const submitButton = document.querySelector('button[type="submit"]');
      const form = document.querySelector('form');
  
      form.addEventListener('submit', function() {
        submitButton.disabled = true;
        submitButton.classList.add('disabled');
      });
    });
  </script>



@endsection
  
@endsection