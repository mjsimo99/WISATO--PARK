<div class="cabin">
    @foreach($slots->groupBy('floor_id') as $florSlots)
    <div class="row">
        <div class="col-12">
            <h4 class="border-top pt-2 text-center">Floor : {{ $florSlots->first()->floor->name }}</h4>
        </div>
    </div>
    <div class="row row--10 mb-4">
        <div class="seats">
            @foreach ($florSlots as $index => $slot)
            <div class="seat {{ $slot->active_parking != NULL && $slot->active_parking->id != $id ? 'text-white' : '' }}">
                <input type="radio" value="{{ $slot->id }}" required name="slot_id" {{ $slot->active_parking != NULL && $slot->active_parking->id != $id ? 'disabled' : ($slot->active_parking != NULL && $slot->active_parking->id == $id ? 'checked' : '' ) }} id="{{ $slot->slotId }}" />
                <label for="{{ $slot->slotId }}">
                    {{ $slot->slot_name }}<br>
                    @if($slot->active_parking != NULL && $slot->active_parking->id != $id)
                    <i class="fa fa-car" aria-hidden="true"></i>
                    @else
                    <i class="fa fa-road" aria-hidden="true"></i>
                    @endif
                </label>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>