<?php

namespace App\Http\Controllers;

use App\AboutContent;
use App\Event;
use App\Slide;
use App\StaffInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Auth;
use Image;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewSliderForm(){
        $slides=Slide::orderBy('id','desc')->get();
        return view('Backend.IT.Slider.silder-input-form',['slides'=>$slides]);
    }
    public function newSlide(Request $request){
        $SlideImage = $request->file('slide_name');

        $imageName = $SlideImage->getClientOriginalName();
        $directory = 'websiteImages/';
        $temp = explode(".", $imageName);
        $newfilename= round(microtime(true)) . '.' . end($temp);
        $imgUrlSlide = $directory.$newfilename;
        Image::make($SlideImage)->save($imgUrlSlide);

        $newSlid=new Slide();
        $newSlid->slide_name=$imgUrlSlide;
        $newSlid->save();
        return back()->with('mass','New Slider Added Successfully!');

    }
    public function inActiveSlider($id){
        $SlideById = Slide::find($id);
        $SlideById->status = 0;
        $SlideById->save();
        return redirect('/slider-input')->with('message', 'Slide Inactivated!');
    }
    public function ActiveSlider($id){
        $SlideById = Slide::find($id);
        $SlideById->status = 1;
        $SlideById->save();
        return redirect('/slider-input')->with('message', 'Slide Activated!');
    }



    public function ViewAllstaffs(){
        $staffs=DB::table('users')
            ->join('roles','roles.id','=','users.role')
            ->where('users.access','=',1)
            ->select('users.*','roles.role as roleName')
            ->get();
        return view('Backend.IT.StaffInfo.all-staffs',['staffs'=>$staffs]);
    }
    public function viewFormNewStaff($id){

        $ExistingStaffInfo=StaffInfo::where('user_id',$id)->first();
        $StaffInfo=User::find($id);
        $StaffRole=DB::table('roles')
                    ->join('users','users.role','=','roles.id')
                    ->select('roles.role')
                    ->where('users.id','=',$id)
                    ->first();

        return view('Backend.IT.StaffInfo.teamMember',['ExistingStaffInfo'=>$ExistingStaffInfo,'StaffInfo'=>$StaffInfo,'StaffRole'=>$StaffRole]);
    }
    public function storeStaffInfo(Request $request){

        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'fathers_name'=>'required',
            'mothers_name'=>'required',
            'present_address'=>'required',
            'permanent_address'=>'required',
            'date_of_birth'=>'required',
            'joining_date'=>'required',
            'designation'=>'required',
            'blood_group'=>'required',
            'salary_amount'=>'required|digits_between:4,20',
            'staff_photo'=>'required',
            'mobile_number'=>'required',
        ]);

        $file=$request->file('staff_photo');
        $imageName2 = $file->getClientOriginalName();
        $directory2 = 'Staff_photos/';
        $temp2 = explode(".", $imageName2);
        $newfilename2 = round(microtime(true)) .date('dmYHis').  '.' . end($temp2);
        $imgUrlApplicantNid = $directory2.$newfilename2;
        Image::make($file)->save($imgUrlApplicantNid);

        if ($request->file('cv_doc')) {
            $cv = $request->file('cv_doc');
            $CVName = $cv->getClientOriginalName();
            $nam = explode('.', $CVName)[0];
            $destinationPath = public_path() . '/Staff_photos/';
            $temp2 = explode(".", $CVName);
            $newCVname = round(microtime(true)) . '.' . end($temp2);
            $finalCVName = $nam . $newCVname;
            $cv->move($destinationPath, $finalCVName);
        }
        $newStaff=new StaffInfo();
        $newStaff->user_id=$request->user_id;
        $newStaff->first_name=$request->first_name;
        $newStaff->last_name=$request->last_name;
        $newStaff->fathers_name=$request->fathers_name;
        $newStaff->mothers_name=$request->mothers_name;
        $newStaff->present_address=$request->present_address;
        $newStaff->permanent_address=$request->permanent_address;
        $newStaff->date_of_birth=$request->date_of_birth;
        $newStaff->joining_date=$request->joining_date;
        $newStaff->designation=$request->designation;
        $newStaff->blood_group=$request->blood_group;
        if ($request->file('cv_doc')) {
            $newStaff->cv_doc = $finalCVName;
        }
        $newStaff->description=$request->description;
        $newStaff->bank_account_no=$request->bank_account_no;
        $newStaff->bank_name=$request->bank_name;
        $newStaff->branch_name=$request->branch_name;
        $newStaff->account_holder_name=$request->account_holder_name;
        $newStaff->salary_amount=$request->salary_amount;
        $newStaff->mobile_number=$request->mobile_number;
        $newStaff->staff_photo=$imgUrlApplicantNid;
        $newStaff->save();

        return back()->with('message','Staff Info Added Successfully!');
    }
    public function UpdateStaffInfo(Request $request){

        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'fathers_name'=>'required',
            'mothers_name'=>'required',
            'present_address'=>'required',
            'permanent_address'=>'required',
            'date_of_birth'=>'required',
            'joining_date'=>'required',
            'designation'=>'required',
            'blood_group'=>'required',
            'mobile_number'=>'required',
            'salary_amount'=>'required|digits_between:4,20',
        ]);

        $updateStaffInfo=StaffInfo::where('id',$request->id)->first();
        if ($request->file('staff_photo') && $request->file('cv_doc')){

            $file=$request->file('staff_photo');
            $imageName2 = $file->getClientOriginalName();
            $directory2 = 'Staff_photos/';
            $temp2 = explode(".", $imageName2);
            $newfilename2 = round(microtime(true)) .date('dmYHis').  '.' . end($temp2);
            $imgUrlApplicantNid = $directory2.$newfilename2;
            Image::make($file)->save($imgUrlApplicantNid);

            $cv=$request->file('cv_doc');
            $CVName = $cv->getClientOriginalName() ;
            $nam=explode('.',$CVName)[0];
            $destinationPath = public_path().'/Staff_photos/' ;
            $temp2 = explode(".", $CVName);
            $newCVname= round(microtime(true)) . '.' . end($temp2);
            $finalCVName=$nam.$newCVname;
            $cv->move($destinationPath,$finalCVName);
            $updateStaffInfo->cv_doc=$finalCVName;
            $updateStaffInfo->staff_photo=$imgUrlApplicantNid;
        }elseif($request->file('cv_doc')){

            $cv=$request->file('cv_doc');
            $CVName = $cv->getClientOriginalName() ;
            $nam=explode('.',$CVName)[0];
            $destinationPath = public_path().'/Staff_photos/' ;
            $temp2 = explode(".", $CVName);
            $newCVname= round(microtime(true)) . '.' . end($temp2);
            $finalCVName=$nam.$newCVname;
            $cv->move($destinationPath,$finalCVName);
            $updateStaffInfo->cv_doc=$finalCVName;

        }elseif($request->file('staff_photo')){
            $file=$request->file('staff_photo');
            $imageName2 = $file->getClientOriginalName();
            $directory2 = 'Staff_photos/';
            $temp2 = explode(".", $imageName2);
            $newfilename2 = round(microtime(true)) .date('dmYHis').  '.' . end($temp2);
            $imgUrlApplicantNid = $directory2.$newfilename2;
            Image::make($file)->save($imgUrlApplicantNid);
            $updateStaffInfo->staff_photo=$imgUrlApplicantNid;
        }
        $updateStaffInfo->first_name=$request->first_name;
        $updateStaffInfo->last_name=$request->last_name;
        $updateStaffInfo->fathers_name=$request->fathers_name;
        $updateStaffInfo->mothers_name=$request->mothers_name;
        $updateStaffInfo->present_address=$request->present_address;
        $updateStaffInfo->permanent_address=$request->permanent_address;
        $updateStaffInfo->date_of_birth=$request->date_of_birth;
        $updateStaffInfo->joining_date=$request->joining_date;
        $updateStaffInfo->designation=$request->designation;
        $updateStaffInfo->blood_group=$request->blood_group;
        $updateStaffInfo->description=$request->description;
        $updateStaffInfo->bank_account_no=$request->bank_account_no;
        $updateStaffInfo->bank_name=$request->bank_name;
        $updateStaffInfo->branch_name=$request->branch_name;
        $updateStaffInfo->account_holder_name=$request->account_holder_name;
        $updateStaffInfo->salary_amount=$request->salary_amount;
        $updateStaffInfo->mobile_number=$request->mobile_number;
        $updateStaffInfo->save();

        return back()->with('message','Staff Info Updated Successfully!');
    }
