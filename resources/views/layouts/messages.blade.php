@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as  $value)
            <p>{{ $value }}</p>
        @endforeach
    </div>
@endif
@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session('success') }}
    </div>
@endif
@if(Session::has('danger'))
    <div class="alert alert-danger" role="alert">
        {{ Session('danger') }}
    </div>
@endif
@if(Session::has('flash_message'))
    <script>
        swal("Great Job", "{{Session::get('flash_message')}}", "success");
    </script>
@endif
