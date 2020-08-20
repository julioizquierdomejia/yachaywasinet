<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Level\IndexLevel;
use App\Http\Requests\Admin\Level\StoreLevel;
use App\Http\Requests\Admin\Level\UpdateLevel;
use App\Http\Requests\Admin\Level\DestroyLevel;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Level;
use Illuminate\Support\Facades\DB;

class LevelsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexLevel $request
     * @return Response|array
     */
    public function index(IndexLevel $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Level::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'title'],

            // set columns to searchIn
            ['id', 'title']
        );

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.level.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.level.create');

        return view('admin.level.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLevel $request
     * @return Response|array
     */
    public function store(StoreLevel $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Level
        $level = Level::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/levels'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/levels');
    }

    /**
     * Display the specified resource.
     *
     * @param  Level $level
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Level $level)
    {
        $this->authorize('admin.level.show', $level);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Level $level
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Level $level)
    {
        $this->authorize('admin.level.edit', $level);


        return view('admin.level.edit', [
            'level' => $level,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLevel $request
     * @param  Level $level
     * @return Response|array
     */
    public function update(UpdateLevel $request, Level $level)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Level
        $level->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/levels'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/levels');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyLevel $request
     * @param  Level $level
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyLevel $request, Level $level)
    {
        $level->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyLevel $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyLevel $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    Level::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
    
    }
