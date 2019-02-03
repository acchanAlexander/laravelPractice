<?php

use Illuminate\Http\Request;

use App\SubCategory;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sub_categories', function (Request $request) {
    $categoryId = $request->q;
    return getSubCategoryListSqueezedByCategoryId($categoryId);
});

function getSubCategoryListSqueezedByCategoryId($categoryId)
{
    $allSubCategoryList = SubCategory::all();
    $squeezedList = [];

    foreach($allSubCategoryList as $subCategory) {
      if($subCategory['category_id'] === (int)$categoryId) {
          $squeezedList[] = $subCategory;
      }
    }

    return $allSubCategoryList->wrap($squeezedList)->pluck('name', 'id');
}
