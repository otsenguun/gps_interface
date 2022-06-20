<table>


<th>№</th>
<th>Нэр</th>
<th>Утас</th>

<tbody>

@foreach($list as $key => $data)
<tr>
    <td>{{$key+1}}</td>
    <td>{{$data->name}}</td>
    <td>{{$data->phone}}</td>
</tr>
@endforeach

</tbody>

</table>