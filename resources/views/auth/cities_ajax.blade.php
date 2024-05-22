<select name="city" id="" required="required">
    <option value="">Choose a City *</option>
    @foreach($cities as $city)
        <option value="{{ $city->id }}" {{ $city->id == $added_city_id ? 'selected': '' }}>{{ $city->city }}</option>
    @endforeach
</select>

