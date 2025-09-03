<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class FavoriteController extends BaseController
{
    public function toggle(Ad $ad)
    {
        $this->authorize('view', $ad); 

        $user = Auth::user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('ad_id', $ad->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Removed from favorites';
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'ad_id' => $ad->id
            ]);
            $message = 'Added to favorites';
        }

        return back()->with('success', $message);
    }
}
