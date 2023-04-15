<?php


namespace App\Http\View\Composers;

use App\Models\Color;
use Illuminate\View\View;

class ColorComposer
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
        $colors = Color::all();
        $view->with('colors', $colors);
    }
}
