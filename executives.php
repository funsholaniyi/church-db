<?php require_once __DIR__ . '/partials/header.php' ?>
<?php require_once __DIR__ . '/partials/aside.php' ?>
<?php
require_once __DIR__ . '/app/model/class.executive.php';
$executive = new Executive();


if (!empty($_GET) && $_GET['mode'] == 'delete' && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $executive->delete_member($id);
}

$groups = $executive->get_executive_groups();
$members = $member->get_all_members();

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

                            <h1>Executive</h1>
                        </div>


                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="main-box">
                        <header class="main-box-header clearfix">
                            <h2 class="pull-left">Add New Executive Member</h2>
                        </header>

                        <div class="main-box-body clearfix">
                            <div class="row">
                                <form action="app/controller/executives.php" method="post">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="session">Session</label>
                                            <select class="form-control" name="session" id="session">
                                                <?php
                                                for($i=(date('Y', time()));$i>=1980;$i--){
                                                    ?><option><?=$i-1?>/<?=$i?></option><?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group form-group-select2">
                                            <label>Member Name</label>
                                            <select style="width:100%" name="member_id" id="sel2">
                                                <?php

                                                if (!empty($members)) {
                                                    foreach ($members as $member) {
                                                        ?>
                                                        <option value="<?= $member['id'] ?>"><?= $member['salutation'] . ' ' . $member['surname'] . ' ' . $member['middlename'] . ' ' . $member['firstname'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="post">Post</label>
                                            <select class="form-control" name="post" id="post">
                                                <option value="">--Select Post--</option>
                                                <option>Coordinator</option>
                                                <option>Assistant Chairman</option>
                                                <option>General Secretary</option>
                                                <option>Sisters' Coordinator</option>
                                                <option>Assistant General Secretary</option>
                                                <option>Bible Study Secretary</option>
                                                <option>Assistant Bible Study Secretary</option>
                                                <option>Evangelism Secretary</option>
                                                <option>Prayer Secretary</option>
                                                <option>Choir Secretary</option>
                                                <option>Assistant Choir Secretary</option>
                                                <option>Drama Secretary</option>
                                                <option>Welfare Secretary</option>
                                                <option>Academic Secretary</option>
                                                <option>Assistant Academic Secretary</option>
                                                <option>Transport Secretary</option>
                                                <option>Publicity Secretary</option>
                                                <option>Mozambique Hall Rep</option>
                                                <option>Angola Hall Rep</option>
                                                <option>Fajuyi Hall Rep</option>
                                                <option>Awolowo Hall Rep</option>
                                                <option>ETF Hall Rep</option>
                                                <option>Akintola Hall Rep</option>
                                                <option>Alumni Hall Rep</option>
                                                <option>Moremi Hall Rep</option>
                                                <option>FYB Chairman</option>
                                                <option>Financial Secretary</option>
                                                <option>Treasurer</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="clearfix"></div>
                                    <button class="btn btn-primary pull-right" type="submit" name="member">Create</button>
                                </form>
                            </div>
                            <div class="row">
                                <?php
                                foreach ($groups as $group){
                                    $session = $group['session'];
                                    ?>
                                    <header class="main-box-header clearfix">
                                        <h2 class="pull-left"><?=$session?> Session</h2>
                                    </header>

                                    <div class="table-responsive">
                                        <table class="table member-list table-hover">
                                            <thead>
                                            <tr>
                                                <th><span>ID</span></th>
                                                <th><span>Full Name</span></th>
                                                <th><span>Post</span></th>
                                                <th><span>Actions</span></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $members = $executive->get_executive_group_member($session);
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
                                                            <span><?= $member['salutation'] . ' ' . $member['surname'] . ' ' . $member['middlename'] . ' ' . $member['firstname'] ?></span>
                                                        </td>
                                                        <td><span><?= $member['post'] ?></span></td>

                                                        <td style="width: 15%">
                                                            <a href="member.php?id=<?= $member['member_id'] ?>" class="table-link"><span class="fa-stack"><i
                                                                            class="fa fa-square fa-stack-2x"></i><i
                                                                            class="fa fa-eye fa-stack-1x fa-inverse"></i></span></a>
                                                            <a href="executives.php?mode=delete&id=<?= $member['id'] ?>"
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
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <script>
                $(function($) {
                    //nice select boxes
                    $('#sel2').select2();
                });
            </script>
            <?php require_once __DIR__ . '/partials/footer.php' ?>
