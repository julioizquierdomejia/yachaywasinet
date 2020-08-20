<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Course\IndexCourse;
use App\Http\Requests\Admin\Course\StoreCourse;
use App\Http\Requests\Admin\Course\UpdateCourse;
use App\Http\Requests\Admin\Course\DestroyCourse;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexCourse $request
     * @return Response|array
     */
    public function index(IndexCourse $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Course::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'competence', 'enabled'],

            // set columns to searchIn
            ['id', 'title', 'competence', 'enabled']
        );

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.course.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.course.create');

        return view('admin.course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCourse $request
     * @return Response|array
     */
    public function store(StoreCourse $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Course
        $course = Course::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/courses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/courses');
    }

    /**
     * Display the specified resource.
     *
     * @param  Course $course
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Course $course)
    {
        $this->authorize('admin.course.show', $course);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Course $course
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Course $course)
    {
        $this->authorize('admin.course.edit', $course);


        return view('admin.course.edit', [
            'course' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCourse $request
     * @param  Course $course
     * @return Response|array
     */
    public function update(UpdateCourse $request, Course $course)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Course
        $course->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/courses'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/courses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyCourse $request
     * @param  Course $course
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyCourse $request, Course $course)
    {
        $course->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyCourse $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyCourse $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    Course::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
    
    }
