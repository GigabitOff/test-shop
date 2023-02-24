<?php

namespace App\Http\Livewire\Widgets\Catalog\Review;

use Livewire\Component;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ReviewShowLivewire extends Component
{
    public $category_id, $product_id, $data, $rating, $count;

    public function mount()
    {
        $this->reviews = Review::query()
            ->where('product_id', $this->product_id)
            ->where('status', 1)
            ->get();

        foreach ($this->reviews as $review) {
            $this->count += $review->rating;
        }

        if ($this->count && $this->reviews) {
            $this->rating = ceil($this->count / $this->reviews->count());
        }

    }

    public function render()
    {

        return view('livewire.widgets.catalog.review.review-show-livewire');
    }
}
