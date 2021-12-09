<div class="footer-area black-bg-2 pt-70">
    <div class="footer-bottom-area border-top-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-7">
                    <div class="copyright">
                        <p>Copyright © <a href="#">Vayuananda.</a> . All Right Not Reserved.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-5">
                    <div class="footer-social">
                        <ul>
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-rss"></i></a></li>
                            <li><a href="#"><i class="ion-social-dribbble-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- all js here -->
<script src="<?php echo user_login?>assets/js/vendor/jquery-1.12.0.min.js"></script>
<script src="<?php echo user_login?>assets/js/popper.js"></script>
<script src="<?php echo user_login?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo user_login?>assets/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo user_login?>assets/js/isotope.pkgd.min.js"></script>
<script src="<?php echo user_login?>assets/js/ajax-mail.js"></script>
<script src="<?php echo user_login?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo user_login?>assets/js/plugins.js"></script>
<script src="<?php echo user_login?>assets/js/main.js"></script>
<script>
  var user_login="<?php echo user_login?>";
  var load="<?php echo load?>";

</script>
<script src="<?php echo user_login?>assets/js/custom.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">

    $(window).resize(function(e)
    {
        console.log('hello');
        /*var vall=$(document).outerWidth(true)
        if(vall<900)*/
       // console.log($(document).outerWidth(true));
    });
//  console.log("hello");
  var title=location.pathname.split('/');
//console.log(location.pathname);
  var titlename=title[title.length-1];
      titlename=titlename.toUpperCase();
  //console.log(titlename);
  $(".booktitle").html(titlename);



//  console.log(title[title.length-1]);
</script>

</body>

</html>
