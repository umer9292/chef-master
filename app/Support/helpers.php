<?php

//use App\Category;
use Carbon\Carbon;

function diff4Human ($date) {
    return is_null($date) ? 'N/A' : Carbon::parse($date)->diffForHumans();
}

#   get only date
function getOnlyDate ($date) {
    return is_null($date) ? 'N/A' : Carbon::parse($date)->toDateString();
}

function getCategoryName($catId)
{
    return \App\Category::find($catId)->name;
}

function getCompanyName($compId)
{
    return \App\Company::find($compId)->name;
}

function getProduct($Id)
{
    return \App\Product::find($Id)->first();
}
