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
                                    <a href="">contact@faistroquer.fr</a>
                                </li>
                                <li>
                                    <span>Tel:</span>
                                    <a href="">+343-33-32-40-43</a>
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
                                                <a href="">Contrat d'échange</a>
                                            </li>
                                            <li>
                                                <a href="">Aide</a>
                                            </li>
                                            <li>
                                                <a href="">A propos</a>
                                            </li>
                                            <li>
                                                <a href="">Contact</a>
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
                                                <a href="">{{$parentcategory['name']}}</a>
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
                        Faistroquer.fr © 2023. Developed by <a href="">SEOMANIAK</a>
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