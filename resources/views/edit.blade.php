@extends('layout')
@section('content')
<style>
    .container {
        max-width: 450px;
    }
    .push-top {
        margin-top: 50px;
    }
</style>
<div class="card push-top">
    <div class="card-header">
    Edit & Update
    </div>
<div class="card-body">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div><br />
    @endif
    <form method="post" action="{{ route('offres.update', $offre->id) }}">
            <div class="form-group">
            @csrf
            @method('PATCH')
                <label for="titre">titre</label>
                <input type="text" class="form-control" name="titre" value="{{ $offre->titre }}"/>
            </div>
            <div class="form-group">
                <label for="type_contrat">type de contrat</label>
                <select id="type_contrat" name="type_contrat" value="{{$offre->type_contrat}}">
                    <option value="CDI">CDI</option>
                    <option value="CDD">CDD</option>
                </select>
            </div>
            <div class="form-group">
                <label for="rythme">rythme</label>
                <select id="rythme" name="rythme" value="{{$offre->rythme}}">
                    <option value="full time">full time</option>
                    <option value="part time">part time</option>
                </select>
            </div>
            <div class="form-group">
                <label for="type_region">type region</label>
                <select id="type_region" name="type_region" value="{{$offre->type_region}}">
                    <option value="remote">remote</option>
                    <option value="office">office</option>
                </select>
            </div>
            <div class="form-group">
                <label for="diplome">diplome requis</label>
                <select id="diplome" name="diplome" value="{{$offre->diplome}}">
                    <option value="bac">bac</option>
                    <option value="bac+1">bac+1</option>
                    <option value="bac+2">bac+2</option>
                    <option value="bac+3">bac+3</option>
                    <option value="bac+4">bac+4</option>
                    <option value="bac+5">bac+5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="experience">experience requise</label>
                <select id="experience" name="experience" value="{{$offre->experience}}">
                    <option value="aucune experience">aucune experience</option>
                    <option value="moins d'un an">moins d'un an</option>
                    <option value="entre 1 et 2 ans">entre 1 et 2 ans</option>
                    <option value="entre 2 et 5 ans">entre 2 et 5 ans</option>
                    <option value="entre 5 et 10 ans">entre 5 et 10 ans</option>
                    <option value="plus que 10 ans">plus que 10 ans</option>
                </select>
            </div>
            <div class="form-group">
                <label for="salaire">salaire</label>
                <input type="text" class="form-control" name="salaire" value="{{ $offre->salaire }}"/>
            </div>
            <div class="form-group">
                <label for="outils">outils</label>
                <input type="text" class="form-control" name="outils" value="{{ $offre->outils }}"/>
            </div>
            <div class="form-group">
                <label for="avantages">avantages</label>
                <input type="text" class="form-control" name="avantages" value="{{ $offre->avantages }}"/>
            </div>
            <div class="form-group">
                <label for="description">description</label>
                <input type="text" class="form-control" name="description" value="{{ $offre->description }}"/>
            </div>
            <div class="form-group">
                <label for="date">date début</label>
                <input type="date" class="form-control" name="date" value="{{ $offre->date_debut }}"/>
            </div>
            <button type="submit" class="btn btn-block btn-danger">Update offre</button>
    </form>
</div>
</div>
@endsection