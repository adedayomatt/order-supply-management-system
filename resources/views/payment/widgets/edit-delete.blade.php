<form action="{{route('payment.delete',[$payment->id])}}" method="post">
    @csrf
    @method('DELETE')
    <a href="{{route('payment.edit',[$payment->id])}}" class="btn btn-info btn-sm"><i class="fa fa-pen"></i> edit</a>
    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> delete</button>
</form>