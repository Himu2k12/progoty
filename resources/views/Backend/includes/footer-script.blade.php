<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-md-center" id="exampleModalLabel">Are you sure to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-md-center">Press "Logout" If you are Sure! </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="{{asset('/Assets/')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('/Assets/')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
@yield('additional_script')
<!-- Core plugin JavaScript-->
<script src="{{asset('/Assets/')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('/Assets/')}}/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="{{asset('/Assets/')}}/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{asset('/Assets/')}}/js/demo/chart-area-demo.js"></script>
<script src="{{asset('/Assets/')}}/js/demo/chart-pie-demo.js"></script>

<script src="{{asset('/Assets/')}}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/Assets/')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{asset('/Assets/')}}/js/demo/datatables-demo.js"></script>

<script>

    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var radius = canvas.height / 2;
    ctx.translate(radius, radius);
    radius = radius * 0.90
    setInterval(drawClock, 1000);

    function drawClock() {
        drawFace(ctx, radius);
        drawNumbers(ctx, radius);
        drawTime(ctx, radius);
    }

    function drawFace(ctx, radius) {
        var grad;
        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, 2*Math.PI);
        ctx.fillStyle = 'white';
        ctx.fill();
        grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
        grad.addColorStop(0, '#333');
        grad.addColorStop(0.5, 'red');
        grad.addColorStop(1, '#333');
        ctx.strokeStyle = grad;
        ctx.lineWidth = radius*0.1;
        ctx.stroke();
        ctx.beginPath();
        ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
        ctx.fillStyle = '#333';
        ctx.fill();
    }
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#slider')
                    .attr('src', e.target.result)
                    .width(1000)
                    .height(500);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function drawNumbers(ctx, radius) {
        var ang;
        var num;
        ctx.font = radius*0.15 + "px arial";
        ctx.textBaseline="middle";
        ctx.textAlign="center";
        for(num = 1; num < 13; num++){
            ang = num * Math.PI / 6;
            ctx.rotate(ang);
            ctx.translate(0, -radius*0.85);
            ctx.rotate(-ang);
            ctx.fillText(num.toString(), 0, 0);
            ctx.rotate(ang);
            ctx.translate(0, radius*0.85);
            ctx.rotate(-ang);
        }
    }

    function drawTime(ctx, radius){
        var now = new Date();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        //hour
        hour=hour%12;
        hour=(hour*Math.PI/6)+
            (minute*Math.PI/(6*60))+
            (second*Math.PI/(360*60));
        drawHand(ctx, hour, radius*0.5, radius*0.07);
        //minute
        minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
        drawHand(ctx, minute, radius*0.8, radius*0.07);
        // second
        second=(second*Math.PI/30);
        drawHand(ctx, second, radius*0.9, radius*0.02);
    }

    function drawHand(ctx, pos, length, width) {
        ctx.beginPath();
        ctx.lineWidth = width;
        ctx.lineCap = "round";
        ctx.moveTo(0,0);
        ctx.rotate(pos);
        ctx.lineTo(0, -length);
        ctx.stroke();
        ctx.rotate(-pos);
    }
