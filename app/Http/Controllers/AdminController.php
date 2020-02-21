<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Feedback;
use App\MotivationalQuote;
use App\Motivations;
use App\Mpo;
use App\Partner;
use App\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function homeContent()
    {
        return view('vendor.multiauth.homeContent.index');
    }

    public function carousel()
    {
        return view('vendor.multiauth.homeContent.carousel');
    }

    public function carouselStore(Request $request)
    {
        dd($request);
    }

    public function motivational()
    {
        $active = Motivations::where('active', true)->latest()->first();
        return view('vendor.multiauth.homeContent.motivational')->with('active', $active);
    }
    
    private function updateQuote($request, $mot_id)
    {
        $prevQuotes = MotivationalQuote::where('motivations_id', $mot_id);
        $prevQuotes->delete();
        

        $quotes1 = new MotivationalQuote;
        $quotes1->quotes = $request->quote1;
        $quotes1->motivations_id = $mot_id;
        $quotes1->save();
        
        $quotes2 = new MotivationalQuote;
        $quotes2->quotes = $request->quote2;
        $quotes2->motivations_id = $mot_id;
        $quotes2->save();
        
        $quotes3 = new MotivationalQuote;
        $quotes3->quotes = $request->quote3;
        $quotes3->motivations_id = $mot_id;
        $quotes3->save();
    }

    public function motivationStore(Request $request)
    {
        $pre_active = Motivations::where('active', true)->latest()->first();
        $prev_mot_id = $pre_active->id;
        $for_update = Motivations::find($prev_mot_id);
        
        
        if ($request->motivation_video == null) {
            $prev_name = $request->prev_video_name;
            $for_update->video = $prev_name;
            $for_update->save();
            
            $validateQuotes = $request->validate([
                'quote1' => 'required',    
                'quote2' => 'required',    
                'quote3' => 'required'    
            ]);
            
            if ($validateQuotes) {
                // Delete previous quotes before adding new onces
                $prevQuotes = MotivationalQuote::where('motivations_id', $prev_mot_id);
                $prevQuotes->delete();
                
        
                $this->updateQuote($request, $prev_mot_id);
                
                return redirect(route('admin.homeContent.motivational'))->with('message', 'Successfully done');
            }

        } else {
            // Validate the video and then replace the existing one
            $messages = ['motivation_video.required' => 'Motivational video is required.'];

            $validateData = $request->validate([
               'motivation_video' => 'mimes:mp4,mpeg',
               'quote1' => 'required',    
               'quote2' => 'required',    
               'quote3' => 'required' 
            ], $messages);
            
            
            if ($validateData) {
                if ($request->hasFile('motivation_video')) {
                    $file = $request->file('motivation_video');

                    $destination = 'videos' . DIRECTORY_SEPARATOR;
                    
                    $prev_video_name = $pre_active->video;

                    if (file_exists($destination . $prev_video_name)) {
                        unlink($destination . $prev_video_name);
                    }
                    
                    $motivation = new Motivations;
                    $quotes = new MotivationalQuote;
    
                    // Deleting previous record from database
                    $prev_mot_id = $pre_active->id;
                    $for_delete = Motivations::find($prev_mot_id);
                    $for_delete->delete();
                    
                    // Creating Motivation with video and get back ID
                    $originalName = $file->getClientOriginalName();
                    $motivations_id = $motivation->create(['video' => $originalName, 'active' => 1])->id;
                    $file->move($destination, $originalName);

                    // Delete previous quotes before adding new onces
                    $prevQuotes = MotivationalQuote::where('motivations_id', $prev_mot_id);
                    $prevQuotes->delete();
                    
            
                    $this->updateQuote($request, $motivations_id);
                
                    return redirect(route('admin.homeContent.motivational'))->with('message', 'Successfully done');
                }
            }
        }
    }

    // Mission, Philosophy and Objective View
    public function mpo()
    {
        $mpo = Mpo::first();
        return view('vendor.multiauth.homeContent.mpo')->with('mpo', $mpo);
    }

    public function mpoStore(Request $request)
    {
        $validatedData = $request->validate([
            'mission' => 'required|max:400',
            'philosophy' => 'required',
            'objective' => 'required|max:400'
        ]);

        if ($validatedData) {

            $prev_mpo = Mpo::first();
            $prev_id = $prev_mpo->id;

            $to_delete = Mpo::find($prev_id);
            $to_delete->delete();

            $mpo = new Mpo;

            $mpo->create($request->all());
            return redirect(route('admin.homeContent.mpo'))->with('message', 'Successfully done');
        }

        return false;
    }

    protected function partners()
    {
        $partners = Partner::all();
        return view('vendor.multiauth.homeContent.partners')->with('partners', $partners);
    }

    public function partnerStore(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200|min:3',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:512',
            'description' => 'required|max:200',
        ]);

        $validator->validated();

        $file = $request->file('image');
        $destination = 'img/partners' . DIRECTORY_SEPARATOR;
        $imageName = time() .'_'. $file->getClientOriginalName();

        $file->move($destination, $imageName);

        $partner = new Partner;

        $partner->name = $request->name;
        $partner->description = $request->description;
        $partner->image = $imageName;

        $partner->save();

        return redirect(route('admin.homeContent.partners'))->with('message', 'Successfully done');
    }

    public function editPartner($id)
    {
        $partner = Partner::findOrfail($id);

        return view('vendor.multiauth.homeContent.editPartner')->with('partner', $partner);
    }

    public function updatePartner(Request $request, $id)
    {
        $partner = Partner::find($id);

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200|min:3',
            'description' => 'required|max:200',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:512'
        ]);

        $validator->validated();

        $destination = 'img/partners' . DIRECTORY_SEPARATOR;

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $imageName = time() .'_'. $file->getClientOriginalName();

            if (file_exists($destination . $partner->image)) {
                unlink($destination . $partner->image);
            }

            $file->move($destination, $imageName);

        } else {
            $imageName = $partner->image;
        }


        $partner->name = $request->name;
        $partner->description = $request->description;
        $partner->featured = $request->status;
        $partner->image = $imageName;

        $partner->save();

        return redirect(route('admin.homeContent.partners'))->with('message', 'Successfully done');
    }

    public function test() {
        dd("CourseTest");
    }

    public function getFeedbacks()
    {
        $feedbacks = Feedback::all();
        return view('vendor.multiauth.homeContent.feedbacks')->with(['feedbacks' => $feedbacks]);
    }
    
    public function getTestimonies()
    {
        $testimonies = Testimony::latest()->paginate(3);
        return view('vendor.multiauth.homeContent.testimonies')->with(['testimonies' => $testimonies]);
    }

    // Update Testimony is_visible variable
    public function updateVisibilty($tId)
    {
        $testimony = Testimony::find($tId);

        $is_visible = !$testimony->is_visible;

        $testimony->is_visible = $is_visible;
        $testimony->save();

        return redirect()->back()->with(['success' => 'Action executed successfully']);
    }

    // destroy Testimony
    public function destroyTestimony($tId)
    {
        $testimony = Testimony::find($tId);

        $testimony->delete();

        return redirect()->back()->with(['warning' => 'Action executed successfully']);
    }

    // destroy Feedback
    public function destroyFeedback($tId)
    {
        $feedback = Feedback::findOrFail($tId);

        $feedback->delete();

        return redirect()->back()->with(['warning' => 'Action executed successfully']);
    }

    // Certificate Handling
    public function getCertificates()
    {
        $certificates = Certificate::all();
        return view('vendor.multiauth.certificate.index')->with(['certificates' => $certificates]);
    }

    public function createCertificate()
    {
        return view('vendor.multiauth.certificate.create');
    }

    public function showCertificate($certId)
    {
        $certificate = Certificate::find($certId);
        return view('vendor.multiauth.certificate.show')->with(['certificate' => $certificate]);
    }

    public function storeCertificate(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'certificate_id' => 'required|max:200|min:3',
            'student_name' => 'required',
            'image' => 'required|image',
            'course_name' => 'required',
            'grade' => 'required'
        ]);

        $validator->validated();

        // Check if certificate id already exist
        if (Certificate::where('certificate_id', '=', $request->certificate_id)->exists()) {
            return back()->with('error', 'This Certificate already exists.');
        }

        $student_image = $request->file('image');
        $originalName = $student_image->getClientOriginalName();

        $originalName = time() .'_'. $originalName;
        $destination = 'cert_student_images' . DIRECTORY_SEPARATOR;

        $student_image->move($destination, $originalName);



        Certificate::create([
            'certificate_id' => $request->certificate_id,
            'student_name' => $request->student_name,
            'student_image' => $originalName,
            'course_name' => $request->course_name,
            'grade' => $request->grade
        ]);

        return redirect(route('admin.certificate.create'))->with(['success' => 'Certificate Added Successfully. Add Another or go back to home.']);
    }

    public function editCertificate($certId)
    {
        $certificate = Certificate::findOrFail($certId);
        return view('vendor.multiauth.certificate.edit')->with(['certificate' => $certificate]);
    }

    public function updateCertificate(Request $request, $certId)
    {
        $previousData = Certificate::find($certId);
        $prev_image = $previousData->student_image;

        // Validation
        $validator = Validator::make($request->all(), [
            'certificate_id' => 'required|max:200|min:3',
            'student_name' => 'required',
            'course_name' => 'required',
            'grade' => 'required'
        ]);

        $validator->validated();

        $student_image = $request->file('image');

        $originalName = $prev_image;

        if ($student_image !== null) {
            $originalName = $student_image->getClientOriginalName();
            $originalName = time() .'_'. $originalName;

            $destination = 'cert_student_images' . DIRECTORY_SEPARATOR;

            if (file_exists($destination . $prev_image)) {
                unlink($destination . $prev_image);
            }

            $student_image->move($destination, $originalName);

        } else {
            $originalName = $prev_image;
        }

        $previousData->certificate_id = $request->certificate_id;
        $previousData->student_name = $request->student_name;
        $previousData->student_image = $originalName;
        $previousData->course_name = $request->course_name;
        $previousData->grade = $request->grade;


        $previousData->save();

        return redirect(route('admin.certificate.show', $certId))->with('success', 'Certificate Updated Successfully.');
    }

    public function deleteCertificate($certId)
    {
        $certificate = Certificate::findOrFail($certId);

        $student_image = $certificate->student_image;

        $destination = 'cert_student_images' . DIRECTORY_SEPARATOR;

        if (file_exists($destination . $student_image)) {
            unlink($destination . $student_image);
        }

        $certificate->delete();
        return redirect(route('admin.certificate'))->with('danger', 'Certificate Deleted Successfully.');
    }

}