//    public function saveInfo(Request $request){
//        $StaffImage = $request->file('staff_picture');
//
//        $imageName = $StaffImage->getClientOriginalName();
//        $directory = 'websiteImages/';
//        $temp = explode(".", $imageName);
//        $newfilename= round(microtime(true)) . '.' . end($temp);
//        $imgUrlStaff = $directory.$newfilename;
//        Image::make($StaffImage)->save($imgUrlStaff);
//
//
//        $staffInfo=new StaffInfo();
//        $staffInfo->staff_id=$request->staff_id;
//        $staffInfo->staff_picture=$imgUrlStaff;
//        $staffInfo->staff_mobile=$request->staff_mobile;
//        $staffInfo->staff_bio=$request->staff_bio;
//        $staffInfo->save();
//        return back()->with('message','Staff Information Inserted!');
//    }
    public function InactiveInfo($id){
        $StaffInfoById = StaffInfo::find($id);
        $StaffInfoById->status = 0;
        $StaffInfoById->save();
        return redirect('new-staff-info')->with('message', 'Staff Info Paused!');
    }
    public function ActiveInfo($id){
        $StaffInfoById = StaffInfo::find($id);
        $StaffInfoById->status = 1;
        $StaffInfoById->save();
        return redirect('new-staff-info')->with('message', 'Staff Info Activated!');
    }
