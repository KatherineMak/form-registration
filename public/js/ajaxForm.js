$(document).ready(function() {
    var action = ajaxForm.getAction( window.location.pathname );

    if (action === 'index') {
        ajaxForm.showIndexForm();
    } else if (action === 'additional') {
        ajaxForm.showAdditionalForm();
    } else if (action === 'share') {
        ajaxForm.showShareForm();
    }
});

var ajaxForm = {
    showIndexForm: function() {
        $.ajax({
            type:'GET',
            dataType: "JSON",
            url:'/ajaxparticipaint',
            success:function(data){
                $("#form").html(data.view);
                history.pushState(null, null, '/index');
                setTimeout(function(){
                    $(document).on('click', '#birthday', function () {
                        $("#birthday").datepicker({
                            showOn: 'focus',
                            altFormat: "mm/dd/yy",
                            dateFormat: "mm/dd/yy",
                            minDate: '12/31/1940',
                            maxDate: '+0m +0w',
                            changeMonth: true,
                            changeYear: true,
                            yearRange: '1950:2019'
                        }).focus();
                    }).on('focus', '#birthday', function () {
                        $("#birthday").mask('99/99/9999');
                    });

                    $("#phone").mask("+9(999) 999-9999");
                }, 1000);
            },
            error: function(data) {
                console.log('unexpected error!');
            }
        });
    },
    showAdditionalForm: function() {

        $.ajax({
            type:'GET',
            dataType: "JSON",
            url:'/checksessionemail',
            success:function(data){
                if (data.code) {
                    ajaxForm.showIndexForm();
                } else {
                    console.log(data.email)

                    $.ajax({
                        type:'GET',
                        dataType: "JSON",
                        url:'/ajaxadditional',
                        success:function(data){
                            $("#form").html(data.view);
                            $("#email").val(data.email);
                            $('#upload').change(function(e){
                                var fileName = e.target.files[0].name;
                                $('.custom-file-label').html(fileName);
                            });
                            history.pushState(null, null, '/additional');
                        },
                        error: function(data) {
                            console.log('error');
                            //console.log(data);
                        }
                    });

                }
            },
            error: function() {
                console.log('error');
            }
        });

        return false;
    },
    showShareForm: function() {
        $.ajax({
            type:'GET',
            url:'/ajaxshare',
            dataType: "JSON",
            success:function(data){
                // $("#form").html(data.num);
                $("#form").html(data.view);
                let contentBtn = "All members (" + data.num + ")";
                $("#members-btn").html(contentBtn);
                history.pushState(null, null, '/share');
            },
            error: function(data) {
                console.log(data);
            }
        });
        return false;
    },
    checkValidate: function(e) {
        // $( "birthday" ).attr("pattern", `(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19[0-9][0-9]|20[0-1][0-9])`)
        // var nowDate = new Date();
        // var date = nowDate.getFullYear()+'/'+(nowDate.getMonth()+1)+'/'+nowDate.getDate();
        // console.log(date);
        // $( "input" ).attr("pattern", '\d*\.?\d*');
        var form = $('#form1')[0];
        if (form.checkValidity()){

            ajaxForm.checkEmail('form1', '/existEmail');

        }
        form.classList.add('was-validated');
    },

    checkValidateAdditional: function(e) {
        let result = 1;
        let input = $('#upload').get(0);
        if (input.files.length > 0) {
            if (input.files[0].size > (1024 * 1024 * 2)) {
                console.log(input.files[0].size );
                input.setCustomValidity("Invalid file size");
                result = 1;
            } else {
                input.setCustomValidity("");
                result = 0;
            }
        } else {
            input.setCustomValidity("");
            result = 0;
        }

        $('#form2').get(0).classList.add('was-validated');
        return result;
    },

    checkEmail: function(form, url) {
        $.ajax({
            url:     url,
            type:     "POST",
            dataType: "JSON",
            data: {email: $("#email1").val()},
            success: function(response) {
                console.log(response.detail);
                if (!response.code) {
                    if (response.data) {
                        $('#no-unique-email').html('').show().append('Email aready exist');
                        console.log("Email already exist.");
                    } else {
                        console.log("An email is unique.");
                        $.ajax({
                            type:'POST',
                            url:'/store',
                            data: $("#form1").serialize(),
                            success:function(data){
                                if (!data.code) {
                                    ajaxForm.showAdditionalForm();
                                } else {
                                    console.log("unknown error");
                                }
                            },
                            error: function(data) {
                                console.log("unknown error");
                            }
                        });
                    }
                } else {
                    console.log(response.detail);
                    console.log("Code =1 ");
                }
            },
            error: function(response) {
                console.log(response);
                console.log("Data didn't sent!!!");
            }
        });
    },

    storeMainForm: function(e) {
        e.preventDefault();
        e.stopPropagation();
        ajaxForm.checkValidate(e);
        return false;
    },

    saveAdditionalForm: function(e) {
        e.preventDefault();
        e.stopPropagation();
        if (ajaxForm.checkValidateAdditional(e)) {
            console.log('No validate additional form');
        } else {
            $('#no-validate-photo').html('').show().append("Photo loading...");
            var fd = new FormData($("#form2").get(0));
            //console.log(fd);
            $.ajax({
                type:'POST',
                url:'/additsave',
                data: fd,
                contentType: false, // важно - убираем форматирование данных по умолчанию
                processData: false, // важно - убираем преобразование строк по умолчанию
                success:function(data){
                    let result = JSON.parse(data);
                    //console.log(tmp);
                    if (!result.code) {
                        if (result.photoCode) {
                            $('#no-validate-photo').html('').show().append(result.photoDetail);
                            return false;
                        } else {
                            $('#no-validate-photo').html('');
                            ajaxForm.showShareForm();
                        }
                    } else {
                        console.log("unknown error");
                    }
                },
                error: function(data) {
                    console.log('error');
                }
            });
        }
        return false;
    },
    getAction: function(url) {
        if (url === '/') {
            return '';
        } else {
            var fullPath = url.split('/');
            return  fullPath[1];
        }
    },
}