@extends('layouts.app')
@section('title', 'USUARIOS')
@section('content')
@section('styles')
<link rel="stylesheet" href="/assets/vendor/css/pages/page-profile.css" />
@endsection
   
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="user-profile-header-banner">
        <img src="{{ asset('/assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
      </div>
      <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
          <img src="{{ asset('/assets/img/avatars/1.png') }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded-3 user-profile-img">
        </div>
        <div class="flex-grow-1 mt-3 mt-sm-5">
          <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
             <div class="flex-grow-1">
                  <span class="fw-semibold d-block lh-1">{{ auth()->user()->name }}</span>
                  <small>
                    @if (Auth::user()->hasRole('admin'))
                      <b>Administrador</b>
                      @else
                      <b>Usuario</b>
                    @endif
                  </small>
                </div>
               <a href="javascript:void(0)" class="btn btn-primary text-nowrap">
              <i class='bx bx-user-check'></i> Connected
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
      <!-- About User -->
      <div class="card mb-4">
        <div class="card-body">
          <small class="text-muted text-uppercase">Datos del usuario</small>
          <ul class="list-unstyled mb-4 mt-3">
            <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-semibold mx-2">Nombre completo:</span> <span>{{ Auth::user()->name }}</span></li>
            <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-semibold mx-2">Estado del usuario:</span> 

              @if ($user->status == 1)
                <span class="badge bg-success">Usuario activo</span>
              @else
                <span class="badge bg-danger">Usuario inactivo</span>
              @endif

            </li>
            <li class="d-flex align-items-center mb-3"><i class="bx bx-star"></i><span class="fw-semibold mx-2">Role:</span>

               @if ($user->hasRole('admin'))
                <b>Administrador</b>
              @else
                <b>Usuario general</b>
              @endif

            </li>
             <li class="d-flex align-items-center mb-3"><i class="bx bx-mail-send"></i><span class="fw-semibold mx-2">Correo electrónico:</span>
              <span>{{ $user->email }}</span>
              

            </li>
            
          </ul>
          
      </div>
    </div>
  </div>
  @php
    $logins = App\Models\LoginUser::orderBy('id','desc')->take(5)->get()
  @endphp
    <div class="col-xl-8 col-lg-7 col-md-7">
    <!-- Activity Timeline -->
    <div class="card card-action mb-4">
      <div class="card-header align-items-center">
        <h5 class="card-action-title mb-0"><i class='bx bx-list-ul bx-sm me-2'></i>Línea de tiempo de actividades</h5>
       {{--  <div class="card-action-element btn-pinned">
          <div class="dropdown">
            <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
            <ul class="dropdown-menu dropdown-menu-end">
             
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
            </ul>
          </div>
        </div> --}}
      </div>
      <div class="card-body">
        <ul class="timeline ms-2">
         @foreach ($logins as $element)
           <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-info"></span>
            <div class="timeline-event">
              <div class="timeline-header mb-1">
                <h6 class="mb-0">Desgloce de actividades</h6>
                <small class="text-muted">{{ $element->created_at->diffForHumans(); }}</small>
              </div>
              <p class="mb-0">{!! $element->descripcion !!}</p>
            </div>
          </li>
         @endforeach
        
          
          <li class="timeline-end-indicator">
            <i class="bx bx-check-circle"></i>
          </li>
        </ul>
      </div>
    </div>
    <!--/ Activity Timeline -->
  </div>
</div>

@endsection