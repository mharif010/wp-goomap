
<?php wp_head(); ?>
    <div id="map"></div>
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-lg btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">Find a Project</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                
                <!-- sidebar-header  -->
                <div class="sidebar-search">
                    <div>
                        <div class="input-group">
                            <input type="text" class="form-control search-menu" placeholder="Search...">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sidebar-search  -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>General</span>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-tachometer-alt"></i>
                                <span>Projects</span>
                                <span class="badge badge-pill badge-danger">3</span>
                            </a>
                            <div class="sidebar-submenu">
                                <h5 class="project-title">Global Overview</h5>
                                <ul class="global-overview">
                                    <li>Projects<br><b>124563</b></li>
                                    <li>Com. Amt<br><b>$ 124563</b></li>
                                    <li>Locations<br><b>124563</b></li>
                                    <li>Countries<br><b>123</b></li>
                                </ul>
                                <h5 class="project-title">Project Status</h5>
                                <ul class="global-overview">
                                    <li><input type="checkbox" name="check" value="active"> Active</li>
                                    <li><input type="checkbox" name="check" value="active"> Closed</li>
                                    <li><input type="checkbox" name="check" value="active"> Dropped</li>
                                    <li><input type="checkbox" name="check" value="active"> Pipeline</li>
                                </ul>
                                <ul class="global-overview">
                                    <li><input type="checkbox" name="check" value="active"> Covid-19 Response</li>
                                </ul>
                                <ul>
                                    <h5 class="brb project-title">Regions</h5>
                                    <ul class="nav nav-tabs" role="tablist" style="padding:0px;">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Projects </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Ammount </a>
                                        </li>
                                    </ul><!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                             <a href="#">1. Project Project </a> 
                                             <a href="#">2. Project 1 </a>
                                             <a href="#">3. Project 1 </a>
                                             <a href="#">4. Project 1 </a> 
                                             <a href="#">5. Project 1 </a>
                                             <a href="#">6. Project 1 </a>
                                        </div>
                                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                                            <a href="#">1. Project Amount </a> 
                                             <a href="#">2. Project 1 </a>
                                             <a href="#">3. Project 1 </a>
                                             <a href="#">4. Project 1 </a> 
                                             <a href="#">5. Project 1 </a>
                                             <a href="#">6. Project 1 </a>
                                        </div>
                                    </div>
                                    
                                </ul>
                                <ul>
                                    <h5 class="brb project-title">Sectors</h5>
                                    <ul class="nav nav-tabs" role="tablist" style="padding:0px;">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tabs-3" role="tab">Projects </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Ammount </a>
                                        </li>
                                    </ul><!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tabs-3" role="tabpanel">
                                             <a href="#">1. Project Project </a> 
                                             <a href="#">2. Project 1 </a>
                                             <a href="#">3. Project 1 </a>
                                             <a href="#">4. Project 1 </a> 
                                             <a href="#">5. Project 1 </a>
                                             <a href="#">6. Project 1 </a>
                                        </div>
                                        <div class="tab-pane" id="tabs-4" role="tabpanel">
                                            <a href="#">1. Project Amount </a> 
                                             <a href="#">2. Project 1 </a>
                                             <a href="#">3. Project 1 </a>
                                             <a href="#">4. Project 1 </a> 
                                             <a href="#">5. Project 1 </a>
                                             <a href="#">6. Project 1 </a>
                                        </div>
                                    </div>
                                    
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Locations</span>
                                <span class="badge badge-pill badge-danger">3</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                     <h5 class="brb project-title">Project Locations</h5>
                                    <li>
                                        <a href="#">1. Location </a>
                                    </li>
                                    <li>
                                        <a href="#">2. Location</a>
                                    </li>
                                    <li>
                                        <a href="#">3. Location</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-calendar"></i>
                                <span>Datasets</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-folder"></i>
                                <span>Toolkit</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
        </nav>
    </div>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxHRBU_I-JXkZRv1HLG3uoaEV_Pa_HC14&callback=initMap"
      
    ></script>