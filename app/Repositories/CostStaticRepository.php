<?php

namespace App\Repositories;

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

    private function deleteSubCost($costStatic)
    {
        $subCosts = $this->getSubCost($costStatic);
        foreach ($subCosts as $cost)
            $this->deleteCost($cost->id);
    }

    public function deleteSubOrSetFlash($costStatic)
    {
        if (!$this->isMain($costStatic))
            session()->flash('DeleteCostStatic');

        if ($this->isMain($costStatic)) {
            $this->deleteSubCost($costStatic);
            session()->flash('DeleteCostStaticAllMember');
        }
        $costStatic->delete();
    }

    public function isMain($costStatic)
    {
        return ($costStatic->child == 0);
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
