<?php

namespace App\Interfaces;
use Illuminate\Http\Request;
interface PetRepositoryInterface 
{
    public function findById($id);
    public function addNewPet(Request $request);
    public function deletePetById($id);
    public function uploadImage(Request $request,$id);
}