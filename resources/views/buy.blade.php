@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">BUY</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <button id="getPay" class="btn btn-success"> Get Payment List</button> <br><br>
                        <table class="table table-striped" >
                            <td>Product Name</td>                                
                            <td>Price</td>                                
                            <td>Quantity</td>                                
                            <td>Total</td>
                            <tr>
                                <td>{{$product['name']}}</td>                                
                                <td>{{$product['price']}} $</td>                                
                                <td>{{$product['quantity']}}</td>                                
                                <td>{{$product['quantity']*$product['price']}} <input type="hidden" id="total" value="{{$product['quantity']*$product['price']}}"> $</td>                                
                            </tr>
                        </table>
                        <div id="result">

                        </div>
                        <br> <br>
                        <table id="paymentMethods" class="table table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>logo</th>
                                    <th>Choose</th>
                                </thead>
                                
                                <tbody>

                                </tbody>
                        </table>
                </div>  
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        
        $('#paymentMethods').hide();
        $('#getPay').unbind();
        $('#getPay').on('click',async function(){
        $('#getPay').attr('disabled',true);
        var token =$('meta[name="csrf-token"]').attr('content');
        var datapost = {
            "amount": $('#total').val(),
            "currency": "USD",
            "mobileNumber": "999",
            "email": "999",
            "firstName": "999",
            "lastName": "999",
            "success_url": "https://www.yahoo.com",
            "fail_url": "https://www.twitter.com",
            "cancel_url": "https://www.twitter.com",
            
        };
        var headerParams = {'Authorization':'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiMDc5NzUwMTc1YzkxYTkwNTNmMmZmMzMyZmIzMDlmMTcxODE0ZjcwMjIyNDc0ZWEyNTNhNDM3ZTU0MzA0YTg3NWVkNTY5YzI2NTc5ODlmNmIiLCJpYXQiOjE2MjM0ODUwNzAsIm5iZiI6MTYyMzQ4NTA3MCwiZXhwIjoxNjU1MDIxMDcwLCJzdWIiOiIxMiIsInNjb3BlcyI6W119.P6ffaEQ-0_tJPnfMJ5H2a2gq-ZAR1DT08hnkP_MyG7e-7Mp-PLSSPoSGuBNEPdlyNqvfQvmWsgsys8RguDWR7d5boBN0XBLOPTdAvw-RwTQNI7d9t_RR1GE9aRKBzzp0-Rqb3KPx_FdB2sRSIjuVAAXyi4UKCS98Zzr2LtMVsNUG1PPc18mYTQXDiJQbbg-mt1cxOXo1P8tMA_zQa2fULtP9xe8HC6W5AlWQs2YUFhDE-gGZ2J35puBkILxKyoH7uobMWjDMevCtt5Twy2nJP6eJfc-fwm1NAXXXHCLkeq1AbAjr3n4Oxw8Q0eX-W-9mmwtAMnaaMXnO0ibJYsnxPaE8tPFF_vVs3OQ5xKuvB4OiLogM0NpsqFYFOPr5ePt5TcVsm-W-J4ApngHJ8tPAWC4hN9RjoxFQgBnnZs4EISwLOmRaUL-PmzuI4V-YrIG3VhiIrLFbs974RRx1dhaAV1aOSRziSDABf41b__pNHJ3ICryeN0EgSkG7hARFXYv0nV9BTQNEmdYaehjGJ7faXy5NF05DLZUtT9NEsf1aK0wGQ7IsNZSc5ssN3y4JmttvSiE6QxIcObxx9K5W-39agMAlkil4LTjKeI7EQ25SoYDeXdt65dAkfbf-kUl3dhOZW_MsJqkWllIfO4r3BC20xenZtQTqVXovcK0WigGL1OU'};
        // localStorage.setItem('headerParams', text);
        $.ajax({
        type: "POST",
        headers:headerParams,
        url: "https://sandbox.api.pinikle.com/api/listOfPayments",
        dataType: 'application/json',
        data: datapost,
        success: function () {
        // OnSuccess(cartObject.productID)
        
        },
        error: function (res) {
            let result = JSON.parse(res.responseText);
            
            if(!result.success){
                alert("Error Response");
                return false;
            } 

            var data = result.data;
            var refid = result.refid;
            $('#getPay').attr('disabled',false);
            $('#paymentMethods').show();
            $('#paymentMethods > tbody').empty();
            $.each(data, function (key, val) {
                key = key+1;
                if(val.subPaymentId){
                    $('#paymentMethods > tbody').append("<tr><td>"+key+"</td><td>"+val.name_en+"</td><td>"+val.gateway+"</td> <td><img width='25%' height='25%' src='"+val.logoURL+"'></td><td>"+""
                        +" <button data-subPaymentId='"+val.subPaymentId+"'  data-refid='"+refid+"' data-gateway='"+val.gateway+"' class='btn btn-primary selectPayment' > Select</button>  </td></tr>");
                }else{
                    $('#paymentMethods > tbody').append("<tr><td>"+key+"</td><td>"+val.name_en+"</td><td>"+val.gateway+"</td> <td><img width='25%' height='25%' src='"+val.logoURL+"'></td><td>"+""
                        +" <button data-subPaymentId='"+val.subPaymentId+"'  data-refid='"+refid+"' data-gateway='"+val.gateway+"' class='btn btn-primary selectPayment'disabled > Select</button>  </td></tr>");
                }
            });
            $('.selectPayment').unbind();
            $('.selectPayment').on('click',function(){
                var refid = $(this).attr('data-refid');
                var gateway = $(this).attr('data-gateway'); 
                var subPaymentId = $(this).attr('data-subPaymentId'); 
                var datapost= {
                    "refid":refid,
                    "gateway":gateway,
                    "subPaymentId":subPaymentId,
                }
                $.ajax({
                type: "POST",
                headers:headerParams,
                url: "https://sandbox.api.pinikle.com/api/initiatePayment",
                dataType: 'application/json',
                data: datapost,
                success: function (Response) {
                
                },error: function (res) {
                    // console.log(2);
                    let result = JSON.parse(res.responseText);
                    console.log(result);
                    if(!result.success){
                        alert("Error Response");
                        return false;
                    } 

                    $('#paymentMethods > tbody').empty();
                    $('#paymentMethods').hide();

                    $('#result').html('<center> <h3>'+result.message+' </h3> <br> <p> Invoice Number : '+result.data["invoice_number"]+'</p> <br> <h6><a href="'+result.data["redirect_url"]+'">Click to Continue to bill Gate</a></h6> </center>');
                    
                }
                })
                
            })            
            
        }
        });
    return false;

        })
    })
</script>
@endsection