//    public function editInfo($id){
//        $StaffInfoById = StaffInfo::find($id);
//        return view('back.IT.StaffInfo.EditStaffInfo',['StaffInfoById'=>$StaffInfoById]);
//    }
//    public function updateInfo(Request $request){
//        if ($request->staff_picture){
//            $StaffImage = $request->file('staff_picture');
//
//            $imageName = $StaffImage->getClientOriginalName();
//            $directory = 'websiteImages/';
//            $temp = explode(".", $imageName);
//            $newfilename= round(microtime(true)) . '.' . end($temp);
//            $imgUrlStaff = $directory.$newfilename;
//            Image::make($StaffImage)->save($imgUrlStaff);
//
//
//            $staffInfo=StaffInfo::find($request->staffinfo_id);
//            $staffInfo->staff_picture=$imgUrlStaff;
//            $staffInfo->staff_mobile=$request->staff_mobile;
//            $staffInfo->staff_bio=$request->staff_bio;
//            $staffInfo->save();
//
//            return redirect('new-staff-info')->with('meassage','Staff info Updated with Picture!');
//        }else{
//            $staffInfo=StaffInfo::find($request->staffinfo_id);
//            $staffInfo->staff_mobile=$request->staff_mobile;
//            $staffInfo->staff_bio=$request->staff_bio;
//            $staffInfo->save();
//            return redirect('new-staff-info')->with('meassage','Staff info Updated!');
//        }
//    }

    public function index()
    {

//        if (Auth::user()->role==1 && Auth::user()->role!=2){
//            return view('fonts.home.home-content');
//        }else{
//            return view('admin.dashboard.dashboard-content');
//        }
    }
        public function viewAboutInfoForm(){
                $about=AboutContent::all();
                return view('Backend.IT.About.about-content',['about'=>$about]);
        }
        public function storeAboutContent(Request $request){
            $StaffImage = $request->file('about_picture');
            $imageName = $StaffImage->getClientOriginalName();
            $directory = 'websiteImages/';
            $temp = explode(".", $imageName);
            $newfilename= round(microtime(true)) . '.' . end($temp);
            $imgUrlStaff = $directory.$newfilename;
            Image::make($StaffImage)->save($imgUrlStaff);

            $about=new AboutContent();
            $about->about_content=$request->about_content;
            $about->about_content_bangla=$request->about_content_bangla;
            $about->about_image=$imgUrlStaff;
            $about->status=1;
            $about->Save();
            return redirect('/new-about-info')->with('message','About Added!');
        }

    public function inActiveAbout($id){
        $SlideById = AboutContent::find($id);
        $SlideById->status = 0;
        $SlideById->save();
        return redirect('new-about-info')->with('message', 'About Info Inactivated!');
    }

    public function ActiveAbout($id){
        $SlideById = AboutContent::find($id);
        $SlideById->status = 1;
        $SlideById->save();
        return redirect('new-about-info')->with('message', 'About Info Activated!');
    }
    public function editAbout($id){
        $editInfo = AboutContent::find($id);

        return view('Backend.IT.About.edit-about',['editInfo'=>$editInfo]);
    }
    public function UpdateAbout(Request $request)
    {
        $updateInfo=AboutContent::find($request->id);
        if (isset($request->about_picture)){
            //unlink($updateInfo->about_image);
        $StaffImage = $request->file('about_picture');
        $imageName = $StaffImage->getClientOriginalName();
        $directory = 'websiteImages/';
        $temp = explode(".", $imageName);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $imgUrlStaff = $directory . $newfilename;
        Image::make($StaffImage)->save($imgUrlStaff);
        $updateInfo->about_image=$imgUrlStaff;
         }
        $updateInfo->about_content=$request->about_content;
        $updateInfo->about_content_bangla=$request->about_content_bangla;
        $updateInfo->status=1;
        $updateInfo->Save();
        return redirect('/new-about-info')->with('message','About Info Updated!');
    }

    public function EventPage(){
        $events=Event::all();
        return view('Backend.IT.Events.add-event',['events'=>$events]);
    }
    public function NewEvent(Request $request){
        $this->validate($request,[
           'event_picture'=>'required',
           'heading'=>'required',
           'location'=>'required',
           'date'=>'required',
           'description'=>'required',
        ]);

        $eventPic = $request->file('event_picture');
        $eventName = $eventPic->getClientOriginalName();
        $dire = 'websiteImages/';
        $temp = explode(".", $eventName);
        $filename = round(microtime(true)) ."Event". date('dmYHis'). '.' . end($temp);
        $urlEventPic = $dire.$filename;
        Image::make($eventPic)->save($urlEventPic);

        $newEvent=new Event();
        $newEvent->heading=$request->heading;
        $newEvent->location=$request->location;
        $newEvent->date=$request->date;
        $newEvent->event_picture=$urlEventPic;
        $newEvent->description=$request->description;
        $newEvent->Save();

        return redirect('/all-event')->with('message','New Event Added Successfully!');
    }
    public function editEvent($id){
        $editInfo=Event::find($id);
        return view('Backend.IT.Events.edit-event',['editInfo'=>$editInfo]);
    }
    public function UpdateEvent(Request $request){
        $this->validate($request,[
            'heading'=>'required',
            'location'=>'required',
            'date'=>'required',
            'description'=>'required',
        ]);
        $newEvent=Event::find($request->id);
        $newEvent->heading=$request->heading;
        $newEvent->location=$request->location;
        $newEvent->date=$request->date;

        if (isset($request->event_picture)) {
            $eventPic = $request->file('event_picture');
            $eventName = $eventPic->getClientOriginalName();
            $dire = 'websiteImages/';
            $temp = explode(".", $eventName);
            $filename = round(microtime(true)) . "Event" . date('dmYHis') . '.' . end($temp);
            $urlEventPic = $dire . $filename;
            Image::make($eventPic)->save($urlEventPic);
            $newEvent->event_picture=$urlEventPic;
        }
        $newEvent->description=$request->description;
        $newEvent->Save();

        return redirect('/all-event')->with('message','Event Updated Successfully!');
    }
}
