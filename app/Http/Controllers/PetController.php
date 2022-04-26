<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\PetRepositoryInterface;

class PetController extends Controller
{
    private  $petRepository;

    public function __construct(PetRepositoryInterface $petRepository)
    {
        $this->petRepository = $petRepository;
    }
    public function findById($id)
    {

        return $this->petRepository->findById($id);
    }
    public function addNewPet(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'array'],
            'photo_urls' => ['required', 'array']
        ]);
        return $this->petRepository->addNewPet($request);
    }
    public function deletePetById($id)
    {
        return $this->petRepository->deletePetById($id);
    }
    public function uploadImage(Request $request, $id)
    {
        $request->validate([
            'image' => ['required'],

        ]);
        return $this->petRepository->uploadImage($request, $id);
    }
}
