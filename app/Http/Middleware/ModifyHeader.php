<?php

namespace App\Http\Middleware;

use App\Services\Helpers\IdHashingHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ModifyHeader
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty($request->headers->get('Content-Type'))) {
            $request->headers->set('Content-Type', 'application/json');
        }

        if ($request->headers->get('Accept') == '*/*') {
            $request->headers->set('Accept', 'application/json');
        }

//        $propertyId = $request->headers->has('propertyId') ? $request->headers->get('propertyId') : $request->get('propertyId');
//        if (!empty($propertyId)) {
//
//            $request->merge(['propertyId' => $propertyId]);
//            $property = Property::find($propertyId);
//
//            \View::share('property', $property);
//        }


        foreach ($request->all() as $key => $value) {
            if ((strpos($key, 'Id') || $key == 'id') && !is_numeric($value) && !is_null($value) && !is_array($value)) {
                $request->merge([$key => IdHashingHelper::decode($value)]);
            }

            if (($key == 'subCategoryIds') && is_array($value) && !is_null($value)) {
                $subCategoryIds = [];
                foreach ($value as $ke => $subCategoryId) {
                    $subCategoryIds[$ke] = IdHashingHelper::decode($subCategoryId);
                }
                $request->merge([$key => $subCategoryIds]);
            }

            if ($key == 'products') {
                $newProducts = [];
                foreach ($value as $ke => $product) {
                    foreach ($product as $k => $v) {
                        if (strpos($k, 'Id') && !is_numeric($v)) {
                            $product[$k] = IdHashingHelper::decode($v);
                        }
                    }
                    $newProducts[$ke] = $product;
                }
                $request->merge([$key => $newProducts]);
            }
        }

        $response = $next($request);
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set("Access-Control-Allow-Headers", "Origin, Content-Type, Accept, Authorization, X-Requested-With");
        $response->headers->set("Access-Control-Allow-Methods", "OPTIONS, HEAD, GET, POST, PUT, DELETE");
        $response->headers->set("CrossOrigin", "Anonymous");

        return $response;
    }
}
