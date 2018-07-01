<?php add_authorization(); ?>

<head>
  <?php set_title(get_name() . '\'s dashboard'); ?>
  <?php load_default_stylesheets(); ?>
  <?php set_stylesheet('receptionist.css'); ?>
  <?php set_stylesheet('sidebar_style.css'); ?>
  <?php set_stylesheet('w3.css'); ?>
</head>

<div class="row" style="width: 100%;">
  <div class="col-1">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-allot-tab" data-toggle="pill" href="#v-pills-allot" role="tab" aria-controls="v-pills-allot" aria-selected="false">
        <i class="fas fa-plus-circle"></i>
      </a>
      <a class="nav-link" id="v-pills-dashboard-tab" data-toggle="pill" href="#v-pills-dashboard" role="tab" aria-controls="v-pills-dashboard" aria-selected="true">
        <i class="fas fa-bed"></i>
      </a>
      <a class="nav-link" id="v-pills-admit-tab" data-toggle="pill" href="#v-pills-admit" role="tab" aria-controls="v-pills-admit" aria-selected="false">
        <i class="fas fa-users"></i>
      </a>
      <a class="nav-link" id="v-pills-patients-tab" data-toggle="pill" href="#v-pills-patients" role="tab" aria-controls="v-pills-patients" aria-selected="false">
        <i class="fas fa-hospital"></i>
      </a>
    </div>
  </div>
  <div class="col-11">
    <?php include_once('common-components/navbar.php'); ?>
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
        <?php include_once('staff_head-components/bed.php'); ?>
      </div>
      <div class="tab-pane fade" id="v-pills-admit" role="tabpanel" aria-labelledby="v-pills-admit-tab">
        <?php include_once('staff_head-components/nurse.php'); ?>
      </div>
      <div class="tab-pane fade" id="v-pills-patients" role="tabpanel" aria-labelledby="v-pills-patients-tab">
        <?php include_once('staff_head-components/room.php'); ?>
      </div>
      <div class="tab-pane fade" id="v-pills-attendance" role="tabpanel" aria-labelledby="v-pills-attendance-tab">
      </div>
      <div class="tab-pane fade show active" id="v-pills-allot" role="tabpanel" aria-labelledby="v-pills-allot-tab">
        <?php include_once('staff_head-components/allot.php'); ?>
      </div>
    </div>
  </div>
</div>

<footer>
  <?php load_default_scripts(); ?>
</footer>
