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

<nav class="navbar navbar-expand-lg navbar-light bg-primary sticky-top">
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
                        @if (empty(auth()->user()->middle_name))
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        @else
                            {{ auth()->user()->first_name }} {{ auth()->user()->middle_name[0] . '.' }} {{ auth()->user()->last_name }}
                        @endif
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="#">Manage Account</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <form action="/logout_user" method="post">
                            @csrf
                            <li><button type="submit" class="dropdown-item">Logout</button></li>
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>