</script>
<script>

    $("#savingsInfo").on("change", function(){

        var id = this.value;
        getMemberInfo(id);
    });

    function getMemberInfo(id){

        $.ajax({
            type: 'POST',
            url: '{{url('/get-member-by-id')}}',
            data: {id:id,"_token":"{{csrf_token()}}"}


        }).done(function(data) {
            var myArray= JSON.parse(data);
            // console.log(myArray);
            // console.log(myArray[2]);
            // console.log(myArray[3]);
            // console.log(myArray[4]);
            // console.log(myArray[5]);
            if(myArray[0]==null){
                $('#accountDuration').append('<p style="color:red">'+myArray[2]+'</p>'+'<br>');
            }
            // console.log(myArray[1]);
            $('#blockquotes').append(' Name:<b>  '+myArray[0].applicant_name+'</b><br> <i class="fas fa-map-marker-alt"></i> <small><cite title="Source Title">'+myArray[0].present_village+','+myArray[0].present_upa+' </cite></small>');
            $('#accountDuration').append('Account Duration: <b>'+myArray[5]+'</b>'+'<br>');
            $('#accountType').append('Deposite Scheme: <b>'+myArray[0].deposite_type+'</b>');
            $('#paymentAmount').append('Scheme Amount: ৳ <b> '+myArray[0].amount_of_money+'</b><hr>');
            $('#applicantPhoto').append(' <img src="'+myArray[0].applicant_photo+'"alt="" width="100%" class="img-rounded img-responsive"/>');

            if(myArray[1]){

                $('#loanLevel').append('  <label for="loan_payment" class="col-md-12" >Loan Payment</label>');
                $('#loanServiceLevel').append('  <label for="service" class="col-md-12" >Service Charge</label>');
                $('#loanDiv').append(' <input type="number" name="loan_payment" class="col-md-12 form-control" />');
                $('#loanServiceDiv').append(' <input type="number" name="service_charge" class="col-md-12 form-control" />');
                $('#loaniv').append(' <input type="hidden" name="loan_id" value="'+myArray[1]['id']+'" class="col-md-6 form-control" />');
                $('#loanAmount').append('Pending Loan: ৳ <b> '+myArray[4]+'</b>');
                $('#serviceAmount').append('Pending Service: ৳ <b> '+myArray[3]+'</b>');

            }else{
                
                console.log('null');

            }

        });
        $('#blockquotes').empty();
        $('#accountType').empty();
        $('#paymentAmount').empty();
        $('#loanAmount').empty();
        $('#serviceAmount').empty();
        $('#applicantPhoto').empty();
        $('#loanLevel').empty();
        $('#loanServiceLevel').empty();
        $('#loanDiv').empty();
        $('#loanServiceDiv').empty();
        $('#loaniv').empty();
        $('#accountDuration').empty();
    }




    $("#withdrawSavings").on("change", function(){

        var id = this.value;
        withdrawInfo(id);
    });

    function withdrawInfo(id){

        $.ajax({
            type: 'POST',
            url: '{{url('/get-withdraw-info-id')}}',
            data: {id:id,"_token":"{{csrf_token()}}"}


        }).done(function(data) {
            var myArray= JSON.parse(data);
            //console.log(myArray[9]);
            // console.log(myArray[1]);
            $('#blockquotes').append(' <p>'+myArray[0].applicant_name+'</p> <small><cite title="Source Title">'+myArray[0].present_village+','+myArray[0].present_upa+' <i class="glyphicon glyphicon-map-marker"></i></cite></small>');
            $('#applicantPhoto').append(' <img src="'+myArray[0].applicant_photo+'"alt="" width="100%" class="img-rounded img-responsive"/>');

            if(myArray[1]){

                $('#LoanStatus').append('Loan Status: <b style="color: red">Active</b>');
                 $('#loanMoney').append('Total Loan Amount with Service: <b style="color:red">'+myArray[4]+'</b>');
                 $('#loanpaidMoney').append('Loan paid (amount+Service): <b style="color:blue">'+myArray[3]+'+'+myArray[5]+'='+myArray[6]+'</b>');
                 

            }else{
                $('#LoanStatus').append('Loan Status: <b style="color: green">No-Loan Active</b>');


            }

            $('#savingsMoney').append('Savings Amount: <b style="color:green">'+myArray[2]+'</b>');
            $('#savingsAmount').append(' <input type="number" name="loan_amount" value="'+myArray[2]+'" class="form-control" />');
            $("#Maxamount").attr("max", myArray[2]);


            console.log(myArray[9]);
        });
        $('#blockquotes').empty();
        $('#LoanStatus').empty();
        $('#savingsAmount').empty();
        $('#savingsMoney').empty();
        $('#loanMoney').empty();
        $('#loanpaidMoney').empty();
        
        $('#applicantPhoto').empty();


    }

</script>


