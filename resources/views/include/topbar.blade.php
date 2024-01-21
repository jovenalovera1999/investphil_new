<style>
    .topbar {
        display: flex;
        justify-content: center;
        /* Center horizontally */
        align-items: center;
        /* Center vertically */
        height: 100px;
        /* Set the height of the top bar */
        background-color: #333;
        /* Background color for the top bar */
    }

    .logo {
        width: 100px;
        /* Set the width of the logo */
        height: 100px;
        /* Set the height of the logo */
        border-radius: 50%;
        /* Make the logo circular */
        overflow: hidden;
        /* Clip any overflowing content */
    }

    .logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Preserve aspect ratio and cover the entire space */
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarScrollingDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Full Name of User
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="#">Manage Account</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <form action="#" method="post">
                            <li><button type="submit" class="dropdown-item" name="logout">Logout</button></li>
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- <nav class="navbar navbar-light fixed-top bg-primary" style="padding:0;min-height: 3.5rem">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display: flex;">
  		
  		</div>
      <div class="col-md-4 float-left text-white">
        <large><b><?php echo isset($_SESSION['system']['name']) ? $_SESSION['system']['name'] : '' ?></b></large>
      </div>
	  	<div class="float-right">
        <div class=" dropdown mr-4">  <i class="fa fa-user-shield"></i>
            <a href="#" class="text-white dropdown-toggle"  id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">full name of user </a>
              <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                <a class="dropdown-item" href="ajax.php?action=logout" name="logout"><i class="fa fa-power-off"></i> Logout</a>
              </div>
        </div>
      </div>
  </div>
  
</nav> -->

{{-- <script>
    $('#manage_my_account').click(function(){
    uni_modal("Manage Account","manage_user.php?id=user id &mtype=own")
  })
</script> --}}