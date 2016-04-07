<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

<ul>
@foreach($contracts as $contract)
  <li>
    <a href="{{url('descargar/contrato/' . $contract->ocdsid)}}">Decargar contrato</a><br>
    {{$contract->ocdsid}}<br>
    @if($contract->releases->count())
    <?php $r = $contract->releases->last(); ?>
    title: {{$r->planning->project}}<br>
    budget: {{number_format($r->planning->amount)}}<br>
    tender title: {{$r->tender->title}}<br>
    tender description: {{$r->tender->description}}<br>
    tender amount: {{$r->tender->amount}}<br>
    buyer name: {{$r->buyer ? $r->buyer->name : "nope"}}<br>
    awards : {{$r->awards ? $r->awards->count() : "nope"}}<br>
    suppliers : {{$r->suppliers()->count()}}<br>
    tenderers : {{$r->tender->tenderers()->count()}}<br>
    @if($r->awards->count())
    <ul>
      @foreach($r->awards as $item)
      <li>{{$item->title}}</li>
      @endforeach
    </ul>
    @endif
    contratos : {{$r->singlecontracts ? $r->singlecontracts->count() : "nope"}}<br>
    @if($r->singlecontracts->count())
    <ul>
      @foreach($r->singlecontracts as $item)
      <li>{{$item->title}} :::: {{$item->release->awards->where('local_id', $item->award_id)->first()->title}}</li>
      @endforeach
    </ul>
    @endif
    items: {{$r->tender->items->count()}}<br>
    @if($r->tender->items->count())
    <ul>
      @foreach($r->tender->items as $item)
      <li>{{$item->description}}</li>
      @endforeach
    </ul>
    @endif
    <br>
    @endif
  </li>
@endforeach
</ul>
</body>
</html>