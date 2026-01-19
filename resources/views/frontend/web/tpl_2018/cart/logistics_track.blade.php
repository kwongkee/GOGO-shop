@foreach($order['logistics_track']['data'] as $k=>$v)
    <p>{{$v['context']}}</p>
    <p>{{$v['time']}}</p>
    <br/>
@endforeach