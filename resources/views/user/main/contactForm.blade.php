
@extends('user.layouts.master')

@section('content')
<div class="container-fluid bg-dark">
    <div class="col-2 offset-9 mb-2">
        {{-- Create Success Alert Message --}}
        @if(session('contactSuccess'))
        <div class="">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="text-success fa-regular fa-circle-check mr-2"></i>{{session('contactSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        </div>
        @endif
    </div>
    <div class="row px-xl-5 ">
        <div class="col-md-4 offset-4 mb-5">

            <h5 class="text-secondary text-uppercase mt-2 mb-4">Contact Us</h5>
                <form name="sentMessage" id="contactForm" novalidate="novalidate" action="{{ route('user#contactList') }}" method="post">
                    @csrf
                    <div class="control-group">
                        <input type="hidden" name="userId" value="{{ Auth::user()->id }}" id="userId">
                                <div class="control-group">
                                    <input type="text" class="form-control text-secondary" id="name" name="name" value="{{ old('name',Auth::user()->name) }}" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <input type="email" class="form-control text-secondary @error ('email') is-invalid @enderror" id="email" name="email" placeholder="Your Email" value="{{ old('email',Auth::user()->email) }}"
                                         />
                                        @error('email')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                        @enderror
                                        <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <textarea class="form-control @error ('name') is-invalid @enderror" rows="8" id="message" name="message" placeholder="Message"></textarea>
                                        @error('message')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                        @enderror
                                        <p class="help-block text-danger"></p>
                                </div>
                                <div>
                                    <button class="btn btn-sm bg-light py-2 px-4" type="submit" id="sendMessageButton">Send
                                        Message</button>
                                </div>
                    </div>
                </form>
        </div>
        <h6 class="text-secondary text-uppercase ms-3 mt-4 mb-3">Follow Us</h6>
        <div class="d-flex ms-3 mb-3">
            <a class="btn btn-white bg-white btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
            <a class="btn btn-white bg-white btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-white bg-white btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
            <a class="btn btn-white bg-white btn-square" href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</div>
@endsection

