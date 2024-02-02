<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <title>
        Account Details
    </title>
</head>
<!------ Include the above in your HEAD tag ---------->
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div style="float: left">
                <img src="{{asset('asset/images/')}}/logo_menu.jpg"  alt="New York Logo" height="100px" width="100px" />

            </div>
            <div style="width: 470px; float: left; text-align: center" >
                <h3 style="padding-left: 5px; margin-bottom: 0px; color:#354356"><strong>Progaty Savings and Loans Co-operative Society Ltd.</strong></h3>
                <h6 style="padding-left: 5px; margin-top: 0px;margin-bottom: 0px; color:green"><strong>Approved by the People's Republic of Bangladesh</strong></h6>
                <h6 style="padding-left: 5px; margin-top: 0px;margin-bottom: 0px; color:darkolivegreen"><strong>Newashi, Nageswari, Kurigram</strong></h6>
                <h6 style="padding-left: 5px; margin-top: 0px;margin-bottom: 0px; color:#354356"><strong>GOV: REG: No: 67/ Reformed REG: No: 001</strong></h6>
                <h6 style="padding-left: 5px; margin-top: 0px;margin-bottom: 0px; color:#354356"><strong>Founded: 2005</strong></h6>
            </div>
            <div style="width:150px; float: left;padding-top: 25px ">
                <h6 style="margin: 0; padding: 0"> Call Us: +8801718910757</h6>
                <h6 style="margin: 0; padding: 0">bdpssl@gmail.com</h6>
                <h6 style="margin: 0; padding: 0">www.progatybd.com</h6>
                <p style="font-size: 10px">Printed By: <span style="color: #2fa360;"> {{Auth::user()->name}}</span> | {{date("h:i:sa")}} | {{Date('Y-m-d')}}</p>
            </div>
            <div style="clear: both"></div>

            <div style="clear: both"></div>
            <hr>
            <h3 style="text-align: center;color:#354356"><strong>Account Details</strong></h3>
        </div>
    </div>
</div>
<div style="float: left">

    <table>
        <tr>
            <td style="height: 25px;">
                <label for="male">Name:</label>
            </td>
            <td>
                <b>{{$userInfo->applicant_name}}</b>
            </td>
        </tr>
        <tr>
            <td style="height: 25px;width: 100px">
                <label for="male">Account No:</label>
            </td>
            <td>
                <b>{{$userInfo->id}}</b>
            </td>
            <td style="height: 25px;width: 100px">
                <label for="male">Yearly Scheme:</label>
            </td>
            <td>
                <b>{{$userInfo->yearly_scheme}}</b> years
            </td>
        </tr>
        <tr>
            <td style="height: 25px;width: 100px">
                <label for="male">Deposite Type:</label>
            </td>
            <td>
                <b>{{$userInfo->deposite_type}}</b>
            </td>
            <td style="height: 25px;width: 100px">
                <label for="male">Amount Of deposite:</label>
            </td>
            <td>
                <b>{{$userInfo->amount_of_money}}</b>
            </td>
            <td style="height: 25px;width: 100px">
                <label for="male">Form Fee:</label>
            </td>
            <td>
                <b>{{$userInfo->form_fee}}</b>
            </td>
        </tr>

    </table>

</div>
<div style="text-align: right">
    
    <img src="{{asset($userInfo->applicant_photo)}}" height="100" width="100">
