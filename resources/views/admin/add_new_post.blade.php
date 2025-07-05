@extends('layouts.admin_content')

@section('title' , $title)


{{-- From Section Extends from Admin Layout --}}

@section('form')
  {{-- Code To Display Error when a post already Exits --}}
  @if(session('error'))
      <div class="alert alert-danger" id="danger-message" style="width: 70rem">
        {{ session('error') }}
      </div>
      <script>
        setTimeout(function() {
            document.getElementById('danger-message').style.display = 'none';
        }, 4000);
      </script>
  @endif
  
  

  {{-- Form For Adding New Post --}}
  <div style="width: 70rem">
    <form action="{{$url}}" method="POST" enctype="multipart/form-data">


      @csrf
      {{-- Title Input --}}
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="{{$post->title ?? old('title')}}">
        <span class="text-danger">
          @error('title')
              {{$message}}
          @enderror
        </span>
      </div>

      {{-- Body Input --}}
      <div class="form-group">
        <label for="body">Body Text:</label>
        <textarea class="form-control" name="body" id="body" rows="3" placeholder="Enter body text">{{$post->body ?? old('body')}}</textarea>
        <span class="text-danger">
          @error('body')
              {{$message}}
          @enderror
        </span>
      </div>


      {{-- Image Input --}}
      <div class="form-group">
        <label for="file">Choose Image:</label>
        <input type="file" name="image" class="form-control-file" id="file">
        <span class="text-danger">
          @error('image')
              {{$message}}
          @enderror
        </span>
        @if(isset($post))
        <p>Previous Image: {{$post->image}}</p>
        @else
        {{null}}
        @endif
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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