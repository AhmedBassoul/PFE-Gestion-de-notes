@extends('layouts.master')

@section('title')
    Code Secret
@endsection

@section('css')
@endsection

@section('content')
    <!--content -->

    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12 col-md-9">
            <div class="card shadow-sm my-5">
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Saisir le Code Secret </h1>
                                </div>
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                        <div class="p-6 text-gray-900 dark:text-gray-100">
                                            @if (session('error'))
                                                <div onclick="this.style.display='none'"
                                                    class="alert alert-light alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                            <div class="card-body">
                                                <form method="POST" action="{{ route('saisir', ['ids' => $ids]) }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input autofocus pattern="[0-9]{1,4}" type="text"
                                                            name="code_saisi" id="code_saisi" class="form-control"
                                                            placeholder="Entrer le code secret"
                                                            value="{{ old('code_saisi') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-block">Valider</button>
                                                    </div>
                                                </form>
                                            </div>
                                            {{--
                                                <div class="flex items-center justify-end mt-4">
                                                    @if (Route::has('password.request'))
                                                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="">
                                                            {{ __('Forgot your password?') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end content -->
@endsection


@section('scripts')
@endsection
