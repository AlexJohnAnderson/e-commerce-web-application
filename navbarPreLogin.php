<!-- 
    Navbar without login
-->

<?php
echo '
  <!doctype html>
  <html>
    <head>
      <title>Emazon</title>
    </head>
    <body>
      <nav class="menu" id="menu">
        <input type="text" placeholder="Search Emazon" />
        <div class="container container-nav-links">
          <div class="btn-departments" id="btn-departments">
            <p>All <span>Departments</span></p>
            <i class="fas fa-caret-down"></i>
          </div>

          <div class="links">
            <a href="#">Login</a>
            <a href="#">Sign Up</a>
          </div>
        </div>
      </nav>
    </body>
  </html>'
?>

<style>
  body {
    background-color: #EAEDED;
    font-family: Arial, sans-serif;
  }
  /** SEARCH BAR**/
  input{
    vertical-align:top;
    margin-top:10px;
    border-radius:10px;
    height:20px;
    width:500px;
  }
  /** --------------------
      NAV AND NAV-LINKS
    -------------------- **/
    .menu {
    background: #232F3E;
    padding: 5px 0;
    margin-bottom: 20px;
  }
  
  .menu .container-menu-buttons {
    /* display: flex; */
    display: none;
    justify-content: space-between;
  }
  
  .menu .container-menu-buttons button {
    font-size: 20px;
    color: #FFF;
    padding: 10px 20px;
    border: 1px solid transparent;
    display: inline-block;
    cursor: pointer;
    background: none;
  }
  
  .menu .container-menu-buttons button:hover {
    border: 1px solid rgba(255,255,255, .4);
  }
  
  .menu .container-menu-buttons .btn-menu-close {
    display: none;
  }
  
  .menu .container-menu-buttons .btn-menu-close.active {
    display: inline-block;
  }
  
  .menu .container-nav-links {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .menu .btn-departments {
    color: #FFF;
    padding: 7px;
    border-radius: 3px;
    display: flex;
    align-items: flex-end;
    border: 1px solid transparent;
    font-size: 12px;
    cursor: default;
  }
  
  .menu .btn-departments i {
    margin-left: 20px;
    position: relative;
    bottom: 3px;
  }
  
  .menu .btn-departments:hover {
    border: 1px solid rgba(255,255,255, .4);
  }
  
  .menu .btn-departments span {
    display: block;
    font-size: 14px;
    font-weight: bold;
  }
  
  .menu .container-nav-links .links a {
    color: #CCC;
    border: 1px solid transparent;
    padding: 7px;
    border-radius: 3px;
    font-size: 14px;
  }
  
  .menu .container-nav-links .links a:hover {
    border: 1px solid rgba(255,255,255, .4);
  }
</style>