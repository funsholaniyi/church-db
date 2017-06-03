<?php require_once __DIR__ . '/partials/header.php' ?>
<?php require_once __DIR__ . '/partials/aside.php' ?>
<?php

if (!empty($_GET) && $_GET['mode'] == 'delete' && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $member->delete_member($id);
}

$members = $member->get_all_members();
?>
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
                        <h1 class="pull-left">Members</h1>

                        <div class="pull-right top-page-ui">
                            <form class="form-inline" method="get" action="search.php">
                                <div class="form-group">
                                    <input type="search" class="form-control" id="search" placeholder="Search..."
                                           name="word">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="field" name="field">
                                        <option value="">-- General Search --</option>
                                        <option value="firstname">First Name</option>
                                        <option value="middlename">Middle Name</option>
                                        <option value="surname">Surname</option>
                                        <option value="nickname">Nick Name</option>
                                        <option value="department">Department</option>
                                        <option value="phone1">Phone1</option>
                                        <option value="phone2">Phone2</option>
                                        <option value="email">Email</option>
                                        <option value="state_of_origin">State Of Origin</option>
                                        <option value="state_of_residence">State Of Residence</option>
                                        <option value="address">Address</option>
                                        <option value="home_parish">Home Parish</option>
                                        <option value="dob">Date Of Birth</option>
                                        <option value="subgroup">Subgroup</option>
                                        <option value="admission_year">Admission Year</option>
                                        <option value="graduation_year">Graduation Year</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box no-header clearfix">
                        <div class="main-box-body clearfix">
                            <div class="table-responsive">
                                <table class="table member-list table-hover">
                                    <thead>
                                    <tr>
                                        <th><span>ID</span></th>
                                        <th><span>Full Name</span></th>
                                        <th><span>Created</span></th>
                                        <th class="text-center"><span>Sub Group(s)</span></th>
                                        <th><span>Email</span></th>
                                        <th><span>Phone1</span></th>
                                        <th><span>Department</span></th>
                                        <th><span>State of Residence</span></th>
                                        <th><span>Actions</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (!empty($members)) {
                                        $i = 0;
                                        $phones = [];
                                        foreach ($members as $member) {
                                            $i++;
                                            $phones[] = $member['phone1'];
                                            ?>
                                            <tr>
                                                <td><span><?= $i ?></span></td>
                                                <td>
                                                    <span><?= $member['salutation'] . ' ' . $member['surname'] . ' ' . $member['firstname'] . ' ' . $member['middlename'] ?></span>
                                                </td>
                                                <td><span><?= $member['date_added'] ?></span></td>
                                                <td><span><?= str_replace('"','',str_replace(']','',str_replace('[','',$member['subgroup']))) ?></span></td>
                                                <td><span><?= $member['email'] ?></span></td>
                                                <td><span><?= $member['phone1'] ?></span></td>
                                                <td><span><?= $member['department'] ?></span></td>
                                                <td><span><?= $member['state_of_residence'] ?></span></td>

                                                <td style="width: 15%">
                                                    <a href="member.php?id=<?= $member['id'] ?>" class="table-link"><span class="fa-stack"><i
                                                                    class="fa fa-square fa-stack-2x"></i><i
                                                                    class="fa fa-eye fa-stack-1x fa-inverse"></i></span></a>

                                                    <a href="edit_member.php?id=<?= $member['id'] ?>"
                                                       onclick="return confirm('Are you sure, you want to edit member ?')"
                                                       class="table-link"><span class="fa-stack"><i
                                                                    class="fa fa-square fa-stack-2x"></i><i
                                                                    class="fa fa-pencil fa-stack-1x fa-inverse"></i></span></a>
                                                    <a href="members.php?mode=delete&id=<?= $member['id'] ?>"
                                                       onclick="return confirm('Are you sure, you want to delete member ?')"
                                                       class="table-link danger"><span class="fa-stack"><i
                                                                    class="fa fa-square fa-stack-2x"></i><i
                                                                    class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>
                                                </td>

                                            </tr>
                                            <?php
                                        }@unlink('phones.txt');
                                        $fh = fopen('phones.txt', 'a');
                                        if (!empty($phones)) {
                                            foreach ($phones as $phone) {
                                                $phone = str_replace('-', '', $phone);
                                                $phone = str_replace('+', '', $phone);
                                                $phone = str_replace(' ', '', $phone);


                                                fwrite($fh, $phone . "\r");
                                            }
                                        }
                                        fclose($fh);
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <?php
                                if(!empty($members)){
                                    ?>
                                    <a href="phones.txt">
                                        <button class="btn btn-success pull-right">Download Phone Numbers</button>
                                    </a>
                                    <?php
                                }
                                ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <?php require_once __DIR__ . '/partials/footer.php' ?>
