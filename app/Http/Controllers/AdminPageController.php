<?php

namespace App\Http\Controllers;

use App\Models\MoneyChanger;
use App\Models\Revision;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function getAllPendingMoneyChanger() {
        if(!session()->has('user')) {
            return redirect('login');
        }

        if(session()->get('role') == 'admin') {
            $moneyChangers = MoneyChanger::where('isActivated', false)->get();
            return view('admin-view.admin', ['moneyChangers'=>$moneyChangers]);
        }

        return redirect()->route('appointment');
    }

    public function approveMoneyChanger(Request $request) {
        if($request->button == 'approve') {
            $revision = Revision::where('moneyChangerId', $request->moneyChangerId)->first();

            if(!empty($revision)) {
                $revision->delete();
            }

            $moneyChanger = MoneyChanger::find($request->moneyChangerId);
            $moneyChanger->latitudeCoordinate = $request->latitudeCoordinate;
            $moneyChanger->longitudeCoordinate = $request->longitudeCoordinate;
            $moneyChanger->isActivated = true;
            $moneyChanger->save();
        }

        return redirect()->route('admin');
    }

    public function giveRevisionNote(Request $request) {
        $existedRevision = Revision::where('moneyChangerId', $request->moneyChangerId)->first();

        if(!$existedRevision) {
            $revision = new Revision();
            $revision->moneyChangerId = $request->moneyChangerId;
            $revision->adminId = session()->get('user.id');
            $revision->revisionNote = $request->revisionNote;
            $revision->save();
        }
        else {
            $existedRevision->revisionNote = $request->revisionNote;
            $existedRevision->save();
        }

        return redirect()->route('admin');
    }
}
