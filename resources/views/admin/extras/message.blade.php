@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
            <span>
              <b> Error - </b> {{ $error }}
            </span>
        </div>
    @endforeach
@endif

@if (session()->has('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
        <span>
              <b> Success - </b> {{ session('success') }}
        </span>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <span>
              <b> Error - </b> {{ session('error') }}
        </span>
    </div>
@endif
