<label for="">Select Month</label>

<div class="d-flex">
    <div class="form-group">
        <select name="month" class="form-control" style="border-radius: 3px 0px 0px 3px">
            <option value="1" {{date('m',time()) == 1 ? 'selected' : ''}}>January</option>
            <option value="2" {{date('m',time()) == 2 ? 'selected' : ''}}>February</option>
            <option value="3" {{date('m',time()) == 3 ? 'selected' : ''}}>March</option>
            <option value="4" {{date('m',time()) == 4 ? 'selected' : ''}}>April</option>
            <option value="5" {{date('m',time()) == 5 ? 'selected' : ''}}>May</option>
            <option value="6" {{date('m',time()) == 6 ? 'selected' : ''}}>June</option>
            <option value="7" {{date('m',time()) == 7 ? 'selected' : ''}}>July</option>
            <option value="8" {{date('m',time()) == 8 ? 'selected' : ''}}>August</option>
            <option value="9" {{date('m',time()) == 9 ? 'selected' : ''}}>September</option>
            <option value="10" {{date('m',time()) == 10 ? 'selected' : ''}}>October</option>
            <option value="11" {{date('m',time()) == 11 ? 'selected' : ''}}>November</option>
            <option value="12" {{date('m',time()) == 12 ? 'selected' : ''}}>December</option>
        </select>
    </div>

    <div class="form-group">
        <input type="text" name="year" value="{{date('Y',time())}}" class="form-control" style="border-radius: 0px">
    </div>
    <div class="form-group">
        <button  type="submit" class="btn btn-primary" style="border-radius: 0px 3px 3px 0px">Filter</button>
    </div>
</div>    
