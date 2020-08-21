<?php

namespace App\Http\Controllers\Online;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
    	$courses = Course::where('enabled', true)->get();
    	return view('online.courses.index', [
    		'courses' => $courses
    	]);
    }

    public function detail($slug)
    {
    	$course = Course::where('enabled', true)->where('slug', $slug)->get();
    	if ($course) {
            $subjects = \DB::table('subjects')->where('course_id', $course->first()->id)->where('enabled', true)->get();
    		return view('online.courses.detail', [
	    		'course' => $course->first(),
                'subjects' => $subjects
	    	]);
    	}
    	return abort();
    }
}
