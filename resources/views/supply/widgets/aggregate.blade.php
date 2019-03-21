<div class="d-flex justify-content-center">
    <div>
        Total Quantity
        <h1>{{number_format($supply_collection->sum('quantity'))}} <span style="font-size: 14px">{{$_unit}}</span></h1> 
    </div>
    <div class="ml-auto">
        Total Value
        <h1>&#8358; {{number_format($supply_collection->sum('value'))}} <span style="font-size: 14px"></span></h1> 
    </div>
</div>
