<div class="form-floating">
    <input type="{{$type}}" class="form-control" id="floatingInput" name="{{$name}}" placeholder="name@example.com" value="{{old($name)}}">
    <label for="floatingInput">{{$label}}</label>
    <span class="text-danger">
      @error($name)
          {{$message}}
      @enderror
    </span>
</div>