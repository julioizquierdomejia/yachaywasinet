<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('online.home');
});

Route::get('/nosotros', function () {
    return view('online.about/index');
})->name('nosotros');

Route::prefix('cursos')->group(function () {
    Route::get('/', 'Online\CourseController@index');
    Route::get('/{slug}', 'Online\CourseController@detail')->name('courseDetail');
});

Route::prefix('temas')->group(function () {
    Route::get('/', 'Online\SubjectController@index');
    Route::get('/{slug}', 'Online\SubjectController@detail')->name('subjectDetail');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/admin-users',                            'Admin\AdminUsersController@index');
    Route::get('/admin/admin-users/create',                     'Admin\AdminUsersController@create');
    Route::post('/admin/admin-users',                           'Admin\AdminUsersController@store');
    Route::get('/admin/admin-users/{adminUser}/edit',           'Admin\AdminUsersController@edit')->name('admin/admin-users/edit');
    Route::post('/admin/admin-users/{adminUser}',               'Admin\AdminUsersController@update')->name('admin/admin-users/update');
    Route::delete('/admin/admin-users/{adminUser}',             'Admin\AdminUsersController@destroy')->name('admin/admin-users/destroy');
    Route::get('/admin/admin-users/{adminUser}/resend-activation','Admin\AdminUsersController@resendActivationEmail')->name('admin/admin-users/resendActivationEmail');
});

/* Auto-generated profile routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/profile',                                'Admin\ProfileController@editProfile');
    Route::post('/admin/profile',                               'Admin\ProfileController@updateProfile');
    Route::get('/admin/password',                               'Admin\ProfileController@editPassword');
    Route::post('/admin/password',                              'Admin\ProfileController@updatePassword');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/levels',                                 'Admin\LevelsController@index');
    Route::get('/admin/levels/create',                          'Admin\LevelsController@create');
    Route::post('/admin/levels',                                'Admin\LevelsController@store');
    Route::get('/admin/levels/{level}/edit',                    'Admin\LevelsController@edit')->name('admin/levels/edit');
    Route::post('/admin/levels/bulk-destroy',                   'Admin\LevelsController@bulkDestroy')->name('admin/levels/bulk-destroy');
    Route::post('/admin/levels/{level}',                        'Admin\LevelsController@update')->name('admin/levels/update');
    Route::delete('/admin/levels/{level}',                      'Admin\LevelsController@destroy')->name('admin/levels/destroy');
});

Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/roles',                                 'Admin\RolesController@index');
    Route::get('/admin/roles/create',                          'Admin\RolesController@create');
    Route::post('/admin/roles',                                'Admin\RolesController@store');
    Route::get('/admin/roles/{role}/edit',                    'Admin\RolesController@edit')->name('admin/roles/edit');
    Route::post('/admin/roles/bulk-destroy',                   'Admin\RolesController@bulkDestroy')->name('admin/roles/bulk-destroy');
    Route::post('/admin/roles/{role}',                        'Admin\RolesController@update')->name('admin/roles/update');
    Route::delete('/admin/roles/{role}',                      'Admin\RolesController@destroy')->name('admin/roles/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/grades',                                 'Admin\GradesController@index');
    Route::get('/admin/grades/create',                          'Admin\GradesController@create');
    Route::post('/admin/grades',                                'Admin\GradesController@store');
    Route::get('/admin/grades/{grade}/edit',                    'Admin\GradesController@edit')->name('admin/grades/edit');
    Route::post('/admin/grades/bulk-destroy',                   'Admin\GradesController@bulkDestroy')->name('admin/grades/bulk-destroy');
    Route::post('/admin/grades/{grade}',                        'Admin\GradesController@update')->name('admin/grades/update');
    Route::delete('/admin/grades/{grade}',                      'Admin\GradesController@destroy')->name('admin/grades/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/courses',                                'Admin\CoursesController@index');
    Route::get('/admin/courses/create',                         'Admin\CoursesController@create');
    Route::post('/admin/courses',                               'Admin\CoursesController@store');
    Route::get('/admin/courses/{course}/edit',                  'Admin\CoursesController@edit')->name('admin/courses/edit');
    Route::post('/admin/courses/bulk-destroy',                  'Admin\CoursesController@bulkDestroy')->name('admin/courses/bulk-destroy');
    Route::post('/admin/courses/{course}',                      'Admin\CoursesController@update')->name('admin/courses/update');
    Route::delete('/admin/courses/{course}',                    'Admin\CoursesController@destroy')->name('admin/courses/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/subjects',                               'Admin\SubjectsController@index');
    Route::get('/admin/subjects/create',                        'Admin\SubjectsController@create');
    Route::post('/admin/subjects',                              'Admin\SubjectsController@store');
    Route::get('/admin/subjects/{subject}/edit',                'Admin\SubjectsController@edit')->name('admin/subjects/edit');
    Route::post('/admin/subjects/bulk-destroy',                 'Admin\SubjectsController@bulkDestroy')->name('admin/subjects/bulk-destroy');
    Route::post('/admin/subjects/{subject}',                    'Admin\SubjectsController@update')->name('admin/subjects/update');
    Route::delete('/admin/subjects/{subject}',                  'Admin\SubjectsController@destroy')->name('admin/subjects/destroy');
});