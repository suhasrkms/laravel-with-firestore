

@extends('layouts.app')

@section('content')

  {{-- Error and Status Card --}}

  @if(Session::has('message'))
    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
      <strong>{{ Session::get('message') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  @if ($errors->any())
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
        <strong>{{$error}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endforeach
  @endif


  <div class="container">
    <div class="row">
      {{-- Uplode form and picture  --}}
      <div class="col-lg-6">
        <div class="card shadow rounded">
          <div class="card-body">
            <h3 class="text-primary">Upload</h3><br>
            {!! Form::open(['action' => 'App\Http\Controllers\CrudController@store', 'method' => 'POST']) !!}

            <div class="form-group">
              {!! Form::label('first_name', 'First Name') !!}
              {!! Form::text('first_name', null, ['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
              {!! Form::label('last_name', 'Last Name') !!}
              {!! Form::text('last_name', null, ['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
              {!! Form::label('age', 'Age') !!}
              {!! Form::number('age', null, ['class'=>'form-control col-4'])!!}
            </div>

            <div class="form-group">
              {!! Form::submit('Upload', ['class'=>'btn btn-primary']) !!}
            </div>

          </div>
        </div>
      </div>
      <div class="col-lg-6 pt-lg-0 pt-3">
        <div class="card shadow rounded">
          <div class="card-body">
            <h3 class="text-primary">Get Data from Firebase Firestore.</h3>

            <div class="form-group">
              {!! Form::label('doc_id', 'Document Id') !!}
              {!! Form::text('doc_id', null, ['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
              {!! Form::submit('Get Data', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
</div>


@endsection()
