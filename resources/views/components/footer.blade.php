<!-- Footer -->
<footer id="main-footer">
        <div class="footer-content">
            <div class="container">
                <div class="row g-0">
                    <div class="col-sm-6 col-md-4 ">
                        <div class="footer-content-infos">
                            <img src="{{ asset('images/logo-faistroquerfr.svg') }} " alt="Footer logo faistroquer.fr" class="footer-logo" />
                            <span>
                                4517 Washington Ave. Manchester, Kentucky 39495
                            </span>
                            <ul>
                                <li>
                                    <span>Email:</span>
                                    <a href="">{{$information->email}}</a>
                                </li>
                                <li>
                                    <span>Tel:</span>
                                    <a href="">{{$information->phone}}</a>
                                </li>
                            </ul>
                            <div class="footer-socialmedias">
                                <a href="footer-socialmedias-icon footer-socialmedias-icon-facebook"></a>
                                <a href="footer-socialmedias-icon footer-socialmedias-icon-facebook"></a>
                                <a href="footer-socialmedias-icon footer-socialmedias-icon-facebook"></a>
                                <a href="footer-socialmedias-icon footer-socialmedias-icon-facebook"></a>
                                <a href="footer-socialmedias-icon footer-socialmedias-icon-facebook"></a>
                                <a href="footer-socialmedias-icon footer-socialmedias-icon-facebook"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8 ">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="footer-content-links">
                                    <h3>Liens</h3>
                                    <nav>
                                        <ul>
                                            <li>
                                                <a href="{{$information->contrat}}" target="_blank">Contrat d'échange</a>
                                            </li>
                                            <li>
                                                <a href="{{route('help')}}">Aide</a>
                                            </li>
                                            <li>
                                                <a href="{{route('about')}}">A propos</a>
                                            </li>
                                            <li>
                                                <a href="/contact">Contact</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-8">
                                <div class="footer-content-links">
                                    <h3>Categories</h3>
                                    <nav>
                                        <ul class="footer-content-links-grid">
                                            @if($parentcategories)
                                            @foreach($parentcategories as $parentcategory)
                                            <li>
                                                <a href="{{route('alloffers.index',['category'=> $parentcategory['id']])}}">{{$parentcategory['name']}}</a>
                                            </li>
                                            @endforeach                                        
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="footer-copyright-content">
                    <div class="footer-copyright-text">
                        Faistroquer.fr © 2023. Developed by <a href="https://seomaniak.ma">SEOMANIAK</a>
                    </div>
                    <div class="footer-links">
                        <ul>
                            <li>
                                <a href="">Politique de confidentialité</a>
                            </li>
                            <li>
                                <a href="">Conditions générales d'utilisation</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>