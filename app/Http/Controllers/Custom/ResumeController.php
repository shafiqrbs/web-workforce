<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\File;
use Validator;
use Auth;

class ResumeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }

        $userResume = DB::table('profile_cvs')->where('user_id', $user->id)->first();
        return view('user.resumes.index')->with(['user'=>$user, 'userResume'=>$userResume]);
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'resume' => 'required|mimes:docx,pdf'
        ]);
        $user = auth()->user();
        $fileName = $user->id.'-'.$request->file('resume')->getClientOriginalName();
        $fileExtension=$request->file('resume')->getClientOriginalExtension();
        $pathToFile = public_path('/cvs/'.$fileName);
        if(File::exists($pathToFile)){
            File::delete($pathToFile);
        }
        $request->resume->move(public_path('cvs'), $fileName);
        $item =  DB::table('profile_cvs')->where('user_id',$user->id)->where('cv_file',$fileName)->first();
        DB::table('profile_cvs')->where('user_id',$user->id)->delete();
        DB::table('profile_cvs')->insert(['user_id'=>$user->id, 'cv_file'=>$fileName]);
        $content='';
        if($fileExtension=='pdf'){
            $content = shell_exec('pdftotext ' . $pathToFile . ' -'); // convert PDF to text and store into the variable
        }elseif ($fileExtension == "doc" || $fileExtension == "docx")
        {
            if($fileExtension == "doc") {
                $content= $this->read_doc($pathToFile);
            } else {
                $content= $this->read_docx($pathToFile);
            }
        }
        $userObj = User::find($user->id);
        $userObj->resume_content=$content;
        $userObj->update();

        flash(__('You have successfully uploaded resume'))->success();
        return back();
    }

    public function show($id)
    {
        $user = auth()->user();
        if ($user && $user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }
        $resume = DB::table('profile_cvs')->where('user_id', $id)->first();
        if($resume){
            $pathToFile = public_path('/cvs/'.$resume->cv_file);
            return response()->file($pathToFile);
        }
        return back();
    }

    public function delete($id)
    {
        $resume = DB::table('profile_cvs')->where('id', $id)->first();
        $pathToFile = public_path('/cvs/'.$resume->cv_file);
        if(File::exists($pathToFile)){
            File::delete($pathToFile);
        }
        DB::table('profile_cvs')->where('id', $id)->delete();
        $user = auth()->user();
        $userObj = User::find($user->id);
        $userObj->resume_content=null;
        $userObj->update();
        flash(__('You have successfully deleted resume'))->success();
        return back();
    }

    private function read_doc($filename)	{
        $fileHandle = fopen($filename, "r");
        $line = @fread($fileHandle, filesize($filename));
        $lines = explode(chr(0x0D),$line);
        $outtext = "";
        foreach($lines as $thisline)
        {
            $pos = strpos($thisline, chr(0x00));
            if (($pos !== FALSE)||(strlen($thisline)==0))
            {
            } else {
                $outtext .= $thisline." ";
            }
        }
        $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
        return $outtext;
    }

    private function read_docx($filename){

        $striped_content = '';
        $content = '';

        $zip = zip_open($filename);

        if (!$zip || is_numeric($zip)) return false;

        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

            if (zip_entry_name($zip_entry) != "word/document.xml") continue;

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }

        zip_close($zip);

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        return $striped_content;
    }

}
