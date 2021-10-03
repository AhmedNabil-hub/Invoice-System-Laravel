@extends('layouts.master')
@section('css')
  <!--  Owl-carousel css-->
  <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
  <!-- Maps css -->
  <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="left-content">
      <div>
        <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">
          Hi <strong>{{ ucfirst(auth()->user()->name) }}</strong>, welcome back!
        </h2>
        <p class="mg-b-0">Invoice System dashboard.</p>
      </div>
    </div>
    <div class="main-dashboard-header-right">
      <div>
        <label class="tx-13">Customer Ratings</label>
        <div class="main-star">
          <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i
            class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i>
          <span>{{ $users_count }}</span>
        </div>
      </div>
    </div>
  </div>
  <!-- /breadcrumb -->
@endsection
@section('content')
  <!-- row -->
  <div class="row row-sm">
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
      <div class="card overflow-hidden sales-card bg-primary-gradient">
        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
          <div class="">
									<h6 class=" mb-3 tx-12 text-white">All invoices</h6>
          </div>
          <div class="pb-0 mt-0">
            <div class="d-flex">
              <div class="">
											<h4 class=" tx-20 font-weight-bold mb-1 text-white">
                {{ number_format($invoices_sum, 2) }}
                </h4>
                <span>Number of invoices: <strong>{{ $invoices_count }}</strong></span>
              </div>
            </div>
          </div>
        </div>
        <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
      <div class="card overflow-hidden sales-card bg-danger-gradient">
        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
          <div class="">
									<h6 class=" mb-3 tx-12 text-white">Paid invoices</h6>
          </div>
          <div class="pb-0 mt-0">
            <div class="d-flex">
              <div class="">
											<h4 class=" tx-20 font-weight-bold mb-1 text-white">
                {{ number_format($paid_invoices_sum, 2) }}
                </h4>
                <span>Number of invoices: <strong>{{ $paid_invoices_count }}</strong></span>
              </div>
              <span class="float-right my-auto mr-auto">
                <i class="fas fa-arrow-circle-down text-white mr-1"></i>
                <span class="text-white op-7">{{ round(($paid_invoices_sum / $invoices_sum) * 100, 2) }}%</span>
              </span>
            </div>
          </div>
        </div>
        <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
      <div class="card overflow-hidden sales-card bg-success-gradient">
        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
          <div class="">
									<h6 class=" mb-3 tx-12 text-white">Partially paid invoices</h6>
          </div>
          <div class="pb-0 mt-0">
            <div class="d-flex">
              <div class="">
											<h4 class=" tx-20 font-weight-bold mb-1 text-white">
                {{ number_format($partially_paid_invoices_sum, 2) }}
                </h4>
                <span>Number of invoices: <strong>{{ $partially_paid_invoices_count }}</strong></span>
              </div>
              <span class="float-right my-auto mr-auto">
                <i class="fas fa-arrow-circle-up text-white mr-1"></i>
                <span class="text-white op-7">{{ round(($partially_paid_invoices_sum / $invoices_sum) * 100, 2) }}%</span>
              </span>
            </div>
          </div>
        </div>
        <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
      <div class="card overflow-hidden sales-card bg-warning-gradient">
        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
          <div class="">
									<h6 class=" mb-3 tx-12 text-white">Unpaid invoices</h6>
          </div>
          <div class="pb-0 mt-0">
            <div class="d-flex">
              <div class="">
											<h4 class=" tx-20 font-weight-bold mb-1 text-white">
                {{ number_format($unpaid_invoices_sum, 2) }}
                </h4>
                <span>Number of invoices: <strong>{{ $unpaid_invoices_count }}</strong></span>
              </div>
              <span class="float-right my-auto mr-auto">
                <i class="fas fa-arrow-circle-down text-white mr-1"></i>
                <span class="text-white op-7">{{ round(($unpaid_invoices_sum / $invoices_sum) * 100, 2) }}%</span>
              </span>
            </div>
          </div>
        </div>
        <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
      </div>
    </div>
  </div>
  <!-- row closed -->



  <!-- row opened -->
  <div class="row row-sm">
    <div class="col-xl-6 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header pb-1">
          <h3 class="card-title mb-2">Recent Invoices</h3>
          <p class="tx-12 mb-0 text-muted">An invoice is an individual or business that purchases the goods service has
            evolved to include real-time</p>
        </div>
        @foreach ($recent_invoices as $invoice)
          <div class="card-body p-0 customers mt-1">
            <div class="list-group list-lg-group list-group-flush">
              <div class="list-group-item list-group-item-action" href="#">
                <div class="media mt-0">
									<div class="media-body">
										<div class="d-flex align-items-start">
											<i class="fas fa-file-alt mr-2"></i>
											<div class="mt-0">
                        <h5 class="mb-1 tx-15">{{ $invoice->invoice_number }}</h5>
                        <p class="mb-0 tx-13 text-muted">
													Section: {{ ucfirst($invoice->section->section_name) }} <span class="text-success ml-2">{{ ucfirst(\App\Models\Invoice::STATUS[$invoice->status]) }}</span>
												</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <div class="col-xl-6 col-md-12 col-lg-6">
      <div class="card">
        <div class="card-header pb-1">
          <h3 class="card-title mb-2">System Activity</h3>
          <p class="tx-12 mb-0 text-muted">System activities are the tactics that salespeople use to achieve their goals
            and objective</p>
        </div>
        <div class="product-timeline card-body pt-2 mt-1">
          <ul class="timeline-1 pb-1">
            <li class="mt-0"> <i class="ti-pie-chart bg-primary-gradient text-white product-icon"></i> <span
                class="font-weight-semibold mb-4 tx-14 ">Total Users</span>
              <p class="mb-0 text-muted tx-12">{{ $users_count }}</p>
            </li>
            <li class="mt-0"> <i class="mdi mdi-cart-outline bg-danger-gradient text-white product-icon"></i>
              <span class="font-weight-semibold mb-4 tx-14 ">Total Products</span>
              <p class="mb-0 text-muted tx-12">{{ $products_count }}</p>
            </li>
            <li class="mt-0"> <i class="ti-bar-chart-alt bg-success-gradient text-white product-icon"></i> <span
                class="font-weight-semibold mb-4 tx-14 ">Toatal Sections</span>
              <p class="mb-0 text-muted tx-12">{{ $sections_count }}</p>
            </li>
            <li class="mt-0"> <i class="ti-wallet bg-warning-gradient text-white product-icon"></i> <span
                class="font-weight-semibold mb-4 tx-14 ">Toatal Invoices</span>
              <p class="mb-0 text-muted tx-12">{{ $invoices_count }}</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Container closed -->
@endsection
@section('js')
  <!--Internal  Chart.bundle js -->
  <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
  <!-- Moment js -->
  <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
  <!--Internal  Flot js-->
  <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
  <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
  <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
  <!--Internal Apexchart js-->
  <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
  <!-- Internal Map -->
  <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
  <!--Internal  index js -->
  <script src="{{ URL::asset('assets/js/index.js') }}"></script>
  <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
@endsection
