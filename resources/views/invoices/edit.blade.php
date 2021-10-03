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
        <div class="alert alert-danger" role="alert">
          <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
          </button>
          <span>Invoice not updated</span>
        </div>
      @endif
      <div class="card  box-shadow-0 ">
        <div class="card-header">
          <h4 class="card-title mb-1">Edit Invoice</h4>
        </div>
        <div class="card-body pt-0">
          <form action="{{ route('invoices.update', $invoice) }}" method="POST" enctype="multipart/form-data">
            @csrf
						@method('PUT')

            <div class=" row row-sm">
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Invoice Number</span>
                  </div>
                  <input class="form-control @error('invoice_number')is-invalid @enderror" type="text" name="invoice_number" value="{{ old('invoice_number') ?? $invoice->invoice_number }}" required>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Section</span>
                  </div>
                  <select id="section" name="section_id" class="form-control select2-no-search @error('section')is-invalid @enderror" required>
                    <option label="Choose one">
                    </option>
                    @foreach ($sections as $section)
                      <option value="{{ $section->id }}" {{ $section->id == $invoice->section_id ? 'selected' : '' }}> {{ Str::ucfirst($section->section_name) }} </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Product</span>
                  </div>
                  <select id="product" name="product[]" class="form-control select2 @error('product')is-invalid @enderror" multiple>
										@foreach (App\Models\Section::find($invoice->section_id)->products as $product)
											<option value="{{ $product->id }}" {{ $invoice->products->contains($product) ? 'selected' : '' }}>
												{{ $product->product_name }}
											</option>
										@endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row row-sm">
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Collection Amount</span>
                  </div>
                  <input class="form-control @error('collection_amount')is-invalid @enderror" placeholder="" type="number" min="0" name="collection_amount" required value="{{ old('collection_amount') ?? $invoice->collection_amount }}">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Commission percent</span>
                  </div>
                  <input class="form-control @error('commission_percent')is-invalid @enderror" placeholder="" type="number" min="0" max="100" name="commission_percent" required value="{{ old('commission_percent') ?? $invoice->commission_percent }}">
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Commission Amount</span>
                  </div>
                  <input class="form-control @error('commission_amount')is-invalid @enderror" placeholder="" type="number" min="0" name="commission_amount" readonly required value="{{ old('commission_amount') ?? $invoice->commission_amount }}">
                </div>
              </div>
            </div>

            <div class="row row-sm">
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Discount</span>
                  </div>
                  <input class="form-control @error('discount')is-invalid @enderror" type="number" min="0" max="100" name="discount" required value="{{ old('discount') ?? $invoice->discount }}">
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rate Vat</span>
                  </div>
                  <input class="form-control @error('rate_vat')is-invalid @enderror" type="number" min="0" max="100" name="rate_vat" required value="{{ old('rate_vat') ?? $invoice->rate_vat }}">
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Value Vat</span>
                  </div>
                  <input class="form-control @error('value_vat')is-invalid @enderror" type="number" min="0" name="value_vat" readonly required value="{{ old('value_vat') ?? $invoice->value_vat }}">
                </div>
              </div>
            </div>

            <div class="row row-sm">
              <div class="input-group col-4 mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Total</span>
                </div>
                <input class="form-control @error('total')is-invalid @enderror" type="number" min="0" name="total" readonly required value="{{ old('total') ?? $invoice->total }}">
              </div>
							<div class="input-group col-md-4 mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Invoice Date</span>
                </div>
                <input class="form-control @error('invoice_date')is-invalid @enderror" placeholder="YYY-MM-DD" type="date" name="invoice_date" required value="{{ old('invoice_date') ?? $invoice->invoice_date }}">
              </div>
              <div class="input-group col-md-4 mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Due Date</span>
                </div>
                <input class="form-control @error('due_date')is-invalid @enderror" placeholder="YYY-MM-DD" type="date" name="due_date" value="{{ old('due_date') ?? $invoice->due_date }}">
              </div>
            </div>

            {{-- <div class="row row-sm">
							<div class="input-group col-md-4 mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Payment Date</span>
                </div>
                <input class="form-control @error('payment_date')is-invalid @enderror" placeholder="YYY-MM-DD" type="date" name="payment_date" value="{{ old('payment_date') ?? $invoice->payment_date }}">
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Status</span>
                  </div>
                  <select name="status" class="form-control select2-no-search @error('status')is-invalid @enderror" required>
                    <option label="Choose one">
                    </option>
                    @foreach (App\Models\Invoice::STATUS as $key => $value)
                      <option value="{{ $key }}" {{ $key == old('status') ? 'selected' : ($key == $invoice->status ? 'selected' : '') }}> {{ Str::ucfirst($value) }} </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div> --}}

            <div class="row row-sm">
              <div class="col-12">
                <textarea class="form-control  @error('note')is-invalid @enderror" placeholder="Note" rows="2" name="note">{{ old('note') ?? $invoice->note }}</textarea>
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
      $('select[id="section"]').on('change', function() {
        var sectionId = $(this).val();
        if (sectionId) {
          $.ajax({
            url: "{{ URL::to('section') }}/" + sectionId,
            type: "GET",
            dataType: "json",
            success: function(data) {
              $('select[id="product"]').empty();
              $('select[id="product"]').prop('disabled', false);
              $.each(data, function(key, value) {
                $('select[id="product"]').append(`<option value="${key}">${value}</option>`);
              });
            },
          });
        } else {
          console.log('AJAX load failed');
        }
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      var total = 0;

      var collection_amount = 0;
      var commission_percent = 0;
      var commission_amount = 0;

      $('input[name="collection_amount"]').on('input', function() {
        collection_amount = $(this).val();
        commission_amount = collection_amount * commission_percent / 100;

        total = commission_amount;

				parseFloat($('input[name="commission_amount"]').val(commission_amount)).toFixed(2);

        parseFloat($('input[name="total"]').val(total).toFixed(2));
      });

      $('input[name="commission_percent"]').on('input', function() {
        commission_percent = $(this).val();
        commission_amount = collection_amount * commission_percent / 100;

        total = commission_amount;

        parseFloat($('input[name="commission_amount"]').val(commission_amount)).toFixed(2);

        parseFloat($('input[name="total"]').val(total)).toFixed(2);
      });

      var discount_percent = 0;
      var discount_amount = 0;
      var rate_vat = 0;
      var value_vat = 0;

      $('input[name="discount"]').on('input', function() {
        discount_percent = $(this).val();
        discount_amount = commission_amount * discount_percent / 100;
        value_vat = (commission_amount - discount_amount) * rate_vat / 100;
        total = commission_amount - discount_amount + value_vat;

        parseFloat($('input[name="value_vat"]').val(value_vat)).toFixed(2);

        parseFloat($('input[name="total"]').val(total)).toFixed(2);
      });

      $('input[name="rate_vat"]').on('input', function() {
        rate_vat = $(this).val();
        discount_amount = commission_amount * discount_percent / 100;
        value_vat = (commission_amount - discount_amount) * rate_vat / 100;
        total = commission_amount - discount_amount + value_vat;

        parseFloat($('input[name="value_vat"]').val(value_vat)).toFixed(2);

        parseFloat($('input[name="total"]').val(total)).toFixed(2);
      });

    });
  </script>
@endsection
