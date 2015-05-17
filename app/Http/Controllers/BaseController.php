<?php namespace Cyclepedia\Http\Controllers;

use Cyclepedia\Models\Category;

use Cyclepedia\Http\Requests;
use Cyclepedia\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BaseController extends Controller {

    /**
     * Category Model
     * @var Category
     */
    protected $category;

    /**
     * Initializer.
     *
     * @access   public
     * @return \BaseController
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
