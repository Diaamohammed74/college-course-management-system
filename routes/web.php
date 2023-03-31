<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Faculty\UserController;
use App\Http\Controllers\Admin\Course\CourseController;
use App\Http\Controllers\admin\Result\ResultController;
use App\Http\Controllers\Admin\Pdf\PdfController;
use App\Http\Controllers\Admin\Student\StudentController;
use App\Http\Controllers\Admin\Teacher\TeacherController;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\Admin\Department\DepartmentController;
use App\Http\Controllers\admin\Course\CourseRegistrationController;
use App\Http\Controllers\Admin\Settings\RequiredHoursSettingsController;
use App\Http\Controllers\Admin\Student\StudentStatusController;

Route::controller(UserController::class)->group(function(){
    Route::get('login','login')->name('login');
    Route::post('loginrequest','loginrequest')->name('loginrequest');
    Route::get('logout','logout')->name('logout');
});

Route::group(["middleware"=>"auth"],function(){
    Route::controller(HomeController::class)->group(function(){
        Route::get('/','index')->name('home');
    });
});

Route::group(["middleware"=>"auth"],function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('/users','show')->name('users');
        Route::get('/users/create','create')->name('users/add');
        Route::post('/users/store','store')->name('users/store');
        Route::get('/users/edit/{id}','edit')->name('users/edit');
        Route::post('/users/upadte/{id}','update')->name('users/update');
        Route::delete('/users/delete/{id}','destroy')->name('users/delete');
    });
});

Route::group(['prefix'=>"department","middleware"=>"auth"],function(){
    Route::controller(DepartmentController::class)->group(function(){
        Route::get('/','index')->name('departments');
        Route::get('create','create')->name('department/create');
        Route::POST('store','store')->name('department/store');
        Route::get('edit/{id}','edit')->name('department/edit');
        Route::POST('update/{id}','update')->name('department/update');
        Route::delete('delete/{id}','destroy')->name('department/delete');
    });
});

Route::group(['prefix'=>"course","middleware"=>"auth"],function(){
    Route::controller(CourseController::class)->group(function(){
        Route::get('/','index')->name('courses');
        Route::get('/archived','trashed')->name('courses/archived');
        Route::get('create','create')->name('course/create');
        Route::POST('store','store')->name('course/store');
        Route::get('edit/{id}','edit')->name('course/edit');
        Route::POST('update/{id}','update')->name('course/update');
        Route::delete('delete/{id}','destroy')->name('course/delete');
        Route::POST('restore/{id}','restore')->name('course/restore');
    });
});

Route::group(['prefix'=>"teacher","middleware"=>"auth"],function(){
    Route::controller(TeacherController::class)->group(function(){
        Route::get('/','index')->name('teachers');
        Route::get('teacher/search','search')->name('teachers/search');
        Route::get('create','create')->name('teacher/create');
        Route::POST('store','store')->name('teacher/store');
        Route::get('edit/{id}','edit')->name('teacher/edit');
        Route::POST('update/{id}','update')->name('teacher/update');
        Route::delete('delete/{id}','destroy')->name('teacher/delete');
        Route::get('courses/get', 'getByDepartment')->name('courses/get');
    });
});

Route::group(['prefix'=>"student","middleware"=>"auth"],function(){
    Route::controller(StudentController::class)->group(function(){
        Route::get('/','index')->name('students');
        Route::get('create','create')->name('student/create');
        Route::POST('store','store')->name('student/store');
        Route::get('edit/{id}','edit')->name('student/edit');
        Route::POST('update/{id}','update')->name('student/update');
        Route::delete('delete/{id}','destroy')->name('student/delete');
        Route::get('levels/get', 'getByDepartment')->name('levels/get');
        Route::get('students/grad', 'studentsGrad')->name('students/grad');
        Route::get('students/undergrad', 'studentsUnderGrad')->name('students/undergrad');
        Route::get('students/bylevel', 'studentsBylevel')->name('students/bylevel');
        Route::get('students/search', 'search')->name('student/search');
    });
});

Route::group(['prefix'=>"courses","middleware"=>"auth"],function(){
    Route::controller(CourseRegistrationController::class)->group(function(){
        Route::get('/register',  'showForm')->name('courses.register.form');
        Route::get('/gets', 'getByDepartment')->name('coursess/get');
        Route::get('students/get', 'getStudentsByDepartment')->name('students/get');
        Route::get('/autocomplete', 'autocomplete')->name('autocomplete');
        Route::post('registersubmission', 'registerSubmission')->name('coursess/register');
        Route::get('schedule/view/{id}', 'showRegisteredList')->name('schedule/view');
        Route::delete('deleteCourseRegistred/{student_id}/{course_id}', 'deleteCourseRegistred')->name('register/delete');
    });
});

Route::group(['prefix'=>"settings","middleware"=>"auth"],function(){
    Route::controller(StudentStatusController::class)->group(function(){
        Route::get('update/studentStatus','updateStudentStatus')->name('update/status');
    });
});

Route::group(['prefix'=>"students/results","middleware"=>"auth"],function(){
    Route::controller(ResultController::class)->group(function(){
        Route::get('/add',  'add')->name('result/add');
        Route::post('/store', 'storeResult')->name('result/store');
        Route::post('/store/{student_id}/{course_id}', 'storeResultFromModal')->name('result/store2');
        Route::post('/update/{student_id}/{course_id}', 'updateResult')->name('result/update');
    });
});

Route::group(['prefix'=>"admin/reports","middleware"=>"auth"],function(){
    Route::controller(PdfController::class)->group(function(){
        Route::get('/users', 'generateUsersPdf')->name('users.pdf');
        Route::get('/teachers', 'generateTeachersPdf')->name('teachers.pdf');
        Route::get('/students', 'generateStudentsPdf')->name('students.pdf');
    });
});

Route::group(['prefix'=>"settings","middleware"=>"auth"],function(){
    Route::controller(RequiredHoursSettingsController::class)->group(function(){
        Route::get('/required_hours', 'show')->name('required_hours/show');
        Route::get('/required_hours/edit', 'edit')->name('required_hours/edit');
        Route::post('/required_hours/update', 'update')->name('required_hours/update');
    });
});