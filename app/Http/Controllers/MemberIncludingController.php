<?php

namespace App\Http\Controllers;

use App\AdditionalCollection;
use App\CollectionCategory;
use App\SavingsAccountInfo;
use App\Upazila;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class MemberIncludingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function newMemberForm(){
        $collectionSector=CollectionCategory::where('status',1)->get();
        return view('front.member-including-form.new-member-form',['collectionSector'=>$collectionSector]);
    }
    public function addMember(Request $request)
    {
        $request->flush();

        $this->validate($request, [
            'applicant_name' => 'required|min:4|max:50',
            'applicants_father_name' => 'required|max:50',
            'national_id' => 'required|min:10|max:50',
            'gender' => 'required',
            'marital_status' => 'required',
            'religion' => 'required',
            'mobile' => 'required|numeric|digits:11',
            'yearly_scheme' => 'required',
            'deposite_type' => 'required',
            'amount_of_money' => 'required|numeric|min:1',
            'form_fee' => 'required|numeric|min:5',
            'present_dist' => 'required',
            'present_upa' => 'required',
            'present_post_code' => 'required|numeric|digits:4',
            'present_village' => 'required|min:4|max:100',

            'permanent_dist' => 'required',
            'permanent_upa' => 'required',
            'permanent_post_code' => 'required|numeric|digits:4',
            'permanent_village' => 'required|min:4|max:100',
            'nominee_name' => 'required|min:3|max:100',
            'relation' => 'required|min:3|max:100',
            'nominee_dist' => 'required',
            'nominee_upazila' => 'required',
            'nomine_nid' => 'mimes:jpeg,jpg,png|max:6000',
            'nominee_post_code' => 'required|numeric|digits:4',
            'nominee_address' => 'required|min:8|max:100',


            'applicant_photo' => 'required|mimes:jpeg,jpg,png|max:6000',
            'applicant_nid' => 'required|mimes:jpeg,jpg,png|max:6000',
            'applicant_signature' => 'required|mimes:jpeg,jpg,png|max:6000',

        ], [
            'applicant_name.required' => 'Applicant Name is Required!',
            'gender.required' => 'Please Select Applicant\'s Gender!',
            'present_dist.required' => 'Please Select Applicant\'s Present District!',
            'present_upa.required' => 'Please Select Applicant\'s Present Thana/Upazila!',
            'present_village.required' => 'Applicant\'s Present Village/Road No/House No/Address is required!',

        ]);


        $newMember = new SavingsAccountInfo();
        $newMember->applicant_name = $request->applicant_name;
        $newMember->applicants_father_name = $request->applicants_father_name;
        $newMember->national_id = $request->national_id;
        $newMember->gender = $request->gender;
        if ($request->marital_status != "Unmarried") {
            $newMember->husband_name = $request->husband_name;
        }
        $newMember->marital_status = $request->marital_status;
        $newMember->religion = $request->religion;
        $newMember->yearly_scheme = $request->yearly_scheme;
        $newMember->deposite_type = $request->deposite_type;
        $newMember->amount_of_money = $request->amount_of_money;
        $newMember->form_fee = $request->form_fee;
        $newMember->mobile = $request->mobile;
        $newMember->present_dist = $request->present_dist;
        $newMember->present_upa = $request->present_upa;
        $newMember->present_post_code = $request->present_post_code;
        $newMember->present_village = $request->present_village;
        $newMember->permanent_dist = $request->permanent_dist;
        $newMember->permanent_upa = $request->permanent_upa;
        $newMember->permanent_post_code = $request->permanent_post_code;
        $newMember->permanent_village = $request->permanent_village;
        $newMember->nominee_name = $request->nominee_name;
        $newMember->relation = $request->relation;
        $newMember->nominee_dist = $request->nominee_dist;
        $newMember->nominee_upazila = $request->nominee_upazila;
        $newMember->nominee_post_code = $request->nominee_post_code;
        $newMember->nominee_address = $request->nominee_address;

        if ($request->nomine_nid){
            $applicantsImage = $request->file('nomine_nid');
            $imageName = $applicantsImage->getClientOriginalName();
            $directory = 'nominee_photos/';
            $temp = explode(".", $imageName);
            $newfilename = round(microtime(true)) . date('dmYHis') . '.' . end($temp);
            $imgUrlNominee = $directory . $newfilename;
            Image::make($applicantsImage)->resize(300, 150)->save($imgUrlNominee);
            $newMember->nomine_nid = $imgUrlNominee;
        }
        $applicantsImage1 = $request->file('applicant_photo');
        $imageName1 = $applicantsImage1->getClientOriginalName();
        $directory1 = 'applicant_photos/';
        $temp1 = explode(".", $imageName1);
        $newfilename1 = round(microtime(true)) . date('dmYHis').  '.' . end($temp1);
        $imgUrlApplicantPhotos = $directory1.$newfilename1;
        Image::make($applicantsImage1)->resize(200, 200)->save($imgUrlApplicantPhotos);
        $newMember->applicant_photo=$imgUrlApplicantPhotos;

        $applicantsNid = $request->file('applicant_nid');
        $imageName2 = $applicantsNid->getClientOriginalName();
        $directory2 = 'applicants_nid/';
        $temp2 = explode(".", $imageName2);
        $newfilename2 = round(microtime(true)) .date('dmYHis').  '.' . end($temp2);
        $imgUrlApplicantNid = $directory2.$newfilename2;
        Image::make($applicantsNid)->resize(300,150)->save($imgUrlApplicantNid);
        $newMember->applicant_nid=$imgUrlApplicantNid;

        $signature = $request->file('applicant_signature');
        $sigName = $signature->getClientOriginalName();
        $dire = 'applicant_photos/';
        $temp = explode(".", $sigName);
        $filename = round(microtime(true)) ."signarute". date('dmYHis'). '.' . end($temp);
        $UrlSignature = $dire.$filename;
        Image::make($signature)->resize(140, 60)->save($UrlSignature);
        $newMember->applicant_signature=$UrlSignature;
        $newMember->field_man_id=Auth::user()->id;
        $newMember->save();


        $additionalCost=new AdditionalCollection();
        $additionalCost->additional_cost=$request->form_fee;
        $additionalCost->collection_category=$request->collection_category;
        $additionalCost->date_of_cost=date('Y-m-d');
        $additionalCost->description="Account No: ".$newMember->id.". Account Opening Form fee";
        $additionalCost->created_by=Auth::user()->id;
        $additionalCost->save();


        return back()->with('mass','Applicant info saved successfully!!!');
    }
    public function allMembers(){
        $members=SavingsAccountInfo::where('field_man_id','=',Auth::user()->id)->get();
        return view('Backend.FieldOfficer.Members.all-members',['members'=>$members]);
    }
    public function editMemberDetails($slug){
            $EditmemberDetails=SavingsAccountInfo::where('slug',$slug)->first();
            $permanentAdressUpazilas=Upazila::where('district_id',$EditmemberDetails->permanent_dist)->get();
            $NomineeUpazilas=Upazila::where('district_id',$EditmemberDetails->nominee_dist)->get();
            $collectionSector=CollectionCategory::where('status',1)->get();
        return view('front.member-including-form.edit-member-including',['collectionSector'=>$collectionSector,'EditmemberDetails'=>$EditmemberDetails,'permanentAdressUpazilas'=>$permanentAdressUpazilas,'NomineeUpazilas'=>$NomineeUpazilas]);
    }
    public function detailsMemberView($slug){
        $viewMember=DB::table('savings_account_infos')
            ->join('users','users.id','=','savings_account_infos.field_man_id')
            ->select('savings_account_infos.*','users.id as Sid','users.name')
            ->where('savings_account_infos.slug','=',$slug)
            ->where('savings_account_infos.field_man_id','=',Auth::user()->id)
            ->first();
            $upazilaName=new Upazila();
        return view('Backend.FieldOfficer.Members.details-of-members',['viewMember'=>$viewMember,'upazilaName'=>$upazilaName]);
    }
    public function UpdateMember(Request $request)
    {
        $this->validate($request, [
            'applicant_name' => 'required|min:4|max:50',
            'applicants_father_name' => 'required|max:50',
            'national_id' => 'required|min:10|max:50',
            'gender' => 'required',
            'marital_status' => 'required',
            'religion' => 'required',
            'mobile' => 'required|numeric|digits:11',
            'yearly_scheme' => 'required',
            'deposite_type' => 'required',
            'amount_of_money' => 'required|numeric|min:5',
            'present_dist' => 'required',
            'present_upa' => 'required',
            'present_post_code' => 'required|numeric|digits:4',
            'present_village' => 'required|min:4|max:100',


            'permanent_dist' => 'required',
            'permanent_upa' => 'required',
            'permanent_post_code' => 'required|numeric|digits:4',
            'permanent_village' => 'required|min:4|max:100',


            'nominee_name' => 'required|min:3|max:100',
            'relation' => 'required|min:3|max:100',
            'nominee_dist' => 'required',
            'nominee_upazila' => 'required',
            'nominee_post_code' => 'required|numeric|digits:4',
            'nominee_address' => 'required|min:4|max:100',
            'applicant_photo' => 'mimes:jpeg,jpg,png|max:6000',
        ], [
            'applicant_name.required' => 'Applicant Name is Required!',
            'gender.required' => 'Please Select Applicant\'s Gender!',
            'present_dist.required' => 'Please Select Applicant\'s Present District!',
            'permanent_dist.required' => 'Please Select Applicant\'s Permanent District!',
            'present_upa.required' => 'Please Select Applicant\'s Present Thana/Upazila!',
            'permanent_upa.required' => 'Please Select Applicant\'s Permanent Thana/Upazila!',
            'present_village.required' => 'Applicant\'s Present Village/Road No/House No/Address is required!',
            'permanent_village.required' => 'Applicant\'s Permanent Village/Road No/House No/Address is required!',
        ]);

        if ($request->marital_status != "Unmarried") {
            $this->validate($request, [
                'husband_name' => 'required',
            ]);

        }
        $updateMember=SavingsAccountInfo::find($request->id);
        $updateMember->applicant_name=$request->applicant_name;
        $updateMember->applicants_father_name=$request->applicants_father_name;
        $updateMember->national_id=$request->national_id;
        $updateMember->gender=$request->gender;
        if ($request->husband_name){
            $updateMember->husband_name=$request->husband_name;
        }else{
            $updateMember->husband_name=null;
        }
        $updateMember->marital_status=$request->marital_status;
        $updateMember->religion=$request->religion;
        $updateMember->yearly_scheme=$request->yearly_scheme;
        $updateMember->deposite_type=$request->deposite_type;
        $updateMember->amount_of_money=$request->amount_of_money;
        $updateMember->mobile=$request->mobile;
        $updateMember->present_dist=$request->present_dist;
        $updateMember->present_upa=$request->present_upa;
        $updateMember->present_post_code=$request->present_post_code;
        $updateMember->present_village=$request->present_village;
        $updateMember->permanent_dist=$request->permanent_dist;
        $updateMember->permanent_upa=$request->permanent_upa;
        $updateMember->permanent_post_code=$request->permanent_post_code;
        $updateMember->permanent_village=$request->permanent_village;
        $updateMember->nominee_name=$request->nominee_name;
        $updateMember->relation=$request->relation;
        $updateMember->nominee_dist=$request->nominee_dist;
        $updateMember->nominee_upazila=$request->nominee_upazila;
        $updateMember->nominee_post_code=$request->nominee_post_code;
        $updateMember->nominee_address=$request->nominee_address;
        if ($request->nomine_nid) {
            $applicantsImage = $request->file('nomine_nid');
            $imageName = $applicantsImage->getClientOriginalName();
            $directory = 'nominee_photos/';
            $temp = explode(".", $imageName);
            $newfilename = round(microtime(true)) . date('dmYHis') . '.' . end($temp);
            $imgUrlNominee = $directory . $newfilename;
            Image::make($applicantsImage)->resize(300, 150)->save($imgUrlNominee);
            $updateMember->nomine_nid = $imgUrlNominee;
        }
        if ($request->applicant_photo) {
            $applicantsImage1 = $request->file('applicant_photo');
            $imageName1 = $applicantsImage1->getClientOriginalName();
            $directory1 = 'applicant_photos/';
            $temp1 = explode(".", $imageName1);
            $newfilename1 = round(microtime(true)) . date('dmYHis') . '.' . end($temp1);
            $imgUrlApplicantPhotos = $directory1 . $newfilename1;
            Image::make($applicantsImage1)->resize(200, 200)->save($imgUrlApplicantPhotos);
            $updateMember->applicant_photo = $imgUrlApplicantPhotos;
        }
        if ($request->applicant_nid) {
            $applicantsNid = $request->file('applicant_nid');
            $imageName2 = $applicantsNid->getClientOriginalName();
            $directory2 = 'applicants_nid/';
            $temp2 = explode(".", $imageName2);
            $newfilename2 = round(microtime(true)) . date('dmYHis') . '.' . end($temp2);
            $imgUrlApplicantNid = $directory2 . $newfilename2;
            Image::make($applicantsNid)->resize(300, 150)->save($imgUrlApplicantNid);
            $updateMember->applicant_nid = $imgUrlApplicantNid;
        }
        if ($request->applicant_signature) {
            $signature = $request->file('applicant_signature');
            $sigName = $signature->getClientOriginalName();
            $dire = 'applicant_photos/';
            $temp = explode(".", $sigName);
            $filename = round(microtime(true)) .'signarute'. date('dmYHis') . '.' . end($temp);
            $UrlSignature = $dire . $filename;
            Image::make($signature)->resize(140, 60)->save($UrlSignature);
            $updateMember->applicant_signature = $UrlSignature;
        }
        $updateMember->save();

        return back()->with('mass','Member Info Updated Successfully!');

    }
}
