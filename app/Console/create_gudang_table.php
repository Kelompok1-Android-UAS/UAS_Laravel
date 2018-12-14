 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gudang_id');
            $table->integer('share_price');
            $table->integer('share_qty');
            $table->timestamps();
        });
    }
Okay now migrate the table using the following command.

php artisan migrate
Now, add the fillable property inside Share.php file.

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
  protected $fillable = [
    'share_name',
    'share_price',
    'share_qty'
  ];
}
#4: Create routes and controller

First, create the ShareController using the following command.

RELATED POSTS
How To Install Statamic | Laravel Based CMS

Nov 27, 2018
Laravel 5.7 Email Verification Tutorial Example

Sep 11, 2018
php artisan make:controller ShareController --resource
Now, inside routes >> web.php file, add the following line of code.

<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('shares', 'ShareController');


Actually, by adding the following line, we have registered the multiple routes for our application. We can check it using the following command.

php artisan route:list
 

Laravel 5.7 Example

Okay, now open the ShareController.php file, and you can see that all the functions declarations are there.

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
#5: Create the views
Inside resources >> views folder, create one folder called shares.

Inside that folder, create the following three files.

create.blade.php
edit.blade.php
index.blade.php
But inside views folder, we also need to create a layout file. So create one file inside the views folder called layout.blade.php. Add the following code inside the layout.blade.php file.

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel 5.7 CRUD Example Tutorial</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
  <div class="container">
    @yield('content')
  </div>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
So basically this file is our main template file, and all the other view files will extend this file. Here, we have already included the bootstrap four by adding the app.css.

Next step would be to code the create.blade.php file. So write the following code inside it.

