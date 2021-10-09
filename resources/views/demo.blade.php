@extends('layouts.master')

@section('css')
  <!-- Internal Data table css -->
  <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
  <!--Internal   Notify -->
  <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection

@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">Sections</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ All
          Sections</span>
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
            <h4 class="card-title mg-b-0">Sections Table</h4>
            <a class="btn btn-primary btn-icon" href="{{ route('sections.create') }}">
              <i class="typcn typcn-document-add"></i>
            </a>
          </div>
					<form class="col-6" action="{{ route('api.demo') }}" method="get">
						<div class="input-group">
							<input class="form-control mr-3" type="search" name="search_filter" id="search-filter" placeholder="Search section name">
						</div>
					</form>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table text-md-nowrap key-buttons" id="example">
              <thead>
                <tr>
                  <th class="wd-15p border-bottom-0">#</th>
                  <th class="wd-15p border-bottom-0">Sections Name</th>
                  <th class="wd-15p border-bottom-0">Description</th>
                  <th class="wd-20p border-bottom-0">Created By</th>
                  <th class="wd-20p border-bottom-0">Actions</th>
                </tr>
              </thead>
              <tbody>
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
  <!--Internal  Notify js -->
  <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

	<script>
		$(document).ready(function() {
			function get_sections(sectionName = '') {
				$.ajax({
					url: `api/demo/?search_filter=${sectionName}`,
					type: "GET",
					dataType: "json",
					success: function(data) {
						$('tbody').empty();
						$.each(data['data'], function(index, section) {
							$('tbody').append(
								`<tr>
									<td class="wd-15p border-bottom-0">${section.id}</td>
									<td class="wd-15p border-bottom-0">${section.section_name}</td>
									<td class="wd-15p border-bottom-0">${section.description}</td>
									<td class="wd-20p border-bottom-0">${section.created_by}</td>
								</tr>`
							);
						});
					},
        });
			}

			get_sections();

      $('input[id="search-filter"]').on('input', function() {
        let sectionName = $(this).val();
				get_sections(sectionName);
      });
    });
	</script>
@endsection
