<nav class="navbar top-navbar navbar-expand">
                <div class="collapse navbar-collapse" id="navbarSupportContent">



                    <form class="nav-search-form d-none ml-auto d-md-block">

                    </form>

                    <ul class="navbar-nav right-nav align-items-center">

                        <li class="nav-item dropdown profile-nav-item">
                            <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="menu-profile">
                                    <span class="name">{{Auth::user()->name??''}}</span>
                                    <img src="{{asset('uploads/'.$imageName)}}" alt="{{$imageName}}" height="50" class="rounded-circle"/>
                                </div>
                            </a>

                            <div class="dropdown-menu">
                                <div class="dropdown-header d-flex flex-column align-items-center">
                                    <div class="figure mb-3">

                                          <img src="{{asset('uploads/'.$imageName)}}" alt="{{$imageName}}" height="50" class="rounded-circle"/>
                                     </div>

                                    <div class="info text-center">
                                        <span class="name">{{Auth::user()->name??''}}</span>
                                        <p class="mb-3 email">{{Auth::user()->email??''}}</p>
                                    </div>
                                </div>



                                <div class="dropdown-footer">
                                    <ul class="profile-nav">
                                        <li class="nav-item">

                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                                      <span> <i class='bx bx-log-out'></i> Logout</span>
                                         </a>

                                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                             @csrf
                                         </form>


                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