@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Share
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('shares.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Share Name:</label>
              <input type="text" class="form-control" name="share_name"/>
          </div>
          <div class="form-group">
              <label for="price">Share Price :</label>
              <input type="text" class="form-control" name="share_price"/>
          </div>
          <div class="form-group">
              <label for="quantity">Share Quantity:</label>
              <input type="text" class="form-control" name="share_qty"/>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection
Okay, now we need to open the ShareController.php file, and on the create function, we need to return a view, and that is the create.blade.php file.

// ShareController.php

public function create()
{
   return view('shares.create');
}
Save the file and start the Laravel development server using the following command.

php artisan serve
Go to the http://localhost:8000/shares/create. 

You can see something like this.

 

Laravel 5.7 Demo For Beginners

#6: Save the data
Now, we need to code the store function to save the data in the database. First, include the Share.php model inside ShareController.php file.

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Share;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shares.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'share_name'=>'required',
        'share_price'=> 'required|integer',
        'share_qty' => 'required|integer'
      ]);
      $share = new Share([
        'share_name' => $request->get('share_name'),
        'share_price'=> $request->get('share_price'),
        'share_qty'=> $request->get('share_qty')
      ]);
      $share->save();
      return redirect('/shares')->with('success', 'Stock has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
If the validation fails, then it will throw an error, and we will display inside the create.blade.php file.

If all the values are good and pass the validation, then it will save the values in the database.

 

Laravel 5.7 CRUD

#7: Display the data.
Okay, now open the file called index.blade.php file and add the following code.
@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Stock Name</td>
          <td>Stock Price</td>
          <td>Stock Quantity</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($shares as $share)
        <tr>
            <td>{{$share->id}}</td>
            <td>{{$share->share_name}}</td>
            <td>{{$share->share_price}}</td>
            <td>{{$share->share_qty}}</td>
            <td><a href="{{ route('shares.edit',$share->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('shares.destroy', $share->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection

Next thing is we need to code the index() function inside ShareController.php file.

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Share;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shares = Share::all();

        return view('shares.index', compact('shares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shares.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'share_name'=>'required',
        'share_price'=> 'required|integer',
        'share_qty' => 'required|integer'
      ]);
      $share = new Share([
        'share_name' => $request->get('share_name'),
        'share_price'=> $request->get('share_price'),
        'share_qty'=> $request->get('share_qty')
      ]);
      $share->save();
      return redirect('/shares')->with('success', 'Stock has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
#8: Edit and Update Data
First, we need to code the edit() function inside  ShareController.php file.

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Share;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shares = Share::all();

        return view('shares.index', compact('shares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shares.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'share_name'=>'required',
        'share_price'=> 'required|integer',
        'share_qty' => 'required|integer'
      ]);
      $share = new Share([
        'share_name' => $request->get('share_name'),
        'share_price'=> $request->get('share_price'),
        'share_qty'=> $request->get('share_qty')
      ]);
      $share->save();
      return redirect('/shares')->with('success', 'Stock has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $share = Share::find($id);

        return view('shares.edit', compact('share'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
Now, add the following lines of code inside the edit.blade.php file.

@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Share
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('shares.update', $share->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Share Name:</label>
          <input type="text" class="form-control" name="share_name" value={{ $share->share_name }} />
        </div>
        <div class="form-group">
          <label for="price">Share Price :</label>
          <input type="text" class="form-control" name="share_price" value={{ $share->share_price }} />
        </div>
        <div class="form-group">
          <label for="quantity">Share Quantity:</label>
          <input type="text" class="form-control" name="share_qty" value={{ $share->share_qty }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection
Finally, code the update function inside ShareController.php file.

public function update(Request $request, $id)
{
      $request->validate([
        'share_name'=>'required',
        'share_price'=> 'required|integer',
        'share_qty' => 'required|integer'
      ]);

      $share = Share::find($id);
      $share->share_name = $request->get('share_name');
      $share->share_price = $request->get('share_price');
      $share->share_qty = $request->get('share_qty');
      $share->save();

      return redirect('/shares')->with('success', 'Stock has been updated');
}
So, now you can update the existing values.

#9: Delete the data
Just code the delete function inside ShareController.php file.

public function destroy($id)
{
     $share = Share::find($id);
     $share->delete();

     return redirect('/shares')->with('success', 'Stock has been deleted Successfully');
}
Finally, Laravel 5.7 CRUD Example Tutorial For Beginners From Scratch is over. I have put the code in the Github Repo. So check out as well.


LaravelLaravel 5.7
 
Krunal
I am Web Developer and Blogger. I have created this website for the web developers to understand complex concepts in an easy manner.

 PREV POST

Filter Array Method in Javascript

NEXT POST 

Angular Material Example Tutorial From Scratch

YOU MIGHT ALSO LIKE More From Author
LARAVEL
How To Install Statamic | Laravel Based CMS

LARAVEL
Laravel 5.7 Email Verification Tutorial Example

LARAVEL
Laravel 5.7 Features and Updates | What Is New

26 COMMENTS

Calvin Carlos Da Conceição Chiulele Says  3 months ago
Nice tutorial. Thanks for you sharing!

 Reply

Krunal Says  3 months ago
Thanks man

 Reply

Jephte Says  2 months ago
Wonderful tutorial Krunal. Thank you very much.

 Reply

Yusup Supriatna Says  3 months ago
Your tutorial is very good . Thanks for you sharing

 Reply

Yusup Supriatna Says  3 months ago
I’m so sorry but can you help me please , I’ve error in ShareController :
public function create()
{
return view(‘shares.create’);
}

shares.create not found

 Reply

Umair Khalid Says  3 weeks ago
check that your create shares folder in views folder

 Reply

Nico Says  3 days ago
same error I fixed only leave
public function create()
{
return view(‘create’);
}

 Reply

Jephte Says  2 months ago
What is the error? 404. Maybe your forgot the “s” in “Route::resource(‘shares’, ‘ShareController’);” inside the web.php.

 Reply

Mark Zuckerberg Says  2 months ago
/shares/create doesn’t show anything, blank page

 Reply

William Says  2 months ago
Hi,
I have an Error while running php artisan migrate command PDOException::(“could not find driver”)
please help me anyone.

 Reply

Marcin Says  1 month ago
apt-get install php7.x-mysql

make sure that you have enabled pdo extension ( you can check it at phpinfo() )

in php.ini

;extension=php_pdo_mysql.so
Change it to this

extension=pdo_mysql.so

restart apache2/nginx

 Reply

GuntherWyns Says  2 months ago
Hello

Can somebody help me?

Missing required parameters for [Route: shares.edit] [URI: shares/{share}/edit]. (View: C:\wamp64\www\stocks\resources\views\shares\index.blade.php)

Missing required parameters for [Route: {$route->getName()}] [URI: {$route->uri()}]

 Reply

Lamhaison Says  2 months ago
Thank you so much because of making a good tutorial.

 Reply

SD Says  1 month ago
Hello, I am trying to get a problem, giving an exception, when I enter localhost: 8000 / shares / create

ErrorException (E_ERROR)
View [layout] not found. (View: C: \ laravel \ resources \ views \ shares \ create.blade.php)

\vendor\laravel\framework\src\Illuminate\View\FileViewFinder.php137

How can I solve it please

 Reply

Emmanuel Says  1 month ago
Is a nice tutorial but i have an the following error: InvalidArgumentException
View [shares.create] not found.how can i fix it anyway?

 Reply

Nagesh Says  4 weeks ago
Very nice tutorial. Thank you very much

 Reply

Jeffrey Del Rosario Says  2 weeks ago
do we really need to use npm?

 Reply

Krunal Says  2 weeks ago
For this example, I would say no, but in general Laravel project yes because you generally use your own JS scripts.

 Reply

Wahad Says  2 weeks ago
best tutorial ever.. thank you as always

 Reply

Neriosoft Says  2 weeks ago
pls i am having this error:

InvalidArgumentException
View [shares.create] not found.

 Reply

Nico Says  3 days ago
try return view(‘create’);

 Reply

DR NIKHIL KUMAR GHORAI Says  2 weeks ago
A very nice tutorial. i had haunting a written guide than a video tutorial. Ultimately got it.Thanks a lot

 Reply

DR NIKHIL KUMAR GHORAI Says  2 weeks ago
A nice tutorial. I think a gem article for laravel 5.7 . The scripts are very consized and well written.
I was haunting for a month for the right codes. Ultimately got here. Thanks a lot. keep helping us who are hobbiest programmer and learning ownself from illustrations in internet.

 Reply

Roshan Says  2 weeks ago
Dear Kunal, can post a tutorials how to create a CRUD page Ex; About us ( Title, Body and Image ) all I’ve seen every where is how to do post with post controllers. I want to do a blog with generic pages with edit and publish functions. Can you please share this. I’m following your great tutorials.

 Reply

Alfonso Says  5 days ago
awesome tutorial, thanks!

 Reply

Mohsin Ali Says  1 day ago
good work dear, thanks alot

 Reply
LEAVE A REPLY
Your email address will not be published.


Your Comment


Your Name *

Your Email *

Your Website

This site uses Akismet to reduce spam. Learn how your comment data is processed.


report this ad

report this ad
Like This Page

Categories
Angular
Blockchain
ECMA Script 6
Javascript
Laravel
Machine Learning
MongoDB
Node.js
Python
React Native
React.js
RxJS
Tools
TypeScript
VueJS
Tags
WebpackReact.js TutorialAxiosReduxAngular 5ES6Angular 6VueexpressReact NativemongodbReactLaravel 5.5JavaScriptReact.jsVue jsLaravel 5.6AngularNode.jsLaravel

 
Stay With Us
Facebook
Likes
260
Followers
Google+
Followers
19
Subscribers
245
Followers
16
Followers
150
Followers
Linkedin
Follow us
281
Posts
Subscribe For Latest Post
Name

Email


report this ad

report this ad
Copyright © AppDividend 2018
