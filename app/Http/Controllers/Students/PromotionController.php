<?php

namespace App\Http\Controllers\students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\promotionRepositoryInterface;
use App\Http\Requests\Promotion\PromotionRequest;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   protected $promotion ;

   public function __construct(promotionRepositoryInterface $promotion)
   {
        $this->promotion = $promotion;
   }

    public function index()
    {
        return $this->promotion->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->promotion->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PromotionRequest $request)
    {
        return $this->promotion->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function delete_promotion(Request $request)
    {
        return $this->promotion->delete_promotion($request);
    }
}
