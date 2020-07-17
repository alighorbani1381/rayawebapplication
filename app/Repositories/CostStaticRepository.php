<?php

namespace App\Repositories;

use App\Cost;
use App\CostStatic;
use Illuminate\Support\Facades\DB;

class CostStaticRepository
{

    public function getStaticCosts()
    {
        return CostStatic::orderBy('child')->paginate(15);
    }

    public function getMainCostStatic()
    {
        return CostStatic::where('child', '0')->get();
    }

    public function getMainWithoutSelf($costStatic)
    {
        return CostStatic::where('child', '0')->where('id', '!=', $costStatic)->get();
    }

    public function getCostStatic($costId)
    {
        return CostStatic::findOrFail($costId);
    }

    /*
    private function deleteSubCost($costStatic)
    {
        $subCosts = $this->getSubCost($costStatic);
        foreach ($subCosts as $cost)
            $this->deleteCost($cost->id);
    }
    */

    public function deleteSubOrSetFlash($costStatic)
    {
        $isMain = $this->isMain($costStatic);
        $hasCost = $this->hasCost($costStatic);

        if ($isMain)
            session()->flash('CantDeleteCostStaticMain');

        if ($hasCost)
            session()->flash('CantDeleteCostStatic');

        if ($hasCost || $isMain)
            return redirect()->route('static.index');

        session()->flash('DeleteCostStatic');
        //$costStatic->delete();
        return back();
    }

    public function isMain($costStatic)
    {
        return ($costStatic->child == 0);
    }

    public function hasCost($costStatic)
    {
        return Cost::where('type', $costStatic->id)->exists();
    }

    private function deleteCost($costId)
    {
        DB::table('cost_statics')
            ->where('cost_statics.id', $costId)
            ->delete();
    }

    private function getSubCost($costStatic)
    {
        return CostStatic::where('child', $costStatic->id)->select('id')->get();
    }
}
