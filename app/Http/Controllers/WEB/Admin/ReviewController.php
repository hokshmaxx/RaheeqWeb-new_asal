<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController
{
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->update($request->only(['review', 'rating']));
        return redirect()
            ->route('admin.products.edit', $review->product_id)
            ->with('success', 'Review updated successfully.');    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->back()->with('status', __('cp.deleted_successfully'));
    }

}
