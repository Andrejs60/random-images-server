<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Returns an array of URLs for 4 images in ascending alphabetical file name order
     */
    public function ascendingOrder(){
        $allImagePaths = Storage::disk("public")->files("/images");

        sort($allImagePaths); // Ascending sort
        
        $imageUrls = $this->getImageUrls($allImagePaths);
        
        return response()->json([
            "images" => $imageUrls
        ]);
    }

    /**
     * Returns an array of URLs for 4 images in descending alphabetical file name order
     */
    public function descendingOrder(){
        $allImagePaths = Storage::disk("public")->files("/images");

        rsort($allImagePaths); // Descending sort
        
        $imageUrls = $this->getImageUrls($allImagePaths);
        
        return response()->json([
            "images" => $imageUrls
        ]);
    }

    /**
     * Returns an array of URLs for 4 images in random file name order
     */
    public function randomOrder(){
        $allImagePaths = Storage::disk("public")->files("/images");

        shuffle($allImagePaths); // Random sort
        
        $imageUrls = $this->getImageUrls($allImagePaths);
        
        return response()->json([
            "images" => $imageUrls
        ]);
    }

    /**
     * Returns image urls from the provided image paths.
     */
    private function getImageUrls(array $allImagePaths): array{
        $imageUrls = [];
        foreach ($allImagePaths as $imagePath) {
            array_push($imageUrls, url("") . Storage::url($imagePath));
        }
        return $imageUrls;
    }
}
