

<!-- Masthead-->
<div class="container-fluid" style="width:1200px">
<header class="masthead bg-primary text-white text-center ">
                <!-- Masthead Avatar Image-->
                <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="" />
                <!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase mb-0">Start Bootstrap</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">Graphic Artist - Web Designer - Illustrator</p>
            </div>
        </header>

        </div>

<div class="container">

      <!-- Portfolio Section Heading -->
      <h3 class="page-section-heading text-center text-uppercase text-secondary mb-0">liste des articles</h3>

      <!-- Icon Divider -->
      <div class="divider-custom">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon">
          <i class="fas fa-star"></i>
        </div>
        <div class="divider-custom-line"></div>
      </div>

      <!-- Portfolio Grid Items -->
      <div class="row">


     
<?php
foreach ($allBlogPost as $post) :

foreach ($post as $p) :
?>

 <!-- Portfolio Item 1 -->
 <div class="col-md-6 col-lg-4 ">
          <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal1">
            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
              <div class="portfolio-item-caption-content text-center text-white">
                
              </div>
            </div>
            <div class = "img-thumbnail " style="padding: 50px">
              <a href='<?php  gethostname()?> /blogid/id/<?= $p->Getid() ?>'  >
               <img class="img-fluid" src="./assets/images/rocher.jpg" alt="rocher" width="300px;">
              </a>
               <h6> <?= $p->getTitre() ?></h6>
            <h6> <?= $p->getAuteur() ?></h6>
         

            
 
            


            </div>


          </div>
        </div>

    <h1>      
    

    </h1>
<?php endforeach ?>

<?php endforeach ?>

</div>

<!-- About Section-->
<section class="page-section bg-primary text-white mb-0 d-flex justify-content-center"  id="about" style="width:1000px">

            <div class="container ">
                
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white">Contactez moi !</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row">
                    <div class="col-lg-4 ml-auto"><p class="lead">Djory Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional SASS stylesheets for easy customization.</p></div>
                    <div class="col-lg-4 mr-auto"><p class="lead">You can create your own custom avatar for the masthead, change the icon in the dividers, and add your email address to the contact form to make it fully functional!</p></div>
                </div>
                <!-- About Section Button-->
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-outline-light" href="https://startbootstrap.com/themes/freelancer/"><i class="fas fa-download mr-2"></i>Free Download!</a>
                </div>
            </div>
        </section>



          <!-- Contact Section Form-->
          <section>
          <div class="row">
                    <div class=" container col-lg-8 mx-auto">
                      <h2 class=class="page-section-heading text-center text-uppercase text-secondary mb-0"></h2>
                      
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                        <form id="contactForm" name="sentMessage" novalidate="novalidate">
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Name</label><input class="form-control" id="name" type="text" placeholder="Name" required="required" data-validation-required-message="Please enter your name." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Email Address</label><input class="form-control" id="email" type="email" placeholder="Email Address" required="required" data-validation-required-message="Please enter your email address." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Phone Number</label><input class="form-control" id="phone" type="tel" placeholder="Phone Number" required="required" data-validation-required-message="Please enter your phone number." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Message</label><textarea class="form-control" id="message" rows="5" placeholder="Message" required="required" data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br />
                            <div id="success"></div>
                            <div class="form-group"><button class="btn btn-primary btn-xl" id="sendMessageButton" type="submit">Send</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>



