<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use App\Models\User;
use App\Models\Review;

class Books extends Model
{
    /** @use HasFactory<\Database\Factories\BooksFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // 
    public function scopeTitle(Builder $query, string $title): Builder
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopeWithReviewsCount(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withCount([
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
        ]);
    }

    public function scopeWithAvgRating(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withAvg([
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
        ], 'rating');
    }

    public function scopePopular(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withReviewsCount($from, $to)
            ->orderByDesc('reviews_count');
    }

    public function scopeHighestRated(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withAvgRating($from, $to)
            ->orderByDesc('reviews_avg_rating');
    }

    public function scopeMinReviews(Builder $query, int $minReviews): Builder
    {
        return $query->having('reviews_count', '>=', $minReviews);
    }

    public function scopeMinRating(Builder $query, int $minRating): Builder
    {
        return $query->having('reviews_avg_rating', '>=', $minRating);
    }

    private function dateRangeFilter(Builder $query, $from = null, $to = null)
    {
        if ($from && !$to) {
            $query->where('created_at', '>=', $from);
        } elseif (!$from && $to) {
            $query->where('created_at', '<=', $to);
        } elseif ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }
    }

    public function scopePopularLastMonth(Builder $query): Builder
    {
        return $query->popular(now()->subMonth(), now())
            ->highestRated(now()->subMonth(), now())
            ->having('reviews_count', '>=', 3);
    }

    public function scopePopularLast6Months(Builder $query): Builder
    {
        return $query->popular(now()->subMonths(6), now())
            ->highestRated(now()->subMonths(6), now())
            ->having('reviews_count', '>=', 5);
    }

    public function scopeHighestRatedLastMonth(Builder $query): Builder
    {
        return $query->highestRated(now()->subMonth(), now())
            ->popular(now()->subMonth(), now())
            ->having('reviews_count', '>=', 4)
            ->having('reviews_avg_rating', '>=', 4);
    }

    public function scopeHighestRatedLast6Months(Builder $query): Builder
    {
        return $query->highestRated(now()->subMonths(6), now())
            ->popular(now()->subMonths(6), now())
            ->having('reviews_count', '>=', 5)
            ->having('reviews_avg_rating', '>=', 4);
    }

}
    