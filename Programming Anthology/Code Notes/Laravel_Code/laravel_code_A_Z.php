<?php 
// laravel tutorial link
// https://laravel.com/docs/5.3

// Creating Controller
// php artisan make:controller --resource SomeResourceController

// The whereNotIn method verifies that the given column's value is not contained in the given array:
$users = DB::table('users')
	        ->whereNotIn('id', [1, 2, 3])
	        ->get();

// for pagination 
echo $jobs->appends(Request::except('page'))->render(); 

// To get data or array of objects write
$jobs = Project::where('status','!=', 'closed')->get();

// Extract data using relationship
class Project extends Model {
	  /**
	   * Get the user that leading this Project
	   */
	  public function teamleader()
	  {
	      return $this->belongsTo('App\User','leader_id');
	  }

	  // Extract user name from user table
	  // We must first ensure the current object is the object of Project Table
	  // $job->teamleader->nick_name; Here $job is the object of the Project; teamleader is the relationship method with user table and nick_name field value of the User table 

}


// Many of you may know this already, but for those who don't this is really handy for building dropdowns

// Suppose you want to show a categories dropdown whose information is pulled from an Eloquent model
// You can use the query builder's "lists" method (available for Eloquent as any query builder method) which
// returns an associative array you can pass to the Form::select method

$categories = Category::lists('title', 'id');

// note that the parameters you pass to lists correspond to the columns for the value and id, respectively
// in this case, "title" and "id"


// Table migration
// 


// Validation
use Illuminate\Support\Facades\Validator;


// $validator = Validator::make($input,[
//     'start_date' => 'required',
//     'end_date' => 'required',
//     'number_of_days' => 'required|min:3',
//     'leave_type' => 'required'
// ]);

// if ($validator->fails()) {
//     // return redirect('post/create')
//     return redirect()->back()
//                 ->withErrors($validator)
//                 ->withInput();
//     return $validator->errors()->all();
//                 // withErrors($validator)
//                 // ->withInput();
// }


$validator = Validator::make($input,[
    'start_date' => 'required|date',
    'end_date' => 'required|date',
    'number_of_days' => 'required|numeric',
    'leave_type' => 'required'
]);

if ($validator->fails()) {

     $response = array(
        'status' => 'error',
        'msg' => 'Leave information doesn\'t save successfully',
        'errors' => $validator->errors()
      );      

    return Response::json( $response );
}




$rules = array(
            'name'    => 'required',
        );

$validator = Validator::make(Input::all(), $rules);

// if the validator fails, redirect back to the form
if ($validator->fails()) {
    return Redirect::back()
        ->withErrors($validator) // send back all errors to the login form
        ->withInput();

    $input = input::all();

} else {

    $company                = New Company();
    $company->name          = Input::get('name');
    $company->user_id       = Input::get('user_id');
    $company->country_id    = Input::get('country_id');
    $company->description   = Input::get('description');

    $company->save();

    return Redirect::to('/backend')->withInput()->with('success', 'Company added.');

}


// Eloquent Relationship 
// One to Many Relationship
// This will hold USER Model
/**
    * Get the leaves for the user.
*/
public function leaves()
{
    return $this->hasMany('App\LeaveInfo');
}

// One to Many relationship inverse
// This will hold LeaveInfo Model
/**
  * Get the user that owns the leave.
 */
public function post()
{
    return $this->belongsTo('App\User');
}