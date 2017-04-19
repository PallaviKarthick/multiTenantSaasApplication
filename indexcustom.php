<!DOCTYPE html >
<html>

    <head>
      <title> Grading System </title>
      <style>
      .grading{position:relative;
      left:460px;
      border: 1px solid black;
      border-radius:5px;
      width:400px;
      padding:10px;}
      </style>
    </head>
    <body>
      <div class="grading">
        <h1 style = "text-align:center">  Grading System </h1>
      <section class="one">

          <form enctype="multipart/form-data" name='grade' action='grade_submit.php' method='POST' accept-charset='UTF-8'>
          <p>Username: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="username" value= <?php
          if(isset($_POST["username"])){
           echo  $_POST["username"] ;
          }
           ?>></p>
          <p>Student ID: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="id" value= <?php
          if(isset($_POST["username"])){
           echo  $_POST["id"] ;
          }
           ?>></p>
          <h3> Grading Attributes </h3>
          <p  style = <?php
          if(!isset($_POST["scale"])){
           echo   "display:none;";
          }
           ?> >
          Scale: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="scale" value=""></p>


          <p
          style = <?php
          if(!isset($_POST["points"])){
           echo   "display:none;";
          }
           ?> >
          Points &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select>
                <option name="points" value="1">1</option>
                <option name="points" value="2">2</option>
                <option name="points" value="3">3</option>
                <option name="points" value="4">4</option>
                <option name="points" value="5">5</option>
            </select>
          </p>



          <p
          style = <?php
          if(!isset($_POST["completeNotComplete"])){
           echo   "display:none;";
          }
           ?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <form >
              <input type="radio" name="completed" value="completed"> Completed
              <input type="radio" name="completed" value="notcompleted"> Not Completed
            </form>
          </p>
          <p
          style = <?php
          if(!isset($_POST["comments"])){
           echo   "display:none;";
          }
           ?>

          >Comments: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="message" rows="3" cols="18"></textarea></p>


          <p><label> Zip/Jar file to upload: <input type="file" name="zip_file" /></label></p>

          <p><button type="submit" style="align:right;width:100px;">Submit</button><br></p>
        </form>
      </section>
    </div>
    </body>
</html>
