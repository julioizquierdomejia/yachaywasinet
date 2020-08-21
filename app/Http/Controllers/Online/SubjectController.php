<?php

namespace App\Http\Controllers\Online;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
    	$subjects = Subject::where('subjects.enabled', true)
                    ->join('courses', 'courses.id', '=', 'subjects.id')
                    ->select('subjects.*', 'courses.title as course_title')
                    ->get();
    	return view('online.subjects.index', [
    		'subjects' => $subjects
    	]);
    }

    public function detail($slug)
    {
    	$subject = Subject::where('enabled', true)->where('slug', $slug)->get();
    	if ($subject->count()) {
    		return view('online.subjects.detail', [
	    		'subject' => $subject->first()
	    	]);
    	}
    	return abort(404);
    }
}
