<form action="{{route('payment.delete',[$payment->id])}}" method="post">
    @csrf
    @method('DELETE')
    <button class="btn btn-link text-danger btn-sm"><i class="fa fa-trash"></i> delete</button>
</form>