<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Support\Facades\Storage;

class IdeaImageController extends Controller
{
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        Storage::disk('public')->delete($idea->image_path);

        $idea->update(['image_path' => null]);
        
        return back();
    }
}
