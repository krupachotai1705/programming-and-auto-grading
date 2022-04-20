<nav class="navbar navbar-dark bg-dark">
  <ul class="nav content">
  <li class="nav-item">
    <div class="container">
      <a href="index.php"  class="navbar-brand mb-0 h1"><b><h2>Compiler</h2></b></a>
    </div>
  </ul>
  <ul class="nav content-end">
    <?php if(isset($_SESSION['type']) && $_SESSION['type']=="teacher"){?>
    <li class="nav-item">
      <a class="nav-link" style="color:#808080" href="index.php"><h4>Home</h4></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:#808080" href="addstudent.php"><h4>Add Student</h4></a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  style="color:#808080" href="addsubject.php"><h4>Add Subject</h4></a>
    </li>
    <?php }?>
    <li class="nav-item">
      <a class="nav-link" style="color:#808080" href="logout.php"><h4>Logout<h4></a>
    </li>
  </ul>
</nav>