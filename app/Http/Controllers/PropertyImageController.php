<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyImage;
use App\Models\Property;   // <---- Add this import

class PropertyImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reorder(Request $request)
    {
        $data = $request->validate([
            'order' => 'required|array',
            'main_image_id' => 'required|integer',
            'property_id' => 'required|integer',
        ]);

        PropertyImage::where('property_id', $data['property_id'])
            ->update(['is_main' => false]);

        foreach ($data['order'] as $index => $imageId) {
            PropertyImage::where('id', $imageId)
                ->update([
                    'order' => $index,
                    'is_main' => ($imageId == $data['main_image_id']) ? 1 : 0,
                ]);
        }

        $mainImage = PropertyImage::find($data['main_image_id']);
        if ($mainImage) {
           
            Property::where('id', $data['property_id'])->update([
    'image' => $mainImage->image_path
]);

        }

        return response()->json(['status' => 'success']);
    }
}
