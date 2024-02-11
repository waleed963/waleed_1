@extends('app')
@section('content')

<div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{ strtoupper($title) }}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="@if( $title == 'edit user'){{ route('updateUser') }}@elseif($title == 'profile'){{ route('updateProfile') }}@else  {{ route('createUserPost') }} @endif" method="post">
                  @csrf
                  <input type="text" name="user_id" class="form-control" @isset($user) value="{{ $user->id }}" @endisset id="user_id" hidden>
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">{{__('words.Name')}}</label>
                    <input type="text" name="name" class="form-control" @isset($user) value="{{ $user->name }}" @endisset id="name" placeholder="{{__('words.enter_name')}}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">{{__('words.email_address')}}</label>
                    <input type="email"  name="email" @isset($user) value="{{$user->email}} " @endisset class="form-control" id="exampleInputEmail1" placeholder="{{__('words.enter_email_address')}}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('words.password') }}</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="{{ __('words.password') }}" @if($title == 'create user') required @endif>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{ __('words.submit') }}</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div>

@endsection