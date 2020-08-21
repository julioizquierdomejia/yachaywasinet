<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Subject\IndexSubject;
use App\Http\Requests\Admin\Subject\StoreSubject;
use App\Http\Requests\Admin\Subject\UpdateSubject;
use App\Http\Requests\Admin\Subject\DestroySubject;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Subject;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class SubjectsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexSubject $request
     * @return Response|array
     */
    public function index(IndexSubject $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Subject::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'description', 'course_id', 'slug', 'enabled'],

            // set columns to searchIn
            ['id', 'title', 'description', 'course_id', 'slug', 'enabled']
        );

        $courses = Course::all();

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.subject.index', [
            'data' => $data,
            'courses' => json_encode($courses)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.subject.create');

        return view('admin.subject.create', [
            'courses' => Course::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSubject $request
     * @return Response|array
     */
    public function store(StoreSubject $request)
    {
        // Sanitize input
        $sanitized = $request->getModifiedData();

        // Store the Subject
        $subject = Subject::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/subjects'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/subjects', [
            'courses' => Course::where('enabled', 1)->get(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Subject $subject
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Subject $subject)
    {
        $this->authorize('admin.subject.show', $subject);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Subject $subject
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Subject $subject)
    {
        $this->authorize('admin.subject.edit', $subject);

        $subject->load('course_id');

        return view('admin.subject.edit', [
            'subject' => $subject,
            'courses' => Course::where('enabled', 1)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSubject $request
     * @param  Subject $subject
     * @return Response|array
     */
    public function update(UpdateSubject $request, Subject $subject)
    {
        // Sanitize input
        $sanitized = $request->getModifiedData();

        // Update changed values Subject
        $subject->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/subjects'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/subjects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroySubject $request
     * @param  Subject $subject
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroySubject $request, Subject $subject)
    {
        $subject->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroySubject $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroySubject $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    Subject::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
    
    }
