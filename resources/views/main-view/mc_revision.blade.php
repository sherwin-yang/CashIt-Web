@extends('main-view/layout/mc_main')

@section('title', 'Revision')

@section('revision')
    <div class="revision">
        <h1>Catatan Revisi</h1>

        <p>Catatan Revisi : <span class="mc_revision_note">{{ $revision }}</span></p>

        <a href="/editProfile">
            <button type="button" class="btn btn-info">Revisi</button>
        </a>
    </div>
@endsection
