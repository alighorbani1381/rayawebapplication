<?php
namespace App\Request;

class CostRequest{

    public function update($request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'money_paid' => 'required',
        ]);
    }

    public function redirectUpdate($cost)
    {
        session()->flash('UpdateCost');
        if (session()->has('SendWithProject') || session()->has('SendWithShow'))
            return back();
        else
            return redirect()->route('costs.show', $cost->id);
    }
}