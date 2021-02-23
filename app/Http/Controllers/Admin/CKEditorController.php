<?php

namespace App\Http\Controllers\Admin;

use App\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            //$request->file('upload')->storeAs('uploads', $filenametostore);
            $request->file('upload')->move(public_path('uploads'), $filenametostore);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');

            $url = asset('uploads/'.$filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function uploadMedia(Request $request)
    {
        $data = $request->get('idList');
        $response = [];
        if(!empty($data)) {
            foreach($data as $id) {
                $media = Media::find($id);
                $response[] = $media->getUrl();
            }

        }
        return $response;
    }
}
