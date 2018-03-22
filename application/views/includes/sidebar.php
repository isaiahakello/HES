<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->

    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
   
        <ul class="page-sidebar-menu   " data-keep-expanded="true" data-auto-scroll="true" data-slide-speed="200">
            <li class="<?php if ($this->uri->segment(1) == "auth") 
   {
    echo "nav-item start active open";
} ?> ">
                <a href="<?php echo $base_url; ?>auth" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>

            </li>
<?php if ($this->ion_auth->in_group('admin')) { ?>
                <li class="heading">
                    <h3 class="uppercase">System Setup</h3>
                </li>
                <li class="nav-item  ">
                    <a href="<?php echo $base_url ?>sdp" class="nav-link ">
                        <i class="icon-globe"></i>
                        <span class="title">SDP Manager</span>
                    </a>
                </li>

                <li class="nav-item  ">
                    <a href="<?php echo $base_url ?>cbo" class="nav-link ">
                        <i class="icon-umbrella"></i>
                        <span class="title">CBO Manager</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?php echo $base_url ?>chv" class="nav-link ">
                        <i class="icon-user-female"></i>
                        <span class="title">CHV Manager</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?php echo $base_url ?>caregivers" class="nav-link ">
                        <i class="icon-symbol-female"></i>
                        <span class="title">Caregiver Manager</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?php echo $base_url ?>ovc" class="nav-link ">
                        <i class="icon-user-following"></i>
                        <span class="title">OVC Manager</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?php echo $base_url ?>auth_admin/settings" class="nav-link ">
                        <i class="icon-settings"></i>
                        <span class="title">General Settings</span>
                    </a>
                </li>


<?php } ?>

            <li class="heading">
                <h3 class="uppercase">H V A</h3>
            </li>

            <li class="<?php if ($this->uri->segment(1) == "hva") {
    echo "nav-item active";
} ?>  ">
                <a href="<?php echo $base_url ?>hva" class="nav-link nav-toggle">
                    <i class="icon-feed"></i>
                    <span class="title">CBO Characteristics</span>

                </a>

            </li>
            <li class="<?php if ($this->uri->segment(2) == "household_classification") {
    echo "nav-item active";
} ?>  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Household Classification</span>

                </a>

            </li>

            <li class="heading">
                <h3 class="uppercase">Household Interventions</h3>
            </li>
<?php if ($this->ion_auth->in_group('admin')) { ?>
                <li class="nav-item  ">
                    <a href="<?php echo $base_url ?>interventions/manage_interventions" class="nav-link nav-toggle">
                        <i class="icon-support"></i>
                        <span class="title">Interventions Manager</span >

                    </a>                           
                </li>
<?php } ?>
             <li class="nav-item  ">
                    <a href="<?php echo $base_url ?>interventions/monitoring" class="nav-link nav-toggle">
                        <i class="icon-graph"></i>
                        <span class="title">Monitoring & Evaluation</span >

                    </a>                           
                </li>    
            <li class="heading">
                <h3 class="uppercase">Graduation</h3>
            </li>
            <li class="nav-item  ">
                <a href="<?php echo $base_url ?>gri/index" class="nav-link nav-toggle">
                    <i class="icon-graduation"></i>
                    <span class="title">GRI Tool</span >

                </a>

            </li>
            <li class="nav-item  ">
                <a href="<?php echo $base_url ?>gri/results" class="nav-link nav-toggle">
                    <i class="icon-eye"></i>
                    <span class="title">GRI Results View</span >

                </a>

            </li>

            <li class="heading">
                <h3 class="uppercase">Reports And Analytics</h3>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-pie-chart"></i>
                    <span class="title">Analytics</span >

                </a>
            <li class="nav-item ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-docs"></i>
                    <span class="title">Standard Reports</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php if ($this->uri->segment(3) == "household_classification") {
    echo "nav-item active";
} ?>  ">
                        <a href="<?php echo $base_url;?>reports_engine/household_classfication" class="nav-link ">
                            <i class="icon-arrow-right"></i>
                            <span class="title">Household Classification</span>
                        </a>
                    </li>
                              <li class="<?php if ($this->uri->segment(3) == "household_interventions") {
    echo "nav-item active";
} ?>  ">
                        <a href="<?php echo $base_url;?>reports_engine/household_interventions" class="nav-link ">
                            <i class="icon-arrow-right"></i>
                            <span class="title">Household Interventions</span>
                        </a>
                    </li>
       <li class="<?php if ($this->uri->segment(4) == "household_graduation") {
    echo "nav-item active";
} ?>  ">
                        <a href="<?php echo $base_url;?>reports_engine/household_graduation" class="nav-link ">
                            <i class="icon-arrow-right"></i>
                            <span class="title">Graduation Results</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-doc"></i>
                    <span class="title">Custom Reports</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php if ($this->uri->segment(3) == "household_ranking") {
    echo "nav-item active";
} ?>  ">
                        <a href="<?php echo $base_url;?>reports_engine/household_ranking" class="nav-link ">
                            <i class="icon-arrow-right"></i>
                            <span class="title">Household Classification</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link ">
                            <i class="icon-arrow-right"></i>
                            <span class="title">Household Interventions</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link ">
                            <i class="icon-arrow-right"></i>
                            <span class="title">Report 3</span>
                        </a>
                    </li>
                </ul>
            </li>
            </li>
<?php if ($this->ion_auth->in_group('admin')) { ?>
                <li class="heading">
                    <h3 class="uppercase">User Management</h3>
                </li>
                <li class="nav-item  ">
                    <a href="<?php echo $base_url ?>auth_admin/user_accounts" class="nav-link nav-toggle">
                        <i class="icon-user"></i>
                        <span class="title">User Accounts</span >

                    </a>

                </li>
                <li class="nav-item  ">
                    <a href="<?php echo $base_url ?>auth_admin/user_groups" class="nav-link nav-toggle">
                        <i class="icon-users"></i>
                        <span class="title">User Groups</span >

                    </a>

                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-key"></i>
                        <span class="title">Priviliges</span >

                    </a>

                </li>
<?php } ?>
            <li class="heading">
                <h3 class="uppercase">My Account</h3>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-pencil"></i>
                    <span class="title">Edit Profile</span >

                </a>

            </li>
            <li class="nav-item ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-support"></i>
                    <span class="title">Support</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="support/faq" class="nav-link ">
                            <i class="icon-info-sign"></i>
                            <span class="title">FAQ's</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link ">
                            <i class="icon-question-sign"></i>
                            <span class="title">Raise Tickets</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link ">
                            <i class="icon-comment"></i>
                            <span class="title">Live Chat</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-download-alt"></i>
                    <span class="title">Downloads</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link ">
                            <i class="icon-form"></i>
                            <span class="title">HVA FORM</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link ">
                            <i class="icon-form"></i>
                            <span class="title">GRI FORM</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link ">
                            <i class="icon-form"></i>
                            <span class="title">4C FORM</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="<?php echo $base_url; ?>auth/logout" class="nav-link nav-toggle">
                    <i class="icon-logout"></i>
                    <span class="title">Logout</span >

                </a>

            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>