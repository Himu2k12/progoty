<?php

namespace App\Http\Controllers;

use App\SavingsAccountInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class MemberIncludingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function newMemberForm(){

        return view('back.member-including-form.new-member-form');
    }
    public function addMember(Request $request){
        $request->flush();
        if($request->marital_status!="Unmarried"){
            $this->validate($request, [
                'applicant_name'=>'required|min:4|max:50',
                'applicants_father_name'=>'required|regex:/^[\pL\s\-]+$/u|max:50',
                'national_id'=>'required|min:10|max:50',
                'gender'=>'required',
                'marital_status'=>'required',
                'religion'=>'required',
                'husband_name'=>'required',
                'yearly_scheme'=>'required',
                'deposite_type'=>'required',
                'amount_of_money'=>'required|numeric|min:5',
                'form_fee'=>'required|numeric|min:5',
                'present_dist'=>'required',
                'present_upa'=>'required',
                'present_post_code'=>'required|numeric|digits:4',
                'present_village'=>'required|min:4|max:100',


                'permanent_dist'=>'required',
                'permanent_upa'=>'required',
                'permanent_post_code'=>'required|numeric|digits:4',
                'permanent_village'=>'required|min:4|max:100',


                'nominee_name'=>'required|min:3|max:100',
                'relation'=>'required|min:3|max:100',
                'nominee_dist'=>'required',
                'nomine_nid'=>'required',
                'nominee_upazila'=>'required',
                'nominee_post_code'=>'required|numeric|digits:4',
                'nominee_address'=>'required|min:4|max:100',

                'applicant_photo'=>'required',
                'applicant_nid'=>'required',
                'applicant_signature'=>'required',
                'field_man_id'=>'required',


            ],[
                'applicant_name.required'=>'Applicant Name is Required!',
                'gender.required'=>'Please Select Applicant\'s Gender!',
                'present_dist.required'=>'Please Select Applicant\'s Present District!',
                'permanent_dist.required'=>'Please Select Applicant\'s Permanent District!',
                'present_upa.required'=>'Please Select Applicant\'s Present Thana/Upazila!',
                'permanent_upa.required'=>'Please Select Applicant\'s Permanent Thana/Upazila!',
                'present_village.required'=>'Applicant\'s Present Village/Road No/House No/Address is required!',
                'permanent_village.required'=>'Applicant\'s Permanent Village/Road No/House No/Address is required!',
            ]);
        }else{
            $this->validate($request, [
                'applicant_name'=>'required|min:4|max:50',
                'applicants_father_name'=>'required|regex:/^[\pL\s\-]+$/u|max:50',
                'national_id'=>'required|min:10|max:50',
                'gender'=>'required',
                'marital_status'=>'required',
                'religion'=>'required',

                'yearly_scheme'=>'required',
                'deposite_type'=>'required',
                'amount_of_money'=>'required|numeric|min:5',
                'form_fee'=>'required|numeric|min:5',
                'present_dist'=>'required',
                'present_upa'=>'required',
                'present_post_code'=>'required|numeric|digits:4',
                'present_village'=>'required|min:8|max:100',

                'permanent_dist'=>'required',
                'permanent_upa'=>'required',
                'permanent_post_code'=>'required|numeric|digits:4',
                'permanent_village'=>'required|min:4|max:100',
                'nominee_name'=>'required|min:3|max:100',
                'relation'=>'required|min:3|max:100',
                'nominee_dist'=>'required',
                'nominee_upazila'=>'required',
                'nomine_nid'=>'required',
                'nominee_post_code'=>'required|numeric|digits:4',
                'nominee_address'=>'required|min:8|max:100',

            ],[
                'applicant_name.required'=>'Applicant Name is Required!',
                'gender.required'=>'Please Select Applicant\'s Gender!',
                'present_dist.required'=>'Please Select Applicant\'s Present District!',
                'present_upa.required'=>'Please Select Applicant\'s Present Thana/Upazila!',
                'present_village.required'=>'Applicant\'s Present Village/Road No/House No/Address is required!',

            ]);
        }

        $newMember= new SavingsAccountInfo();
        $newMember->applicant_name=$request->applicant_name;
        $newMember->applicants_father_name=$request->applicants_father_name;
        $newMember->national_id=$request->national_id;
        $newMember->gender=$request->gender;
        $newMember->marital_status=$request->marital_status;
        $newMember->religion=$request->religion;
        $newMember->yearly_scheme=$request->yearly_scheme;
        $newMember->deposite_type=$request->deposite_type;
        $newMember->amount_of_money=$request->amount_of_money;
        $newMember->form_fee=$request->form_fee;
        $newMember->present_dist=$request->present_dist;
        $newMember->present_upa=$request->present_upa;
        $newMember->present_post_code=$request->present_post_code;
        $newMember->present_village=$request->present_village;
        $newMember->permanent_dist=$request->permanent_dist;
        $newMember->permanent_upa=$request->permanent_upa;
        $newMember->permanent_post_code=$request->permanent_post_code;
        $newMember->permanent_village=$request->permanent_village;
        $newMember->nominee_name=$request->nominee_name;
        $newMember->relation=$request->relation;
        $newMember->nominee_dist=$request->nominee_dist;
        $newMember->nominee_upazila=$request->nominee_upazila;
        $newMember->nominee_post_code=$request->nominee_post_code;
        $newMember->nominee_address=$request->nominee_address;

        $applicantsImage = $request->file('nomine_nid');
        $imageName = $applicantsImage->getClientOriginalName();
        $directory = 'nominee_photos/';
        $temp = explode(".", $imageName);
        $newfilename= round(microtime(true)) . '.' . end($temp);
        $imgUrlNominee = $directory.$newfilename;
        Image::make($applicantsImage)->resize(200, 200)->save($imgUrlNominee);
        $newMember->nomine_nid=$imgUrlNominee;

        $applicantsImage1 = $request->file('applicant_photo');
        $imageName1 = $applicantsImage1->getClientOriginalName();
        $directory1 = 'nominee_photos/';
        $temp1 = explode(".", $imageName1);
        $newfilename1 = round(microtime(true)) . '.' . end($temp1);
        $imgUrlApplicantPhotos = $directory1.$newfilename1;
        Image::make($applicantsImage1)->resize(200, 200)->save($imgUrlApplicantPhotos);
        $newMember->applicant_photo=$imgUrlApplicantPhotos;

        $applicantsNid = $request->file('applicant_nid');
        $imageName2 = $applicantsNid->getClientOriginalName();
        $directory2 = 'applicants_nid/';
        $temp2 = explode(".", $imageName2);
        $newfilename2 = round(microtime(true)) . '.' . end($temp2);
        $imgUrlApplicantNid = $directory2.$newfilename2;
        Image::make($applicantsNid)->resize(200, 200)->save($imgUrlApplicantNid);
        $newMember->applicant_nid=$imgUrlApplicantNid;

        $signature = $request->file('applicant_signature');
        $sigName = $signature->getClientOriginalName();
        $dire = 'applicant_photos/';
        $temp = explode(".", $sigName);
        $filename = round(microtime(true)) . '.' . end($temp);
        $UrlSignature = $dire.$filename;
        Image::make($signature)->save($UrlSignature);
        $newMember->applicant_signature=$UrlSignature;

        $newMember->field_man_id=Auth::user()->id;
        $newMember->save();


        return back()->with('mass','Applicant info saved successfully!!!');
    }
}
