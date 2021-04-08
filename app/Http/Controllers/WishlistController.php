<?php

namespace App\Http\Controllers;

use App\Course;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = Auth::user()->wishlists;
        return view('Wishlist.index', compact('wishlists'));
    }

    public function wishlist(Course $course)
    {
        $wishlist = new Wishlist;
        $wishlist->course_id = $course->id;
        $wishlist->student_id = Auth::user()->id;
        $wishlist->save();

        return back()->with('toast_success', 'Wishlisted Successfully!');
    }

    public function remove(Wishlist $wishlist)
    {
        $wishlist->delete();

        return back()->with('toast_error', 'Removed from Wishlist!');
    }
}
