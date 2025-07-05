@extends('layouts.admin_content')

@section('main-content')
    @section('title' , 'Admins')
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
        @elseif (session('error'))
            <div class="alert alert-danger" id="error-message" style="width: 70rem">
              {{ session('error')}}
            </div>
            <script>
              setTimeout(function() {
                  document.getElementById('error-message').style.display = 'none';
              }, 4000);
            </script>
        @endif

        {{-- Button For Adding New Post --}}
        <div class="button-post" style="width: 8.5rem">
          <a href="{{url('/user/admin/admins/newadmin')}}" style="text-decoration-line: none">
          <button type="button" class="btn btn-success">
            <span><img src="{{asset('assets/img/admin-page-icons/plus.svg')}}" alt="plus-icon"></span>
            <span style="margin-right:0.1rem">Add Admin</span>
          </button>
        </a>
        </div>
    @endsection


     {{-- Code From Posts From Database In a Table --}}
  @if(count($user) > 0)
     @section('table-show')
       <div class="table-container">
         <table class="table table-hover">
           <thead>
             <tr>
               <th scope="col">No</th>
               <th scope="col">Name</th>
               <th scope="col">Email</th>
               <th scope="col">Role</th>
               <th></th>
             </tr>
           </thead>
           <tbody>
             @foreach ($user as $key => $admin)
               <tr>
                 <td scope="row">{{$key + 1}}</td>
                 <td>{{$admin->name}}</td>
                 <td>{{$admin->email}}</td>
                 <td>{{$admin->role}}</td>
                 <td>
                   <div class="btn-container">
                   <a href="{{ route('admins.edit', ['id' => $admin->id]) }}"><img src="{{asset('assets/img/admin-page-icons/edit_icon.svg')}}" alt="edit"></a>
                   <form action="{{ route('admins.destroy', ['id' => $admin->id]) }}" method="POST">
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
         <h6 class="text-center">No Admin!</h6>
         {{md5('1234')}}
       </div>  
     @endsection
 @endif



@endsection