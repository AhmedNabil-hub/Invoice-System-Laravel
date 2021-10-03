@extends('layouts.master')

@section('css')
  <!-- Internal Select2 css -->
  <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Edit
          User</span>
      </div>
    </div>
  </div>
  <!-- breadcrumb -->
@endsection

@section('content')
  <!-- row -->
  <div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
          </button>
          <span>User not updated</span>
        </div>
      @endif
      <div class="card  box-shadow-0 ">
        <div class="card-header">
          <h4 class="card-title mb-1">Edit User</h4>
        </div>
        <div class="card-body pt-0">
          <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
						@method('PUT')

            <div class=" row row-sm">
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                  </div>
                  <input class="form-control @error('name')is-invalid @enderror" type="text" name="name" value="{{ old('name') ?? $user->name }}" required>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Email</span>
                  </div>
                  <input class="form-control @error('email')is-invalid @enderror" type="email" name="email" value="{{ old('email') ?? $user->email }}" required>
                </div>
              </div>
            </div>

            <div class="row row-sm">
							<div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Role</span>
                  </div>
                  <select name="role" class="form-control select2-no-search @error('role')is-invalid @enderror" required>
                    <option label="Choose one">
                    </option>
                    @foreach ($roles as $role)
                      <option value="{{ $role->id }}" {{ $role->id == old('role') ? 'selected' : ($user->roles->first()->id == $role->id ? 'selected' : '' ) }}>
												{{ Str::ucfirst($role->name) }}
											</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3 mb-0">Edit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- row closed -->
  </div>
  <!-- Container closed -->
  </div>
  <!-- main-content closed -->
@endsection

@section('js')
  <!--Internal  Datepicker js -->
  <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
  <!--Internal  jquery.maskedinput js -->
  <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
  <!--Internal  spectrum-colorpicker js -->
  <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
  <!-- Internal Select2.min js -->
  <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
  <!--Internal  jquery-simple-datetimepicker js -->
  <script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
  <!-- Ionicons js -->
  <script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
  <!--Internal  pickerjs js -->
  <script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
  <!-- Internal form-elements js -->
  <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
@endsection
