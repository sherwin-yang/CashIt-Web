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

        $moneyChangerId = session()->get('user.id');
        $revision = Revision::where('moneyChangerId', $moneyChangerId)->first();

        if(empty($revision)) {
            $revision = 'Informasi registrasi yang anda kirim sedang dalam proses peninjauan.';
            return view('main-view.mc_revision', ['revision'=>$revision]);
        }

        return view('main-view.mc_revision', ['revision'=>$revision->revisionNote]);
    }

    public function navigateToEditProfile() {
        if(!session()->has('user')) {
            return redirect('login');
        }

        if(session()->get('role') == 'mc') {
            if(session()->get('user.isActivated') == false) {
                return redirect()->route('showEditProfilePage');
            }
            return redirect()->route('appointment');
        }
        else if(session()->get('role') == 'admin') {
            return redirect()->route('admin');
        }
    }

}
