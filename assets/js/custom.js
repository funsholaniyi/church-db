/**
 * Created by Funsho Olaniyi on 15/06/2016.
 */

$(document).ready(function () {

    $("#error").hide();
    $("#small-menu").hide();
    $("#data-centre").hide();


    $(window).load(function () {
        $('#dvLoading').hide(2000);
    });


    $("#other-menu").click(function () {

        $("#error").hide();


        if ($("#themenu").hasClass('fa-bars')) {

            $("#small-menu").fadeIn();
            $("#body-gan-gan").hide();
            $("#data-centre").hide();

            $("#themenu").removeClass('fa-bars');
            $("#themenu").addClass('fa-times');
            $("#other-menu").addClass('red-bg');


        } else {

            $("#small-menu").hide();
            $("#data-centre").hide();
            $("#body-gan-gan").fadeIn();

            $("#themenu").removeClass('fa-times');
            $("#other-menu").removeClass('red-bg');
            $("#themenu").addClass('fa-bars');

        }
    });


    $(".dashboard").click(function () {
        $("#error").hide();


        $("#other-menu").removeClass('red-bg');
        $("#themenu").removeClass('fa-times');
        $("#themenu").addClass('fa-bars');

        $("#small-menu").hide();
        $("#body-gan-gan").fadeIn();
        $("#data-centre").hide();
    });

    $(".first").click(function () {
        $('#dvLoading').show();

        $("#other-menu").removeClass('red-bg');
        $("#themenu").removeClass('fa-times');
        $("#themenu").addClass('fa-bars');
        $("#data-centre").hide();


        $("#small-menu").hide();
        $("#body-gan-gan").hide();
        $("#content").load("../pages/first.php", function (responseTxt, statusTxt, xhr) {
            $('#dvLoading').hide(2000);

            if (xhr.status != 200) {
                //$("#datacentre").load('error/all.html');
                $("#error").fadeIn();
            } else {
                $("#data-centre").fadeIn();

                $("#error").hide();
            }

        });
    });

    $(".tablepage").click(function () {
        $('#dvLoading').show();

        $("#other-menu").removeClass('red-bg');
        $("#themenu").removeClass('fa-times');
        $("#themenu").addClass('fa-bars');
        $("#data-centre").hide();


        $("#small-menu").hide();
        $("#body-gan-gan").hide();
        $("#content").load("../pages/table.php", function (responseTxt, statusTxt, xhr) {
            $('#dvLoading').hide(2000);

            if (xhr.status != 200) {
                //$("#datacentre").load('error/all.html');
                $("#error").fadeIn();
            } else {
                $("#data-centre").fadeIn();

                $("#error").hide();
            }

        });
    });
});