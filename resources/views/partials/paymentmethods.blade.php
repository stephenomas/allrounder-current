<div class="form-group row">
    <label class="col-sm-2 control-label">Payment Method</label>
    <div class="col-sm-10">
        <div class="row m-auto">
            <div class="d-flex ">
                <span class="mr-5">
                    <span class="mr-2">POS</span><input class="" name="pos" value="1" type="checkbox" onchange="toggler(this)" id="posCheck">
                </span>
                <span class="mr-5">
                    <span class="mr-2">Bank Transfer</span><input type="checkbox" name="transfer" value="1" onchange="toggler(this)" id="transferCheck">
                </span>
                <span class="mr-5">
                    <span class="mr-2">Cash</span><input type="checkbox" name="cash" value="1" onchange="toggler(this)" id="cashCheck">
                </span>
            </div>
        </div>
        <div class="" >
            <div class="  mt-3" id="posDiv" style="display: none">
                <span class="" style="margin-right: 30px;">
                    <span class="" >POS:</span>
                </span>
                <div class="">
                    <div class="row">
                        <div class="col mb-1">
                            <input type="number" name="posAmount" placeholder="Amount">
                        </div>
                        <div class="col mb-1">
                            <input type="text" placeholder="Bank" name="posBank">
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Account No" name="posAccount">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="" >
            <div class=" mt-3" id="transferDiv" style="display: none">
                <div class=""style="margin-right: 10px;">
                    <span class="" >Bank Transfer:</span>
                </div>
                <div class="">
                    <div class="row">
                        <div class="col mb-1">
                            <input type="number" placeholder="Amount" name="transferAmount">
                        </div>
                        <div class="col mb-1">
                            <input type="text" placeholder="Bank" name="transferBank">
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Account No" name="transferAccount">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-auto">
            <div class=" mt-3"  id="cashDiv" style="display: none">
                <span class="" style="margin-right: 30px;">
                    <p >Cash:</p>
                </span>
                <span class="">
                    <input type="number" name="cashAmount" placeholder="Amount">
                </span>
            </div>
        </div>


        {{-- <select name="paymentmethod" class="form-control">
            <option>Select Payment Method</option>
            <option>Transfer</option>
            <option>POS</option>
            <option>Cash</option>
        </select> --}}
    </div>
</div>
<div class="form-group row ">
    <label class="col-sm-2 control-label">Payment Status</label>
    <div class="col-sm-10">
        <select name="paymentstatus" class="form-control">
            <option>Select Payment Status</option>
            <option>Paid</option>
            <option>Pending</option>
            <option>Refunded</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 control-label" for="example-password-input">Apply Discount <input type="checkbox" name="discount" value="1" onchange="toggler(this)" id="discount"></label>

    <div class="col-sm-10" style="display: none;" id="discountAmount">
        <input type="number" name="discountPrice"   class="form-control" placeholder="Price" id="example-password-input">
    </div>
</div>
<script>
    let target = '';
    const toggler = (e) => {

        switch(e.id) {
            case "posCheck":
                target =  document.getElementById("posDiv");
                break;
            case "transferCheck":
                 target =  document.getElementById("transferDiv");
                break;
            case "cashCheck":
                target =  document.getElementById("cashDiv");
                break;
            case "discount":
                target =  document.getElementById("discountAmount");
                break;
                // code block
        }

        if (e.checked) {
            target.style.display = "flex";
        } else {
            target.style.display = "none";
        }
    }


</script>
