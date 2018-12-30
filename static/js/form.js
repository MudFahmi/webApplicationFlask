/**
 * Created by houdavic on 3/26/2017.
 */



    $(document).ready(function () {

        $('form').on('submit',function(event){

            $.ajax({
                data : {
                    email : $('#email_input').val(),
                    password : $('#password_input').val(),
                },

                type :'POST' ,
                url : "/login"
            })

                .done(function (data) {

                    if(data.error){

                        $('#error_login').text(data.error).show();

                        $('#success_login').hide();

                    }
                    else{

                        $('#success_login').text(data.name).show();

                        $('#error_login').hide();
                    }
                })

            event.preventDefault();

        });

    })


