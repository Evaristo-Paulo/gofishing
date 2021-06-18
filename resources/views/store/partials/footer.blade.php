<footer class="footer">
    <!-- Start Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="inner-content">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="footer-logo">
                            <a href="{{ route('store.home') }}">
                                <img src="{{ asset('store/assets/images/logo/white-logo.svg') }}"
                                    alt="#">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="footer-newsletter">
                            <h4 class="title">
                                Subscrever na Newsletter
                                <span>Seja o primeiro a receber notificações sobre novos produtos e ofertas.</span>
                            </h4>
                            <div class="newsletter-form-head">
                                <form action="#" method="get" target="_blank" class="newsletter-form">
                                    <input name="EMAIL" placeholder="Email" type="email">
                                    <div class="button">
                                        <button class="btn" type="button">Subscrever<span class="dir-part"></span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Top -->
    <!-- Start Footer Middle -->
    <div class="footer-middle">
        <div class="container">
            <div class="bottom-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer f-contact">
                            <h3>Contacta-Nos</h3>
                            <p class="phone">(+244) 940570866</p>
                            <ul>
                                <li><span>De segunda à sexta-feira: </span> 9h:00 - 20h:00</li>
                                <li><span>Sábado: </span> 10h:00 - 18h:00</li>
                            </ul>
                            <p class="mail">
                                <a href="mailto:support@shopgrids.com">supporte@gmail.com</a>
                            </p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer f-link">
                            <h3>Informação</h3>
                            <ul>
                                <li><a href="{{ route('store.home') }}">Home</a></li>
                                <li><a href="#">Sobre Nós</a></li>
                                <li><a href="#" data-bs-toggle="modal"
                                    data-bs-target="#contactUsModal" >Contacta-Nos</a></li>
                                <li><a href="#">FAQs</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Middle -->
    <!-- Start Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="inner-content">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-12">
                        <div class="payment-gateway">
                            <span>Aceitamos:</span>
                            <img src="{{ asset('store/assets/images/footer/credit-cards-footer.png') }}"
                                alt="#">
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="copyright">
                            <p><a href="#" rel="nofollow" target="_blank"> &copy; GoShopping 
                                    2021 -</a> Todos Direitos Reservados</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <ul class="socila">
                            <li>
                                <span>Siga-Nos:</span>
                            </li>
                            <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Bottom -->
</footer>
