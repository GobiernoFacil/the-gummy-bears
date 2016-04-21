<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<h1>Suppliers</h1>
<p>name : RFC</p>
<ul>
@foreach($suppliers as $supplier)
  <li>
    {{empty($supplier->name) ? "sin nombre" : 
    $supplier->name}} : {{$supplier->rfc}} : 

  </li>
@endforeach
</ul>

<h1>Contracts</h1>
<p>OCDS : RELEASES num</p>
<ul>
@foreach($contracts as $contract)
  <li>{{$contract->ocdsid}} : {{$contract->releases->count()}}</li>
@endforeach
</ul>

<h1>Tenders</h1>
<p>Title : tenderers</p>
<ul>
@foreach($tenders as $tender)
  <li>{{$tender->title}} : {{$tender->tenderers()->where("rfc", "SIC0306206M8")->count()}}</li>
@endforeach
</ul>
</body>
</html>