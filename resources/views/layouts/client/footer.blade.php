 <!-- Footer Start -->
 <div class="container-fluid bg-primary text-light footer wow fadeIn mt-0" data-wow-delay="0.1s">
     <div class="container ">
         <div class="row g-5">
             <div class="col-md-6 col-lg-4">
                 <p class="section-title text-white h5 mb-4">Address<span></span></p>
                 <p><i class="fa fa-map-marker-alt me-3"></i>RANCHI, JHARKHAND, INDIA</p>
                 <p><i class="fa fa-phone-alt me-3"></i>+91 9128227890</p>
                 <p><i class="fa fa-envelope me-3"></i>serviceondoor@example.com</p>
                 <div class="d-flex pt-2">
                     <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                     <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                     <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-instagram"></i></a>
                     <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                 </div>
             </div>
             <div class="col-md-6 col-lg-4">
                 <p class="section-title text-white h5 mb-4">Quick Link<span></span></p>
                 <a class="btn btn-link" href="{{url('/privacy')}}">Privacy Policy</a>
                 <a class="btn btn-link" href="{{url('terms-and-condition')}}">Terms & Condition</a>
                 <a class="btn btn-link" href="{{url('career')}}">Career</a>
             </div>
             <div class="col-md-6 col-lg-4">
                 <p class="section-title text-white h5 mb-4">Newsletter<span></span></p>
                 <p>Enter email to recieve daily news and updates.</p>
                 <div class="position-relative w-100 mt-3">
                    <form action="{{url('/newsletter/subscribe')}}" method="post">
                    @csrf
                        <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text"
                            placeholder="Your Email" style="height: 48px;">
                        <button type="submit" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i
                                class="fa fa-paper-plane text-primary fs-4"></i></button>
                    </form>
                 </div>
             </div>
         </div>
     </div>
     <div class="container px-lg-5">
         <div class="copyright">
             <div class="row">
                 <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                     &copy; <a class="border-bottom" href="https://jharnirbhar.thecognizance.in">JharNirbhar</a>, All Right Reserved.
                 </div>
                 <div class="col-md-6 text-center text-md-end">
                     <div class="footer-menu">
                         <a href="{{url('/')}}">Home</a>
                         <a href="{{url('/cookies')}}">Cookies</a>
                         <a href="{{url('/help')}}">Help</a>
                         <a href="{{url('/faqs')}}">FAQs</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Footer End -->

 @yield('Custom_footer')
