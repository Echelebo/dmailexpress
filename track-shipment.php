<?php include_once "menu.php"; ?>
      <!-- Start #page-title-->
      <section class="page-title bg-overlay bg-overlay-dark bg-parallax" id="page-title">
        <div class="bg-section"><img src="assets/images/page-titles/7.jpg" alt="Background"/></div>
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="title text-lg-left">
                <div class="title-heading">
                  <h1>track &amp; trace</h1>
                </div>
                <div class="clearfix"></div>
                <ol class="breadcrumb justify-content-lg-start">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Track And Trace</li>
                </ol>
              </div>
              <!-- End .title -->
            </div>
            <!-- End .col-lg-8 -->
          </div>
          <!-- End .row-->
        </div>
        <!-- End .container-->
      </section>
      <!-- End #page-title-->
      <!--
      ============================
      Track Shimpent Section
      ============================
      -->
      <section class="track-shipment request-quote contact-card" id="track-shipment">
        <div class="container">
          <div class="row">
            <!-- Start .col-lg-4-->
            <div class="col-sm-12 col-md-12 col-lg-4 order-2 order-lg-0">
              <div class="sidebar sidebar-case-study">
                <!-- Start .widget-categories-->
                <div class="widget widget-categories">
                  <div class="widget-title">
                    <h5>transport services</h5>
                  </div>
                  <div class="widget-content">
                    <ul class="list-unstyled">
                      <li><a href="javascript:void(0)">warehouse</a></li>
                      <li><a href="javascript:void(0)">air freight</a></li>
                      <li><a href="javascript:void(0)">ocean freight</a></li>
                      <li><a href="javascript:void(0)">road freight</a></li>
                      <li><a href="javascript:void(0)">supply chain</a></li>
                      <li><a href="javascript:void(0)">packaging</a></li>
                    </ul>
                  </div>
                </div>
                <!-- End .widget-categories -->
              </div>
            </div>
            <div class="col-12 col-lg-8">
              <div class="track-form quote-form contact-body trackFormActive">
                <div class="form-status">
                  <p>Need dependable, cost effective transportation of your commodities? Fill out our easy Quote Request Form below to get a fast quote on your job.</p>
                </div>
                <form class="contactForm" method="post" action="https://demo.zytheme.com/equita/assets/php/contact.php">
                  <div class="form-section">
                    <h5 class="card-heading">personal data</h5>
                    <div class="row">
                      <div class="col-12">
                        <div class="select-container">
                          <select class="form-control">
                            <option value="default">shipment type</option>
                            <option value="AL">type 1</option>
                            <option value="AK">type 2</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <h5 class="card-heading">tracking number</h5>
                    <div class="row">
                      <div class="col-12">
                        <textarea class="form-control" name="contact-tracking-number" cols="30" rows="2" placeholder="You can enter up to a maximum of 10 airway bill numbers for tracking." required=""></textarea>
                      </div>
                      <div class="col-12">
                        <div class="custom-radio-group">
                          <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" id="customRadioInline1" name="customRadioInline1"/>
                            <label for="customRadioInline1">fragile</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" id="customRadioInline2" name="customRadioInline1"/>
                            <label for="customRadioInline2">express delivery</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" id="customRadioInline3" name="customRadioInline1"/>
                            <label for="customRadioInline3">insurance</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" id="customRadioInline4" name="customRadioInline1"/>
                            <label for="customRadioInline4">packaging</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <input class="btn btn--secondary btn--block" type="submit" value="Track &amp; Trace"/>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- End .row-->
        </div>
        <!-- End .container-->
      </section>
      <!--
      ============================
      Footer #1
      ============================
      -->
      <?php include_once "footer.php"; ?>