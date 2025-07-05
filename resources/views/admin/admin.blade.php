@extends('layouts.admin_content')


@section('main-content')
    @section('title' , 'News & Insights')
    @section('button')
     {{-- Code To Display Success Message when admin delete a post --}}
     @if(session('success'))
        <div class="alert alert-success" id="success-message" style="width: 70rem">
            {{ session('success') }}
        </div>
        <script>
          setTimeout(function() {
              document.getElementById('success-message').style.display = 'none';
          }, 4000);
        </script>
    @endif

    {{-- Button For Adding New Post --}}
    <div class="button-post">
      <a href="{{url('/user/admin/addnewpost')}}" style="text-decoration-line: none">
      <button type="button" class="btn btn-success">
        <span><img src="{{asset('assets/img/admin-page-icons/plus.svg')}}" alt="plus-icon"></span>
        <span style="margin-right:0.1rem">Add post</span>
      </button>
    </a>
    </div>
    @endsection
    
    {{-- Code From Posts From Database In a Table --}}
    @if(count($data) > 0)
        @section('table-show')
          <div class="table-container">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Title</th>
                  <th scope="col">Body</th>
                  <th scope="col">Added By</th>
                  <th scope="col">Image</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $post)
                  @php
                  $body = Illuminate\Support\Str::limit($post->body, 60);
                  $img = explode('/', $post->image)[1]
                  @endphp
                  <tr>
                    <td scope="row">{{$key + 1}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$body}}</td>
                    <td>{{$post->added_By}}</td>
                    <td>{{$img}}</td>
                    <td>
                      <div class="btn-container">
                      <a href="{{ route('posts.edit', ['id' => $post->id]) }}"><img src="{{asset('assets/img/admin-page-icons/edit_icon.svg')}}" alt="edit"></a>
                      <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"><img src="{{asset('assets/img/admin-page-icons/trash.svg')}}" alt="delete"></button>
                      </form>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          
        @endsection
    @else
      @section('data')
          <div class="d-flex justify-content-center align-items-center h-50" style="margin-left: 50%">
            <h6 class="text-center">No Post!</h6>
          </div>  
        @endsection
    @endif
    
@endsection
