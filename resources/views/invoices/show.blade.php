@extends('layouts.master')

@section('css')
@endsection

@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Invoice</span>
      </div>
    </div>
  </div>
  <!-- breadcrumb -->
@endsection

@section('content')
  <!-- row -->
  <div class="row row-sm">
    <div class="col-md-12 col-xl-12">
      <div id="invoice-content" class=" main-content-body-invoice">
        <div class="card card-invoice">
          <div class="card-body">
            <div class="invoice-header">
              <h1 class="invoice-title">Invoice</h1>
            </div><!-- invoice-header -->
            <div class="row mg-t-20">
              <div class="col-md">
                <label class="tx-gray-600">Billed To</label>
                <div class="billed-to">
                  <h6>{{ $invoice->user->name }}</h6>
                  <p>Email: {{ $invoice->user->email }}</p>
                </div>
              </div>
              <div class="col-md">
                <label class="tx-gray-600">Invoice Information</label>
                <p class="invoice-info-row">
									<span>Invoice Number</span>
                  <span>{{ $invoice->invoice_number }}</span>
                </p>
                <p class="invoice-info-row">
									<span>Invoice Date</span>
									<span>{{ $invoice->invoice_date }}</span>
								</p>
                <p class="invoice-info-row">
									<span>Due Date</span>
									<span>{{ $invoice->due_date }}</span>
								</p>
                <p class="invoice-info-row">
									<span>Section</span>
									<span>{{ Str::ucfirst($invoice->section->section_name) }}</span>
								</p>
              </div>
            </div>
            <div class="table-responsive mg-t-40">
              <table class="table table-invoice border text-md-nowrap mb-0">
                <thead>
                  <tr>
                    <th class="wd-20p">Product</th>
                    <th class="wd-40p">Description</th>
                  </tr>
                </thead>
                <tbody>
									@foreach ($invoice->products as $product)
										<tr>
											<td>{{ Str::ucfirst($product->product_name) }}</td>
											<td class="tx-12">{{ $product->description }}</td>
										</tr>
									@endforeach
                  <tr>
                    <td class="valign-middle" colspan="2" rowspan="4">
                      <div class="invoice-notes">
                        <label class="main-content-label tx-13">Details</label>
                        <p>Details</p>
                      </div>
                    </td>
                    <td class="tx-right">Collection Amount</td>
                    <td class="tx-right" colspan="2">${{ $invoice->collection_amount }}</td>
                  </tr>
                  <tr>
                    <td class="tx-right">Commision Amount ({{ $invoice->commission_percent }}%)</td>
                    <td class="tx-right" colspan="2">${{ $invoice->commission_amount }}</td>
                  </tr>
                  <tr>
                    <td class="tx-right">Discount</td>
                    <td class="tx-right" colspan="2">{{ $invoice->discount }}%</td>
                  </tr>
                  <tr>
                    <td class="tx-right">Rate Vat ({{ $invoice->rate_vat }}%)</td>
                    <td class="tx-right" colspan="2">${{ $invoice->value_vat }}</td>
                  </tr>
                  <tr>
                    <td class="tx-right tx-uppercase tx-bold tx-inverse">Total</td>
                    <td class="tx-right" colspan="2">
                      <h4 class="tx-primary tx-bold">${{ $invoice->total }}</h4>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <hr class="mg-b-40">
            <button id="print-button" class="btn btn-danger float-left mt-3 mr-2" type="button" onclick="printInvoice()">
              <i class="mdi mdi-printer ml-1"></i>Print
						</button>
          </div>
        </div>
      </div>
    </div><!-- COL-END -->
  </div>
  <!-- row closed -->
  </div>
  <!-- Container closed -->
  </div>
  <!-- main-content closed -->
@endsection

@section('js')
  <!--Internal  Chart.bundle js -->
  <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
	<script>
		function printInvoice() {
			document.getElementById('print-button').style.display = 'none';
			var invoiceContent = document.getElementById('invoice-content').innerHTML;

			document.body.innerHTML = invoiceContent;

			window.print();
			location.reload();
		}
	</script>
@endsection
