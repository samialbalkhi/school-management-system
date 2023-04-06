<?php 
namespace App\Repository ;

use Illuminate\Http\Request;

interface promotionRepositoryInterface
{
    public function index();
    public function store(Request $request);
    public function create();   
    public function delete_promotion(Request $request);
}