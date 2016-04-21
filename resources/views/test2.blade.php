<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<h1>
{{empty($supplier->name) ? "sin nombre" : $supplier->name }} :
{{$supplier->rfc}} : 
licitaciones({{$tenders->count()}})</h1>

<h2>Licitaciones</h2>
<ul>
  @foreach($tenders as $tender)
  <li>
    {{$tender->title}}<br>
    {{$tender->description}}<br>
    ${{number_format($tender->amount)}}<br>
    {{$tender->tender_start}}<br>
    {{$tender->release->ocid}}<br>
  </li>
  @endforeach
</ul>

<h2>Awards</h2>
<ul>
  @foreach($awards as $award)
  <li>
    {{$award->title}}<br>
    contratos: <br>
    <ul>
    @foreach($award->release->singlecontracts->where("award_id", $award->local_id) as $contract)
      <li>
      {{$contract->title}}<br>
      ${{number_format($contract->amount)}}<br>
      </li>
    @endforeach
    </ul>
  </li>
  @endforeach
</ul>
</body>
</html>