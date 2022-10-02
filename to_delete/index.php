<!DOCTYPE html>
<html>
<head>
<title>Training Application</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
    <div class="form">
        <form method="POST" action="login.php">
            <fieldset>
                <legend style="text-transform: uppercase; font-size: 1.6em">Application form</legend>


                <div>
                <label>Username :</label>
                <input type="text" name="username" class="form-control" required="required"/>
                </div>
                <div>
                <label>Password :</label>
                <input type="password" name="password" class="form-control" required="required"/>   
                </div>
                <button name="login">Login</button>
            </fieldset>
        </form>
 
    </div>
</body>
</html>
