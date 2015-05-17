<?php namespace Cyclepedia\Http\Controllers;

use Cyclepedia\Models\Category;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

    /**
     * Category Model
     * @var Category
     */
    protected $category;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Category $category)
	{
		// $this->middleware('auth');
		$this->category = $category;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $categories = $this->category->get();

        return view('home.index', compact('categories'));

        // return View::make('home.index', compact('categories'));
	}

    public function loader()
    {
        $categories = $this->category->get();

        return View::make('home.loader', compact('categories'));
    }

    public function store()
    {
        $csv = Input::file('csv');
        $table = Input::get('table');

        $csvArray = CsvHandler::toArray($csv);
        $csvAssociative = CsvHandler::toAssociative($csvArray);

        if (Schema::hasTable(str_plural($table))){
            foreach($csvAssociative as $row){
                $model = $table::firstOrNew(array('name' => $row['Name']));
                foreach ($row as $key => $value){
                    if (!Schema::hasColumn(str_plural($table),strtolower($key))){
                        $parent = $key::where('name',$value)->first();
                        $name = strtolower($key);
                        $model->$name()->associate($parent);
                        unset($row[$key]);
                    } else {
                        $model->$key = $value;
                    }
                }
                
                $model->save();
            }
        }

        return $table::get();
    }

}
