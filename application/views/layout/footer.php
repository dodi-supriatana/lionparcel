<!-- <div class="page-footer">
   <div class="row">
      <div class="col-xs-12 col-sm-6">
         <span class="txt-color-white">SmartAdmin 1.9.X <span class="hidden-xs"> - Web Application Framework</span> © 2017-2019</span>
      </div>
      <div class="col-xs-6 col-sm-6 text-right hidden-xs">
         <div class="txt-color-white inline-block">
            <i class="txt-color-blueLight hidden-mobile">Last account activity <i class="fa fa-clock-o"></i> <strong>52 mins ago &nbsp;</strong> </i>
            <div class="btn-group dropup">
               <button class="btn btn-xs dropdown-toggle bg-color-blue txt-color-white" data-toggle="dropdown">
               <i class="fa fa-link"></i> <span class="caret"></span>
               </button>
               <ul class="dropdown-menu pull-right text-left">
                  <li>
                     <div class="padding-5">
                        <p class="txt-color-darken font-sm no-margin">Download Progress</p>
                        <div class="progress progress-micro no-margin">
                           <div class="progress-bar progress-bar-success" style="width: 50%;"></div>
                        </div>
                     </div>
                  </li>
                  <li class="divider"></li>
                  <li>
                     <div class="padding-5">
                        <p class="txt-color-darken font-sm no-margin">Server Load</p>
                        <div class="progress progress-micro no-margin">
                           <div class="progress-bar progress-bar-success" style="width: 20%;"></div>
                        </div>
                     </div>
                  </li>
                  <li class="divider"></li>
                  <li>
                     <div class="padding-5">
                        <p class="txt-color-darken font-sm no-margin">Memory Load <span class="text-danger">*critical*</span></p>
                        <div class="progress progress-micro no-margin">
                           <div class="progress-bar progress-bar-danger" style="width: 70%;"></div>
                        </div>
                     </div>
                  </li>
                  <li class="divider"></li>
                  <li>
                     <div class="padding-5">
                        <button class="btn btn-block btn-default">refresh</button>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div> -->
<div id="shortcut">
   <ul>
      <li>
         <a href="inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Preventive <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
      </li>
      <li>
         <a href="calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Corective</span> </span> </a>
      </li>
      <li>
         <a href="gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Event</span> </span> </a>
      </li>
      <li>
         <a href="invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Development <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
      </li>
      <li>
         <a href="gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Performance </span> </span> </a>
      </li>
      <li>
         <a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
      </li>
   </ul>
</div>
<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?php echo base_url('assets/js/plugin/pace/pace.min.js') ?>"></script>
<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
   if (!window.jQuery) {
       document.write('<script src="<?php echo base_url('assets/js/libs/jquery-3.2.1.min.js') ?>"><\/script>');
   }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
   if (!window.jQuery.ui) {
       document.write('<script src="<?php echo base_url('assets/js/libs/jquery-ui.min.js')?>"><\/script>');
   }
</script>
<!-- IMPORTANT: APP CONFIG -->
<script src="<?php echo base_url('assets/js/app.config.js')?>"></script>
<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="<?php echo base_url('assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js')?>"></script> 
<!-- BOOTSTRAP JS -->
<script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js')?>"></script>
<!-- CUSTOM NOTIFICATION -->
<script src="<?php echo base_url('assets/js/notification/SmartNotification.min.js')?>"></script>
<!-- JARVIS WIDGETS -->
<script src="<?php echo base_url('assets/js/smartwidgets/jarvis.widget.min.js')?>"></script>
<!-- EASY PIE CHARTS -->
<script src="<?php echo base_url('assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js')?>"></script>
<!-- SPARKLINES -->
<script src="<?php echo base_url('assets/js/plugin/sparkline/jquery.sparkline.min.js')?>"></script>
<!-- JQUERY VALIDATE -->
<script src="<?php echo base_url('assets/js/plugin/jquery-validate/jquery.validate.min.js')?>"></script>
<!-- JQUERY MASKED INPUT -->
<script src="<?php echo base_url('assets/js/plugin/masked-input/jquery.maskedinput.min.js')?>"></script>
<!-- JQUERY SELECT2 INPUT -->
<script src="<?php echo base_url('assets/js/plugin/select2/select2.min.js')?>"></script>
<!-- JQUERY UI + Bootstrap Slider -->
<script src="<?php echo base_url('assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js')?>"></script>
<!-- browser msie issue fix -->
<script src="<?php echo base_url('assets/js/plugin/msie-fix/jquery.mb.browser.min.js')?>"></script>
<!-- FastClick: For mobile devices -->
<script src="<?php echo base_url('assets/js/plugin/fastclick/fastclick.min.js')?>"></script>
<!--[if IE 8]>
<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
<![endif]-->
<!-- Demo purpose only -->
<!-- <script src="<?php echo base_url('assets/js/demo.min.js')?>"></script> -->
<!-- MAIN APP JS FILE -->
<script src="<?php echo base_url('assets/js/app.min.js')?>"></script>
<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
<script src="<?php echo base_url('assets/js/speech/voicecommand.min.js')?>"></script>
<!-- SmartChat UI : plugin -->
<script src="<?php echo base_url('assets/js/smart-chat-ui/smart.chat.ui.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/smart-chat-ui/smart.chat.manager.min.js')?>"></script>
<!-- PAGE RELATED PLUGIN(S) 
   <script src="..."></script>-->
    <?php 
      if (isset($script)) { 
        $this->load->view($script_url); 
      } 
    ?>

<!-- Tampilan Jam -->
<script>
  function renderTime(){
       var currentTime = new Date();
       var h = currentTime.getHours();
       var m = currentTime.getMinutes();
       var s = currentTime.getSeconds();
       if (h == 0){
        h = 24;
         }
         if (h < 10){
          h = "0" + h;
          }
       
          if (m < 10){
          m = "0" + m;
          }
          if (s < 10){
          s = "0" + s;
          }
       var myClock = document.getElementById('clockDisplay');
       myClock.textContent = h + ":" + m + ":" + s + "";    
       setTimeout ('renderTime()',1000);
       }
       renderTime();
</script>
<!-- Your GOOGLE ANALYTICS CODE Below -->
<!-- <script>
   var _gaq = _gaq || [];
       _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
       _gaq.push(['_trackPageview']);
   
   (function() {
       var ga = document.createElement('script');
       ga.type = 'text/javascript';
       ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0];
       s.parentNode.insertBefore(ga, s);
   })();
   
</script> -->


</body>
</html>