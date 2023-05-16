@extends('layouts.app')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-xl-8 stretch-card grid-margin">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between flex-wrap mb-3">
						<div>
							<div class="card-title mb-0">Month Wise Collection</div>
							<span class="font-10 font-weight-semibold text-muted">{{ $data['lineChart']['dateFrom'].' - '.$data['lineChart']['dateTo'] }}</span>
						</div>
						<div>
							<div class="d-flex flex-wrap pt-2 justify-content-between sales-header-right">
								<div class="d-flex me-3 mt-2 mt-sm-0">
									<button type="button" class="btn btn-social-icon btn-outline-sales profit">
										<i class="mdi mdi-cash text-info"></i>
									</button>
									<div class="ps-2">
										<h4 class="mb-0 font-weight-semibold head-count"> {{ $data['lineChart']['totalAmount'] }} </h4>
										<span class="font-10 font-weight-semibold text-muted">Total {{ $data['lineChart']['dateFrom'].' - '.$data['lineChart']['dateTo'] }}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="line-chart-wrapper">
						<canvas id="linechart" height="80"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 grid-margin">
			<div class="card stretch-card mb-3">
				<div class="card-body d-flex flex-wrap justify-content-between">
					<div>
						<h4 class="font-weight-semibold mb-1 text-success"> Daily Collection </h4>
						<h6 class="text-muted">{{ now()->format('d F Y') }}</h6>
					</div>
					<h3 class="text-success font-weight-bold">{{$data['today_amount']}}</h3>
				</div>
			</div>
			<div class="card stretch-card mb-3">
				<div class="card-body d-flex flex-wrap justify-content-between">
					<div>
						<h4 class="font-weight-semibold mb-1 text-behance"> Monthly Collection </h4>
						<h6 class="text-muted">{{ now()->format('F Y') }}</h6>
					</div>
					<h3 class="text-behance font-weight-bold">{{$data['this_month_amount']}}</h3>
				</div>
			</div>
			<div class="card mt-3">
				<div class="card-body d-flex flex-wrap justify-content-between">
					<div>
						<h4 class="font-weight-semibold mb-1 text-facebook"> Yearly Collection </h4>
						<h6 class="text-muted">{{ now()->format('Y') }}</h6>
					</div>
					<h3 class="text-facebook font-weight-bold">{{$data['this_year_amount']}}</h3>
				</div>
			</div>
		</div>
		<div class="col-xl-4 grid-margin">
			<div class="card stretch-card mb-3">
				<div class="card-body d-flex flex-wrap justify-content-between">
					<div>
						<h4 class="font-weight-semibold mb-1 text-success"> Total Slots </h4>
						<h6 class="text-muted">Slots in all category</h6>
					</div>
					<h3 class="text-success font-weight-bold">{{ $data['total_slots'] }}</h3>
				</div>
			</div>
			<div class="card stretch-card mb-3">
				<div class="card-body d-flex flex-wrap justify-content-between">
					<div>
						<h4 class="font-weight-semibold mb-1 text-behance">Currently parking</h4>
						<h6 class="text-muted">Booked slots</h6>
					</div>
					<h3 class="text-behance font-weight-bold">{{ $data['currently_parking'] }}</h3>
				</div>
			</div>
			<div class="card mt-3">
				<div class="card-body d-flex flex-wrap justify-content-between">
					<div>
						<h4 class="font-weight-semibold mb-1 text-facebook"> Available Slots </h4>
						<h6 class="text-muted">Currently Available</h6>
					</div>
					<h3 class="text-facebook font-weight-bold">{{ $data['total_slots'] - $data['currently_parking'] }}
					</h3>
				</div>
			</div>
		</div>
		<div class="col-xl-8 stretch-card grid-margin">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between flex-wrap mb-3">
						<div>
							<div class="card-title mb-0">Slots</div>
							<span class="font-10 font-weight-semibold text-muted">Total allocation {{
								$data['total_slots'] }}</span>
						</div>
						<div>
							<div class="d-flex flex-wrap pt-2 justify-content-between sales-header-right">
								<div class="d-flex me-5">
									<div class="ps-2">
										<h4 class="mb-0 font-weight-semibold head-count free-box bg-available"></h4>
										<span class="font-10 font-weight-semibold text-muted">Available</span>
									</div>
								</div>
								<div class="d-flex me-3 mt-2 mt-sm-0">
									<div class="ps-2">
										<h4 class="mb-0 font-weight-semibold head-count free-box bg-booked"></h4>
										<span class="font-10 font-weight-semibold text-muted">Booked</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="bar-chart-wrapper">
						<canvas id="barchart" height="80"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	var barChartLabel = @json($data['barChart']['labels']);
	var lineChartAvailableData = @json($data['barChart']['availableData']);
	var lineChartBookedData = @json($data['barChart']['bookedData']);
	var lineChartLabel = @json($data['lineChart']['labels']);
	var lineChartData = @json($data['lineChart']['data']);
</script>
<script src="{{ asset('js/custom/dashboard/home.js') }}"></script>
@endpush