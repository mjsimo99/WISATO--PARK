<?php
ini_set('pcre.backtrack_limit', 10000000);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Parking Report at {{date('YmdHim')}}</title>
	<link rel="stylesheet" href="{{asset('css/custom/report/pdf-report.css')}}" />
</head>

<body>
	<div>
		<div>
			<h4 class="tc">Parking Report</h4>
			<h6 class="tc"> <b>Date:</b> from {{($request['from_date'] != NULL)?$request['from_date']:"ALL"}} to {{($request['to_date'] != NULL)?$request['to_date']:"ALL"}}</h6>
			@if($request['category_id'] != -1)
				<h6 class="tc">Brand: {{App\Models\Category::find($request['category_id'])->type}}</h6>
			@endif
		</div>
		<br>
	</div>
	<div>
		<table>
			<thead>
				<tr>
					<th>SL</th>
					<th>Vehicle No</th>					
					<th>Type</th>
					<th>Floor</th>
					<th>Slot</th>
					<th>In Time</th>
					<th>Out Time</th>
					<th>Amount (BDT)</th>
					<th>Paid (BDT)</th>
				</tr>
			</thead>
			<tbody>
				<?php $i= 1; $total = 0; $totalPaid = 0;?>
				@foreach ($parkings as $parking)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{$parking->vehicle_no}}</td>
						<td>{{$parking->category->type}}</td>						
						<td>{{$parking->slot->floor->name ?? ''}}</td>						
						<td>{{$parking->slot->slot_name ?? ''}}</td>						
						<td>{{$parking->in_time->format(env('DATE_FORMAT','m-d-Y H:i:s'))}}</td>
						<td>{{$parking->out_time != null?$parking->out_time->format(env('DATE_FORMAT','m-d-Y H:i:s')):$parking->out_time}}</td>
						@php
							$total += $parking->amount;
							$totalPaid += $parking->paid;
						@endphp
						<td  class="tr">{{round($parking->amount,2)}} /=</td>
						<td  class="tr">{{$parking->paid}} /=</td>
					</tr>
				@endforeach
				<tr>
					<td colspan="7" class="text-right">Total = </td>
					<td  class="tr">{{$total}} /=</td>
					<td  class="tr">{{$totalPaid}} /=</td>
				</tr>
			</tbody>
		</table>
	</div>

</body>
</html>