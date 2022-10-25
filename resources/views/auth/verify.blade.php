@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            {{--Aula 221 tradução--}}
                <div class="card-header">Falta pouco agora precisamos apenas que você valide seu email </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            reenviamos um email para você com o link de validação
                        </div>
                    @endif

                    Antes de utilizar os recursos da aplicação por favor valide seu email, através do link de validação que foi enviado para seu email
                    <br>
                    Caso não tenha recebido clique no link a seguir para receber novo email.
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Clique aqui</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
