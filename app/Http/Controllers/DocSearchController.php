<?php

namespace App\Http\Controllers;

use App\Http\Resources\SectionResource;
use App\Models\Section;

class DocSearchController extends Controller
{
    public function search($query)
    {
        $query = Section::query()
            ->where('content', 'LIKE', "%{$query}%")
            ->orWhere('title', 'LIKE', "%{$query}%");

        return SectionResource::collection($query->paginate(5));
    }
}
