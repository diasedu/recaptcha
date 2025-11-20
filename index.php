<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./recaptcha-check.php" id="demo-form" method="post">

        <button 
            class="g-recaptcha" 
            data-sitekey="6LfszxIsAAAAANHPxUwDKile7h6Hpzqa7fhGdo11" 
            data-callback='onSubmit' 
            data-action='submit'
        >Submit</button>    
    </form>

    <script src="https://www.google.com/recaptcha/api.js?render=6LfszxIsAAAAANHPxUwDKile7h6Hpzqa7fhGdo11"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }
    </script>
</body>
</html>