</div>
<div style="clear: both"></div>
<h3 style="text-align: center;color:#354356;padding-top: 10px"><strong>Personal Informations</strong></h3>
<table>
    <tr>
        <td style="height: 50px;">
            <label for="male">Father's Name:</label>
        </td>
        <td>
             <b>{{$userInfo->applicants_father_name}}</b>
        </td>
        <td style="padding-left: 200px">
            <label for="male">Marital Status:</label>
        </td>
        <td>
            <b>{{$userInfo->marital_status}}</b>
        </td>
    </tr>
    <tr>
        <td>
            <label for="male">National Id:</label>
        </td>
        <td>
            <b>{{$userInfo->national_id}}</b>
        </td>
        <td style="padding-left: 200px">
            <label for="male">Spouse Name:</label>
        </td>
        <td>
            <b>{{$userInfo->husband_name}}</b>
        </td>
    </tr>
    <tr>
        <td style="height: 0px;">
            <label for="male">Gender:</label>
        </td>
        <td>
            <b>{{$userInfo->gender}}</b>
        </td>
        <td style="padding-left: 200px">
            <label for="male">Religion:</label>
        </td>
        <td>
            <b>{{$userInfo->religion}}</b>
        </td>

    </tr>
</table>
<h3 style="text-align: center;color:#354356"><strong>Present Address</strong></h3>
<table>
    <tr>
        <td style="height: 25px;">
            <label for="male">District:</label>
        </td>
        <td>
            <b>{{$userInfo->present_dist}}</b>
        </td>
        <td style="padding-left: 250px">
            <label for="male">Upazila:</label>
        </td>
        <td>
            <b>{{$userInfo->present_upa}}</b>
        </td>
    </tr>
    <tr>
        <td style="width:10%">
            <label for="male">Post Code:</label>
        </td>
        <td>
            <b>{{$userInfo->present_post_code}}</b>
        </td>
        <td style="padding-left: 250px">
            <label for="male">Village/Road:</label>
        </td>
        <td>
            <b>{{$userInfo->present_village}}</b>
        </td>
    </tr>
</table>

<h3 style="text-align: center;color:#354356"><strong>Permanent Address</strong></h3>
<table>
    <tr>
        <td style="height: 25px;">
            <label for="male">District:</label>
        </td>
        <td>
            <b>{{$userInfo->permanent_dist==1?'Kurigram':'Lalmonirhat'}}</b>
        </td>
        <td style="padding-left: 250px">
            <label for="male">Upazila:</label>
        </td>
        <td>
            <b>{{$PermanentupazilaName->upazila_name}}</b>
        </td>
    </tr>
    <tr>
        <td style="width:10%">
            <label for="male">Post Code:</label>
        </td>
        <td>
            <b>{{$userInfo->present_post_code}}</b>
        </td>
        <td style="padding-left: 250px">
            <label for="male">Village/Road:</label>
        </td>
        <td>
            <b>{{$userInfo->present_village}}</b>
        </td>
    </tr>
</table>

<h3 style="text-align: center;color:#354356; padding-bottom: 0px"><strong>Nominee Informations</strong></h3>
<table>
    <tr style="width:50%">
        <td style="height: 25px;">
            <label for="male">Nominee:</label>
        </td>
        <td style="width:30%">
            <b>{{$userInfo->nominee_name}}</b>
        </td>
        <td style="padding-left: 150px">
            <label for="male">Relation:</label>
        </td>
        <td>
            <b>{{$userInfo->relation}}</b>
        </td>
    </tr>
    <tr style="width:50%">
        <td>
            <label for="male">District:</label>
        </td>
        <td>
            <b>{{$userInfo->nominee_dist==1?'Kurigram':'Lalmonirhat'}}</b>
        </td>
        <td style="padding-left: 150px">
            <label for="male">Upazila:</label>
        </td>
        <td>
            <b>{{$NomineeupazilaName->upazila_name}}</b>
        </td>
    </tr>
    <tr>

        <td style="height: 25px">
            <label for="male">Post Code:</label>
        </td>
        <td>
            <b>{{$userInfo->nominee_post_code}}</b>
        </td>
        <td style="padding-left: 150px">
            <label for="male">Address:</label>
        </td>
        <td>
            <b>{{$userInfo->nominee_address}}</b>
        </td>
    </tr>
</table>
<br>
<br>
<table>
    <tr style=height:50px;>
    <td><img src="{{asset($userInfo->applicant_signature)}}"></td>
    </tr>
    <tr>
    <td style="padding-left: 20px">Signature</td>
    </tr>
</table>
</body>
</html>
