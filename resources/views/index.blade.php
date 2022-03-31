@extends('layout')
@section('content')
<style>
    .push-top {
    margin-top: 50px;
    }
</style>
<div class="push-top">
@if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}  
    </div><br />
@endif
    <table class="table">
    <thead>
        <tr class="table-warning">
            <td>titre</td>
            <td>type de contrat</td>
            <td>rythme</td>
            <td>type region</td>
            <td>diplome requis</td>
            <td>experience requise</td>
            <td>salaire</td>
            <td>outils/logiciels utilisés à ce poste</td>
            <td>avantages</td>
            <td>description</td>
            <td>date de debut</td>
            
            <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($offre as $Offres)
        <tr>
            <td>{{$offres->titre}}</td>
            <td>{{$offres->type_contrat}}</td>
            <td>{{$offres->rythme}}</td>
            <td>{{$offres->type_region}}</td>
            <td>{{$offres->diplome}}</td>
            <td>{{$offres->exigences}}</td>
            <td>{{$offres->salaire}}</td>
            <td>{{$offres->outils}}</td>
            <td>{{$offres->avantages}}</td>
            <td>{{$offres->description}}</td>
            <td>{{$offres->date_debut}}</td>
            <td class="text-center">
                <a href="{{ route('offres.edit', $offres->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                <form action="{{ route('offres.destroy', $offres->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
<div>
@endsection