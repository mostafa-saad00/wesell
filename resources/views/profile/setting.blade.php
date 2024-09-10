<x-app-layout>
   
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

              

                <div class="row mt-5">
                    <div class="col-xxl-3">
                        <div class="card mt-n5">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                            <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                            <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                <span class="avatar-title rounded-circle bg-light text-body">
                                                    <i class="ri-camera-fill"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <h5 class="fs-16 mb-1">{{ auth()->user()->name }}</h5>
                                    <p class="text-muted mb-0">Store Owner</p>
                                </div>
                            </div>
                        </div>
                        <!--end card-->
                        
                    
                    </div>
                    <!--end col-->
                    <div class="col-xxl-9">
                        <div class="card mt-xxl-n5">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link text-body active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                            <i class="fas fa-home"></i>
                                            Personal Details
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-body" data-bs-toggle="tab" href="#changePassword" role="tab">
                                            <i class="far fa-user"></i>
                                            Change Password
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                            <div class="card-body p-4">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">
                                                        Name
                                                    </label>
                                                    <input type="text" class="form-control" id="name" value="{{ auth()->user()->name }}" disabled>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">
                                                        Email
                                                    </label>
                                                    <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" disabled>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">
                                                        Phone
                                                    </label>
                                                    <input type="text" class="form-control" id="phone" value="{{ auth()->user()->phone }}" disabled>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                        
                                    </div>
                                    <!--end tab-pane-->
                                    
                                    <div class="tab-pane" id="changePassword" role="tabpanel">
                                        <form  method="post" action="{{ route('password.update') }}">
                                            @csrf
                                            @method('put')

                                            <div class="row g-2">
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="oldpasswordInput" class="form-label">Old
                                                            Password*</label>
                                                        <input type="password" name="current_password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">
                                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="newpasswordInput" class="form-label">New
                                                            Password*</label>
                                                        <input type="password" name="password" class="form-control" id="newpasswordInput" placeholder="Enter new password">
                                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="confirmpasswordInput" class="form-label">Confirm
                                                            Password*</label>
                                                        <input type="password" name="password_confirmation" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">
                                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                                    </div>
                                                </div>
                                                
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-success">Change
                                                            Password</button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                            
                                        </form>
                                        
                                    </div>
                                    <!--end tab-pane-->
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                @if (session('status') === 'password-updated')
                    <div 
                        style="z-index: 11"
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 5000)" 
                        class="toast-container position-absolute p-3 bottom-0 end-0">

                        <div id="borderedToast2" class="toast toast-border-success overflow-hidden mt-3 fade show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <i class="ri-checkbox-circle-fill align-middle"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Password Changed</h6>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('status') === 'password-update-failed')
                    <div 
                        style="z-index: 11"
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 5000)" 
                        class="toast-container position-absolute p-3 bottom-0 end-0">

                        <div style="z-index: 11">
                            <div id="borderedToast4" class="toast toast-border-danger overflow-hidden mt-3 fade show" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2">
                                            <i class="ri-alert-line align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0">Something went wrong!</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <!-- container-fluid -->
        </div><!-- End Page-content -->

       
        
        
       
        
       
  


        
    </div>
    
   
</x-app-layout>
