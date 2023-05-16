@extends('layouts.app')
@section('title', ' - All Parking')
@section('content')
<div class="container-fluid mb100">

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Barcode Print') }}</div>

                <div class="card-body" id="printDiv">
                    <link rel="stylesheet" href="{{asset('css/custom/content/end-parking.css')}}" />
                    <p class="dN tc fs-16 fwb">{{ ($settings->site_title) ? $settings->site_title : config('app.name', 'Demo Parking') }}</p>
                    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($parking->barcode, 'C128', 50, 1366) }}" alt="barcode" class="w70 ml15" />
                    <table class="table table-condensed rTable">
                        <tbody>
                            <tr>
                                <td class="w40">Vehicle No</td>
                                <td class="w10">:</td>                                
                                <td class="w50">{{$parking->vehicle_no}}</td>                                
                            </tr>
                            <tr>
                                <td class="w40">Type</td>                                
                                <td class="w10">:</td>                                
                                <td class="w50">{{$parking->category->type}}</td>                                
                            </tr>
                            <tr>
                                <td class="w40">Driver Name</td>                                
                                <td class="w10">:</td>                                
                                <td class="w50">{{$parking->driver_name}}</td>                                
                            </tr>
                            <tr>
                                <td class="w40">Driver Mobile</td>                                
                                <td class="w10">:</td>                                
                                <td class="w50">{{$parking->driver_mobile}}</td>                                
                            </tr>
                            <tr>
                                <td class="w40">Floor</td>
                                <td class="w10">:</td>
                                <td class="w50">{{$parking->slot->floor->name ?? ''}}</td>
                            </tr>
                            <tr>
                                <td class="w40">Parking Slot</td>
                                <td class="w10">:</td>
                                <td class="w50">{{$parking->slot->slot_name ?? ''}}</td>
                            </tr>
                            <tr>
                                <td class="w40">In Time</td>                                
                                <td class="w10">:</td>                                
                                <td class="w50"><b>{{$parking->in_time->format(env('DATE_FORMAT','m-d-Y H:i:s'))}}</b></td>
                            </tr>
                            <tr>
                                <td class="w40">Out Time</td>                                
                                <td class="w10">:</td>   
                                @php 
                                if($parking->out_time){
                                    $outTime = $parking->out_time;
                                }
                                elseif(session()->has('eDate_'.$parking->id)){
                                    $outTime = session()->get('eDate_'.$parking->id);
                                }
                                
                                @endphp                             
                                <td class="w50"><b>{{$outTime->format(env('DATE_FORMAT','m-d-Y H:i:s'))}}</b></td>
                            </tr>
                            <tr>
                                <td class="w40">Duration</td>                                
                                <td class="w10">:</td>                                
                                <td class="w50">
                                    <b>
                                        <?php
                                    $eDate = (is_string($outTime)) ? new \DateTime($outTime) : $outTime;
                                    $dateDiff = $eDate->diff(new \DateTime($parking->in_time));
                                    $hour = $dateDiff->h;                                    
                                    if($dateDiff->days > 0)
                                    $hour = $dateDiff->h + ($dateDiff->days * 24);
                                    echo $hour.' hour, '.$dateDiff->i. ' min';
                                    ?>
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td class="w40">Payable Amount</td>                                
                                <td class="w10">:</td>  
                                <td class="w50"><b id="payble_amt">{{ ($parking->amount != 0) ? round($parking->amount,2) : round($amt,2) }}</b></td>
                            </tr>
                            @if($parking->paid > 0)
                            <tr>
                                <td class="w40">Paid Amount</td>                                
                                <td class="w10">:</td>                                
                                <td class="w50"><b>{{$parking->paid}}</b></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    @if($parking->paid < 1)
                    <table class="table table-condensed rTable">
                        <tbody>
                        <form id="payForm" action="{{route('parking.pay',['parking' => $parking->id])}}" method="post">
                        @csrf
                            <tr>
                                <td class="w40">Recive Amount</td>                                
                                <td class="w10">:</td>                                
                                <td class="w50">                                    
                                    <input tabindex="1" type="number" id="recive_amt" step="any" placeholder="Recive Amount" class="form-control" required="">                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="w40">Return Amount</td>                                
                                <td class="w10">:</td>                                
                                <td class="w50">                                    
                                    <input tabindex="2" type="number" disabled id="return_amt" placeholder="Return Amount" class="form-control">                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="w40">Paid Amount</td>                                
                                <td class="w10">:</td>                                
                                <td class="w50">                                    
                                    <input tabindex="3" type="number" id="paid_amt" name="paid_amt" placeholder="Paid Amount" class="form-control" readonly="" required="">
                                    @if ($errors->has('paid_amt'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('paid_amt') }}</strong>
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="w40"></td>                                
                                <td class="w10"></td>                                
                                <td class="w50">
                                    <input type="submit" class="btn btn-info btn-sm pull-right" value="End Parking">
                                </td>
                            </tr>
                        </form>
                        </tbody>
                    </table>
                    @endif                    
                    <p class="dN tc fs-12" id="footer-p">{{ $settings->site_title }} - All Rights Reserved</p>
                </div>
                <div class="card-footer">
                    @if($parking->paid > 0)
                    <a href="{{route('parking.index')}}" class="btn btn-warning" id="parking_list">Go to Parking list</a>
                    <button class="btn btn-success" id="print_slip">Print Slip</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> 
<script src="{{ asset('js/custom/content/end-parking.js') }}"></script>
<script>
   var paidAmount={{$parking->paid}};  
</script>

@endsection