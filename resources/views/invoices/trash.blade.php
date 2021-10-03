@extends('layouts.master')

@section('css')
  <!-- Internal Data table css -->
  <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Trashed
          Invoices</span>
      </div>
    </div>
  </div>
  <!-- breadcrumb -->
@endsection

@section('content')
  <!-- row -->
  <div class="row">
    <div class="col-xl-12">
      @if (session('message'))
        <div class="alert alert-success" role="alert">
          <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
          </button>
          <span>{{ session('message') }}</span>
        </div>
      @endif
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title mg-b-0">Invoices Table</h4>
						<a class="btn btn-primary btn-icon" href="{{ route('invoices.index') }}">
                <i class="fas fa-chevron-left"></i>
              </a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table text-md-nowrap key-buttons" id="example">
              <thead>
                <tr>
                  <th class="wd-15p border-bottom-0">#</th>
                  <th class="wd-15p border-bottom-0">Invoice Number</th>
                  <th class="wd-25p border-bottom-0">Status</th>
                  <th class="wd-25p border-bottom-0">User</th>
                  <th class="wd-25p border-bottom-0">Invoice Date</th>
                  <th class="wd-25p border-bottom-0">Due Date</th>
                  <th class="wd-25p border-bottom-0">Payment Date</th>
                  <th class="wd-25p border-bottom-0">Total</th>
                  <th class="wd-25p border-bottom-0">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($trashedInvoices as $invoice)
                  <tr>
                    <td class="wd-15p border-bottom-0">{{ $invoice->id }}</td>
                    <td class="wd-15p border-bottom-0">{{ $invoice->invoice_number }}</td>
                    <td class="wd-25p border-bottom-0">
                      @if ($invoice->status == 1)
                        <span class="text-danger">
                          {{ App\Models\Invoice::STATUS[$invoice->status] }}
                        </span>
                      @elseif ($invoice->status == 2)
                        <span class="text-info">
                          {{ App\Models\Invoice::STATUS[$invoice->status] }}
                        </span>
                      @else
                        <span class="text-success">
                          {{ App\Models\Invoice::STATUS[$invoice->status] }}
                        </span>
                      @endif
                    </td>
                    <td class="wd-25p border-bottom-0">{{ $invoice->user->name }}</td>
                    <td class="wd-25p border-bottom-0">{{ $invoice->invoice_date }}</td>
                    <td class="wd-25p border-bottom-0">{{ $invoice->due_date }}</td>
                    <td class="wd-25p border-bottom-0">{{ $invoice->payment_date }}</td>
                    <td class="wd-25p border-bottom-0">{{ $invoice->total }}</td>
                    <td class="wd-25p border-bottom-0">
                      <div class="btn-icon-list">
                        <form action="{{ route('invoices.restore', $invoice->id) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-success btn-icon ml-2">
                            <i class="fas fa-undo-alt"></i>
                          </button>
                        </form>
                        <form action="{{ route('invoices.permanent-delete', $invoice->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-icon">
                            <i class="typcn typcn-document-delete"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div><!-- bd -->
      </div><!-- bd -->
    </div>
  </div>
  <!-- row closed -->
  </div>
  <!-- Container closed -->
  </div>
  <!-- main-content closed -->
@endsection

@section('js')
  <!-- Internal Data tables -->
  <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
  <!--Internal  Datatable js -->
  <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
@endsection
