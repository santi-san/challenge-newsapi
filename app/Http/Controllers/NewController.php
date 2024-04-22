<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class NewController extends Controller
{
    public function __invoke()
    {
        $url = env('KEY_NEWSAPI', '');

        $perPage = 10;
        $currentPage = request()->has('page') ? request('page') : 1;

        $jsonResponse = Http::get('https://newsapi.org/v2/top-headlines?country=us&pageSize='.$perPage.'&page='.$currentPage.'&apiKey='.$url.'');
        $news = collect(json_decode($jsonResponse, true))->jsonserialize();
        $offset = ceil(( $news['totalResults'] / $perPage) - 1);

        // Replace author value from randomUser
        foreach ($news['articles'] as &$item) {
            $randomUser = Http::get('https://randomuser.me/api/');
            $item['author'] = $randomUser['results'][0]['name']['first'] . ' ' . $randomUser['results'][0]['name']['last'];
        }

        $results = new LengthAwarePaginator(
            $news['articles'],
            $news['totalResults'],
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('welcome', compact('results'));
    }
}
