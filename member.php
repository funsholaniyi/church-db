<?php require_once __DIR__ . '/partials/header.php' ?>
<?php require_once __DIR__ . '/partials/aside.php' ?>
<?php

if (!empty($_GET) && is_numeric($_GET['id'])) {

    $id = $_GET['id'];
    $member = $member->get_a_member($id);

    require_once __DIR__ . '/app/model/class.council.php';
    $council = new Council();

    require_once __DIR__ . '/app/model/class.executive.php';
    $executive = new Executive();

    require_once __DIR__ . '/app/model/class.committee.php';
    $committee = new Committee();

    $councils = $council->get_member_council_portfolio($id);
    $executives = $executive->get_member_executive_portfolio($id);
    $committees = $committee->get_member_committee_portfolio($id);

}
?>
<style>
    h4{
        font-weight: 700;
    }
</style>
<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active"><span>Members</span></li>
                    </ol>

                    <div class="clearfix">
                        <h1 class="pull-left"></h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box no-header clearfix">
                        <div class="main-box-body clearfix">
                            <div class="jumbotron">
                                <h1><?= $member['salutation'] . ' ' . $member['surname'] . ' ' . $member['firstname'] . ' ' . $member['middlename'] ?></h1>
                                <p class="lead">
                                    <small>
                                        Committee Position(s):
                                        <?php
                                        if(!empty($committees)){
                                            foreach ($committees as $committee){
                                                echo $committee['post'].' '.$committee['committee_name'].' ('.$committee['session'].'), ';
                                            }
                                        }
                                        ?>
                                    </small><br>
                                    <small>
                                        Executive Position(s):
                                        <?php
                                        if(!empty($executives)){
                                            foreach ($executives as $executive){
                                                echo $executive['post'].' ('.$executive['session'].'), ';
                                            }
                                        }
                                        ?>
                                    </small><br>
                                    <small>
                                        Council Position(s):
                                        <?php
                                        if(!empty($councils)){
                                            foreach ($councils as $council){
                                                echo $council['post'].' ('.$council['session'].'), ';
                                            }
                                        }
                                        ?>
                                    </small>
                                </p>

                            </div>

                            <div class="row marketing">
                                <div class="col-lg-4">

                                    <h4>Nickname</h4>
                                    <p><?= $member['nickname'] ?></p>


                                    <h4>Biography</h4>
                                    <p><?= $member['biography'] ?></p>

                                    <h4>Sub Group</h4>
                                    <p><?= str_replace('"','',str_replace(']','',str_replace('[','',$member['subgroup']))) ?></p>

                                    <h4>State of Residence</h4>
                                    <p><?= $member['state_of_residence'] ?></p>

                                    <h4>State of Origin</h4>
                                    <p><?= $member['state_of_origin'] ?></p>

                                    <h4>Phone Numbers</h4>
                                    <p><?=$member['phone1'].', '.$member['phone2']?></p>

                                    <h4>Email</h4>
                                    <p><?=$member['email']?></p>
                                </div>

                                <div class="col-lg-5">

                                    <h4>Date of Birth</h4>
                                    <p><?=$member['dob']?></p>


                                    <h4>Year of Admission</h4>
                                    <p><?=$member['admission_year']?></p>

                                    <h4>Year of Graduation</h4>
                                    <p><?=$member['graduation_year']?></p>

                                    <h4>Department</h4>
                                    <p><?=$member['department']?></p>
                                    <h4>Home Parish</h4>
                                    <p><?=$member['home_parish']?></p>

                                    <h4>Address</h4>
                                    <p><?=$member['address']?></p>

                                </div>
                                <div class="col-lg-3">
                                   <img class="img-responsive img-rounded" src="assets/uploads/<?=$member['profile_picture']?>">
                                    <div class="clearfix"></div>
                                    <br>
                                    <br>
                                    <br>
                                    <a href="edit_member.php?id=<?=$member['id']?>">
                                        <button type="button" class="btn btn-success">Edit Profile</button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <?php require_once __DIR__ . '/partials/footer.php' ?>
