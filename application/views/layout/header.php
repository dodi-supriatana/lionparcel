<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title> STP BAST ONLINE </title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- #CSS Links -->
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">
    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-production-plugins.min.css') ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-production.min.css') ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-skins.min.css') ?>">
    <!-- SmartAdmin RTL Support -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-rtl.min.css') ?>">
    <!-- We recommend you use "your_style.css" to override SmartAdmin
         specific styles this will also ensure you retrain your customization with each SmartAdmin update.
         <link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->
    <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/demo.min.css') ?>">
    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/login/spt_logo1.png') ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url('assets/img/login/spt_logo1.png') ?>" type="image/x-icon">
    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
</head>

<body class="desktop-detected pace-done">
    <!-- #HEADER -->
    <header id="header" style="background: Black;">
        <div id="logo-group">
            <!-- PLACE YOUR LOGO HERE -->
            <span id="logo"> <img src="<?php echo base_url('assets/img/login/spt_logo2.png') ?>" style="margin-top: -14px;;height: 46px;" alt="SmartAdmin"> </span>
            <!-- END LOGO PLACEHOLDER -->
            <!-- Note: The activity badge color changes when clicked and resets the number to 0
               Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
            <span id="activity" class="activity-dropdown" style="display:none"> <i class="fa fa-user"></i> <b class="badge"> 21 </b> </span>
            <!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
            <div class="ajax-dropdown">
                <!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio" name="activity" id="<?php echo base_url('assets/ajax/notify/mail.html') ?>">
                        Msgs (14) </label>
                    <label class="btn btn-default">
                        <input type="radio" name="activity" id="<?php echo base_url('assets/ajax/notify/notifications.html') ?>">
                        notify (3) </label>
                    <label class="btn btn-default">
                        <input type="radio" name="activity" id="<?php echo base_url('assets/ajax/notify/tasks.html') ?>">
                        Tasks (4) </label>
                </div>
                <!-- notification content -->
                <div class="ajax-notifications custom-scroll">
                    <div class="alert alert-transparent">
                        <h4>Click a button to show messages here</h4>
                        This blank page message helps protect your privacy, or you can show the first message here automatically.
                    </div>
                    <i class="fa fa-lock fa-4x fa-border"></i>
                </div>
                <!-- end notification content -->
                <!-- footer: refresh area -->
                <span> Last updated on: 12/12/2013 9:43AM
                    <button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
                        <i class="fa fa-refresh"></i>
                    </button> </span>
                <!-- end footer -->
            </div>
            <!-- END AJAX-DROPDOWN -->
        </div>
        <!-- #PROJECTS: projects dropdown -->
        <div class="project-context hidden-xs" style="display:none">
            <span class="label">Projects:</span>
            <span class="project-selector dropdown-toggle" data-toggle="dropdown">Recent projects <i class="fa fa-angle-down"></i></span>
            <!-- Suggestion: populate this list with fetch and push technique -->
            <ul class="dropdown-menu">
                <li>
                    <a href="javascript:void(0);">TESTOnline e-merchant management system - attaching integration with the iOS</a>
                </li>
                <li>
                    <a href="javascript:void(0);">Notes on pipeline upgradee</a>
                </li>
                <li>
                    <a href="javascript:void(0);">Assesment Report for merchant account</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-power-off"></i> Clear</a>
                </li>
            </ul>
            <!-- end dropdown-menu-->
        </div>
        <!-- end projects dropdown -->
        <!-- #TOGGLE LAYOUT BUTTONS -->
        <!-- pulled right: nav area -->
        <div class="pull-right">
            <!-- collapse menu button -->
            <div id="hide-menu" class="btn-header pull-right">
                <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
            </div>
            <!-- end collapse menu -->
            <!-- #MOBILE -->
            <!-- Top menu profile link : this shows only when top menu is active -->
            <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
                <li class="">
                    <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                        <img src="<?php echo base_url('assets/img/avatars/sunny.png') ?>" alt="John Doe" class="online" />
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="login.html" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- logout button -->
            <div id="logout" class="btn-header transparent pull-right">
                <span> <a href="<?php echo base_url('login') ?>" title="Sign Out" data-action="userLogout" data-logout-msg="are you sure want to logout"><i class="fa fa-sign-out"></i></a> </span>
            </div>
            <!-- end logout button -->
            <!-- search mobile button (this is hidden till mobile view port) -->
            <div id="search-mobile" class="btn-header transparent pull-right">
                <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
            </div>
            <!-- end search mobile button -->
            <!-- #SEARCH -->
            <!-- input: search field -->
            <form action="search.html" class="header-search pull-right">
                <input id="search-fld" type="text" name="param" placeholder="Find reports and more">
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>
                <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
            </form>
            <!-- end input: search field -->
            <!-- fullscreen button -->
            <div id="fullscreen" class="btn-header transparent pull-right">
                <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
            </div>
            <!-- end fullscreen button -->
            <!-- #Voice Command: Start Speech -->
            <div id="speech-btn" class="btn-header transparent pull-right hidden-sm hidden-xs">
                <div>
                    <a href="javascript:void(0)" title="Voice Command" data-action="voiceCommand"><i class="fa fa-microphone"></i></a>
                    <div class="popover bottom">
                        <div class="arrow"></div>
                        <div class="popover-content">
                            <h4 class="vc-title">Voice command activated <br><small>Please speak clearly into the mic</small></h4>
                            <h4 class="vc-title-error text-center">
                                <i class="fa fa-microphone-slash"></i> Voice command failed
                                <br><small class="txt-color-red">Must <strong>"Allow"</strong> Microphone</small>
                                <br><small class="txt-color-red">Must have <strong>Internet Connection</strong></small>
                            </h4>
                            <a href="javascript:void(0);" class="btn btn-success" onclick="commands.help()">See Commands</a>
                            <a href="javascript:void(0);" class="btn bg-color-purple txt-color-white" onclick="$('#speech-btn .popover').fadeOut(50);">Close Popup</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end voice command -->
            <!-- multiple lang dropdown : find all flags in the flags page -->
            <ul class="header-dropdown-list hidden-xs" style="display:none">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo base_url('assets/img/blank.gif') ?>" class="flag flag-us" alt="United States"> <span> English (US) </span> <i class="fa fa-angle-down"></i> </a>
                    <ul class="dropdown-menu pull-right">
                        <li class="active">
                            <a href="javascript:void(0);"><img src="<?php echo base_url('assets/img/blank.gif') ?>" class="flag flag-us" alt="United States"> English (US)</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><img src="<?php echo base_url('assets/img/blank.gif') ?>" class="flag flag-fr" alt="France"> Français</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><img src="<?php echo base_url('assets/img/blank.gif') ?>" class="flag flag-es" alt="Spanish"> Español</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><img src="<?php echo base_url('assets/img/blank.gif') ?>" class="flag flag-de" alt="German"> Deutsch</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><img src="<?php echo base_url('assets/img/blank.gif') ?>" class="flag flag-jp" alt="Japan"> 日本語</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><img src="<?php echo base_url('assets/img/blank.gif') ?>" class="flag flag-cn" alt="China"> 中文</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><img src="<?php echo base_url('assets/img/blank.gif') ?>" class="flag flag-it" alt="Italy"> Italiano</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><img src="<?php echo base_url('assets/img/blank.gif') ?>" class="flag flag-pt" alt="Portugal"> Portugal</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><img src="<?php echo base_url('assets/img/blank.gif') ?>" class="flag flag-ru" alt="Russia"> Русский язык</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><img src="<?php echo base_url('assets/img/blank.gif') ?>" class="flag flag-kr" alt="Korea"> 한국어</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- end multiple lang -->
        </div>
        <!-- end pulled right: nav area -->
    </header>
    <!-- END HEADER -->
    <!-- #NAVIGATION -->
    <!-- Left panel : Navigation area -->
    <!-- Note: This width of the aside area can be adjusted through LESS variables -->
    <aside id="left-panel" style="background: #c50202;">
        <!-- User info -->
        <div class="login-info">
            <span>
                <!-- User image size is adjusted inside CSS, it should stay as it -->
                <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                    <?php if ($_SESSION['picture'] == "") { ?>
                        <img src="<?php echo base_url('assets/img/avatars/sunny.png') ?>" alt="me" class="online" />
                    <?php } else { ?>
                        <img src="<?php echo base_url($_SESSION['picture']) ?>" alt="me" class="online" />
                    <?php } ?>
                    <span>
                        <?php echo $_SESSION['username'] ?>
                    </span>
                    <i class="fa fa-angle-down"></i>
                </a>
            </span>
        </div>
        <!-- end user info -->
        <nav>
            <!-- 
                   NOTE: Notice the gaps after each icon usage <i></i>..
                   Please note that these links work a bit different than
                   traditional href="" links. See documentation for details.
                   -->
            <ul>
                <?php foreach ($menu as $list) { ?>
                    <li>
                        <?php if ($list->parent_id == 0) { ?>
                            <a href="<?php echo $list->ctrl_menu ?>"><i class="<?php echo $list->icon ?>"></i> <span class="menu-item-parent"><?php echo $list->permission_name ?></span></a>
                            <?php
                            if ($list->ctrl_menu == '#') {
                                echo "<ul>";
                            }
                        } ?>



                        <?php foreach ($menu as $sub) {
                            if ($list->menu_id == $sub->parent_id) { ?>

                            <li>
                                <a href="<?php echo $sub->ctrl_menu ?>" title="<?php
                                                                                ?>"><i class="<?php echo $sub->icon ?>"></i> <span class="menu-item-parent"><?php echo $sub->permission_name; ?></span></a>
                            </li>

                        <?php
                    }
                } ?>
                    <?php if ($list->ctrl_menu == '#') {
                        echo "</ul>";
                    } ?>
                    </li>
                <?php
            } ?>
            </ul>
        </nav>
        <span class="minifyme" data-action="minifyMenu" style="display:none">
            <i class="fa fa-arrow-circle-left hit"></i>
        </span>
    </aside>
    <!-- END NAVIGATION -->
    <!-- MAIN PANEL -->
    <div id="main" role="main">
        <!-- RIBBON -->
        <div id="ribbon" style="background: white;">
            <span class="ribbon-button-alignment">
                <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This settings will syc your data to SAP." data-html="true">
                    <i class="fa fa-refresh"></i>
                </span>
            </span>
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <!-- <li>Home</li> -->
                <!-- <li>Miscellaneous</li> -->
                <li>
                    <!-- <div id="clockDisplay" style="padding:6px;color:#C09853;font-family:'arial black';font-size:12px;font-weight:bold;letter-spacing:2px;display:inline;"> -->
                    <div style="padding:6px;color:#000000;font-family:'arial black';font-size:12px;font-weight:bold;letter-spacing:2px;display:inline;">PO Last update on <?php echo date("d M Y H:i");; ?> </div>

                </li>
            </ol>

            <!-- end breadcrumb -->
            <!-- You can also add more buttons to the
                ribbon for further usability
            
                Example below:
            
                <span class="ribbon-button-alignment pull-right">
                <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
                <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-`plus`"></i> Add</span>
                <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
                </span> -->
        </div>
        <!-- END RIBBON -->