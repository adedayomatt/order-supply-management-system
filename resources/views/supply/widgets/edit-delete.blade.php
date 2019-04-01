
<form action="{{route('supply.delete',[$supply->id])}}" method="post">
    @csrf
    @method('DELETE')
    <a class="btn btn-sm btn-info" href="{{route('supply.edit',[$supply->id])}}" ><i class="fa fa-pen"></i> edit</a>
    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> delete</button>
</form>