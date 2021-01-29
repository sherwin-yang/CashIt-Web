<?php

namespace App\Http\Controllers;

use App\Models\Revision;

class RevisionPageController extends Controller
{
    public function getRevisionNote() {
        if(!session()->has('user')) {
            return redirect('login');
        }

        if(session()->get('role') == 'admin') {
            return redirect()->route('admin');
        }

        if(session()->get('user.isActivated') == true) {
            return redirect()->route('appointment');
        }

        $moneyChangerId = session()->get('user.id');
        $revision = Revision::where('moneyChangerId', $moneyChangerId)->first();

        if(empty($revision)) {
            $revision = 'Formulir registrasi yang anda kirim sedang dalam proses peninjauan.';
            return view('main-view.mc_revision', ['revision'=>$revision]);
        }

        return view('main-view.mc_revision', ['revision'=>$revision->revisionNote]);
    }

}
