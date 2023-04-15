<?php


namespace App\Http\View\Composers;
use App\Models\Size;
use Illuminate\View\View;

class SizeComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {   
        $sizes = Size::all();
        $view->with('sizes', $sizes);
    }
}
