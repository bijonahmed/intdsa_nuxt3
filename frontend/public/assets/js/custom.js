$(document).ready(function () {
    // pass modal part here 
    $(".pass_mdal_open").click(function () {
        $(".pass_mdal").fadeIn();
    })
    $(".bt_close").click(function () {
        $(".pass_mdal").fadeOut();
    })
    // withdrawal pass modal part here 
    $(".wdrl_mdal_open").click(function () {
        $(".wdrl_mdal").fadeIn();
    })
    $(".bt_close").click(function () {
        $(".wdrl_mdal").fadeOut();
    })
    // Phone number modal part here 
    $(".phone_mdal_open").click(function () {
        $(".phone_mdal").fadeIn();
    })
    $(".bt_close").click(function () {
        $(".phone_mdal").fadeOut();
    })
    // e-mail modal part here 
    $(".email_mdal_open").click(function () {
        $(".email_mdal").fadeIn();
    })
    $(".bt_close").click(function () {
        $(".email_mdal").fadeOut();
    })
    // e-mail modal part here 
    $(".id_mdal_open").click(function () {
        $(".id_mdal").fadeIn();
    })
    $(".bt_close").click(function () {
        $(".id_mdal").fadeOut();
    })
    //  cancel_mdal_openl modal part here 
    $(".cancel_mdal_open").click(function () {
        $(".cancel_mdal").fadeIn();
    })
    $(".bt_close").click(function () {
        $(".cancel_mdal").fadeOut();
    })

    $(".bt_s").click(function () {
        $(".cancel_mdal").fadeOut();
    })

    $(".toggle_password").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    


    
});
$(document).ready(function(){
    $(".bank_paymentMethod_open").click(function () {
        $(".bank_paymentMethod").fadeIn();
    });
    $(".bt_close").click(function () {
        $(".bank_paymentMethod").fadeOut();
    });

    // show field after select 
    $('#mySelect').change(function () {
        $('#additionalFields').show();
    });
    $('#mySelect2').change(function () {
        $('#additionalFields2').show();
    });
});
$(document).ready(function(){
    // confirm modal 
    $(".confirm_").click(function () {
        $(".foating").fadeIn();
        setTimeout(function () {
            $(".foating").fadeOut();
        }, 1500)
    });
    $(".services_ label").click(function () {

        $(this).toggleClass("active");
        // $(".services_ a").addClass("active");
    });
    $(".dMdal_open").click(function () {
        event.stopPropagation();
        $(".dMdal_").fadeIn();
    });
    $(".bt_close").click(function () {
        $(".dMdal_").fadeOut();
    });
})
$(document).ready(function () {
    $(".btn_success").click(function () {
        $("#messagePopup").fadeIn();
        setTimeout(() => {
            $("#messagePopup").fadeOut();
        }, 2000);
    });
});