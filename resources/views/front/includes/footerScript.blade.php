<script type='text/javascript' src='{{asset('asset/')}}/js/jquery.js'></script>
<script type='text/javascript' src='{{asset('asset/')}}/js/jquery.collapsible.min.js'></script>
<script type='text/javascript' src='{{asset('asset/')}}/js/swiper.min.js'></script>
<script type='text/javascript' src='{{asset('asset/')}}/js/jquery.countdown.min.js'></script>
<script type='text/javascript' src='{{asset('asset/')}}/js/circle-progress.min.js'></script>
<script type='text/javascript' src='{{asset('asset/')}}/js/jquery.countTo.min.js'></script>
<script type='text/javascript' src='{{asset('asset/')}}/js/jquery.barfiller.js'></script>
<script type='text/javascript' src='{{asset('asset/')}}/js/custom.js'></script>

<script>


    function readURLNominee(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#nominee')
                    .attr('src', e.target.result)
                    .width(400)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#nid')
                    .attr('src', e.target.result)
                    .width(400)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function signature(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#signatu')
                    .attr('src', e.target.result)
                    .width(300)
                    .height(80);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


    function myFunction() {
        var x=document.getElementById("present_dist").value;
        var y=document.getElementById("present_upazila").value;
        var z=document.getElementById("present_post_code").value;
        var a=document.getElementById("present_village").value;
        if(x=="" || y==""|| z=="" || a==""){
            alert("Please fill all 4 fields in present address");
            document.getElementById("check_address").checked = false;
        }

        else if (confirm("Please Confirm!! Present and permanent addresses are same!")) {
            document.forms['newMember'].elements['permanent_dist'].value = x;
            $.ajax({
                type: 'POST',
                url: '{{url('/permanent-upazila-By-id-for-present')}}',
                data: {id:y,"_token":"{{csrf_token()}}"},


            }).done(function(data) {
                $('#permanent_upa').empty();
                $.each(JSON.parse(data), function (index, subcatObj) {
                    $('#permanent_upa').append('<option value="'+subcatObj.id+'">'+subcatObj.upazila_name+'</option>');
                })

            });
            document.forms['newMember'].elements['permanent_post_code'].value = z;
            document.forms['newMember'].elements['permanent_village'].value = a;
            document.getElementById("permanent_dist").disabled = true;
            document.getElementById("permanent_upa").disabled = true;
            document.getElementById("permanent_post_code").disabled = true;
            document.getElementById("permanent_village").disabled = true;
        } else {
            document.getElementById("check_address").checked = false;
            document.forms['newMember'].elements['permanent_dist'].value = "";
            document.forms['newMember'].elements['permanent_upa'].value = "";
            document.forms['newMember'].elements['permanent_post_code'].value = "";
            document.forms['newMember'].elements['permanent_village'].value = "";
            document.getElementById("permanent_dist").disabled = false;
            document.getElementById("permanent_upa").disabled = false;
            document.getElementById("permanent_post_code").disabled = false;
            document.getElementById("permanent_village").disabled = false;
        }

    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#present_dist").on("change", function(){
        var id = this.value;
        getUpazila(id);
    });

    function getUpazila(id){


        $.ajax({
            type: 'POST',
            url: '{{url('/upazila-By-id')}}',
            data: {id:id,"_token":"{{csrf_token()}}"},


        }).done(function(data) {
            $('#present_upazila').empty();
            $.each(JSON.parse(data), function (index, subcatObj) {
                $('#present_upazila').append('<option value="'+subcatObj.id+'">'+subcatObj.upazila_name+'</option>');
            })

        });
    }
    $("#permanent_dist").on("change", function(){
        var id = this.value;
        getPermanentUpazila(id);
    });

    function getPermanentUpazila(id){


        $.ajax({
            type: 'POST',
            url: '{{url('/permanent-upazila-By-id')}}',
            data: {id:id,"_token":"{{csrf_token()}}"},


        }).done(function(data) {
            $('#permanent_upa').empty();
            $.each(JSON.parse(data), function (index, subcatObj) {
                $('#permanent_upa').append('<option value="'+subcatObj.id+'">'+subcatObj.upazila_name+'</option>');
            })

        });
    }
    $("#nominee_dist").on("change", function(){
        var id = this.value;
        getnomineeUpazila(id);
    });

    function getnomineeUpazila(id){


        $.ajax({
            type: 'POST',
            url: '{{url('/permanent-upazila-By-id')}}',
            data: {id:id,"_token":"{{csrf_token()}}"},


        }).done(function(data) {
            $('#nominee_upazila').empty();
            $.each(JSON.parse(data), function (index, subcatObj) {
                $('#nominee_upazila').append('<option value="'+subcatObj.id+'">'+subcatObj.upazila_name+'</option>');
            })

        });
    }

    function validate() {
      var  name = document.getElementById("applicant_name");

        if (!name.checkValidity()) {
            document.getElementById("error_applicant_name").innerHTML = name.validationMessage;
            document.getElementById("applicant_name").style.borderColor = "red";
        }else{
            document.getElementById("error_applicant_name").innerHTML="";
            document.getElementById("applicant_name").style.borderColor = "green";
        }
    }
    function validate2() {
        var  applicants_father_name = document.getElementById("applicants_father_name");
        if (!applicants_father_name.checkValidity()) {
            document.getElementById("error_applicant_father_name").innerHTML = applicants_father_name.validationMessage;
            document.getElementById("applicants_father_name").style.borderColor = "red";
        }else{
            document.getElementById("error_applicant_father_name").innerHTML="";
            document.getElementById("applicants_father_name").style.borderColor = "green";
        }
    }
    function validate3() {
        var  national_id = document.getElementById("national_id");

        if (!national_id.checkValidity()) {
            document.getElementById("error_national_id").innerHTML = "National ID must be Numeric and between 10 to 20";
            document.getElementById("national_id").style.borderColor = "red";
        }else{
            document.getElementById("error_national_id").innerHTML="";
            document.getElementById("national_id").style.borderColor = "green";
        }
    }
    function validate4() {
        var x=document.getElementById("marital_status").value;
        if(x=="Unmarried"){
            document.getElementById("husband_name").disabled = true;
            document.getElementById("error_husband_name").innerHTML = "";
        }else{
            document.getElementById("husband_name").disabled = false;
            document.getElementById("husband_name").innerHTML="required";
        }
    }
    function validateMobile() {
        var  name = document.getElementById("mobile");

        if (!name.checkValidity()) {
            document.getElementById("error_mobile").innerHTML = name.validationMessage;
            document.getElementById("mobile").style.borderColor = "red";
        }else{
            document.getElementById("error_mobile").innerHTML="";
            document.getElementById("mobile").style.borderColor = "green";
        }
    }
    function getNomineeInfo(){
        var id=$('#accountID').val();

        $.ajax({

            type: 'POST',
            url: '{{url('/get-nominee-by-id')}}',
            data: {aid:id,"_token":"{{csrf_token()}}"}


        }).done(function(data) {

            console.log(data);
            console.log(data.name.applicant_name);

            document.getElementById("amountOfSavings").value =data.amount;
            document.getElementById("amountOfSavings1").value =data.amount;
            document.getElementById("nomineeName").value =data.name.applicant_name;
        });

    }

    function getNomineeInfo2(){
        var id=$('#accountID2').val();

        $.ajax({

            type: 'POST',
            url: '{{url('/get-nominee-by-id')}}',
            data: {aid:id,"_token":"{{csrf_token()}}"}


        }).done(function(data) {

            console.log(data);
            console.log(data.name.applicant_name);

            document.getElementById("amountOfSavings2").value =data.amount;
            document.getElementById("amountOfSavings21").value =data.amount;
            document.getElementById("nomineeName2").value =data.name.applicant_name;
        });

    }

    function GetSumOfApplicant(){
        var id=$('#accountNo').val();

        $.ajax({

            type: 'POST',
            url: '{{url('/get-amount-by-id')}}',
            data: {mid:id,"_token":"{{csrf_token()}}"}


        }).done(function(data) {

            console.log(data);
            document.getElementById("saving").value =data['money'];
            document.getElementById("account_name").value =data['account_name'];
            document.getElementById("prevloan").value =data['prevloan'];
        });

    }

</script>

</body>
</html>
