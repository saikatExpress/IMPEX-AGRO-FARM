<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>hjasdjh</h1>
    <form id="searchForm" method="GET" action="{{ route('search.zones') }}">
        <select name="search" id="searchSelect" style="border-color:#0f0097; border-radius:8px; height: 38px;" onchange="this.form.submit()">
            <option >select...</option>
            @foreach($read as $data)
            <option value="{{$data->tag}}">{{$data->tag}}</option>
            @endforeach
        </select>
    </form>

    <div class="view">
        <h3 style="display: none">jsad</h3>
        @foreach($reads as $data)
    <tr>
        <td style="font-size: 15px" clsaa="view 2">{{ $data->tag }}</td>
        <td style="font-size: 15px">{{ $data->age }}</td>
        <td style="font-size: 15px">{{ $data->caste }}</td>
        
    </tr>
    @endforeach
    </div>


    
    
</body>
</html>