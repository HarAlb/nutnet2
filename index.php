<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>

    <!-- For Seo -->
    <meta name="description" content="Add New User In ">
    <meta name="author" content="Albert Harutyunyan">

    <!-- No Index -->
    <meta name="robots" content="noindex">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style type="text/css">
        .absolute-center {
            top: 50%;
            left: 50%;
            transform: translate(-50% , -50%);
        }
    </style>
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div>
            <h1>Register</h1>
        </div>
        <div class="row pt-5">
            <form id="add-user" class="border p-2 rounded m-auto">
                <h2>All Fields are required and write in english</h2>
                <div class="form-group">
                    <label for="user-name">Name Please</label>
                    <input id="user-name" type="text" name="username" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="user-surname">Surname Please</label>
                    <input id="user-surname" type="text" name="surname" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="user-age">Age</label>
                    <input id="user-age" type="number" name="age" class="form-control" min="10" max="100"/>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>


    <script type="text/javascript" async>
        jQuery(document).ready(function($) {
            $(document).on('click' , 'button[type="submit"]' , function(e){
                e.preventDefault();
                let form = validated_form();
                if(form){
                    $.ajax({
  						method: "POST",
  						url: "main.php",
  						data: {"clicked" : form}
					}).done(function( msg ) {
                        try{
                            msg = JSON.parse(msg);
                            console.log(msg);
                            if(msg.success){
                                alert(msg.success);
                                window.location = window.location;
                            }
                        }catch(e){
                           alert(e);
                        }
                    });
                }
            })

            function validated_form(){
                let inputs = $('form input[type!="submit"], form textarea');
                var textRegex = /^\w{1,100}$/
                var ageRegex = /^\d{1,2}$/;
                var data = {};
                var bool = true;
                inputs.each(function(index , key){
                    data[key.name] = key.value;
                    if( key.type === "text" ){
                        if( !textRegex.test(key.value) ){
                            $(key).addClass('is-invalid');
                            $(key).prev().addClass('text-danger').text('This field is not valid');
                            bool = false;
                        }
                    }else{
                        if(!ageRegex.test(parseInt(key.value))){
                            $(key).addClass('is-invalid');
                            $(key).prev().addClass('text-danger').text('This field is not valid');
                            bool = false;
                        }
                    }


                });
                return bool ? data : bool ;
            }
        })
    </script>
</body>

</html>