<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class AdController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Constructor to apply policy authorization automatically
     */
    public function __construct()
    {
        // Use slug as the route parameter for authorization
        $this->authorizeResource(Ad::class, 'ad');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['q','category','min','max']);
        $ads = Ad::with(['category','images','user'])
            ->published()
            ->filter($filters)
            ->latest()
            ->paginate(12)
            ->withQueryString();
        $categories = Category::orderBy('name')->get();
        return view('ads.index', compact('ads','categories','filters'));
    }

    public function myAds()
    {
        $ads = Ad::with(['category','images'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('ads.my_ads', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Ad::class);
        $categories = Category::orderBy('name')->get();
        return view('ads.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $title = $request->string('title');
        $slug = Str::slug($title.'-'.Str::random(6));

        $ad = Ad::create([
            'user_id' => $request->user()->id,
            'category_id' => $request->integer('category_id'),
            'title' => $title,
            'slug' => $slug,
            'description' => $request->input('description'),
            'price' => $request->integer('price'),
            'location' => $request->input('location'),
            'status' => 'published',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('ads/'.$ad->id, 'public');
                $ad->images()->create(['path'=>$path]);
            }
        }

        return redirect()->route('ads.show', $ad)->with('success','Ad created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ad $ad)
    {
        $isFavorite = Auth::check() 
            ? Favorite::where('user_id', Auth::id())->where('ad_id', $ad->id)->exists() 
            : false;

        return view('ads.show', compact('ad', 'isFavorite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ad $ad)
    {
        $this->authorize('update', $ad);
        $categories = Category::orderBy('name')->get();
        return view('ads.edit', compact('ad','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ad $ad)
    {
        $this->authorize('update', $ad);
        $ad->update($request->safe()->except('images'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('ads/'.$ad->id,'public');
                $ad->images()->create(['path'=>$path]);
            }
        }

        return redirect()->route('ads.show',$ad)->with('success','Ad updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ad $ad)
    {
        $this->authorize('delete', $ad);
        $ad->delete();
        return redirect()->route('ads.index')->with('success','Ad deleted');
    }
}
