
<option value="">Chọn màu sắc</option>
@if ($colors)
@foreach ($colors as $color)
<option value="{{$color['id']}}">{{$color['color']['name']}}</option>
@endforeach
@endif
