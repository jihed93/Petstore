<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\PetRepositoryInterface;
use Illuminate\Http\Request;


use App\Models\Pet;
use App\Models\ApiResponse;
use App\Models\PhotoUrl;
use App\Models\Tag;




class PetRepository implements PetRepositoryInterface
{
    use ApiResponse;
    /**
     * Find Pet by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function findById($id)
    {

        return $this->successResponse(
            Pet::query()
                ->findOrfail($id)
                ->with(['tags'])
                ->with(['photoUrls'])
                ->first()
        );
    }
     /**
     * Add a new pet .
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addNewPet(Request $request)
    {
       // $validated = $request->validated();
       $data = $request->only([
        'name',
        'category',
        'tags',
        'photo_urls'
     ]);
        $pet = new Pet($data);
        $pet->status = Pet::STATUS['AVAILABLE'];
        $pet->category_id = $data['category']['id'];

        $pet = DB::transaction(
            function () use ($pet, $data) {
                $pet->save();
                $tags = $data['tags'];
                foreach ($tags as $tag) {
                    $pettag=new Tag();
                    $pettag->name=$tag['name'];
                    $pet->tags()->save($pettag);
                }
                
                $petPhotoUrls = $data['photo_urls'];
                if (isset($petPhotoUrls) && count($petPhotoUrls) > 0) {
                    foreach ($petPhotoUrls as $photo) {
                        if (Storage::disk('public')->exists('tmp/' . $photo)) {
                            Storage::disk('public')->move('tmp/' . $photo, 'pets/' . $photo);
                        }
                        $petphoto=new PhotoUrl();
                        $petphoto->pet_id=$pet->id;
                        $petphoto->photo_url = $photo;
                        $pet->photoUrls()->save($petphoto);
                    }
                }
                return $pet;
            }
        );
        return $this->successResponse($pet);
    }
    /**
     * Delete a pet.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePetById($id)
    {
        $pet = Pet::findOrFail($id);

        DB::transaction(
            function () use ($pet) {
                $pet->delete();
                Tag::where('pet_id', $pet->id)->delete();
                $petPhotoUrls = PhotoUrl::where('pet_id', $pet->id)->pluck('photo_url');
                
                foreach ($petPhotoUrls as $photo) {
                    if (Storage::disk('public')->exists('pets/' . $photo)) {
                        Storage::disk('public')->delete('pets/' . $photo);
                    }
                }

                PhotoUrl::where('pet_id', $pet->id)->delete();
            }
        );

        return $this->okResponse();
    }
    /**
     * Upload pet image.
     *
     */
    public function uploadImage(Request $request,$id)
    {
        $uploadImg = $request->file('image');
        $photo= new PhotoUrl();
        $photo->pet_id = $id;
        if ($uploadImg->isValid()) {
            $imageUploadPath = $uploadImg->store('tmp', 'public');
            $photo->photo_url = $imageUploadPath ;
            $photo->save();
            return $this->successResponse([
                'file_name' =>  basename($imageUploadPath),
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Upload image file failed',
        ], 400);
    }
}
