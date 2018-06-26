<?php add_authorization(); ?>

<head>
  <?php set_title(get_name() . '\'s dashboard'); ?>
  <?php load_default_stylesheets(); ?>
  <?php set_stylesheet('receptionist.css'); ?>
</head>

<div class="row" style="width: 100%;">
  <div class="col-1">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-allot-tab" data-toggle="pill" href="#v-pills-allot" role="tab" aria-controls="v-pills-allot" aria-selected="false">
        <i class="fas fa-plus-circle"></i>
      </a>
      <a class="nav-link" id="v-pills-dashboard-tab" data-toggle="pill" href="#v-pills-dashboard" role="tab" aria-controls="v-pills-dashboard" aria-selected="true">
        <i class="fas fa-tachometer-alt"></i>
      </a>
      <a class="nav-link" id="v-pills-admit-tab" data-toggle="pill" href="#v-pills-admit" role="tab" aria-controls="v-pills-admit" aria-selected="false">
        <i class="fas fa-user-plus"></i>
      </a>
      <a class="nav-link" id="v-pills-patients-tab" data-toggle="pill" href="#v-pills-patients" role="tab" aria-controls="v-pills-patients" aria-selected="false">
        <i class="fas fa-user-clock"></i>
      </a>
      <a class="nav-link" id="v-pills-doctors-tab" data-toggle="pill" href="#v-pills-doctors" role="tab" aria-controls="v-pills-doctors" aria-selected="false">
        <i class="fas fa-user-md"></i>
      </a>
      <a class="nav-link" id="v-pills-attendance-tab" data-toggle="pill" href="#v-pills-attendance" role="tab" aria-controls="v-pills-attendance" aria-selected="false">
        <i class="fas fa-list-ul"></i>
      </a>
    </div>
  </div>
  <div class="col-11">
    <?php include_once('common-components/navbar.php'); ?>
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
        <?php include_once('receptionist-components/dashboard.php'); ?>
      </div>
      <div class="tab-pane fade" id="v-pills-admit" role="tabpanel" aria-labelledby="v-pills-admit-tab">
        <?php include_once('receptionist-components/admit.php'); ?>
      </div>
      <div class="tab-pane fade" id="v-pills-patients" role="tabpanel" aria-labelledby="v-pills-patients-tab">
        <?php include_once('receptionist-components/patients.php'); ?>
      </div>
      <div class="tab-pane fade" id="v-pills-doctors" role="tabpanel" aria-labelledby="v-pills-doctors-tab">
        <?php include_once('receptionist-components/doctors.php'); ?>
      </div>
      <div class="tab-pane fade" id="v-pills-attendance" role="tabpanel" aria-labelledby="v-pills-attendance-tab">
        <?php include_once('receptionist-components/attendance.php'); ?>
      </div>
      <div class="tab-pane fade show active" id="v-pills-allot" role="tabpanel" aria-labelledby="v-pills-allot-tab">
        <?php include_once('receptionist-components/allot.php'); ?>
      </div>
    </div>
  </div>
</div>

<footer>
  <?php load_default_scripts(); ?>
  <?php set_script('receptionist.js'); ?>
</footer>
