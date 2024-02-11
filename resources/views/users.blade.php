@extends('app')
@section('content')

<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-12">
      <a href="{{ route('createUser') }}" class="btn btn-success m-2">  {{ __('words.create_user')  }} </a>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ strtoupper($title) }}</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>{{ __('words.ID') }}</th>
                      <th>{{ __('words.Name') }}</th>
                      <th>{{ __('words.Email') }}</th>
                      <th>{{ __('words.Options') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                      <tr>
                        <td>{{ $loop->index + 1  }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a class="btn btn-secondary"  href="{{ route('editUser', $user->id) }}"> {{ __('words.Edit')   }}</a> <a class="btn btn-danger" data-toggle="modal" data-target="#Modal{{ $user->id }}"> {{ __('words.Delete')   }}</a></td>
                      </tr>

                      
                      <!-- Modal Delete -->
                      <div class="modal fade" id="Modal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Are you sure to delete  {{ $user->email }} ?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a type="button" class="btn btn-primary"  href="{{ route('dashboard.delete_user', $user->id) }}">Confirm</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
  </div>
  <!-- /.row -->
</div>


@endsection