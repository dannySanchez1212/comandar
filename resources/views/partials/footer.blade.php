@if (Request::is('/')==1)
       <footer class="bottom-footer trasparen">
            <div class="grid-container">
                <div class="grid-x grid-padding-y">
                    <div class="cell small-12" style="padding-top:0%;">
                    <div class="container">
                        <div class="row">
                            <div class="has-feedback">
                                <div class="col-sm-10" style="display: flex;justify-content: center; zoom: 62%;">
                                    <img src="{{ url('/') }}/Images/Supermercado/delivery.jpg" />
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            1 file
                                <div class="has-feedback">
                                    flags
                                        <div class="col-lg-12" style="display:flex;">

                                            <div class="col-xs-1 col-sm-1 col-md-1" style="border: solid 2px #fff;">
                                                <img src="{{ url('/') }}/images/flags/estados-unidos.jpg" />
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1" style="border: solid 2px #fff;">
                                                <img src="{{ url('/') }}/images/flags/reino-unido.jpg" />
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1" style="border: solid 2px #fff;">
                                                <img src="{{ url('/') }}/images/flags/francia.jpg" />
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1" style="border: solid 2px #fff;">
                                                <img src="{{ url('/') }}/images/flags/canada.jpg" />
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1" style="border: solid 2px #fff;">
                                                <img src="{{ url('/') }}/images/flags/Alemania.jpg" />
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1" style="border: solid 2px #fff;">
                                                <img src="{{ url('/') }}/images/flags/italia.jpg" />
                                            </div>
                                        </div>
                                     end flags
                                </div>
                                2 file
                                <div class="has-feedback">
                                flags
                                        <div class="col-lg-12" style="display:flex;">

                                            <div class="col-xs-1 col-sm-1 col-md-1" style="border: solid 2px #fff;">
                                                <img src="{{ url('/') }}/images/flags/espana.jpg" />
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1" style="border: solid 2px #fff;">
                                                <img src="{{ url('/') }}/images/flags/brasil.jpg" />
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1" style="border: solid 2px #fff;">
                                                <img src="{{ url('/') }}/images/flags/japon.jpg" />
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1" style="border: solid 2px #fff;">
                                                <img src="{{ url('/') }}/images/flags/india.jpg" />
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1" style="border: solid 2px #fff;">
                                                <img src="{{ url('/') }}/images/flags/mexico.jpg" />
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1" style="border: solid 2px #fff;">
                                                <img src="{{ url('/') }}/images/flags/china.jpg" />
                                            </div>
                                        </div>
                                     end flags
                                </div>
                        </div> -->
                      <div class="col-sm-12" style="display: flex;justify-content: center; ">
                        <h6 style="font-weight: 600;font-size: 21px;margin-bottom: 0px;"> </h6>
                      </div>
                      <div class="col-sm-12" style="display: flex;justify-content: center; ">
                        <h6 style="font-weight: 600;font-size: 21px;margin-bottom: 0px;"> </h6>
                      </div>
                    </div>
                    </div> <!-- /.cell -->
                </div> <!-- /.grid -->
            </div> <!-- /.grid-container -->
       </footer>
    @endif
       <footer class="top-footer">
            <div class="grid-container">
                <div class="grid-x">

                    <div class="cell medium-4 text-center medium-text-left" style="max-width: 20%;">
                     <!-- /.cell  <img  src="{{ url('/') }}/images/Logos/logo-inferior.jpg" alt="{{ setting('site.title') }}" title="{{ setting('site.title') }}" /> -->
                    </div> <!-- /.cell -->

                    <div class="vertical-space show-for-small-only"></div>

                    <div class="cell medium-6 medium-offset-2 text-center medium-text-right">
                         
                    </div> <!-- /.cell -->
                </div> <!-- /.grid -->
            </div> <!-- /.grid-container -->

        </footer>

        <p style="padding-top: 14px; margin-bottom: 0px;color:#9eb324;" class="copyright text-center">&copy; {{ setting('site.title') }} @php echo date('Y'); @endphp. Todos los derechos reservados.</p>





    </div> <!-- /.off-canvas-content -->

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="{{ url('/') }}/js/app.js"></script>
</body>
</html>
