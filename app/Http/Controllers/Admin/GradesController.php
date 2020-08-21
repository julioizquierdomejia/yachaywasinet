<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Grade\IndexGrade;
use App\Http\Requests\Admin\Grade\StoreGrade;
use App\Http\Requests\Admin\Grade\UpdateGrade;
use App\Http\Requests\Admin\Grade\DestroyGrade;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Grade;
use App\Models\Level;
//use App\Models\Course;
use Illuminate\Support\Facades\DB;

class GradesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexGrade $request
     * @return Response|array
     */
    public function index(IndexGrade $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Grade::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'level_id', 'levels.title as level', 'enabled', 'courses'],

            // set columns to searchIn
            ['id', 'title', 'level_id', 'enabled', 'courses'],

            function($query) use ($request){
                $query->join('levels', 'levels.id', '=', 'grades.level_id');
            }
        );

        $leveltype = Level::all();

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.grade.index', [
            'data' => $data,
            'leveltype' => json_encode($leveltype)
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
        $this->authorize('admin.grade.create');

        $courses = DB::table('courses')->where('enabled', 1)->select('id', 'title')->get();

        return view('admin.grade.create', [
            'level_type' => Level::all(),
            'courses' => $courses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreGrade $request
     * @return Response|array
     */
    public function store(StoreGrade $request)
    {
        // Sanitize input
        //$sanitized = $request->validated();
        $sanitized = $request->getModifiedData();

        // Store the Grade
        $grade = Grade::create($sanitized);

        $courses = DB::table('courses')->where('enabled', 1)->select('id', 'title')->get();

        if ($request->ajax()) {
            return ['redirect' => url('admin/grades'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/grades', [
            'courses' => $courses,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Grade $grade
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Grade $grade)
    {
        $this->authorize('admin.grade.show', $grade);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Grade $grade
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Grade $grade)
    {
        $this->authorize('admin.grade.edit', $grade);

        $grade->load('level_id');
        $courses = DB::table('courses')->where('enabled', 1)->select('id', 'title')->get();

        return view('admin.grade.edit', [
            'grade' => $grade,
            'level_type' => Level::all(),
            'courses' => $courses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateGrade $request
     * @param  Grade $grade
     * @return Response|array
     */
    public function update(UpdateGrade $request, Grade $grade)
    {
        // Sanitize input
        //$sanitized = $request->getSanitized();
        $sanitized = $request->getModifiedData();

        // Update changed values Grade
        $grade->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/grades'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/grades');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyGrade $request
     * @param  Grade $grade
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyGrade $request, Grade $grade)
    {
        $grade->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyGrade $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyGrade $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    Grade::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
    
    }
