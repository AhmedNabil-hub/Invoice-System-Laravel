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
        <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Edit
          Invoice</span>
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
        {{-- <div class="alert alert-danger" role="alert">
          <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
          </button>
          <span>Invoice not updated</span>
        </div> --}}
        @foreach ($errors->all() as $error)
          <div class="alert alert-danger" role="alert">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
              <span aria-hidden="true">&times;</span>
            </button>
            <span>{{ $error }}</span>
          </div>
        @endforeach
      @endif
      <div class="card  box-shadow-0 ">
        <div class="card-header">
          <h4 class="card-title mb-1">Edit Invoice</h4>
        </div>
        <div class="card-body pt-0">
          <form action="{{ route('invoices.update-payment', $invoice) }}" method="POST">
            @csrf
            @method('PUT')

            <div class=" row row-sm">
              <div class="col-lg-4">
                <div class="input-group mb-5">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Invoice Number</span>
                  </div>
                  <input class="form-control" type="text" name="invoice_number" value="{{ $invoice->invoice_number }}"
                    readonly>
                </div>
              </div>
            </div>
            <div class="row row-sm">
              <div class="input-group col-md-4 mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">Invoice Date</span>
                </div>
                <input class="form-control" type="text" name="invoice_date" value="{{ $invoice->invoice_date }}"
                  readonly>
              </div>
              <div class="input-group col-md-4 mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">Due Date</span>
                </div>
                <input class="form-control" type="text" name="due_date" value="{{ $invoice->due_date }}" readonly>
              </div>
              <div class="input-group col-4 mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">Total</span>
                </div>
                <input class="form-control @error('total')is-invalid @enderror" type="number" min="0" name="total"
                  readonly required value="{{ old('total') ?? $invoice->total }}">
              </div>
            </div>

            <div class="row row-sm">
              <div class="input-group col-md-4 mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Payment Date</span>
                </div>
                <input class="form-control @error('payment_date')is-invalid @enderror" placeholder="YYY-MM-DD" type="date"
                  name="payment_date" value="{{ old('payment_date') ?? $invoice->payment_date }}">
              </div>

              <div class="input-group col-md-4 mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Payment Amount</span>
                </div>
                <input class="form-control @error('payment_amount')is-invalid @enderror" type="number" step="0.01" name="payment_amount" value="{{ old('payment_amount') ?? $invoice->payment_amount }}">
              </div>

              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Status</span>
                  </div>
                  <select name="status" class="form-control select2-no-search @error('status')is-invalid @enderror"
                    required>
                    <option label="Choose one">
                    </option>
                    @foreach (App\Models\Invoice::STATUS as $key => $value)
                      <option value="{{ $key }}"
                        {{ $key == old('status') ? 'selected' : ($key == $invoice->status ? 'selected' : '') }}>
                        {{ Str::ucfirst($value) }} </option>
                    @endforeach
                  </select>
                </div>
              </div>

							<div class="input-group col-md-4 mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Remainder</span>
                </div>
                <input class="form-control @error('remainder')is-invalid @enderror" type="number" step="0.01" name="remainder" readonly>
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

  <script>
    $(document).ready(function() {
      const total = $("input[name='total']").val();

      $('input[name="payment_amount"]').on('input', function() {
        parseFloat($('input[name="remainder"]').val(total - $(this).val())).toFixed(2);
      });
    });
  </script>
@endsection
