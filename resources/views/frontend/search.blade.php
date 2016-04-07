<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <form method="get" action="{{url('contratos/busqueda')}}">
    {!! csrf_field() !!}
    <p>
      <input name="query" value="{{old('query')}}">
    </p>
    <p><input type="submit" value="buscar"></p>
  </form>

  @if($contracts)
  <ul>
    @foreach($contracts as $contract)
    <li>{{$contract->id}} : {{$contract->releases()->count()}} : {{$contract->plannings()->count()}} : {{$contract->ocdsid}}</li>
    @endforeach
  </ul>
  @endif
</body>
</html>