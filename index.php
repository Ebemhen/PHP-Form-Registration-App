<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = mysqli_connect("localhost", "root", "","formdatabase") or die("Failed to connect to database");



            $userName = mysqli_real_escape_string($connection, $_POST['userName']);
            $email = mysqli_real_escape_string($connection, $_POST['email']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            $phoneNumber = mysqli_real_escape_string($connection, $_POST['phoneNo']);
            $gender = mysqli_real_escape_string($connection, $_POST['gender']);
            $language = mysqli_real_escape_string($connection, $_POST['language']);
            $zipCode = mysqli_real_escape_string($connection, $_POST['zipCode']);
            $about = mysqli_real_escape_string($connection, $_POST['about']);

            
            $sqlData = "INSERT INTO userrecords (Name , Email , Password, PhoneNumber, Gender, Language, ZipCode,	About ) VALUES ('$userName', '$email', '$password','$phoneNumber' , '$gender', '$language', '$zipCode', '$about')";
            


            if ($connection->query($sqlData)===TRUE){
                echo '<p class="success-message">Your form has been successfully submitted.<br>To navigate through all the records in the form, and to search for users records randomly, <a class="allRecords-link" href="./allRecords.php">click here</a></p>';
            }else {
                echo "alert(Error:". $sqlData . mysqli_error($connection).")";
            }

            mysqli_close($connection);
    }
 
?> 


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Web Application</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
      href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap"
      rel="stylesheet"/>
  </head>
  <body>
    <header></header>
    <main>
      <div class="form-wrapper">
        <div class="form-head">
          <div class="img-container">
            <img
              class="form-passport"
              src="./assets/DoenPic.jpeg"
              alt="My passport"
            />
          </div>
          <h1 class="form-title">Registration Form</h1>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" id="form" name="myform" method="POST">
          <div class="input-container">
            <label for="userName">Name: </label>
            <div class="input-wrapper">
              <input
                class="input-element"
                type="text"
                name="userName"
                id="userName"
                placeholder="your name"
              />
              <small class="errorMessage" id="error"></small>
            </div>
          </div>
          <div class="input-container">
            <label for="email">Email: </label>
            <div class="input-wrapper">
              <input
                class="input-element"
                type="email"
                name="email"
                id="email"
                placeholder="your email"
              />
              <small class="errorMessage" id="error"></small>
            </div>
          </div>
          <div class="input-container">
            <label for="password">Password: </label>
            <div class="input-wrapper">
              <input
                class="input-element"
                type="password"
                name="password"
                id="password"
              />
              <small class="errorMessage" id="error"></small>
            </div>
          </div>
          <div class="input-container input-div">
            <label for="phone-number">Phone Number: </label>
            <div class="input-wrapper">
              <input
                class="input-element"
                type="tel"
                name="phoneNo"
                id="phoneNo"
              />
              <small class="errorMessage" id="error"></small>
            </div>
          </div>
          <div class="radio-container">
            <label for="gender">Gender:</label>
            <div class="input-element input-wrapper">
              <label for="male">Male: </label>
              <input type="radio" value="male" name="gender" id="male" onclick="genderValidation()"/>
              <label for="female">Female: </label>
              <input type="radio" value="female" name="gender" id="female" onclick="genderValidation()"/>
              <label for="other">Other: </label>
              <input type="radio" value="other" name="gender" id="other" onclick="genderValidation()"/>
              <small class="errorMessage" id="error"></small>
            </div>

          </div>
          <div class="input-container">
            <label for="language">Language: </label>
            <div class="input-wrapper">
              <select name="language" id="language" class="input-element" onchange="languageValidation()" on="languageValidation()">
                <option value="" disabled selected hidden>
                  Select Language
                </option>

                <?php 
                //open mysql database connection
                $connection = mysqli_connect("localhost", "root", "","formdatabase") or die("Failed to connect to database");
                $query = "SELECT * FROM languages";
                $result = mysqli_query($connection, $query);

                while ($language = mysqli_fetch_assoc($result)){
                  echo"<option value ='".$language["Language"]. "'>" . $language["Language"]. "</option>";
                }

                //close mysql database connection
                mysqli_close($connection);

              ?>
              
              </select>
              <small class="errorMessage" id="error"></small>
            </div>
          </div>
          <div class="input-container">
            <label for="zipCode">Zip Code: </label>
            <div class="input-wrapper">
              <input
                type="text"
                name="zipCode"
                id="zipCode"
                class="input-element"
              />
              <small class="errorMessage" id="error"></small>
            </div>
          </div>
          <div class="input-container textarea-div">
            <label for="about">About: </label>
            <div class="input-wrapper">
              <textarea
                name="about"
                id="about"
                class="input-element"
                cols="30"
                rows="2"
                placeholder="Write about yourself..."
              ></textarea>
              <small class="errorMessage" id="error"></small>
            </div>
          </div>
          <div class="submit-container">
            <input
              id="submit-btn"
              class="submit-btn"
              type="submit"
              value="Register"
            />
          </div>
        </form>
      </div>
    </main>
    <script src="./script.js"></script>
  </body>
</html>
