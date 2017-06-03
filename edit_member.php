<?php require_once __DIR__ . '/partials/header.php' ?>
<?php require_once __DIR__ . '/partials/aside.php' ?>
<?php
require_once __DIR__ . '/app/library/CSV49.php';
$csv49 = new CSV49();
$states = $csv49->get_states_and_capital_geolocation();
$lgas = $csv49->get_states_lga_and_geolocation();


if (!empty($_GET) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $member = $member->get_a_member($id);
}

?>
<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div id="content-header" class="clearfix">
                        <div class="pull-left">
                            <ol class="breadcrumb">
                                <li><a href="members.php">Home</a></li>
                                <li class="active"><span>Members</span></li>
                            </ol>

                            <h1>Edit Member</h1>
                        </div>


                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="main-box">
                        <header class="main-box-header clearfix">
                            <h2 class="pull-left">Edit Member</h2>
                        </header>

                        <div class="main-box-body clearfix">
                            <div class="row">
                                <form action="app/controller/edit_member.php" method="post"
                                      enctype="multipart/form-data">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="salutation">Salutation</label>
                                            <select class="form-control" name="salutation" id="salutation">
                                                <option><?=$member['salutation']?></option>
                                                <option>Bro.</option>
                                                <option>Sis.</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="firstname">First Name</label>
                                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?=$member['firstname']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="middlename">Middle Name</label>
                                            <input type="text" class="form-control" name="middlename" id="middlename" value="<?=$member['middlename']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="surname">Surname</label>
                                            <input type="text" class="form-control" name="surname" id="surname" value="<?=$member['surname']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nickname">Nickname</label>
                                            <input type="text" class="form-control" name="nickname" id="nickname" value="<?=$member['nickname']?>">
                                        </div>


                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <input type="text" class="form-control" name="department" id="department" value="<?=$member['department']?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone1">Phone Number 1</label>
                                            <input type="tel" class="form-control" name="phone1" id="phone1" value="<?=$member['phone1']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone2">Phone Number 2</label>
                                            <input type="tel" class="form-control" name="phone2" id="phone2" value="<?=$member['phone2']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="<?=$member['email']?>">
                                        </div>

                                        <div class="form-group form-group-select2">
                                            <label>Sub-Group</label>
                                            <select name="subgroup[]" style="width:100%" id="sel2Multi" multiple>
                                                <option>Academic</option>
                                                <option>Bible Study</option>
                                                <option>Choir</option>
                                                <option>Drama</option>
                                                <option>Evangelism</option>
                                                <option>Prayer</option>
                                                <option>Publicity</option>
                                                <option>Service</option>
                                                <option>Transport</option>
                                                <option>Welfare</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group form-group-select2">
                                            <label>State of Origin</label>
                                            <select style="width:100%" name="state_of_origin" id="sel2">
                                                <?php

                                                if (!empty($states)) {
                                                    foreach ($states as $state) {
                                                        ?>
                                                        <option value="<?= $state['state'] ?>"><?= $state['state'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group form-group-select2">
                                            <label>State of Residence</label>
                                            <select style="width:100%" name="state_of_residence" id="sel1">
                                                <?php

                                                if (!empty($states)) {
                                                    foreach ($states as $state) {
                                                        ?>
                                                        <option value="<?= $state['state'] ?>"><?= $state['state'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" name="address" id="address"
                                                      rows="5"><?=$member['address']?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="home_parish">Home Parish</label>
                                            <input type="text" class="form-control" name="home_parish" id="home_parish" value="<?=$member['home_parish']?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" class="form-control" name="dob" id="dob" value="<?=$member['dob']?>">
                                        </div>


                                        <div class="form-group">
                                            <label for="admission_year">Year of Admission</label>
                                            <select class="form-control" name="admission_year" id="admission_year">
                                                <option><?=$member['admission_year']?></option>
                                                <?php
                                                for($i=1980;$i<=2100;$i++){
                                                    ?><option><?=$i?></option><?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="graduation_year">Year of Graduation</label>
                                            <select class="form-control" name="graduation_year" id="graduation_year">
                                                <option><?=$member['graduation_year']?></option>

                                                <?php
                                                for($i=1984;$i<=2100;$i++){
                                                    ?><option><?=$i?></option><?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="biography">Biography</label>
                                            <textarea class="form-control" name="biography" id="biography" rows="4"><?=$member['biography']?></textarea>
                                        </div>
                                        <input type="hidden" name="member_id" value="<?=$id?>">
                                    </div>
                                    <div class="clearfix"></div>
                                    <button class="btn btn-primary pull-right" type="submit" name="member">Update
                                    </button>

                                </form>
                            </div
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(function($) {
                    //nice select boxes
                    $('#sel2').select2();
                    $('#sel1').select2();

                    $('#sel2Multi').select2({
                        placeholder: 'Select Sub Groups',
                        allowClear: true
                    });


                });
            </script>

            <?php require_once __DIR__ . '/partials/footer.php' ?>
